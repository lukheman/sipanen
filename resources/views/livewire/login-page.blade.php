
<div class="container py-5 login-page">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="shadow-card">
                <h2 class="section-title text-center mb-4">Masuk ke SIPANEN</h2>

                <x-flash-message />

                <form wire:submit="submit">
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            wire:model="email"
                            placeholder="Masukkan email Anda"
                            required>
                        @error('email')
                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            wire:model="password"
                            placeholder="Masukkan kata sandi"
                            required>
                        @error('password')
                            <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>

            </div>
        </div>
    </div>
</div>
