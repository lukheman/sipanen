<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $guarded = [];

    public function petugas(): BelongsTo {

        return $this->belongsTo(User::class, 'id_petugas');

    }

    public function hasilPanen() {
        return $this->belongsTo(HasilPanen::class, 'id_hasil_panen', 'id_hasil_panen');
    }

}
