<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terbit extends Model
{
    use HasFactory;
    protected $table = 'terbit';
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
