<?php
session_start();

// Check if username is set in session, if not redirect to login page
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit;
}

// Retrieve username from session
$username = $_SESSION['username'];

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
// Query to retrieve medical appointments for the user
$sql = "SELECT * FROM medical_appointments $username"; // Assuming each user has their own table

$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Appointments</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Medical Appointments</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Hospital Branch</th>
            <th>Specialization</th>
        </tr>
        <?php
        // Display medical appointments in table rows
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['appointmentDate'] . "</td>";
                echo "<td>" . $row['hospitalBranch'] . "</td>";
                echo "<td>" . $row['specialization'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No appointments found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>