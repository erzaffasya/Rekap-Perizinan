<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    use HasFactory;
    protected $table = 'helpdesk';
    protected $fillable = [
        'nama','no_hp','ttd','kategori_helpdesk_id','keterangan'
    ];

   
    protected $primaryKey = 'id';

    public function kategori()
    {
        return $this->belongsTo(KategoriHelpdesk::class, 'kategori_helpdesk_id', 'id');
    }
}
