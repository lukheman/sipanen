<?php

namespace App\Livewire\Dashboard;

use App\Enums\Role;
use App\Models\HasilPanen;
use App\Models\Petugas;
use App\Models\User;
use Livewire\Component;

class KepalaDinasDashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard.kepala-dinas-dashboard', [
            'jumlah_petani' => User::count(),
            'jumlah_petugas' => Petugas::count(),
            'jumlah_hasil_panen' => HasilPanen::count(),
        ]);
    }
}
