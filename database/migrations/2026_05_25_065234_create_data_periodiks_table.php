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
        Schema::create('data_periodiks', function (Blueprint $table) {
            $table->id();
            
            // Relasi utama ke tabel calon_siswas
            $table->foreignId('calon_siswa_id')->constrained('calon_siswas')->onDelete('cascade');
            
            // Atribut Fisik & Kondisi Kondisional Siswa sesuai spesifikasi data Dapodik/PPDB
            $table->integer('tinggi_badan'); // Menyimpan dalam satuan cm
            $table->integer('berat_badan');  // Menyimpan dalam satuan kg
            $table->integer('jarak_ke_sekolah'); // Jarak rumah dalam satuan km/meter
            $table->integer('waktu_tempuh'); // Waktu tempuh perjalanan dalam satuan menit
            $table->integer('jumlah_saudara_kandung')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_periodiks');
    }
};