<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UploadImageController;
use App\Http\Middleware\MultiAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\LandingPage::class)->name('index');

Route::get('/landing', \App\Livewire\LandingPage::class)->name('landing');

Route::get('/login', \App\Livewire\LoginPage::class)->name('login')->middleware('guest');

Route::get('/logout', App\Http\Controllers\LogoutController::class)->name('logout');
Route::get('/registrasi', \App\Livewire\RegistrasiPage::class)->name('registrasi')->middleware('guest');

Route::get('/dashboard', \App\Livewire\Dashboard\Index::class)
    ->name('dashboard')
    ->middleware(MultiAuth::class.':Admin,Petugas,Kepala Dinas');

Route::get('/tanaman', \App\Livewire\Table\TanamanTable::class)->name('tanaman-table')->middleware(MultiAuth::class.':Admin');

Route::get('/pengguna', \App\Livewire\Table\PenggunaTable::class)->name('pengguna-table')->middleware(MultiAuth::class.':Admin');

Route::get('/hasil-panen', \App\Livewire\Table\HasilPanenTable::class)->name('hasil-panen-table')->middleware(MultiAuth::class.':admin,petugas');


Route::get('/laporan/petugas', \App\Livewire\Laporan\LaporanDataPetugas::class)->name('laporan.petugas')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/laporan/hasil-panen', \App\Livewire\Laporan\LaporanDataHasilPanen::class)->name('laporan.hasil-panen')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/profile', \App\Livewire\Profile\PenggunaProfile::class)->name('profile')->middleware(MultiAuth::class.':Admin,Kepala Dinas,Petugas');

Route::get('/cetak-laporan/petugas', [LaporanController::class, 'laporanPetugas'])->name('print-laporan.petugas')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::get('/cetak-laporan/hasil-panen/{idTanaman}', [LaporanController::class, 'laporanHasilPanen'])->name('print-laporan.hasil-panen')->middleware(MultiAuth::class . ':kepala_dinas,admin');

Route::post('/laporan/hasil-panen/pdf', [LaporanController::class, 'generatePDF'])->name('laporan.panen.pdf');


// Route::post('/upload-image', UploadImageController::class)->name('upload.image')->middleware(MultiAuth::class . ':admin');
