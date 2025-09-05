@props(['icon' => 'fa-plus', 'table'])

<div class="row">
    <div class="col-6">
        <!-- Tombol Modal Form Petani -->
        <button wire:click="add" class="btn btn-primary">
            <i class="fa {{ $icon }}"></i>
            Tambah {{ $table }}
        </button>

    </div>
    <div class="col-6">

        <!-- Pencarian -->
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
            <input  wire:model.live="search" type="text" class="form-control" placeholder="Cari {{ strtolower($table )}}...">
        </div>
    </div>

</div>
