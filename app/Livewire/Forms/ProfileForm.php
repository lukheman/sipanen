<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;
use function getActiveGuard;
use function str_replace;
use function strtolower;

class ProfileForm extends Form
{
    use WithFileUploads;

    public ?string $nama = null;

    public ?string $email = null;

    public ?string $password = null;

    public $photo = null ;

    public ?User $user = null;

    protected function rules(): array
    {

        $guard = getActiveGuard(); // guard / table active

        return [
            'nama' => ['required', 'max:50'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'password' => ['nullable', 'min:4'],
            'photo' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ];

    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Mohon masukkan nama Anda (maksimal 255 karakter).',
            'nama.string' => 'Nama hanya boleh berisi huruf atau karakter yang valid.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'email.required' => 'Mohon masukkan email Anda.',
            'email.email' => 'Format email tidak valid, silakan periksa kembali.',
        ];
    }

    public function update(): bool
    {
        // Validate the form data
        $this->validate();

        // Prepare updates only for changed fields
        $updates = [];
        if ($this->nama !== $this->user->nama) {
            $updates['nama'] = $this->nama;
        }
        if ($this->email !== $this->user->email) {
            $updates['email'] = $this->email;
        }
        if (! empty($this->password)) {
            $updates['password'] = Hash::make($this->password);
        }

        if ($this->photo) {
            // Delete old photo if exists
            if ($this->user->photo) {
                Storage::disk('public')->delete($this->user->photo);
            }
            // Store new photo
            $path = $this->photo->store('photos', 'public');
            $updates['photo'] = $path;
        }

        // Perform update only if there are changes
        if (! empty($updates)) {
            $this->user->update($updates);

            return true;
        }

        return false; // No changes made
    }

    public function fillFromModel(User $user): void {
        $this->user = $user;
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->photo = $user->photo;
    }

}
