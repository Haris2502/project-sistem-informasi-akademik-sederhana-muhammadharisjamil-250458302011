<div class="container-fluid py-4">

    <h3 class="fw-bold text-muted mb-4">
        <i class="bi bi-cloud-arrow-up-fill me-2 text-primary"></i> Upload Materi
    </h3>

    <div class="card shadow-lg border-0 mb-4">

        <div class="card-header bg-primary border-bottom d-flex justify-content-between align-items-center p-4">
            <h5 class="fw-bold text-dark mb-0">
                Daftar Materi yang Telah Diunggah
            </h5>

            {{-- TOMBOL TAMBAH MATERI --}}
            <button wire:click="openModal" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Materi
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

            {{-- ================= MODAL UPLOAD MATERI ================= --}}
            @if($isModalOpen)
            <div wire:ignore.self class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.6);">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content shadow-xl border-0">

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="bi bi-upload me-1"></i> Upload Materi Baru
                            </h5>
                            <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                        </div>

                        <form wire:submit.prevent="simpan" enctype="multipart/form-data">
                            <div class="modal-body">

                                {{-- Judul Materi --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Judul Materi</label>
                                    <input wire:model="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan judul materi, misal: Modul Fisika Bab 3">
                                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- Mata Pelajaran --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Mata Pelajaran</label>
                                    <select wire:model="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror">
                                        <option value="">Pilih Mata Pelajaran yang Relevan</option>
                                        @foreach($mapelList as $mp)
                                        <option value="{{ $mp->id }}">{{ $mp->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                    @error('mapel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                {{-- File Upload --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Pilih File Materi (PDF, DOCX, PPT, dll.)</label>
                                    <input type="file" wire:model="file" class="form-control @error('file') is-invalid @enderror">
                                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                    {{-- File Preview/Status --}}
                                    @if ($file)
                                    <small class="text-success mt-2 d-block">
                                        <i class="bi bi-check-circle-fill me-1"></i> File siap diupload: **{{ $file->getClientOriginalName() }}**
                                    </small>
                                    @endif

                                    {{-- Indikator Loading Upload --}}
                                    <div wire:loading wire:target="file">
                                        <div class="progress mt-2" style="height: 5px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-info">Mengunggah file, mohon tunggu...</small>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal"><i class="bi bi-x-lg me-1"></i> Batal</button>
                                <button type="submit" class="btn btn-success" wire:loading.attr="disabled" wire:target="simpan, file">
                                    <span wire:loading.remove wire:target="simpan, file"><i class="bi bi-upload me-1"></i> Upload Materi</span>
                                    <span wire:loading wire:target="simpan, file">Processing...</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @endif

            {{-- LIST MATERI --}}
            <ul class="list-group list-group-flush">

                @forelse($materiList as $materi)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3">

                    <div class="me-3">
                        {{-- Judul --}}
                        <h6 class="mb-1 fw-bold text-muted">{{ $materi->judul }}</h6>
                        {{-- Detail Meta --}}
                        <small class="text-muted d-block">
                            <span class="badge bg-primary me-2">{{ optional($materi->mapel)->nama_mapel ?? 'Tanpa Mapel' }}</span>
                            Diunggah oleh **{{ optional($materi->guru->user)->name ?? 'Unknown' }}**
                        </small>
                    </div>

                    <div>
                        <button onclick="confirmDelete({{ $materi->id }})" class="btn btn-sm btn-danger shadow-sm ms-2">
                            <i class="bi bi-trash"></i>
                        </button>
                        <a href="{{ asset('storage/'.$materi->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm flex-shrink-0" title="Unduh File">
                            <i class="bi bi-download me-1"></i> Download
                        </a>
                    </div>


                    {{-- Tombol Download --}}


                    {{-- TODO: Tambahkan tombol edit dan hapus jika diperlukan dalam Livewire component --}}
                </li>
                @empty
                <li class="list-group-item text-center text-muted py-4">
                    <i class="bi bi-folder-x fs-3 d-block mb-2"></i>
                    Belum ada materi yang diunggah.
                </li>
                @endforelse

            </ul>
        </div>
    </div>
</div>
