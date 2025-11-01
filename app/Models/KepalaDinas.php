<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KepalaDinas extends Authenticatable
{
    protected $table = 'kepala_dinas';

    protected $primaryKey = 'id_kepala_dinas';

    protected $guarded = [];

    public function getRoleAttribute()
    {
        return Role::KEPALADINAS;
    }
}
