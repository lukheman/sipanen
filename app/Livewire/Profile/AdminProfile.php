<?php

namespace App\Livewire\Profile;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\WithNotify;
use App\Livewire\Forms\AdminForm;

class AdminProfile extends Component
{
    public AdminForm $form;
    use WithFileUploads;
    use WithNotify;

    public function mount() {
        $admin = Admin::query()->find(auth()->user()->id_admin);
        $this->form->fillFromModel($admin);
    }

    public function save()
    {
        if ($this->form->update()) {

            $this->notifySuccess('Berhasil menyimpan perubahan profile');
        }

    }

    public function render()
    {
        return view('livewire.profile.admin-profile');
    }
}
