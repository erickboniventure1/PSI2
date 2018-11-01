<?php

namespace App\Imports;

use App\Facility;
use Maatwebsite\Excel\Concerns\ToModel;

class FacilitiesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Facility([
            //
        ]);
    }
}
