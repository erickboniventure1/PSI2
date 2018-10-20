<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable =[
    	'name',
    ];
    
    public function facilities(){
    	return $this->hasMany('App\Facility');
    }
    
    public function districts(){
    	return $this->hasMany('App\District');
    }

}
