<?php

namespace App\Livewire\Dashboard;

use App\Models\HasilPanen;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $topHasilPanen = HasilPanen::select('id_tanaman', DB::raw('COUNT(*) as total'))
            ->groupBy('id_tanaman')
            ->orderByDesc('total')
            ->with('tanaman') // ambil relasi tanaman
            ->limit(5)
            ->get();

        return view('livewire.dashboard.admin-dashboard', [
            'topHasilPanen' => $topHasilPanen
        ]);
    }
}
