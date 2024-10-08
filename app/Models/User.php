<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'nama_lengkap',
        'npm',
        'jenis_kelamin',
        'whatsapp',
        'angkatan',
        'alamat',
        'password',
        'role',
        'ukm_id',
        'prodi_id',
        'jurusan_id',
        'status',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }

    public function ukmUser(){
        return $this->belongsTo(UkmUser::class, 'id', 'user_id');
    }

    public function prodi(){
        return $this->belongsTo(Prodi::class, "prodi_id");
    }

    public function getjurusan(){
        return $this->belongsTo(Jurusan::class, "jurusan_id");
    }
}
