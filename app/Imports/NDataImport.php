<?php

namespace App\Imports;

use App\Models\NData;
use Maatwebsite\Excel\Concerns\ToModel;

class NDataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NData([
            //
        ]);
    }
}
