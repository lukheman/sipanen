<?php

namespace App\Livewire\Table;

use App\Enums\State;
use App\Livewire\Forms\HasilPanenForm;
use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Tanaman;
use App\Models\User;
use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Hasil Panen')]
class HasilPanenTable extends Component
{
    use WithModal;
    use WithNotify;
    use WithPagination;

    public $is_add = true;

    public HasilPanenForm $form;

    public $currentState = State::CREATE;

    public string $search = '';

    public ?int $tahun;

    public string $idModal = 'modal-form-hasil-panen';

    public ?User $user;

    public function mount()
    {
        $this->user = getActiveUser()->load('kecamatan');

        $this->tahun = date('Y');
    }

    #[Computed]
    public function hasilPanen()
    {
        $query = HasilPanen::with('tanaman')
            ->when($this->search, function ($query) {
                $query->whereHas('tanaman', function ($q) {
                    $q->where('nama_tanaman', 'like', '%'.$this->search.'%');
                })
                    ->orWhereHas('kecamatan', function ($q) {
                        $q->where('nama', 'like', '%'.$this->search.'%');
                    });
            })
            ->where('id_kecamatan', $this->user->kecamatan->id_kecamatan)
            ->where('tahun', $this->tahun);

        return $query->latest()->paginate(10);
    }

    #[Computed]
    public function kecamatanList()
    {
        return Kecamatan::all();
    }

    #[Computed]
    public function tanamanList()
    {
        return Tanaman::all();
    }

    public function add()
    {
        $this->form->reset();
        $this->currentState = State::CREATE;
        $this->openModal($this->idModal);
    }

    public function detail($id)
    {

        $hasil_panen = HasilPanen::findOrFail($id);

        $this->currentState = State::SHOW;

        $this->form->fillFromModel($hasil_panen);
        $this->openModal($this->idModal);

    }

    public function edit(int $id)
    {
        $this->detail($id);
        $this->currentState = State::UPDATE;
    }

    public function save()
    {

        $this->form->tahun = $this->tahun;

        if ($this->currentState === State::CREATE) {

            $this->form->id_kecamatan = $this->user->kecamatan->id_kecamatan;

            $this->form->store();
            $this->notifySuccess('Hasil panen berhasil ditambahkan!');
        } elseif ($this->currentState === State::UPDATE) {
            $this->form->update();
            $this->notifySuccess('Hasil panen berhasil diperbarui!');
        }

        $this->closeModal($this->idModal);

    }

    public function delete(int $id)
    {

        $this->form->hasilPanen = HasilPanen::findOrFail($id);

        $this->dispatch('deleteConfirmation', message: 'Yakin untuk menghapus hasil panen ini?');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        try {
            $this->form->delete();
            $this->notifySuccess('Hasil panen berhasil dihapus!');
        } catch (\Exception $e) {
            $this->notifyError('Gagal menghapus hasil panen: '.$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.table.hasil-panen-table');
    }
}
