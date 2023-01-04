<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Auth;

class UserController extends Controller
{
    public function userLogin(Request $request) {
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

            return response()->json(['token' => $token]);
        }
    }

    public function userDetails() {
        $user = Auth::guard('api')->user();

        return response()->json(['user' => $user]);
    }
}
