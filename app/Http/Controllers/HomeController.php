<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sflight;
use App\Eflight;
use App\Travel;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $sflights = Sflight::all();
        $eflights = Eflight::all();
        return view('home', compact('sflights',"eflights"));
    }

    public function create()
    {
        return view('create');
    }

    public function show(Request $request)
    {
        //taking cities
        $sflights = Sflight::all();
        $eflights = Eflight::all();

        // taking choosen cities
        $start_city_id = $request->get('start_id');
        $end_city_id = $request->get('end_id');

        // taking DIRECT flight without transfers
        // example -> Sofia->Burgas
        $direct_flight = Travel::get_direct_flight($start_city_id, $end_city_id);
        $price = Travel::get_price($start_city_id, $end_city_id);

        // taking specific flights with one transfer ___START___
        // example -> Sofia->Pleven->Burgas
        $start_city = Travel::get_start_city_possibilities($start_city_id, $end_city_id);
        $end_city = Travel::get_end_city_possibilities($start_city_id, $end_city_id);
        $one_city_transfer = Travel::one_city_transfer($start_city, $end_city);
         // taking specific flights with one transfer ____END_____

         // taking specific flights with two transfer _____START______
         // example -> Sofia->Vratsa->Pleven->Burgas
        $two_cities_transfer = Travel::two_cities_transfer($start_city, $end_city);
        // taking specific flights with two transfer _____END____
        return view('home', compact(
            'start_city_id','end_city_id',
            'start_city','end_city',
            'sflights',"eflights","direct_flight",
            "one_city_transfer",'two_cities_transfer','price'

        ));
       
    }
}
