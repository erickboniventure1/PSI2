<?php

namespace App\Imports;

use App\Staff;
use Maatwebsite\Excel\Concerns\ToModel;

class StaffImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Staff([
      'first_name'=> row[0], 
      'last_name'=>row[1], 
      'phone_number'=>row[2],
      'device_sn'=>row[3], 
      'device_imei'=>row[4], 
      'status'=>row[5],
      'description'=>row[6],
      'type'=>row[7],
      'facility_id'=>$request->get('facility_id'),
        ]);
    }
}
