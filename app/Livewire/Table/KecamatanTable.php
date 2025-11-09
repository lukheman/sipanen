<?php

namespace App\Livewire\Table;

use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Traits\Traits\WithModal;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Kecamatan')]
class KecamatanTable extends Component
{
    use WithModal;
    use WithPagination;

    public string $search = '';

    public ?int $selectedKecamatanId = null;

    public function downloadLaporanPanen() {
        // Redirect ke route preview (akan tampilkan view + tombol download PDF)
        return redirect()->route('print-laporan.hasil-panen-kecamatan', [
            'idKecamatan' => $this->selectedKecamatanId
        ]);

    }

    #[Computed]
    public function kecamatanList()
    {
        return Kecamatan::query()
            ->when($this->search, fn ($q) => $q->where('nama', 'like', "%{$this->search}%"))
            ->paginate(10);
    }

    #[Computed]
    public function dataHasilPanen()
    {
        return HasilPanen::select(
            'id_tanaman',
            'tahun',
            DB::raw('SUM(jumlah) as total')
        )
            ->with(['tanaman:id_tanaman,nama_tanaman', 'kecamatan:id_kecamatan,nama'])
            ->when($this->selectedKecamatanId, function ($query) {
                $query->where('id_kecamatan', $this->selectedKecamatanId);
            })
            ->groupBy('id_tanaman', 'tahun')
            ->orderBy('tahun', 'asc')
            ->get();
    }

    public function detail($id)
    {
        $this->selectedKecamatanId = $id;
        $this->dispatch('updateChart', data: $this->dataHasilPanen);
        $this->openModal('modal-grafik-hasil-panen');

    }

    public function render()
    {
        return view('livewire.table.kecamatan-table');
    }
}
