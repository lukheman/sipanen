<?php

namespace App\Livewire\Table;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Petugas;
use App\Livewire\Forms\PetugasForm;
use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Component;
use App\Enums\State;

#[Title('Petugas')]
class PetugasTable extends Component
{
    use WithPagination, WithModal, WithNotify;

    public $currentState = State::CREATE;
    public PetugasForm $form;

    public string $search = '';

    public $idModal = 'modal-form-petugas';

    public $kecamatan;

    public $kecamatanList;

    public function mount() {
        $this->kecamatanList = Kecamatan::all();
    }

    public function add()
    {
        $this->form->reset();
        $this->currentState = State::CREATE;
        $this->openModal($this->idModal);
    }

    public function detail($id)
    {
        $petugas = Petugas::with('kecamatan')->findOrFail($id);

        $this->currentState = State::SHOW;
        $this->kecamatan = "Kecamatan {$petugas->kecamatan->nama}";

        $this->form->fillFromModel($petugas);

        $this->openModal($this->idModal);

    }

    public function save()
    {

        if ($this->currentState === State::CREATE) {

            $this->form->store();
            $this->notifySuccess('Petugas berhasil ditambahkan!');
        } elseif ($this->currentState === State::UPDATE) {
            $this->form->update();
            $this->notifySuccess('Petugas berhasil diperbarui!');
        }

        $this->closeModal($this->idModal);

    }

    public function edit(int $id)
    {
        $this->detail($id);
        $this->currentState = State::UPDATE;
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        try {
            $this->form->delete();
            $this->notifySuccess('Petugas berhasil dihapus!');
        } catch (\Exception $e) {
            $this->notifyError('Gagal menghapus petugas: '.$e->getMessage());
        }
    }

    public function delete(int $id)
    {
        $this->form->petugas = Petugas::findOrFail($id);
        $this->dispatch('deleteConfirmation', message: 'Yakin untuk menghapus petugas ini?');
    }

    #[Computed]
    public function petugas() {
        return Petugas::query()
            ->when($this->search, fn($q) => $q->where('nama_petugas', 'like', "%{$this->search}%")
                                            ->orWhere('email', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.table.petugas-table');
    }
}
