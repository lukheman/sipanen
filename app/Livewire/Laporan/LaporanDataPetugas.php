<?php

namespace App\Livewire\Laporan;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Laporan Petugas')]
class LaporanDataPetugas extends Component
{
    public function render()
    {
        return view('livewire.laporan.laporan-data-petugas');
    }
}
