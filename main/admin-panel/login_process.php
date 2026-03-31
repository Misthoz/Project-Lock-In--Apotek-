<?php
// ===================================================
// FILE: login_process.php
// FUNGSI: Proses login admin
// ===================================================

session_start();
include '../../config/db.php';

// ============================================
// 1. AMBIL DATA DARI FORM
// ============================================
$no_hp = trim($_POST['no_hp']);

// Cek apakah no_hp kosong
if (empty($no_hp)) {
    header('Location: login.php?error=empty');
    exit;
}

// ============================================
// 2. CEK DI DATABASE
// ============================================
// Cari user berdasarkan no_hp
$no_hp_escaped = mysqli_real_escape_string($db, $no_hp);
$query = "SELECT * FROM user WHERE no_hp = '$no_hp_escaped' AND role = 'admin'";
$result = mysqli_query($db, $query);

// DEBUG: Tampilkan error MySQL jika ada
if (!$result) {
    die("Query error: " . mysqli_error($db));
}

// Cek apakah admin ditemukan
if (mysqli_num_rows($result) == 0) {
    // Coba cek apakah user exist tapi bukan admin
    $query_check = "SELECT * FROM user WHERE no_hp = '$no_hp_escaped'";
    $result_check = mysqli_query($db, $query_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        // User ada tapi bukan admin
        header('Location: login.php?error=notadmin');
        exit;
    } else {
        // User tidak ditemukan sama sekali
        header('Location: login.php?error=wrong');
        exit;
    }
}

// ============================================
// 3. LOGIN BERHASIL - SIMPAN SESSION
// ============================================
$user = mysqli_fetch_assoc($result);

$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_id'] = $user['id_user'];
$_SESSION['admin_nama'] = $user['nama'];
$_SESSION['admin_no_hp'] = $user['no_hp'];

// Redirect ke admin panel
header('Location: admin-panel.php');
exit;
?>
