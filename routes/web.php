<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\LogoutController;
use App\Http\Middleware\MultiAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', \App\Livewire\LandingPage::class)->name('index');
Route::get('/landing', \App\Livewire\LandingPage::class)->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\LoginPage::class)->name('login');
    Route::get('/registrasi', \App\Livewire\RegistrasiPage::class)->name('registrasi');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::get('/logout', LogoutController::class)->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard & Profile (semua role)
|--------------------------------------------------------------------------
*/
Route::middleware(MultiAuth::class . ':Admin,Petugas,Kepala Dinas')->group(function () {
    Route::get('/dashboard', \App\Livewire\Dashboard\Index::class)->name('dashboard');
});

Route::middleware(MultiAuth::class . ':Admin,Kepala Dinas,Petugas')->group(function () {
    Route::get('/profile', \App\Livewire\Profile\PenggunaProfile::class)->name('profile');
});

/*
|--------------------------------------------------------------------------
| Master Data
|--------------------------------------------------------------------------
*/
Route::middleware(MultiAuth::class . ':Admin')->group(function () {
    Route::get('/tanaman', \App\Livewire\Table\TanamanTable::class)->name('tanaman-table');
    Route::get('/pengguna', \App\Livewire\Table\PenggunaTable::class)->name('pengguna-table');
});

Route::middleware(MultiAuth::class . ':Admin,Petugas')->group(function () {
    Route::get('/kecamatan', \App\Livewire\Table\KecamatanTable::class)->name('kecamatan-table');
});

Route::middleware(MultiAuth::class . ':Admin,Petugas,Kepala Dinas')->group(function () {
    Route::get('/hasil-panen', \App\Livewire\Table\HasilPanenTable::class)->name('hasil-panen-table');
});

/*
|--------------------------------------------------------------------------
| Laporan
|--------------------------------------------------------------------------
*/
Route::prefix('laporan')->middleware(MultiAuth::class . ':Kepala Dinas,Petugas,Admin')->group(function () {
    Route::get('/hasil-panen', \App\Livewire\Laporan\LaporanDataHasilPanen::class)
        ->name('laporan.hasil-panen');

    Route::post('/hasil-panen/pdf', [LaporanController::class, 'generateHasilPanenPDF'])
        ->name('laporan.panen.pdf');

});

Route::middleware(MultiAuth::class . ':Kepala Dinas')->group(function () {
    Route::get('/laporan/petugas', \App\Livewire\Laporan\LaporanDataPetugas::class)
        ->name('laporan.petugas');
});

/*
|--------------------------------------------------------------------------
| Cetak Laporan
|--------------------------------------------------------------------------
*/
Route::prefix('cetak-laporan')->middleware(MultiAuth::class . ':Kepala Dinas,Petugas,Admin')->group(function () {
    Route::get('/hasil-panen/{idTanaman}', [LaporanController::class, 'laporanHasilPanenByTanaman'])
        ->name('print-laporan.hasil-panen');

    Route::post('/hasil-panen-kecamatan', [LaporanController::class, 'laporanHasilPanenByKecamatan'])
        ->name('print-laporan.hasil-panen-kecamatan');

    Route::get('/cetak-laporan/hasil-panen/{idTanaman}/{idKecamatan?}',
        [LaporanController::class, 'laporanHasilPanen'])
        ->name('print-laporan.hasil-panen')
        ->middleware(MultiAuth::class . ':Admin,Petugas,Kepala Dinas');
});

Route::middleware(MultiAuth::class . ':Kepala Dinas')->group(function () {
    Route::get('/cetak-laporan/petugas', [LaporanController::class, 'laporanPetugas'])
        ->name('print-laporan.petugas');
});

/*
|--------------------------------------------------------------------------
| Upload (opsional)
|--------------------------------------------------------------------------
*/
// Route::post('/upload-image', UploadImageController::class)
//     ->name('upload.image')
//     ->middleware(MultiAuth::class . ':Admin');
