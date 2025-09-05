<?php

namespace App\Livewire\Laporan;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Laporan Hasil Panen')]
class LaporanDataHasilPanen extends Component
{
    public function render()
    {
        return view('livewire.laporan.laporan-data-hasil-panen');
    }
}
