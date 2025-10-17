<x-laporan.index>

    <x-laporan.navbar-download :pdf="$pdf" />

    <h5 class="report-title">Laporan Data {{ $label ?? ''}}</h5>
    <p class="report-date">Laporan {{ $label ?? ''}} - {{ date('d F Y')}}</p>

    <!-- Chart Top 5 Kecamatan -->

    <div style="border:1px solid #ddd; border-radius:12px; padding:16px; margin-bottom:20px;">
        <h5 style="margin:0 0 12px 0; font-size:1rem; font-weight:600; color:#333;">
            Top 5 Kecamatan Penghasil {{ $hasilPanen->first()->tanaman->nama_tanaman }}
        </h5>
            <div id="chartTop5"></div>
@if(!empty($chartPath))
    <div style="text-align:center; margin:20px 0;">
        <img src="{{storage_path('app/public/' . $chartPath)}}" style="width:500px; height:auto;">
    </div>
@endif
    </div>

    <!-- Table -->
    <table>
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
                    <td style="text-align:center;">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->tanggal_panen }}</td>
                    <td>{{ $item->petani->nama_petani }}</td>
                    <td>
                        Desa {{ $item->petani->desa->nama }}
                        - Kecamatan {{ $item->petani->desa->kecamatan->nama }}
                    </td>
                    <td>{{ $item->tanaman->nama_tanaman }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">
                        Tidak ada data hasil panen.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Chart Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            chart: {
                type: 'bar',
                height: 400
            },
            series: [{
                name: 'Total Panen',
                data: @json($series ?? [])
            }],
            xaxis: {
                categories: @json($labels ?? [])
            },
            colors: ['#4CAF50'],
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    horizontal: false
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartTop5"), options);

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
