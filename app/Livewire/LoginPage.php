<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('layouts.guest')]
class LoginPage extends Component
{
    #[Rule(['required', 'email'])]
    public string $email = '';

    #[Rule(['required', 'min:6'])]
    public string $password = '';

    public ?string $redirect = null;

    public function messages(): array
    {
        return [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ];
    }

    public function mount()
    {
        // Ambil query string "redirect" jika ada
        $this->redirect = request()->query('redirect');
    }

    public function submit()
    {
        // Validasi input sesuai rule
        $credentials = $this->validate();

        // Coba login
        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            // Regenerate session ID untuk keamanan
            request()->session()->regenerate();

            // Ambil user aktif
            $user = Auth::user();

            // Flash message sukses
            flash('Berhasil login sebagai '.$user->nama);

            // Redirect ke halaman tujuan atau dashboard
            return redirect()->intended($this->redirect ?? route('dashboard'));
        }

        // Jika gagal
        flash('Email atau password tidak valid.', 'danger');

        return null;
    }

    public function render()
    {
        return view('livewire.login-page');
    }
}
