<x-laporan.index>

    @if (!$pdf)
        <!-- Navbar dengan tombol download PDF -->
        <div class="navbar" style="margin-bottom:16px;">
            <form action="{{ route('laporan.panen-kecamatan.pdf') }}" method="POST" id="form-pdf">
                @csrf
                <input type="hidden" name="id_kecamatan" value="{{ $kecamatan->id_kecamatan }}">
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
            <td style="width:100px; text-align:center; vertical-align:middle; border:none;">
                @if ($pdf)
                    <img src="{{ public_path('img/logo-kolaka.png') }}" style="width:90px; height:auto;">
                @else
                    <img src="{{ asset('img/logo-kolaka.png') }}" alt="Logo Kolaka" style="width:90px; height:auto;">
                @endif
            </td>
            <td style="text-align:center; vertical-align:middle; border:none;">
                <h4 style="margin:0; font-weight:700;">DINAS PERKEBUNAN DAN PETERNAKAN KABUPATEN KOLAKA</h4>
                <p style="margin:0; font-size:12px;">
                    Jl. Badewi No. 75, Kel. Balandete, Kec. Kolaka, Kab. Kolaka 93517
                </p>
            </td>
        </tr>
    </table>
    <hr style="border-top:1px solid #000; margin:15px 0;">

    <h5 class="text-center" style="margin:20px 0; font-weight:600;">
        {{ $label ?? 'Laporan Hasil Panen per Tahun' }}
    </h5>
    <p style="margin-bottom:20px;">
        <strong>Kecamatan:</strong> {{ $kecamatan->nama }}
    </p>

    <!-- Tabel Hasil Panen per Tahun & Tanaman -->
    <table style="width:100%; border-collapse:collapse; margin-bottom:25px;">
        <thead>
            <tr style="background-color:#f8f9fa;">
                <th style="border:1px solid #ddd; padding:10px; text-align:center;">Tahun</th>
                <th style="border:1px solid #ddd; padding:10px;">Nama Tanaman</th>
                <th style="border:1px solid #ddd; padding:10px; text-align:end;">Total (ton)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grouped = $hasilPanen->groupBy('tahun');
            @endphp
            @forelse ($grouped as $tahun => $items)
                @foreach ($items as $index => $item)
                    <tr>
                        @if ($index === 0)
                            <td style="border:1px solid #ddd; padding:8px; text-align:center;"
                                rowspan="{{ $items->count() }}">
                                {{ $tahun }}
                            </td>
                        @endif
                        <td style="border:1px solid #ddd; padding:8px;">
                            {{ $item->tanaman->nama_tanaman ?? '-' }}
                        </td>
                        <td style="border:1px solid #ddd; padding:8px; text-align:end;">
                            {{ number_format($item->total, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="3" style="border:1px solid #ddd; padding:12px; text-align:center; color:#888;">
                        Tidak ada data hasil panen.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Grafik -->
    <div style="border:1px solid #ddd; border-radius:12px; padding:16px; background:#fafafa;">
        <h5 style="margin:0 0 15px 0; font-size:1rem; font-weight:600; color:#333;">
            Grafik Hasil Panen per Tahun
        </h5>

        @if ($pdf && $chartPath)
            <div style="text-align:center;">
                <img src="{{ public_path('storage/' . $chartPath) }}"
                    style="max-width:100%; height:auto; border-radius:8px;">
            </div>
        @else
            <div id="chartHasilPanen" style="min-height:450px;"></div>
        @endif
    </div>

    <!-- Script: Grafik Sama Persis dengan Modal -->
    @if (!$pdf)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // AMBIL DATA DARI LARAVEL
                let rawData = @json($hasilPanen ?? []);

                // PASTIKAN ARRAY
                if (!Array.isArray(rawData)) rawData = [];

                // FILTER: tahun & tanaman valid, total number
                const validData = rawData.filter(item => {
                    return item &&
                        item.tahun != null &&
                        item.total != null &&
                        item.tanaman &&
                        item.tanaman.nama_tanaman;
                });

                // KALAU KOSONG
                if (validData.length === 0) {
                    document.getElementById('chartHasilPanen').innerHTML =
                        '<p style="text-align:center; color:#999; padding:50px;">Tidak ada data valid untuk grafik.</p>';
                    return;
                }

                // AMBIL TAHUN UNIK & URUTKAN
                const years = [...new Set(validData.map(i => i.tahun))].sort((a, b) => a - b);

                // GROUPING AMAN
                const grouped = {};
                validData.forEach(i => {
                    const name = i.tanaman.nama_tanaman;
                    const year = i.tahun;
                    const total = parseFloat(i.total) || 0;

                    if (!grouped[name]) grouped[name] = {};
                    grouped[name][year] = total;
                });

                // BUILD SERIES
                const series = Object.keys(grouped).map(name => {
                    const data = years.map(y => grouped[name][y] || 0);
                    return {
                        name,
                        data
                    };
                });

                // KALAU SERIES MASIH KOSONG (nggak mungkin, tapi aman)
                if (series.length === 0 || series.some(s => !Array.isArray(s.data))) {
                    document.getElementById('chartHasilPanen').innerHTML =
                        '<p style="text-align:center; color:#999; padding:50px;">Error: Data grafik tidak valid.</p>';
                    return;
                }

                // OPTIONS APEXCHARTS
                const options = {
                    chart: {
                        type: 'bar',
                        height: 450,
                        toolbar: {
                            show: true
                        }
                    },
                    series: series,
                    xaxis: {
                        categories: years,
                        title: {
                            text: 'Tahun'
                        },
                        labels: {
                            rotate: -45
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Total (ton)'
                        },
                        labels: {
                            formatter: val => val.toLocaleString()
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '100%',
                            borderRadius: 6,

                            dataLabels: {
                                position: 'top' // Label di atas batang
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -20,
                        style: {
                            fontSize: '11px',
                            colors: ['#304758']
                        },
                        formatter: val => val > 0 ? val : ''
                    },
                    legend: {
                        position: 'top'
                    },
                    colors: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#6610f2', '#fd7e14'],
                    tooltip: {
                        y: {
                            formatter: val => `${val} ton`
                        }
                    }
                };

                // RENDER CHART
                try {
                    const chart = new ApexCharts(document.querySelector("#chartHasilPanen"), options);
                    chart.render().then(() => {
                        // UNTUK PDF: ambil gambar setelah render
                        setTimeout(() => {
                            chart.dataURI().then(({
                                imgURI
                            }) => {
                                const input = document.getElementById("chart_image");
                                if (input) input.value = imgURI;
                            }).catch(err => console.error("Gagal ambil chart image:", err));
                        }, 1000);
                    }).catch(err => {
                        console.error("Gagal render chart:", err);
                        document.getElementById('chartHasilPanen').innerHTML =
                            '<p style="text-align:center; color:#c00;">Error render grafik.</p>';
                    });
                } catch (err) {
                    console.error("ApexCharts error:", err);
                    document.getElementById('chartHasilPanen').innerHTML =
                        '<p style="text-align:center; color:#c00;">Gagal inisialisasi grafik.</p>';
                }
            });
        </script>
    @endif
</x-laporan.index>
