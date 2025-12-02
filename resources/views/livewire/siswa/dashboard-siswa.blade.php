<div class="container-fluid py-4">

    {{-- HEADER SAMBUTAN --}}
    <h3 class="mb-4 text-primary fw-bold">
        <i class="bi bi-speedometer2 me-2"></i> Selamat Datang, <span class="text-primary">{{ Auth::user()->name }}</span>
    </h3>

    <div class="container-fluid py-4">

    <h3 class="fw-bolder text-muted mb-4">
        <i class="bi bi-bar-chart-line-fill me-2 text-primary"></i> Ringkasan Performa Akademik
    </h3>

    {{-- SECTION 1: METRIC CARDS (Ringkasan Data Cepat) --}}
    <div class="row g-4 mb-5">

        {{-- Card Total Mapel (Primary) --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white shadow-lg border-0 h-100" style="background: linear-gradient(135deg, #0d6efd 0%, #004085 100%);">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-uppercase fw-bold opacity-75 mb-1">Total Mata Pelajaran</h6>
                        <h1 class="display-4 fw-bolder mb-0">{{ $totalMapel }}</h1>
                    </div>
                </div>
                <div class="card-footer bg-black bg-opacity-10 text-center border-0 p-2">
                    <small>Mata pelajaran yang Anda ikuti</small>
                </div>
            </div>
        </div>

        {{-- Card Nilai Rata-Rata (Success) --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white shadow-lg border-0 h-100" style="background: linear-gradient(135deg, #198754 0%, #0a472a 100%);">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-uppercase fw-bold opacity-75 mb-1">Nilai Rata-Rata</h6>
                        <h1 class="display-4 fw-bolder mb-0">{{ number_format($rataRataNilai, 2) }}</h1>
                    </div>
                </div>
                 <div class="card-footer bg-black bg-opacity-10 text-center border-0 p-2">
                    <small>Nilai rata-rata keseluruhan</small>
                </div>
            </div>
        </div>

        {{-- Card Kehadiran (Warning) --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white shadow-lg border-0 h-100" style="background: linear-gradient(135deg, #ffc107 0%, #cc9a00 100%);">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-uppercase fw-bold opacity-75 mb-1">Persentase Kehadiran</h6>
                        <h1 class="display-4 fw-bolder mb-0">{{ $persentaseKehadiran }}%</h1>
                    </div>
                </div>
                <div class="card-footer bg-black bg-opacity-10 text-center border-0 p-2">
                    <small>Rata-rata kehadiran (Semua mapel)</small>
                </div>
            </div>
        </div>

        {{-- Card Pengumuman Baru (Info) --}}
        <div class="col-xl-3 col-md-6">
            <div class="card text-white shadow-lg border-0 h-100" style="background: linear-gradient(135deg, #0dcaf0 0%, #0087a3 100%);">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <h6 class="text-uppercase fw-bold opacity-75 mb-1">Pengumuman Baru</h6>
                        <h1 class="display-4 fw-bolder mb-0">{{ $jumlahPengumuman }}</h1>
                    </div>
                </div>
                <div class="card-footer bg-black bg-opacity-10 text-center border-0 p-2">
                    <small>Pengumuman terbaru yang belum dibaca</small>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- SECTION 2: CHART & DAFTAR NILAI (Baris Gabungan) --}}
    <div class="row g-4 mb-5">

        {{-- Kolom Kiri (Grafik Nilai) --}}
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-primary border-bottom">
                    <h5 class="mb-0 text-dark"><i class="bi bi-bar-chart-fill me-2"></i> Grafik Nilai Mata Pelajaran</h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="nilaiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan (Tabel Nilai Terakhir) --}}
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-primary border-bottom">
                    <h5 class="mb-0 text-dark"><i class="bi bi-list-ol me-2"></i> Daftar Nilai Terakhir</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col" class="text-center">Nilai Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mapelList as $m)
                                    @php
                                        $nilaiTerakhir = optional($m->nilai->where('siswa_id', Auth::user()->siswa->id)->last())->nilai;
                                        $badgeColor = match(true) {
                                            $nilaiTerakhir >= 90 => 'success',
                                            $nilaiTerakhir >= 75 => 'warning',
                                            $nilaiTerakhir === null => 'secondary',
                                            default => 'danger',
                                        };
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $m->nama_mapel }}</strong></td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $badgeColor }} fs-6 px-3 py-2">
                                                {{ $nilaiTerakhir ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-3">Tidak ada data mata pelajaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION 3: PENGUMUMAN (Diletakkan di Baris Baru Jika Perlu) --}}
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary border-bottom">
            <h5 class="mb-0 text-dark"><i class="bi bi-megaphone-fill me-2"></i> Pengumuman Terbaru</h5>
        </div>
        <div class="card-body">
            @forelse ($pengumumanList as $p)
                <div class="d-flex align-items-start border-bottom pb-3 mb-3">
                    <i class="bi bi-info-circle-fill text-info fs-4 me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1 text-muted">{{ $p->judul }}</h6>
                        <small class="text-muted"><i class="bi bi-calendar-event me-1"></i> {{ $p->tanggal }}</small>
                        <p class="mt-1 mb-0">{{ Str::limit($p->isi, 150) }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-3 text-muted">
                    <i class="bi bi-check2-circle fs-3 d-block mb-2"></i>
                    Semua pengumuman sudah dibaca. Tidak ada pengumuman baru saat ini.
                </div>
            @endforelse
        </div>
    </div>

</div>

{{-- ChartJS Script (Wajib di bagian bawah) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('nilaiChart').getContext('2d');

        // Data dari PHP harus di-encode dengan benar
        const labels = {!! json_encode(array_keys($chartData ?? [])) !!};
        const dataValues = {!! json_encode(array_values($chartData ?? [])) !!};

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nilai Akhir',
                    data: dataValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Penting untuk layout
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: { stepSize: 10 }
                    },
                    x: { grid: { display: false } }
                },
                plugins: { legend: { display: false } }
            }
        });
    });
</script>
