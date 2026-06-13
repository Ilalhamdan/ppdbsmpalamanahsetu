<?php

// 1. Paksa PHP menampilkan semua error
ini_set('display_errors', '1');
error_reporting(E_ALL);

// 2. Siapkan folder views darurat di /tmp agar sistem tidak panik
$tmpViews = '/tmp/storage/framework/views';
if (!is_dir($tmpViews)) {
    mkdir($tmpViews, 0755, true);
}
$_ENV['VIEW_COMPILED_PATH'] = $tmpViews;
putenv('VIEW_COMPILED_PATH=' . $tmpViews);

// 3. Jalankan aplikasi dan tangkap paksa error aslinya
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<div style='font-family: sans-serif; padding: 20px; background: #fff3f3; border: 1px solid #ffcaca; border-radius: 8px;'>";
    echo "<h2 style='color: #d93025;'>🚨 AKAR MASALAH DITEMUKAN:</h2>";
    
    // Gali terus sampai menemukan penyebab pertama
    $rootCause = $e;
    while ($rootCause->getPrevious()) {
        $rootCause = $rootCause->getPrevious();
    }
    
    echo "<h3 style='color: #333;'>Pesan Error: <span style='color: #d93025;'>" . $rootCause->getMessage() . "</span></h3>";
    echo "<p><strong>File Lokasi:</strong> " . $rootCause->getFile() . "</p>";
    echo "<p><strong>Baris Kode:</strong> " . $rootCause->getLine() . "</p>";
    echo "</div>";
}
