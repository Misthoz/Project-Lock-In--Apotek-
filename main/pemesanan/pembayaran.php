<?php
include '../../config/db.php';

// Cek data lengkap
if (empty($_SESSION['keranjang']) || empty($_SESSION['data_pemesan'])) {
    header("Location: keranjang.php");
    exit;
}

// Proses pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bayar'])) {
    $metode = $_POST['metode_pembayaran'];
    $data = $_SESSION['data_pemesan'];

    // 1. Insert user
    $nama = mysqli_real_escape_string($db, $data['nama']);
    $umur = (int) $data['umur'];
    $no_hp = mysqli_real_escape_string($db, $data['no_hp']);

    $query_user = "INSERT INTO user (nama, umur, no_hp) VALUES ('$nama', $umur, '$no_hp')";
    mysqli_query($db, $query_user);
    $id_user = mysqli_insert_id($db);

    // 2. Hitung total harga
    $total_harga = 0;
    foreach ($_SESSION['keranjang'] as $item) {
        $total_harga += $item['harga'] * $item['jumlah'];
    }

    // 3. Insert pemesanan
    $tanggal_pesan = date('Y-m-d H:i:s');
    $query_pesan = "INSERT INTO pemesanan (id_user, metode_pembayaran, total_harga, tanggal_pesan) 
                    VALUES ($id_user, '$metode', $total_harga, '$tanggal_pesan')";
    mysqli_query($db, $query_pesan);
    $id_pemesanan = mysqli_insert_id($db);

    // 4. Insert detail pemesanan
    foreach ($_SESSION['keranjang'] as $item) {
        $id_barang = (int) $item['id_barang'];
        $jumlah = (int) $item['jumlah'];
        $harga_satuan = (int) $item['harga'];

        $query_detail = "INSERT INTO detail_pemesanan (id_pemesanan, id_barang, jumlah, harga_satuan) 
                         VALUES ($id_pemesanan, $id_barang, $jumlah, $harga_satuan)";
        mysqli_query($db, $query_detail);
    }

    // 5. Simpan id_pemesanan ke session lalu bersihkan keranjang
    $_SESSION['id_pemesanan'] = $id_pemesanan;
    $_SESSION['keranjang'] = [];
    $_SESSION['data_pemesan'] = [];

    header("Location: detailpemesanan.php");
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
    <title>Pembayaran - Marcydap Apotek</title>
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
            margin-bottom: 8px;
        }

        .section-header p {
            color: #666;
            font-size: 14px;
        }

        .payment-option {
            border: 2px solid #e8f5e9;
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 12px;
        }

        .payment-option:hover {
            border-color: var(--accent-green);
            background: #fafffe;
        }

        .payment-option.selected {
            border-color: var(--accent-green);
            background: #f0f8f4;
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-option .option-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .payment-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .ewallet-icon {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .cod-icon {
            background: #fff3e0;
            color: #e65100;
        }

        .order-details-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e8f5e9;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item-name {
            color: #555;
            font-size: 14px;
        }

        .order-item-qty {
            color: #999;
            font-size: 13px;
        }

        .order-item-price {
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

        .pay-btn {
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
            margin-top: 20px;
        }

        .pay-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4);
            color: white;
        }

        .pay-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .help-section {
            background: linear-gradient(135deg, #f8fffe, #e8f5e9);
            padding: 25px;
            border-radius: 12px;
            margin-top: 20px;
            text-align: center;
        }

        .help-section h3 {
            color: var(--primary-green);
            font-size: 16px;
            margin-bottom: 10px;
        }

        .help-section p {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .help-btn {
            padding: 12px 30px;
            background: white;
            color: var(--secondary-green);
            border: 2px solid var(--accent-green);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .help-btn:hover {
            background: var(--light-green);
        }

        .data-pemesan-box {
            background: #f0f8f4;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--accent-green);
        }

        .data-pemesan-box table td {
            padding: 6px 12px;
            font-size: 14px;
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
                    <div class="step completed d-flex align-items-center gap-2">
                        <div class="step-number">2</div>
                        <div class="step-label">Pemesanan</div>
                    </div>
                    <div class="step active d-flex align-items-center gap-2">
                        <div class="step-number">3</div>
                        <div class="step-label">Pembayaran</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <form method="POST" id="formBayar">
            <div class="row g-4">
                <!-- Left Section -->
                <div class="col-lg-8">
                    <!-- Payment Methods -->
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Pilih Metode Pembayaran</h2>
                            <p>Pilih metode pembayaran yang paling nyaman untuk Anda</p>
                        </div>

                        <!-- E-Wallet -->
                        <label class="payment-option" id="opt-ewallet">
                            <input type="radio" name="metode_pembayaran" value="ewallet" required>
                            <div class="option-content">
                                <div class="payment-icon ewallet-icon">
                                    <i class="bi bi-phone"></i>
                                </div>
                                <div>
                                    <strong style="color: var(--primary-green);">E-Wallet</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">GoPay, OVO, DANA, ShopeePay</p>
                                </div>
                            </div>
                        </label>

                        <!-- COD -->
                        <label class="payment-option" id="opt-cod">
                            <input type="radio" name="metode_pembayaran" value="cod" required>
                            <div class="option-content">
                                <div class="payment-icon cod-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div>
                                    <strong style="color: var(--primary-green);">Bayar di Tempat (COD)</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">Bayar saat mengambil pesanan di apotek</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Data Pemesan -->
                    <div class="section-card">
                        <div class="section-header">
                            <h2><i class="bi bi-person"></i> Data Pemesan</h2>
                        </div>
                        <div class="data-pemesan-box">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="text-muted">Nama</td>
                                    <td class="fw-bold" style="color: var(--primary-green);"><?php echo htmlspecialchars($_SESSION['data_pemesan']['nama']); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Umur</td>
                                    <td class="fw-bold" style="color: var(--primary-green);"><?php echo $_SESSION['data_pemesan']['umur']; ?> tahun</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">No. HP</td>
                                    <td class="fw-bold" style="color: var(--primary-green);"><?php echo htmlspecialchars($_SESSION['data_pemesan']['no_hp']); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="section-card">
                        <div class="section-header">
                            <h2>Detail Pesanan (<?php echo $total_item; ?> item)</h2>
                        </div>
                        <div class="order-details-box">
                            <?php foreach ($_SESSION['keranjang'] as $item) { ?>
                                <div class="order-item">
                                    <div>
                                        <div class="order-item-name"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
                                        <div class="order-item-qty">Qty: <?php echo $item['jumlah']; ?> × Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></div>
                                    </div>
                                    <div class="order-item-price">Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Right: Summary -->
                <div class="col-lg-4">
                    <div class="sidebar-sticky">
                        <div class="summary-card">
                            <h2>Ringkasan Pembayaran</h2>
                            <div class="d-flex flex-column gap-3 mb-3 pb-3 border-bottom">
                                <?php foreach ($_SESSION['keranjang'] as $item) { ?>
                                    <div class="summary-item">
                                        <span class="summary-label"><?php echo htmlspecialchars($item['nama_barang']); ?> x<?php echo $item['jumlah']; ?></span>
                                        <span class="summary-value">Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="summary-total">
                                <span class="summary-total-label">Total Bayar</span>
                                <span class="summary-total-value">Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                            </div>
                            <button type="submit" name="bayar" class="pay-btn" id="btnBayar" disabled>
                                <i class="bi bi-shield-check"></i> Konfirmasi & Bayar — Rp <?php echo number_format($total_harga, 0, ',', '.'); ?>
                            </button>
                        </div>

                        <div class="help-section">
                            <h3>Butuh Bantuan?</h3>
                            <p>Tim kami siap membantu Anda 24/7</p>
                            <button type="button" class="help-btn">Hubungi Customer Service</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Payment option selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                document.getElementById('btnBayar').disabled = false;
            });
        });
    </script>
</body>

</html>