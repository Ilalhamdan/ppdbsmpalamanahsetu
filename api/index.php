<?php

// 1. Muat sistem autoload dari Composer
require __DIR__ . '/../vendor/autoload.php';

// 2. Ambil instance dasar aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. PAKSA Laravel menggunakan folder /tmp milik Vercel SEBELUM aplikasi dijalankan sepenuhnya
$app->useStoragePath('/tmp/storage');

// 4. Rakit folder-folder darurat secara otomatis di dalam /tmp
$storageFolders = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs'
];

foreach ($storageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }
}

// 5. Ambil alih Kernel HTTP dan jalankan request secara manual
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
