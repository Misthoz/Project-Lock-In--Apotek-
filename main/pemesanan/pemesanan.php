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
    <style>
        :root {
            --primary-green: #1a472a;
            --secondary-green: #2d6a4f;
            --accent-green: #52b788;
            --light-green: #95d5b2;
            --bg-cream: #faf8f3;
            --text-dark: #1a1a1a;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-cream);
            color: var(--text-dark);
        }

        .header {
            background: white;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo-icon::before,
        .logo-icon::after {
            content: '';
            position: absolute;
            background: white;
        }

        .logo-icon::before {
            width: 5px;
            height: 20px;
        }

        .logo-icon::after {
            width: 20px;
            height: 5px;
        }

        .logo-text h1 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-green);
            font-size: 24px;
            margin: 0;
        }

        .logo-text p {
            color: var(--accent-green);
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0;
        }

        .step-number {
            width: 35px;
            height: 35px;
            background: #e8f5e9;
            color: #999;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .step.active .step-number {
            background: var(--accent-green);
            color: white;
        }

        .step.completed .step-number {
            background: var(--secondary-green);
            color: white;
        }

        .step-label {
            font-size: 14px;
            color: #999;
            font-weight: 500;
        }

        .step.active .step-label {
            color: var(--primary-green);
            font-weight: 600;
        }

        .section-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            margin-bottom: 25px;
        }

        .section-header {
            margin-bottom: 25px;
        }

        .section-header h2 {
            font-size: 20px;
            color: var(--primary-green);
        }

        .address-card {
            background: #f0f8f4;
            padding: 20px;
            border-radius: 12px;
            border: 2px solid var(--accent-green);
        }

        .address-type {
            background: var(--accent-green);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .address-detail {
            color: #555;
            font-size: 14px;
            line-height: 1.7;
        }

        .cart-item {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .item-image {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #f0f0f0, #e8f5e9);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            flex-shrink: 0;
            background-size: cover;
            background-position: center;
        }

        .item-name {
            font-weight: 600;
            color: var(--primary-green);
            font-size: 16px;
            margin-bottom: 8px;
        }

        .item-meta {
            font-size: 13px;
            color: #666;
        }

        .item-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--secondary-green);
        }

        .form-control {
            border: 2px solid #e8f5e9;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.15);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-green);
            font-size: 14px;
        }

        .sidebar-sticky {
            position: sticky;
            top: 100px;
        }

        .summary-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .summary-card h2 {
            font-size: 20px;
            color: var(--primary-green);
            margin-bottom: 25px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-label {
            color: #666;
            font-size: 14px;
        }

        .summary-value {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 15px;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-top: 2px solid #f0f0f0;
            margin-top: 20px;
        }

        .summary-total-label {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-green);
        }

        .summary-total-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--secondary-green);
        }

        .checkout-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4);
            color: white;
        }

        .benefits-list {
            background: #f8fffe;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .benefits-list h3 {
            font-size: 14px;
            color: var(--primary-green);
            margin-bottom: 12px;
        }

        .benefit-item {
            font-size: 13px;
            color: #555;
            margin-bottom: 10px;
        }
    </style>
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
                            <h3>✨ Keuntungan Berbelanja</h3>
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