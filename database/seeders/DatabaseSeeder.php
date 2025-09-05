<?php

use App\Models\Admin;
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
        User::factory(10)->create();
        Petugas::factory(10)->create();

        Tanaman::factory(10)->create();
        HasilPanen::factory(10)->create();

        // Buat user dengan id_desa secara acak
        Admin::create([
            'nama_admin' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        // User::factory()->create([
        //     'name' => 'Petani 1',
        //     'email' => 'petani1@gmail.com',
        //     'id_desa' => $desaIds->random(),
        // ]);
        //
        // User::factory()->create([
        //     'name' => 'Petani 2',
        //     'email' => 'petani2@gmail.com',
        //     'id_desa' => $desaIds->random(),
        // ]);
        //
        // Penyuluh::create([
        //     'name' => 'Penyuluh',
        //     'email' => 'ahlipertanian@gmail.com',
        //     'telepon' => '0822502231231',
        //     'tanggal_lahir' => now(),
        //     'id_desa' => $desaIds->random(),
        // ]);
        //
        // KepalaDinas::create([
        //     'name' => 'KEPALADINAS',
        //     'email' => 'kepaladinas@gmail.com',
        //     'telepon' => '082283919291',
        //     'tanggal_lahir' => now(),
        //     'id_desa' => $desaIds->random(),
        // ]);
    }
}
