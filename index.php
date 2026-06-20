<?php
include('koneksi/koneksi.php');

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['id']; // ID dari tabel anggota
$sql = "SELECT * FROM anggota WHERE id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dash.css">
</head>
<body>
    <header class="navbar navbar-dark bg-primary sticky-top p-2 shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler d-md-none" type="button" id="sidebarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= !isset($_GET['page']) || $_GET['page'] == 'home' ? 'active' : '' ?>" href="?page=home">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'profil' ? 'active' : '' ?>" href="?page=profil">
                                <i class="fas fa-user"></i> Profil Anggota
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="koneksi/logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                $file = "pages/$page.php";

                if (file_exists($file)) {
                    include $file;
                } else {
                    include "pages/404.php";
                }
                ?>
            </main>
        </div>
    </div>

    <footer class="text-center mt-5 py-3 bg-light">
        <small>&copy; 2025 Dashboard Ormawa</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/sidebar-toggle.js"></script>
</body>
</html>