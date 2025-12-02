<div class="container py-4">

    <div class="card shadow-lg border-0 mb-4">
        <div class="card-header bg-primary text-white text-center py-3">
            <h3 class="mb-0">
                <i class="bi bi-journal-bookmark-fill me-2"></i> LAPORAN HASIL BELAJAR SISWA
            </h3>
            <p class="mb-0 fs-6 mt-1">RAPOR NILAI TAHUN AJARAN [Tahun Ajaran Saat Ini]</p>
        </div>

        <div class="card-body p-4">

            {{-- Bagian Data Siswa --}}
            <div class="row mb-4 border-bottom pb-3">
                <div class="col-md-6">
                    <h5 class="text-primary mb-2">👤 Data Siswa</h5>
                    <p class="mb-1"><strong>Nama Peserta Didik:</strong> <span class="text-dark">{{ $siswa->user->name ?? 'N/A' }}</span></p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-primary mb-2 d-md-none d-block">Informasi Kelas</h5>
                    <p class="mb-1"><strong>Kelas / Semester:</strong> <span class="text-dark">{{ $siswa->kelas->nama_kelas ?? 'N/A' }} / [Semester]</span></p>
                    <p class="mb-1"><strong>Nomor Induk Siswa (NIS):</strong> <span class="text-dark">{{ $siswa->nis ?? 'N/A' }}</span></p>
                </div>
            </div>

            {{-- Bagian Nilai Mata Pelajaran --}}
            <h5 class="mt-4 mb-3 text-primary">📊 Nilai Mata Pelajaran</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col" style="width: 5%;">No.</th>
                            <th scope="col" style="width: 50%;">Mata Pelajaran</th>
                            <th scope="col" style="width: 20%;">Nilai Akhir</th>
                            <th scope="col" style="width: 25%;">Predikat</th> {{-- Tambahkan kolom Predikat --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($nilaiList as $index => $n)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><strong>{{ $n->mapel->nama_mapel ?? 'Mata Pelajaran Tidak Diketahui' }}</strong></td>
                            <td class="text-center fw-bold fs-5">
                                {{ $n->nilai }}
                            </td>
                            {{-- LOGIKA PREDICATE (Contoh sederhana: A: >=90, B: 80-89, C: 70-79, D: <70) --}}
                            <td class="text-center">
                                @php
                                    $nilai = $n->nilai;
                                    $predikat = match(true) {
                                        $nilai >= 90 => 'A (Sangat Baik)',
                                        $nilai >= 80 => 'B (Baik)',
                                        $nilai >= 70 => 'C (Cukup)',
                                        default => 'D (Kurang)',
                                    };
                                @endphp
                                <span class="badge bg-secondary px-3 py-2">{{ $predikat }}</span>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Data nilai mata pelajaran belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tambahkan Tanda Tangan (Simulasi) --}}
            <div class="row mt-5 text-center">
                <div class="col-md-4 offset-md-8">
                    <p class="mb-5">Wali Kelas,</p>
                    <p class="fw-bold border-bottom d-inline-block px-3">Nama Wali Kelas</p>
                    <p>NIP. [NIP Wali Kelas]</p>
                </div>
            </div>

        </div>

        {{-- Footer dengan Tombol Download --}}
        <div class="card-footer bg-light border-0 text-center">
            <button class="btn btn-outline-primary btn-lg shadow-sm" wire:click="exportPdf">
                <i class="bi bi-file-earmark-arrow-down-fill me-2"></i> Download Rapor (PDF)
            </button>
            <p class="text-muted mt-2 small">Pastikan semua data sudah benar sebelum mengunduh.</p>
        </div>
    </div>

</div>
