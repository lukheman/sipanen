@php
    use App\Enums\State;
@endphp
<div class="card my-4">
    <div class="card-header">


    @if ($currentState !== State::LAPORAN)
        <x-datatable.header icon="fa-user" table="Tanaman" />
    @elseif($currentState === State::LAPORAN)

    <div class="raw">
    <div class="col-6 float-end">
        <x-datatable.search table="Tanaman"></x-datatable.search>
    </div>
    </div>

    @endif


        <!-- Modal Form Tanaman -->
        <div class="modal fade" id="modal-form-tanaman" tabindex="-1" wire:ignore.self>
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

                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis</label>
                                <input wire:model="form.jenis" type="text" class="form-control" id="jenis" placeholder="Masukkan jenis tanaman" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.jenis')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="musim_tanam" class="form-label">Musim Tanam</label>
                                <input wire:model="form.musim_tanam" type="text" class="form-control" id="musim_tanam" name="musim_tanam" placeholder="Contoh: Musim Hujan" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.musim_tanam')
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
                        <th>Nama Tanaman</th>
                        <th>Jenis</th>
                        <th>Musim Tanam</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->tanaman as $item)
                        <tr>
                            <td>{{ $item->nama_tanaman }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->musim_tanam }}</td>
                            <td class="text-end">
                            @if ($currentState !== State::LAPORAN)
                                <x-datatable.actions :id="$item->id_tanaman"/>
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
