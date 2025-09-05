<?php

namespace App\Livewire;

use App\Enums\Role;
use App\Models\Konsultasi;
use App\Models\Petugas;
use App\Models\User;
use Livewire\Component;

class KepalaDinasDashboard extends Component
{
    public function render()
    {
        return view('livewire.kepala-dinas-dashboard', [
            'jumlah_petani' => User::count(),
            'jumlah_petugas' => Petugas::count(),
            'jumlah_konsultasi' => Konsultasi::count(),
        ]);
    }
}
