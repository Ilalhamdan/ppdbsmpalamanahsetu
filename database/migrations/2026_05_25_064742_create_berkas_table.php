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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel pendaftarans (Menghubungkan berkas dengan data pendaftaran)
            $table->foreignId('pendaftaran_id')->constrained('pendaftarans')->onDelete('cascade');
            
            // Kolom untuk menyimpan nama file dokumen (nullable jika siswa belum upload saat daftar)
            $table->string('file_kartu_keluarga')->nullable();
            $table->string('file_akta_kelahiran')->nullable();
            $table->string('file_ijazah_rapor')->nullable();
            
            // Status verifikasi dokumen oleh panitia admin PPDB
            $table->enum('status_verifikasi', ['Belum Diperiksa', 'Valid', 'Tidak Valid'])->default('Belum Diperiksa');
            $table->text('catatan_admin')->nullable(); // Alasan jika berkas ditolak/tidak valid
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};