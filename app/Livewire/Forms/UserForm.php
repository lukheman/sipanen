<?php

namespace App\Livewire\Forms;

use App\Enums\Role;
use App\Models\Admin;
use App\Models\KepalaDinas;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public $user;

    public string $nama_petani = '';

    public string $telepon = '';

    public string $alamat = '';

    public ?int $id_desa;

    protected function rules(): array
    {
        return [
            'nama_petani' => 'required|string|max:255',
            'telepon' => [
                'required',
                'regex:/^0[0-9]{9,14}$/',
                'numeric'
            ],
            'alamat' => 'required|max:255',
            'id_desa' => 'required|exists:desa,id_desa',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_petani.required' => 'Mohon masukkan nama Anda (maksimal 255 karakter).',
            'nama_petani.string' => 'Nama hanya boleh berisi huruf atau karakter yang valid.',
            'nama_petani.max' => 'Nama maksimal 255 karakter.',

            'alamat.required' => 'Mohon isi alamat Anda.',
            'alamat.max' => 'Alamat maksimal 255 karakter',

            'telepon.required' => 'Mohon masukkan nomor telepon Anda.',
            'telepon.regex' => 'Nomor telepon harus format Indonesia, diawali 0, dan panjang 10–15 digit.',
            'telepon.numeric' => 'Nomor telepon hanya boleh berisi angka',
            'telepon.numeric' => 'Nomor telepon hanya boleh berisi angka',
            'id_desa.required' => 'Silakan pilih desa.',
            'id_desa.exists' => 'Desa yang dipilih tidak tersedia di sistem.',

        ];
    }

    public function store()
    {
        User::create($this->validate());
        $this->reset();
    }

    public function update()
    {
        $this->user->update($this->validate());
        $this->reset();
    }

    public function delete()
    {
        $this->user->delete();
        $this->reset();
    }
}
