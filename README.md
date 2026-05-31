# 🖥️ Sistem Gudang Inventaris Komponen Gaming

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Vite-Frontend-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
</p>

> Platform inventaris terpadu untuk memantau dan mengelola stok GPU, CPU, RAM, SSD, dan komponen gaming lainnya secara real-time dengan sistem approval berjenjang.

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi Database](#-konfigurasi-database)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Akun Default (Seeder)](#-akun-default-seeder)
- [Peran Pengguna (Roles)](#-peran-pengguna-roles)
- [Alur Approval](#-alur-approval)
- [Struktur Proyek](#-struktur-proyek)
- [Lisensi](#-lisensi)

---

## 📦 Tentang Proyek

**Sistem Gudang Inventaris Komponen Gaming** adalah aplikasi manajemen inventaris berbasis web yang dibangun menggunakan Laravel 12. Sistem ini dirancang untuk membantu pengelolaan stok komponen PC gaming seperti GPU, CPU, RAM, SSD, Motherboard, dan periferal lainnya.

Sistem dilengkapi dengan **approval berjenjang dua level** (Superadmin → Pimpinan) untuk setiap transaksi barang masuk dan keluar, serta fitur laporan yang dapat diekspor ke format **PDF** dan **Excel**.

---

## ✨ Fitur Utama

| Fitur | Keterangan |
|---|---|
| 📊 **Dashboard** | Ringkasan stok, transaksi terkini, dan statistik real-time |
| 📦 **Manajemen Barang** | CRUD data barang beserta kategori, satuan, dan harga |
| 🏷️ **Kategori & Satuan** | Pengelompokan barang dan satuan ukur |
| 📥 **Barang Masuk** | Pencatatan stok masuk dengan form pengajuan dan lampiran |
| 📤 **Barang Keluar** | Pencatatan stok keluar dengan sistem pengajuan |
| ✅ **Approval 2 Level** | Persetujuan bertahap: Superadmin → Pimpinan |
| 📈 **Laporan Stok** | Laporan stok real-time, dapat diekspor ke PDF & Excel |
| 📋 **Laporan Masuk/Keluar** | Riwayat transaksi dengan filter tanggal |
| 🔄 **Riwayat Mutasi** | Catatan lengkap seluruh pergerakan stok |
| 👥 **Manajemen User** | Kelola pengguna dengan peran berbeda |
| 🔒 **Autentikasi** | Login aman menggunakan Laravel Breeze |

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** TailwindCSS 3.x, Alpine.js, Vite
- **Database:** MySQL
- **Export PDF:** barryvdh/laravel-dompdf
- **Export Excel:** maatwebsite/excel 3.1
- **Chart:** ApexCharts
- **Alert:** SweetAlert2
- **Auth Scaffold:** Laravel Breeze

---

## ⚙️ Persyaratan Sistem

Pastikan environment Anda sudah memenuhi persyaratan berikut sebelum instalasi:

- **PHP** >= 8.2 (dengan ekstensi: `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`)
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM** >= 9.x
- **MySQL** >= 5.7 / MariaDB >= 10.3
- **XAMPP** / **Laragon** / server lokal setara (opsional, untuk development)

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/sistem_gudang.git
cd sistem_gudang
```

> Ganti `username` dengan nama akun GitHub Anda.

---

### 2. Install Dependensi PHP

```bash
composer install
```

---

### 3. Install Dependensi Node.js

```bash
npm install
```

---

### 4. Salin File Environment

```bash
cp .env.example .env
```

> Di Windows (tanpa Git Bash):
> ```powershell
> copy .env.example .env
> ```

---

### 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 🗄️ Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database berikut:

```env
APP_NAME="Gudang PC Gaming"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_gudang
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan:** Buat database baru bernama `sistem_gudang` (atau nama lain sesuai preferensi) di MySQL sebelum melanjutkan.

---

### Jalankan Migrasi & Seeder

```bash
# Jalankan migrasi tabel
php artisan migrate

# Jalankan seeder untuk data awal (akun & data contoh)
php artisan db:seed
```

Atau jalankan keduanya sekaligus (reset + migrate + seed):

```bash
php artisan migrate:fresh --seed
```

---

## ▶️ Menjalankan Aplikasi

Anda memerlukan **dua terminal** yang berjalan secara bersamaan:

### Terminal 1 — Laravel Server

```bash
php artisan serve
```

Aplikasi akan tersedia di: **http://localhost:8000**

### Terminal 2 — Vite Asset Compiler (Development)

```bash
npm run dev
```

> Untuk **production/deployment**, gunakan `npm run build` (sekali saja) sebagai pengganti `npm run dev`.

---

### 🏃 Jalankan Semua Sekaligus (Opsional)

```bash
composer dev
```

Perintah ini akan menjalankan Laravel server, queue worker, log watcher, dan Vite secara bersamaan menggunakan `concurrently`.

---

## 👤 Akun Default (Seeder)

Setelah menjalankan `db:seed`, akun berikut tersedia untuk login:

| Peran | Email | Password |
|---|---|---|
| **Superadmin** | `superadmin@gudang.com` | `password` |
| **Staff Gudang** | `staff@gudang.com` | `password` |
| **Pimpinan** | `pimpinan@gudang.com` | `password` |

> ⚠️ **Penting:** Segera ganti password default setelah pertama kali login di lingkungan production.

---

## 🎭 Peran Pengguna (Roles)

Sistem memiliki tiga peran dengan akses berbeda:

### 🔴 Superadmin
- Akses penuh ke seluruh fitur sistem
- Mengelola data master: Barang, Kategori, Satuan
- Mengelola akun pengguna
- Mencatat & menyetujui transaksi barang masuk/keluar (Level 1)
- Melihat semua laporan dan riwayat mutasi

### 🟡 Staff Gudang
- Mencatat pengajuan barang masuk dan barang keluar
- Melihat laporan dan riwayat mutasi
- Tidak dapat mengakses data master atau manajemen user

### 🟢 Pimpinan
- Memberikan persetujuan **final (Level 2)** untuk transaksi yang sudah disetujui Superadmin
- Melihat laporan dan riwayat mutasi
- Tidak dapat mencatat transaksi baru

---

## 🔄 Alur Approval

Setiap transaksi barang masuk dan keluar mengikuti alur berikut:

```
Staff/Superadmin         Superadmin              Pimpinan
     │                       │                       │
     ▼                       ▼                       ▼
[Buat Pengajuan]  →  [Review & Setujui]  →  [Persetujuan Final]
                     (pending_superadmin)    (pending_pimpinan)
                              │                       │
                         [Tolak]               [Tolak / Setuju]
                              │                       │
                         [Ditolak]         [Ditolak / Approved]
```

| Status | Keterangan |
|---|---|
| `pending_superadmin` | Menunggu persetujuan Superadmin |
| `pending_pimpinan` | Sudah disetujui Superadmin, menunggu Pimpinan |
| `approved` | Disetujui penuh — stok otomatis ter-update |
| `rejected` | Ditolak pada salah satu level |

> Stok barang **hanya berubah** setelah status transaksi menjadi `approved` oleh Pimpinan.

---

## 📁 Struktur Proyek

```
sistem_gudang/
├── app/
│   ├── Http/Controllers/       # Controller untuk setiap modul
│   ├── Models/                 # Eloquent Models
│   └── Exports/                # Kelas export Excel (Maatwebsite)
├── database/
│   ├── migrations/             # Migrasi tabel database
│   └── seeders/                # Seeder data awal
├── resources/
│   ├── css/app.css             # Entry point CSS (Tailwind)
│   ├── js/app.js               # Entry point JavaScript
│   └── views/
│       ├── layouts/            # Layout utama (app, guest/login)
│       ├── auth/               # Halaman autentikasi
│       ├── dashboard.blade.php # Dashboard
│       ├── items/              # Manajemen Barang
│       ├── categories/         # Kategori
│       ├── units/              # Satuan
│       ├── stock_ins/          # Barang Masuk
│       ├── stock_outs/         # Barang Keluar
│       ├── approvals/          # Halaman Approval
│       ├── mutations/          # Riwayat Mutasi
│       ├── reports/            # Laporan (HTML + PDF)
│       └── users/              # Manajemen User
├── routes/web.php              # Definisi semua route
├── .env.example                # Template konfigurasi environment
├── composer.json               # Dependensi PHP
└── package.json                # Dependensi Node.js
```

---

## 🔧 Perintah Artisan Berguna

```bash
# Membersihkan semua cache
php artisan optimize:clear

# Melihat semua route yang terdaftar
php artisan route:list

# Masuk ke mode maintenance
php artisan down

# Keluar dari mode maintenance
php artisan up
```

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik dan internal perusahaan.  
Dibangun di atas [Laravel Framework](https://laravel.com) yang bersifat open-source di bawah [MIT License](https://opensource.org/licenses/MIT).

---

<p align="center">
  Dibuat dengan ❤️ menggunakan <strong>Laravel 12</strong> + <strong>TailwindCSS</strong>
</p>
