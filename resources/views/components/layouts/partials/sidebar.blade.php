<div id="sidebar">
    <div class="sidebar-wrapper active">

        {{-- HEADER & LOGO --}}
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">

                <div class="logo">
                    <a href="https://latansacendekia.sch.id/" class="d-flex align-items-center text-decoration-none " wire:navigate>
                        {{-- SVG INLINE/DATA URI DIBIARKAN KARENA SUDAH CUSTOM --}}
                        <img src="https://latansacendekia.sch.id/wp-content/uploads/2023/10/logo-list-putih.png"
                             alt="Logo Sistem Akademik"
                             style="height: 70px ; width: auto; margin-right: 8px;"/>

                        <span style="font-size: 70pxnt-weight: 700; color: #435ebe; font-family: 'Poppins', sans-serif;">
                            SIAS
                        </span>
                    </a>
                </div>

                {{-- THEME TOGGLE (DIPIPINDAH KE BAWAH LOGO UNTUK KEBERSIHAN) --}}
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2 d-none d-lg-flex">
                    <i class="bi bi-sun-fill text-warning" style="font-size: 1.1rem;"></i>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <i class="bi bi-moon-fill text-dark" style="font-size: 1.1rem;"></i>
                </div>

                {{-- SIDEBAR TOGGLER --}}
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        {{-- MENU UTAMA --}}
        <div class="sidebar-menu">
            <ul class="menu">

                {{-- ADMIN MENU --}}
                @if (Auth::user()->role === 'admin')
                    <x-sidebar-item route="admin.dashboard" icon="bi bi-grid-fill" title="Dashboard" :active="request()->routeIs('admin.dashboard')"/>
                    <li class="sidebar-title mt-3"> Menu Administrator</li>
                    <x-sidebar-item route="admin.data.guru" icon="bi bi-people-fill" title="Data Guru" :active="request()->routeIs('admin.data.guru')"/>
                    <x-sidebar-item route="admin.mata-pelajaran" icon="bi bi-book-fill" title="Mata Pelajaran" :active="request()->routeIs('admin.mata-pelajaran')"/>
                    <x-sidebar-item route="admin.kelas-siswa" icon="bi bi-person-workspace" title="Data Kelas" :active="request()->routeIs('admin.kelas-siswa')"/>
                    <li class="sidebar-title mt-3"> Data Siswa</li>
                    <x-sidebar-item route="admin.data.siswa" icon="bi bi-person-badge-fill" title="Data Siswa" :active="request()->routeIs('admin.data.siswa')"/>
                    <li class="sidebar-title mt-3"> Profile Saya</li>
                    <x-sidebar-item route="admin.update-profile-admin" icon="bi bi-person-circle" title="Update Profile" :active="request()->routeIs('admin.update-profile-admin')"/>

                {{-- GURU MENU --}}
                @elseif(Auth::user()->role === 'guru')
                    <x-sidebar-item route="guru.dashboard" icon="bi bi-grid-fill" title="Dashboard" :active="request()->routeIs('guru.dashboard')"/>
                    <li class="sidebar-title mt-3"> Menu Guru & Akademik</li>
                    <x-sidebar-item route="guru.jadwal-pelajaran" icon="bi bi-calendar3-event-fill" title="Update Jadwal" :active="request()->routeIs('guru.jadwal-pelajaran')"/>
                    <x-sidebar-item route="guru.upload-materi" icon="bi bi-cloud-arrow-up-fill" title="Upload Materi" :active="request()->routeIs('guru.upload-materi')"/>
                    <x-sidebar-item route="guru.lihat-tugas" icon="bi bi-journal-text" title="Lihat Tugas Siswa" :active="request()->routeIs('guru.lihat-tugas')"/>
                    <li class="sidebar-title mt-3"> Penilaian & Presensi</li>
                    <x-sidebar-item route="guru.presensi-siswa" icon="bi bi-clipboard-check-fill" title="Presensi Siswa" :active="request()->routeIs('guru.presensi-siswa')"/>
                    <x-sidebar-item route="guru.input-nilai" icon="bi bi-calculator-fill" title="Input Nilai Pelajaran" :active="request()->routeIs('guru.input-nilai')"/>
                    <li class="sidebar-title mt-3"> Komunikasi</li>
                    <x-sidebar-item route="guru.kelola-pengumuman" icon="bi bi-megaphone-fill" title="Kelola Pengumuman" :active="request()->routeIs('guru.kelola-pengumuman')"/>
                    <li class="sidebar-title mt-3"> Profile Saya</li>
                    <x-sidebar-item route="guru.update-profile-guru" icon="bi bi-person-circle" title="Update Profile" :active="request()->routeIs('guru.update-profile-guru')"/>

                {{-- SISWA MENU --}}
                @else
                    <x-sidebar-item route="siswa.dashboard" icon="bi bi-grid-fill" title="Dashboard" :active="request()->routeIs('siswa.dashboard')"/>
                    <li class="sidebar-title mt-3"> Akses Akademik</li>
                    <x-sidebar-item route="siswa.lihat-materi" icon="bi bi-journal-album" title="Lihat Materi" :active="request()->routeIs('siswa.lihat-materi')"/>
                    <x-sidebar-item route="siswa.upload-tugas" icon="bi bi-folder-fill" title="Upload Tugas" :active="request()->routeIs('siswa.tugas-siswa')"/>
                    <x-sidebar-item route="siswa.jadwal-siswa" icon="bi bi-clock-history" title="Jadwal Pelajaran" :active="request()->routeIs('siswa.jadwal-siswa')"/>
                    <x-sidebar-item route="siswa.presensi-saya" icon="bi bi-calendar-check-fill" title="Presensi Saya" :active="request()->routeIs('siswa.presensi-saya')"/>
                    <li class="sidebar-title mt-3"> Laporan</li>
                    <x-sidebar-item route="siswa.cetak-rapor" icon="bi bi-file-earmark-text-fill" title="Cetak Rapor" :active="request()->routeIs('siswa.cetak-rapor')"/>
                    <li class="sidebar-title mt-3"> Profile Saya</li>
                    <x-sidebar-item route="siswa.update-profile" icon="bi bi-person-circle" title="Update Profile" :active="request()->routeIs('siswa.update-profile')"/>
                @endif
            </ul>
        </div>

    </div>
</div>
