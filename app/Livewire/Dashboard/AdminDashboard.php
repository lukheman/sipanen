<?php

namespace App\Livewire\Dashboard;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function jumlahKecamatan(): int
    {
        return Kecamatan::query()->count();
    }

    public function jumlahHasilPanen(): int
    {
        return HasilPanen::query()->count();
    }

    public function render()
    {
        return view('livewire.dashboard.admin-dashboard');
    }
}
