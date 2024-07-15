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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('jurusan_id')->nullable()->after('ukm_id');
            $table->unsignedBigInteger('prodi_id')->nullable()->after('ukm_id');

            $table->foreign("jurusan_id")->references("id")->on("jurusan")->onDelete('set null');
            $table->foreign("prodi_id")->references("id")->on("prodi")->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
