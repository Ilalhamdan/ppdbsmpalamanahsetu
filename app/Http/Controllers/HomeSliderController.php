<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    /** Ambil semua slider (admin) */
    public function index()
    {
        $sliders = HomeSlider::orderBy('urutan')->orderBy('created_at', 'desc')->get();
        return response()->json($sliders);
    }

    /** Simpan slider baru */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:255',
            'gambar'  => 'required|string', // base64
            'urutan'  => 'nullable|integer',
        ]);

        // Proses gambar base64
        $gambarPath = null;
        if ($request->gambar && str_starts_with($request->gambar, 'data:image')) {
            $gambarPath = $this->simpanBase64($request->gambar, 'home_sliders');
        }

        $slider = HomeSlider::create([
            'judul'      => $request->judul,
            'deskripsi'  => $request->deskripsi ?? null,
            'gambar'     => $gambarPath,
            'link_url'   => $request->link_url ?? null,
            'urutan'     => $request->urutan ?? 0,
            'aktif'      => $request->aktif ?? true,
            'created_by' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'data' => $slider]);
    }

    /** Update slider */
    public function update(Request $request, $id)
    {
        $slider = HomeSlider::findOrFail($id);

        $data = [
            'judul'    => $request->judul ?? $slider->judul,
            'deskripsi' => $request->deskripsi ?? $slider->deskripsi,
            'link_url' => $request->link_url ?? $slider->link_url,
            'urutan'   => $request->urutan ?? $slider->urutan,
            'aktif'    => $request->has('aktif') ? (bool)$request->aktif : $slider->aktif,
        ];

        // Ganti gambar jika ada yang baru
        if ($request->gambar && str_starts_with($request->gambar, 'data:image')) {
            // Hapus lama
            if ($slider->gambar && file_exists(public_path($slider->gambar))) {
                unlink(public_path($slider->gambar));
            }
            $data['gambar'] = $this->simpanBase64($request->gambar, 'home_sliders');
        }

        $slider->update($data);

        return response()->json(['success' => true, 'data' => $slider]);
    }

    /** Hapus slider */
    public function destroy($id)
    {
        $slider = HomeSlider::findOrFail($id);
        if ($slider->gambar && file_exists(public_path($slider->gambar))) {
            unlink(public_path($slider->gambar));
        }
        $slider->delete();
        return response()->json(['success' => true]);
    }

    /** Simpan base64 ke file */
    private function simpanBase64(string $base64, string $folder): string
    {
        [$meta, $data] = explode(',', $base64);
        preg_match('/data:image\/(\w+);base64/', $meta, $matches);
        $ext = $matches[1] ?? 'jpg';
        $filename = 'slider_' . time() . '_' . rand(100, 999) . '.' . $ext;
        $path = "uploads/{$folder}/{$filename}";
        $fullPath = public_path($path);
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }
        file_put_contents($fullPath, base64_decode($data));
        return $path;
    }
}
