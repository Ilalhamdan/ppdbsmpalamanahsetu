<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed database dengan akun admin permanen.
     * Jalankan dengan: php artisan db:seed
     */
    public function run(): void
    {
        // Akun Admin Permanen - hanya dibuat lewat seeder, TIDAK bisa dibuat via registrasi
        User::updateOrCreate(
            ['email' => 'hamdanqodu@gmail.com'], // Cek berdasarkan email (tidak duplikat jika dijalankan ulang)
            [
                'name'              => 'Admin PPDB',
                'email'             => 'hamdanqodu@gmail.com',
                'password'          => Hash::make('admin@ppdb'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->call(SettingSeeder::class);

        $this->command->info('✅ Akun admin berhasil dibuat!');
        $this->command->info('   Email    : hamdanqodu@gmail.com');
        $this->command->info('   Password : admin@ppdb');
        $this->command->warn('   ⚠️  Segera ganti password setelah login pertama!');
    }
}
