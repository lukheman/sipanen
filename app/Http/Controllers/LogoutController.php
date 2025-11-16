<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the logout request.
     */
    public function __invoke(Request $request)
    {
        // Daftar guard yang ingin dilogout
        $guards = ['web', 'admin', 'petugas', 'kepala_dinas'];

        foreach ($guards as $guard) {
            Auth::guard($guard)->logout();
        }

        // Hapus semua session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (function_exists('flash')) {
            flash('Berhasil logout dari semua akun');
        }

        return redirect()->route('login');
    }
}
