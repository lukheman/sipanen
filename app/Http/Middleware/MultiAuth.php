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
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::shouldUse($guard); // pakai guard yg sedang login

                return $next($request);
            }
        }

        return redirect()->route('login'); // jika semua gagal

        // Jika role tidak sesuai, arahkan ke halaman tidak diizinkan
        return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
