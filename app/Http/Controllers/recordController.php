<?php

namespace App\Http\Controllers;

use App\Models\damage;
use Illuminate\Http\Request;
use App\Models\instrument;
use App\Models\instructor;
use App\Models\record;
use App\Models\record_damages;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;

class recordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instrument = instrument::pluck('instrument_name','id');
        $instructor = instructor::pluck('instructor_name','id');
        $damage = damage::pluck('title','id');
        return View('record.index',[
            'instrument' => $instrument,
            'instructor' => $instructor,
            'damage' => $damage,
        ]);
    }

    public function getRecordsAll(Request $request)
    {
            $records = DB::table('records')
            ->leftJoin('instruments','instruments.id','=','records.instrument_id')
            ->leftJoin('instructors','instructors.id','=','records.instructor_id')
            ->leftJoin('records_damages','records_damages.record_id','=','records.id')
            ->join('damages','damages.id','=','records.id')
            ->select('records.*', 'records_damages.*', 'records.id AS recordid', 'records.recordDate AS recordDate', 'records.fee AS fee', 'records.comment AS comment', 'instruments.*', 'instructors.*', 'damages.*',  'records_damages.record_id AS records_fk','damages.id AS damages_id', 'damage_id AS damages_fk', 'damages.title AS damagetitle', 'damages.description AS description')
            ->get();
            
            return response()->json($records);
            
    }

    public function getRecord(Request $request, $id){
        // if ($request->ajax()) {
            $record = record::where('id',$id)->first();
             return response()->json($record);
        // }
    }

    public function searchindex(Request $request)
    {
        
        if (empty($request->get('search'))) {
            $records = record::with('instruments')->get(); 
        
        }
    
        else {

            $records = record::whereHas('instruments', function($q) use($request){
                $q->where("isntrument_name","LIKE", "%".$request->get('search')."%");})
              ->get();
          }
      
          $url = 'records';
      
        return View::make('welcome',compact('records','url'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    //     $damage = damage::get();
        
    //     return View::make('record.index', compact('damage'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $record = new record;
        // $record->instructor_id = $request->instructor_id;
        // $record->instrument_id = $request->instrument_id;
        // $record->recordDate = $request->recordDate;
        // $record->fee = $request->fee;
        // $record->comment = $request->comment;

        // $record->save();

        // $damages = new record_damages;
        // $damages->record_id = $record->id;
        // $damages->damaged_id = $request->damage_id;
        // $record->save();

        $input = $request->all();
        $record = record::create($input);
        if(!(empty($request->record_id))){
                $record->records_damages()->attach($request->record_id); 
        }
        //   return Redirect::route('record.index')->with('success','record created!');
        return response()->json(["success" => "record stored successfully.", "record" => $record, "status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $animals = animal::with('consultations')->where('id',$id)->get();
        // $consultations = consultations::with('diseases_injuries','employee')->where('animal_id',$id)->get();
        // return view('consultations.show',compact('animals','consultations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
