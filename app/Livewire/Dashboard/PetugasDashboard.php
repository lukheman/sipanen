<?php

namespace App\Livewire\Dashboard;

use App\Models\HasilPanen;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PetugasDashboard extends Component
{

    public $kecamatan;

    public function getJumlahPetani(): int {

        $user = Auth::guard('petugas')->user();
        $petugas = Petugas::query()->with('kecamatan')->find($user->id_kecamatan);

        $this->kecamatan = $petugas->kecamatan->nama;

        return User::with('desa')->whereHas('desa', function ($q) use ($petugas) {
            $q->where('id_kecamatan', $petugas->id_kecamatan);
        })->count();

    }

    public function getJumlahHasilPanen(): int {
        $user = Auth::guard('petugas')->user();
        $petugas = Petugas::query()->find($user->id_kecamatan);

        return HasilPanen::with('petani.desa')->whereHas('petani.desa', function ($q) use ($petugas) {
            $q->where('id_kecamatan', $petugas->id_kecamatan);
        })->count();
    }

    public function render()
    {
        return view('livewire.dashboard.petugas-dashboard', [
            'jumlah_petani' => $this->getJumlahPetani(),
            'jumlah_hasil_panen' => $this->getJumlahHasilPanen(),
        ]);
    }
}
