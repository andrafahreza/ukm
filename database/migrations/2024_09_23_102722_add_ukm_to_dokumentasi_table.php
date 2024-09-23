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
        Schema::table('dokumentasi', function (Blueprint $table) {
            $table->unsignedBigInteger('ukm_id')->nullable();

            $table->foreign("ukm_id")->references("id")->on("ukm");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumentasi', function (Blueprint $table) {
            //
        });
    }
};
