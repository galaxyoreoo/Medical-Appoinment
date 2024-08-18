<?php
session_start();
require_once 'koneksi.php';

// Periksa apakah pengguna telah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    exit;
}

$username = $_SESSION['login_user'];

// Ambil nama pasien berdasarkan username
$sql_nama = "SELECT nama_pasien FROM patientsre WHERE username='$username'";
$result_nama = $conn->query($sql_nama);
$row_nama = $result_nama->fetch_assoc();
$nama_pasien = $row_nama['nama_pasien'];

// Ambil data medical record pasien dari database berdasarkan nama pasien
$sql = "SELECT tanggal, dokter_bidang, nama_pasien, umur_pasien, diagnosa, obat FROM patients WHERE nama_pasien='$nama_pasien'";
$result = $conn->query($sql);

$medical_records = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $medical_records[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Record Pasien</title>
    <link rel="stylesheet" href="medpat.css">
</head>
<body>
<nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="navbar-item"></a>
            <a href="../Home/Home.html" class="navbar-item"><i class="fa-solid fa-house"></i>Home</a>
            <a href="../Transaction/transaction.html" class="navbar-item"><i class="fa-solid fa-file-invoice"></i>Notification</a>
            <div class="navbar-item search-bar"> <!-- Change this to a div -->
                <input type="text" placeholder="Search..."> <!-- Change to an input element -->
                <button type="submit"><i class="fa-solid fa-search"></i></button> <!-- Add a search button -->
            </div>
        </div>
        <div class="navbar-right">
            <a href="../Login/login.php" class="navbar-item">Sign In</a>
            <a href="../Login/register.php" class="navbar-item">Sign Up</a>
        </div>
    </nav>
    
    <div class="container">
        <h2>Medical Record Pasien</h2>
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Dokter Bidang</th>
                <th>Nama Pasien</th>
                <th>Umur Pasien</th>
                <th>Gejala</th>
                <th>Diagnosa</th>
                <th>Obat</th>
            </tr>
            <?php foreach ($medical_records as $record): ?>
            <tr>
                <td><?php echo $record['tanggal']; ?></td>
                <td><?php echo $record['dokter_bidang']; ?></td>
                <td><?php echo $record['nama_pasien']; ?></td>
                <td><?php echo $record['umur_pasien']; ?></td>
                <td><?php echo $record['gejala']; ?></td>
                <td><?php echo $record['diagnosa']; ?></td>
                <td><?php echo $record['obat']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
