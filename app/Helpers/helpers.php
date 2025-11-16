<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('getActiveGuard')) {
    function getActiveGuard()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        return null;
    }
}

if (! function_exists('getActiveUser')) {
    function getActiveUser()
    {

        $guard = getActiveGuard();

        $user = auth($guard)->user();

        if($guard === 'admin') {
            return $user->nama_admin;
        } else if( $guard === 'petugas') {
            return $user->nama_petugas;
        }else if( $guard === 'kepala_dinas') {
            return $user->nama_kepala_dinas;
        } else {
            return null;
        }


    }
}

// active role

// if (! function_exists('activeRole')) {
//     function activeRole()
//     {
//         $user = getActiveUser();
//
//         return $user ? $user->role : null;
//     }
// }
