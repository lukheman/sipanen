<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEmailAllUsers implements Rule
{
    public function passes($attribute, $value)
    {
        $tables = ['admin', 'petugas', 'kepala_dinas'];

        foreach ($tables as $table) {
            if (DB::table($table)->where('email', $value)->exists()) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Email sudah tidak tersedian';
    }
}
