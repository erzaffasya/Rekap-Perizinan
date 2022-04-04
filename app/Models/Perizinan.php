<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perizinan extends Model
{
    use HasFactory;
    protected $table = 'perizinan';
    protected $fillable = [
        'nama_izin',
    ];

   
    protected $primaryKey = 'id';


    public function Permohonan()
    {
        return $this->hasMany(Permohonan::class, 'permohonan_id', 'id');
    }

    public function Perizinan()
    {
        return $this->hasMany(Perizinan::class, 'perizinan_id', 'id');
    }
}
