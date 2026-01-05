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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("inventory_id");
            $table->unsignedBigInteger("user_id");
            $table->integer("quantity");
            $table->integer("quantity_before");
            $table->integer("quantity_after");
            $table->enum("movement_type", ["peminjaman", "pengembalian", "restock"]);
            $table->text("comment")->nullable();
            $table->timestamps();

            $table->foreign("inventory_id")->references("id")->on("inventories")->onDelete("CASCADE")->onUpdate("CASCADE");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("CASCADE")->onUpdate("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
