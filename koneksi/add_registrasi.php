<?php
include('koneksi.php');

// Ambil data dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jeniskel = $_POST['jeniskel'];
$kelas = $_POST['kelas'];
$prodi = $_POST['prodi'];
$no_hp = $_POST['notelp'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$password = md5($_POST['password']);

// Simpan ke database
$sql = "INSERT INTO anggota (nim, nama, gender, kelas, prodi, notelp, alamat, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $nim, $nama, $jeniskel, $kelas, $prodi, $no_hp, $alamat, $email, $password);

if ($stmt->execute()) {
    echo "<script>alert('Registrasi berhasil!'); window.location='../login.php'; </script>";
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>