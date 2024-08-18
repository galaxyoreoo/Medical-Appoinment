<?php
session_start();
require_once 'koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username ada di tabel admins
    $sql_admins = "SELECT * FROM admins WHERE username='$username'";
    $result_admins = $conn->query($sql_admins);

    if ($result_admins->num_rows > 0) {
        $row = $result_admins->fetch_assoc();
        if ($password === $row['password']) { // Jika password admin tidak di-hash
            $_SESSION['username'] = $username;
            header("location: admin_dashboard.php");
            exit; // Penting untuk menghentikan eksekusi script setelah melakukan redirect
        }
    }

    // Cek apakah username ada di tabel patientsre
    $sql_patients = "SELECT * FROM patientsre WHERE username='$username'";
    $result_patients = $conn->query($sql_patients);

    if ($result_patients->num_rows > 0) {
        $row = $result_patients->fetch_assoc();
        if (password_verify($password, $row['password'])) { // Jika password pasien di-hash
            $_SESSION['username'] = $username; // Simpan username ke dalam sesi
            header("location: patient_medical_record.php");
            exit; // Penting untuk menghentikan eksekusi script setelah melakukan redirect
        }
    }


    // Jika username tidak ada di kedua tabel, tampilkan pesan kesalahan
    $error = "Username atau password salah";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="log.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>I don't have an account <a href="register.php">Sign in</a></p>
    </div>
</body>
</html>