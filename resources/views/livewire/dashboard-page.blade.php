@php
    use \App\Enums\Role;
    $role = auth()->user()->role;
@endphp

<div>
    <x-flash-message />

    @if(auth('admin')->check())
        <livewire:admin-dashboard />
    @elseif(auth('penyuluh')->check())
        <livewire:ahli-pertanian-dashboard />
    @elseif(auth('kepala_dinas')->check())
        <livewire:kepala-dinas-dashboard />
    @endif
</div>
