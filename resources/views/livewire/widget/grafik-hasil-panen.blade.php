<div class="card rounded-3">
    <div class="card-body">
        <h6 class="mb-3">{{ $chartTitle }}</h6>
        <div id="chart"></div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var el = document.querySelector("#chart");
            if (!el) return;

            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Total Panen (Kg)',
                    data: @json($topHasilPanen->pluck('total_panen'))
                }],
                xaxis: {
                    categories: @json($topHasilPanen->map(fn($item) => $item->tanaman->nama_tanaman)),
                    labels: {
                        style: {
                            fontSize: '13px'
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + " Kg"; // tambahkan satuan di label
                    },
                    style: {
                        fontSize: '13px'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Kg"; // tambahkan satuan di tooltip juga
                        }
                    }
                },
                colors: ['#0d6efd']
            };

            var chart = new ApexCharts(el, options);
            chart.render();
        });
    </script>
@endpush
