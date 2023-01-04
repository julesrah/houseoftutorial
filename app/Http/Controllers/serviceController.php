<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service;
use App\Models\instrument;
use App\Models\instructor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class serviceController extends Controller
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
        return View('service.index',[
            'instrument' => $instrument,
            'instructor' => $instructor,
        ]);
    }

    public function getServicesAll(Request $request)
    {
            $services = DB::table('services')
            ->leftJoin('instruments','instruments.id','=','services.instrument_id')
            ->leftJoin('instructors','instructors.id','=','services.instructor_id')
            ->select('services.*', 'services.id AS service_id', 'services.description AS service_desc', 'services.imagePath AS service_img', 'instruments.*', 'instructors.*')
            ->get();
            
            return response()->json($services);
            
    }

    public function getService(Request $request, $id){
        // if ($request->ajax()) {
            $service = service::where('id',$id)->first();
             return response()->json($service);
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
        $service = new service;
        $service->instructor_id = $request->instructor_id;
        $service->instrument_id = $request->instrument_id;
        $service->servname = $request->servname;
        $service->eventStarts = $request->eventStarts;
        $service->description = $request->description;
        $service->price = $request->price;

        $files = $request->file('uploads');

        $service->imagePath = 'images/'.$files->getClientOriginalName();
        $service->save();

        Storage::put('public/images/'.$files->getClientOriginalName(), file_get_contents($files));
        return response()->json(["success" => "service created successfully.", "service" => $service, "status" => 200]);
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
        $service = service::Find($id);
        return response()->json($service);
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
        $service = service::find($id);

        $service->instructor_id = $request->instructor_id;
        $service->instrument_id = $request->instrument_id;
        $service->servname = $request->servname;
        $service->eventStarts = $request->eventStarts;
        $service->description = $request->description;
        $service->price = $request->price;

        $files = $request->file('uploads');

        $service->imagePath = 'images/'. $files->getClientOriginalName();
        $service->save();

        Storage::put('public/images/'.$files->getClientOriginalName(), file_get_contents($files));
        return response()->json(["success" => "service updated successfully.", "service" => $service, "status" => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = service::findOrFail($id);

        if (File::exists("storage/" . $service->imagePath)) {
            File::delete("storage/" . $service->imagePath);
        }

        $service->delete();

        $data = array('success' => 'deleted', 'code' => '200');
        return response()->json($data);
    }

    public function postCheckout(Request $request)
    {
        $services = json_decode($request->getContent(),true);

        Log::info(print_r($items, true));
          try {
              DB::beginTransaction();
              $order = new Order();
              $client =  client::find(3);
              $client->orders()->save($order);

            foreach($services as $service) {

               $id = $service['service_id'];

               $order->services()->attach($order->service_orderinfo_id,['slot'=> $service['slot'],'service_id'=>$id]);

               $sessions = session::find($id);
               $sessions->slot = $sessions->slot - $service['slot'];
               $sessions->save();
            }
            
          }
          catch (\Exception $e) {
              DB::rollback();
              return response()->json(array('status' => 'Session failed','code'=>409,'error'=>$e->getMessage()));
              }
      
          DB::commit();
          return response()->json(array('status' => 'Session Success','code'=>200,'order id'=>$order->service_orderinfo_id));
          }
}
