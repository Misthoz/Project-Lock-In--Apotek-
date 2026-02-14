<?php
$db = mysqli_connect("localhost", "root", "", "db_apotek");

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
