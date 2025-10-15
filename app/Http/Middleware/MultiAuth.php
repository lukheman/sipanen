<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MultiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Jika user memiliki role (asumsi kolom 'role' ada di tabel users)
        // dan termasuk dalam daftar role yang diizinkan
        if (in_array($user->role->value, $roles)) {
            return $next($request);
        }

        // Jika role tidak sesuai, arahkan ke halaman tidak diizinkan
        return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
