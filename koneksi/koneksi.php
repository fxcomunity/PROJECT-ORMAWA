<?php
session_start();
$host = "localhost";
$db = "ormawa";
$user = "root";
$pass = "";

// Koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>