<?php

namespace App\Livewire\Dashboard;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PetugasDashboard extends Component
{

    public function jumlahHasilPanen(): int {
        return HasilPanen::query()->count();
    }

    public function jumlahKecamatan(): int {
        return Kecamatan::query()->count();
    }

    public function render()
    {
        return view('livewire.dashboard.petugas-dashboard');
    }
}
