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
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->integer('tinggi_badan')->nullable();
            $table->string('gol_darah')->nullable();
            $table->string('agama')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->integer('saudara_laki')->nullable();
            $table->integer('saudara_perempuan')->nullable();
            $table->integer('saudara_menikah')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->string('alamat_rt_rw')->nullable();
            $table->string('alamat_desa')->nullable();
            $table->string('alamat_kecamatan')->nullable();
            $table->string('alamat_kabupaten')->nullable();
            $table->string('no_hp_siswa')->nullable();
            $table->string('alamat_sekolah')->nullable();
        });

        Schema::table('data_orangtuas', function (Blueprint $table) {
            $table->string('status_ayah')->nullable();
            $table->string('status_ibu')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('alamat_ortu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('no_hp_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->dropColumn([
                'tinggi_badan', 'gol_darah', 'agama', 'anak_ke', 'jumlah_saudara', 
                'saudara_laki', 'saudara_perempuan', 'saudara_menikah', 'alamat_jalan', 
                'alamat_rt_rw', 'alamat_desa', 'alamat_kecamatan', 'alamat_kabupaten', 
                'no_hp_siswa', 'alamat_sekolah'
            ]);
        });

        Schema::table('data_orangtuas', function (Blueprint $table) {
            $table->dropColumn([
                'status_ayah', 'status_ibu', 'pendidikan_ayah', 'pendidikan_ibu', 
                'alamat_ortu', 'nama_wali', 'alamat_wali', 'no_hp_wali', 'pekerjaan_wali'
            ]);
        });
    }
};
