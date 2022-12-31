<?php

namespace App\Http\Controllers;

use App\Models\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class instructorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('instructor.index');
    }

    public function getInstructorsAll(Request $request)
    {
        //if ($request->ajax()){
            $instructors = instructor::orderBy('id', 'DESC')->get();
            return response()->json($instructors);
            //}
            
    }

    public function getInstructor(Request $request, $id){
        // if ($request->ajax()) {
            $instructor = instructor::where('id',$id)->first();
             return response()->json($instructor);
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

        $instructor = new instructor;
        $instructor->user_id = 25;
        $instructor->name = $request->name;
        $instructor->specialty = $request->specialty;
        $instructor->description = $request->description;
        $instructor->status = $request->status;
        $instructor->address = $request->address;
        $instructor->phonenumber = $request->phonenumber;

        $files = $request->file('uploads');

        $instructor->imagePath = 'images/' . time() . '-' . $files->getClientOriginalName();
        $instructor->save();

        $data = array('status' => 'saved');
        Storage::put('public/images/' . time() . '-' . $files->getClientOriginalName(), file_get_contents($files));

        return response()->json(["success" => "instructor Created Successfully.", "instructors" => $instructor, "status" => 200]);
  
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
        $instructor = instructor::Find($id);
        return response()->json($instructor);
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
        $instructor = instructor::find($id);
        $instructor = $instructor->update($request->all());
        return response()->json($instructor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instructor = instructor::findOrFail($id);

        if (File::exists("storage/" . $instructor->imagePath)) {
            File::delete("storage/" . $instructor->imagePath);
        }

        $instructor->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }
}
