<div class="container-fluid py-4">
    <h3 class="fw-bold text-muted mb-4">
        <i class="bi bi-clipboard-check-fill me-2 text-primary"></i> Presensi Siswa
    </h3>

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- FILTER -->
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-header bg-primary border-bottom">
            <h6 class="mb-0 text-dark fw-bold"><i class="bi bi-funnel-fill me-2 text-dark"></i> Pilih Kelas & Tanggal</h6>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label>Kelas</label>
                    <select wire:model.live="kelas_id" class="form-select">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelasList as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Tanggal</label>
                    <input type="date" wire:model.live="tanggal" class="form-control">
                </div>
            </div>
        </div>
    </div>

    @if ($kelas_id)

        <!-- BUTTON BUKA MODAL -->
        <button class="btn btn-primary mb-3" wire:click="openModal">
            Input Presensi
        </button>

        <!-- MODAL INPUT PRESENSI -->
        @if ($showModal)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Input Presensi Siswa</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>

                    <div class="modal-body">

                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswaList as $index => $siswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $siswa->user->name }}</td>
                                    <td>
                                        <select wire:model="presensi.{{ $siswa->id }}" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="Hadir">Hadir</option>
                                            <option value="Izin">Izin</option>
                                            <option value="Sakit">Sakit</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeModal">Tutup</button>
                        <button class="btn btn-success" wire:click="simpan">Simpan Presensi</button>
                    </div>

                </div>
            </div>
        </div>
        @endif

        <!-- RIWAYAT -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">Riwayat Presensi ({{ $tanggal }})</h6>
            </div>

            <div class="card-body">

                @if (count($riwayat) > 0)

                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->siswa->user->name }}</td>

                            <td>
                                <select class="form-select"
                                    wire:change="updatePresensi({{ $p->id }}, $event.target.value)">
                                    <option value="Hadir" {{ $p->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="Izin" {{ $p->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="Sakit" {{ $p->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                </select>
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @else
                    <p class="text-center text-muted">Belum ada presensi untuk tanggal ini.</p>
                @endif

            </div>
        </div>

    @endif

</div>

<script>
    document.addEventListener('livewire:init', () => {

        Livewire.on('confirm-delete', () => {
            if (confirm("Yakin ingin menghapus presensi ini?")) {
                Livewire.dispatch('deleteConfirmed');
            }
        });

        Livewire.on('show-toast', (data) => {
            alert(data.message); // Bisa diganti SweetAlert
        });

    });
</script>


