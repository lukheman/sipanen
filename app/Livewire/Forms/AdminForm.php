<?php

namespace App\Livewire\Forms;

use App\Models\Admin;
use Illuminate\Validation\Rule;
use Livewire\Form;

class AdminForm extends Form
{
    public ?Admin $admin = null;

    public string $nama = '';
    public string $email = '';
    public ?string $alamat = '';
    public ?string $password = '';
    public $photo = null;

    /**
     * Rules untuk validasi form Admin
     */
    protected function rules(): array
    {
        $guard = getActiveGuard(); // guard / table aktif

        return [
            'nama' => ['required', 'max:50'],
            'email' => [
                'required',
                'email',
                Rule::unique($guard, 'email')->ignore($this->admin),
            ],
            'alamat' => ['nullable', 'max:255'],
            'password' => ['nullable', 'min:4'],
            'photo' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ];
    }

    /**
     * Pesan error custom untuk validasi
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Mohon masukkan nama Anda (maksimal 50 karakter).',
            'nama.max' => 'Nama maksimal 50 karakter.',

            'email.required' => 'Mohon masukkan email Anda.',
            'email.email' => 'Format email tidak valid, silakan periksa kembali.',
            'email.unique' => 'Email ini sudah digunakan, silakan gunakan yang lain.',

            'alamat.max' => 'Alamat maksimal 255 karakter',

            'password.min' => 'Password minimal 4 karakter.',

            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    /**
     * Update profil Admin
     */
    public function update(): bool
    {
        $this->validate();

        $updates = [];

        if ($this->nama !== $this->admin->nama_admin) {
            $updates['nama_admin'] = $this->nama;
        }

        if ($this->email !== $this->admin->email) {
            $updates['email'] = $this->email;
        }

        if (! empty($this->password)) {
            $updates['password'] = \Hash::make($this->password);
        }

        if ($this->alamat !== $this->admin->alamat) {
            $updates['alamat'] = $this->alamat;
        }

        if ($this->photo) {
            if ($this->admin->photo) {
                \Storage::disk('public')->delete($this->admin->photo);
            }
            $path = $this->photo->store('photos', 'public');
            $updates['photo'] = $path;
        }

        if (! empty($updates)) {
            $this->admin->update($updates);
            return true;
        }

        return false;
    }

    /**
     * Isi form dari model Admin
     */
    public function fillFromModel(Admin $admin): void
    {
        $this->admin   = $admin;
        $this->nama    = $admin->nama_admin;
        $this->email   = $admin->email;
        $this->photo   = $admin->photo;
        $this->alamat  = $admin->alamat;
    }
}
