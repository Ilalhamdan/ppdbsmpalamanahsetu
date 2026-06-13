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
        Schema::create('calon_siswas', function (Blueprint $table) {
            $table->id();
            
            // Relasi utama ke tabel users (Menghubungkan ke data login akun)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Kolom spesifikasi data diri sesuai sketsa & ERD
            $table->string('nik', 16)->unique();
            $table->string('nisn', 10)->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('asal_sekolah');
            $table->string('kebutuhan_khusus')->default('Tidak Ada');
            $table->json('data_khusus')->nullable(); // Kolom tambahan untuk data langkah 3 (Prestasi/Tahfidz)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_siswas');
    }
};