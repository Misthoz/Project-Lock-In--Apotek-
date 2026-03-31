<?php
// ===================================================
// FILE: process_order.php
// FUNGSI: Approve atau Cancel pesanan dari admin
// ===================================================

include '../../config/db.php';

// Ambil data yang dikirim dari form
$action = $_POST['action'];           // approve atau cancel
$id_pemesanan = $_POST['id_pemesanan']; // ID pesanan

// --- PROSES APPROVE ---
if ($action == 'approve') {
    // Update status jadi 'selesai'
    $query = "UPDATE pemesanan SET status = 'selesai' WHERE id_pemesanan = $id_pemesanan";
    mysqli_query($db, $query);
    
    // Redirect kembali ke halaman admin
    header('Location: admin-panel.php?msg=approved');
    exit;
}

// --- PROSES CANCEL ---
if ($action == 'cancel') {
    // Update status jadi 'dibatalkan'
    $query = "UPDATE pemesanan SET status = 'dibatalkan' WHERE id_pemesanan = $id_pemesanan";
    mysqli_query($db, $query);
    
    // Redirect kembali ke halaman admin
    header('Location: admin-panel.php?msg=cancelled');
    exit;
}
?>
