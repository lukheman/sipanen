@php
    use App\Enums\State;
@endphp

<div class="card my-4">
    <div class="card-header">
            <x-datatable.header icon="fa-user" table="Kecamatan" :is_add="false" />

    </div>

    <!-- Modal Form Pengguna -->
    <div class="modal fade" id="modal-grafik-hasil-panen" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white">
                       Grafik Hasil Panen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <div id="chart"></div>
                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->kecamatanList as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-end">
<button wire:click="detail({{ $item->id_kecamatan }})" class="btn btn-info">
    <i class="bi bi-graph-up"></i>
</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :items="$this->kecamatanList" />
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("livewire:init", () => {
        let chart = null;
        const el = document.querySelector("#chart");

        if (!el) return;

        // Inisialisasi chart kosong dulu
        chart = new ApexCharts(el, {
            chart: { type: 'bar', height: 350 },
            series: [{ name: 'Jumlah Data Panen', data: [] }],
            xaxis: { categories: [] },
            plotOptions: {
                bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' }
            },
            dataLabels: { enabled: true },
            colors: ['#0d6efd']
        });
        chart.render();

        // Dengarkan event dari Livewire
        Livewire.on('updateChart', (payload) => {
            const data = payload.data ?? [];
            const totals = data.map(i => i.total);
            const labels = data.map(i => i.tanaman?.nama_tanaman ?? 'Tidak Diketahui');

            chart.updateOptions({
                xaxis: { categories: labels }
            });
            chart.updateSeries([{
                name: 'Jumlah Data Panen',
                data: totals
            }]);
        });
    });
</script>
@endpush
