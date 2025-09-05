

<x-laporan>

    <h5 class="report-title">Laporan Data {{ $label ?? ''}}</h5>

    <p class="report-date">Laporan {{ $label ?? ''}} - {{ date('d F Y')}}</p>

    <!-- Table -->
    <table id="petani">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <td class="center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->nama_petugas}}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->telepon }}</td>
                    <td>{{ $item->jabatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        <p>Total {{ $label ?? 'data'}}: <strong>{{ $users->count() }}</strong></p>
    </div>

    <!-- Tanda Tangan -->
    <!-- <x-signature /> -->
</x-laporan>
