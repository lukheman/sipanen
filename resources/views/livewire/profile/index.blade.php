<div>

    @if (auth('kepala_dinas')->check())
        <livewire:profile.kepala_dinas_profile />
    @elseif(auth('admin')->check())
        <livewire:profile.admin_profile />
    @elseif(auth('petugas')->check())
        <livewire:profile.petugas_profile />
    @endif

</div>
