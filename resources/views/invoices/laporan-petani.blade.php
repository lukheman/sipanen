

<x-laporan.index>

    <x-laporan.navbar-download :pdf="$pdf" />

    <h5 class="report-title">Laporan Data {{ $label ?? ''}}</h5>

    <p class="report-date">Laporan {{ $label ?? ''}} - {{ date('d F Y')}}</p>

    <!-- Table -->
    <table id="petani">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Petani</th>
                <th>Telepon</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $item)
                <tr>
                    <td class="center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->nama_petani }}</td>
                    <td>{{ $item->telepon }}</td>
                    <td>{{ $item->lokasi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada data petani.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        <p>Total {{ $label ?? 'data'}}: <strong>{{ $users->count() }}</strong></p>
    </div>

</x-laporan.index>
