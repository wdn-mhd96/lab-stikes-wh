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
        Schema::create('peminjaman_alat_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('status_id');
            $table->dateTime('tanggal_pinjam');
            $table->dateTime('tanggal_kembali')->nullable();
            $table->string('nim')->nullable();
            $table->string('nama_peminjam');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ruangan_id')->references('id')->on('ruangan')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('peminjaman_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_alat_headers');
    }
};
