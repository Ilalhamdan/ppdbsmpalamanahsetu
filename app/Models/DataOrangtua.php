<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataOrangtua extends Model
{
    protected $guarded = [];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }
}
