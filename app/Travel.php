<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Eflight;
use App\Sflight;

use DB;

class Travel extends Model
{
     protected $fillable = [
        'start_id','end_id','price',
    ];

    public function sflight(){
      return $this->belongsTo('App\Eflight');
    }

    // DIRECT FLIGHTS _____ START _______
    public static function get_direct_flight($start_city_id, $end_city_id)
    {
    	$direct_flight = DB::table('travels')
         ->join('sflights', 'travels.start_id', '=', 'sflights.start_id')
         ->join('eflights', 'travels.end_id', '=', 'eflights.end_id')
         ->where('travels.start_id', $start_city_id)
         ->where('travels.end_id', $end_city_id)
         ->select('travels.*', 'eflights.city_end', 'sflights.city_start')
         ->first();
            return $direct_flight;
    }
    public static function get_price($start_city_id, $end_city_id)
    {
         $price = DB::table('travels')
         ->join('sflights', 'travels.start_id', '=', 'sflights.start_id')
         ->join('eflights', 'travels.end_id', '=', 'eflights.end_id')
         ->where('travels.start_id', $start_city_id)
         ->where('travels.end_id', $end_city_id)
         ->select('travels.*', 'price')
         ->first();
            return $price;
    }
     // DIRECT FLIGHTS _____ END _______
    // FLIGHTS WITH ONE TRANSFER ALGORITM _____ START______
    public static function get_start_city_possibilities($start_city_id, $end_city_id)
    {
    	// first flight possibilities
    	$start_city = DB::table('travels')
         ->join('sflights', 'travels.start_id', '=', 'sflights.start_id')
         ->join('eflights', 'travels.end_id', '=', 'eflights.end_id')
         ->where('travels.start_id', $start_city_id)
         ->where('travels.end_id','!=',$end_city_id)
         ->select('travels.*', 'sflights.city_start', 'eflights.city_end')
         ->get();
         return $start_city;
         
    }
   public static function get_end_city_possibilities($start_city_id, $end_city_id)
   {
   	// second flight possibilities
   	$end_city = DB::table('travels')
         ->join('sflights', 'travels.start_id', '=', 'sflights.start_id')
         ->join('eflights', 'travels.end_id', '=', 'eflights.end_id')
         ->where('travels.end_id', $end_city_id)
         ->where('travels.start_id','!=',$start_city_id)
         ->select('travels.*', 'sflights.city_start', 'eflights.city_end')
         ->get();

         return $end_city;
   }
   // getting all combination ( flights with one trasnfer ) from $start_city and $end_city
   public static function one_city_transfer($start_city, $end_city)
   {
   	$one_city_transfer = [[]];
   	 foreach ($start_city as $first) 
         {
             foreach ($end_city as $end) 
             {
                if($first->end_id == $end->start_id)
                     {
                        $one_city_transfer[] = array('first_flight_id' => $first,'end_flight_id' => $end);
                     }
             }
         }

       return $one_city_transfer;
   }
   // FLIGHTS WITH ONE TRANSFER ALGORITM _____ END______

   // FLIGHTS WITH TWO TRANSFER ALGORITM _____ START______
   public static function two_cities_transfer($start_city, $end_city)
   {
   	 $two_cities_transfer = [[]];
         foreach ($start_city  as $first) 
         {
         	foreach ($end_city as $end) 
         	{
         		
         		// seaching in database if intermediate flight exist
	         		$second_flight = DB::table('travels')
                    ->join('sflights', 'travels.start_id', '=', 'sflights.start_id')
                    ->join('eflights', 'travels.end_id', '=', 'eflights.end_id')
	        		->where('travels.start_id', $first->end_id)
                    ->where('travels.end_id', $end->start_id)
                    ->select('travels.*', 'sflights.city_start', 'eflights.city_end')
	         		->first();

	         		if(!empty($second_flight))
	         		{
	         			// if exist -> saving in array
	         			/*echo "<h1>TWO TRANSFER</h1>";
	         		 	echo "$first->start_id"." ";
	         		 	echo "$first->end_id"."/";
	         		 	echo "$second_flight->start_id"." ";
	         		 	echo "$second_flight->end_id"."/";
	         		 	echo "$end->start_id"." ";
	         		 	echo "$end->end_id";*/
	         		 	$two_cities_transfer[] = array('first_flight_id' => $first,'second_flight_id' =>$second_flight,'end_flight_id' => $end);

	         		}
         	}
         }

         return $two_cities_transfer;
   }
}
