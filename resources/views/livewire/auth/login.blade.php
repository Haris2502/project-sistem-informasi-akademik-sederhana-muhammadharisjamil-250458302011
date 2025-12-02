    <div>
    <div class="container-fluid p-0">
        <div class="row min-vh-100 g-0">
            <div class="col-lg-5 col-12 d-flex align-items-center justify-content-center bg-tertiary">
                <div class="auth-box p-4 p-md-5 w-100" style="max-width: 450px;">
                    <div class="auth-logo text-center mb-4">
                        <a href="https://latansacendekia.sch.id/" class="d-inline-block">
                            <img src="data:image/svg+xml,%3csvg width='200' height='60' viewBox='0 0 200 60' xmlns='http://www.w3.org/2000/svg'%3e%3cg transform='translate(10, 15)'%3e%3cpath d='M15 10 L0 15 L15 20 L30 15 Z' fill='%230ea5e9'/%3e%3crect x='5' y='7' width='20' height='3' fill='%2306b6d4' rx='1'/%3e%3cline x1='25' y1='8' x2='28' y2='5' stroke='%230ea5e9' stroke-width='1.5'/%3e%3ccircle cx='28' cy='4' r='2' fill='%230ea5e9'/%3e%3cpath d='M3 15 L3 22 Q15 26 27 22 L27 15' stroke='%2306b6d4' stroke-width='1.5' fill='none'/%3e%3c/g%3e%3ctext x='55' y='25' font-family='Arial, sans-serif' font-size='24' font-weight='bold' fill='%230ea5e9'%3eSIAS%3c/text%3e%3ctext x='55' y='40' font-family='Arial, sans-serif' font-size='10' fill='%2364748b'%3eSistem Informasi Akademik%3c/text%3e%3c/svg%3e" alt="Logo" style="height: 60px;">
                        </a>
                    </div>

                    <h2 class="auth-title text-center fw-bold mb-2">Masuk ke SIAS</h2>
                    <p class="auth-subtitle text-center text-muted mb-4">Silahkan masukkan kredensial Anda untuk melanjutkan.</p>

                    <form wire:submit.prevent="login">

                        <div class="form-group mb-3">
                            <label for="email" class="form-label visually-hidden">Email</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="text" wire:model="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror @error('login_failed') is-invalid @enderror"
                                    placeholder="Alamat Email">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div x-data="{ show: false }" class="form-group mb-4">
                            <label for="password" class="form-label visually-hidden">Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <input :type="show ? 'text' : 'password'" id="password"
                                    wire:model="password"
                                    class="form-control pe-5 @error('password') is-invalid @enderror @error('login_failed') is-invalid @enderror"
                                    placeholder="Kata Sandi">

                                <button type="button"
                                    @click="show = !show"
                                    tabindex="-1"
                                    class="btn position-absolute end-0 top-50 translate-middle-y me-2 border-0 bg-transparent"
                                    style="z-index: 100;">
                                    <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'" class="text-muted fs-5"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        @error('login_failed')
                            <div class="alert alert-danger mb-4 mt-2">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $message }}
                            </div>
                        @enderror

                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                <label class="form-check-label text-gray-600 small" for="rememberMe">
                                    Ingat Saya (Keep me logged in)
                                </label>
                            </div>
                            <a href="#" class="text-decoration-none small">Lupa Password?</a>
                        </div>


                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="login">
                                <i class="bi bi-box-arrow-in-right me-2"></i> **Masuk**
                            </span>
                            <span wire:loading wire:target="login">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Memuat...
                            </span>
                        </button>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-gray-600 mb-0">Belum Mempunyai Akun? <a href="{{ route('register') }}" class="font-bold text-decoration-none">Daftar (Sign up)</a></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block auth-right-bg-login">
                <div class="d-flex align-items-center justify-content-center h-100 text-white p-5">
                    <div class="text-center">
                        <h1 class="display-4 fw-light mb-4">Kelola Akademik Anda</h1>
                        <p class="lead">Sistem Informasi Akademik (SIAS) menyediakan data yang akurat dan terintegrasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* CSS Kustom (Tambahkan di bagian style aplikasi Anda) */

    /* Warna latar belakang untuk sisi kanan (dapat diganti dengan gambar) */
    .auth-right-bg-login {
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .auth-box {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Shadow yang lebih halus */
    }

    /* Menggunakan input-group untuk ikon */
    .input-group-text {
        background-color: #f8f9fa; /* Latar belakang ikon */
        border-right: none;
        color: #6c757d;
    }

    .input-group > .form-control {
        border-left: none;
    }

    .btn-primary {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #06b6d4;
        border-color: #06b6d4;
    }

    /* Memperbaiki tampilan tombol show/hide password dalam input group */
    .input-group-lg .form-control {
        padding-right: 3.5rem !important; /* Tambahkan padding agar teks tidak tertutup tombol show/hide */
    }
    </style>
    </div>
