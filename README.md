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
