<?php
// ===================================================
// ADMIN PANEL - KELOLA PESANAN
// ===================================================

include '../../config/db.php';

// ============================================
// CEK AUTENTIKASI ADMIN
// ============================================
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Ambil data admin yang login
$admin_username = $_SESSION['admin_username'] ?? 'admin';

// ============================================
// 1. AMBIL DATA PESANAN YANG MENUNGGU
// ============================================
$query = "SELECT p.*, u.nama, u.no_hp 
          FROM pemesanan p 
          JOIN user u ON p.id_user = u.id_user 
          WHERE p.status = 'menunggu' 
          ORDER BY p.tanggal_pesan DESC";

$result = mysqli_query($db, $query);
$pesanan_menunggu = [];

while ($row = mysqli_fetch_assoc($result)) {
    $pesanan_menunggu[] = $row;
}

// ============================================
// 2. HITUNG STATISTIK
// ============================================
// Hitung total pesanan menunggu
$total_menunggu = count($pesanan_menunggu);

// Hitung total revenue (dari pesanan selesai)
$query_revenue = "SELECT SUM(CAST(total_harga AS UNSIGNED)) as total FROM pemesanan WHERE status = 'selesai'";
$result_revenue = mysqli_query($db, $query_revenue);
$revenue_data = mysqli_fetch_assoc($result_revenue);
$total_revenue = $revenue_data['total'] ?? 0;

// Hitung pesanan hari ini
$query_today = "SELECT COUNT(*) as total FROM pemesanan WHERE DATE(tanggal_pesan) = CURDATE()";
$result_today = mysqli_query($db, $query_today);
$today_data = mysqli_fetch_assoc($result_today);
$pesanan_hari_ini = $today_data['total'];

// Hitung total customer
$query_customer = "SELECT COUNT(*) as total FROM user";
$result_customer = mysqli_query($db, $query_customer);
$customer_data = mysqli_fetch_assoc($result_customer);
$total_customer = $customer_data['total'];

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Marcydap Apotek</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin-panel.css">
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <div class="logo-content">
                    <div class="logo-icon">🌿</div>
                    <div class="logo-text">
                        <h2>MARCYDAP</h2>
                        <p>Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-section">
                    <div class="menu-label">Main</div>
                    <a href="admin-panel.php" class="menu-item active">
                        <span class="menu-icon">📊</span>
                        Dashboard
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="page-title">
                    <h1>Dashboard Overview</h1>
                    <div class="breadcrumb">
                        <span> Home</span>
                        <span>›</span>
                        <span>Dashboard</span>
                    </div>
                </div>
                <div class="top-actions">
                    <div class="search-box">
                        <span class="search-icon"></span>
                        <input type="text" placeholder="Search orders, products, customers...">
                    </div>
                    <div class="icon-btn">
                        🔔
                        <span class="notification-dot"></span>
                    </div>
                    <div class="profile-btn">
                        <div class="profile-avatar">👤</div>
                        <div class="profile-info">
                            <h4><?php echo htmlspecialchars($admin_username); ?></h4>
                            <p>Administrator</p>
                        </div>
                    </div>
                    <a href="logout.php" class="logout-btn" title="Logout">
                        🚪
                    </a>
                </div>
            </div>

            <!-- NOTIFIKASI -->
            <?php if (isset($_GET['msg'])) { ?>
                <div style="background: <?php echo $_GET['msg'] == 'approved' ? '#d1fae5' : '#fee2e2'; ?>; 
                            color: <?php echo $_GET['msg'] == 'approved' ? '#065f46' : '#991b1b'; ?>; 
                            padding: 15px; 
                            border-radius: 10px; 
                            margin-bottom: 20px;
                            font-weight: 600;">
                    <?php
                    if ($_GET['msg'] == 'approved') {
                        echo '✓ Pesanan berhasil di-approve!';
                    } else {
                        echo '✕ Pesanan berhasil dibatalkan!';
                    }
                    ?>
                </div>
            <?php } ?>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <!-- Card 1: Total Revenue -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Total Revenue</span>
                        <div class="stat-icon">💰</div>
                    </div>
                    <div class="stat-value">Rp <?php echo number_format($total_revenue, 0, ',', '.'); ?></div>
                    <div class="stat-change up">↑ Dari pesanan selesai</div>
                </div>

                <!-- Card 2: Pesanan Menunggu -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Pesanan Menunggu</span>
                        <div class="stat-icon">⏳</div>
                    </div>
                    <div class="stat-value"><?php echo $total_menunggu; ?></div>
                    <div class="stat-change" style="color: #f59e0b;">⚠ Perlu di-approve</div>
                </div>

                <!-- Card 3: Pesanan Hari Ini -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Pesanan Hari Ini</span>
                        <div class="stat-icon">📦</div>
                    </div>
                    <div class="stat-value"><?php echo $pesanan_hari_ini; ?></div>
                    <div class="stat-change up">↑ Hari ini</div>
                </div>

                <!-- Card 4: Total Customer -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Total Customer</span>
                        <div class="stat-icon">👥</div>
                    </div>
                    <div class="stat-value"><?php echo $total_customer; ?></div>
                    <div class="stat-change up">↑ Terdaftar</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- TABEL PESANAN MENUNGGU -->
                <div class="table-card">
                    <div class="card-header">
                        <h3>📋 Pesanan Menunggu Persetujuan</h3>
                        <div class="filter-tabs">
                            <span class="filter-tab active">Total: <?php echo $total_menunggu; ?></span>
                        </div>
                    </div>

                    <?php if ($total_menunggu > 0) { ?>
                        <!-- Ada pesanan yang menunggu -->
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pesanan_menunggu as $pesanan) {
                                    // Format nomor pesanan jadi 5 digit: 1 -> 00001
                                    $nomor_pesanan = str_pad($pesanan['id_pemesanan'], 5, '0', STR_PAD_LEFT);

                                    // Format tanggal jadi lebih mudah dibaca
                                    $tanggal = date('d M Y, H:i', strtotime($pesanan['tanggal_pesan']));
                                ?>
                                    <tr>
                                        <!-- Nomor Pesanan -->
                                        <td>
                                            <span class="order-id">#MRC-<?php echo $nomor_pesanan; ?></span>
                                        </td>

                                        <!-- Info Customer -->
                                        <td>
                                            <div class="customer-info">
                                                <div class="customer-avatar">👤</div>
                                                <div class="customer-details">
                                                    <h4><?php echo $pesanan['nama']; ?></h4>
                                                    <p><?php echo $pesanan['no_hp']; ?></p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Tanggal -->
                                        <td><?php echo $tanggal; ?></td>

                                        <!--  Total Harga -->
                                        <td><strong>Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></strong></td>

                                        <!-- Tombol -->
                                        <td>
                                            <div class="action-btns">
                                                <!-- TOMBOL APPROVE -->
                                                <form method="POST" action="process_order.php" style="display: inline;">
                                                    <input type="hidden" name="action" value="approve">
                                                    <input type="hidden" name="id_pemesanan" value="<?php echo $pesanan['id_pemesanan']; ?>">
                                                    <button type="submit"
                                                        class="action-btn"
                                                        style="background: #d1fae5; color: #065f46;"
                                                        onclick="return confirm('Approve pesanan #MRC-<?php echo $nomor_pesanan; ?>?')">
                                                        ✓
                                                    </button>
                                                </form>

                                                <!-- TOMBOL CANCEL -->
                                                <form method="POST" action="process_order.php" style="display: inline;">
                                                    <input type="hidden" name="action" value="cancel">
                                                    <input type="hidden" name="id_pemesanan" value="<?php echo $pesanan['id_pemesanan']; ?>">
                                                    <button type="submit"
                                                        class="action-btn"
                                                        style="background: #fee2e2; color: #991b1b;"
                                                        onclick="return confirm('Batalkan pesanan #MRC-<?php echo $nomor_pesanan; ?>?')">
                                                        ✕
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    <?php } else { ?>
                        <!-- Tidak ada pesanan menunggu -->
                        <div style="text-align: center; padding: 60px 20px; color: var(--slate);">
                            <div style="font-size: 60px; margin-bottom: 20px;">✅</div>
                            <h4 style="margin-bottom: 10px; color: var(--ink);">Tidak Ada Pesanan Menunggu</h4>
                            <p>Semua pesanan sudah diproses</p>
                        </div>
                    <?php } ?>
                </div>

                <!-- ACTIVITY FEED -->
                <div class="activity-feed">
                    <div class="card-header">
                        <h3>📊 Ringkasan</h3>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">⏳</div>
                        <div class="activity-content">
                            <h4>Pesanan Menunggu</h4>
                            <p><?php echo $total_menunggu; ?> pesanan perlu di-approve</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">📦</div>
                        <div class="activity-content">
                            <h4>Pesanan Hari Ini</h4>
                            <p><?php echo $pesanan_hari_ini; ?> pesanan masuk hari ini</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">💰</div>
                        <div class="activity-content">
                            <h4>Total Revenue</h4>
                            <p>Rp <?php echo number_format($total_revenue, 0, ',', '.'); ?></p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">👥</div>
                        <div class="activity-content">
                            <h4>Total Customer</h4>
                            <p><?php echo $total_customer; ?> pelanggan terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>

</html>