<?php

namespace App\Livewire\Table;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Petugas;
use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Illuminate\Support\Facades\Auth;
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

    public $kecamatanList;

    public $desaList;

    public $selectedDesa;

    public $selectedKecamatan;

    public $kecamatan;

    public function mount() {
        $this->kecamatanList = Kecamatan::all();
        $this->desaList = collect(); // Initialize as empty

        if (auth('petugas')->check()) {

            $user = auth()->user();

            $this->form->id_kecamatan = $user->id_kecamatan;
            $this->updatedKecamatan($user->id_kecamatan);

        }
    }

    public function updatedKecamatan($value)
    {
        $this->desaList = $value ? Desa::where('id_kecamatan', $value)->get() : collect();
    }

    #[Computed]
    public function petani()
    {
        $guard = getActiveGuard(); // guard aktif
        $user = Auth::guard($guard)->user();

        $query = User::with('desa')
            ->when($this->search, function ($query) {
                $query->where('nama_petani', 'like', '%' . $this->search . '%');
            });

        if ($guard === 'petugas') {
            // cari kecamatan tempat petugas berada
            $petugas = Petugas::query()->find($user->id_petugas);

            if ($petugas) {
                $query->whereHas('desa', function ($q) use ($petugas) {
                    $q->where('id_kecamatan', $petugas->id_kecamatan);
                });
            }
        }

        // jika admin -> tidak ada filter tambahan, otomatis ambil semua
        return $query->latest()->paginate(10);
    }

    public function add()
    {
        $this->form->reset();
        $this->currentState = State::CREATE;
        $this->openModal($this->idModal);
    }

    public function detail($id)
    {
        $this->currentState = State::SHOW;

        $petani = User::with('desa')->findOrFail($id);
        $this->updatedKecamatan($petani->desa->id_kecamatan);

        $this->form->user = $petani;
        $this->form->nama_petani = $petani->nama_petani;
        $this->form->alamat = $petani->alamat;
        $this->form->telepon = $petani->telepon;
        $this->form->id_desa = $petani->id_desa;


        $this->kecamatan = $petani->desa->id_kecamatan;
        $this->selectedDesa = $petani->desa->nama;
        $this->selectedKecamatan = Kecamatan::query()->find($petani->desa->id_kecamatan)->nama;

        $this->openModal($this->idModal);

    }

    public function edit(int $id)
    {
        $this->detail($id);
        $this->currentState = State::UPDATE;

        $this->form->id_desa = null;
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

        $this->form->reset();
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
        return view('livewire.table.petani-table');
    }
}
