@php
    use App\Enums\State;
    use App\Enums\Role;
    $role = activeRole();

@endphp

<div>

    <!-- modal chart -->
    <div class="modal fade" id="modal-chart" tabindex="-1" wire:ignore>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white">
                        Grafik Hasil Panen Tanaman {{ $grafikTanaman->nama_tanaman ?? '' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" wire.ignore.self>

                    <div class="row">

                        <div class="col-6">

                            <button wire:click="downloadLaporanPanen" class="btn btn-danger">
                                <i class="bi bi-printer"></i> Download Sekarang
                            </button>


                        </div>

                        <div class="col-6">

                            <div class="input-group flex-nowrap">
                                <span class="input-group-text text-truncate">
                                    Kecamatan
                                </span>
                                <select class="form-control" wire:model.live="grafikKecamatan">
                                    <option value="all">Semua</option>
                                    @foreach ($this->kecamatanList as $kecamatan)
                                        <option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->nama }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>


                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal download -->
    <div class="modal fade" id="modal-download" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title text-white">
                        Download Laporan Hasil Panen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Komoditi</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->tanamanList as $tanaman)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $tanaman->nama_tanaman }}</td>

                                    <td class="text-end">

                                        <button wire:click="showHasilPanenGrafik({{ $tanaman->id_tanaman }})"
                                            class="btn  btn-info text-white">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- <div class="modal-footer"> -->
                <!--     <button type="button" wire:click="save" class="btn btn-primary">Perbarui</button> -->
                <!-- </div> -->
            </div>
        </div>
    </div>

    <div class="card my-4">
        <div class="card-header">



            <div class="row gy-3">


                <!-- Kiri -->
                <div class="col-12 col-md-3">

                    <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                        data-bs-target="#modal-download">
                        <i class="bi bi-printer"></i>
                        Download Laporan
                    </button>


                </div>
                <!-- Kiri -->
                <div class="col-12 col-md-3">

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-truncate">
                            Tanaman
                        </span>
                        <select class="form-control" wire:model.live="tanaman">
                            <option value="all">Semua</option>
                            @foreach ($this->tanamanList as $tanaman)
                                <option value="{{ $tanaman->id_tanaman }}">{{ $tanaman->nama_tanaman }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-12 col-md-3">

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-truncate">
                            Kecamatan
                        </span>
                        <select class="form-control" wire:model.live="kecamatan">
                            <option value="all">Semua</option>
                            @foreach ($this->kecamatanList as $kecamatan)
                                <option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->nama }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <!-- Kanan -->
                <div class="col-12 col-md-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-truncate">
                            Tahun
                        </span>

                        <select class="form-control" wire:model.live="tahun">
                            <option value="">Pilih Tahun</option>
                            @for ($i = 2020; $i <= now()->year; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                    </div>
                </div>
            </div>


            <!-- Modal Form Hasil Panen -->
            <div class="modal fade" id="modal-form-hasil-panen" tabindex="-1" wire:ignore.self>
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title text-white">
                                Detail Hasil Panen
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="mb-3">
                                            <label for="tanaman" class="form-label">Jenis Komoditi</label>

                                            <select wire:model="form.id_tanaman" id="tanaman" class="form-control"
                                                @if ($currentState === State::SHOW) disabled @endif>
                                                <option value="">Jenis Komoditas</option>
                                                @foreach ($this->tanamanList as $tanaman)
                                                    <option value="{{ $tanaman->id_tanaman }}">
                                                        {{ $tanaman->nama_tanaman }}</option>
                                                @endforeach
                                            </select>

                                            @error('form.id_tanaman')
                                                <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah Produksi (Kg)</label>
                                    <input wire:model="form.jumlah" type="number" class="form-control"
                                        id="jumlah" placeholder="Masukkan jumlah hasil panen"
                                        @if ($currentState === State::SHOW) disabled @endif>
                                    @error('form.jumlah')
                                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>

                                    <select class="form-control" wire:model.live="form.id_kecamatan"
                                        @if ($currentState === State::SHOW) disabled @endif>
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach ($this->kecamatanList as $kecamatan)
                                            <option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="save" class="btn btn-primary">Perbarui</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Jenis Komoditi</th>
                            <th>Jumlah Produksi</th>
                            <th>Kecamatan</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($this->hasilPanen->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data hasil panen.</td>
                            </tr>
                        @else
                            @foreach ($this->hasilPanen as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->tanaman->nama_tanaman }}</td>
                                    <td>{{ $item->jumlah }} Kg</td>
                                    <td>{{ $item->kecamatan->nama }}</td>
                                    <td class="text-end">

                                        @if ($role === Role::ADMIN)
                                            <x-datatable.actions :id="$item->id_hasil_panen" />
                                        @elseif($role === Role::KEPALADINAS)
                                            <div class="btn-group">

                                                <button wire:click="detail({{ $item->id_hasil_panen }})"
                                                    class="btn  btn-info text-white">
                                                    <i class="bi bi-eye"></i>
                                                </button>

                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <x-pagination :items="$this->hasilPanen" />
            </div>
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
                    height: 400
                },
                series: [],
                xaxis: {
                    categories: [],
                    title: {
                        text: 'Tahun',
                        style: {
                            fontSize: '14px',
                            fontWeight: 600
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Total Hasil Panen (Kg)',
                        style: {
                            fontSize: '14px',
                            fontWeight: 600
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '60%',
                        borderRadius: 6
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => val + " Kg",
                    style: {
                        fontSize: '12px',
                        colors: ['#000']
                    }
                },
                colors: ['#0d6efd']
            });

            chart.render();

            Livewire.on('updateChart', (payload) => {

                const data = payload.data ?? [];

                // Ambil tahun dan total panen
                const years = data.map(i => i.tahun);
                const values = data.map(i => i.total_panen ?? i.total);

                chart.updateOptions({
                    title: {
                        text: `Grafik Hasil Panen: ${payload.namaTanaman}`,
                        align: 'center',
                        style: {
                            fontSize: '16px',
                            fontWeight: 'bold'
                        }
                    },
                    xaxis: {
                        categories: years,
                        title: {
                            text: 'Tahun',
                            style: {
                                fontWeight: 600
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total Panen (Kg)',
                            style: {
                                fontWeight: 600
                            }
                        }
                    }
                });

                chart.updateSeries([{
                    name: 'Total Panen (Kg)',
                    data: values
                }]);
            });
        });
    </script>
@endpush
