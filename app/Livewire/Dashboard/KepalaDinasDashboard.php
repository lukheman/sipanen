<?php

namespace App\Livewire\Dashboard;

use App\Enums\Role;
use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\User;
use Livewire\Component;

class KepalaDinasDashboard extends Component
{

    public function jumlahKecamatan(): int {
        return Kecamatan::query()->count();
    }

    public function jumlahHasilPanen(): int {
        return HasilPanen::query()->count();
    }

    public function render()
    {
        return view('livewire.dashboard.kepala-dinas-dashboard');
    }
}
