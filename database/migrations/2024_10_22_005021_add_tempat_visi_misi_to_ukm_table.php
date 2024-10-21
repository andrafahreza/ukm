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
        Schema::table('ukm', function (Blueprint $table) {
            $table->string('tempat')->nullable()->after('contact');
            $table->text('visi')->nullable()->after('contact');
            $table->text('misi')->nullable()->after('contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ukm', function (Blueprint $table) {
            $table->dropColumn('tempat');
            $table->dropColumn('visi');
            $table->dropColumn('misi');
        });
    }
};
