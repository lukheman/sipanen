<?php

use App\Enums\Role;
use App\Models\Admin;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\KepalaDinas;
use App\Models\User;
use App\Models\Petugas;
use App\Models\HasilPanen;
use App\Models\Tanaman;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // Data kecamatan
        $kecamatanList = [
            'Baula',
            'Iwoimendaa',
            'Kolaka',
            'Latambaga',
            'Polinggona',
            'Pomalaa',
            'Samaturu',
            'Tanggetada',
            'Toari',
            'Watubangga',
            'Wolo',
            'Wundulako',
        ];

        // Tambahkan ke database
        foreach ($kecamatanList as $namaKecamatan) {
            Kecamatan::query()->create([
                'nama' => $namaKecamatan,
            ]);
        }

        // Tanaman::factory(10)->create();
        // HasilPanen::factory(10)->create();

        // Buat user dengan id_desa secara acak
        User::query()->create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => Role::ADMIN
        ]);

        User::query()->create([
            'nama' => 'Petugas 1',
            'email' => 'petugas1@gmail.com',
            'role' => Role::PETUGAS
        ]);

        User::query()->create([
            'nama' => 'Petugas 2',
            'email' => 'petugas2@gmail.com',
            'role' => Role::PETUGAS
        ]);

        User::query()->create([
            'nama' => 'Kepala Dinas Kolaka',
            'email' => 'kepaladinas@gmail.com',
            'role' => Role::KEPALADINAS
        ]);

    }
}
