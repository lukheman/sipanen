<?php

namespace App\Livewire\Profile;

use App\Traits\WithNotify;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Profile')]
class Index extends Component
{
    use WithFileUploads;
    use WithNotify;

    public function render()
    {
        return view('livewire.profile.index');
    }
}
