<?php

namespace App\Livewire\Forms;

use App\Models\KepalaDinas;
use Illuminate\Validation\Rule;
use Livewire\Form;

class KepalaDinasForm extends Form
{
    public ?KepalaDinas $kepala_dinas = null;

    public string $nama = '';
    public string $email = '';
    public ?string $alamat = '';
    public string $telepon = '';
    public string $tanggal_lahir = '';
    public ?string $password = '';
    public $photo = null;

    /**
     * Rules untuk validasi form Kepala Dinas
     */
    protected function rules(): array
    {
        $guard = getActiveGuard(); // guard / table aktif

        return [
            'nama' => ['required', 'max:50'],
            'email' => [
                'required',
                'email',
                Rule::unique($guard, 'email')->ignore($this->kepala_dinas),
            ],
            'alamat' => ['nullable', 'max:255'],
            'password' => ['nullable', 'min:4'],
            'telepon' => [
                'required',
                'regex:/^0[0-9]{9,14}$/',
            ],
            'tanggal_lahir' => [
                'required',
                'date',
                'before:today',
            ],
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

            // 'alamat.required' => 'Mohon isi alamat Anda.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',

            'telepon.required' => 'Mohon masukkan nomor telepon Anda.',
            'telepon.regex' => 'Nomor telepon harus format Indonesia, diawali 0, dan panjang 10–15 digit.',

            'tanggal_lahir.required' => 'Mohon masukkan tanggal lahir Anda.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',

            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    /**
     * Update profil Kepala Dinas
     */
    public function update(): bool
    {
        // Validasi semua field sesuai rules()
        $this->validate();


        $updates = [];

        if ($this->nama !== $this->kepala_dinas->nama_kepala_dinas) {
            $updates['nama_kepala_dinas'] = $this->nama;
        }

        if ($this->email !== $this->kepala_dinas->email) {
            $updates['email'] = $this->email;
        }

        if (! empty($this->password)) {
            $updates['password'] = \Hash::make($this->password);
        }

        if ($this->telepon !== $this->kepala_dinas->telepon) {
            $updates['telepon'] = $this->telepon;
        }

        if ($this->tanggal_lahir !== $this->kepala_dinas->tanggal_lahir) {
            $updates['tanggal_lahir'] = $this->tanggal_lahir;
        }

        if ($this->alamat !== $this->kepala_dinas->alamat) {
            $updates['alamat'] = $this->alamat;
        }

        if ($this->photo) {
            // Hapus foto lama kalau ada
            if ($this->kepala_dinas->photo) {
                \Storage::disk('public')->delete($this->kepala_dinas->photo);
            }

            // Simpan foto baru
            $path = $this->photo->store('photos', 'public');
            $updates['photo'] = $path;
        }

        if (! empty($updates)) {
            $this->kepala_dinas->update($updates);
            return true;
        }

        return false; // Tidak ada perubahan
    }

    public function fillFromModel(KepalaDinas $kepala_dinas): void
    {
        $this->kepala_dinas   = $kepala_dinas;
        $this->nama           = $kepala_dinas->nama_kepala_dinas;
        $this->email          = $kepala_dinas->email;
        $this->telepon        = $kepala_dinas->telepon;
        $this->tanggal_lahir  = $kepala_dinas->tanggal_lahir;
        $this->photo          = $kepala_dinas->photo;
        $this->alamat         = $kepala_dinas->alamat;
    }
}

