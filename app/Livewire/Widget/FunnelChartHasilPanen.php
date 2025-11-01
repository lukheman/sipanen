<?php

namespace App\Livewire\Widget;

use App\Models\HasilPanen;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FunnelChartHasilPanen extends Component
{

    public string $chartTitle = '5 Tanaman dengan hasil panen terbanyak';

    public function render()
    {

         $topHasilPanen = HasilPanen::select('id_tanaman', DB::raw('SUM(jumlah) as total_panen'))
                ->groupBy('id_tanaman')
                ->orderByDesc('total_panen')
                ->with('tanaman') // relasi ke tabel tanaman
                ->limit(5)
                ->get();

        return view('livewire.widget.funnel-chart-hasil-panen', [
            'topHasilPanen' => $topHasilPanen
        ]);
    }
}
