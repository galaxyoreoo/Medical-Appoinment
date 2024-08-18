<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $dokter_bidang = $_POST['dokter_bidang'];
    $nama_pasien = $_POST['nama_pasien'];
    $umur_pasien = $_POST['umur_pasien'];
    $gejala = $_POST['gejala'];
    $diagnosa = $_POST['diagnosa'];
    $obat = $_POST['obat'];

    $sql = "INSERT INTO patients (tanggal, dokter_bidang, nama_pasien, umur_pasien, gejala, diagnosa, obat) VALUES ('$tanggal', '$dokter_bidang', '$nama_pasien', '$umur_pasien', '$gejala', '$diagnosa', '$obat')";

    if ($conn->query($sql) === TRUE) {
        echo "Data pasien berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="mimin.css">
</head>
<body>
    <div class="container">
        <h2>Form Input Pasien</h2>
        <form action="" method="post">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>
            
            <label for="dokter_bidang">Dokter Bidang:</label>
            <input type="text" id="dokter_bidang" name="dokter_bidang" required>
            
            <label for="nama_pasien">Nama Pasien:</label>
            <input type="text" id="nama_pasien" name="nama_pasien" required>
            
            <label for="umur_pasien">Umur Pasien:</label>
            <input type="number" id="umur_pasien" name="umur_pasien" required>

            <label for="gejala">Gejala:</label>
            <input type="text" id="gejala" name="gejala" required>

            <label for="diagnosa">Diagnosa:</label>
            <input type="text" id="diagnosa" name="diagnosa" required>
            
            <label for="obat">Obat:</label>
            <input type="text" id="obat" name="obat" required>
            
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
