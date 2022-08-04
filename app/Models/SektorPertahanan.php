<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SektorPertahanan extends Model
{
    use HasFactory;
    protected $table = 'tb_data_pertahanan';
    protected $fillable = [
        'no_surat','alamat','nama_pemohon','kecamatan','tanggal','tujuan_opd','keterangan','seksi_id'
    ];

   
    protected $primaryKey = 'id';
}
