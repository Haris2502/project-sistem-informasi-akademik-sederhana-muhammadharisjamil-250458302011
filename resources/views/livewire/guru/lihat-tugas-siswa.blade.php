<div class="card shadow-lg border-0 mb-4">

    <div class="card-header bg-primary text-dark d-flex align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-folder-check me-2"></i> Tugas yang Dikumpulkan Siswa
        </h5>
    </div>

    <div class="card-body p-0">
        <ul class="list-group list-group-flush">

            @forelse($tugasSiswa as $t)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">

                    <div class="d-flex align-items-start flex-grow-1">

                        <i class="bi bi-file-earmark-text fs-4 text-success me-3 mt-1"></i>

                        <div>

                            <!-- Judul tugas -->
                            <strong class="text-muted">
                                {{ $t->tugas->judul ?? 'Tanpa Judul Tugas' }}
                            </strong>

                            <div class="mt-1">
                                <small class="text-muted">
                                    <i class="bi bi-person-fill me-1"></i>
                                    Dikumpulkan oleh:
                                    {{ $t->siswa->user->name ?? 'Siswa' }}
                                </small>
                            </div>

                            <!-- Tanggal Upload -->
                            <div>
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Tanggal: {{ $t->created_at->format('d M Y - H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Download File -->
                    <a href="{{ asset('storage/'.$t->file_path) }}"
                        target="_blank"
                        class="btn btn-sm btn-outline-primary shadow-sm flex-shrink-0">
                        <i class="bi bi-download me-1"></i> Download
                    </a>

                </li>
            @empty
                <li class="list-group-item text-center py-4 text-muted">
                    <i class="bi bi-folder-x fs-3 d-block mb-2"></i>
                    Belum ada tugas yang dikumpulkan siswa.
                </li>
            @endforelse

        </ul>
    </div>

    <!-- Pagination -->
    @if ($tugasSiswa->hasPages())
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-center">
                {{ $tugasSiswa->links() }}
            </div>
        </div>
    @endif

</div>
