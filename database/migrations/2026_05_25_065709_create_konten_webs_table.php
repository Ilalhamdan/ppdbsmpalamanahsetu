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
        Schema::create('konten_webs', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users untuk mencatat admin siapa yang memposting/membuat konten
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Atribut konten halaman utama / landing page sekolah
            $table->string('judul');
            $table->string('slug')->unique(); // Untuk link URL, contoh: pengumuman-ppdb-2026
            $table->enum('kategori', ['Berita', 'Galeri', 'Pengumuman', 'Fasilitas']);
            $table->text('isi_konten');
            $table->string('gambar_fitur')->nullable(); // Menyimpan nama file foto ilustrasi berita
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten_webs');
    }
};