<div align="center">

# 📦 Stockly

### Sales & Inventory Management System

**Aplikasi internal untuk bisnis — kelola stok, catat penjualan, dan pantau aktivitas bisnis dalam satu tempat.**

<br/>

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=flat-square&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4-38bdf8?style=flat-square&logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.2-777bb4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)

</div>

---

## ✨ Tentang Stockly

**Stockly** adalah sistem manajemen stok & penjualan yang dibangun untuk bisnis yang menjual produk fisik. Fokus utamanya sederhana: **membantu Anda menjaga stok tetap terkontrol dan transaksi tercatat rapi**, tanpa kerumitan yang berlebihan.

Aplikasi ini bersifat *internal* — akun dibuat oleh Admin, bukan lewat registrasi publik.

> **Status proyek:** semua modul inti sudah berfungsi — Produk, Kategori, Supplier, Barang Masuk, Penjualan (POS), dan Laporan, dengan stok yang bergerak otomatis mengikuti transaksi.

---
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/49c3f480-2148-4603-a1c9-b0633ca77022" />
<img width="959" height="539" alt="image" src="https://github.com/user-attachments/assets/c745b16c-3a74-4aa6-ad19-337cd99c6362" />


## 🚀 Fitur

| Modul | Deskripsi |
| --- | --- |
| **Welcome / Landing** | Halaman depan gelap sinematik dengan preview dashboard interaktif. |
| **Login** | Autentikasi berbasis role (Admin & Kasir) dengan akun demo. |
| **Dashboard Admin** | Ringkasan bisnis real-time: total produk, stok, penjualan hari ini, stok menipis, grafik 7 hari & transaksi terbaru. |
| **Dashboard Kasir** | Ringkasan transaksi kasir: penjualan hari ini, total transaksi, produk terjual & ringkasan per jam. |
| **Produk** | CRUD lengkap dengan SKU otomatis per kategori (`KODE-0001`), pencarian & filter status stok. |
| **Kategori** | CRUD kategori dengan kode unik sebagai prefiks SKU. |
| **Supplier** | CRUD data pemasok barang. |
| **Barang Masuk** | Catat penerimaan stok dari supplier — stok produk otomatis bertambah & harga beli diperbarui. |
| **Penjualan (POS)** | Kasir membuat transaksi lewat antarmuka keranjang — stok otomatis berkurang, dengan proteksi overselling. |
| **Laporan** | Rekap penjualan, produk terlaris, stok perlu perhatian & riwayat transaksi. |
| **Notifikasi** | Peringatan stok menipis/habis real-time dari database. |

---

## 💻 Teknologi

- **Laravel 12** — framework backend
- **Tailwind CSS 4** — styling (via Vite)
- **PHP 8.2**
- **MySQL** — database
- **Vite** — build tool aset frontend
- **Custom design system** — tokens warna & komponen Blade lestari

---

## 🎨 Design System

Stockly menggunakan tema **gelap sinematik** yang konsisten di seluruh halaman (landing, admin & kasir):

| Token | Nilai | Penggunaan |
| --- | --- | --- |
| `background` | `#0C0C0C` | Latar halaman |
| `surface` | `#101319` | Kartu/panel |
| `primary` | `#00D2FF` | Aksen & aksi (cyan) |
| `content` | `#F1F5F9` | Teks utama |
| `muted` | `#94A3B8` | Teks sekunder |
| `line` | `white/10` | Border tipis |
| `success` | `#34D399` | Stok tersedia / lunas |
| `warning` | `#FBBF24` | Stok menipis |
| `danger` | `#F87171` | Error / stok habis |

**Prinsip desain:** dark cinematic, aksen cyan, panel kaca (glass), micro-interaction halus, animasi scroll-in — konsisten dari landing hingga dashboard.

---

## 🧪 Akun Demo

Login menggunakan akun berikut:

| Role | Email | Password |
| --- | --- | --- |
| **Admin** | `admin@stockly.id` | `password123` |
| **Kasir** | `kasir@stockly.id` | `password123` |

> ⚠️ Ini hanya data sementara untuk keperluan pengembangan & demo. Jangan gunakan di produksi.

---

## 🛠️ Instalasi & Menjalankan

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL

### Langkah
```bash
# 1. Clone / salin project ke server web Anda (mis. C:\laragon\www\Stockly)
cd Stockly

# 2. Install dependency PHP
composer install

# 3. Salin file environment & generate app key
copy .env.example .env
php artisan key:generate

# 4. Siapkan database (sesuaikan kredensial di .env), lalu migrasi + seeder
php artisan migrate --seed

# 5. Install & build aset frontend (Tailwind + Vite)
npm install
npm run build

# 6. Jalankan server development
php artisan serve
```

Kemudian buka `http://127.0.0.1:8000` (atau sesuai URL Laragon Anda).

**Selama pengembangan**, untuk auto-reload aset gunakan mode watch:
```bash
npm run dev
```

---

## 🗂️ Struktur Folder (Relevan)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/LoginController.php        # Autentikasi berbasis session
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── ProdukController.php
│   │   │   ├── KategoriController.php
│   │   │   ├── SupplierController.php
│   │   │   ├── BarangMasukController.php   # Stok masuk (restock)
│   │   │   └── LaporanController.php       # Rekap penjualan & stok
│   │   └── Kasir/
│   │       ├── DashboardController.php
│   │       └── PenjualanController.php     # POS / transaksi kasir
│   ├── Middleware/
│   │   ├── EnsureLogin.php                 # Proteksi halaman setelah login
│   │   └── EnsureRole.php                  # Proteksi berbasis role
│   └── Requests/                           # Validasi form (Produk, Kategori, Supplier)
├── Models/
│   ├── Produk.php  ├── Kategori.php  ├── Supplier.php
│   ├── Penjualan.php  ├── PenjualanItem.php  └── BarangMasuk.php
resources/
└── views/
    ├── welcome.blade.php                   # Halaman landing
    ├── auth/login.blade.php                # Halaman login
    ├── admin/                              # dashboard, produk, kategori, supplier,
    │                                       # barang-masuk, laporan
    ├── kasir/                              # dashboard, penjualan (POS)
    └── components/                         # Komponen Blade lestari
        ├── app-shell.blade.php             # Layout sidebar + topbar responsif
        ├── icon.blade.php                  # Ikon SVG terpusat
        ├── stat-card.blade.php             # Kartu statistik
        ├── status-badge.blade.php          # Badge status (stok/transaksi)
        └── chart-bars.blade.php            # Grafik batang (CSS murni)
```

---

## 📄 Lisensi

Proyek ini bersifat open-source di bawah lisensi **MIT**.

---

<div align="center">

Dibuat dengan ❤️ untuk bisnis yang lebih tertata.

</div>
