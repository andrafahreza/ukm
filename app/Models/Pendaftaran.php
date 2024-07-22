<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table    = 'pendaftaran';
    protected $fillable = [
        'id',
        'ukm_id',
        'user_id',
        'alasan',
        'foto',
        'status',
        'alasan_tolak'
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
}
