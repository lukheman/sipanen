@php
    use App\Enums\State;
@endphp
<div class="card my-4">
    <div class="card-header">


    @if ($currentState !== State::LAPORAN)
        @if (activeRole() === \App\Enums\Role::ADMIN)
            <x-datatable.header icon="fa-user" table="Tanaman" />
        @else
            <x-datatable.search table="Tanaman"></x-datatable.search>
        @endif
    @elseif($currentState === State::LAPORAN)

    <div class="row">
        <div class="col-6">

            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-form-laporan-hasil-panen-kecamatan">
                <i class="bi bi-printer"></i>
                Download Laporan
            </button>

        </div>
        <div class="col-6">
            <x-datatable.search table="Tanaman"></x-datatable.search>
        </div>
    </div>

    @endif


        <!-- Modal Form Tanaman -->
        <div class="modal fade" id="modal-form-laporan-hasil-panen-kecamatan" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content ">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title text-white">
                            Laporan Hasil Panen
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('print-laporan.hasil-panen-kecamatan') }}" method="POST">
    @csrf
                    <div class="modal-body">

                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select id="kecamatan" class="form-control"  @if ($currentState === \App\Enums\State::SHOW) disabled @endif name="idKecamatan">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($this->kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->id_kecamatan}}">{{ $kecamatan->nama}}</option>
                                    @endforeach
                                </select>

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">

<i class="bi bi-printer"></i>
    Cetak
    </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Form Tanaman -->
        <div class="modal fade" id="modal-form-hasil-panen" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content ">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white">
                            @if ($currentState === \App\Enums\State::CREATE)
                                Tambah Tanaman
                            @elseif ($currentState === \App\Enums\State::UPDATE)
                                Perbarui Tanaman
                            @elseif ($currentState === \App\Enums\State::SHOW)
                                Detail Tanaman
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="nama_tanaman" class="form-label">Nama Tanaman</label>
                                <input wire:model="form.nama_tanaman" type="text" class="form-control" id="nama_tanaman" placeholder="Masukkan nama tanaman" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.nama_tanaman')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        @if ($currentState === \App\Enums\State::CREATE)
                            <button type="button" wire:click="save" class="btn btn-primary">Tambahkan</button>
                        @elseif ($currentState === \App\Enums\State::UPDATE)
                            <button type="button" wire:click="save" class="btn btn-primary">Perbarui</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped   ">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Tanaman</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->tanaman as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->nama_tanaman }}</td>
                            <td class="text-end">
                            @if ($currentState !== State::LAPORAN)
                            <div class="btn-group">

                            <button wire:click="detail({{ $item->id_tanaman }})" class="btn  btn-info text-white">
                            <i class="bi bi-eye"></i>
                            </button>

                            @if (activeRole() === \App\Enums\Role::ADMIN || activeRole() === \App\Enums\Role::PETUGAS)

                            <button wire:click="edit({{ $item->id_tanaman }})" class="btn  btn-warning text-white">
                            <i class="bi bi-pencil"></i>
                             </button>

                            <button wire:click="delete({{ $item->id_tanaman }})" class="btn  btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>

                            @endif
                            </div>
                            @else
                            <a href="{{ route('print-laporan.hasil-panen', ['idTanaman' => $item->id_tanaman]) }}" class="btn btn-danger">
                                <i class="bi bi-printer"></i>
                            </a>

                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :items="$this->tanaman" />
        </div>
    </div>
</div>
