<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Travel;
use App\Sflight;

class Eflight extends Model
{
     protected $fillable = [
        'end_id','city_end'
    ];
	public function Travel()
    {
    	 return $this->hasOne('App\Travel');
    }
}
