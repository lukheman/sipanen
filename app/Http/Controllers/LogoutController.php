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
        // Logout user
        Auth::logout();

        // Hapus semua data session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Tambahkan notifikasi jika kamu punya helper flash()
        if (function_exists('flash')) {
            flash('Berhasil logout dari aplikasi');
        }

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
