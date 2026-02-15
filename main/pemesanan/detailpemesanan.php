<?php
include '../../config/db.php';

// Cek ada id_pemesanan
if (!isset($_SESSION['id_pemesanan'])) {
    header("Location: ../produk.php");
    exit;
}

$id_pemesanan = (int) $_SESSION['id_pemesanan'];

// Query ambil data pemesanan + user
$query = "SELECT p.*, u.nama, u.umur, u.no_hp 
          FROM pemesanan p 
          JOIN user u ON p.id_user = u.id_user 
          WHERE p.id_pemesanan = $id_pemesanan";
$result = mysqli_query($db, $query);
$pesanan = mysqli_fetch_assoc($result);

if (!$pesanan) {
    header("Location: ../produk.php");
    exit;
}

// Query ambil detail item
$query_detail = "SELECT dp.*, b.nama_barang, b.gambar 
                 FROM detail_pemesanan dp 
                 JOIN barang b ON dp.id_barang = b.id_barang 
                 WHERE dp.id_pemesanan = $id_pemesanan";
$result_detail = mysqli_query($db, $query_detail);

// Format tanggal
$tanggal = date('d F Y, H:i', strtotime($pesanan['tanggal_pesan']));

// Metode pembayaran label
$metode_label = $pesanan['metode_pembayaran'] === 'ewallet' ? 'E-Wallet' : 'Bayar di Tempat (COD)';

// Bersihkan session id_pemesanan
unset($_SESSION['id_pemesanan']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan - Marcydap Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/detailpemesanan.css">
</head>

<body>
    <!-- Header -->


    <header class="header sticky-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <a href="../dashboard.php" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="logo-icon"></div>
                    <div class="logo-text">
                        <h1>MARCYDAP</h1>
                        <p>APOTEK</p>
                    </div>
                </a>
                <a href="../produk.php" class="back-btn">← Kembali ke Produk</a>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <!-- Status Banner -->
        <div class="status-banner mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-4 position-relative" style="z-index:1;">
                <div class="status-info">
                    <h1>Pesanan Berhasil! ✓</h1>
                    <div class="d-flex gap-4 flex-wrap">
                        <div>
                            <span class="meta-label d-block">No. Pesanan</span>
                            <span class="meta-value">#MRC-<?php echo str_pad($pesanan['id_pemesanan'], 5, '0', STR_PAD_LEFT); ?></span>
                        </div>
                        <div>
                            <span class="meta-label d-block">Tanggal Pesan</span>
                            <span class="meta-value"><?php echo $tanggal; ?></span>
                        </div>
                    </div>
                </div>
                <div class="status-badge menunggu">Menunggu Pengambilan</div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Section -->
            <div class="col-lg-8">
                <!-- Order Items -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Produk yang Dipesan</h2>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <?php while ($item = mysqli_fetch_assoc($result_detail)) {
                            $subtotal = $item['jumlah'] * $item['harga_satuan'];
                        ?>
                            <div class="order-item">
                                <div class="item-image" style="<?php if (!empty($item['gambar'])) echo "background-image: url('" . $item['gambar'] . "');"; ?>">
                                    <?php if (empty($item['gambar'])) echo '💊'; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="item-name"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
                                    <div class="item-meta">Rp <?php echo number_format($item['harga_satuan'], 0, ',', '.'); ?> per item</div>
                                </div>
                                <div class="text-end">
                                    <div class="item-qty">Qty: <?php echo $item['jumlah']; ?></div>
                                    <div class="item-price">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Informasi Pemesanan -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Informasi Pemesanan</h2>
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="info-block">
                                <h3><i class="bi bi-person-fill"></i> Informasi Pemesan</h3>
                                <p>
                                    <strong><?php echo htmlspecialchars($pesanan['nama']); ?></strong>
                                    <i class="bi bi-telephone"></i> <?php echo htmlspecialchars($pesanan['no_hp']); ?><br>
                                    Umur: <?php echo $pesanan['umur']; ?> tahun
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <h3><i class="bi bi-geo-alt-fill"></i> Lokasi Pengambilan</h3>
                                <p>
                                    <strong>Apotek Marcydap Pusat</strong>
                                    Jl. Gurami No. 123, Kota Anda<br>
                                    Senin - Sabtu, 08:00 - 21:00
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="payment-card">
                        <h3 style="color: var(--primary-green); font-size: 16px; margin-bottom: 15px;">💳 Metode Pembayaran</h3>
                        <div class="d-flex align-items-center gap-3">
                            <div style="font-size: 24px;">
                                <?php echo $pesanan['metode_pembayaran'] === 'ewallet' ? '📱' : '💵'; ?>
                            </div>
                            <div class="flex-grow-1">
                                <h4 style="color: var(--primary-green); font-size: 15px; margin-bottom: 4px;">
                                    <?php echo $metode_label; ?>
                                </h4>
                            </div>
                            <div style="display: inline-flex; align-items: center; gap: 6px; background: #fff3cd; color: #856404; padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                ⏳ Menunggu
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Order Summary -->
                <div class="sidebar-card">
                    <h3>Ringkasan Pembayaran</h3>
                    <div class="summary-total">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-value">Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></span>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="sidebar-card">
                    <h3>Aksi Cepat</h3>
                    <div class="d-flex flex-column gap-3">
                        <button class="action-btn action-btn-primary" onclick="window.print()">
                            <i class="bi bi-printer"></i> Cetak Struk
                        </button>
                        <a href="cek_pesanan.php" class="action-btn action-btn-secondary">
                            <i class="bi bi-search"></i> Cek Pesanan
                        </a>
                        <a href="../produk.php" class="action-btn action-btn-secondary">
                            <i class="bi bi-house"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

                <!-- Help -->
                <div class="sidebar-card help-card">
                    <h3>Butuh Bantuan?</h3>
                    <p>Simpan nomor pesanan Anda:<br><strong style="font-size: 18px; color: var(--primary-green);">#MRC-<?php echo str_pad($pesanan['id_pemesanan'], 5, '0', STR_PAD_LEFT); ?></strong></p>
                    <p>Lupa struk? Buka <strong>Cek Pesanan</strong> dan masukkan nomor HP Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>