<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data_khusus' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataOrangtua()
    {
        return $this->hasOne(DataOrangtua::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
}
