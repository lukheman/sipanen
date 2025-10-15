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

    public function getJumlahHasilPanen(): int {
        $user = Auth::guard('petugas')->user();
        $petugas = Petugas::query()->find($user->id_kecamatan);

        return HasilPanen::query()->count();
    }

    public function render()
    {
        return view('livewire.dashboard.petugas-dashboard', [
            'jumlah_hasil_panen' => $this->getJumlahHasilPanen(),
        ]);
    }
}
