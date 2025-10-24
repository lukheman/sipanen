@php
use App\Enums\State;
use App\Enums\Role;
$role = activeRole();

@endphp

<div>

<div class="alert alert-secondary">
  <div class="d-grid" style="grid-template-columns: auto 1fr; column-gap: 8px;">
    <span>Kecamatan</span><span>: {{ $user->kecamatan->nama }}</span>
    <span>Kabupaten</span><span>: Kolaka</span>
    <span>Provinsi</span><span>: Sulawesi Tenggara</span>
    <span>Tahun</span><span>: {{ date('Y')}}</span>
  </div>
</div>


<div class="card my-4">
    <div class="card-header">


@if ($currentState === State::LAPORAN)

<a href="{{ route('print-laporan.hasil-panen')}}" class="btn btn-danger" type="submit">
    <i class="bi bi-printer"></i>
    Download Laporan
</a>
@else
    <x-datatable.header icon="fa-user" table="Hasil Panen" />
@endif


        <!-- Modal Form Hasil Panen -->
        <div class="modal fade" id="modal-form-hasil-panen" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white">
                            @if ($currentState === \App\Enums\State::CREATE)
                                Tambah Hasil Panen
                            @elseif ($currentState === \App\Enums\State::UPDATE)
                                Perbarui Hasil Panen
                            @elseif ($currentState === \App\Enums\State::SHOW)
                                Detail Hasil Panen
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="row">
                                <div class="col-md-12">

                                <div class="mb-3">
                                    <label for="tanaman" class="form-label">Jenis Komoditi</label>

                                    <select wire:model="form.id_tanaman" id="tanaman" class="form-control"  @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
                                        <option value="">Jenis Komoditas</option>
                                        @foreach ($this->tanamanList as $tanaman)
                                        <option value="{{ $tanaman->id_tanaman}}">{{ $tanaman->nama_tanaman}}</option>
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
                                <input wire:model="form.jumlah" type="number" class="form-control" id="jumlah" placeholder="Masukkan jumlah hasil panen" @if ($currentState === \App\Enums\State::SHOW) disabled @endif>
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
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal input data</th>
                        <th>Jenis Komoditi</th>
                        <th>Jumlah Produksi</th>
                        @if ($currentState !== State::LAPORAN)
                        <th class="text-end">Aksi</th>
@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->hasilPanen as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->tanaman->nama_tanaman}}</td>
                            <td>{{ $item->jumlah }} Kg</td>
                        @if ($currentState !== State::LAPORAN)
                            <td class="text-end">
                            @if ($role === Role::PETUGAS)

<button wire:click="delete({{ $item->id_hasil_panen }})" class="btn  btn-danger">
    <i class="bi bi-trash"></i>
</button>
                            @else
                            <x-datatable.actions :id="$item->id_hasil_panen"/>

                            @endif
                            </td>

                        @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :items="$this->hasilPanen" />
        </div>
    </div>
</div>
</div>
