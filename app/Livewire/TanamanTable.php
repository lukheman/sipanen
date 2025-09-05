<?php

namespace App\Livewire;

use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Tanaman;
use App\Enums\State;
use App\Livewire\Forms\TanamanForm;
use Livewire\WithPagination;

#[Title('Tanaman')]
class TanamanTable extends Component
{
    use WithModal;
    use WithNotify;
    use WithPagination;

    public TanamanForm $form;

    public $currentState = State::CREATE;

    public string $idModal = 'modal-form-tanaman';

    public string $search = '';

    #[Computed]
    public function tanaman() {
        return Tanaman::query()
            ->when($this->search, function ($query) {
                $query->where('nama_tanaman', 'like', '%'.$this->search.'%')
                ->orWhere('jenis', 'like', '%'.$this->search.'%')
                ->orWhere('musim_tanam', 'like', '%'.$this->search.'%')
                ;
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

        $tanaman = Tanaman::findOrFail($id);

        $this->currentState = State::SHOW;

        $this->form->fillFromModel($tanaman);
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
            $this->notifySuccess('Tanaman berhasil ditambahkan!');
        } elseif ($this->currentState === State::UPDATE) {
            $this->form->update();
            $this->notifySuccess('Tanaman berhasil diperbarui!');
        }

        $this->closeModal($this->idModal);

    }

    public function delete(int $id)
    {

        $this->form->tanaman = Tanaman::findOrFail($id);

        $this->dispatch('deleteConfirmation', message: 'Yakin untuk menghapus tanaman ini?');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        try {
            $this->form->delete();
            $this->notifySuccess('Tanaman berhasil dihapus!');
        } catch (\Exception $e) {
            $this->notifyError('Gagal menghapus tanaman: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.tanaman-table');
    }
}
