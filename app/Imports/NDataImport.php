<?php

namespace App\Imports;

use App\Models\NData;
use App\Models\NSeksi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class NDataImport implements ToModel, WithHeadingRow, SkipsEmptyRows
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
    }

    public function model(array $row)
    {
        return new NData([
            'nama_pemohon' => $row['nama_pemohon'],
            'alamat_pemohon' => $row['alamat_pemohon'],
            'tempat_kerja' => $row['tempat_kerja'],
            'nomor_str' => $row['nomor_str'],
            'izin_terbit' => $this->convert($row['izin_terbit']),
            'masa_berlaku_akhir' => $this->convert($row['masa_berlaku_akhir']),
            'praktik_ke' => $row['praktek_ke'],
            'alamat_praktik' => $row['alamat_praktik'],
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
