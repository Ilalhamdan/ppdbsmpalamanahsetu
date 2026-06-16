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

        // Mengirimkan event Registered untuk memicu verifikasi email otomatis
        event(new Registered($user));

        // Mengautentikasi user secara otomatis
        Auth::login($user);

        // Mengarahkan ke dashboard (di mana middleware 'verified' akan memicu halaman verifikasi email jika belum diverifikasi)
        return redirect()->route('dashboard');
    }
}