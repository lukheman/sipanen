<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="">SiPanen</a>
                </div>
                <!-- theme toggle, biarin aja -->
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-md">
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('./assets/compiled/jpg/2.jpg') }}">
                    </div>

                    {{-- tampilkan nama user sesuai guard --}}
                    @if(auth('admin')->check())
                        <p class="font-bold ms-3 mb-0">Admin - {{ auth('admin')->user()->name }}</p>
                    @elseif(auth('petani')->check())
                        <p class="font-bold ms-3 mb-0">Petani - {{ auth('petani')->user()->name }}</p>
                    @elseif(auth('petugas')->check())
                        <p class="font-bold ms-3 mb-0">Petugas - {{ auth('petugas')->user()->nama_petugas }}</p>
                    @elseif(auth('kepala_dinas')->check())
                        <p class="font-bold ms-3 mb-0">Kepala Dinas - {{ auth('kepala_dinas')->user()->name }}</p>
                    @endif
                </div>
                <hr>

                <li class="sidebar-title">Navigasi Utama</li>

                <x-nav-link icon="bi-speedometer2"
                    href="{{ route('dashboard')}}"
                    :active="request()->routeIs('dashboard')">
                    Beranda
                </x-nav-link>

                {{-- ADMIN --}}
                @if(auth('admin')->check())

                    <x-nav-link icon="bi-people-fill"
                        href="{{ route('petani-table')}}"
                        :active="request()->routeIs('petani-table')">
                        Manajemen Pengguna
                    </x-nav-link>

                    <x-nav-link icon="bi-people-fill"
                        href="{{ route('petugas-table')}}"
                        :active="request()->routeIs('petugas-table')">
                        Manajemen Petugas
                    </x-nav-link>

                    <x-nav-link icon="bi-people-fill"
                        href="{{ route('tanaman-table')}}"
                        :active="request()->routeIs('tanaman-table')">
                        Manajemen Tanaman
                    </x-nav-link>

                    <x-nav-link icon="bi-people-fill"
                        href="{{ route('hasil-panen-table')}}"
                        :active="request()->routeIs('hasil-panen-table')">
                        Hasil Panen
                    </x-nav-link>

                    <x-nav-link icon="bi-people-fill"
                        href="{{ route('laporan.petani')}}"
                        :active="request()->routeIs('laporan.petani')">
                        Laporan Petani
                    </x-nav-link>

                    <x-nav-link icon="bi-people-fill"
                        href="{{ route('laporan.petugas')}}"
                        :active="request()->routeIs('laporan.petugas')">
                        Laporan Petugas
                    </x-nav-link>

                    <x-nav-link icon="bi-people-fill"
                        href="{{ route('laporan.hasil-panen')}}"
                        :active="request()->routeIs('laporan.hasil-panen')">
                        Laporan Hasil Panen
                    </x-nav-link>

                @endif


                {{-- PETUGAS --}}
                @if(auth('petugas')->check())
                    <x-nav-link icon="bi-chat-dots-fill"
                        href="{{ route('konsultasi')}}"
                        :active="request()->routeIs('konsultasi')">
                        Daftar Konsultasi
                    </x-nav-link>
                @endif

                {{-- KEPALA DINAS --}}
                @if(auth('kepala_dinas')->check())
                    <x-nav-link icon="bi-clipboard-data"
                        href="{{ route('laporan.petani')}}"
                        :active="request()->routeIs('laporan.petani')">
                        Laporan Petani
                    </x-nav-link>

                @endif

                <li class="sidebar-title">Akun</li>

                <x-nav-link icon="bi-person-circle"
                    href="{{ route('profile')}}"
                    :active="request()->routeIs('profile')">
                    Profil
                </x-nav-link>

                <x-nav-link icon="bi-box-arrow-right"
                    href="{{ route('logout')}}">
                    Keluar
                </x-nav-link>
            </ul>
        </div>
    </div>
</div>
