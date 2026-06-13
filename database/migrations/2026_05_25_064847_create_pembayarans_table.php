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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel pendaftarans (Menghubungkan invoice dengan data pendaftaran siswa)
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade');
            
            // Kolom spesifikasi data transaksi keuangan sesuai ERD
            $table->string('kode_invoice')->unique(); // Contoh: INV-20260525-001
            $table->integer('jumlah_bayar'); // Menyimpan nominal biaya pendaftaran
            $table->string('bukti_transfer')->nullable(); // Menyimpan nama file gambar bukti bayar
            
            // Status verifikasi pembayaran oleh bendahara / admin
            $table->enum('status_pembayaran', ['Belum Bayar', 'Menunggu Verifikasi', 'Lunas'])->default('Belum Bayar');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};