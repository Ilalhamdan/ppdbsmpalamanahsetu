<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'tahun_ajaran', 'value' => '2026/2027'],
            ['key' => 'tahun_ajaran_tampil', 'value' => '2026 / 2027'],
            ['key' => 'ppdb_status', 'value' => 'Buka'],
            ['key' => 'gelombang_aktif', 'value' => 'Gelombang 1'],
            ['key' => 'pengumuman_header', 'value' => 'PPDB Online TA 2026/2027 Telah Dibuka'],
            ['key' => 'tahun_sekarang', 'value' => '2026'],
            ['key' => 'nama_sekolah', 'value' => 'SMP Al-Amanah'],
            ['key' => 'kuota_kursi', 'value' => 'Terbatas'],
            ['key' => 'gelombang1_waktu', 'value' => '13 Oktober 2025 - 28 Februari 2026'],
            ['key' => 'gelombang1_diskon', 'value' => '30%'],
            ['key' => 'gelombang2_waktu', 'value' => '02 Maret 2026 - 11 Juli 2026'],
            ['key' => 'gelombang2_diskon', 'value' => '20%'],
            ['key' => 'tanggal_ujian', 'value' => 'Sabtu, 6 Juni 2026'],
            ['key' => 'deskripsi_sekolah', 'value' => 'Lembaga pendidikan menengah yang berdedikasi tinggi mewujudkan siswa berprestasi akademis gemilang yang bertumpu pada pondasi akhlakul karimah dan wawasan global terintegrasi.'],
            ['key' => 'sosmed_facebook', 'value' => 'https://www.facebook.com/smpalamanahsetu'],
            ['key' => 'sosmed_instagram', 'value' => 'https://www.instagram.com/smpalamanahsetu'],
            ['key' => 'sosmed_youtube', 'value' => 'https://www.youtube.com/@smpalamanahsetu'],
            ['key' => 'sosmed_tiktok', 'value' => 'https://www.tiktok.com/@smpalamanahsetu'],
            ['key' => 'kontak_alamat', 'value' => 'Jl. Raya Al-Amanah No. 45, Al Bantani, Indonesia'],
            ['key' => 'kontak_email', 'value' => 'info@smp-alamanah.sch.id'],
            ['key' => 'kontak_telepon', 'value' => '0813-8993-0005'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
