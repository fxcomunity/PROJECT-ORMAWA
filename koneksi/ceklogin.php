<?php
include('koneksi.php');
$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM anggota WHERE nim = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $anggotaData = $result->fetch_assoc();
    $_SESSION['id'] = $anggotaData['id'];
    header("Location: ../"); // Halaman setelah login (index.php)
    exit;
} else {
    echo "<script>alert('Username atau Password salah!'); window.location='../login.php'; </script>";
}
$conn->close();
?>