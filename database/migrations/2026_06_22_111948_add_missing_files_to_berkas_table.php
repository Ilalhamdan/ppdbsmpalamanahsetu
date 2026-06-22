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
        Schema::table('berkas', function (Blueprint $table) {
            if (!Schema::hasColumn('berkas', 'file_pas_foto')) {
                $table->string('file_pas_foto')->nullable();
            }
            if (!Schema::hasColumn('berkas', 'file_sertifikat_prestasi')) {
                $table->string('file_sertifikat_prestasi')->nullable();
            }
            if (!Schema::hasColumn('berkas', 'file_surat_hafalan')) {
                $table->string('file_surat_hafalan')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            $colsToDrop = [];
            if (Schema::hasColumn('berkas', 'file_pas_foto')) {
                $colsToDrop[] = 'file_pas_foto';
            }
            if (Schema::hasColumn('berkas', 'file_sertifikat_prestasi')) {
                $colsToDrop[] = 'file_sertifikat_prestasi';
            }
            if (Schema::hasColumn('berkas', 'file_surat_hafalan')) {
                $colsToDrop[] = 'file_surat_hafalan';
            }
            if (!empty($colsToDrop)) {
                $table->dropColumn($colsToDrop);
            }
        });
    }
};
