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
    <link rel="stylesheet" href="../css/pembayaran.css">
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
                                    <strong style="color: var(--primary-green);">Cash In Place (CIP)</strong>
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
        // Metode Pembayaran
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