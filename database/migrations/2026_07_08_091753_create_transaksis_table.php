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
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->string('nama_customer'); // Untuk Nama Costumer
        $table->string('alamat');        // Untuk Alamat
        $table->string('jenis_cat');     // Untuk Jenis Cat (CATYLAC, dll)
        $table->string('warna_cat');     // Untuk Warna Cat (Merah, Biru, Kuning)
        $table->integer('jumlah_beli');  // Untuk Jumlah Beli
        $table->integer('total_harga')->nullable(); // Opsional, untuk menyimpan hasil hitungan
        $table->timestamps(); // Otomatis membuat created_at dan updated_at
    });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
