<?php

namespace App\Livewire\Forms;

use Illuminate\Validation\Rule;
use Livewire\Form;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasForm extends Form
{
    public ?Petugas $petugas = null;

    public string $nama_petugas = '';
    public string $email = '';
    public ?string $password = '';
    public string $telepon = '';
    public string $jabatan = '';
    public $photo = null;

    public $id_kecamatan;

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
            'password' => ['nullable', 'min:4'],
            'id_kecamatan' => 'required|exists:kecamatan,id_kecamatan',
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
            'password.min' => 'Password minimal 4 karakter.',
            'jabatan.max' => 'Jabatan maksimal 50 karakter.',
            'photo.image' => 'File photo harus berupa gambar.',
            'photo.max' => 'Ukuran photo maksimal 2MB.',
            'id_kecamatan.required' => 'Silakan pilih kecamatan.',
            'id_kecamatan.exists' => 'Kecamatan yang dipilih tidak tersedia di sistem.',
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
            'id_kecamatan' => $this->id_kecamatan
        ]);
    }


    /**
     * Update data petugas yang sudah ada
     */
    public function update(): bool
    {

        $this->validate();

        $updates = [];

        if ($this->nama_petugas !== $this->petugas->nama_petugas) {
            $updates['nama_petugas'] = $this->nama_petugas;
        }

        if ($this->email !== $this->petugas->email) {
            $updates['email'] = $this->email;
        }

        if (! empty($this->password)) {
            $updates['password'] = \Hash::make($this->password);
        }

        if ($this->telepon !== $this->petugas->telepon) {
            $updates['telepon'] = $this->telepon;
        }

        if ($this->jabatan !== $this->petugas->jabatan) {
            $updates['jabatan'] = $this->jabatan;
        }

        if ($this->id_kecamatan !== $this->petugas->id_kecamatan) {
            $updates['id_kecamatan'] = $this->id_kecamatan;
        }

        if ($this->photo) {
            // Hapus foto lama kalau ada
            if ($this->petugas->photo) {
                \Storage::disk('public')->delete($this->petugas->photo);
            }

            // Simpan foto baru
            $path = $this->photo->store('photos', 'public');
            $updates['photo'] = $path;
        }

        if (! empty($updates)) {
            $this->petugas->update($updates);
            return true;
        }
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
        $this->id_kecamatan = $petugas->id_kecamatan;
    }

}
