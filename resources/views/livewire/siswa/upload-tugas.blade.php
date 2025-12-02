<div class="container-fluid py-4">

    <h3 class="fw-bold text-muted mb-4">
        <i class="bi bi-cloud-arrow-up-fill me-2 text-primary"></i> Upload Tugas
    </h3>

    <div class="card shadow-lg border-0 mb-4">

        <div class="card-header bg-primary border-bottom d-flex justify-content-between align-items-center p-4">
            <h5 class="fw-bold text-dark mb-0">
                Daftar Tugas yang Sudah Kamu Kumpulkan
            </h5>

            {{-- TOMBOL TAMBAH TUGAS --}}
            <button wire:click="openModal" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Upload Tugas
            </button>
        </div>

        <div class="card-body p-0">

            {{-- ALERT --}}
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- ================= MODAL UPLOAD TUGAS ================= --}}
            @if($isModalOpen)
            <div wire:ignore.self class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.6);">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content shadow-xl border-0">

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="bi bi-upload me-1"></i> Upload Tugas Baru
                            </h5>
                            <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                        </div>

                        <form wire:submit.prevent="simpan" enctype="multipart/form-data">
                            <div class="modal-body">

                                {{-- JUDUL TUGAS --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Judul Tugas</label>
                                    <input wire:model="judul" class="form-control @error('judul') is-invalid @enderror"
                                           placeholder="Masukkan judul tugas, contoh: Tugas Matematika Bab 4">
                                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- MATA PELAJARAN --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Mata Pelajaran</label>
                                    <select wire:model="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror">
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mapelList as $mp)
                                        <option value="{{ $mp->id }}">{{ $mp->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                    @error('mapel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- FILE TUGAS --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">File Tugas (PDF, DOCX, PPT, dll.)</label>
                                    <input type="file" wire:model="file" class="form-control @error('file') is-invalid @enderror">
                                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                    {{-- File Preview --}}
                                    @if($file)
                                    <small class="text-success mt-2 d-block">
                                        <i class="bi bi-check-circle-fill me-1"></i> File siap diupload:
                                        {{ $file->getClientOriginalName() }}
                                    </small>
                                    @endif

                                    {{-- Loading animation --}}
                                    <div wire:loading wire:target="file">
                                        <div class="progress mt-2" style="height: 5px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%;"></div>
                                        </div>
                                        <small class="text-info">Mengunggah file, mohon tunggu...</small>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                    <i class="bi bi-x-lg me-1"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                                    <span wire:loading.remove><i class="bi bi-upload me-1"></i> Upload Tugas</span>
                                    <span wire:loading>Processing...</span>
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            @endif

            {{-- ============== LIST TUGAS YANG DIUPLOAD SISWA ================= --}}
            <ul class="list-group list-group-flush">

                @forelse($tugasList as $tugas)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3">

                    <div class="me-3">
                        <h6 class="mb-1 fw-bold text-muted">{{ $tugas->judul }}</h6>
                        <small class="text-muted d-block">
                            <span class="badge bg-primary me-2">{{ optional($tugas->mapel)->nama_mapel ?? 'Tanpa Mapel' }}</span>
                            Diunggah oleh **{{ auth()->user()->name }}**
                        </small>
                    </div>

                    <div>
                        <button onclick="confirmDelete({{ $tugas->id }})" class="btn btn-sm btn-danger shadow-sm ms-2">
                            <i class="bi bi-trash"></i>
                        </button>

                        <a href="{{ asset('storage/'.$tugas->file_path) }}"
                           target="_blank"
                           class="btn btn-sm btn-outline-primary shadow-sm flex-shrink-0">
                            <i class="bi bi-download me-1"></i> Download
                        </a>
                    </div>

                </li>

                @empty
                <li class="list-group-item text-center text-muted py-4">
                    <i class="bi bi-folder-x fs-3 d-block mb-2"></i>
                    Belum ada tugas yang dikumpulkan.
                </li>
                @endforelse

            </ul>
        </div>
    </div>
</div>


<script>
function confirmDelete(id) {
    if (confirm("Yakin ingin menghapus tugas ini?")) {
        Livewire.dispatch('delete', { id: id });
    }
}
</script>
