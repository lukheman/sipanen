<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\ProfileForm;
use App\Models\User;
use App\Traits\WithNotify;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Profile')]
class PenggunaProfile extends Component
{
    public ProfileForm $form;

    use WithFileUploads;
    use WithNotify;

    public function mount()
    {
        $user = User::query()->find(Auth::user()->id);
        $this->form->fillFromModel($user);
    }

    public function save()
    {
        if ($this->form->update()) {

            $this->notifySuccess('Berhasil menyimpan perubahan profile');
        }

    }

    public function render()
    {
        return view('livewire.profile.pengguna-profile');
    }
}
