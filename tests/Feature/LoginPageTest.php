<?php

use App\Livewire\LoginPage;
use App\Models\Admin;  // Sesuaikan namespace modelmu
use App\Models\Petugas;
use App\Models\KepalaDinas;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

it('renders halaman login dengan sukses', function () {
    Livewire::test(LoginPage::class)
        ->assertStatus(200)
        ->assertSee('Email')  // Ganti dengan teks di viewmu, misal label form
        ->assertSee('Password')
        ->assertSee('Submit');  // Atau tombol login
});

it('validasi required dan format email kalau input kosong atau invalid', function () {
    Livewire::test(LoginPage::class)
        ->set('email', '')
        ->set('password', '')
        ->call('submit')
        ->assertHasErrors(['email' => 'required', 'password' => 'required']);

    Livewire::test(LoginPage::class)
        ->set('email', 'invalid-email')
        ->set('password', 'password123')
        ->call('submit')
        ->assertHasErrors(['email' => 'email']);
});

it('tampilkan custom error message dari messages() method', function () {
    Livewire::test(LoginPage::class)
        ->call('submit')
        ->assertSee('Email harus diisi.')  // Ini dari messages()
        ->assertSee('Password harus diisi.');
});

it('login sukses sebagai admin dan redirect ke dashboard', function () {
    $admin = Admin::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
    ]);

    Livewire::test(LoginPage::class)
        ->set('email', 'admin@example.com')
        ->set('password', 'password123')
        ->call('submit')
        ->assertRedirect(route('dashboard'))  // Asumsi default redirect
        ->assertSessionHas('success', 'Berhasil login sebagai admin');  // Kalau flash() set session 'success'

    assertAuthenticatedAs($admin, 'admin');
});

it('login sukses sebagai petugas dengan redirect dari query param', function () {
    $petugas = Petugas::factory()->create([
        'email' => 'petugas@example.com',
        'password' => bcrypt('password123'),
    ]);

    // Simulasi query param 'redirect'
    Livewire::withQueryParams(['redirect' => '/custom-page'])
        ->test(LoginPage::class)
        ->set('email', 'petugas@example.com')
        ->set('password', 'password123')
        ->call('submit')
        ->assertRedirect('/custom-page')
        ->assertSessionHas('success', 'Berhasil login sebagai petugas');  // Atau 'Berhasil login sebagai petani' kalau match kondisi

    assertAuthenticatedAs($petugas, 'petugas');
});

it('login sukses sebagai kepala_dinas dan redirect intended', function () {
    $kepala = KepalaDinas::factory()->create([
        'email' => 'kepala@example.com',
        'password' => bcrypt('password123'),
    ]);

    Livewire::test(LoginPage::class)
        ->set('email', 'kepala@example.com')
        ->set('password', 'password123')
        ->call('submit')
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('success', 'Berhasil login sebagai kepala_dinas');

    assertAuthenticatedAs($kepala, 'kepala_dinas');
});

it('login gagal kalau credentials salah dan tampilkan flash danger', function () {
    Livewire::test(LoginPage::class)
        ->set('email', 'wrong@example.com')
        ->set('password', 'wrongpass')
        ->call('submit')
        ->assertNoRedirect()  // Gak redirect karena gagal
        ->assertSessionHas('danger', 'Email atau password tidak valid.')
        ->assertSee('Email atau password tidak valid.');  // Kalau flash tampil di view

    assertGuest();  // Pastiin gak authenticated di guard mana pun
});

it('handle mount() dengan redirect query param', function () {
    $component = Livewire::withQueryParams(['redirect' => '/test-redirect'])
        ->test(LoginPage::class);

    expect($component->redirect)->toBe('/test-redirect');
});
