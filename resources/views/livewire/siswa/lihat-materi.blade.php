<div class="card shadow-lg border-0 mb-4">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-book-half me-2"></i> Daftar Materi Pembelajaran
        </h5>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            @forelse($materi as $m)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                    <div class="d-flex align-items-start flex-grow-1">
                        <i class="bi bi-file-earmark-text fs-4 text-primary me-3 mt-1"></i>
                        <div>
                            <strong class="text-muted">{{ $m->judul }}</strong>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <i class="bi bi-person-circle me-1"></i> Diajarkan oleh: **{{ optional($m->guru->user)->name ?? 'Unknown' }}**
                                </small>
                            </div>
                            {{-- Contoh penambahan Badge untuk informasi cepat (opsional) --}}
                            {{-- <span class="badge bg-secondary ms-2">PDF</span> --}}
                        </div>
                    </div>

                    <a href="{{ asset('storage/'.$m->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary shadow-sm flex-shrink-0">
                        <i class="bi bi-download me-1"></i> Download
                    </a>
                </li>
            @empty
                <li class="list-group-item text-center py-4 text-muted">
                    <i class="bi bi-folder-fill fs-3 d-block mb-2"></i>
                    Belum ada materi pembelajaran yang tersedia.
                </li>
            @endforelse
        </ul>
    </div>

    @if ($materi->hasPages())
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-center">
                {{ $materi->links() }}
            </div>
        </div>
    @endif
</div>
