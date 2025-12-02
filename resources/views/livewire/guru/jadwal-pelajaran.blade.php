<div class="container-fluid px-4">
    
    <h3 class="fw-bold text-muted mb-4">
        <i class="bi bi-cloud-arrow-up-fill me-2 text-primary"></i> Upload Jadwal Pelajaran
    </h3>

<div class="card shadow-lg border-0 mb-5">
    <div class="card-header bg-primary border-bottom d-flex justify-content-between align-items-center">
        <h2 class="fw-bold text-dark mb-0">
            <i class="bi bi-calendar-day-fill me-2"></i> Jadwal Pelajaran
        </h2>

        {{-- TOMBOL TAMBAH --}}
        <button class="btn btn-success"
            data-bs-toggle="modal"
            data-bs-target="#tambahModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Jadwal Baru
        </button>
    </div>

    <div class="card-body p-4">

        {{-- ALERT --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th scope="col" class="text-start">Kelas</th>
                        <th scope="col">Mata Pelajaran</th>
                        <th scope="col">Guru Pengajar</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam</th>
                        <th scope="col" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwalList as $jadwal)
                    <tr>
                        <td class="text-start fw-bold">{{ $jadwal->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</td>
                        <td><i class="bi bi-book me-1 text-muted"></i> {{ $jadwal->mapel->nama_mapel ?? 'Mapel Tidak Ditemukan' }}</td>
                        <td><i class="bi bi-person-circle me-1 text-muted"></i> {{ $jadwal->guru->user->name ?? 'Guru Tidak Ditemukan' }}</td>
                        <td class="fw-bold">{{ $jadwal->hari }}</td>
                        <td><span class="badge bg-secondary px-2 py-1">{{ $jadwal->jam }}</span></td>
                        <td>
                            <button wire:click="edit({{ $jadwal->id }})"
                                class="btn btn-warning btn-sm text-white me-1"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button onclick="confirmDelete({{ $jadwal->id }})"
                                class="btn btn-danger btn-sm"
                                title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                            Belum ada jadwal pelajaran yang terdata.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ================= MODAL TAMBAH (Menggunakan Card Header yang Seragam) ================= --}}
<div wire:ignore.self class="modal fade" id="tambahModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-plus-circle me-1"></i> Tambah Jadwal Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="store">
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kelas</label>
                        <select wire:model="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Guru</label>
                        <select wire:model="guru_id" class="form-select @error('guru_id') is-invalid @enderror">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($guruList as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->user->name }}</option>
                            @endforeach
                        </select>
                        @error('guru_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Pelajaran</label>
                        <select wire:model="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($mapelList as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                        @error('mapel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Hari</label>
                            <select wire:model="hari" class="form-select @error('hari') is-invalid @enderror">
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                            @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam</label>
                            <input type="time" wire:model="jam" class="form-control @error('jam') is-invalid @enderror">
                            @error('jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- ================= MODAL EDIT (Menggunakan Card Header yang Seragam) ================= --}}
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i> Edit Jadwal</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kelas</label>
                        <select wire:model="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Guru</label>
                        <select wire:model="guru_id" class="form-select @error('guru_id') is-invalid @enderror">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($guruList as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->user->name }}</option>
                            @endforeach
                        </select>
                        @error('guru_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mata Pelajaran</label>
                        <select wire:model="mapel_id" class="form-select @error('mapel_id') is-invalid @enderror">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($mapelList as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                        @error('mapel_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Hari</label>
                            <select wire:model="hari" class="form-select @error('hari') is-invalid @enderror">
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                            @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jam</label>
                            <input type="time" wire:model="jam" class="form-control @error('jam') is-invalid @enderror">
                            @error('jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white">Update Jadwal</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
