<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terbit extends Model
{
    use HasFactory;
    protected $table = 'Terbit';
    protected $guarded  = [];

    protected $casts = [ 
        'perizinan_id' => 'integer', ];

    protected $primaryKey = 'id';


    public function Perizinan()
    {
        return $this->belongsTo(Perizinan::class, 'perizinan_id', 'id');
    }

}
