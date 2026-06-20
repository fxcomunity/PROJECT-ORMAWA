<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Ormawa</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="login-container">
        <h2>Login ORMAWA</h2>
        <form id="loginForm" method="POST" action="koneksi/ceklogin.php" onsubmit="return validateForm()">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p id="errorMessage" class="error-message"></p>
        <p><a href="registrasi.php">Klik Untuk Registrasi</a></p>
    </div>
    <script src="javascript/script.js"></script>
</body>
</html>