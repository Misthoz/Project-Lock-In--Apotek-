<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_apotek";

$db = mysqli_connect($host, $user, $pass, $dbname);

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Start session jika belum
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}
?>