<div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
        <i class="bi bi-person-circle"></i> Profile Admin
    </div>

    <div class="card-body">

        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="updateProfile">

            <div class="row">

                <!-- ===================== KOLOM KIRI ===================== -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Nama Admin</label>
                        <input type="text" class="form-control" wire:model="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" wire:model="telepon">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" wire:model="tempat_lahir">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" wire:model="tanggal_lahir">
                    </div>

                </div>

                <!-- ===================== KOLOM KANAN ===================== -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-control" wire:model="gender">
                            <option value="">-- Pilih Gender --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- FOTO -->
                    <div class="mb-3">

                        <label class="form-label fw-bold">Foto Admin</label> <br>

                        @if ($photo)
                            <!-- Preview foto baru -->
                            <img src="{{ $photo->temporaryUrl() }}"
                                class="img-thumbnail mb-2" width="120">
                        @elseif ($oldPhoto)
                            <!-- Foto lama -->
                            <img src="{{ asset('storage/' . $oldPhoto) }}"
                                class="img-thumbnail mb-2" width="120">
                        @endif

                        <input type="file" class="form-control" wire:model="photo">
                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary px-4 mt-3">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>

        </form>

    </div>
</div>
