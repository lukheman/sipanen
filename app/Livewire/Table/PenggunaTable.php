<?php

namespace App\Livewire\Table;

use App\Enums\Role;
use App\Enums\State;
use App\Livewire\Forms\UserForm;
use App\Models\Admin;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\KepalaDinas;
use App\Models\Petugas;
use App\Models\User;
use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manajemen Pengguna')]
class PenggunaTable extends Component
{
    use WithModal;
    use WithNotify;
    use WithPagination;

    public UserForm $form;

    public $currentState = State::CREATE;

    public $idModal = 'modal-form-pengguna';

    public $kecamatanList;

    public $desaList;

    public $selectedDesa;

    public $selectedKecamatan;

    public $kecamatan;

    public $type;

    public function mount()
    {
        $this->kecamatanList = Kecamatan::all();
        $this->desaList = collect(); // Initialize as empty
    }

    public function updatedKecamatan($value)
    {
        $this->desaList = $value ? Desa::where('id_kecamatan', $value)->get() : collect();
    }

    public function detail($id, $role)
    {
        $role = Role::from($role);

        if ($role === Role::ADMIN) {
            $user = Admin::with('desa')->find($id);
        }  elseif ($role === Role::PETUGAS) {
            $user = Petugas::with('desa')->find($id);
        } elseif ($role === Role::KEPALADINAS) {
            $user = KepalaDinas::with('desa')->find($id);
        }

        $this->form->type = $role->value;
        $this->currentState = State::SHOW;
        $this->form->user = $user;
        $this->form->name = $user->name;
        $this->form->email = $user->email;
        $this->form->lokasi = $user->alamat;
        $this->form->role = $user->role;
        $this->form->telepon = $user->telepon;
        $this->form->tanggal_lahir = $user->tanggal_lahir;
        $this->form->id_desa = $user->desa->id ?? null;
        $this->kecamatan = $user->desa->id_kecamatan;
        $this->selectedDesa = $user->desa->nama;
        $this->selectedKecamatan = Kecamatan::find($user->desa->id_kecamatan)->nama;
        $this->updatedKecamatan($this->kecamatan); // Load desa list for the selected kecamatan
        $this->openModal($this->idModal);

    }

    public function edit($id, $role)
    {
        $this->detail($id, $role);
        $this->currentState = State::UPDATE;
    }

    public function save()
    {

        if ($this->currentState === State::CREATE) {

            $this->validate([
                'type' => 'required',
            ]);

            $this->form->type = $this->type;
            $this->form->store();
            $this->notifySuccess('Pengguna berhasil ditambahkan!');
        } elseif ($this->currentState === State::UPDATE) {
            $this->form->update();
            $this->notifySuccess('Pengguna berhasil diperbarui!');
        }

        $this->closeModal($this->idModal);

    }

    public function delete(int $id, $type)
    {
        $type = Role::from($type);

        if ($type === Role::ADMIN) {
            $this->form->user = Admin::findOrFail($id);
    } elseif ($type === Role::PETUGAS) {
            $this->form->user = Petugas::findOrFail($id);
        } elseif ($type === Role::KEPALADINAS) {
            $this->form->user = KepalaDinas::findOrFail($id);
        }

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

    public function add()
    {
        $this->form->reset();
        $this->currentState = State::CREATE;
        $this->openModal($this->idModal);
    }

    public function render()
    {

        $users = User::paginate();


        return view('livewire.table.pengguna-table', [
            'users' => $users,
        ]);
    }
}
