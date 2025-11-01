<x-laporan.index>

    @if (!$pdf)

    <!-- Navbar dengan tombol download PDF -->
    <div class="navbar" style="margin-bottom:16px;">
        <form action="{{ route('laporan.panen.pdf') }}" method="POST" id="form-pdf">
            @csrf
            <input type="hidden" name="id_tanaman" value="{{ $tanaman->id_tanaman }}">
            <input type="hidden" name="id_kecamatan" value="{{ $id_kecamatan ?? 'all' }}">
            <input type="hidden" name="chart_image" id="chart_image">
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-printer"></i> Download PDF
            </button>
        </form>
    </div>

    @endif

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

    <!-- Judul Laporan -->
    <h5 class="report-title text-center" style="text-align: center;">Laporan Hasil Panen</h5>

    <p class="report-date">

        @if (!$pdf)
            <div class="d-grid" style="grid-template-columns: auto 2fr; column-gap: 8px; font-weight: bold;">
                <span>KOMODIDIT</span><span>: {{ $tanaman->nama_tanaman ?? '-' }}</span>
                <span>KECAMATAN</span><span>:{{ $namaKecamatan ?? '-' }}</span>
                <span>TANGGAL</span><span>:{{ date('d F Y') }}</span>
            </div>
        @else
<p><strong>KOMODITI:</strong> {{ $tanaman->nama_tanaman ?? '-' }}</p>
<p><strong>KECAMATAN:</strong> {{ $namaKecamatan ?? '-' }}</p>
<p><strong>TANGGAL:</strong> {{ date('d F Y') }}</p>
        @endif


    </p>

    <!-- Chart Hasil Panen per Tahun -->
    <div style="border:1px solid #ddd; border-radius:12px; padding:16px; margin-bottom:20px;">
        <h5 style="margin:0 0 12px 0; font-size:1rem; font-weight:600; color:#333;">
            Grafik Total Panen per Tahun
        </h5>
        @if (!empty($chartPath))
            <div style="text-align:center; margin:20px 0;">
                <img src="{{ storage_path('app/public/' . $chartPath) }}" style="width:500px; height:auto;">
            </div>
        @else
            <div id="chartHasilPanen"></div>
        @endif
    </div>

    <!-- Table Hasil Panen per Kecamatan -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align:center;">No</th>
                <th>Kecamatan</th>
                <th>Total Panen (Kg)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hasilPanenRaw as $item)
                <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->kecamatan->nama ?? '-' }}</td>
                    <td>{{ $item->total ?? $item->jumlah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center;">Tidak ada data hasil panen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Chart Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chartData = @json(array_column($hasilPanen, 'total'));
            const chartLabels = @json(array_column($hasilPanen, 'tahun'));

            if (chartData.length === 0 || chartLabels.length === 0) return;

            const options = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Total Panen (Kg)',
                    data: chartData
                }],
                xaxis: {
                    categories: chartLabels
                },
                colors: ['#4CAF50'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: false
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => val + " Kg"
                },
                tooltip: {
                    y: {
                        formatter: val => val + " Kg"
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#chartHasilPanen"), options);
            chart.render().then(() => {
                // Ambil chart base64 untuk PDF
                setTimeout(() => {
                    chart.dataURI().then(({
                        imgURI
                    }) => {
                        const chartInput = document.getElementById("chart_image");
                        if (chartInput) chartInput.value = imgURI;
                    });
                }, 1000);
            });
        });
    </script>

</x-laporan.index>
