<div Penggunaclass="card card-primary">
    <div class="card-header">

        <button wire:click="add" class="btn btn-primary">
            <i class="fa fa-user-plus"></i>
            Tambah Pengguna
        </button>
    </div>
    <div class="card-body">


        <div class="table-responsive">
            <table class="table table-striped   ">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td class="font-weight-bold">{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td><span class="badge badge-{{ $item->role->getColor() }}">{{ $item->role }}</span></td>
                            <td class="text-right">
                                <button wire:click="detail({{ $item->id }}, '{{ $item->role }}')" class="btn btn-sm btn-info">Lihat</button>
                                <button wire:click="edit({{ $item->id }}, '{{ $item->role }}')" class="btn btn-sm btn-warning">Edit</button>
                                <button wire:click="delete({{ $item->id }} , '{{ $item->role }}')" class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :items="$users" />
        </div>
    </div>
</div>

@push('modals')

        <div class="modal fade" id="modal-form-pengguna" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content shadow-lg rounded">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" id="myModalLabel1">
                            @if ($currentState === \App\Enums\State::CREATE)
                                Tambah Pengguna
                            @elseif ($currentState === \App\Enums\State::UPDATE)
                                Perbarui Pengguna
                            @elseif ($currentState === \App\Enums\State::SHOW)
                                Detail Pengguna
                            @endif
                        </h5>
                        <button type="button" class="close" wire:click="$dispatch('closeModal', {id: 'modal-form-pengguna'})">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Nama</label>
                                <input wire:model="form.nama_petani" type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.nama_petani')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input wire:model="form.email" type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.email')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            @if ($currentState === \App\Enums\State::SHOW)
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kecamatan" class="font-weight-bold">Kecamatan</label>
                                        <input wire:model="selectedKecamatan" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="desa" class="font-weight-bold">Desa</label>
                                        <input wire:model="selectedDesa" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if ($currentState !== \App\Enums\State::SHOW)
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="kecamatan" class="font-weight-bold">Kecamatan</label>
                                        <select wire:model.live="kecamatan" class="form-control" id="kecamatan">
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach ($kecamatanList as $item)
                                                <option value="{{ $item->id_kecamatan }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="desa" class="font-weight-bold">Desa</label>
                                        <select wire:model.live="form.id_desa" class="form-control" id="desa">
                                            <option value="">Pilih Desa</option>
                                            @foreach ($desaList as $item)
                                                <option value="{{ $item->id_desa }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('form.id_desa')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="alamat" class="font-weight-bold">Alamat</label>
                                <input wire:model="form.alamat" type="text" class="form-control" id="alamat" name="alamat" placeholder="Contoh: Jl. Pemuda" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                @error('form.alamat')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            @if ($currentState === \App\Enums\State::CREATE)
                            <div class="form-group">
                                <label for="role" class="font-weight-bold">Role</label>
                                <select wire:model="type" class="form-control" id="role" name="role">
                                    <option value="">Pilih Role</option>
                                    @foreach (\App\Enums\Role::values() as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="telepon" class="font-weight-bold">Telepon</label>
                                        <input wire:model="form.telepon" type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                        @error('form.telepon')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="font-weight-bold">Tanggal Lahir</label>
                                        <input wire:model="form.tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                        @error('form.tanggal_lahir')
                                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
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

@endpush
