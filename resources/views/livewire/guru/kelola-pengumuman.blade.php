<div class="container-fluid py-4">

    <h3 class="fw-bold text-muted mb-4">
        <i class="bi bi-megaphone-fill me-2 text-primary"></i> Kelola Pengumuman
    </h3>

    <div class="card shadow-lg border-0 mb-4">

        <div class="card-header bg-primary border-bottom d-flex justify-content-between align-items-center p-4">
            <h5 class="fw-bold text-dark mb-0">
                Daftar Pengumuman
            </h5>

            {{-- TOMBOL TAMBAH --}}
            <button wire:click="openModal" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Pengumuman
            </button>
        </div>

        <div class="card-body p-0">

            {{-- ALERT --}}
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- ================= MODAL TAMBAH/EDIT PENGUMUMAN ================= --}}
            @if($isModalOpen)
            <div wire:ignore.self class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.6);">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content shadow-xl border-0">

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="bi bi-envelope-plus me-1"></i> {{ $isEdit ? 'Edit Pengumuman' : 'Tambah Pengumuman' }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                        </div>

                        <form wire:submit.prevent="simpan">
                            <div class="modal-body">

                                {{-- Judul --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Judul</label>
                                    <input type="text" wire:model="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Contoh: Jadwal Ujian Akhir Semester">
                                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Isi --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Isi</label>
                                    <textarea wire:model="isi" class="form-control @error('isi') is-invalid @enderror" rows="4" placeholder="Tulis detail pengumuman di sini..."></textarea>
                                    @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Tanggal --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tanggal</label>
                                    <input type="date" wire:model="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                    @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                            </div>

                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                                <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="simpan">
                                        <i class="bi bi-save me-1"></i> {{ $isEdit ? 'Update' : 'Simpan' }}
                                    </span>
                                    <span wire:loading wire:target="simpan">Processing...</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @endif

            {{-- LIST PENGUMUMAN --}}
            <ul class="list-group list-group-flush">

                @forelse($list as $pengumuman)
                    <li class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row py-3">

                        <div class="me-3 mb-2 mb-md-0">
                            {{-- Judul dan Tanggal --}}
                            <h6 class="mb-1 fw-bold text-primary">{{ $pengumuman->judul }}</h6>
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-calendar-event me-1"></i>
                                Tanggal: **{{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') }}**
                            </small>
                            {{-- Isi Pengumuman --}}
                            <p class="mb-0 text-muted">{{ $pengumuman->isi }}</p>
                        </div>

                        <div class="d-flex flex-shrink-0 align-items-center">

                            {{-- Tombol Edit --}}
                            <button wire:click="openEdit({{ $pengumuman->id }})" class="btn btn-sm btn-warning me-2 shadow-sm" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            {{-- Tombol Hapus (Logic onclick tetap sama) --}}
                            <button onclick="confirmDelete({{ $pengumuman->id }})"
                                    class="btn btn-sm btn-danger shadow-sm" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted py-4">
                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                        Belum ada pengumuman yang tercatat.
                    </li>
                @endforelse

            </ul>
        </div>
    </div>
</div>
