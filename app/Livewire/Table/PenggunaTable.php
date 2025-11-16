<?php

namespace App\Livewire\Table;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Enums\Role;
use App\Enums\State;
use App\Livewire\Forms\PenggunaForm;
use App\Models\Kecamatan;
use App\Models\Petugas;
use App\Models\Admin;
use App\Models\KepalaDinas;
use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Pengguna')]
class PenggunaTable extends Component
{
    use WithModal, WithNotify, WithPagination;

    public $currentState = State::CREATE;

    public PenggunaForm $form;

    public string $search = '';

    public $idModal = 'modal-form-pengguna';

    public $currentUserRole;

    public function add()
    {
        $this->form->reset();
        $this->currentState = State::CREATE;
        $this->openModal($this->idModal);
    }

    public function detail($id, $role)
    {

        $this->currentState = State::SHOW;
        $this->form->fillUser($id, $role);
        $this->currentUserRole = $role;

        $this->openModal($this->idModal);

    }

    public function save()
    {

        $this->form->role = Role::from($this->currentUserRole);
        if ($this->currentState === State::CREATE) {
            $this->form->store();
            $this->notifySuccess('Petugas berhasil ditambahkan!');
        } elseif ($this->currentState === State::UPDATE) {
            $this->form->update();
            $this->notifySuccess('Petugas berhasil diperbarui!');
        }

        $this->closeModal($this->idModal);

    }

    public function edit($id, $role)
    {
        $this->detail($id, $role);
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

    public function delete($id, $role)
    {
        $this->form->fillUser($id, $role);
        $this->dispatch('deleteConfirmation', message: 'Yakin untuk menghapus petugas ini?');
    }

    #[Computed]
    public function kecamatanList()
    {

        return Kecamatan::all();

    }

    #[Computed]
    public function pengguna()
    {

        $admin = Admin::all()->map(function ($item) {
            $item->id = $item->id_admin;
            $item->nama = $item->nama_admin;
            $item->role = Role::ADMIN;

            return $item;
        });

        $petugas = Petugas::with('kecamatan')->get()->map(function ($item) {
            $item->id = $item->id_petugas;
            $item->nama = $item->nama_petugas;
            $item->role = Role::PETUGAS;

            return $item;
        });

        $kepalaDinas = KepalaDinas::all()->map(function ($item) {
            $item->id = $item->id_kepala_dinas;
            $item->nama = $item->nama_kepala_dinas;
            $item->role = Role::KEPALADINAS;

            return $item;
        });

        // Gabungkan jadi satu collection
        $allUsers = $admin
            ->concat($petugas)
            ->concat($kepalaDinas);

        // Sortir berdasarkan created_at
        $allUsers = $allUsers->sortByDesc('created_at');

        // Paginasi manual
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allUsers->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginated = new LengthAwarePaginator(
            $currentItems,
            $allUsers->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $paginated;

    }

    public function render()
    {
        return view('livewire.table.pengguna-table');
    }
}
