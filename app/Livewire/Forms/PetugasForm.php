<?php

namespace App\Livewire\Forms;

use Illuminate\Validation\Rule;
use Livewire\Form;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasForm extends Form
{
    public ?Petugas $petugas = null;

    public $nama_petugas = '';
    public $email = '';
    // public $password = '';
    public $telepon = '';
    public $jabatan = '';
    public $photo = null;

    public function rules(): array
    {
        return [
            'nama_petugas' => ['required', 'string', 'min:3', 'max:100'],
            'email' => [
                'required',
                'email',
                Rule::unique('petugas', 'email')->ignore($this->petugas, 'id_petugas'),
            ],
            // 'password' => $this->petugas ? ['nullable', 'string', 'min:6'] : ['required', 'string', 'min:6'],
            'telepon' => ['required', 'string', 'min:10', 'max:15'],
            'jabatan' => ['nullable', 'string', 'max:50'],
            'photo' => ['nullable', 'image', 'max:2048'], // 2MB
        ];
    }

     public function messages(): array
    {
        return [
            'nama_petugas.required' => 'Nama petugas wajib diisi.',
            'nama_petugas.min' => 'Nama petugas minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.min' => 'Nomor telepon minimal 10 digit.',
            'telepon.max' => 'Nomor telepon maksimal 15 digit.',
            'jabatan.max' => 'Jabatan maksimal 50 karakter.',
            'photo.image' => 'File photo harus berupa gambar.',
            'photo.max' => 'Ukuran photo maksimal 2MB.',
        ];
    }

    /**
     * Simpan data petugas baru
     */
    public function store(): Petugas
    {
        $this->validate();

        return Petugas::create([
            'nama_petugas' => $this->nama_petugas,
            'email'        => $this->email,
            'telepon'      => $this->telepon,
            'jabatan'      => $this->jabatan,
        ]);
    }


    /**
     * Update data petugas yang sudah ada
     */
    public function update(): bool
    {
        $this->validate();

        return $this->petugas->update([
            'nama_petugas' => $this->nama_petugas,
            'email'        => $this->email,
            // 'password'     => $this->password
            //                     ? Hash::make($this->password)
            //                     : $this->petugas->password,
            'telepon'      => $this->telepon,
            'jabatan'      => $this->jabatan,
            // 'photo'        => $this->photo,
        ]);
    }

    public function delete()
    {
        $this->petugas->delete();
        $this->reset();
    }

    /**
     * Isi form dengan data existing (untuk edit)
     */
    public function fillFromModel(Petugas $petugas): void
    {
        $this->petugas      = $petugas;
        $this->nama_petugas = $petugas->nama_petugas;
        $this->email        = $petugas->email;
        $this->telepon      = $petugas->telepon;
        $this->jabatan      = $petugas->jabatan;
        $this->photo        = $petugas->photo;
    }
}
