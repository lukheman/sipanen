<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\PenggunaForm;
use App\Models\User;
use App\Traits\WithNotify;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Profile')]
class PenggunaProfile extends Component
{
    public PenggunaForm $form;

    use WithFileUploads;
    use WithNotify;

    public function mount()
    {
        $user = getActiveUser();
        $this->form->fillUser(getActiveUserId(), activeRole());
    }

    public function save()
    {
        $this->form->update();
        $this->notifySuccess('Berhasil menyimpan perubahan profile');

    }

    public function render()
    {
        return view('livewire.profile.pengguna-profile');
    }
}
