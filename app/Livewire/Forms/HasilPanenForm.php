<?php

namespace App\Livewire\Forms;

use App\Models\HasilPanen;
use Livewire\Form;

class HasilPanenForm extends Form
{
    public ?HasilPanen $hasilPanen = null;

    public string $jumlah = '';

    public ?int $tahun = null;

    public ?int $id_tanaman = null;

    public ?int $id_kecamatan = null;

    public function rules(): array
    {
        return [
            'jumlah' => ['required', 'numeric'],
            'tahun' => ['required', 'digits:4', 'integer', 'min:2000', 'max:'.date('Y') + 1],
            'id_tanaman' => ['required', 'exists:tanaman,id_tanaman'],
            'id_kecamatan' => ['required', 'exists:kecamatan,id_kecamatan'],
        ];
    }

    public function messages(): array
    {
        return [
            'jumlah.required' => 'Jumlah hasil panen wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',

            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.digits' => 'Tahun harus terdiri dari 4 angka.',
            'tahun.integer' => 'Tahun harus berupa angka.',
            'tahun.min' => 'Tahun minimal 2000.',
            'tahun.max' => 'Tahun tidak boleh melebihi tahun sekarang.',

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
        $this->jumlah = $hasilPanen->jumlah;
        $this->tahun = $hasilPanen->tahun;
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
                'jumlah' => $this->jumlah,
                'tahun' => $this->tahun,
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
