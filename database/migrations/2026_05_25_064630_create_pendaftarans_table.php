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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel calon_siswas (Menghubungkan pendaftaran dengan biodata siswa)
            $table->foreignId('calon_siswa_id')->constrained('calon_siswas')->onDelete('cascade');
            
            // Kolom spesifikasi data pendaftaran sesuai ERD & Tampilan Dashboard
            $table->string('no_pendaftaran')->unique(); // Contoh: REG-2026001
            $table->string('gelombang'); // Contoh: Gelombang 1, Gelombang 2
            $table->string('jurusan_pilihan'); // Contoh: Akademik Terpadu, Tahfidz
            $table->string('latar_belakang'); // Contoh: SD / MI
            $table->enum('status_pendaftaran', ['Proses', 'Selesai', 'Ditolak'])->default('Proses');
            $table->date('tanggal_daftar');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};