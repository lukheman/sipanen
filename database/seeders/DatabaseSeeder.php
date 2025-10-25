<?php

use App\Enums\Role;
use App\Models\User;
use App\Models\Tanaman;
use App\Models\HasilPanen;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === 1. Data kecamatan ===
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
            Kecamatan::create(['nama' => $namaKecamatan]);
        }


        // === 3. User admin ===
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => Role::ADMIN,
        ]);

        // === 4. User kepala dinas ===
        User::create([
            'nama' => 'Kepala Dinas Kolaka',
            'email' => 'kepaladinas@gmail.com',
            'role' => Role::KEPALADINAS,
        ]);

        // === 5. Buat petugas untuk setiap kecamatan ===
        $kecamatanList = Kecamatan::all();

        foreach ($kecamatanList as $kecamatan) {
            // ubah nama kecamatan jadi format email-friendly
            $slug = strtolower(str_replace(' ', '', $kecamatan->nama));

            User::create([
                'nama' => 'Petugas ' . $kecamatan->nama,
                'email' => "petugas_{$slug}@gmail.com",
                'role' => Role::PETUGAS,
                'id_kecamatan' => $kecamatan->id_kecamatan,
            ]);
        }

        // === 2. Data tanaman & hasil panen ===
        Tanaman::factory(20)->create();
        HasilPanen::factory(200)->create();
    }
}
