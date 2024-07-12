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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('nama_lengkap');
            $table->string('npm')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('angkatan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'ukm', 'mahasiswa']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
