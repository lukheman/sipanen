<?php

namespace App\Livewire\Laporan;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Laporan Petugas')]
class LaporanDataPetugas extends Component
{
    public function render()
    {
        return view('livewire.laporan.laporan-data-petugas');
    }
}
