<?php

namespace App\Livewire\Forms;

use App\Models\HasilPanen;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HasilPanenForm extends Form
{
    public ?HasilPanen $hasilPanen = null;

    public string $tanggal_panen = '';
    public string $jumlah = '';
    public string $satuan = '';
    public ?int $id_tanaman;
    public ?int $id_petani;

    public function rules(): array
    {
        return [
            'tanggal_panen' => ['required', 'date'],
            'jumlah' => ['required', 'string', 'min:1', 'max:100'],
            'satuan' => ['required', 'string', 'max:50'],
            'id_tanaman' => ['required', 'exists:tanaman,id_tanaman'],
            'id_petani' => ['required', 'exists:petani,id_petani'],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_panen.required' => 'Tanggal panen wajib diisi.',
            'tanggal_panen.date' => 'Tanggal panen harus berupa tanggal yang valid.',

            'jumlah.required' => 'Jumlah hasil panen wajib diisi.',
            'jumlah.min' => 'Jumlah hasil panen minimal 1 karakter.',
            'jumlah.max' => 'Jumlah hasil panen maksimal 100 karakter.',

            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.max' => 'Satuan maksimal 50 karakter.',

            'id_tanaman.required' => 'Tanaman wajib dipilih.',
            'id_tanaman.exists' => 'Tanaman tidak ditemukan.',

            'id_petani.required' => 'Petani wajib dipilih.',
            'id_petani.exists' => 'Petani tidak ditemukan.',
        ];
    }

    /**
     * Load data ke form saat edit
     */
    public function fillFromModel(HasilPanen $hasilPanen): void
    {
        $this->hasilPanen = $hasilPanen;
        $this->tanggal_panen = $hasilPanen->tanggal_panen;
        $this->jumlah = $hasilPanen->jumlah;
        $this->satuan = $hasilPanen->satuan;
        $this->id_tanaman = $hasilPanen->id_tanaman;
        $this->id_petani = $hasilPanen->id_petani;
    }

    /**
     * Store data baru
     */
    public function store(): void
    {
        HasilPanen::create($this->validate());
        $this->reset();
    }

    /**
     * Update data hasil panen yang sudah ada
     */
    public function update(): void
    {
        $this->validate();

        if ($this->hasilPanen) {
            $this->hasilPanen->update([
                'tanggal_panen' => $this->tanggal_panen,
                'jumlah' => $this->jumlah,
                'satuan' => $this->satuan,
                'id_tanaman' => $this->id_tanaman,
                'id_petani' => $this->id_petani,
            ]);
        }
    }

    /**
     * Hapus data hasil panen
     */
    public function delete(): void
    {
        if ($this->hasilPanen) {
            $this->hasilPanen->delete();
            $this->reset();
        }
    }
}
