<?php

namespace App\Imports;

use App\Models\Permohonan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PermohonanImport implements WithHeadingRow, ToModel
{
    // public function tanggalan()
    // {
    //     if
    // }
    
    public function model(array $row)
    {
        return new Permohonan([
            // 'perizinan_id'  => $row['Nama Izin / Non Izin Usaha'],
            'jumlah' => $this->jumlah($row['januari']),
            // 'tanggal' => $row['email'],
        ]);
    }
    public function headingRow(): int
    {
        return 3;
    }
    public function jumlah($data)
    {
        if($data == '-'){
            return 0;
        }else{
            return $data;
        }
    }
}
