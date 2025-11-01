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

            chart = new ApexCharts(el, {
                chart: {
                    type: 'bar',
                    height: 400,
                    stacked: false
                },
                series: [],
                xaxis: {
                    categories: []
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%', // batang lebih besar
                        endingShape: 'rounded',
                        borderRadius: 6,
                        dataLabels: {
                            position: 'center'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#000'], // angka di batang berwarna hitam
                        fontWeight: 600
                    },
                    formatter: function(val, opts) {
                        // Jangan tampilkan kalau 0
                        if (val === 0) return '';

                        // Ambil nama tanaman dari series
                        const name = opts.w.config.series[opts.seriesIndex].name;
                        return `${name}: ${val}`;
                    }
                },
                legend: {
                    position: 'top'
                },
                colors: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#6610f2'],
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " ton"; // tampilkan satuan di tooltip
                        }
                    }
                }
            });

            chart.render();

            // Event dari Livewire
            Livewire.on('updateChart', (payload) => {
                const data = payload.data ?? [];

                // Ambil daftar tahun unik
                const years = [...new Set(data.map(i => i.tahun))].sort();

                // Kelompokkan data berdasarkan tanaman
                const grouped = {};
                data.forEach(i => {
                    const name = i.tanaman?.nama_tanaman ?? 'Tidak Diketahui';
                    if (!grouped[name]) grouped[name] = {};
                    grouped[name][i.tahun] = i.total;
                });

                // Bentuk series untuk ApexCharts
                const series = Object.keys(grouped).map(name => ({
                    name,
                    data: years.map(y => grouped[name][y] ?? 0)
                }));

                chart.updateOptions({
                    xaxis: {
                        categories: years
                    }
                });
                chart.updateSeries(series);
            });
        });
    </script>
@endpush
