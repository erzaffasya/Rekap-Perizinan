<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IMTN extends Model
{
    use HasFactory;
    protected $table = 'imtn';
    protected $fillable = [
        'no_surat','alamat','nama_pemohon','kecamatan','tanggal','tujuan_opd','keterangan'
    ];

   
    protected $primaryKey = 'id';
}
