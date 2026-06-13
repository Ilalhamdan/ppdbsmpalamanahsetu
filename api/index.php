<?php
// Membuat folder penyimpanan sementara di Vercel jika belum ada
if (isset($_SERVER['VERCEL_URL'])) {
    $storageFolders = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs'
    ];
    foreach ($storageFolders as $folder) {
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
    }
}
require __DIR__ . '/../public/index.php';
