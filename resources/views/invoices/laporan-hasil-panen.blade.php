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
                <th>Nama Tanaman</th>
                <th>Hasil Panen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilPanen as $item)
                <tr>
                    <td class="center">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->tanggal_panen}}</td>
                    <td>{{ $item->petani->nama_petani }}</td>
                    <td>{{ $item->tanaman->nama_tanaman }}</td>
                    <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total -->
    <div class="total">
        {{--  
        <p>Total {{ $label ?? 'data'}}: <strong>{{ $users->count() }}</strong></p>
        --}}
    </div>

    <!-- Tanda Tangan -->
    <!-- <x-signature /> -->
</x-laporan>
