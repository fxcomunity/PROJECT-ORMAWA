<?php
require('../vendor/fpdf.php');
require('../koneksi/koneksi.php');

if (!isset($_SESSION['id'])) {
    die("Akses ditolak. Silahkan login.");
}

$id = $_SESSION['id'];
$query = "SELECT * FROM anggota WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan.");
}

// Set ukuran kertas seukuran ID Card (Landscape)
$pdf = new FPDF('L', 'mm', array(85, 54)); 
$pdf->AddPage();

// Membuat border kartu
$pdf->SetDrawColor(0, 0, 0);
$pdf->Rect(2, 2, 81, 50, 'D');

// Cetak Logo
if (file_exists('../img/logo.png')) {
    $pdf->Image('../img/logo.png', 4, 4, 10);
}

// Cetak Judul Kartu
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(16, 6);
$pdf->Cell(60, 4, 'KARTU ANGGOTA ORMAWA', 0, 1, 'L');

// Garis pembatas
$pdf->Line(4, 16, 81, 16);

// Cetak Isi Data Anggota
$pdf->SetFont('Arial', '', 8);

$pdf->SetXY(4, 19); $pdf->Cell(20, 4, 'NIM', 0, 0);
$pdf->Cell(2, 4, ':', 0, 0); $pdf->Cell(50, 4, $data['nim'], 0, 1);

$pdf->SetX(4); $pdf->Cell(20, 4, 'Nama', 0, 0);
$pdf->Cell(2, 4, ':', 0, 0); $pdf->Cell(50, 4, $data['nama'], 0, 1);

$pdf->SetX(4); $pdf->Cell(20, 4, 'Jenis Kelamin', 0, 0);
$pdf->Cell(2, 4, ':', 0, 0); $pdf->Cell(50, 4, $data['gender'], 0, 1);

$pdf->SetX(4); $pdf->Cell(20, 4, 'Kelas', 0, 0);
$pdf->Cell(2, 4, ':', 0, 0); $pdf->Cell(50, 4, $data['kelas'], 0, 1);

$pdf->SetX(4); $pdf->Cell(20, 4, 'Prodi', 0, 0);
$pdf->Cell(2, 4, ':', 0, 0); $pdf->Cell(50, 4, $data['prodi'], 0, 1);

// Cetak Tanggal di pojok kanan bawah
$pdf->SetFont('Arial', 'I', 6);
$pdf->SetY(46);
$pdf->Cell(0, 4, 'Dicetak: ' . date('d-m-Y'), 0, 0, 'R');

$pdf->Output('I', 'kartu-anggota.pdf');
?>