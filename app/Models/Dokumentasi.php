<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table    = 'dokumentasi';
    protected $fillable = [
        'id',
        'file',
        'ukm_id'
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }
}
