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
        Schema::create('peminjaman_alat_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id');
            $table->unsignedBigInteger('alat_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('peminjaman_id')->references('id')->on('peminjaman_alat_headers')->onDelete('cascade');
            $table->foreign('alat_id')->references('id')->on('inventories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_alat_details');
    }
};
