<?php

namespace App\Livewire\Forms;

use App\Enums\Role;
use App\Models\Admin;
use App\Models\KepalaDinas;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;

class PenggunaForm extends Form
{
    public $user = null;

    public string $nama = '';

    public string $email = '';

    public $tanggal_lahir;

    public $role;

    public $photo;

    public $password;


    public $id_kecamatan;

    /**
     * Aturan validasi
     */
    public function rules(): array
    {

        // ================================
        // ADMIN
        // ================================
        if ($this->role === Role::ADMIN) {
            return [
                'nama' => ['required', 'string', 'min:3', 'max:100'],
                'email' => [
                    'required',
                    'email',
                    'max:100',
                    Rule::unique('admin', 'email')->ignore($this->user),
                ],
            ];
        }

        // ================================
        // PETUGAS
        // ================================
        if ($this->role === Role::PETUGAS) {
            return [
                'nama' => ['required', 'string', 'min:3', 'max:100'],
                'email' => [
                    'required',
                    'email',
                    'max:100',
                    Rule::unique('petugas', 'email')->ignore($this->user),
                ],
                'id_kecamatan' => ['required', 'exists:kecamatan,id_kecamatan'],
            ];
        }

        // ================================
        // KEPALA DINAS
        // ================================
        if ($this->role === Role::KEPALADINAS) {
            return [
                'nama' => ['required', 'string', 'min:3', 'max:100'],
                'email' => [
                    'required',
                    'email',
                    'max:100',
                    Rule::unique('kepala_dinas', 'email')->ignore($this->user),
                ],
                'tanggal_lahir' => ['required', 'date'],
            ];
        }

    }

    public function messages(): array
    {
        return [

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'email.unique' => 'Email sudah digunakan.',


            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.max' => 'Nomor telepon terlalu panjang.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',



            // ============================
            // ADMIN
            // ============================
            'nama.required' => 'Nama admin wajib diisi.',
            'nama.min' => 'Nama admin minimal 3 karakter.',
            'nama.max' => 'Nama admin maksimal 100 karakter.',


            // ============================
            // PETUGAS
            // ============================
            'nama.required' => 'Nama petugas wajib diisi.',
            'nama.min' => 'Nama petugas minimal 3 karakter.',
            'nama.max' => 'Nama petugas maksimal 100 karakter.',

            'id_kecamatan.required' => 'Kecamatan wajib dipilih.',
            'id_kecamatan.exists' => 'Kecamatan tidak valid.',


            // ============================
            // KEPALA DINAS
            // ============================
            'nama.required' => 'Nama kepala dinas wajib diisi.',
            'nama.min' => 'Nama kepala dinas minimal 3 karakter.',
            'nama.max' => 'Nama kepala dinas maksimal 100 karakter.',

            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',

        ];
    }


    /**
    * Load data ke form saat edit
    */
    public function fillUser($id, $role): void
    {

        $role = Role::from($role);

        if ($role === Role::ADMIN) {
            $user = Admin::query()->find($id);
            $user->role = Role::ADMIN;
        } elseif ($role === Role::PETUGAS) {
            $user = Petugas::with('kecamatan')->find($id);
            $user->role = Role::PETUGAS;
        } elseif ($role === Role::KEPALADINAS) {
            $user = KepalaDinas::query()->find($id);
            $user->role = Role::KEPALADINAS;
        }

        $this->user = $user;

        $this->role = $role;

        // isi field umum
        $this->email = $user->email;

        $this->photo = $user->photo;

        // isi field berdasarkan role
        if ($user->role === Role::ADMIN) {
            $this->nama = $user->nama_admin;
        }

        if ($user->role === Role::PETUGAS) {
            $this->nama = $user->nama_petugas;
            $this->id_kecamatan = $user->id_kecamatan;
        }

        if ($user->role === Role::KEPALADINAS) {
            $this->nama = $user->nama_kepala_dinas;
            $this->tanggal_lahir = $user->tanggal_lahir;
        }
    }

    /**
     * Store data baru
     */
    public function store()
    {
        $validated = $this->validate();

        if ($this->role === Role::ADMIN) {
            Admin::query()->create([
                'nama_admin' => $this->nama,
                'email' => $this->email
            ]);
        } elseif ($this->role === Role::PETUGAS) {
            Petugas::query()->create([
                'nama_petugas' => $this->nama,
                'email' => $this->email,
                'id_kecamatan' => $this->id_kecamatan
            ]);
        } elseif ($this->role === Role::KEPALADINAS) {
            KepalaDinas::query()->create([
                'nama_kepala_dinas' => $this->nama,
                'email' => $this->email,
                'tanggal_lahir' => $this->tanggal_lahir
            ]);
        }

        $this->reset();
    }

    private function handlePhotoUpload($model)

    {
        // Jika tidak ada file baru, jangan lakukan apa-apa
        if (!is_object($this->photo)) {
            return $model->photo; // tetap pakai foto lama
        }

        // Hapus foto lama jika ada
        if ($model->photo && file_exists(storage_path('app/public/' . $model->photo))) {
            unlink(storage_path('app/public/' . $model->photo));
        }

        // Simpan foto baru
        $path = $this->photo->store('photos', 'public');

        return $path;
    }

    /**
     * Update data pengguna
     */
    public function update(): void
    {
        $validated = $this->validate();

        // handle upload foto baru
        $photoPath = $this->handlePhotoUpload($this->user);

        if ($this->role === Role::ADMIN) {
            $this->user->update([
                'nama_admin' => $this->nama,
                'email' => $this->email,
                'photo' => $photoPath,
                'password' => bcrypt($this->password)
            ]);
        } elseif ($this->role === Role::PETUGAS) {
            $this->user->update([
                'nama_petugas' => $this->nama,
                'email' => $this->email,
                'id_kecamatan' => $this->id_kecamatan,
                'photo' => $photoPath,
                'password' => bcrypt($this->password),
            ]);

        } elseif ($this->role === Role::KEPALADINAS) {
            $this->user->update([
                'nama_kepala_dinas' => $this->nama,
                'email' => $this->email,
                'tanggal_lahir' => $this->tanggal_lahir,
                'photo' => $photoPath,
                'password' => bcrypt($this->password),
            ]);
        }


        // $this->reset();
    }

    /**
     * Hapus data pengguna
     */
    public function delete(): void
    {
        $this->user->delete();
        $this->reset();
    }
}
