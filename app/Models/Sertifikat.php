<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table    = 'sertifikat';
    protected $fillable = [
        'id',
        'ukm_id',
        'file',
        'user_id',
        'nama'
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
}
