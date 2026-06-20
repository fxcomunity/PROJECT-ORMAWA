<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Ormawa</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <form action="koneksi/add_registrasi.php" method="POST" onsubmit="return validateForm()">
        <div class="form-wrapper">
            
            <div class="login-container">
                <h2>Form Registrasi</h2>
                <input type="text" name="nim" id="nim" placeholder="Masukkan NIM" required>
                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" required>
                
                <label class="radio-label">Jenis Kelamin:</label>
                <div class="radio-group">
                    <label><input type="radio" name="jeniskel" value="Laki-laki" required> Laki-laki</label>
                    <label><input type="radio" name="jeniskel" value="Perempuan"> Perempuan</label>
                </div>
            </div>

            <div class="login-container">
                <input type="text" name="kelas" id="kelas" placeholder="Masukkan Kelas" required>
                <input type="text" name="prodi" id="prodi" placeholder="Masukkan Program Studi" required>
                <input type="number" name="notelp" id="notelp" placeholder="Masukkan Nomor Telepon" required>
                <input type="text" name="alamat" id="alamat" placeholder="Masukkan Alamat Rumah" required>
                <input type="email" name="email" id="email" placeholder="Masukkan Email Aktif" required>
                <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
                
                <button type="submit">Daftar</button>
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>

        </div>
    </form>
    <script src="javascript/script.js"></script>
</body>
</html>