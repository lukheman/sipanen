<?php

use App\Enums\Role;
use App\Models\Admin;
use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\KepalaDinas;
use App\Models\Petugas;
use App\Models\Tanaman;
use App\Models\User;
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
        Admin::create([
            'nama_admin' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        // === 4. User kepala dinas ===
        KepalaDinas::create([
            'nama_kepala_dinas' => 'Kepala Dinas Kolaka',
            'email' => 'kepaladinas@gmail.com',
            'password' => bcrypt('password123'),
            'tanggal_lahir' => date('Y-m-h')
        ]);

        // === 5. Buat petugas untuk setiap kecamatan ===
        $kecamatanList = Kecamatan::all();

        foreach ($kecamatanList as $kecamatan) {
            // ubah nama kecamatan jadi format email-friendly
            $slug = strtolower(str_replace(' ', '', $kecamatan->nama));

            Petugas::create([
                'nama_petugas' => 'Petugas '.$kecamatan->nama,
                'email' => "petugas_{$slug}@gmail.com",
                'id_kecamatan' => $kecamatan->id_kecamatan,
                'password' => bcrypt('password123'),
            ]);
        }

        // === 2. Data tanaman & hasil panen ===
        Tanaman::factory(10)->create();
        HasilPanen::factory(200)->create();
    }
}
