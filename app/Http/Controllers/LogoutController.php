<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // contoh di controller logout
        if (auth('petugas')->check()) {
            auth('petugas')->logout();
        } elseif (auth('admin')->check()) {
            auth('admin')->logout();
        } elseif (auth('kepala_dinas')->check()) {
            auth('kepala_dinas')->logout();
        }

        // clear session
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        flash('Berhasil logout dari aplikasi');

        return to_route('login');
    }
}
