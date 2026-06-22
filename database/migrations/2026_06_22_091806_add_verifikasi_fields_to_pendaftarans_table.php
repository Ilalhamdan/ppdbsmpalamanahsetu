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
        // 1. Tambah kolom verifikasi admin, nilai ujian & hasil seleksi ke pendaftarans
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->enum('status_formulir_admin', ['Menunggu', 'Disetujui', 'Ditolak', 'Belum Valid'])
                  ->default('Menunggu')->after('jurusan_pilihan');
            $table->text('catatan_formulir_admin')->nullable()->after('status_formulir_admin');
            $table->enum('status_berkas_admin', ['Menunggu', 'Disetujui', 'Ditolak', 'Belum Valid'])
                  ->default('Menunggu')->after('catatan_formulir_admin');
            $table->text('catatan_berkas_admin')->nullable()->after('status_berkas_admin');
            $table->decimal('nilai_ujian', 5, 2)->nullable()->after('catatan_berkas_admin');
            $table->string('hasil_seleksi')->nullable()->after('nilai_ujian'); // 'Lulus' | 'Tidak Lulus'
        });

        // 2. Tambah kolom tracking status formulir & berkas ke calon_siswas
        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->enum('status_formulir', ['Belum', 'Terkirim'])->default('Belum')->after('user_id');
            $table->enum('status_berkas', ['Belum', 'Terkirim'])->default('Belum')->after('status_formulir');
        });

        // 3. Tambah kolom file berkas tambahan ke tabel berkas
        Schema::table('berkas', function (Blueprint $table) {
            $table->string('file_pas_foto')->nullable()->after('file_ijazah_rapor');
            $table->string('file_sertifikat_prestasi')->nullable()->after('file_pas_foto');
            $table->string('file_surat_hafalan')->nullable()->after('file_sertifikat_prestasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn([
                'status_formulir_admin', 'catatan_formulir_admin',
                'status_berkas_admin', 'catatan_berkas_admin',
                'nilai_ujian', 'hasil_seleksi',
            ]);
        });

        Schema::table('calon_siswas', function (Blueprint $table) {
            $table->dropColumn(['status_formulir', 'status_berkas']);
        });

        Schema::table('berkas', function (Blueprint $table) {
            $table->dropColumn(['file_pas_foto', 'file_sertifikat_prestasi', 'file_surat_hafalan']);
        });
    }
};
