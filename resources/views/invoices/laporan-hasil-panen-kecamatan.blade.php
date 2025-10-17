<x-laporan.index>

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

    <h5 class="report-title text-center" style="text-align: center;">
        Laporan {{ $label ?? '' }}
    </h5>
    <p class="report-date">
        <strong>Kecamatan:</strong> {{ $kecamatan->nama}}
    </p>

    <!-- Table Data Hasil Panen -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tanaman</th>
                <th style="text-align: end;">Total Produksi (Kg)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hasilPanenPerTanaman as $item)
                <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->tanaman->nama_tanaman ?? '-' }}</td>
                    <td style="text-align:end;">{{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center;">Tidak ada data hasil panen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br><br>

    <!-- Chart Total Hasil Panen per Tanaman -->
    <div style="border:1px solid #ddd; border-radius:12px; padding:16px; margin-bottom:20px;">
        <h5 style="margin:0 0 12px 0; font-size:1rem; font-weight:600; color:#333;">
            Grafik Total Hasil Panen Tiap Tanaman di Kecamatan {{ ucfirst($kecamatan->nama_kecamatan) }}
        </h5>

        @if(!empty($chartPath))
            <div style="text-align:center; margin:20px 0;">
                <img src="{{ storage_path('app/public/' . $chartPath) }}" style="width:500px; height:auto;">
            </div>
        @else
            <div id="chartHasilPanen"></div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chartData = @json($hasilPanenPerTanaman);
            var options = {
                chart: { type: 'bar', height: 400 },
                series: [{
                    name: 'Total Panen',
                    data: chartData.map(item => item.total)
                }],
                xaxis: {
                    categories: chartData.map(item => item.tanaman.nama_tanaman),
                    title: { text: 'Tanaman' }
                },
                yaxis: {
                    title: { text: 'Jumlah Produksi (Kg)' }
                },
                colors: ['#28a745'],
                plotOptions: {
                    bar: { borderRadius: 6, horizontal: false, columnWidth: '55%' }
                },
                dataLabels: { enabled: true }
            };
            var chart = new ApexCharts(document.querySelector("#chartHasilPanen"), options);
            chart.render().then(() => {
                setTimeout(() => {
                    chart.dataURI().then(({ imgURI }) => {
                        document.getElementById("chart_image").value = imgURI;
                    });
                }, 2000);
            });
        });
    </script>
</x-laporan.index>
