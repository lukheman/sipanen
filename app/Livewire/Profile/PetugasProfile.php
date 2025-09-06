<?php

namespace App\Livewire\Profile;

use App\Livewire\Forms\PetugasForm;
use App\Models\Petugas;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class PetugasProfile extends Component
{

    public PetugasForm $form;
    use WithFileUploads;
    use WithNotify;

    public string $kecamatan;

    public function mount() {
        $petugas = Petugas::query()->with('kecamatan')->find(auth()->user()->id_petugas);
        $this->form->fillFromModel($petugas);
        $this->kecamatan = $petugas->kecamatan->nama;
    }

    public function save()
    {
        if ($this->form->update()) {

            $this->notifySuccess('Berhasil menyimpan perubahan profile');
        }

    }
    public function render()
    {
        return view('livewire.profile.petugas-profile');
    }
}
