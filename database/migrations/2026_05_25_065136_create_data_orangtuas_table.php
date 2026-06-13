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
        Schema::create('data_orangtuas', function (Blueprint $table) {
            $table->id();
            
            // Relasi utama ke tabel calon_siswas (Menghubungkan data orang tua ke siswa terkait)
            $table->foreignId('calon_siswa_id')->constrained('calon_siswas')->onDelete('cascade');
            
            // DATA AYAH KANDUNG
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('penghasilan_ayah');
            $table->string('no_hp_ayah', 15)->nullable();

            // DATA IBU KANDUNG
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_ibu');
            $table->string('no_hp_ibu', 15)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_orangtuas');
    }
};