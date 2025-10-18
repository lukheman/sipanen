<div class="row g-4">

<div class="col-12">
    <div class="alert alert-secondary">
        <!-- <h4 class="alert-heading">Secondary</h4> -->
        <p>Selamat datang, Anda login sebagai <b>Admin</b></p>
    </div>
</div>

    {{--

<!-- Jumlah Kecamatan -->
<div class="col-6 col-md-6">
    <div class="card rounded-3 h-100">
        <div class="card-body d-flex align-items-center p-4">
            <!-- Icon -->
            <div class="stats-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-white me-3"
                 style="width:60px; height:60px; font-size:24px;">
                <i class="iconly-boldLocation"></i>
            </div>
            <!-- Content -->
            <div>
                <h6 class="mb-1">Jumlah Kecamatan</h6>
                <h4 class="fw-bold mb-0">{{ $this->jumlahKecamatan() }}</h4>
            </div>
        </div>
    </div>
</div>
    --}}

    <div class="col-6">
        <div class="card rounded-3 h-100">
            <div class="card-body d-flex align-items-center p-4">
                <!-- Icon -->
                <div class="stats-icon rounded-circle d-flex align-items-center justify-content-center bg-info text-white me-3" style="width:60px; height:60px; font-size:24px;">
                    <i class="iconly-boldWork"></i>
                </div>
                <!-- Content -->
                <div>
                    <h6 class="mb-1">Jumlah Data Hasil Panen</h6>
                    <h4 class="fw-bold  mb-0">{{ $this->jumlahHasilPanen() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card rounded-3">
            <div class="card-body">
                <h6 class="mb-3">5 Tanaman dengan Data Panen Terbanyak</h6>
                <div id="chart"></div> <!-- pastikan ini ada -->
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card rounded-3">
            <div class="card-body">
                <h6 class="mb-3">5 Tanaman dengan Data Panen Terbanyak</h6>
                <div id="funnelChart"></div>
            </div>
        </div>
    </div>


</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var el = document.querySelector("#chart");
        if (!el) return;

        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Jumlah Data Panen',
                data: @json($topHasilPanen->pluck('total'))
            }],
            xaxis: {
                categories: @json(
                    $topHasilPanen->map(fn($item) => $item->tanaman->nama_tanaman)
                ),
                labels: {
                    style: { fontSize: '13px' }
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: { enabled: true },
            colors: ['#0d6efd']
        };

        var chart = new ApexCharts(el, options);
        chart.render();
    });

</script>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var el = document.querySelector("#funnelChart");
        if (!el) return;

        var options = {
            chart: {
                type: 'bar',
                height: 400
            },
            series: [{
                name: 'Jumlah Data Panen',
                data: @json(
                    $topHasilPanen->map(fn($item) => [
                        'x' => $item->tanaman->nama_tanaman,
                        'y' => $item->total
                    ])
                )
            }],
            dataLabels: {
                enabled: true,
                formatter: function (val, opt) {
                    return opt.w.config.series[0].data[opt.dataPointIndex].x + ": " + val;
                }
            },
            legend: {
                show: false
            },
            plotOptions: {
                bar: {
                    borderRadius: 0,
                    horizontal: true,
                    barHeight: '80%',
                    isFunnel: true,
                }
            }
        };

        var chart = new ApexCharts(el, options);
        chart.render();
    });
</script>
@endpush
