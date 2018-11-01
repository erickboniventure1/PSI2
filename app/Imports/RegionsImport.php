<?php

namespace App\Imports;

use App\Region;
use Maatwebsite\Excel\Concerns\ToModel;

class RegionsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new Region([
           'name'     => $row[1], 
        ]);
    }
}