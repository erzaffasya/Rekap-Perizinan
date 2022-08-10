<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SektorPerdagangan extends Model
{
    use HasFactory;
    protected $table = 'tb_data_perdagangan';
    protected $guarded = [];


    protected $primaryKey = 'id';

    public function seksi()
    {
        return $this->belongsTo(NSeksi::class, 'seksi_id', 'id');
    }
}
