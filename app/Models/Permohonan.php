<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;
    protected $table = 'Permohonan';
    protected $fillable = [
        'perizinan_id',
        'jumlah',
        'tanggal',
    ];

    protected $casts = [ 
        'perizinan_id' => 'integer', 
        'jumlah' => 'integer',
        'tanggal' => 'date'];

    protected $primaryKey = 'id';


    public function Perizinan()
    {
        return $this->belongsTo(Perizinan::class, 'perizinan_id', 'id');
    }

}
