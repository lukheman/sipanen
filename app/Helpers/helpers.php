<?php

use App\Enums\Role;
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
            $user->role = Role::ADMIN;
        } else if($guard === 'petugas') {
            $user->role = Role::PETUGAS;
        } else if ($guard === 'kepala_dinas') {
            $user->role = Role::KEPALADINAS;
        }

        return $user;
    }
}

if (! function_exists('getActiveUserId')) {
    function getActiveUserId()
    {

        $user = getActiveUser();

        if($user->role === Role::ADMIN) {
            return $user->id_admin;
        } else if($user->role === Role::PETUGAS) {
            return $user->id_petugas;
        } else if($user->role === Role::KEPALADINAS) {
            return $user->id_kepala_dinas;
        }

    }
}

if (! function_exists('getActiveUserName')) {
    function getActiveUserName()
    {

        $user = getActiveUser();

        if($user->role === Role::ADMIN) {
            return $user->nama_admin;
        } else if($user->role === Role::PETUGAS) {
            return $user->nama_petugas;
        } else if($user->role === Role::KEPALADINAS) {
            return $user->nama_kepala_dinas;
        }

    }
}


if (! function_exists('activeRole')) {
    function activeRole()
    {
        return match (getActiveGuard()) {
            'admin'        => 'Admin',
            'petugas'      => 'Petugas',
            'kepala_dinas' => 'Kepala Dinas',
            default        => null,
        };
    }
}
