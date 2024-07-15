<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusUkm extends Model
{
    use HasFactory;

    protected $table    = 'pengurus_ukm';
    protected $fillable = [
        'id',
        'ukm_id',
        'ketua_umum',
        'wakil_ketua_umum',
        'sekretaris',
        'wakil_sekretaris',
        'bendahara',
        'wakil_bendahara',
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }
}
