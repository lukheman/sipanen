<?php

namespace App\Livewire\Forms;

use App\Models\Tanaman;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TanamanForm extends Form
{
    public ?Tanaman $tanaman = null;

    public string $nama_tanaman = '';
    public string $musim_tanam = '';

  public function rules(): array
    {
        return [
            'nama_tanaman' => ['required', 'string', 'min:3', 'max:100'],
            'musim_tanam' => ['required', 'string', 'min:3', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_tanaman.required' => 'Nama tanaman wajib diisi.',
            'nama_tanaman.min' => 'Nama tanaman minimal 3 karakter.',
            'nama_tanaman.max' => 'Nama tanaman maksimal 100 karakter.',

            'musim_tanam.required' => 'Musim tanam wajib diisi.',
            'musim_tanam.min' => 'Musim tanam minimal 3 karakter.',
            'musim_tanam.max' => 'Musim tanam maksimal 50 karakter.',
        ];
    }

    /**
     * Load data ke form saat edit
     */
    public function fillFromModel(Tanaman $tanaman): void
    {
        $this->tanaman = $tanaman;
        $this->nama_tanaman = $tanaman->nama_tanaman;
        $this->musim_tanam = $tanaman->musim_tanam;
    }

    /**
     * Store data baru
     */
    public function store(): void
    {
        Tanaman::create($this->validate());
        $this->reset();
    }

    /**
     * Update data tanaman yang sudah ada
     */
    public function update(): void
    {
        $this->validate();

        if ($this->tanaman) {
            $this->tanaman->update([
                'nama_tanaman' => $this->nama_tanaman,
                'musim_tanam' => $this->musim_tanam,
            ]);
        }
    }

    /**
     * Hapus data tanaman
     */
    public function delete(): void
    {
        if ($this->tanaman) {
            $this->tanaman->delete();
            $this->reset();
        }
    }

}
