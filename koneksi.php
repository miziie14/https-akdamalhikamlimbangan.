<?php
// koneksi.php
$host = "localhost";
$user = "u193532380_akdam"; // Ganti dengan user database Hostinger
$pass = "Dhuyuand05@"; // Ganti dengan password database
$db   = "u193532380_akdam"; // Ganti dengan nama database

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>