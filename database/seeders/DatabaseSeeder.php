<?php

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
        Admin::query()->create([
            'nama_admin' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        Petugas::factory()->create([
            'nama_petugas' => 'Petugas 1',
            'email' => 'petugas1@gmail.com',
            'id_kecamatan' => 1
        ]);

        Petugas::factory()->create([
            'nama_petugas' => 'Petugas 2',
            'email' => 'petugas2@gmail.com',
            'id_kecamatan' => 2
        ]);

        KepalaDinas::query()->create([
            'nama_kepala_dinas' => 'Kepala Dinas Kolaka',
            'email' => 'kepaladinas@gmail.com',
            'telepon' => '08225002210021',
            'tanggal_lahir' => fake()->date()
        ]);

    }
}
