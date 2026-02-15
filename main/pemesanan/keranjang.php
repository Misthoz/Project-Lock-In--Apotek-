<?php
include '../../config/db.php';

// Proses update jumlah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_qty'])) {
        $index = (int) $_POST['index'];
        $jumlah = (int) $_POST['jumlah'];

        if ($jumlah <= 0) {
            array_splice($_SESSION['keranjang'], $index, 1);
        } else {
            $_SESSION['keranjang'][$index]['jumlah'] = $jumlah;
        }
        header("Location: keranjang.php");
        exit;
    }

    if (isset($_POST['hapus_item'])) {
        $index = (int) $_POST['index'];
        array_splice($_SESSION['keranjang'], $index, 1);
        header("Location: keranjang.php");
        exit;
    }

    if (isset($_POST['kosongkan'])) {
        $_SESSION['keranjang'] = [];
        header("Location: keranjang.php");
        exit;
    }
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
    <title>Keranjang Belanja - Marcydap Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/keranjang.css">
</head>

<body>
    <!-- Header -->


    <header class="header sticky-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <a href="../produk.php" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="logo-icon"></div>
                    <div class="logo-text">
                        <h1>MARCYDAP</h1>
                        <p>APOTEK</p>
                    </div>
                </a>
                <a href="../produk.php" class="continue-shopping">← Lanjut Belanja</a>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="page-header mb-4">
            <h1>Keranjang Belanja</h1>
            <p class="text-muted">Kelola produk yang akan Anda beli</p>
        </div>

        <?php if (empty($_SESSION['keranjang'])) { ?>
            <!-- Keranjang Kosong -->
            <div class="empty-cart">
                <i class="bi bi-cart-x"></i>
                <h3 style="color: var(--primary-green); margin-top: 15px;">Keranjang Anda Kosong</h3>
                <p class="text-muted">Belum ada produk yang ditambahkan ke keranjang</p>
                <a href="../produk.php" class="checkout-btn d-inline-block mt-3" style="width: auto; padding: 14px 30px;">
                    <i class="bi bi-shop"></i> Mulai Belanja
                </a>
            </div>
        <?php } else { ?>
            <div class="row g-4">
                <!-- Left: Cart Items -->
                <div class="col-lg-8">
                    <!-- Header Bar -->
                    <div class="select-all-card d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span style="font-weight: 600; color: var(--primary-green); font-size: 15px;">
                                <?php echo $total_item; ?> item di keranjang
                            </span>
                        </div>
                        <form method="POST">
                            <button type="submit" name="kosongkan" class="delete-selected" onclick="return confirm('Kosongkan keranjang?')">
                                <i class="bi bi-trash"></i> Hapus Semua
                            </button>
                        </form>
                    </div>

                    <!-- Item Keranjang -->
                    <?php foreach ($_SESSION['keranjang'] as $index => $item) {
                        $subtotal = $item['harga'] * $item['jumlah'];
                    ?>
                        <div class="cart-item mb-3">
                            <div class="d-flex gap-3 align-items-center flex-wrap">
                                <div class="item-image" style="<?php if (!empty($item['gambar'])) echo "background-image: url('" . $item['gambar'] . "');"; ?>">
                                    <?php if (empty($item['gambar'])) echo '💊'; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="item-name"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
                                    <div class="item-meta">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?> per item</div>

                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <input type="hidden" name="jumlah" value="<?php echo $item['jumlah'] - 1; ?>">
                                            <button type="submit" name="update_qty" class="qty-btn">−</button>
                                        </form>
                                        <span class="qty-number"><?php echo $item['jumlah']; ?></span>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                                            <input type="hidden" name="jumlah" value="<?php echo $item['jumlah'] + 1; ?>">
                                            <button type="submit" name="update_qty" class="qty-btn">+</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="price-current" style="font-size: 20px;">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                                    <form method="POST">
                                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                                        <button type="submit" name="hapus_item" class="control-btn delete mt-2">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Right: Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar-sticky">
                        <div class="summary-card">
                            <h2>Ringkasan Belanja</h2>
                            <div class="d-flex flex-column gap-3 mb-3 pb-3 border-bottom">
                                <?php foreach ($_SESSION['keranjang'] as $item) { ?>
                                    <div class="summary-item">
                                        <span class="summary-label"><?php echo htmlspecialchars($item['nama_barang']); ?> x<?php echo $item['jumlah']; ?></span>
                                        <span class="summary-value">Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="summary-total">
                                <span class="summary-total-label">Total</span>
                                <span class="summary-total-value">Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                            </div>
                            <a href="pemesanan.php" class="checkout-btn mt-3">Lanjut ke Pemesanan</a>
                            <div class="text-center text-muted mt-3" style="font-size:13px;">🔒 Transaksi aman & terenkripsi</div>
                        </div>

                        <div class="benefits-list">
                            <h3>Keuntungan Berbelanja</h3>
                            <div class="benefit-item">✓ Produk 100% original & berkualitas</div>
                            <div class="benefit-item">✓ Gratis konsultasi apoteker</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>