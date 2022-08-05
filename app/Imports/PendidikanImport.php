<?php

namespace App\Imports;

use App\Models\Kesehatan;
use App\Models\NSeksi;
use App\Models\SektorPendidikan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class PendidikanImport implements ToModel, WithHeadingRow, SkipsEmptyRows
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
        return new SektorPendidikan([           
            'tanggal_terbit' => $this->convert($row['tanggal_terbit']),
            'nomor_izin' => $row['nomor_izin'],
            'nama_sekolah' => $row['nama_sekolah'],
            'NIB' => $row['nib'],
            'alamat' => $row['alamat'],
            'nama_yayasan' => $row['nama_yayasan'],
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
