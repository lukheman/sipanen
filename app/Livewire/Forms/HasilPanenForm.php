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
    public ?int $id_tanaman;
    public ?int $id_kecamatan;

    public function rules(): array
    {
        return [
            'tanggal_panen' => ['required', 'date'],
            'jumlah' => ['required', 'numeric'],
            'id_tanaman' => ['required', 'exists:tanaman,id_tanaman'],
            'id_kecamatan' => ['required', 'exists:kecamatan,id_kecamatan']
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_panen.required' => 'Tanggal panen wajib diisi.',
            'tanggal_panen.date' => 'Tanggal panen harus berupa tanggal yang valid.',

            'jumlah.required' => 'Jumlah hasil panen wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka',


            'id_tanaman.required' => 'Tanaman wajib dipilih.',
            'id_tanaman.exists' => 'Tanaman tidak ditemukan.',

            'id_kecamatan.required' => 'Kecamatan wajib dipilih.',
            'id_kecamatan.exists' => 'Kecamatan tidak ditemukan.',

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
        $this->id_tanaman = $hasilPanen->id_tanaman;
        $this->id_kecamatan = $hasilPanen->id_kecamatan;
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
                'id_tanaman' => $this->id_tanaman,
                'id_kecamatan' => $this->id_kecamatan,
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
