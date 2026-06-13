<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Role selalu di-set 'siswa' di sisi server.
        // Calon siswa TIDAK bisa memilih atau memanipulasi role via request.
        $user = User::create([
            'name'     => $request->username,
            'email'    => $request->email,
            'role'     => 'siswa',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Hapus Auth::login($user) agar tidak otomatis login
        // Arahkan kembali ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('status', 'Pendaftaran berhasil! Silakan cek kotak masuk email Anda (atau folder Spam) untuk mengklik link aktivasi sebelum Anda bisa login.');
    }
}