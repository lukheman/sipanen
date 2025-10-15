<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'hasil_panen';

    protected $primaryKey = 'id_hasil_panen';

    protected $guarded = [];

    public function tanaman(): HasOne {
        return $this->hasOne(Tanaman::class, 'id_tanaman', 'id_tanaman');
    }

}
