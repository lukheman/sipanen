<div class="row g-4">

    {{-- Welcome Card --}}
    <div class="col-12">
        <div class="alert alert-secondary">
            <!-- <h4 class="alert-heading">Secondary</h4> -->
            <p>Selamat datang, Anda login sebagai <b>Admin</b></p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card border-0 rounded-3 h-100 shadow-sm">
            <div class="card-body d-flex align-items-center p-4">
                <div class="stats-icon rounded-3 d-flex align-items-center justify-content-center me-3"
                    style="width:56px; height:56px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                    <i class="iconly-boldWork text-white" style="font-size: 24px;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1">Jumlah Data Hasil Panen</p>
                    <h3 class="fw-bold text-primary mb-0">{{ number_format($this->jumlahHasilPanen(), 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card border-0 rounded-3 h-100 shadow-sm">
            <div class="card-body d-flex align-items-center p-4">
                <div class="stats-icon rounded-3 d-flex align-items-center justify-content-center me-3"
                    style="width:56px; height:56px; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="iconly-boldLeaf text-white" style="font-size: 24px;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1">Jumlah Tanaman</p>
                    <h3 class="fw-bold text-success mb-0">{{ number_format($this->jumlahTanaman(), 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card border-0 rounded-3 h-100 shadow-sm">
            <div class="card-body d-flex align-items-center p-4">
                <div class="stats-icon rounded-3 d-flex align-items-center justify-content-center me-3"
                    style="width:56px; height:56px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="iconly-boldUser3 text-white" style="font-size: 24px;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-1">Jumlah Petugas</p>
                    <h3 class="fw-bold text-warning mb-0">{{ number_format($this->jumlahPetugas(), 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="col-12 col-xl-6">
        <livewire:widget.grafik-hasil-panen />
    </div>

    <div class="col-12 col-xl-6">
        <livewire:widget.funnel-chart-hasil-panen />
    </div>

</div>
