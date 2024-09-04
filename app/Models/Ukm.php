<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    protected $table    = 'ukm';
    protected $fillable = [
        'id',
        'ukmNama',
        'ukmDeskripsi',
        'logo',
        'contact',
        'ketua'
    ];
}
