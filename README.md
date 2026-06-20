# ORMAWA

Sistem informasi keanggotaan ORMAWA berbasis PHP & MySQL.

## Cara Install Project

Berikut langkah-langkah untuk menjalankan project ini di komputer lokal.

### 1. Clone Repository

```bash
git clone https://github.com/username/ORMAWA.git
cd ORMAWA
```

> Ganti URL di atas dengan URL repository kamu yang sebenarnya.

### 2. Pindahkan ke Folder Web Server

Jika menggunakan **Laragon**, pastikan folder project berada di:

```
C:\laragon\www\ORMAWA
```

Jika clone langsung ke folder tersebut, langkah ini bisa dilewati.

### 3. Setup Database

1. Buka **phpMyAdmin** atau **HeidiSQL** (bawaan Laragon), lalu buat database baru, misalnya:

```sql
CREATE DATABASE ormawa;
```

2. Import struktur tabel. Jika tersedia file `.sql` (misal `ormawa.sql`), import melalui phpMyAdmin, atau lewat terminal:

```bash
mysql -u root -p ormawa < ormawa.sql
```

3. Jika belum ada file `.sql`, buat tabel secara manual menggunakan query pada bagian [Struktur Tabel](#struktur-tabel) di bawah.

### 4. Konfigurasi Koneksi Database

Buka file koneksi database project (umumnya ada di folder `koneksi/`, misal `koneksi/koneksi.php`), lalu sesuaikan dengan konfigurasi lokal:

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ormawa";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
```

> Sesuaikan `$user`, `$pass`, dan `$db` dengan konfigurasi MySQL di komputer kamu.

### 5. Install Dependency (Vendor / FPDF)

Project ini membutuhkan library **FPDF** untuk fitur export PDF. Folder `vendor` tidak disertakan di repository, sehingga perlu di-setup ulang. Lihat panduan lengkapnya di bagian [Dependency: FPDF (Vendor)](#dependency-fpdf-vendor) di bawah.

Cara cepat (lewat Composer):

```bash
composer require setasign/fpdf
```

### 6. Jalankan Project

Pastikan **Laragon** (atau Apache + MySQL) sudah berjalan, lalu buka browser dan akses:

```
http://localhost/ORMAWA/index.php
```

atau jika menggunakan PHP built-in server:

```bash
php -S localhost:8000
```

lalu buka `http://localhost:8000`.

### 7. Cek Login / Registrasi

Buka halaman `registrasi.php` untuk membuat akun anggota baru, lalu login melalui `login.php` untuk mengakses sistem.

---

# Tabel `anggota`

Dokumentasi struktur tabel `anggota` yang digunakan untuk menyimpan data anggota (mahasiswa) pada sistem.

## Struktur Tabel

```sql
CREATE TABLE anggota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(8) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    gender ENUM('Laki-Laki', 'Perempuan') NOT NULL,
    notelp VARCHAR(13) NOT NULL,
    email VARCHAR(100) NOT NULL,
    kelas VARCHAR(10) NOT NULL,
    prodi VARCHAR(50) NOT NULL,
    alamat TEXT NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

## Deskripsi Kolom

| Kolom      | Tipe Data       | Keterangan                                          |
|------------|-----------------|------------------------------------------------------|
| `id`       | `INT`           | Primary key, auto increment, ID unik tiap anggota   |
| `nim`      | `VARCHAR(8)`    | Nomor Induk Mahasiswa, wajib diisi                  |
| `nama`     | `VARCHAR(100)`  | Nama lengkap anggota, wajib diisi                   |
| `gender`   | `ENUM`          | Jenis kelamin: `'Laki-Laki'` atau `'Perempuan'`     |
| `notelp`   | `VARCHAR(13)`   | Nomor telepon anggota, wajib diisi                  |
| `email`    | `VARCHAR(100)`  | Alamat email anggota, wajib diisi                   |
| `kelas`    | `VARCHAR(10)`   | Kelas anggota, wajib diisi                          |
| `prodi`    | `VARCHAR(50)`   | Program studi anggota, wajib diisi                  |
| `alamat`   | `TEXT`          | Alamat lengkap anggota, wajib diisi                 |
| `password` | `VARCHAR(255)`  | Password akun (disarankan disimpan dalam bentuk hash) |

## Catatan

- Kolom `id` digunakan sebagai **primary key** dan terisi otomatis (`AUTO_INCREMENT`).
- Kolom `gender` dibatasi hanya menerima dua nilai (`ENUM`): `Laki-Laki` atau `Perempuan`.
- Kolom `password` sebaiknya **tidak disimpan dalam bentuk teks biasa**. Gunakan fungsi hashing seperti `bcrypt`, `password_hash()` (PHP), atau library hashing lain sebelum disimpan ke database.
- Semua kolom bersifat `NOT NULL`, artinya wajib diisi saat melakukan insert data baru.
- Disarankan menambahkan constraint `UNIQUE` pada kolom `nim` dan `email` jika nilai-nilai tersebut harus unik per anggota, contoh:

```sql
ALTER TABLE anggota
    ADD UNIQUE (nim),
    ADD UNIQUE (email);
```

## Contoh Query

### Insert Data

```sql
INSERT INTO anggota (nim, nama, gender, notelp, email, kelas, prodi, alamat, password)
VALUES (
    '21010001',
    'Budi Santoso',
    'Laki-Laki',
    '081234567890',
    'budi.santoso@email.com',
    'TI-3A',
    'Teknik Informatika',
    'Jl. Merdeka No. 10, Jakarta',
    'hashed_password_disini'
);
```

### Select Data

```sql
SELECT id, nim, nama, gender, kelas, prodi
FROM anggota
ORDER BY nama ASC;
```

### Update Data

```sql
UPDATE anggota
SET notelp = '081298765432', alamat = 'Jl. Sudirman No. 5, Jakarta'
WHERE nim = '21010001';
```

### Delete Data

```sql
DELETE FROM anggota
WHERE nim = '21010001';
```

## Dependency: FPDF (Vendor)

Project ini menggunakan library [FPDF](https://www.fpdf.org/) untuk fitur generate/export PDF. Folder `vendor` **tidak disertakan di repository** (lihat `.gitignore`) karena bisa di-generate ulang dengan mudah. Berikut cara setup-nya.

### Opsi 1: Menggunakan Composer (Disarankan)

Jika project menggunakan Composer, jalankan:

```bash
composer require setasign/fpdf
```

Folder `vendor/setasign/fpdf` beserta `composer.json` dan `composer.lock` akan otomatis terbuat. Untuk setup ulang di komputer lain, cukup jalankan:

```bash
composer install
```

### Opsi 2: Download Manual

1. Buka halaman download resmi FPDF: [https://www.fpdf.org/en/dl.php?v=186&f=zip](https://www.fpdf.org/en/dl.php?v=186&f=zip)
2. Extract file zip yang didownload.
3. Salin seluruh isi hasil extract ke dalam folder `vendor` pada root project, sehingga strukturnya menjadi:

```
ORMAWA/
├── vendor/
│   ├── doc/
│   ├── font/
│   ├── makefont/
│   ├── tutorial/
│   ├── changelog.htm
│   ├── FAQ.htm
│   ├── fpdf.css
│   ├── fpdf.php
│   ├── install.txt
│   └── license.txt
├── pages/
├── koneksi/
├── index.php
└── ...
```

4. Include file utamanya di kode PHP:

```php
require('vendor/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Hello World!');
$pdf->Output();
```

### Catatan

- Folder `vendor` sebaiknya ditambahkan ke `.gitignore` agar tidak ikut di-commit ke Git, karena:
  - Ukurannya bisa besar dan tidak perlu disimpan di version control.
  - Bisa di-generate ulang kapan saja dari Composer atau didownload ulang secara manual.
- Tambahkan baris berikut ke `.gitignore` jika belum ada:

```
/vendor/
```
