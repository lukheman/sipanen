<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = 'petugas';
    protected $guarded = [];

    protected $primaryKey = 'id_petugas';

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_petugas');
    }

}
