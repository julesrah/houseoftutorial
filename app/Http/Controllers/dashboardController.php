<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function salesChart() {
        // $cars = DB::table('orderlines')
        // ->join('cars as c', 'c.id', 'orderlines.car_id')
        // ->groupBy('c.car_model')
        // ->orderBy('total')
        // ->pluck(DB::raw('count(c.car_model) as total'),'c.car_model')
        // ->all();

        $total = DB::table('clients')
        ->join('service_orderinfo','clients.id','=', 'service_orderinfo.client_id')
        ->join('service_orderline','service_orderinfo.service_orderinfo_id','=','service_orderline.service_orderinfo_id')
        ->join('services', 'service_orderline.service_id','=','services.id')
        ->groupBy('service_orderinfo.schedule')
        ->pluck(DB::raw('SUM(services.price) AS total'), 'service_orderinfo.schedule as date')
        ->all();
        
        $labels = (array_keys($total));
        $data= array_values($total);
     
        return response()->json(array('data' => $data, 'labels' => $labels));

        // return View('dashboard.index',[
        //     'data' => $data,
        //     'labels' => $labels
        // ]);

    }

    public function serviceChart(){
        //gets the charts for product brands
        $servname = DB::table('services')->groupBy('servname')->orderBy('total')->pluck(DB::raw('count(servname) as total'), 'servname')->all();
        $labels = (array_keys($servname));

        $data = array_values($servname);
       
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function instrumentChart(){
        $instruments = DB::table('instruments')->groupBy('type')->orderBy('total')->pluck(DB::raw('count(type) as total'), 'type')->all();
        $labels = (array_keys($instruments));

        $data = array_values($instruments);
       
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function instructorChart(){
        $instructors = DB::table('instructors')->groupBy('status')->orderBy('total')->pluck(DB::raw('count(status) as total'), 'status')->all();
        $labels = (array_keys($instructors));

        $data = array_values($instructors);
       
        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function conditionChart(){
        $conditions = DB::table('instruments')->groupBy('condition')->orderBy('total')->pluck(DB::raw('count(condition) as total'), 'condition')->all();
        $labels = (array_keys($conditions));

        $data = array_values($conditions);
       
        return response()->json(array('data' => $data, 'labels' => $labels));
    }
}
