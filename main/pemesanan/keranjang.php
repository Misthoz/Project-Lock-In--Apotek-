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

        .continue-shopping {
            padding: 10px 20px;
            background: white;
            border: 2px solid var(--accent-green);
            color: var(--secondary-green);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .continue-shopping:hover {
            background: var(--light-green);
            color: var(--secondary-green);
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            color: var(--primary-green);
        }

        .select-all-card {
            background: white;
            border-radius: 16px;
            padding: 20px 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .delete-selected {
            color: #dc3545;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            background: none;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .delete-selected:hover {
            background: #ffe8ea;
        }

        .cart-item {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .item-image {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f0f0f0, #e8f5e9);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            flex-shrink: 0;
            background-size: cover;
            background-position: center;
        }

        .item-name {
            font-weight: 600;
            color: var(--primary-green);
            font-size: 18px;
            margin-bottom: 8px;
        }

        .item-meta {
            font-size: 13px;
            color: #666;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            background: white;
            border: 2px solid #e8f5e9;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            color: var(--secondary-green);
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            background: var(--light-green);
            border-color: var(--accent-green);
        }

        .qty-number {
            width: 50px;
            text-align: center;
            font-weight: 600;
            color: var(--primary-green);
            font-size: 16px;
        }

        .control-btn {
            padding: 8px 16px;
            background: white;
            border: 2px solid #e8f5e9;
            color: #666;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-btn:hover {
            border-color: var(--accent-green);
            color: var(--secondary-green);
        }

        .control-btn.delete {
            border-color: #dc3545;
            color: #dc3545;
        }

        .control-btn.delete:hover {
            background: #ffe8ea;
        }

        .price-current {
            font-size: 24px;
            font-weight: 700;
            color: var(--secondary-green);
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
            margin-bottom: 20px;
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
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4);
            color: white;
        }

        .benefits-list {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .benefits-list h3 {
            font-size: 16px;
            color: var(--primary-green);
            margin-bottom: 15px;
        }

        .benefit-item {
            font-size: 13px;
            color: #555;
            margin-bottom: 12px;
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .empty-cart i {
            font-size: 5rem;
            color: #ddd;
        }
    </style>
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

                    <!-- Cart Items -->
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