<?php

namespace App\Livewire\Laporan;

use App\Enums\State;
use App\Livewire\Forms\HasilPanenForm;
use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Tanaman;
use App\Traits\Traits\WithModal;
use App\Traits\WithNotify;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Laporan Hasil Panen')]
class LaporanDataHasilPanen extends Component
{
    use WithModal;
    use WithNotify;
    use WithPagination;

    public ?HasilPanenForm $form;

    // filter
    public ?int $tahun;

    public $kecamatan = 'all';

    public $tanaman = 'all';

    public $selectedKecamatan;

    public $currentState = State::SHOW;

    public $grafikLabels = [];

    public $grafikData = [];

    public $grafikKecamatan = 'all';

    public $grafikTanaman;

    public function mount()
    {
        $this->tahun = date('Y');
    }

    public function downloadLaporanPanen()
    {
        $idTanaman = $this->grafikTanaman->id_tanaman ?? 'all';
        $idKecamatan = $this->grafikKecamatan ?? 'all';

        // Redirect ke route cetak PDF
        return redirect()->route('print-laporan.hasil-panen', [
            'idTanaman' => $idTanaman,
            'idKecamatan' => $idKecamatan
        ]);
    }

    public function showHasilPanenGrafik($idTanaman)
    {
        $this->grafikKecamatan = 'all';
        $this->grafikTanaman = Tanaman::findOrFail($idTanaman);


        // Ambil dan kirim data ke grafik
        $this->updateGrafikData();

        $this->closeModal('modal-download');
        $this->openModal('modal-chart');
    }

    public function updatedGrafikKecamatan($idKecamatan)
    {
        $this->grafikKecamatan = $idKecamatan;

        // Perbarui data grafik berdasarkan kecamatan yang dipilih
        $this->updateGrafikData();
    }

    private function updateGrafikData()
    {
        $idTanaman = $this->grafikTanaman->id_tanaman;

        // Ambil data hasil panen sesuai tanaman dan kecamatan (jika bukan 'all')
        $hasilPanen = HasilPanen::selectRaw('tahun, SUM(jumlah) as total')
            ->where('id_tanaman', $idTanaman)
            ->when($this->grafikKecamatan !== 'all', function ($query) {
                $query->where('id_kecamatan', $this->grafikKecamatan);
            })
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun'); // hasil: [2022 => 150, 2023 => 200]

        // Ambil semua tahun unik untuk tanaman ini (agar tahun tanpa data tetap muncul)
        $semuaTahun = HasilPanen::where('id_tanaman', $idTanaman)
            ->distinct()
            ->orderBy('tahun')
            ->pluck('tahun')
            ->toArray();

        // Pastikan setiap tahun ada, isi 0 jika tidak ada totalnya
        $dataLengkap = collect($semuaTahun)->map(function ($tahun) use ($hasilPanen) {
            return [
                'tahun' => (int) $tahun,
                'total' => (float) ($hasilPanen[$tahun] ?? 0),
            ];
        })->values()->toArray();

        // kirim event JS
        $this->dispatch('updateChart', data: $dataLengkap, namaTanaman: $this->grafikTanaman->nama_tanaman);
    }

    public function detail($id)
    {

        $hasil_panen = HasilPanen::with('kecamatan')->findOrFail($id);

        $this->selectedKecamatan = $hasil_panen->kecamatan->nama;
        $this->form->fillFromModel($hasil_panen);
        $this->openModal('modal-form-hasil-panen');

    }

    public function edit(int $id)
    {
        $this->detail($id);
        $this->currentState = State::UPDATE;
    }

    public function save()
    {

        if ($this->currentState === State::CREATE) {

            $this->form->id_kecamatan = $this->user->kecamatan->id_kecamatan;

            $this->form->store();
            $this->notifySuccess('Hasil panen berhasil ditambahkan!');
        } elseif ($this->currentState === State::UPDATE) {
            $this->form->update();
            $this->notifySuccess('Hasil panen berhasil diperbarui!');
        }

        $this->closeModal('modal-form-hasil-panen');

    }

    public function delete(int $id)
    {

        $this->form->hasilPanen = HasilPanen::findOrFail($id);

        $this->dispatch('deleteConfirmation', message: 'Yakin untuk menghapus hasil panen ini?');
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        try {
            $this->form->delete();
            $this->notifySuccess('Hasil panen berhasil dihapus!');
        } catch (\Exception $e) {
            $this->notifyError('Gagal menghapus hasil panen: '.$e->getMessage());
        }
    }

    #[Computed]
    public function hasilPanen()
    {
        $query = HasilPanen::with(['tanaman', 'kecamatan'])
            ->where('tahun', $this->tahun)

            // Filter tanaman (jika bukan 'all')
            ->when($this->tanaman !== 'all', function ($query) {
                $query->where('id_tanaman', $this->tanaman);
            })

            // Filter kecamatan (jika bukan 'all')
            ->when($this->kecamatan !== 'all', function ($query) {
                $query->where('id_kecamatan', $this->kecamatan);
            });

        return $query->latest()->paginate(10);
    }

    #[Computed]
    public function tanamanList()
    {
        return Tanaman::all();
    }

    #[Computed]
    public function kecamatanList()
    {
        return Kecamatan::all();
    }

    public function render()
    {
        return view('livewire.laporan.laporan-data-hasil-panen');
    }
}
