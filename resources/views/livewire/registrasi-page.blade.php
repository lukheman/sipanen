<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h2 class="section-title text-center mb-4">Daftar ke Tani Pedia</h2>
                    <form wire:submit.prevent="register">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" wire:model="name"
                                placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" wire:model="email"
                                placeholder="Masukkan email Anda" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="telepon" wire:model="telepon"
                                placeholder="Masukkan nomor telepon" required>
                            @error('telepon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select wire:model.live="kecamatan" class="form-control" id="kecamatan">
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach ($kecamatanList as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="desa" class="form-label">Desa</label>
                                    <select wire:model.live="desa" class="form-control" id="desa">
                                        <option value="">Pilih Desa</option>
                                        @foreach ($desaList as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('desa')
                                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" wire:model="alamat"
                                placeholder="Contoh: Jl. Pemuda" required>
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" wire:model="tanggal_lahir"
                                required>
                            @error('tanggal_lahir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" wire:model="password"
                                placeholder="Masukkan kata sandi" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                wire:model="password_confirmation" placeholder="Konfirmasi kata sandi" required>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Daftar</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk
                                sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
