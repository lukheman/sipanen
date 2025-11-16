<?php

use App\Enums\StatusValidasi;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_hasil_panen')->constrained('hasil_panen', 'id_hasil_panen')->cascadeOnDelete();
            $table->enum('status_validasi', StatusValidasi::values())->default(StatusValidasi::BELUM->value);
            $table->foreignId('id_petugas')->constrained('petugas', 'id_petugas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
