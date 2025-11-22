<?php

namespace App\Models;

use App\Enums\StatusValidasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function laporan(): BelongsTo {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }

}
