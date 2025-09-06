<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $primaryKey = 'id_kecamatan';

    protected $guarded = [];

    public function desa()
    {
        return $this->hasMany(Desa::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function petugas(): HasOne
    {
        return $this->hasOne(Petugas::class, 'id_petugas', 'id_kecamatan');
    }
}
