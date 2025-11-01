<div class="row g-4">

<div class="col-12">
    <div class="alert alert-secondary">
        <!-- <h4 class="alert-heading">Secondary</h4> -->
        <p>Selamat datang, Anda login sebagai <b>Admin</b></p>
    </div>
</div>

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
        <livewire:widget.grafik-hasil-panen />
    </div>

    <div class="col-12 col-md-6">
        <livewire:widget.funnel-chart-hasil-panen />
    </div>


</div>


