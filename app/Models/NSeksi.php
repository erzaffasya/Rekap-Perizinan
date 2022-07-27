<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NSeksi extends Model
{
    use HasFactory;
    protected $table = 'tb_seksi';
    protected $fillable = [
        'nama_seksi','deskripsi','sektor_id'
    ];

   
    protected $primaryKey = 'id';

    public function sektor()
    {
        return $this->belongsTo(NSektor::class, 'sektor_id', 'id');
    }
}
