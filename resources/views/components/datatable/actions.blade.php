@props(['id'])

<div class="btn-group">

    <button wire:click="detail({{ $id }})" class="btn  btn-info text-white">
        <i class="bi bi-eye"></i>
    </button>

    <button wire:click="edit({{ $id }})" class="btn  btn-warning text-white">
        <i class="bi bi-pencil"></i>
    </button>

    <button wire:click="delete({{ $id }})" class="btn  btn-danger">
        <i class="bi bi-trash"></i>
    </button>
</div>
