<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Tambahan 1: Panggil facade URL

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- Tambahan 2: Paksa HTTPS jika bukan di mode local ---
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
        // --------------------------------------------------------

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
                \Illuminate\Support\Facades\View::share('sys_settings', $settings);
            }
        } catch (\Exception $e) {
            // Abaikan jika tabel settings belum ada saat migrasi
        }
    }
}