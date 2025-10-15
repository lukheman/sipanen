<div class="row g-4">

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
