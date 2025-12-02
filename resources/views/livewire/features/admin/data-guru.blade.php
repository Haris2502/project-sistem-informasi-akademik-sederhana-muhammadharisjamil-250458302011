<div>
<div class="container-fluid py-4">
    <h2 class="fw-bold text-muted mb-4">
        <i class="bi bi-people-fill me-2 text-primary"></i> Kelola Data Guru
    </h2>

    {{-- Alert --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body">

            {{-- Tombol Tambah dan Search --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Tombol Tambah --}}
                <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#guruModal" wire:click="resetForm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data Guru
                </button>

                {{-- Search --}}
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0" wire:model.live="search" placeholder="Cari Nama, NIP, atau Mata Pelajaran...">
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:5%">No</th>
                            <th style="width:20%">Nama Guru</th>
                            <th style="width:20%">Email</th>
                            <th style="width:15%">NIP</th>
                            <th style="width:20%">Mata Pelajaran</th>
                            <th style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $index => $guru)
                            <tr>
                                <td>{{ $gurus->firstItem() + $index }}</td>
                                <td class="text-start fw-semibold">{{ $guru->user->name ?? '-' }}</td>
                                <td>{{ $guru->user->email ?? '-' }}</td>
                                <td>{{ $guru->nip }}</td>
                                <td><span class="badge bg-info text-dark">{{ $guru->mapel->nama_mapel ?? 'Belum Ditentukan' }}</span></td>
                                <td>
                                    {{-- Edit Button --}}
                                    <button wire:click="edit({{ $guru->id }})" data-bs-toggle="modal" data-bs-target="#guruModal"
                                        class="btn btn-warning btn-sm shadow-sm" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    {{-- Delete Button --}}
                                    <button onclick="confirmDelete({{ $guru->id }})"
                                        class="btn btn-danger btn-sm shadow-sm" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted py-4">
                                    <i class="bi bi-info-circle fs-5 d-block mb-1"></i>
                                    Data guru tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $gurus->links() }}
            </div>

        </div>
    </div>
</div>

{{-- ================= MODAL TAMBAH / EDIT ================= --}}
<div wire:ignore.self class="modal fade" id="guruModal" tabindex="-1" aria-labelledby="guruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="guruModalLabel">
                    <i class="bi bi-person-badge-fill me-1"></i> {{ $guru_id ? 'Edit Data Guru' : 'Tambah Data Guru Baru' }}
                </h5>
                <button type="button" class="btn-close btn-close-white" wire:click="resetForm" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="{{ $guru_id ? 'update' : 'store' }}">
                <div class="modal-body">

                    {{-- Nama Guru (User) --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Guru</label>
                        <select wire:model.defer="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">-- Pilih User (Akun Guru) --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- NIP --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIP</label>
                        <input type="text" wire:model.defer="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukkan Nomor Induk Pegawai...">
                        @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Mata Pelajaran --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Pelajaran yang Diampu</label>
                        <select wire:model.defer="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach ($mapels as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                        @error('mapel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" wire:click="resetForm" data-bs-dismiss="modal"><i class="bi bi-x-lg me-1"></i> Tutup</button>
                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="{{ $guru_id ? 'update' : 'store' }}"><i class="bi bi-save me-1"></i> {{ $guru_id ? 'Update Data' : 'Simpan Data' }}</span>
                        <span wire:loading wire:target="{{ $guru_id ? 'update' : 'store' }}">Processing...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
