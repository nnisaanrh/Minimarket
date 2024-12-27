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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID column
            $table->unsignedBigInteger('cabang_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['in', 'out']);
            $table->integer('quantity');
            $table->timestamp('movement_date')->useCurrent();
            $table->timestamps(0); // created_at and updated_at

            // Foreign keys
            $table->foreign('cabang_id')->references('id')->on('cabangs')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
