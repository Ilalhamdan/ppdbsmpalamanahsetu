<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Auth;

$user = User::factory()->create();
Auth::login($user);

$formData = [
    'inputNIK' => '1234567890123456', 
    'inputNISN' => '1234567890', 
    'inputNama' => 'Test Siswa', 
    'inputGender' => 'Laki-laki', 
    'inputTempatLahir' => 'Jakarta', 
    'inputTanggalLahir' => '2010-01-01', 
    'inputAgama' => 'Islam', 
    'inputTinggiBadan' => '150', 
    'inputAnakKe' => '1', 
    'inputJumlahSaudara' => '2', 
    'inputAlamatJalan' => 'Jl. Test', 
    'inputAlamatRTRW' => '01/01', 
    'inputAlamatDesa' => 'Desa Test', 
    'inputAlamatKecamatan' => 'Kec Test', 
    'inputAlamatKabupaten' => 'Kab Test', 
    'inputAsalSekolah' => 'SD Test', 
    'inputAlamatSekolah' => 'Jl SD', 
    'inputNamaAyah' => 'Ayah Test', 
    'inputPendidikanAyah' => 'S1', 
    'inputPekerjaanAyah' => 'PNS', 
    'inputNamaIbu' => 'Ibu Test', 
    'inputPendidikanIbu' => 'S1', 
    'inputPekerjaanIbu' => 'PNS', 
    'inputAlamatOrtu' => 'Jl Ortu', 
    'inputNoHpOrtu' => '08123'
];

$request = new Request([
    'formData' => $formData,
    'jalur' => 'Reguler',
    'noUrut' => 'REG-TEST-' . uniqid()
]);

$controller = new PendaftaranController();
$response = $controller->saveFormulir($request);

echo "Response Content: " . $response->getContent() . "\n";

$pendaftaran = Pendaftaran::where('calon_siswa_id', function($q) use ($user) {
    $q->select('id')->from('calon_siswas')->where('user_id', $user->id);
})->first();

echo "Tahun Ajaran tersimpan: " . ($pendaftaran->tahun_ajaran ?? 'NULL') . "\n";
