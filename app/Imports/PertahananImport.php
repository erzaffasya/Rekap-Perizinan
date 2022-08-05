<?php

namespace App\Imports;

use App\Models\NSeksi;
use App\Models\SektorPertahanan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class PertahananImport implements ToModel, WithHeadingRow, SkipsEmptyRows
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
        return new SektorPertahanan([
            'no_surat' => $row['no_surat'],
            'alamat' => $row['alamat'],
            'nama_pemohon' => $row['nama_pemohon'],
            'kecamatan' => $row['kecamatan'],
            'tanggal' => $this->convert($row['tanggal']),
            'tujuan_opd' => $row['tujuan_opd'],
            'keterangan' => $row['keterangan'],            
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