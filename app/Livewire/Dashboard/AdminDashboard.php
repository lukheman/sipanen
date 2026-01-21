<?php

namespace App\Livewire\Dashboard;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Petugas;
use App\Models\Tanaman;
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

    public function jumlahTanaman(): int
    {
        return Tanaman::query()->count();
    }

    public function jumlahPetugas(): int
    {
        return Petugas::query()->count();
    }

    public function render()
    {
        return view('livewire.dashboard.admin-dashboard');
    }
}
