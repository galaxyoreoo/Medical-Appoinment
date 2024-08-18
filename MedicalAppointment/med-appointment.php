<?php
// Mulai sesi PHP
session_start();

// Cek apakah pengguna sudah login atau belum, jika belum redirect ke halaman login
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Hubungkan ke database
$servername = "localhost"; // Ganti dengan hostname server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "improject"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data janji medis dari form
$hospitalBranch = $_POST['hospitalBranch'];
$specialization = $_POST['specialization'];
$appointmentDate = $_POST['appointmentDate'];
$username = $_SESSION['username']; // Ambil nama pasien dari sesi

// Menyimpan data janji medis ke dalam database
$sql = "INSERT INTO medical_appointments (username, hospitalBranch, specialization, appointmentDate)
        VALUES ('$username', '$hospitalBranch', '$specialization', '$appointmentDate')";

if ($conn->query($sql) === TRUE) {
    header("Location: med-appo-choose.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi ke database
$conn->close();
?>