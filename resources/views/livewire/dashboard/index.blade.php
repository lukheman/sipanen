@php
    use App\Enums\Role;
    $role = getActiveGuard();
@endphp

<div>

    @if ($role === 'admin')
        <livewire:dashboard.admin-dashboard />
    @elseif($role === 'kepala_dinas')
        <livewire:dashboard.kepala-dinas-dashboard />
    @elseif($role === 'petugas')
        <livewire:dashboard.petugas-dashboard />
    @endif

</div>
