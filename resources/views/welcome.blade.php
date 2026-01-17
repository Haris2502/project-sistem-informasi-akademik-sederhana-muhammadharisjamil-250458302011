<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" type="image/x-icon" href="data:image/svg+xml,%3csvg width='200' height='60' viewBox='0 0 200 60' xmlns='http://www.w3.org/2000/svg'%3e%3cg transform='translate(10, 15)'%3e%3cpath d='M15 10 L0 15 L15 20 L30 15 Z' fill='%230ea5e9'/%3e%3crect x='5' y='7' width='20' height='3' fill='%2306b6d4' rx='1'/%3e%3cline x1='25' y1='8' x2='28' y2='5' stroke='%230ea5e9' stroke-width='1.5'/%3e%3ccircle cx='28' cy='4' r='2' fill='%230ea5e9'/%3e%3cpath d='M3 15 L3 22 Q15 26 27 22 L27 15' stroke='%2306b6d4' stroke-width='1.5' fill='none'/%3e%3c/g%3e%3ctext x='55' y='25' font-family='Arial, sans-serif' font-size='24' font-weight='bold' fill='%230ea5e9'%3eSIAS%3c/text%3e%3ctext x='55' y='40' font-family='Arial, sans-serif' font-size='10' fill='%2364748b'%3eSistem Informasi Akademik%3c/text%3e%3c/svg%3e" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Akademik Sederhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0ea5e9'
                        , secondary: '#06b6d4'
                    , }
                }
            }
        }

    </script>
</head>
<body class="font-sans antialiased">

    <!-- Navigation -->
    <nav class="fixed w-full bg-white shadow-md z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-primary">SIAS</span>
                    <span class="ml-2 text-gray-700 hidden sm:inline">Sistem Informasi Akademik</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-primary transition">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-primary transition">About</a>
                    <a href="#features" class="text-gray-700 hover:text-primary transition">Features</a>
                    <a href="#story" class="text-gray-700 hover:text-primary transition">Story</a>
                    <a href="#konsumen" class="text-gray-700 hover:text-primary transition">Support</a>
                </div>

                <div class="hidden md:block">
                    <a href="{{ route('register') }}" class="text-black px-6 py-2 rounded-lg hover:bg-sky-600 transition" wire:navigate>Daftar</a>
                    <a href="{{ route('login') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-sky-600 transition" wire:navigate>Masuk</a>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-700" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden md:hidden bg-white border-t" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#home" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Home</a>
                <a href="#about" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">About</a>
                <a href="#features" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Features</a>
                <a href="#story" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Story</a>
                <a href="#pricing" class="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">Pricing</a> <a href="{{ route('register') }}" class="block px-3 py-2 bg-primary text-white rounded text-center" wire:navigate>Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-24 pb-20 bg-gradient-to-br from-sky-50 to-cyan-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-center md:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Kelola Akademik Lebih <span class="text-primary">Mudah & Efisien</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-gray-600 mb-8">
                        SIAS adalah solusi sistem informasi akademik yang dirancang khusus untuk memudahkan pengelolaan data akademik sekolah dan universitas Anda
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white rounded-lg shadow-2xl p-8">
                        <img src="https://images.pexels.com/photos/5905857/pexels-photo-5905857.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Academic System" class="rounded-lg w-full transition-transform duration-700 ease-out animate-pulse hover:scale-105">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-sky-100">Institusi</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">50K+</div>
                    <div class="text-sky-100">Pengguna Aktif</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">99.9%</div>
                    <div class="text-sky-100">Uptime</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-sky-100">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Tentang SIAS</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami berkomitmen untuk menyediakan solusi terbaik dalam pengelolaan sistem informasi akademik
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="bg-white rounded-lg shadow-2xl p-8">
                    <img src="https://images.pexels.com/photos/3184292/pexels-photo-3184292.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Team" class="rounded-lg w-full transition-transform duration-700 ease-out animate-pulse hover:scale-105"">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Siapa Kami?</h3>
                    <p class="text-gray-600 mb-6">
                        SIAS didirikan pada tahun 2025 dengan misi untuk menghadirkan transformasi digital dalam dunia pendidikan. Kami percaya bahwa teknologi dapat membuat proses akademik menjadi lebih efisien dan transparan.
                    </p>
                    <p class="text-gray-600 mb-6">
                        Tim kami terdiri dari para profesional berpengalaman di bidang teknologi pendidikan yang memahami kebutuhan institusi akademik modern.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-700 font-medium">Berpengalaman lebih dari 5 tahun</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-700 font-medium">Dipercaya oleh ratusan institusi</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-700 font-medium">Dukungan pelanggan terbaik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Semua yang Anda butuhkan untuk mengelola sistem akademik dalam satu platform
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Manajemen Siswa</h3>
                    <p class="text-gray-600">
                        Kelola data siswa dengan mudah, termasuk biodata, riwayat akademik, dan dokumen penting
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Nilai & Rapor</h3>
                    <p class="text-gray-600">
                        Input dan kelola nilai siswa secara efisien dengan sistem perhitungan otomatis dan cetak rapor digital
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Absensi Online</h3>
                    <p class="text-gray-600">
                        Catat kehadiran siswa secara real-time dengan sistem absensi digital yang akurat dan mudah
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Jadwal Pelajaran</h3>
                    <p class="text-gray-600">
                        Buat dan atur jadwal pelajaran dengan mudah, lengkap dengan notifikasi otomatis
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Laporan & Analitik</h3>
                    <p class="text-gray-600">
                        Dapatkan insight mendalam dengan laporan komprehensif dan visualisasi data yang menarik
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Komunikasi Terintegrasi</h3>
                    <p class="text-gray-600">
                        Hubungkan guru, siswa, dan orang tua dengan sistem notifikasi dan pesan terintegrasi
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section id="story" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Perjalanan Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Dari ide sederhana hingga menjadi solusi terpercaya untuk ratusan institusi
                </p>
            </div>

            <div class="relative">
                <!-- Timeline -->
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-primary"></div>

                <div class="space-y-12">
                    <!-- Timeline Item 1 -->
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div class="md:text-right">
                            <div class="bg-sky-50 p-6 rounded-lg">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">2025 - Awal Mula</h3>
                                <p class="text-gray-600">
                                    SIAS dimulai dari keprihatinan kami melihat banyak institusi pendidikan yang masih menggunakan sistem manual. Kami memutuskan untuk menciptakan solusi yang lebih baik.
                                </p>
                            </div>
                        </div>
                        <div class="hidden md:block"></div>
                    </div>

                    <!-- Timeline Item 2 -->
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div class="hidden md:block"></div>
                        <div>
                            <div class="bg-sky-50 p-6 rounded-lg">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">2026 - Peluncuran Beta</h3>
                                <p class="text-gray-600">
                                    Setelah satu tahun pengembangan intensif, kami meluncurkan versi beta dengan 10 sekolah pilot. Feedback yang kami terima sangat positif dan membangun.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Item 3 -->
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div class="md:text-right">
                            <div class="bg-sky-50 p-6 rounded-lg">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">2027 - Ekspansi Pesat</h3>
                                <p class="text-gray-600">
                                    Kepercayaan dari pengguna membuat kami berkembang pesat. Lebih dari 100 institusi bergabung dan kami meluncurkan fitur-fitur baru yang lebih powerful.
                                </p>
                            </div>
                        </div>
                        <div class="hidden md:block"></div>
                    </div>

                    <!-- Timeline Item 4 -->
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div class="hidden md:block"></div>
                        <div>
                            <div class="bg-sky-50 p-6 rounded-lg">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">2028 - Inovasi Berkelanjutan</h3>
                                <p class="text-gray-600">
                                    Kami terus berinovasi dengan menambahkan AI untuk analitik prediktif dan mobile app untuk kemudahan akses. Pengguna kami mencapai 50,000+.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Item 5 -->
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div class="md:text-right">
                            <div class="bg-sky-50 p-6 rounded-lg">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">2029 - Masa Depan Cerah</h3>
                                <p class="text-gray-600">
                                    Dengan lebih dari 500 institusi yang mempercayai kami, kami terus berkomitmen untuk menghadirkan inovasi dan pelayanan terbaik dalam dunia pendidikan.
                                </p>
                            </div>
                        </div>
                        <div class="hidden md:block"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="konsumen" class="py-20 bg-blue-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Kata Mereka</h2>
                <p class="text-xl text-white max-w-3xl mx-auto">
                    Testimoni dari pengguna yang puas dengan layanan kami
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">
                        "IAS sangat membantu kami dalam mengelola data siswa. Proses input nilai dan pembuatan rapor menjadi jauh lebih cepat. Sangat direkomendasikan!"
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full mr-3">
                            <img src="https://sma.latansacendekia.sch.id/assets/images/user/929221e9f6ebaf71a368df557a2bcdb2.png">
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Ahmad Zulfikar Fauzi, S.Pd.I</p>
                            <p class="text-sm text-gray-600">Kepala Sekolah SMA Latansa Cendekia</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class=" bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">
                        "Interface yang user-friendly dan fitur yang lengkap. Tim support juga sangat responsif. Investasi terbaik untuk sekolah kami."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full mr-3">
                            <img src="https://sma.latansacendekia.sch.id/assets/images/user/23757faeff6bd26107a2b26343e16d06.png">
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Louly Risdianty, SP</p>
                            <p class="text-sm text-gray-600">Wakil Kepala Sekolah Latansa cendekia</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">
                        "Migrasi dari sistem lama ke IAS sangat smooth. Data kami terkelola dengan rapi dan orang tua siswa juga puas dengan transparansi informasi."
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full mr-3">
                            <img src="https://sma.latansacendekia.sch.id/assets/images/user/9a592497a77999951be001b8d4e14f21.png">
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Budiman Prastyo, S.Pd</p>
                            <p class="text-sm text-gray-600">Kimia & Pjok SMA Latansa Cendekia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <span class="text-2xl font-bold text-white">IAS</span>
                    </div>
                    <p class="text-sm mb-4">
                        Solusi sistem informasi akademik terpercaya untuk institusi pendidikan modern
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/p/LATANSA-CENDEKIA-100069884625648/?locale=id_ID" class="hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="https://x.com/LatansaSmait" class="hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/channel/UCblVq7yhxqbET9UtJY3-75Q" class="hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 16.892c-2.102.144-6.784.144-8.883 0C5.282 16.736 5.017 15.622 5 12c.017-3.629.285-4.736 2.558-4.892 2.099-.144 6.782-.144 8.883 0C18.718 7.264 18.982 8.378 19 12c-.018 3.629-.285 4.736-2.559 4.892zM10 9.658l4.917 2.338L10 14.342z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Product -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Produk</h3>
                    <ul class="space-y-2">
                        <li><a href="#features" class="hover:text-white transition">Fitur</a></li>
                        <li><a href="#pricing" class="hover:text-white transition">Harga</a></li>
                        <li><a href="#demo" class="hover:text-white transition">Demo</a></li>
                        <li><a href="#" class="hover:text-white transition">API</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Perusahaan</h3>
                    <ul class="space-y-2">
                        <li><a href="#about" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#story" class="hover:text-white transition">Cerita Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Dukungan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-white transition">Status</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-sm text-center">
                <p>&copy; 2024 IAS - Sistem Informasi Akademik Sederhana. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking a link
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                        , block: 'start'
                    });
                }
            });
        });

    </script>
</body>
</html>
