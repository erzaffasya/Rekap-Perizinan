<?php

namespace App\Imports;

use App\Models\IMTN;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class IMTNImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{

    use Importable;

    public function convert($date)
    {
        $tanggal = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date));
        return $tanggal;
    }

    public function model(array $row)
    {
        // dd($row);
        return new IMTN([
            'no_surat' => $row['no_surat'],
            'alamat' => $row['alamat'],
            'nama_pemohon' => $row['nama_pemohon'],
            'kecamatan' => $row['kecamatan'],
            'tanggal' => $this->convert($row['tanggal']),
            'tujuan_opd' => $row['tujuan_opd'],
            'keterangan' => $row['keterangan'],
        ]);
    }

    public function rules(): array
    {
        return [
            'no_surat' => [
                'required',
            ],
        ];
    }
}
