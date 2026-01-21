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

            var chartData = @json($topHasilPanen->map(fn($item) => [
                'x' => $item->tanaman->nama_tanaman,
                'y' => (float) $item->total_panen,
            ]));

            // Hitung tinggi dinamis berdasarkan jumlah data (minimal 300, maksimal 600)
            var dynamicHeight = Math.max(300, Math.min(600, chartData.length * 50));

            var options = {
                chart: {
                    type: 'bar',
                    height: dynamicHeight,
                    toolbar: {
                        show: true
                    }
                },
                series: [{
                    name: 'Total Panen (Kg)',
                    data: chartData
                }],
                xaxis: {
                    labels: {
                        style: {
                            fontSize: '12px'
                        },
                        formatter: function(val) {
                            return val.toLocaleString('id-ID');
                        }
                    },
                    // Tambahkan ruang ekstra agar label tidak terpotong
                    max: function(max) {
                        return max * 1.2; // Tambah 20% ruang di kanan
                    }
                },
                dataLabels: {
                    enabled: true,
                    textAnchor: 'middle',
                    formatter: function(val, opt) {
                        const name = opt.w.config.series[0].data[opt.dataPointIndex].x;
                        return name + ": " + val.toLocaleString('id-ID') + " Kg";
                    },
                    style: {
                        fontSize: '12px',
                        fontWeight: 600,
                        colors: ['#fff']
                    },
                    dropShadow: {
                        enabled: true,
                        top: 1,
                        left: 1,
                        blur: 2,
                        opacity: 0.3
                    }
                },
                legend: {
                    show: false
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val.toLocaleString('id-ID') + " Kg";
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                        barHeight: '75%',
                        isFunnel: true,
                        distributed: true,
                        dataLabels: {
                            position: 'center'
                        }
                    }
                },
                colors: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#20c997', '#fd7e14', '#6c757d']
            };

            var chart = new ApexCharts(el, options);
            chart.render();
        });
    </script>
@endpush
