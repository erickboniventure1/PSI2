<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
    	'user_id', 
    	'district_id', 
    	'region_id', 
    	'name', 
    	'description',
    	'status',
    ];
    public function district(){
    	return $this->belongsTo('App\District');

    }
    
    public function region(){
    	return $this->belongsTo('App\Region');
    }
    
    public function user(){
    	return $this->belongsTo('App\User');
    }
    
    public function staff(){
    	return $this->hasMany('App\Staff');
    }
    
}
