<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tanaman extends Model
{
    use HasFactory;
    protected $table = 'tanaman';
    protected $guarded = [];
    protected $primaryKey = 'id_tanaman';

    public function hasilPanen(): HasMany {
        return $this->hasMany(HasilPanen::class, 'id_tanaman', 'id_tanaman');
    }
}
