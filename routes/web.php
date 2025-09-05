<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UploadImageController;
use App\Http\Middleware\MultiAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\LandingPage::class)->name('index');

Route::get('/landing', \App\Livewire\LandingPage::class)->name('landing');

Route::get('/login', \App\Livewire\LoginPage::class)->name('login')->middleware('guest');
Route::get('/petani/login', \App\Livewire\LoginPage::class)->name('petani.login')->middleware('guest');
Route::get('/admin/login', \App\Livewire\LoginPage::class)->name('admin.login')->middleware('guest');

Route::get('/logout', App\Http\Controllers\LogoutController::class)->name('logout');
Route::get('/registrasi', \App\Livewire\RegistrasiPage::class)->name('registrasi')->middleware('guest');

Route::get('/baca-berita/{id}', \App\Livewire\BacaBerita::class)->name('baca-berita');
Route::get('/nonton-video/{id}', \App\Livewire\NontonVideo::class)->name('nonton-video');

Route::get('/semua-berita', \App\Livewire\BeritaIndex::class)->name('berita.index');
Route::get('/semua-video', \App\Livewire\VideoIndex::class)->name('video.index');

Route::get('/dashboard', \App\Livewire\DashboardPage::class)
    ->name('dashboard')
    ->middleware(MultiAuth::class.':admin,penyuluh,kepala_dinas');

Route::get('/video', \App\Livewire\VideoPage::class)->name('video')->middleware(MultiAuth::class.':admin');
Route::get('/video/{id}/komentar', \App\Livewire\KomentarPage::class)->name('video.komentar')->middleware(MultiAuth::class.':admin');

Route::get('/pengguna', \App\Livewire\PenggunaTable::class)->name('pengguna')->middleware(MultiAuth::class.':admin');

Route::get('/petani', \App\Livewire\PetaniTable::class)->name('petani-table')->middleware(MultiAuth::class.':admin');
Route::get('/petugas', \App\Livewire\PetugasTable::class)->name('petugas-table')->middleware(MultiAuth::class.':admin');

Route::get('/tanaman', \App\Livewire\TanamanTable::class)->name('tanaman-table')->middleware(MultiAuth::class.':admin');
Route::get('/hasil-panen', \App\Livewire\HasilPanenTable::class)->name('hasil-panen-table')->middleware(MultiAuth::class.':admin');


Route::get('/laporan/petani', \App\Livewire\Laporan\LaporanDataPetani::class)->name('laporan.petani')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/laporan/petugas', \App\Livewire\Laporan\LaporanDataPetugas::class)->name('laporan.petugas')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/laporan/hasil-panen', \App\Livewire\Laporan\LaporanDataHasilPanen::class)->name('laporan.hasil-panen')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/profile', \App\Livewire\Profile::class)->name('profile')->middleware(MultiAuth::class.':admin,penyuluh,kepala_dinas');

Route::get('/cetak-laporan/petani', [LaporanController::class, 'laporanPetani'])->name('print-laporan.petani')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/cetak-laporan/petugas', [LaporanController::class, 'laporanPetugas'])->name('print-laporan.petugas')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/cetak-laporan/hasil-panen', [LaporanController::class, 'laporanHasilPanen'])->name('print-laporan.hasil-panen')->middleware(MultiAuth::class . ':kepala_dinas,admin');


// Route::post('/upload-image', UploadImageController::class)->name('upload.image')->middleware(MultiAuth::class . ':admin');
