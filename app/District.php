<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
    	'region_id',
    	 'name',
    ];

    public function region(){
    	return $this->belongsTo('App\Region');
    }

    public function facilities(){
    	return $this->hasMany('App\Facility');
    }
   
}


