<?php

namespace App\Livewire\Table;

use App\Models\Petugas;
use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Tanaman;
use App\Models\HasilPanen;
use App\Models\User;
use App\Enums\State;
use App\Livewire\Forms\HasilPanenForm;
use Livewire\WithPagination;

#[Title('Hasil Panen')]
class HasilPanenTable extends Component
{
    use WithModal;
    use WithNotify;
    use WithPagination;

    public HasilPanenForm $form;

    public $currentState = State::CREATE;

    public string $search = '';

    public string $idModal = 'modal-form-hasil-panen';

    #[Computed]
    public function hasilPanen()
    {
        $guard = getActiveGuard(); // guard aktif
        $user = Auth::guard('petugas')->user();

        $query = HasilPanen::with(['petani.desa', 'tanaman'])
            ->when($this->search, function ($query) {
                $query->whereHas('petani', function ($q) {
                    $q->where('nama_petani', 'like', '%' . $this->search . '%');
                })->orWhereHas('tanaman', function ($q) {
                    $q->where('nama_tanaman', 'like', '%' . $this->search . '%');
                });
            });

        if ($guard === 'petugas') {
            // ambil data petugas
            $petugas = Petugas::find($user->id_petugas);

            if ($petugas && $petugas->id_kecamatan) {
                // filter hanya hasil panen dari petani di kecamatan yang sama
                $query->whereHas('petani.desa', function ($q) use ($petugas) {
                    $q->where('id_kecamatan', $petugas->id_kecamatan);
                });
            }
        }

        // admin -> tidak ada filter tambahan, otomatis ambil semua
        return $query->latest()->paginate(10);
    }

    #[Computed]
    public function petaniList() {
        $guard = getActiveGuard();
        $user = Auth::guard($guard)->user();

        $query = User::query();

        if($guard === 'petugas') {

            // cari kecamatan tempat petugas berada
            $kecamatanPetugas = Petugas::query()->find($user->id_petugas);


            if ($kecamatanPetugas) {
                $query->whereHas('desa', function ($q) use ($kecamatanPetugas) {
                    $q->where('id_kecamatan', $kecamatanPetugas->id_kecamatan);
                });
            }

        }

        return $query->latest()->get();
    }

    #[Computed]
    public function tanamanList() {
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

        if ($this->currentState === State::CREATE) {

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

        $this->form->hasil_panen = HasilPanen::findOrFail($id);

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
