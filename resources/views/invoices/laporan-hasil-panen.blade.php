<x-laporan>

    <h5 class="report-title">Laporan Data {{ $label ?? ''}}</h5>

    <p class="report-date">Laporan {{ $label ?? ''}} - {{ date('d F Y')}}</p>

    <!-- Table -->
    <table id="petani">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Panen</th>
                <th>Nama Petani</th>
                <th>Lokasi</th>
                <th>Nama Tanaman</th>
                <th>Hasil Panen</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hasilPanen as $item)
                <tr>
                    <td class="center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->tanggal_panen }}</td>
                    <td>{{ $item->petani->nama_petani }}</td>
                    <td>
                        Desa {{ $item->petani->desa->nama }}
                        - Kecamatan {{ $item->petani->desa->kecamatan->nama }}
                    </td>
                    <td>{{ $item->tanaman->nama_tanaman }}</td>
                    <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data hasil panen.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <!-- <x-signature /> -->
</x-laporan>
