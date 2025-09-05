@php
    use App\Enums\State;
@endphp

<div class="card my-4">
    <div class="card-header">


@if ($currentState === State::LAPORAN)

<a href="{{ route('print-laporan.petugas')}}" class="btn btn-danger" type="submit">
    <i class="bi bi-printer"></i>
    Download Laporan
</a>
@else
    <x-datatable.header icon="fa-user" table="Petani" />
@endif

        <!-- Modal Form Petani -->
        <div class="modal fade" id="modal-form-petani" tabindex="-1" wire:ignore.self >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content ">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" >
                            @if ($currentState === \App\Enums\State::CREATE)
                                Tambah Pengguna
                            @elseif ($currentState === \App\Enums\State::UPDATE)
                                Perbarui Pengguna
                            @elseif ($currentState === \App\Enums\State::SHOW)
                                Detail Pengguna
                            @endif
                        </h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input wire:model="form.nama_petani" type="text" class="form-control" id="name" placeholder="Masukkan nama" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.nama_petani')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor telepon</label>
                                <input wire:model="form.telepon" type="text" class="form-control" id="telepon" placeholder="Masukkan nomor telepon" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.nama_petani')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input wire:model="form.lokasi" type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Jl. Pemuda" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.lokasi')
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
                        <th>Nama Petani</th>
                        <th>Telepon</th>
                        <th>Lokasi</th>
                        @if ($currentState !== State::LAPORAN)
                        <th class="text-end">Aksi</th>
@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->petani as $item)
                        <tr>
                            <td>{{ $item->nama_petani }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->lokasi }}</td>
                            @if ($currentState !== State::LAPORAN)
                            <td class="text-end">
                            <x-datatable.actions :id="$item->id_petani"/>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :items="$this->petani" />
        </div>
    </div>
</div>
