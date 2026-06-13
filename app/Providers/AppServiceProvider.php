<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Kosong
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // KITA MATIKAN SEMENTARA LOGIKA VIEW COMPOSER-NYA
        // Karena pemanggilan View di sini bentrok dengan siklus booting Vercel.
    }
}
