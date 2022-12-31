<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\damage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class damageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('damage.index');
    }

    public function getDamagesAll(Request $request)
    {
        //if ($request->ajax()){
            $damages = damage::orderBy('id', 'DESC')->get();
            return response()->json($damages);
            //}
            
    }

    public function getDamage(Request $request, $id){
        // if ($request->ajax()) {
            $damage = damage::where('id',$id)->first();
             return response()->json($damage);
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
        $damage = new damage;
        $damage->title = $request->title;
        $damage->description = $request->description;

        $files = $request->file('uploads');

        $damage->imagePath = 'images/'.$files->getClientOriginalName();
        $damage->save();

        Storage::put('public/images/'.$files->getClientOriginalName(), file_get_contents($files));
        return response()->json(["success" => "damage created successfully.", "damage" => $damage, "status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $damage = damage::Find($id);
        return response()->json($damage);
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
        $damage = damage::find($id);

        $damage->title = $request->title;
        $damage->description = $request->description;

        $files = $request->file('uploads');

        $damage->imagePath = 'images/'. $files->getClientOriginalName();
        $damage->save();

        Storage::put('public/images/'.$files->getClientOriginalName(), file_get_contents($files));
        return response()->json(["success" => "Damage updated successfully.", "damage" => $damage, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $damage = damage::findOrFail($id);

        if (File::exists("storage/" . $damage->imagePath)) {
            File::delete("storage/" . $damage->imagePath);
        }

        $damage->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
