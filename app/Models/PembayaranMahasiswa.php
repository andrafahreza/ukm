<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranMahasiswa extends Model
{
    use HasFactory;

    protected $table    = 'pembayaran_mahasiswa';
    protected $fillable = [
        'id',
        'user_id',
        'ukm_id',
        'tujuan_pembayaran',
        'bukti',
        'tgl_bayar',
        'validasi',
        'keterangan'
    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function ukm(){
        return $this->belongsTo(Ukm::class, "ukm_id");
    }
}
