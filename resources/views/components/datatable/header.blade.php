@props(['icon' => 'fa-plus', 'table', 'is_add' => true])

<div class="row">


    <div class="col-6">
    @if ($is_add)
        <!-- Tombol Modal Form Petani -->
        <button wire:click="add" class="btn btn-primary">
            <i class="fa {{ $icon }}"></i>
            Tambah {{ $table }}
        </button>

    @endif
    </div>


    <div class="col-6">

        <x-datatable.search :table="$table"></x-datatable.search>

    </div>

</div>
