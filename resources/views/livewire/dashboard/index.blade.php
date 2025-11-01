@php
    use App\Enums\Role;
    $role = activeRole();
@endphp

<div>

    @if ($role === Role::ADMIN)
        <livewire:dashboard.admin-dashboard />
    @elseif($role === Role::KEPALADINAS)
        <livewire:dashboard.kepala-dinas-dashboard />
    @elseif($role === Role::PETUGAS)
        <livewire:dashboard.petugas-dashboard />
    @endif

</div>
