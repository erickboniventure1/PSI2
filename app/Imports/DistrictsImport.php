<?php

namespace App\Imports;

use App\District;
use Maatwebsite\Excel\Concerns\ToModel;

class DistrictsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new District([
            //
        ]);
    }
}
