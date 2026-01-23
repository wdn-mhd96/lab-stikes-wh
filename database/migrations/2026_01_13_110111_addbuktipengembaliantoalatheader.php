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
            $table->text('bukti_pengembalian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('peminjaman_alat_headers', function (Blueprint $table) {
            $table->dropColumn('bukti_pengembalian');
        });
    }
};
