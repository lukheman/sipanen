<?php

namespace App\Models;

use App\Enums\StatusValidasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Validasi extends Model
{
    protected $table = 'validasi';
    protected $primaryKey = 'id_validasi';
    protected $guarded = [];

    public function casts(): array {
        return [
            'status_validasi' => StatusValidasi::class
        ];
    }

    public function hasilPanen(): BelongsTo {
        return $this->belongsTo(HasilPanen::class, 'id_hasil_panen', 'id_hasil_panen');
    }

    public function laporan(): HasOne {
        return $this->hasOne(Laporan::class, 'id_laporan', 'id_laporan');
    }

}
