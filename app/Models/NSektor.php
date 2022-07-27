<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NSektor extends Model
{
    use HasFactory;
    protected $table = 'tb_sektor';
    protected $fillable = [
        'nama_sektor','deskripsi'
    ];

   
    protected $primaryKey = 'id';
}
