<?php
// ===================================================
// ADMIN LOGOUT
// ===================================================

include '../../config/db.php';

// Hapus semua session admin
unset($_SESSION['admin_logged_in']);
unset($_SESSION['admin_username']);

// Redirect ke halaman login
header('Location: login.php');
exit;
