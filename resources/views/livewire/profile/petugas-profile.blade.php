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
                    <h3 class="mt-3">{{ $form->nama_petugas }}</h3>
                    <p class="text-small">{{ $form->jabatan ?? 'Petugas' }}</p>
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
                        <label for="nama_petugas" class="form-label">Nama</label>
                        <input wire:model="form.nama_petugas" type="text" id="nama_petugas" class="form-control" placeholder="Nama Lengkap">
                        @error('form.nama_petugas')
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

                    <!-- Telepon -->
                    <div class="form-group">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input wire:model="form.telepon" type="text" id="telepon" class="form-control">
                        @error('form.telepon')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="form-group">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input wire:model="form.jabatan" type="text" id="jabatan" class="form-control" placeholder="Jabatan">
                        @error('form.jabatan')
                        <small class="d-block mt-1 text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Kecamatan -->
                    <div class="form-group">
                        <label for="id_kecamatan" class="form-label">Tempat Tugas</label>
                        <input wire:model="kecamatan" type="text" id="id_kecamatan" class="form-control" disabled>
                        <small class="d-block mt-1 text-danger">Anda tidak bisa mengubah kecamatan tempat Anda bertugas, silahkan hubungi admin</small>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input wire:model="form.password" type="password" id="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
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
