<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Travel;
use App\Eflight;

class Sflight extends Model
{
    protected $fillable = [
        'end_id','city_start'
    ];

    public function eflight(){
      return $this->hasOne('App\Eflight');
    }
   
}
