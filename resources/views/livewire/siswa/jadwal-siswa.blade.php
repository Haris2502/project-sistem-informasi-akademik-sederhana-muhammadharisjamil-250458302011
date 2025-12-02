<div class="card shadow-lg border-0 mb-4">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-calendar-check-fill me-2"></i> Jadwal Pelajaran
        </h5>
        {{-- Penanda Hari Ini (Anda perlu menentukan variabel $hari_ini di Controller Anda) --}}
        {{-- Contoh: $hari_ini = strtolower(date('l')); (Senin, Selasa, dll. dalam Bahasa Inggris) --}}
        @php
            // Asumsi $hari_ini berisi nama hari dalam bahasa Inggris, misal: 'monday'
            $hari_ini = strtolower(date('l'));
        @endphp
        <span class="badge bg-light text-success ms-auto">
            <i class="bi bi-clock-fill me-1"></i> Hari Ini: {{ ucwords(Str::replaceArray(' ', [''], date('l'))) }}
        </span>
    </div>

    <div class="card-body p-0">
        {{-- Menggunakan table-responsive untuk tampilan di perangkat kecil --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">Hari</th>
                        <th scope="col" class="text-center">Jam</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Guru Pengampu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwalList as $j)
                        @php
                            // Menambahkan highlight pada baris hari ini
                            $is_today = (strtolower($j->hari) === $hari_ini);
                            $row_class = $is_today ? 'table-info border-start border-5 border-success' : '';
                        @endphp
                        <tr class="{{ $row_class }}">
                            <td class="fw-bold text-center text-uppercase">
                                {{ ucfirst($j->hari) }}
                                @if ($is_today)
                                    <span class="badge bg-success ms-1">NOW</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <i class="bi bi-watch me-1"></i> **{{ $j->jam }}**
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-text fs-5 text-success me-2"></i>
                                    <strong>{{ $jadwal->mapel->nama_mapel ?? 'Mata Pelajaran Tidak Diketahui' }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-fill fs-5 text-secondary me-2"></i>
                                    {{ $jadwal->guru->user->name ?? 'Guru Tidak Diketahui' }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                                Jadwal pelajaran untuk saat ini belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
