<div>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3 px-4">
            <h5 class="mb-0 text-white fw-semibold"><i class="bi bi-card-checklist me-2"></i> Data Kelas Siswa</h5>
        </div>

        <div class="card-body p-4">
            {{-- Toolbar --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button wire:click="resetForm" data-bs-toggle="modal" data-bs-target="#kelasModal" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Kelas
                </button>

                <div class="input-group input-group-sm" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                    <input wire:model.live="search" type="text" class="form-control border-start-0" placeholder="Cari kelas...">
                </div>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelasList as $index => $item)
                            <tr>
                                <td>{{ $kelasList->firstItem() + $index }}</td>
                                <td>{{ $item->nama_kelas }}</td>
                                <td>{{ $item->deskripsi ?? '-' }}</td>
                                <td>{{ $item->siswa->count() }}</td>
                                <td>
                                    <button wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#kelasModal"
                                        class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button>

                                    <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5">Tidak ada data kelas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-2">{{ $kelasList->links() }}</div>
        </div>
    </div>

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="kelasModal" tabindex="-1" aria-labelledby="kelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="store" class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{ $isEdit ? 'Edit Data Kelas' : 'Tambah Data Kelas' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kelas</label>
                        <input wire:model.defer="nama_kelas" type="text" class="form-control" placeholder="Masukkan nama kelas...">
                        @error('nama_kelas') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea wire:model.defer="deskripsi" class="form-control" placeholder="Tuliskan deskripsi kelas..."></textarea>
                        @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" wire:click="resetForm" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-save"></i> {{ $isEdit ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 🔹 SweetAlert Script --}}
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('show-delete-confirmation', () => {
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.dispatch('deleteConfirmed'); // 🔹 kirim ke Livewire
                    }
                });
            });
        });
    </script>
</div>
