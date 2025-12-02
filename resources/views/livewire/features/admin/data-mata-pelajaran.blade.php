<div>
    <div class="card shadow-sm border-0">
        {{-- Header --}}
        <div class="card-header bg-primary text-white py-3 px-4">
            <h5 class="mb-0 fw-semibold text-white">
                <i class="bi bi-book-half me-2"></i> Manajemen Mata Pelajaran
            </h5>
        </div>

        <div class="card-body p-4">
            {{-- Input Pencarian --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-primary btn-sm fw-semibold" data-bs-toggle="modal"
                    data-bs-target="#mapelModal">
                    <i class="bi bi-plus-circle"></i> Tambah Mata Pelajaran
                </button>
                <input wire:model="search" type="text" class="form-control form-control-sm w-50"
                    placeholder="🔍 Cari mata pelajaran...">
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Kode</th>
                            <th width="25%">Nama Mata Pelajaran</th>
                            <th width="35%">Deskripsi</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mataPelajaran as $index => $mapel)
                            <tr>
                                <td class="fw-medium">{{ $mataPelajaran->firstItem() + $index }}</td>
                                <td><span class="badge bg-secondary">{{ $mapel->kode_mapel ?? '-' }}</span></td>
                                <td class="text-start">{{ $mapel->nama_mapel }}</td>
                                <td class="text-start text-muted">{{ $mapel->deskripsi ?? '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button wire:click="edit({{ $mapel->id }})"
                                            data-bs-toggle="modal" data-bs-target="#mapelModal"
                                            class="btn btn-sm btn-warning text-white">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <button type="button" onclick="confirmDelete({{ $mapel->id }})"
                                            class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted fst-italic py-3">Belum ada data mata pelajaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $mataPelajaran->links() }}
            </div>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- ✅ Modal Tambah & Edit Mata Pelajaran --}}
    {{-- ========================================================= --}}
    <div wire:ignore.self class="modal fade" id="mapelModal" tabindex="-1" aria-labelledby="mapelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="mapelModalLabel">
                        {{ $mata_pelajaran_id ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran' }}
                    </h1>
                    <button type="button" class="btn-close" wire:click="resetForm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form wire:submit.prevent="{{ $mata_pelajaran_id ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Kode Mapel</label>
                                <input type="text" wire:model.defer="kode_mapel" class="form-control"
                                    placeholder="Contoh: MAT101">
                                @error('kode_mapel') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Nama Mata Pelajaran</label>
                                <input type="text" wire:model.defer="nama_mapel" class="form-control"
                                    placeholder="Nama mata pelajaran...">
                                @error('nama_mapel') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea wire:model.defer="deskripsi" class="form-control" rows="3"
                                    placeholder="Deskripsi singkat mata pelajaran..."></textarea>
                                @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" wire:click="resetForm" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                            <i class="bi bi-save"></i> {{ $mata_pelajaran_id ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
