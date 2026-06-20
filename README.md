# ORMAWA

Sistem informasi keanggotaan ORMAWA berbasis PHP & MySQL.

## Cara Install Project (Buat Pemula Banget)

Tenang, ikuti aja langkah-langkah ini satu-satu pelan-pelan. Nggak perlu jago komputer, yang penting teliti dan jangan buru-buru ya! 😊

### Langkah 1: Buka "CMD" (tempat ngetik perintah komputer)

CMD itu kayak kotak ajaib tempat kita ngetik perintah buat komputer. Caranya buka:

1. Tekan tombol **Windows** + **R** secara bersamaan di keyboard.
2. Nanti muncul kotak kecil. Ketik `cmd` di kotak itu.
3. Tekan **Enter**.
4. Muncul jendela hitam-hitam. Itu namanya CMD. Jangan takut, itu cuma tempat ngetik perintah aja.

### Langkah 2: Pindah ke folder tempat nyimpen project

Di CMD yang sudah terbuka, ketik perintah ini, lalu tekan **Enter**:

```bash
cd C:\laragon\www
```

Ini artinya "pindah ke folder `www` di dalam Laragon". Folder ini tempat semua project website kita disimpan.

### Langkah 3: Download project dari GitHub (namanya "clone")

Sekarang kita mau ambil/download semua file project dari GitHub ke komputer kita. Caranya:

1. Buka halaman repository GitHub project ini di browser.
2. Cari tombol hijau yang namanya **"Code"**, klik tombol itu.
3. Copy link yang muncul (biasanya diakhiri `.git`), contohnya:

```
https://github.com/username/ORMAWA.git
```

4. Balik lagi ke CMD yang masih terbuka tadi. Ketik `git clone` lalu **spasi**, lalu **paste** link yang sudah di-copy. Jadinya kira-kira seperti ini:

```bash
git clone https://github.com/username/ORMAWA.git
```

5. Tekan **Enter**. Tunggu sebentar sampai proses download selesai. Nanti muncul folder baru bernama `ORMAWA` di dalam `C:\laragon\www`.

> 💡 Kalau muncul tulisan error seperti `'git' is not recognized`, itu artinya **Git** belum terinstall di komputer kamu. Download dulu di [git-scm.com](https://git-scm.com/), install seperti install aplikasi biasa (next-next-next aja), baru ulangi langkah ini.

### Langkah 4: Masuk ke folder project-nya

Masih di CMD yang sama, ketik:

```bash
cd ORMAWA
```

lalu tekan **Enter**. Ini artinya "masuk ke dalam folder ORMAWA yang baru di-download".

### Langkah 5: Buat database-nya

Database itu tempat nyimpen data, kayak data anggota, login, dll. Caranya:

1. Buka **Laragon**, klik tombol **Start All** (biar Apache & MySQL nyala, tandanya jadi warna hijau).
2. Buka browser, ketik di address bar: `localhost/phpmyadmin`
3. Klik menu **"New"** / **"Baru"** di sebelah kiri.
4. Ketik nama database, misalnya `ormawa`, lalu klik **Create**.
5. Kalau ada file `.sql` di dalam project (biasanya nama file-nya seperti `ormawa.sql`), klik database yang baru dibuat, lalu klik tab **Import**, pilih file `.sql` tersebut, lalu klik **Go** di bagian bawah.
6. Kalau belum ada file `.sql`, kamu bisa bikin tabel manual pakai query yang ada di bagian [Struktur Tabel](#struktur-tabel) di bawah halaman ini. Tinggal copy-paste ke kotak **SQL** di phpMyAdmin lalu klik **Go**.

### Langkah 6: Atur koneksi ke database

Buka folder project (`ORMAWA`) pakai aplikasi seperti **VS Code**. Cari file koneksi database, biasanya ada di folder `koneksi/`. Buka filenya, lalu pastikan isinya seperti ini:

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

> Kalau nama database kamu beda (bukan `ormawa`), ganti bagian `$db` sesuai nama database yang kamu buat di Langkah 5.

### Langkah 7: Pasang library FPDF (buat fitur cetak PDF)

Project ini butuh "alat tambahan" namanya FPDF, supaya bisa cetak/export PDF. Cara pasangnya ada lengkap di bagian [Dependency: FPDF (Vendor)](#dependency-fpdf-vendor) di bawah. Ikuti aja salah satu caranya (boleh pakai Composer, boleh download manual).

### Langkah 8: Buka website-nya! 🎉

1. Pastikan **Laragon** masih nyala (tombol Start All tadi).
2. Buka browser, ketik:

```
http://localhost/ORMAWA/index.php
```

3. Kalau muncul tampilan website, berarti **berhasil!** 🎊

### Langkah 9: Coba daftar & login

- Buka halaman `registrasi.php` dulu buat bikin akun baru.
- Habis itu buka `login.php` buat masuk pakai akun yang baru dibuat.

Selesai! Kalau ada error, baca pesan errornya baik-baik, biasanya kasih tau bagian mana yang salah (misal koneksi database, atau file yang nggak ketemu).

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
