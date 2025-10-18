<x-laporan.index>
    <x-laporan.navbar-download :pdf="$pdf ?? null"  :id_tanaman="$tanaman->id_tanaman"/>

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

    <h5 class="report-title text-center" style="text-align: center;">Laporan {{ $label ?? '' }}</h5>
    <p class="report-date">

  <div class="d-grid" style="grid-template-columns: auto 1fr; column-gap: 8px; font-weight: bold;">
    <span>KABUPATEN</span><span>: KOLAKA</span>
    <span>PROVINSI</span><span>: SULAWESI TENGGARA</span>
    <span>KOMODITI</span><span>: {{ strtoupper($tanaman->nama_tanaman )}}</span>
  </div>

    </p>

    <!-- Table Data Hasil Panen -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kecamatan</th>
                <th style="text-align: end;">Total Produksi (Kg)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hasilPanenPerKecamatan as $item)
                <tr>
                    <td style="text-align:center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->kecamatan->nama ?? '-' }}</td>
                    <td style="text-align: end;">{{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center;">Tidak ada data hasil panen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br><br>

    <!-- Chart Total Hasil Panen per Kecamatan -->
    <div style="border:1px solid #ddd; border-radius:12px; padding:16px; margin-bottom:20px;">
        <h5 style="margin:0 0 12px 0; font-size:1rem; font-weight:600; color:#333;">
            Grafik Total Hasil Panen {{ ucfirst($tanaman->nama_tanaman) }} Pada Tiap Kecamatan
        </h5>

@if(!empty($chartPath))
    <div style="text-align:center; margin:20px 0;">
        <img src="{{storage_path('app/public/' . $chartPath)}}" style="width:500px; height:auto;">
    </div>
@else
        <div id="chartHasilPanen"></div>
@endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chartData = @json($hasilPanenPerKecamatan);
            var options = {
                chart: { type: 'bar', height: 400 },
                series: [{
                    name: 'Total Panen',
                    data: chartData.map(item => item.total)
                }],
                xaxis: {
                    categories: chartData.map(item => item.kecamatan.nama),
                    title: { text: 'Kecamatan' }
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
                    // jangan auto submit, biar user klik tombol
                });
            }, 2000); // kasih delay 1 detik supaya chart pasti sudah ter-render
        });
        });
    </script>

</x-laporan.index>
