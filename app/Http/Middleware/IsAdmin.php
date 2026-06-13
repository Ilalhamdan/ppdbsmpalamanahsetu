<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Menangani request masuk.
     * Hanya mengizinkan user dengan role 'admin' untuk melanjutkan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            // Jika bukan admin, redirect ke dashboard siswa dengan pesan error
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk mengakses halaman tersebut.');
        }

        return $next($request);
    }
}
