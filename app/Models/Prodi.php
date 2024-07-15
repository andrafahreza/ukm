<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table    = 'prodi';
    protected $fillable = [
        'id',
        'nama_prodi'
    ];

    public function jurusan(){
        return $this->hasMany(Jurusan::class, "prodi_id", "id");
    }
}
