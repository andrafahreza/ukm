<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table    = 'berita';
    protected $fillable = [
        'id',
        'ukm_id',
        'status',
        'alasan_tolak',
        'judul',
        'isi',
        'foto'
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }
}
