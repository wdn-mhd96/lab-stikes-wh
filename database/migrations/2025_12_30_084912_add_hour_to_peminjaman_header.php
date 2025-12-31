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
        Schema::table('peminjaman_alat_headers', function (Blueprint $table) {
            $table->addColumn('time', 'jam_mulai');
            $table->addColumn('time', 'jam_selesai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman_alat_headers', function (Blueprint $table) {
            $table->dropColumn('jam_mulai');
            $table->dropColumn('jam_selesai');
        });
    }
};
