@php
    use App\Enums\State;
    use App\Enums\Role;
    $role = activeRole();

@endphp

<div>

    <div class="card my-4">
        <div class="card-header">



            <div class="row gy-3">


                <!-- Kiri -->
                <div class="col-12 col-md-3">
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
                        <input type="text" class="form-control" wire:model.live="tahun" style="width: 100px;">

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
                                                disabled>
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


                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="mb-3">
                                            <label for="jumlah" class="form-label">Jumlah Produksi (Kg)</label>
                                            <input wire:model="form.jumlah" type="number" class="form-control"
                                                id="jumlah" placeholder="Masukkan jumlah hasil panen" disabled>
                                            @error('form.jumlah')
                                                <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
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
                            <th>Tanggal input data</th>
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
                                    <td>{{ $item->created_at }}</td>
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
