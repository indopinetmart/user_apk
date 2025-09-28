<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
  <a href="https://github.com/indopinetmart/user_apk/actions/workflows/user-ci.yml/badge.svg"><img src="https://github.com/indopinetmart/user_apk/actions/workflows/user-ci.yml/badge.svg" alt="CI/CD Status"></a>
</p>

---

# 🏢 IPM Pinetmart - User Services

## 📌 Deskripsi
**IPM Pinetmart User Services** adalah backend service berbasis **Laravel 11** untuk mengelola:

- Autentikasi multi-level user (9 level role).  
- Manajemen profil & file upload (`profile`, `selfie`, `verifikasi`).  
- Manajemen produk & transaksi.  z`
- Integrasi **Pi Network SDK** dan KYC verification.  
- Sistem laporan transaksi.  
- Deployment otomatis dengan **zero downtime** ke Hostinger.

Project ini mendukung workflow **CI/CD penuh** menggunakan GitHub Actions dengan backup otomatis, shared storage, dan optimasi Laravel.

---

## 🚀 Tech Stack
- **Backend**: Laravel 11 (PHP 8.2)  
- **Database**: MariaDB / MySQL  
- **Authentication**: Laravel Passport / Sanctum (token-based)  
- **Deployment**: GitHub Actions → Hostinger Shared Hosting  
- **Containerization (Dev)**: Docker + Laradock  

---

## 📂 Struktur Project
user-services/
├── app/ # Core logic (Controllers, Models, Policies)
├── bootstrap/ # Laravel bootstrap files
├── config/ # Konfigurasi environment
├── database/ # Migration & Seeder
├── public/ # Public index.php
├── resources/ # Blade templates, lang, assets
├── routes/ # API & web routes
├── storage/ # Cache, logs, session (shared)
├── tests/ # Unit & Feature tests
├── vendor/ # Composer dependencies
├── .env # Config environment
├── user-ci.yml # GitHub Actions workflow
└── README.md

yaml
Copy code

---

## ⚡️ Setup Development

### 1. Clone Repository
```bash
git clone git@github.com:indopinetmart/user_apk.git
cd user_apk
2. Install Dependencies
bash
Copy code
composer install
cp .env.example .env
php artisan key:generate
3. Migrasi Database
bash
Copy code
php artisan migrate --seed
4. Jalankan Server
bash
Copy code
php artisan serve
Access: http://127.0.0.1:8000

🔄 CI/CD Pipeline
Workflow user-ci.yml mencakup:

Continuous Integration (CI)
Install Composer dependencies

Generate key & setup environment CI

Skip migrations & tests (opsional untuk CI cepat)

Continuous Deployment (CD) ke Hostinger
Clone repository ke release baru

Zero downtime deployment

Backup storage & public_html

Shared uploads symlink (profile, selfie, verifikasi)

Laravel optimize & cache (config, route, view)

Cleanup release lama & backup



👨‍💻 Tim & Kontribusi
Tim IT Development IPM Pinetmart

Kontribusi internal menggunakan Pull Request & Code Review

📜 Lisensi
Proyek ini adalah properti internal PT. Indo Pinetmart.
Tidak untuk distribusi publik tanpa izin resmi.

📞 Kontak
Septian – Admin & Developer
Email: your-email@example.com
