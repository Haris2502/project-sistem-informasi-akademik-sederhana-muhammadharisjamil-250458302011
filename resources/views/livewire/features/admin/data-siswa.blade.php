<div>
    <div class="container-fluid py-4">

    <div class="page-heading">
        <h3 class="fw-bold text-muted mb-4">
            <i class="bi bi-person-lines-fill me-2 text-primary"></i> Kelola Data Siswa
        </h3>
    </div>

    {{-- Notifikasi --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">

            {{-- Toolbar (Tambah & Search) --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                {{-- Tombol Tambah --}}
                <button wire:click="resetForm" data-bs-toggle="modal" data-bs-target="#siswaModal" class="btn btn-primary shadow-sm">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Data Siswa
                </button>

                {{-- Search --}}
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input wire:model.live="search" type="text" class="form-control border-start-0" placeholder="Cari Nama atau NIS...">
                    </div>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:5%">No</th>
                            <th style="width:25%">Nama</th>
                            <th style="width:25%">Email</th>
                            <th style="width:10%">NIS</th>
                            <th style="width:15%">Kelas</th>
                            <th style="width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $index => $siswa)
                            <tr>
                                <td>{{ $siswas->firstItem() + $index }}</td>
                                <td class="text-start fw-semibold">{{ $siswa->user->name ?? '-' }}</td>
                                <td>{{ $siswa->user->email ?? '-' }}</td>
                                <td>{{ $siswa->nis }}</td>
                                <td><span class="badge bg-primary">{{ $siswa->kelas->nama_kelas ?? 'Belum Ada' }}</span></td>
                                <td>
                                    {{-- Edit Button --}}
                                    <button wire:click="edit({{ $siswa->id }})" data-bs-toggle="modal" data-bs-target="#siswaModal"
                                        class="btn btn-warning btn-sm shadow-sm me-2" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    {{-- Delete Button (Menggunakan onclick untuk SweetAlert/Custom JS) --}}
                                    <button onclick="confirmDelete({{ $siswa->id }})"
                                        class="btn btn-danger btn-sm shadow-sm" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted py-4">
                                    <i class="bi bi-info-circle fs-5 d-block mb-1"></i>
                                    Data siswa tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $siswas->links() }}
            </div>
        </div>
    </div>
</div>

{{-- =============== MODAL TAMBAH / EDIT SISWA =============== --}}
<div wire:ignore.self class="modal fade" id="siswaModal" tabindex="-1" aria-labelledby="siswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="siswaModalLabel">
                        <i class="bi bi-person-fill-gear me-1"></i> {{ $isEdit ? 'Edit Data Siswa' : 'Tambah Data Siswa Baru' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="resetForm" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- Pilih User --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">User (Akun Siswa)</label>
                        <select wire:model.defer="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">-- Pilih Akun User Siswa --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- NIS --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIS (Nomor Induk Siswa)</label>
                        <input wire:model.defer="nis" type="text" class="form-control @error('nis') is-invalid @enderror" placeholder="Masukkan NIS...">
                        @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Pilih Kelas --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kelas</label>
                        <select wire:model.defer="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror">
                            <option value="">-- Pilih Kelas Siswa --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                </div>

                <div class="modal-footer bg-light">
                    <button type="button" wire:click="resetForm" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Tutup
                    </button>
                    <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="{{ $isEdit ? 'update' : 'store' }}"><i class="bi bi-save me-1"></i> {{ $isEdit ? 'Update Data' : 'Simpan Data' }}</span>
                        <span wire:loading wire:target="{{ $isEdit ? 'update' : 'store' }}">Processing...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
