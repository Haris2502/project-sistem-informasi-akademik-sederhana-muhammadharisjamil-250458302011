<div>
<div class="container-fluid p-0">
    <div class="row min-vh-100 g-0">
        <div class="col-lg-5 col-12 d-flex align-items-center justify-content-center">
            <div class="auth-box p-4 p-md-5 w-100" style="max-width: 450px;">
                <div class="auth-logo text-center mb-4">
                    <a href="https://latansacendekia.sch.id/" class="d-inline-block">
                        <img src="data:image/svg+xml,%3csvg width='200' height='60' viewBox='0 0 200 60' xmlns='http://www.w3.org/2000/svg'%3e%3cg transform='translate(5, 12)'%3e%3crect x='5' y='5' width='25' height='20' fill='%230ea5e9' rx='2'/%3e%3crect x='5' y='5' width='3' height='20' fill='%2306b6d4'/%3e%3cline x1='10' y1='10' x2='25' y2='10' stroke='white' stroke-width='1.5' opacity='0.7'/%3e%3cline x1='10' y1='14' x2='25' y2='14' stroke='white' stroke-width='1.5' opacity='0.7'/%3e%3cline x1='10' y1='18' x2='20' y2='18' stroke='white' stroke-width='1.5' opacity='0.7'/%3e%3cpath d='M32 10 Q35 7 38 10 T44 10' stroke='%2306b6d4' stroke-width='2' fill='none'/%3e%3cpath d='M32 15 Q35 12 38 15 T44 15' stroke='%2306b6d4' stroke-width='2' fill='none'/%3e%3cpath d='M32 20 Q35 17 38 20 T44 20' stroke='%2306b6d4' stroke-width='2' fill='none'/%3e%3c/g%3e%3ctext x='60' y='25' font-family='Arial, sans-serif' font-size='24' font-weight='bold' fill='%230ea5e9'%3eSIAS%3c/text%3e%3ctext x='60' y='40' font-family='Arial, sans-serif' font-size='10' fill='%2364748b'%3eSistem Informasi Akademik%3c/text%3e%3c/svg%3e" alt="Logo" style="height: 60px;">
                    </a>
                </div>

                <h2 class="auth-title text-center fw-bold mb-2">Daftar Akun Baru</h2>
                <p class="auth-subtitle text-center text-dark mb-4">Masukkan data diri Anda untuk mengakses SIAS.</p>

                <form wire:submit.prevent="register">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="email" class="form-label visually-hidden">Email</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input wire:model="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="name" class="form-label visually-hidden">Username</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input wire:model="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pengguna (Username)">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="password" class="form-label visually-hidden">Password</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input wire:model="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="register">
                            <i class="bi bi-person-plus-fill me-2"></i> **Daftar**
                        </span>
                        <span wire:loading wire:target="register">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Memuat...
                        </span>
                    </button>
                </form>

                <div class="text-center mt-4 pt-3 border-top">
                    <p class='text-gray-600 mb-0'>Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-decoration-none">Masuk (Login)</a></p>
                </div>
            </div>
        </div>

        <div class="col-lg-7 d-none d-lg-block auth-right-bg">
            <div class="d-flex align-items-center justify-content-center h-100 text-white p-5">
                <div class="text-center">
                    <h1 class="display-4 fw-light mb-4">Selamat Datang di SIAS</h1>
                    <p class="lead">Sistem Informasi Akademik yang modern dan terintegrasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS Kustom (Tambahkan di bagian style aplikasi Anda) */
.auth-right-bg {
    /* Ganti URL atau warna ini dengan desain yang Anda inginkan */
    background: linear-gradient(135deg, #0ea5e9, #06b6d4);
    /* Anda bisa mengganti ini dengan: background-image: url('URL_GAMBAR_LATAR_BELAKANG'); background-size: cover; */
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
}

.auth-box {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Shadow yang lebih halus */
}

/* Menggunakan input-group untuk ikon, menggantikan form-control-icon */
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
</style>
</div>
