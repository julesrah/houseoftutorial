<?php

namespace App\Http\Controllers;

use App\Models\instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class instrumentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('instrument.index');
    }

    public function getInstrumentsAll(Request $request)
    {
        //if ($request->ajax()){
            $instruments = Instrument::orderBy('id', 'DESC')->get();
            return response()->json($instruments);
            //}
            
    }

    public function getInstrument(Request $request, $id){
        // if ($request->ajax()) {
            $instrument = Instrument::where('id',$id)->first();
             return response()->json($instrument);
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

        $instrument = new Instrument;
        $instrument->instrument_name = $request->instrument_name;
        $instrument->type = $request->type;
        $instrument->description = $request->description;
        $instrument->condition = $request->condition;

        $files = $request->file('uploads');

        $instrument->imagePath = 'images/'.$files->getClientOriginalName();
        $instrument->save();

        Storage::put('public/images/'.$files->getClientOriginalName(), file_get_contents($files));
        return response()->json(["success" => "instrument created successfully.", "instrument" => $instrument, "status" => 200]);
  
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
        $instrument = instrument::Find($id);
        return response()->json($instrument);
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
        $instrument = instrument::find($id);

        $instrument->instrument_name = $request->instrument_name;
        $instrument->type = $request->type;
        $instrument->description = $request->description;
        $instrument->condition = $request->condition;

        $files = $request->file('uploads');

        $instrument->imagePath = 'images/'. $files->getClientOriginalName();
        $instrument->save();

        Storage::put('public/images/'.$files->getClientOriginalName(), file_get_contents($files));
        return response()->json(["success" => "instrument updated successfully.", "instrument" => $instrument, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instrument = instrument::findOrFail($id);

        if (File::exists("storage/" . $instrument->imagePath)) {
            File::delete("storage/" . $instrument->imagePath);
        }

        $instrument->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
