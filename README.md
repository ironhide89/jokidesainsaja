# ⚡ JokiDesainSaja - Platform Portofolio Talent

JokiDesainSaja adalah platform berbasis web yang dikembangkan dengan **Laravel 11** dan **Bootstrap 5**. Platform ini dirancang untuk mengelola dan memamerkan portofolio karya desain, pemrograman, dan penulisan secara profesional.

## 🚀 Fitur Utama

- **Landing Page Modern:** Desain mewah dengan skema warna *Dark Slate & Yellow*.
- **Dashboard Admin:** Monitoring statistik user, total portofolio, dan manajemen kategori.
- **Dashboard User (Talent):** Ruang khusus bagi joki untuk mengelola profil CV dan karya mereka.
- **Sistem Portofolio Detail:** Galeri karya dengan switcher gambar dinamis dan link ke profil WhatsApp.
- **Responsive UI:** Tampilan yang optimal di perangkat mobile maupun desktop.
- **Fixed Navigation:** Sidebar dan Topbar yang stabil untuk pengalaman pengguna yang lebih baik.

## 🛠️ Teknologi yang Digunakan

- **Backend:** PHP 8.2+, Laravel 11
- **Frontend:** Bootstrap 5.3, Chart.js
- **Database:** MySQL
- **Tooling:** Vite, NPM

## 📦 Cara Instalasi

Jika Anda ingin menjalankan proyek ini secara lokal, ikuti langkah berikut:

1. **Clone Repository**
   ```bash
   git clone [https://github.com/username-anda/jokidesainsaja.git](https://github.com/username-anda/jokidesainsaja.git)
   cd jokidesainsaja

2. **Install Dependensi**
    ```bash
    composer install
    npm install

3. **Konfigurasi Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate

4. **Migrasi Database**
    ```bash
    php artisan migrate --seed

5. **Hubungkan Storage**
    ```bash
    php artisan storage:link

6. **Jalankan Website**
    ```bash
    php artisan serve
    npm run dev