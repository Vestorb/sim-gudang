# 📦 Sistem Informasi Gudang

Aplikasi web berbasis **Laravel** yang dirancang untuk membantu pengelolaan data barang di gudang secara efektif dan efisien, mulai dari data master hingga transaksi barang masuk dan barang keluar.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.x-blue?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql)
![Status](https://img.shields.io/badge/Status-Completed-success?style=for-the-badge)

---

# 📖 Deskripsi

Sistem Informasi Gudang merupakan aplikasi berbasis web yang membantu proses pengelolaan stok barang, data kategori, supplier, transaksi barang masuk, transaksi barang keluar, serta pembuatan laporan secara cepat dan akurat.

---

# ✨ Fitur

- 🔐 Login & Autentikasi
- 📊 Dashboard
- 📦 Manajemen Barang
- 🏷️ Manajemen Kategori
- 🏢 Manajemen Supplier
- 📥 Barang Masuk
- 📤 Barang Keluar
- 📄 Laporan Barang
- 🖨️ Cetak Laporan PDF

---

# 🛠️ Teknologi yang Digunakan

| Teknologi | Keterangan |
|-----------|------------|
| Laravel | Framework PHP |
| PHP | Bahasa Pemrograman |
| MySQL | Database |
| Tailwind CSS | Framework CSS |
| Vite | Build Tool |

---

# ⚙️ Instalasi

### Clone Repository

```bash
git clone https://github.com/Vestorb/sim-gudang.git
```

Masuk ke folder project

```bash
cd sim-gudang
```

Install dependency PHP

```bash
composer install
```

Copy file environment

```bash
cp .env.example .env
```

Generate key

```bash
php artisan key:generate
```

Jalankan migrasi database

```bash
php artisan migrate --seed
```

Install dependency frontend

```bash
npm install
```

Compile asset

```bash
npm run dev
```

Jalankan aplikasi

```bash
php artisan serve
```

---

# 📷 Screenshot

Tambahkan screenshot aplikasi di sini.

Contoh:

| Dashboard |
|-----------|
| ![](images/dashboard.PNG) |

| Kategori |
|-----------|
| ![](images/kategori.PNG) |

| Supplier |
|-----------|
| ![](images/supplier.PNG) |

| Supplier |
|-----------|
| ![](images/gudang.PNG) |

| Barang |
|---------|--------------|
| ![](images/barang.PNG) |

| Barang Masuk | Barang Keluar |
|----------------|
| ![](images/barang-masuk.PNG) | ![](images/barang-keluar.png) |

---

# 👥 Tim Pengembang

| No | Nama | NIM |
|----|----------------------|-----------|
| 1 | Aristya Novandhika | 251220021 |
| 2 | Moh Luthfi Wardhana | 251220022 |
| 3 | Ferdy Maulana | 251220039 |

---

## 📄 License

Project ini dibuat untuk memenuhi UAS mata kuliah **Sistem Informasi Gudang**.