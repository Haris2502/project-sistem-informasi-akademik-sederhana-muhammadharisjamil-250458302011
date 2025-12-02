<div>
    <div class="container-fluid py-4">

    {{-- HEADER DAN SUB JUDUL --}}
    <div class="page-heading mb-5">
        <h3 class="fw-bolder text-muted mb-1">
            <i class="bi bi-speedometer me-2 text-primary"></i> Dashboard Guru
        </h3>
        <p class="text-muted">Selamat datang! Pantau dan evaluasi performa akademis siswa Anda.</p>
    </div>

    {{-- ===== STATISTIK CARDS (KPIs) ===== --}}
    <div class="row g-4 mb-5">

        {{-- Total Siswa --}}
        <div class="col-md-3 col-sm-6">
            <div class="card bg-primary text-white shadow-lg h-100 border-0 overflow-hidden">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-1 fw-semibold opacity-75">Total Siswa</h6>
                        <h1 class="display-6 fw-bold mb-0">{{ $totalSiswa }}</h1>
                    </div>
                    <div style="font-size: 3rem; opacity: .3;">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
                <div class="p-2 bg-black bg-opacity-10 text-center"><small>Data keseluruhan</small></div>
            </div>
        </div>

        {{-- Mata Pelajaran --}}
        <div class="col-md-3 col-sm-6">
            <div class="card bg-success text-white shadow-lg h-100 border-0 overflow-hidden">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-1 fw-semibold opacity-75">Mata Pelajaran</h6>
                        <h1 class="display-6 fw-bold mb-0">{{ $totalMapel }}</h1>
                    </div>
                    <div style="font-size: 3rem; opacity: .3;">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                </div>
                <div class="p-2 bg-black bg-opacity-10 text-center"><small>Mata Pelajaran yang Anda ajar</small></div>
            </div>
        </div>

        {{-- Total Kelas --}}
        <div class="col-md-3 col-sm-6">
            <div class="card bg-warning text-white shadow-lg h-100 border-0 overflow-hidden">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-1 fw-semibold opacity-75">Total Kelas</h6>
                        <h1 class="display-6 fw-bold mb-0">{{ $totalKelas }}</h1>
                    </div>
                    <div style="font-size: 3rem; opacity: .3;">
                        <i class="bi bi-door-open-fill"></i>
                    </div>
                </div>
                <div class="p-2 bg-black bg-opacity-10 text-center"><small>Kelas yang Anda kelola</small></div>
            </div>
        </div>

        {{-- Rata-rata Nilai --}}
        <div class="col-md-3 col-sm-6">
            <div class="card bg-info text-white shadow-lg h-100 border-0 overflow-hidden">
                <div class="card-body d-flex align-items-center justify-content-between p-4">
                    <div>
                        <h6 class="text-uppercase mb-1 fw-semibold opacity-75">Rata-rata Nilai</h6>
                        <h1 class="display-6 fw-bold mb-0">{{ $rataRataNilaiKeseluruhan }}</h1>
                    </div>
                    <div style="font-size: 3rem; opacity: .3;">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                </div>
                <div class="p-2 bg-black bg-opacity-10 text-center"><small>Rata-rata nilai total siswa</small></div>
            </div>
        </div>
    </div>

    {{-- ===== GRAFIK ROW 1 ===== --}}
    <div class="row g-4 mb-4">
        {{-- Grafik 1: Rata-Rata Nilai per Mata Pelajaran (Bar Chart) --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary border-bottom">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-graph-up me-2"></i> Rata-Rata Nilai per Mata Pelajaran</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartNilai" height="300"></canvas>
                </div>
            </div>
        </div>

        {{-- Grafik 2: Distribusi Siswa per Kelas (Doughnut Chart) --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary border-bottom">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-pie-chart-fill me-2"></i> Distribusi Siswa per Kelas</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="chartKelas" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== GRAFIK ROW 2 ===== --}}
    <div class="row g-4 mb-4">
        {{-- Grafik 3: Distribusi Rentang Nilai (Horizontal Bar Chart) --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary border-bottom">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-bar-chart-line-fill me-2"></i> Distribusi Rentang Nilai</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartDistribusi" height="300"></canvas>
                </div>
            </div>
        </div>

        {{-- Grafik 4: Perbandingan Min - Avg - Max per Mapel (Line Chart) --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary border-bottom">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-activity me-2"></i> Perbandingan Min - Avg - Max per Mapel</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartTrend" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== Chart.js CDN ===== (Tetap di sini) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- ===== SCRIPT GRAFIK (Tanpa Perubahan Logic) ===== --}}
<script>
    let chartNilaiInstance, chartKelasInstance, chartDistribusiInstance, chartTrendInstance;

    function initCharts() {

        // Destroy old charts
        chartNilaiInstance?.destroy();
        chartKelasInstance?.destroy();
        chartDistribusiInstance?.destroy();
        chartTrendInstance?.destroy();

        // ---------------------------
        // GRAFIK 1: Rata-rata Nilai (Bar)
        // ---------------------------
        chartNilaiInstance = new Chart(document.getElementById('chartNilai'), {
            type: 'bar',
            data: {
                labels: @json(array_column($chartNilai, 'mapel')),
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: @json(array_column($chartNilai, 'rata')),
                    backgroundColor: '#4e73df',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, max: 100 }
                }
            }
        });

        // ---------------------------
        // GRAFIK 2: Siswa per Kelas (Doughnut)
        // ---------------------------
        chartKelasInstance = new Chart(document.getElementById('chartKelas'), {
            type: 'doughnut',
            data: {
                labels: @json(array_column($chartKelas, 'kelas')),
                datasets: [{
                    data: @json(array_column($chartKelas, 'jumlah')),
                    backgroundColor: ['#36b9cc', '#f6c23e', '#1cc88a', '#e74a3b', '#6f42c1']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right' }
                }
            }
        });

        // ---------------------------
        // GRAFIK 3: Distribusi Nilai (Horizontal Bar)
        // ---------------------------
        chartDistribusiInstance = new Chart(document.getElementById('chartDistribusi'), {
            type: 'bar',
            data: {
                labels: @json(array_column($chartDistribusiNilai, 'range')),
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: @json(array_column($chartDistribusiNilai, 'jumlah')),
                    backgroundColor: ['#e74a3b', '#f6c23e', '#36b9cc', '#1cc88a'],
                    borderRadius: 5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: {
                    x: { beginAtZero: true }
                }
            }
        });

        // ---------------------------
        // GRAFIK 4: Trend Nilai (Line)
        // ---------------------------
        chartTrendInstance = new Chart(document.getElementById('chartTrend'), {
            type: 'line',
            data: {
                labels: @json(array_column($chartTrendNilai, 'mapel')),
                datasets: [
                    {
                        label: 'Tertinggi',
                        data: @json(array_column($chartTrendNilai, 'tertinggi')),
                        borderColor: '#1cc88a',
                        backgroundColor: 'rgba(28, 200, 138, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Rata-rata',
                        data: @json(array_column($chartTrendNilai, 'rata')),
                        borderColor: '#4e73df',
                        tension: 0.4
                    },
                    {
                        label: 'Terendah',
                        data: @json(array_column($chartTrendNilai, 'terendah')),
                        borderColor: '#e74a3b',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true, max: 100 }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', initCharts);
    document.addEventListener('livewire:navigated', initCharts);
</script>

<style>
    /* Styling tambahan untuk efek hover */
    .card {
        border-radius: 12px;
        transition: transform .3s, box-shadow .3s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,.15) !important;
    }
    /* Mengurangi tinggi card header pada kartu KPI */
    .card.bg-primary .p-4, .card.bg-success .p-4, .card.bg-warning .p-4, .card.bg-info .p-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }
</style>
</div>
