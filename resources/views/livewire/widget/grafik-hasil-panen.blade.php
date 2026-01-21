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
                    height: 380,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: true
                    }
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
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '12px'
                        },
                        formatter: function(val) {
                            return val.toLocaleString('id-ID');
                        }
                    },
                    // Tambahkan padding ke atas agar label tidak terpotong
                    max: function(max) {
                        return max * 1.15; // Tambah 15% ruang di atas
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded',
                        dataLabels: {
                            position: 'top' // Posisikan label di atas bar
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val.toLocaleString('id-ID') + " Kg"; // Format angka dengan pemisah ribuan
                    },
                    offsetY: -20, // Geser label ke atas bar
                    style: {
                        fontSize: '12px',
                        colors: ['#333']
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
