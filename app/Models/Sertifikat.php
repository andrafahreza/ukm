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
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }
}
