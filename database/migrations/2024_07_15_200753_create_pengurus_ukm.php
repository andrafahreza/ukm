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
        Schema::create('pengurus_ukm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ukm_id');
            $table->string('ketua_umum')->nullable();
            $table->string('wakil_ketua_umum')->nullable();
            $table->string('sekretaris')->nullable();
            $table->string('wakil_sekretaris')->nullable();
            $table->string('bendahara')->nullable();
            $table->string('wakil_bendahara')->nullable();
            $table->timestamps();

            $table->foreign("ukm_id")->references("id")->on("ukm")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus_ukm');
    }
};
