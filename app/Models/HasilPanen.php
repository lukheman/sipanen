<?php

namespace App\Models;

use App\Enums\StatusValidasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'hasil_panen';

    protected $primaryKey = 'id_hasil_panen';

    protected $guarded = [];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function tanaman(): BelongsTo
    {
        return $this->belongsTo(Tanaman::class, 'id_tanaman', 'id_tanaman');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'id_hasil_panen', 'id_hasil_panen');
    }

    public static function booted()
    {
        static::created(function ($hasilPanen) {

            // Buat Laporan
            $hasilPanen = $hasilPanen->laporan()->create([
                'id_petugas' => getActiveUserId() ?? 1,
            ]);

            $laporan = Laporan::query()->with('validasi')->find($hasilPanen->id_hasil_panen);

            $laporan->validasi()->create([
                'status_validasi' => StatusValidasi::BELUM
            ]);
        });
    }
}
