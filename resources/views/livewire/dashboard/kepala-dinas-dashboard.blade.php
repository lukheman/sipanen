<div class="row g-4">

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

    <!-- Jumlah Ahli Pertanian -->
    <div class="col-6 col-md-6">
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
</div>
