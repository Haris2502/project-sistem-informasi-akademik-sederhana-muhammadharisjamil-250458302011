<div class="container-fluid py-4">

    <h3 class="fw-bold text-muted mb-4">
        <i class="bi bi-journal-text me-2 text-primary"></i> Input Nilai Siswa
    </h3>

    {{-- ALERT --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg mb-4 border-0">
        <div class="card-header bg-primary border-bottom">
            <h6 class="mb-0 text-dark fw-bold"><i class="bi bi-filter-square-fill me-2 text-secondary"></i> Pilih Kriteria Nilai</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-bold">Kelas</label>
                    <select wire:model.live="kelas_id" class="form-select form-select-lg">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelasList as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Mata Pelajaran</label>
                    <select wire:model.live="mapel_id" class="form-select form-select-lg">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($mapelList as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>

    {{-- BAGIAN INPUT DAN RIWAYAT (Hanya Tampil Jika Filter Lengkap) --}}
    @if ($kelas_id && $mapel_id)

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 text-dark">
                Nilai **{{ $mapelList->find($mapel_id)->nama_mapel ?? '...' }}**
                untuk Kelas **{{ $kelasList->find($kelas_id)->nama_kelas ?? '...' }}**
            </h5>

            <button class="btn btn-primary shadow-sm" wire:click="openModal">
                <i class="bi bi-plus-circle-fill me-1"></i> Input Nilai
            </button>
        </div>

        <hr class="mt-0">

        {{-- RIWAYAT NILAI (Updated Look) --}}
        <div class="card shadow-lg mt-4 border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-ol me-2"></i> Riwayat Nilai Siswa</h5>
            </div>

            <div class="card-body p-0">

                @if (count($riwayat) > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 text-center">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th class="text-start">Nama Siswa</th>
                                <th style="width: 25%;">Nilai (Edit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $i => $n)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td class="text-start fw-bold">{{ $n->siswa->user->name ?? '-' }}</td>
                                <td>
                                    <input type="number" class="form-control text-center w-50 mx-auto"
                                        min="0" max="100"
                                        value="{{ $n->nilai }}"
                                        wire:change="updateNilai({{ $n->id }}, $event.target.value)">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-archive fs-3 d-block mb-2"></i>
                        Belum ada nilai yang tercatat untuk kriteria ini.
                    </div>
                @endif
            </div>
        </div>
@else
<div class="card shadow-lg border-0 bg-white mt-4 rounded-4">
    <div class="card-body text-center py-5">

        <div class="mb-3">
            <i class="bi bi-collection-play-fill text-primary fs-1"
               style="animation: float 2s ease-in-out infinite;"></i>
        </div>

        <h5 class="fw-bold text-secondary mb-2">
            Belum Ada Data yang Ditampilkan
        </h5>

        <p class="text-muted mb-3">
            Pilih <span class="fw-bold text-primary">Kelas</span>
            dan <span class="fw-bold text-primary">Mata Pelajaran</span>
            terlebih dahulu untuk mulai mengelola nilai siswa.
        </p>

        <a class="btn btn-primary px-4 rounded-pill shadow-sm disabled">
            <i class="bi bi-hand-index-thumb me-2"></i>Mulai Setelah Memilih
        </a>

    </div>
</div>

{{-- Animasi kecil biar hidup --}}
<style>
@keyframes float {
    0%   { transform: translateY(0); }
    50%  { transform: translateY(-6px); }
    100% { transform: translateY(0); }
}
</style>
@endif


    {{-- ================= MODAL INPUT NILAI (Updated Look) ================= --}}
    @if ($showModal)
    <div wire:ignore.self class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,.6);">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-xl border-0">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-calculator me-1"></i> Input Nilai Siswa Baru</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                </div>

                <form wire:submit.prevent="simpan">
                    <div class="modal-body p-4">

                        <p class="fw-bold border-bottom pb-2">
                            Kelas: <span class="badge bg-secondary me-3">{{ $kelasList->find($kelas_id)->nama_kelas ?? '...' }}</span>
                            Mata Pelajaran: <span class="badge bg-secondary">{{ $mapelList->find($mapel_id)->nama_mapel ?? '...' }}</span>
                        </p>

                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered table-striped align-middle mb-0">
                                <thead class="table-dark sticky-top">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th class="text-start" style="width: 50%;">Nama Siswa</th>
                                        <th style="width: 45%;">Nilai (0-100)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswaList as $index => $s)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-start fw-bold">{{ $s->user->name }}</td>
                                        <td>
                                            <input type="number" min="0" max="100"
                                                wire:model.defer="nilai.{{ $s->id }}"
                                                class="form-control text-center w-50 mx-auto"
                                                placeholder="Masukkan nilai">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"><i class="bi bi-x-lg me-1"></i> Tutup</button>
                        <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="simpan"><i class="bi bi-save me-1"></i> Simpan Nilai</span>
                            <span wire:loading wire:target="simpan">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

</div>
