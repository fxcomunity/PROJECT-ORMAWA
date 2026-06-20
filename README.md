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
