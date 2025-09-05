<?php

namespace App\Livewire\Laporan;

use App\Enums\Role;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Laporan Petani')]
class LaporanDataPetani extends Component
{
    public function render()
    {
        return view('livewire.laporan.laporan-data-petani');
    }
}
