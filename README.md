# 📚 Perpus Digital

**Perpus Digital** adalah aplikasi perpustakaan berbasis web yang dibuat untuk membantu proses pengelolaan data perpustakaan secara lebih mudah, terstruktur, dan efisien.

Aplikasi ini dikembangkan menggunakan **Laravel** sebagai framework utama dan ditujukan untuk mendukung proses pengelolaan buku serta transaksi peminjaman di lingkungan perpustakaan.

---

## ✨ Fitur

Beberapa fitur yang tersedia dalam aplikasi **Perpus Digital** antara lain:

* 🔐 **Login & Authentication**

  * Login pengguna
  * Pengelolaan akses berdasarkan role

* 📖 **Manajemen Buku**

  * Menampilkan daftar buku
  * Menambahkan data buku
  * Mengubah data buku
  * Menghapus data buku
  * Melihat informasi/detail buku

* 👤 **Manajemen Pengguna**

  * Pengelolaan data pengguna
  * Role pengguna seperti Admin dan Siswa

* 🔄 **Transaksi Peminjaman**

  * Melakukan peminjaman buku
  * Melihat data transaksi peminjaman
  * Pengelolaan transaksi oleh Admin

* 🔎 **Katalog Buku**

  * Melihat koleksi buku yang tersedia
  * Mencari dan memilih buku

* 📊 **Dashboard**

  * Menampilkan informasi dan ringkasan data perpustakaan

---

## 🛠️ Teknologi yang Digunakan

| Teknologi      | Keterangan                    |
| -------------- | ----------------------------- |
| PHP            | 8.3+                          |
| Laravel        | 13                            |
| MySQL / SQLite | Database                      |
| Blade          | Template Engine               |
| Tailwind CSS   | Styling                       |
| Vite           | Frontend Build Tool           |
| Composer       | PHP Dependency Manager        |
| NPM            | JavaScript Dependency Manager |

Project ini menggunakan struktur standar Laravel dengan folder seperti `app`, `config`, `database`, `public`, `resources`, `routes`, dan `tests`.

---

## 📋 Requirements

Sebelum menjalankan project, pastikan perangkat sudah memiliki:

* PHP >= 8.3
* Composer
* Node.js & NPM
* MySQL atau SQLite
* Git

---

## 🚀 Installation

### 1. Clone Repository

```bash
git clone https://github.com/aurellia1112/Perpus_digital.git
```

Masuk ke folder project:

```bash
cd Perpus_digital
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Install Dependency Frontend

```bash
npm install
```

### 4. Buat File Environment

Copy file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file `.env`, kemudian sesuaikan konfigurasi database.

Contoh menggunakan MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus_digital
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `perpus_digital` sudah dibuat di MySQL.

### 7. Jalankan Migration

```bash
php artisan migrate
```

Jika ingin menjalankan migration sekaligus mengisi data awal dari seeder:

```bash
php artisan migrate:fresh --seed
```

> Pastikan menggunakan **dua tanda minus biasa `--`**, bukan tanda `–`.

### 8. Jalankan Project

Jalankan server Laravel:

```bash
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

---

## 💻 Menjalankan Frontend

Untuk development, jalankan:

```bash
npm run dev
```

Biasanya development environment dijalankan dengan dua terminal:

**Terminal 1**

```bash
php artisan serve
```

**Terminal 2**

```bash
npm run dev
```

---

## 📁 Struktur Project

```text
Perpus_digital/
│
├── app/
│   ├── Http/
│   ├── Models/
│   └── Providers/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   ├── console.php
│   └── web.php
│
├── storage/
│
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## 👥 Role Pengguna

### 👑 Admin

Admin memiliki akses untuk mengelola sistem perpustakaan, seperti:

* Mengelola data buku
* Mengelola data pengguna
* Mengelola transaksi peminjaman
* Melihat data perpustakaan

### 👨‍🎓 Siswa

Siswa dapat menggunakan sistem untuk:

* Melihat katalog buku
* Melihat informasi buku
* Melakukan peminjaman buku
* Melihat informasi peminjaman

---

## 🔄 Alur Sistem

```text
                    ┌───────────────┐
                    │     Login     │
                    └───────┬───────┘
                            │
                  ┌─────────┴─────────┐
                  │                   │
             ┌────▼────┐         ┌────▼────┐
             │  Admin  │         │  Siswa  │
             └────┬────┘         └────┬────┘
                  │                   │
          ┌───────┼───────┐      ┌────▼─────┐
          │       │       │      │  Katalog  │
          ▼       ▼       ▼      │   Buku    │
        Buku   User   Transaksi  └────┬─────┘
                                      │
                                      ▼
                                Peminjaman
```

---

## 🧪 Testing

Untuk menjalankan testing Laravel:

```bash
php artisan test
```

Atau:

```bash
composer test
```

---

## 🔧 Useful Artisan Commands

Membersihkan cache:

```bash
php artisan optimize:clear
```

Menjalankan migration:

```bash
php artisan migrate
```

Reset database dan menjalankan seeder:

```bash
php artisan migrate:fresh --seed
```

Melihat daftar route:

```bash
php artisan route:list
```

Menjalankan server:

```bash
php artisan serve
```

---

## 📌 Status Project

🚧 **Development**

Project ini masih dalam tahap pengembangan dan dapat dikembangkan lebih lanjut dengan penambahan fitur seperti:

* 📅 Pengembalian buku
* ⏰ Sistem denda keterlambatan
* 📧 Notifikasi peminjaman
* 📊 Laporan perpustakaan
* 🔍 Search & filter buku yang lebih lengkap
* 📱 Responsive design
* 📈 Statistik perpustakaan

---

## 👩‍💻 Developer

**Aurellia**

GitHub:
https://github.com/aurellia1112

Repository:
https://github.com/aurellia1112/Perpus_digital

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran dan pengembangan aplikasi perpustakaan berbasis web.

Framework Laravel menggunakan lisensi MIT.
