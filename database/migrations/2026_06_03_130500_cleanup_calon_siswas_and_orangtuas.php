<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus kolom lama yang tidak terpakai dari tabel calon_siswas
        Schema::table('calon_siswas', function (Blueprint $table) {
            // Hapus kolom 'alamat' yang sudah digantikan oleh alamat_jalan, alamat_desa, dll
            if (Schema::hasColumn('calon_siswas', 'alamat')) {
                $table->dropColumn('alamat');
            }
            // Buat kolom-kolom yang sudah ada menjadi nullable agar tidak error
            $table->string('nik', 16)->nullable()->change();
            $table->string('nisn', 10)->nullable()->change();
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->change();
            $table->string('asal_sekolah')->nullable()->change();
        });

        // Ubah kolom wajib di data_orangtuas menjadi nullable
        Schema::table('data_orangtuas', function (Blueprint $table) {
            $table->string('nama_ayah')->nullable()->change();
            $table->string('pekerjaan_ayah')->nullable()->change();
            $table->string('penghasilan_ayah')->nullable()->default('Tidak Ada')->change();
            $table->string('nama_ibu')->nullable()->change();
            $table->string('pekerjaan_ibu')->nullable()->change();
            $table->string('penghasilan_ibu')->nullable()->default('Tidak Ada')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->text('alamat')->nullable();
        });

        Schema::table('data_orangtuas', function (Blueprint $table) {
            $table->string('nama_ayah')->nullable(false)->change();
            $table->string('pekerjaan_ayah')->nullable(false)->change();
            $table->string('nama_ibu')->nullable(false)->change();
            $table->string('pekerjaan_ibu')->nullable(false)->change();
        });
    }
};
