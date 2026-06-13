<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $table = 'home_sliders';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'link_url',
        'urutan',
        'aktif',
        'created_by',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function aktif()
    {
        return static::where('aktif', true)->orderBy('urutan')->orderBy('created_at', 'desc')->get();
    }
}
