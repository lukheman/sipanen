@php
    use App\Enums\State;
@endphp

<div class="card my-4">
    <div class="card-header">
        @if ($currentState === State::LAPORAN)
            <a href="{{ route('print-laporan.petugas') }}" class="btn btn-danger">
                <i class="bi bi-printer"></i>
                Download Laporan
            </a>
        @else
            <x-datatable.header icon="fa-user" table="Pengguna" />
        @endif

        <!-- Modal Form Pengguna -->
        <div class="modal fade" id="modal-form-pengguna" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white">
                            @if ($currentState === State::CREATE)
                                Tambah Pengguna
                            @elseif ($currentState === State::UPDATE)
                                Perbarui Pengguna
                            @elseif ($currentState === State::SHOW)
                                Detail Pengguna
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input wire:model="form.nama" type="text" class="form-control" id="nama"
                                            placeholder="Masukkan nama pengguna"
                                            @if ($currentState === State::SHOW) disabled @endif>
                                        @error('form.nama')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input wire:model="form.email" type="email" class="form-control"
                                            id="email" placeholder="Masukkan email pengguna"
                                            @if ($currentState === State::SHOW) disabled @endif>
                                        @error('form.email')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Jenis Komoditi</label>

                                        <select wire:model="form.id_kecamatan" class="form-control"
                                            @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach ($this->kecamatanList as $kecamatan)
                                                <option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->nama }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('form.id_kecamatan')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                @if ($currentState === \App\Enums\State::CREATE || $currentState === \App\Enums\State::UPDATE)

                                    <div class="mb-3">
                                        <label for="role" class="form-label fw-semibold">Role</label>
                                        <select wire:model.live="form.role" class="form-select" id="role"
                                            name="role" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                            <option value="">Pilih Role</option>
                                            @foreach (\App\Enums\Role::values() as $role)
                                                <option value="{{ $role }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @elseif($currentState === \App\Enums\State::SHOW)
                                    <div class="mb-3">
                                        <label for="role" class="form-label fw-semibold">Role</label>
                                        <input type="text" class="form-control" id="role"
                                            value="{{ $form->role }}" disabled>
                                    </div>


                                @endif

                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        @if ($currentState === State::CREATE)
                            <button type="button" wire:click="save" class="btn btn-primary">Tambahkan</button>
                        @elseif ($currentState === State::UPDATE)
                            <button type="button" wire:click="save" class="btn btn-primary">Perbarui</button>
                        @endif
                    </div>
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
                        <th>Email</th>
                        <th>Unit Pengguna</th>
                        <th>Role</th>
                        @if ($currentState !== State::LAPORAN)
                            <th class="text-end">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->pengguna as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->kecamatan->nama ?? '-' }}</td>
                            <td><span class="badge bg-{{ $item->role->getColor() }}">{{ $item->role->value }}</span>
                            </td>
                            @if ($currentState !== State::LAPORAN)
                                <td class="text-end">
                                    <x-datatable.actions :id="$item->id" />
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :items="$this->pengguna" />
        </div>
    </div>
</div>
