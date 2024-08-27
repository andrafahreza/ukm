<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaUkm extends Model
{
    use HasFactory;

    protected $table    = 'agenda_ukm';
    protected $fillable = [
        'id',
        'ukm_id',
        'status',
        'alasan_tolak',
        'judul',
        'isi'
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }
}