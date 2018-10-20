<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
      'first_name', 
      'last_name', 
      'phone_number',
      'device_sn', 
      'device_imei', 
      'status',
      'description',
      'type',
      'facility_id',
    ];

    public function facility(){
      return $this->belongsTo('App\Facility');
    }

}
