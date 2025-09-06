<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\KepalaDinasForm;
use App\Models\KepalaDinas;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class KepalaDinasProfile extends Component
{
    public KepalaDinasForm $form;
    use WithFileUploads;
    use WithNotify;

    public function mount() {
        $kepala_dinas = KepalaDinas::query()->find(auth()->user()->id_kepala_dinas);
        $this->form->fillFromModel($kepala_dinas);
    }

    public function save()
    {
        if ($this->form->update()) {


            $this->notifySuccess('Berhasil menyimpan perubahan profile');
        }

    }

    public function render()
    {
        return view('livewire.profile.kepala-dinas-profile');
    }
}
