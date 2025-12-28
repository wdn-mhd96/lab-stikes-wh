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
        Schema::create('history_perubahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('old_status_id')->nullable();
            $table->unsignedBigInteger('new_status_id')->nullable();
            $table->timestamps();

            $table->foreign('peminjaman_id')->references('id')->on('peminjaman_alat_headers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('old_status_id')->references('id')->on('peminjaman_statuses')->onDelete('set null');
            $table->foreign('new_status_id')->references('id')->on('peminjaman_statuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_perubahans');
    }
};
