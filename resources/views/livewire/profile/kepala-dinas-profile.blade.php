<div class="row">
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <div class="avatar avatar-2xl">
                        <img src="{{ $form->photo ? asset('storage/' . $form->photo) : asset('assets/compiled/jpg/1.jpg') }}" alt="">
                    </div>
                    <div class="mt-2">
                        <label for="profile-photo" class="btn btn-outline-primary btn-sm" style="cursor: pointer;">
                            <i class="bi bi-camera"></i> Ganti Foto
                        </label>
                        <input wire:model="form.photo" type="file" id="profile-photo" class="d-none" accept="image/*">
                    </div>
                    <h3 class="mt-3">{{ $form->nama}}</h3>
                    <p class="text-small">Kepala Dinas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <form wire:submit="save">
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama" class="form-label">Nama</label>
                        <input wire:model="form.nama" type="text" id="nama" class="form-control" placeholder="Nama Lengkap">
                        @error('form.nama')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input wire:model="form.email" type="email" id="email" class="form-control">
                        @error('form.email')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input wire:model="form.alamat" type="text" id="alamat" class="form-control">
                        @error('form.alamat')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Telepon & Tanggal Lahir -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input wire:model="form.telepon" type="text" id="telepon" class="form-control">
                                @error('form.telepon')
                                <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                                <input wire:model="form.tanggal_lahir" type="date" id="tanggal-lahir" class="form-control">
                                @error('form.tanggal_lahir')
                                <small class="d-block mt-1 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input wire:model="form.password" type="password" id="password" class="form-control">
                        @error('form.password')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
