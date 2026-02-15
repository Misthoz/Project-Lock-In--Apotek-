<?php
include '../../config/db.php';

// Cek keranjang tidak kosong
if (empty($_SESSION['keranjang'])) {
    header("Location: keranjang.php");
    exit;
}

// Proses form data user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lanjut_bayar'])) {
    $_SESSION['data_pemesan'] = [
        'nama' => trim($_POST['nama']),
        'umur' => (int) $_POST['umur'],
        'no_hp' => trim($_POST['no_hp'])
    ];

    header("Location: pembayaran.php");
    exit;
}

// Hitung total
$total_harga = 0;
$total_item = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total_harga += $item['harga'] * $item['jumlah'];
    $total_item += $item['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Marcydap Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/pemesanan.css">
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
                <div class="d-none d-md-flex gap-4 align-items-center">
                    <div class="step completed d-flex align-items-center gap-2">
                        <div class="step-number">1</div>
                        <div class="step-label">Keranjang</div>
                    </div>
                    <div class="step active d-flex align-items-center gap-2">
                        <div class="step-number">2</div>
                        <div class="step-label">Pemesanan</div>
                    </div>
                    <div class="step d-flex align-items-center gap-2">
                        <div class="step-number">3</div>
                        <div class="step-label">Pembayaran</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="row g-4">
            <!-- Left Section -->
            <div class="col-lg-8">
                <!-- Data Pemesan -->
                <div class="section-card">
                    <div class="section-header">
                        <h2><i class="bi bi-person-fill"></i> Data Pemesan</h2>
                    </div>
                    <form method="POST" id="formPemesanan">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" required
                                value="<?php echo isset($_SESSION['data_pemesan']['nama']) ? htmlspecialchars($_SESSION['data_pemesan']['nama']) : ''; ?>"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="umur" name="umur" required min="1" max="120"
                                value="<?php echo isset($_SESSION['data_pemesan']['umur']) ? $_SESSION['data_pemesan']['umur'] : ''; ?>"
                                placeholder="Masukkan umur">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required
                                value="<?php echo isset($_SESSION['data_pemesan']['no_hp']) ? htmlspecialchars($_SESSION['data_pemesan']['no_hp']) : ''; ?>"
                                placeholder="Contoh: 08123456789">
                        </div>
                        <button type="submit" name="lanjut_bayar" class="checkout-btn" style="margin-top: 10px;">
                            Lanjut ke Pembayaran <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>

                <!-- Alamat Apotek -->
                <div class="section-card">
                    <div class="section-header d-flex justify-content-between align-items-center">
                        <h2><i class="bi bi-geo-alt-fill"></i> Lokasi Pengambilan</h2>
                    </div>
                    <div class="address-card">
                        <div class="mb-3"><span class="address-type">Apotek</span></div>
                        <div class="address-detail">
                            <strong style="color: var(--primary-green);">Apotek Marcydap Pusat</strong><br>
                            Jl. Gurami No. 123, Kota Anda<br>
                            <small class="text-muted"><i class="bi bi-clock"></i> Buka: Senin - Sabtu, 08:00 - 21:00</small>
                        </div>
                    </div>
                </div>

                <!-- Produk yang Dipesan -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Produk yang Dipesan (<?php echo $total_item; ?> item)</h2>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($_SESSION['keranjang'] as $item) {
                            $subtotal = $item['harga'] * $item['jumlah'];
                        ?>
                            <div class="cart-item">
                                <div class="item-image" style="<?php if (!empty($item['gambar'])) echo "background-image: url('" . $item['gambar'] . "');"; ?>">
                                    <?php if (empty($item['gambar'])) echo '💊'; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="item-name"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
                                    <div class="item-meta">Qty: <?php echo $item['jumlah']; ?> × Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></div>
                                </div>
                                <div class="text-end">
                                    <div class="item-price">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="summary-card">
                        <h2>Ringkasan Pesanan</h2>
                        <div class="d-flex flex-column gap-3 mb-3 pb-3 border-bottom">
                            <?php foreach ($_SESSION['keranjang'] as $item) { ?>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo htmlspecialchars($item['nama_barang']); ?> x<?php echo $item['jumlah']; ?></span>
                                    <span class="summary-value">Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="summary-total">
                            <span class="summary-total-label">Total Pembayaran</span>
                            <span class="summary-total-value">Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                        </div>
                        <div class="text-center text-muted mt-3" style="font-size:13px;">🔒 Transaksi aman & terenkripsi</div>
                        <div class="benefits-list">
                            <h3> Keuntungan Berbelanja</h3>
                            <div class="benefit-item">✓ Produk 100% original</div>
                            <div class="benefit-item">✓ Gratis konsultasi apoteker</div>
                            <div class="benefit-item">✓ Poin reward setiap transaksi</div>
                            <div class="benefit-item">✓ Kemudahan retur & refund</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>