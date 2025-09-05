@props(['id'])
<button wire:click="detail({{ $id }})" class="btn btn-sm btn-info text-white">Detail</button>
<button wire:click="edit({{ $id }})" class="btn btn-sm btn-warning text-white">Edit</button>
<button wire:click="delete({{ $id }})" class="btn btn-sm btn-danger">Hapus</button>
