<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_futsal"; // Pastikan nama database ini sama dengan yang kamu buat tadi

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>