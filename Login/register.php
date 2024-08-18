<?php
session_start();
require_once 'koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nama_pasien = $_POST['nama_pasien'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $no_handphone = $_POST['no_handphone'];
    $birthdate = $_POST['birthdate'];

    // Cek apakah password sama dengan konfirmasi password
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok";
    } else {
        // Hash password sebelum menyimpannya ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah username sudah digunakan
        $sql_check = "SELECT * FROM patientsre WHERE username='$username'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows == 0) {
            // Tambahkan data ke database jika username belum digunakan
            $sql = "INSERT INTO patientsre (username, password, nama_pasien, no_handphone, birthdate) VALUES ('$username', '$hashed_password', '$nama_pasien','$no_handphone', '$birthdate')";

            if ($conn->query($sql) === TRUE) {
                // Registrasi sukses, arahkan ke halaman login atau halaman lain yang sesuai
                header("location: login.php");
                exit;
            } else {
                $error = "Registrasi gagal. Silakan coba lagi.";
            }
        } else {
            $error = "Username sudah digunakan. Silakan gunakan username lain.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pasien</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <div class="container">
        <h2>Registrasi Pasien</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="nama_pasien">Nama Pasien:</label>
            <input type="text" id="nama_pasien" name="nama_pasien" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Konfirmasi Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <label for="no_handphone">No. Handphone:</label>
            <input type="text" id="no_handphone" name="no_handphone">
            
            <label for="birthdate">Tanggal Lahir:</label>
            <input type="date" id="birthdate" name="birthdate" required>
            
            <button type="submit">Daftar</button>
        </form>
        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>Have you an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
