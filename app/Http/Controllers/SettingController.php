<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        $settings = $request->except(['_token', '_method']);

        foreach ($settings as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}
