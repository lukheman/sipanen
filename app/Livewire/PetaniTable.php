<?php

namespace App\Livewire;

use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use App\Enums\State;
use App\Livewire\Forms\UserForm;
use Livewire\WithPagination;

#[Title('Petani')]
class PetaniTable extends Component
{
    use WithModal;
    use WithNotify;
    use WithPagination;

    public UserForm $form;

    public $currentState = State::CREATE;

    public string $idModal = 'modal-form-petani';
    public string $search = '';

    #[Computed]
    public function petani() {
        return User::query()
            ->when($this->search, function ($query) {
                $query->where('nama_petani', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(10);

    }

    public function add()
    {
        $this->form->reset();
        $this->currentState = State::CREATE;
        $this->openModal($this->idModal);
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);

        $this->currentState = State::SHOW;

        $this->form->user = $user;
        $this->form->nama_petani = $user->nama_petani;
        $this->form->lokasi = $user->lokasi;
        $this->form->telepon = $user->telepon;
        $this->openModal($this->idModal);

    }

    public function edit(int $id)
    {
        $this->detail($id);
        $this->currentState = State::UPDATE;
    }

    public function save()
    {

        if ($this->currentState === State::CREATE) {

            $this->form->store();
            $this->notifySuccess('Pengguna berhasil ditambahkan!');
        } elseif ($this->currentState === State::UPDATE) {
            $this->form->update();
            $this->notifySuccess('Pengguna berhasil diperbarui!');
        }

        $this->closeModal($this->idModal);

    }

    public function delete(int $id)
    {

        $this->form->user = User::findOrFail($id);

        $this->dispatch('deleteConfirmation', message: 'Yakin untuk menghapus pengguna ini?');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        try {
            $this->form->delete();
            $this->notifySuccess('Pengguna berhasil dihapus!');
        } catch (\Exception $e) {
            $this->notifyError('Gagal menghapus pengguna: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.petani-table');
    }
}
