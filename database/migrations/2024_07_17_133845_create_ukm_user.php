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
        Schema::create('ukm_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ukm_id');
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("ukm_id")->references("id")->on("ukm")->onDelete('cascade');
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('alasan_tolak')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukm_user');
    }
};
