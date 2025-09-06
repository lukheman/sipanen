<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Beranda')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
