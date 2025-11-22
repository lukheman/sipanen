<?php

namespace App\Models;

use App\Enums\StatusValidasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $guarded = [];

    public function petugas(): BelongsTo
    {

        return $this->belongsTo(Petugas::class, 'id_petugas');

    }

    public function validasi()
    {
        return $this->hasOne(Validasi::class, 'id_laporan', 'id_laporan');
    }

    public function hasilPanen()
    {
        return $this->belongsTo(HasilPanen::class, 'id_hasil_panen', 'id_hasil_panen');
    }

    public function getStatusValidasiAttribute() {

        return $this->validasi->status_validasi;

    }
}
