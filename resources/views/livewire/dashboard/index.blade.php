@php
    use \App\Enums\Role;
    $role = auth()->user()->role;
@endphp

<div>

    @if(auth('admin')->check())
        <livewire:dashboard.admin-dashboard />
    @elseif(auth('kepala_dinas')->check())
        <livewire:dashboard.kepala-dinas-dashboard />
    @elseif(auth('petugas')->check())
        <livewire:dashboard.petugas-dashboard />
    @endif
</div>
