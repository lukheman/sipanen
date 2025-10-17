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

    public $user;

    public function mount() {
        $this->user = getActiveUser();
        $this->user->load('kecamatan');
    }

    public function jumlahHasilPanen(): int {
        return HasilPanen::query()->count();
    }


    public function render()
    {
        return view('livewire.dashboard.petugas-dashboard');
    }
}
