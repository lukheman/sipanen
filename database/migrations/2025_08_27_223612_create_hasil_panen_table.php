<?php

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
        Schema::create('hasil_panen', function (Blueprint $table) {
            $table->id('id_hasil_panen');
            $table->string('jumlah');
            $table->foreignId('id_tanaman')->constrained('tanaman', 'id_tanaman')->cascadeOnDelete();
            $table->foreignId('id_kecamatan')->constrained('kecamatan', 'id_kecamatan')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_panen');
    }
};
