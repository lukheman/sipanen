<div class="card rounded-3">
    <div class="card-body">
        <h6 class="mb-3">{{ $chartTitle }}</h6>
        <div id="funnelChart"></div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var el = document.querySelector("#funnelChart");
            if (!el) return;

            var options = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Total Panen (Kg)',
                    data: @json(
                        $topHasilPanen->map(fn($item) => [
                                'x' => $item->tanaman->nama_tanaman,
                                'y' => (float) $item->total_panen,
                            ]))
                }],
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opt) {
                        const name = opt.w.config.series[0].data[opt.dataPointIndex].x;
                        return name + ": " + val + " Kg";
                    },
                    style: {
                        fontSize: '13px'
                    }
                },
                legend: {
                    show: false
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Kg";
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                        barHeight: '80%',
                        isFunnel: true,
                    }
                },
                colors: ['#0d6efd']
            };

            var chart = new ApexCharts(el, options);
            chart.render();
        });
    </script>
@endpush
