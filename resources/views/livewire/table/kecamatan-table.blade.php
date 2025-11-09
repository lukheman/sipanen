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
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white">
                        Grafik Hasil Panen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <div class="col-6">

                        <button wire:click="downloadLaporanPanen" class="btn btn-danger">
                            <i class="bi bi-printer"></i> Download Sekarang
                        </button>


                    </div>
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
                                <button wire:click="detail({{ $item->id_kecamatan }})" class="btn btn-danger">
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
                    height: 450,
                    stacked: false
                },
                series: [],
                xaxis: {
                    categories: [],
                    labels: {
                        rotate: -45,
                        rotateAlways: false,
                        trim: true,
                        style: {
                            fontSize: '12px'
                        }
                    },
                    group: {
                        style: {
                            fontSize: '13px',
                            fontWeight: 700
                        },
                        groups: [] // Akan diisi saat update
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '100%', // Lebih ramping, cegah tumpang tindih
                        borderRadius: 6,
                        dataLabels: {
                            position: 'top' // Label di atas batang
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    position: 'top',
                    offsetY: -20, // Jarak dari atas batang
                    style: {
                        colors: ['#304758'],
                        fontWeight: 600,
                        fontSize: '11px' // Ukuran teks lebih kecil
                    },
                    formatter: function(val) {
                        return val > 0 ? val : ''; // Hanya tampilkan nilai
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left'
                },
                colors: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#6610f2'],
                tooltip: {
                    y: {
                        formatter: function(val, opts) {
                            const name = opts.w.config.series[opts.seriesIndex].name;
                            return `${name}: ${val} ton`;
                        }
                    }
                }
            });

            chart.render();

            // Event dari Livewire
            Livewire.on('updateChart', (payload) => {
                const data = payload.data ?? [];
                const years = [...new Set(data.map(i => i.tahun))].sort();
                const grouped = {};

                data.forEach(i => {
                    const name = i.tanaman?.nama_tanaman ?? 'Tidak Diketahui';
                    if (!grouped[name]) grouped[name] = {};
                    grouped[name][i.tahun] = i.total;
                });

                const series = Object.keys(grouped).map(name => ({
                    name,
                    data: years.map(y => grouped[name][y] ?? 0)
                }));

                chart.updateOptions({
                    xaxis: {
                        categories: years,
                        labels: {
                            rotate: -45,
                            rotateAlways: false,
                            trim: true
                        }
                    }
                });
                chart.updateSeries(series);
            });
        });
    </script>
@endpush
