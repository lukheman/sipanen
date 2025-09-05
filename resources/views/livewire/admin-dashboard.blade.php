<div class="row">
    <!-- Jumlah Petani -->
    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon purple mb-2">
                            <i class="iconly-boldProfile"></i> <!-- lebih mewakili petani -->
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Jumlah Petani</h6>
                        <h6 class="font-extrabold mb-0">{{ $jumlah_petani }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Ahli Pertanian -->
    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                            <i class="iconly-boldWork"></i> <!-- cocok untuk profesional/ahli -->
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Jumlah Ahli Pertanian</h6>
                        <h6 class="font-extrabold mb-0">{{ $jumlah_petugas }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Video -->
    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon green mb-2">
                            <i class="iconly-boldPlay"></i> <!-- play icon untuk video -->
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Jumlah Video</h6>
                        <h6 class="font-extrabold mb-0">{{ $jumlah_video }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Artikel & Berita -->
    <div class="col-6 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon red mb-2">
                            <i class="iconly-boldPaper"></i> <!-- cocok untuk berita/artikel -->
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Jumlah Artikel & Berita</h6>
                        <h6 class="font-extrabold mb-0">{{ $jumlah_berita }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
