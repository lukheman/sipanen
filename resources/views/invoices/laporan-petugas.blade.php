

<x-laporan.index>

    <x-laporan.navbar-download :pdf="$pdf" />

    <!-- KOP SURAT -->
<table style="width:100%; margin-bottom:20px; border-collapse:collapse; border:none;">
    <tr>
        <!-- Logo -->
        <td style="width:100px; text-align:center; vertical-align:middle; border:none;">
            @if ($pdf)
                <img src="{{ storage_path('app/public/img/logo-kolaka.png') }}" style="width:90px; height:auto;">
            @else
                <img src="{{ asset('img/logo-kolaka.png') }}" alt="Logo Kolaka" style="width:90px; height:auto;">
            @endif
        </td>

        <!-- Teks Kop -->
        <td style="text-align:center; vertical-align:middle; border:none;">
            <h4 style="margin:0; font-weight:700;">DINAS PERKEBUNAN DAN PETERNAKAN KABUPATEN KOLAKA</h4>
            <p style="margin:0; font-size:12px;">
                Jl. Badewi No. 75, Kel. Balandete, Kec. Kolaka, Kab. Kolaka 93517
            </p>
        </td>
    </tr>
</table>

        <hr>

    <h5 class="report-title" style="text-align: center;">Laporan Data {{ $label ?? ''}}</h5>

    <p class="report-date">Laporan {{ $label ?? ''}} - {{ date('d F Y')}}</p>

    <!-- Table -->
    <table id="petani">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Email</th>
                <th>Tempat Tugas (Kecamatan)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $item)
                <tr>
                    <td class="center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->nama}}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->kecamatan->nama }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data petugas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        <p>Total {{ $label ?? 'data'}}: <strong>{{ $users->count() }}</strong></p>
    </div>

    <!-- Tanda Tangan -->
    <!-- <x-signature /> -->
</x-laporan.index>
