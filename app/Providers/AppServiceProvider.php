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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                \Illuminate\Support\Facades\View::composer('*', function ($view) {
                    $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
                    $view->with('sys_settings', $settings);
                });
            }
        } catch (\Exception $e) {
            // Abaikan jika tabel settings belum ada saat migrasi
        }
    }
}
