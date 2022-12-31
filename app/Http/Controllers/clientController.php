<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('client.index');
    }

    public function getClientsAll(Request $request)
    {
        //if ($request->ajax()){
            $clients = client::orderBy('id', 'DESC')->get();
            return response()->json($clients);
            //}
            
    }

    public function getClient(Request $request, $id){
        // if ($request->ajax()) {
            $client = client::where('id',$id)->first();
             return response()->json($client);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new client;
        $client->user_id = 25;
        $client->title = $request->title;
        $client->firstName = $request->firstName;
        $client->lastName = $request->lastName;
        $client->age = $request->age;
        $client->address = $request->address;
        $client->sex = $request->sex;
        $client->phonenumber = $request->phonenumber;

        $files = $request->file('uploads');

        $client->imagePath = 'images/' . time() . '-' . $files->getClientOriginalName();
        $client->save();

        $data = array('status' => 'saved');
        Storage::put('public/images/' . time() . '-' . $files->getClientOriginalName(), file_get_contents($files));

        return response()->json(["success" => "Client Created Successfully.", "clients" => $client, "status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = client::Find($id);
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = client::find($id);
        $client = $client->update($request->all());
        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = client::findOrFail($id);

        if (File::exists("storage/" . $client->imagePath)) {
            File::delete("storage/" . $client->imagePath);
        }

        $client->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
