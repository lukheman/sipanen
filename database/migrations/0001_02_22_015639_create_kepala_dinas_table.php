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
        Schema::create('kepala_dinas', function (Blueprint $table) {
            $table->id('id_kepala_dinas');
            $table->string('nama_kepala_dinas');
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('password123'));
            $table->string('telepon');
            $table->date('tanggal_lahir');
            $table->string('photo')->nullable();
            $table->string('alamat')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_dinas');
    }
};
