<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\Client;
use App\Models\Admin;
use App\Models\User;

use Validator;
use Auth;
use View;

class UserController extends Controller
{
    public function userDetails() {
        $user = Auth::guard('api')->user();

        return response()->json(['user' => $user]);
    }

    public function clientRegister(Request $request)
    {
        $data = $request->validate([
            'userName' => 'required|string|max:250',
            'role' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'userName' =>  $data['userName'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('token')->accessToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];


        $request->validate([
            'title' => 'required|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'age' => 'required|max:255',
            'address' => 'required|max:255',
            'sex' => 'required|max:255',
            'phonenumber' => 'required|max:255',
            'imagePath' => 'mimes:png, jpg, gif, svg',

        ]);

        //inserting data through post request
        $client = new client();

        $client->user_id = $user->id;
        $client->title = $request->title;
        $client->firstName = $request->firstName;
        $client->lastName = $request->lastName;
        $client->age = $request->age;
        $client->address = $request->address;
        $client->sex = $request->sex;
        $client->phonenumber = $request->phonenumber;

        $files = $request->file('uploads');

        $client->imagePath = 'images/' .  $files->getClientOriginalName();
        $client->save();

        Storage::put('public/images/' . $files->getClientOriginalName(), file_get_contents($files));

        return View::make('client.index');
    }

    public function adminRegister(Request $request)
    {
        $data = $request->validate([
            'userName' => 'required|string|max:250',
            'role' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'userName' =>  $data['userName'],
            'role' => $data['role'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('token')->accessToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        $request->validate([
            'name' => 'required|max:255',
            'job' => 'required|max:255',
            'address' => 'required|max:255',
            'phonenumber' => 'required|max:255',
            'imagePath' => 'mimes:png, jpg, gif, svg',
        ]);

        //inserting data through post request
        $admin = new admin();

        $admin->user_id = $user->id;
        $admin->name = $request->name;
        $admin->job = $request->job;
        $admin->address = $request->address;
        $admin->phonenumber = $request->phonenumber;

        $files = $request->file('uploads');

        $admin->imagePath = 'images/' .  $files->getClientOriginalName();
        $admin->save();

        Storage::put('public/images/' . $files->getClientOriginalName(), file_get_contents($files));

        return View::make('instrument.index');

    }

    public function login(Request $request) {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation->fails()){
            return response()->json(['error' => $validation->errors()],422);
        }

        if (Auth::attempt(['email' => $input['email'],'password' => $input['password']])) {
            $user = Auth::user();
            
            // dd($user);

            $token = $user->createToken('token')->accessToken;

            return View::make('client.index');
        }
    }

    public function logout(Request $request) {
        // Auth::logout();
        // return ['message' => 'Logged out',];

        $accessToken = Auth::user()->token();
        DB::table('oauth_access_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response()->json(null, 204);


        // DB::table('personal_access_tokens')->delete();
        // return ['message' => 'Logged out',];

        // $user = Auth::user()->tokens();
        // $user->revoke();

        // $response = ["message" => "You have Successfully Logout!"];

        // return response()->json($success, 200);
    }
}
