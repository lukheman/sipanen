<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    protected $primaryKey = 'id_admin';

    protected $guarded = [];

    public function getRoleAttribute()
    {
        return Role::ADMIN;
    }
}
