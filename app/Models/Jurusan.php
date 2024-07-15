<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table    = 'jurusan';
    protected $fillable = [
        'id',
        'prodi_id',
        'nama_jurusan'
    ];

    public function prodi(){
        return $this->belongsTo(Prodi::class, "prodi_id");
    }
}
