<?php
// ===================================================
// FILE: logout.php
// FUNGSI: Logout admin (hapus session)
// ===================================================

session_start();

// Hapus semua session
session_destroy();

// Redirect ke halaman login
header('Location: login.php');
exit;
?>
