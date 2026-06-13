<?php

// 1. Trik Utama: Paksa Laravel merespons dengan JSON murni!
// Ini akan menghentikan Laravel mencari komponen "view" saat terjadi error.
$_SERVER['HTTP_ACCEPT'] = 'application/json';

// 2. Pastikan error level server juga nyala
ini_set('display_errors', '1');
error_reporting(E_ALL);

// 3. Eksekusi aplikasi
require __DIR__ . '/../public/index.php';
