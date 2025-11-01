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

        $user = Auth::user();

        return $user;

    }
}

// active role

if (! function_exists('activeRole')) {
    function activeRole()
    {
        $user = getActiveUser();

        return $user ? $user->role : null;
    }
}
