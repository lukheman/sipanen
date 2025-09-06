<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{

    use HasFactory;

    protected $table = 'petugas';

    protected $primaryKey = 'id_petugas';

    protected $guarded = [];

    public function getRoleAttribute()
    {
        return Role::PETUGAS;
    }

    public function getIdAttribute()
    {
        return $this->id_petugas;
    }

    public function kecamatan(): BelongsTo {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');

    }

}
