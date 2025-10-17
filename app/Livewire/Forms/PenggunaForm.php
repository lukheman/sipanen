<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;
use Illuminate\Validation\Rule;

class PenggunaForm extends Form
{
    public ?User $user = null;

    public string $nama = '';
    public string $email = '';
    public ?string $photo = null;
    public string $role = '';

    /**
     * Aturan validasi
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'min:3', 'max:100'],
            'email' => [
                'required',
                'email', 'max:100',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'photo' => ['nullable', 'string'],
            'role' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'role.required' => 'Role wajib diisi.',
        ];
    }

    /**
     * Load data ke form saat edit
     */
    public function fillFromModel(User $user): void
    {
        $this->user = $user;
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->photo = $user->photo;
        $this->role = $user->role->value;
    }

    /**
     * Store data baru
     */
    public function store(): void
    {
        $data = $this->validate();
        User::create($data);
        $this->reset();
    }

    /**
     * Update data pengguna
     */
    public function update(): void
    {
        $data = $this->validate();
        if ($this->user) {
            $this->user->update($data);
        }
    }

    /**
     * Hapus data pengguna
     */
    public function delete(): void
    {
        if ($this->user) {
            $this->user->delete();
            $this->reset();
        }
    }
}
