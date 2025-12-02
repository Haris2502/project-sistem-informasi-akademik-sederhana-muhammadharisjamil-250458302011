<div>
    <div class="page-heading mb-4">
        <h3>Dashboard Admin</h3>
        <p class="text-muted">Selamat datang di halaman dashboard admin</p>
    </div>

    {{-- Ringkasan Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3 bg-primary text-white">
                <h6>Total Siswa</h6>
                <h3 class="fw-bold">{{ $totalSiswa }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3 bg-success text-white">
                <h6>Total Guru</h6>
                <h3 class="fw-bold">{{ $totalGuru }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3 bg-warning text-white">
                <h6>Total Kelas</h6>
                <h3 class="fw-bold">{{ $totalKelas }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3 bg-info text-white">
                <h6>Total Mapel</h6>
                <h3 class="fw-bold">{{ $totalMapel }}</h3>
            </div>
        </div>
    </div>

    {{-- Chart Distribusi Siswa per Kelas --}}
    <div>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary border-0 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">Statistik Data</h5>
        </div>

        <div class="card-body">
            <div id="chartDashboard" style="height: 350px;"></div>
        </div>
    </div>

    {{-- ApexCharts CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('livewire:load', renderDashboardChart);
        document.addEventListener('livewire:navigated', renderDashboardChart);

        function renderDashboardChart() {
            const el = document.querySelector("#chartDashboard");

            // Hapus chart lama jika ada
            if (window.dashboardChart) window.dashboardChart.destroy();

            window.dashboardChart = new ApexCharts(el, {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: { show: false },
                },
                plotOptions: {
                    bar: {
                        borderRadius: 5,
                        columnWidth: '50%',
                        distributed: true,
                    }
                },
                colors: ['#435ebe', '#00a65a', '#f39c12', '#dd4b39'],
                dataLabels: { enabled: true },
                series: [{
                    name: 'Total',
                    data: @json($chartData),
                }],
                xaxis: {
                    categories: @json($chartLabels),
                    labels: {
                        style: { fontSize: '14px', colors: '#333' }
                    }
                },
                yaxis: {
                    title: { text: 'Jumlah', style: { fontSize: '14px' } }
                },
                title: {
                    text: 'Total Data Siswa, Guru, Kelas, dan Mata Pelajaran',
                    align: 'center',
                    style: { fontSize: '16px', color: '#263238' }
                },
                grid: {
                    borderColor: '#f1f1f1'
                }
            });

            window.dashboardChart.render();
        }
    </script>
</div>
</div>
