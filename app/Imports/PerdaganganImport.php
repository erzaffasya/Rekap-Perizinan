<?php

namespace App\Imports;

use App\Models\NSeksi;
use App\Models\SektorPerdagangan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class PerdaganganImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{

    use Importable;

    public function convert($date)
    {
        $tanggal = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
        return $tanggal;
    }

    public function seksi($seksi)
    {
        $dataSeksi = null;
        $dataSeksi = NSeksi::where('nama_seksi', $seksi)->first();
        return $dataSeksi->id;
        // dd($dataSeksi->id);
    }

    public function model(array $row)
    {
        // dd($row);
        return new SektorPerdagangan([
            'nama' => $row['nama'],
            'alamat_kantor' => $row['alamat_kantor'],
            'lokasi_usaha' => $row['lokasi_usaha'],
            'nib' => $row['nib'],            
            'status_penanaman_modal' => $row['status_penanaman_modal'],    
            'kbli' => $row['kbli'],            
            'tanggal' => $this->convert($row['tanggal']),        
            'tujuan_opd' => $row['tujuan_opd'],   
            'seksi_id' => $this->seksi($row['seksi']),
        ]);
    }

    public function rules(): array
    {
        return [
            'seksi_id' => [
                'required',
            ],
        ];
    }
}
