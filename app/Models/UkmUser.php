<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkmUser extends Model
{
    use HasFactory;

    protected $table    = 'ukm_user';
    protected $fillable = [
        'id',
        'user_id',
        'ukm_id'
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
}
