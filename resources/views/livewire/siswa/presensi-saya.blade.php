<div> {{-- SECTION 1: METRIC CARDS (Ringkasan Statistik) --}}
    <div class="row g-4 mb-5">

        {{-- Card Hadir --}}
        <div class="col-sm-6 col-md-4">
            <div class="card shadow-lg border-start border-5 border-success h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-success fw-bold mb-1 text-uppercase">
                            <i class="bi bi-check-circle-fill me-1"></i> Hadir
                        </p>
                        <h1 class="display-4 fw-bolder mb-0 text-success">
                            {{ $hadir }}
                        </h1>
                        <small class="text-muted">Total Hadir</small>
                    </div>
                    <div class="bg-success-subtle p-3 rounded-circle text-success fs-1 opacity-75">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Izin --}}
        <div class="col-sm-6 col-md-4">
            <div class="card shadow-lg border-start border-5 border-warning h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-warning fw-bold mb-1 text-uppercase">
                            <i class="bi bi-person-exclamation-fill me-1"></i> Izin
                        </p>
                        <h1 class="display-4 fw-bolder mb-0 text-warning">
                            {{ $izin }}
                        </h1>
                        <small class="text-muted">Total Izin</small>
                    </div>
                    <div class="bg-warning-subtle p-3 rounded-circle text-warning fs-1 opacity-75">
                        <i class="bi bi-file-earmark-person"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Sakit --}}
        <div class="col-sm-12 col-md-4">
            <div class="card shadow-lg border-start border-5 border-danger h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-danger fw-bold mb-1 text-uppercase">
                            <i class="bi bi-person-x-fill me-1"></i> Sakit
                        </p>
                        <h1 class="display-4 fw-bolder mb-0 text-danger">
                            {{ $sakit }}
                        </h1>
                        <small class="text-muted">Total Sakit</small>
                    </div>
                    <div class="bg-danger-subtle p-3 rounded-circle text-danger fs-1 opacity-75">
                        <i class="bi bi-bandaid"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SECTION 2: RIWAYAT PRESENSI --}}
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary border-bottom">
            <h4 class="mb-0 text-dark">
                <i class="bi bi-list-check me-2 text-dark"></i> Riwayat Presensi Detail
            </h4>
        </div>

        <div class="card-body p-0">
            {{-- Tambahkan table-responsive untuk mobile --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" style="width: 50%;">Tanggal</th>
                            <th scope="col" style="width: 50%;">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($list as $p)
                            <tr>
                                <td class="fw-bold">
                                    <i class="bi bi-calendar-event me-2 text-muted"></i>
                                    {{ $p->tanggal->format('d F Y') }}
                                </td>
                                <td>
                                    {{-- Menggunakan Badge untuk status --}}
                                    @php
                                        $status = strtolower($p->status);
                                        $badge_class = match($status) {
                                            'hadir' => 'success',
                                            'izin' => 'warning',
                                            'sakit' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge_class }} text-uppercase px-3 py-2 shadow-sm">
                                        {{-- Icon di dalam badge --}}
                                        @if ($status === 'hadir')
                                            <i class="bi bi-check-lg me-1"></i>
                                        @elseif ($status === 'izin')
                                            <i class="bi bi-dash-circle me-1"></i>
                                        @elseif ($status === 'sakit')
                                            <i class="bi bi-heart me-1"></i>
                                        @else
                                            <i class="bi bi-question-circle me-1"></i>
                                        @endif
                                        {{ $status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">
                                    <i class="bi bi-folder-open fs-3 d-block mb-2"></i>
                                    Belum ada riwayat presensi yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
