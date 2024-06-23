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
        Schema::create('barang_pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('barangs', 'id');
            $table->foreignId('id_pemesanan')->constrained('pemesanans', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_pemesanans');
    }
};
