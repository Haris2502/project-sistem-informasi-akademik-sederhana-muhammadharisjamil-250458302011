Deskripsi Singkat Aplikasi

Sistem Informasi Akademik Sederhana (SIAS) adalah aplikasi berbasis web yang digunakan untuk mengelola data akademik seperti data guru, data siswa, mata pelajaran, jadwal pelajaran, pengumuman, serta manajemen kelas. Aplikasi ini dirancang untuk membantu sekolah dalam mengelola aktivitas akademik secara efisien, cepat, dan terintegrasi.

  Fitur Utama
🔹 1. Manajemen Data Guru

Menambah, mengedit, menghapus data guru

Upload foto guru

Menampilkan detail lengkap guru

🔹 2. Manajemen Data Siswa

Input data siswa

Update biodata siswa

Kelola kelas dan kategori siswa

🔹 3. Manajemen Mata Pelajaran

Menambahkan kategori mapel

Mengedit dan menghapus mata pelajaran

🔹 4. Manajemen Jadwal Pelajaran

Membuat jadwal untuk setiap kelas

Menentukan guru pengampu & jam pelajaran

🔹 5. Manajemen Kelas

Membuat kelas baru

Menambahkan siswa ke dalam kelas tertentu

🔹 6. Pengumuman & Informasi

Admin dapat membuat pengumuman untuk siswa dan guru

Sistem menampilkan pengumuman terbaru

🔹 7. Dashboard Admin

Statistik jumlah siswa, guru, kelas, mapel

Grafik aktivitas akademik (opsional)

🔹 8. Sistem Login & Role

Role: Admin & Guru

Akses fitur dibatasi sesuai role

🛠️ Teknologi yang Digunakan
Layer	Teknologi
Backend	Laravel 10 / 11
Frontend	Blade, TailwindCSS / Bootstrap 5
Reaktif	Livewire 3
Database	MySQL
Authentication	Laravel Breeze / Fortify
Tools Pendukung	Composer, NPM, Git
📥 Cara Instalasi
1️⃣ Clone Repository
git clone https://github.com/username/sias.git
cd sias

2️⃣ Install Dependency Backend
composer install

3️⃣ Install Dependency Frontend
npm install

4️⃣ Copy File .env
cp .env.example .env

5️⃣ Generate Key
php artisan key:generate

6️⃣ Konfigurasi Database di file .env
DB_DATABASE=sias
DB_USERNAME=root
DB_PASSWORD=

7️⃣ Migrasi Database
php artisan migrate --seed


(Seeder akan mengisi: Admin default, contoh guru, contoh kelas)

▶️ Cara Menjalankan Project
Jalankan Server Laravel
php artisan serve

Jalankan Vite
npm run dev

Akses di Browser
http://localhost:8000

Akun Login Default (Jika Ada Seeder)

Email: admin@gmail.com

Password: password


