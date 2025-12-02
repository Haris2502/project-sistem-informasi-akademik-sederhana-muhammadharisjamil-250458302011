<div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
        <i class="bi bi-person-circle"></i> Profile Guru
    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form wire:submit.prevent="updateProfile">

            <div class="row">

                <!-- ===================== COL KIRI ===================== -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control" wire:model="nip">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Masuk Mengajar</label>
                        <input type="text" class="form-control" wire:model="tahun_masuk">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" wire:model="tempat_lahir">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" wire:model="gender">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3">
                        @if ($photo)
                            <!-- Preview foto baru -->
                            <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail mb-2" width="120">
                        @elseif ($oldPhoto)
                            <!-- Foto lama -->
                            <img src="{{ asset('storage/' . $oldPhoto) }}" class="img-thumbnail mb-2" width="120">
                        @endif

                        <label class="form-label fw-bold">Foto Guru</label>
                        <input type="file" class="form-control" wire:model="photo">
                    </div>

                </div>

                <!-- ===================== COL KANAN ===================== -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Nama Guru</label>
                        <input type="text" class="form-control" wire:model="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control" wire:model="mata_pelajaran">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" wire:model="telepon">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" wire:model="tanggal_lahir">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alasan Mengajar di Sini</label>
                        <textarea class="form-control" rows="3" wire:model="alasan_mengajar"></textarea>
                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary px-4 mt-3">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>

        </form>

    </div>
</div>
