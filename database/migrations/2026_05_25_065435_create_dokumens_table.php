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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            
            // Relasi utama ke tabel calon_siswas (Menghubungkan dokumen dengan siswa)
            $table->foreignId('calon_siswa_id')->constrained('calon_siswas')->onDelete('cascade');
            
            // Atribut dokumen pendukung / prestasi
            $table->string('nama_dokumen'); // Contoh: Sertifikat Juara 1 OSN Matematika, Kartu KIP
            $table->enum('jenis_dokumen', ['Prestasi', 'Beasiswa', 'Lainnya']);
            $table->string('file_path'); // Tempat menyimpan nama/path file dokumen di storage
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};