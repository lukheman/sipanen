
@php
    use App\Enums\State;
@endphp
<div class="card my-4">
    <div class="card-header">

@if ($currentState === State::LAPORAN)

<a href="{{ route('print-laporan.petugas')}}" class="btn btn-danger">
    <i class="bi bi-printer"></i>
    Download Laporan
</a>
@else
    <x-datatable.header icon="fa-user" table="Petugas" />
@endif


        <!-- Modal Form Petugas -->
        <div class="modal fade" id="modal-form-petugas" tabindex="-1" wire:ignore.self >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content ">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" >
                            @if ($currentState === \App\Enums\State::CREATE)
                                Tambah Petugas
                            @elseif ($currentState === \App\Enums\State::UPDATE)
                                Perbarui Petugas
                            @elseif ($currentState === \App\Enums\State::SHOW)
                                Detail Petugas
                            @endif
                        </h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form>
    <div class="row">
    <div class="col-md-6 col-12">

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input wire:model="form.nama_petugas" type="text" class="form-control" id="name" placeholder="Masukkan nama" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.nama_petugas')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    </div>
    <div class="col-md-6 col-12">

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input wire:model="form.email" type="email" class="form-control" id="email" placeholder="Masukkan email petugas" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.email')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    </div>
    <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor telepon</label>
                                <input wire:model="form.telepon" type="text" class="form-control" id="telepon" placeholder="Masukkan nomor telepon" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.telepon')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    </div>

    <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input wire:model="form.jabatan" type="text" class="form-control" id="telepon" placeholder="Masukan jabatan petugas" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.jabatan')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
    </div>

                            @if ($currentState !== \App\Enums\State::SHOW)
                            <!-- Kecamatan -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label fw-semibold">Tempat Tugas</label>
                                        <select wire:model.live="form.id_kecamatan" class="form-control" id="kecamatan" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach ($kecamatanList as $item)
                                                <option value="{{ $item->id_kecamatan }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('form.id_kecamatan')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
    @endif

                            @if ($currentState === \App\Enums\State::SHOW)

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label fw-semibold">Tempat Tugas</label>
                                    <input wire:model="kecamatan" type="text" class="form-control" disabled>
                                    </div>
                                </div>

                            @endif
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
                        <th>Nama Petugas</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        @if ($currentState !== State::LAPORAN)
                        <th class="text-end">Aksi</th>
@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->petugas as $item)
                        <tr>
                            <td>{{ $item->nama_petugas }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->email }}</td>
                            @if ($currentState !== State::LAPORAN)
                            <td class="text-end">
                            <x-datatable.actions :id="$item->id_petugas"/>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :items="$this->Petugas" />
        </div>
    </div>
</div>
