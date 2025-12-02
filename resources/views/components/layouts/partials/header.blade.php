<header class="mb-3 d-flex align-items-center shadow-sm bg-light px-3 py-2 rounded-3 ">

    <!-- Burger Button -->
    <a href="#" class="burger-btn d-block d-xl-none text-dark">
        <i class="bi bi-list fs-2"></i>
    </a>

    @php
        $user = Auth::user();

        if ($user->role === 'guru') {
            $photo = $user->profileGuru?->photo;
        } elseif ($user->role === 'siswa') {
            $photo = $user->profile?->photo;
        } elseif ($user->role === 'admin') {
        $photo = $user->profileAdmin?->photo;
        }
        else {
            $photo = null;
        }
    @endphp

    <!-- Profile Dropdown -->
    <div class="dropdown ms-auto">
        <a
            href="#"
            class="d-flex align-items-center text-decoration-none"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            style="cursor: pointer;"
        >
            <!-- Foto Profile -->
            <div class="position-relative">
                <img
                    src="{{ $photo ? asset('storage/' . $photo) : asset('images/default.png') }}"
                    class="rounded-circle border"
                    width="45"
                    height="45"
                    style="object-fit: cover; border: 2px solid #0d6efd;"
                >

                <!-- Online Dot -->
                <span
                    class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-white"
                    style="width: 12px; height: 12px;"
                ></span>
            </div>

            <!-- Nama + Role -->
            <div class="ms-3 text-start">
                <div class="fw-semibold text-primary">{{ $user->name }}</div>
                <small class="text-dark text-capitalize">{{ $user->role }}</small>
            </div>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">

            <!-- PROFILE -->
            <li class="px-3 pt-2 pb-1 text-muted small">Account</li>

            @if($user->role === 'admin')
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <i class="bi bi-person-gear me-2"></i> Profile Admin
                    </a>
                </li>
            @elseif($user->role === 'guru')
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('guru.update-profile-guru') }}">
                        <i class="bi bi-person-badge me-2"></i> Profile Guru
                    </a>
                </li>
            @elseif($user->role === 'siswa')
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('siswa.update-profile') }}">
                        <i class="bi bi-person me-2"></i> Profile Siswa
                    </a>
                </li>
            @endif

            <li><hr class="dropdown-divider"></li>

            <!-- LOGOUT -->
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger d-flex align-items-center" type="submit">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

</header>

<style>
    /* Hover pada dropdown item */
    .dropdown-item:hover {
        background-color: #f1f5ff !important;
        color: #0d6efd !important;
        border-radius: 6px;
    }
</style>
