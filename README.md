# 📦 Stockly

### Sales & Inventory Management System

**Aplikasi internal untuk bisnis — kelola stok, catat penjualan, dan pantau aktivitas bisnis dalam satu tempat.**

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=flat-square\&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4-38bdf8?style=flat-square\&logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.2-777bb4?style=flat-square\&logo=php)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)


<img width="948" height="539" alt="image" src="https://github.com/user-attachments/assets/32544f41-aae8-476a-8d4e-0109f5ddeb13" />


---

## ✨ Tentang Stockly

**Stockly** adalah sistem manajemen stok dan penjualan yang dibangun untuk bisnis yang menjual produk fisik.

Fokus utamanya sederhana: **membantu menjaga stok tetap terkontrol dan transaksi tercatat dengan rapi**, tanpa kerumitan yang berlebihan.

Aplikasi ini bersifat **internal** — akun dibuat oleh Admin dan tidak tersedia registrasi publik.

> **Status proyek:** Dalam pengembangan aktif.
> Saat ini tersedia halaman Welcome, Login, Dashboard Admin, dan Dashboard Kasir. Modul Produk, Supplier, Barang Masuk, Penjualan, dan Laporan sedang dalam tahap pengembangan.

---

## 🚀 Fitur

| Halaman               | Deskripsi                                                                                                                   |
| --------------------- | --------------------------------------------------------------------------------------------------------------------------- |
| **Welcome / Landing** | Halaman depan dengan desain SaaS profesional, preview inventory interaktif, dan loading splash.                             |
| **Login**             | Autentikasi berbasis role (Admin & Kasir) dengan akun demo.                                                                 |
| **Dashboard Admin**   | Ringkasan bisnis: total produk, stok, penjualan hari ini, stok menipis, grafik 7 hari, stok menipis, dan transaksi terbaru. |
| **Dashboard Kasir**   | Ringkasan transaksi: penjualan hari ini, total transaksi, produk terjual, transaksi terbaru, dan ringkasan per jam.         |

### 🗺️ Roadmap Modul

* [ ] **Produk** — CRUD lengkap
* [ ] **Kategori** — Pengelompokan produk
* [ ] **Supplier** — Data pemasok
* [ ] **Barang Masuk** — Restock / pembelian
* [ ] **Penjualan** — Transaksi kasir
* [ ] **Laporan** — Rekap dan analitik
* [ ] **Manajemen User** — Kelola akun oleh Admin

---

## 💻 Teknologi

* **Laravel 12** — Framework backend
* **Tailwind CSS 4** — Styling melalui Vite
* **PHP 8.2** — Bahasa pemrograman
* **Vite** — Build tool untuk aset frontend
* **Blade Components** — Komponen UI yang reusable
* **Custom Design System** — Design tokens dan komponen yang konsisten

---

## 🎨 Design System

Stockly menggunakan **design tokens** yang konsisten di seluruh halaman.

| Token        | Nilai     | Penggunaan         |
| ------------ | --------- | ------------------ |
| `background` | `#F8FAFC` | Latar halaman      |
| `surface`    | `#FFFFFF` | Kartu / panel      |
| `primary`    | `#00875A` | Aksen & aksi       |
| `content`    | `#111827` | Teks utama         |
| `muted`      | `#64748B` | Teks sekunder      |
| `line`       | `#E2E8F0` | Border             |
| `danger`     | `#DC2626` | Error / stok habis |
| `warning`    | `#D97706` | Stok menipis       |

### Prinsip Desain

* Clean dan minimal
* Banyak whitespace
* Satu warna aksen utama
* Border yang subtle
* Micro-interaction yang halus
* Responsif
* Fokus pada kemudahan penggunaan
* Tampilan seperti produk SaaS sungguhan, bukan template generik

---

## 🧪 Akun Demo

Login menggunakan akun berikut:

| Role      | Email              | Password      |
| --------- | ------------------ | ------------- |
| **Admin** | `admin@stockly.id` | `password123` |
| **Kasir** | `kasir@stockly.id` | `password123` |

> ⚠️ **Catatan:** Data akun di atas masih bersifat sementara untuk keperluan pengembangan dan demo. Sistem autentikasi akan dipindahkan ke database dan tidak menggunakan akun hardcoded pada versi produksi.

---

## 🛠️ Instalasi & Menjalankan

### Prasyarat

Pastikan sudah menginstall:

* PHP 8.2+
* Composer
* Node.js & npm

### 1. Clone / Salin Project

Jika menggunakan Laragon:

```bash
cd C:\laragon\www
```

Kemudian masuk ke folder project:

```bash
cd Stockly
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

**Windows:**

```bash
copy .env.example .env
```

Kemudian generate application key:

```bash
php artisan key:generate
```

### 4. Install Dependency Frontend

```bash
npm install
```

Build aset frontend:

```bash
npm run build
```

### 5. Jalankan Development Server

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

> Jika menggunakan Laragon, project juga dapat diakses melalui URL virtual host sesuai konfigurasi Laragon.

### Development Mode

Selama pengembangan, gunakan Vite dalam mode watch agar perubahan pada aset frontend dapat langsung diperbarui:

```bash
npm run dev
```

---

## 🗂️ Struktur Folder

Struktur folder yang relevan:

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   └── LoginController.php
│   │   ├── Admin/
│   │   │   └── DashboardController.php
│   │   └── Kasir/
│   │       └── DashboardController.php
│   │
│   └── Middleware/
│       ├── EnsureLogin.php
│       └── EnsureRole.php
│
resources/
└── views/
    ├── welcome.blade.php
    │
    ├── auth/
    │   └── login.blade.php
    │
    ├── admin/
    │   └── dashboard.blade.php
    │
    ├── kasir/
    │   └── dashboard.blade.php
    │
    └── components/
        ├── app-shell.blade.php
        ├── icon.blade.php
        ├── stat-card.blade.php
        ├── status-badge.blade.php
        └── chart-bars.blade.php
```

### Komponen Utama

| Komponen                 | Fungsi                              |
| ------------------------ | ----------------------------------- |
| `app-shell.blade.php`    | Layout sidebar dan topbar responsif |
| `icon.blade.php`         | Ikon SVG terpusat                   |
| `stat-card.blade.php`    | Kartu statistik                     |
| `status-badge.blade.php` | Badge status stok / transaksi       |
| `chart-bars.blade.php`   | Grafik batang berbasis CSS          |

---

## 📄 Lisensi

Proyek ini bersifat **open-source** dan menggunakan [MIT License](LICENSE).

---
