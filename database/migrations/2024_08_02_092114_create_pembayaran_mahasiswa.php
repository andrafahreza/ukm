<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ukm_id');
            $table->string('tujuan_pembayaran');
            $table->string('bukti');
            $table->enum('validasi', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('keterangan')->nullable();
            $table->dateTime('tgl_bayar');
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("ukm_id")->references("id")->on("ukm")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_mahasiswa');
    }
};
