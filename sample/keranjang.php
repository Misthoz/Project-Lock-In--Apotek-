<?php
include 'config/db.php';

// Proses update jumlah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_qty'])) {
        $index = (int) $_POST['index'];
        $jumlah = (int) $_POST['jumlah'];
        
        if ($jumlah <= 0) {
            // Hapus item jika jumlah 0 atau kurang
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
            --primary: #1B4332;
            --secondary: #2D6A4F;
            --accent: #52B788;
            --light: #D8F3DC;
            --dark: #081C15;
        }
        body { font-family: 'DM Sans', sans-serif; background-color: #f5f5f5; }
        .header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header h1 {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 1.5rem;
            margin: 0;
        }
        .cart-item {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .cart-item-img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            background-size: cover;
            background-position: center;
            background-color: #eee;
            flex-shrink: 0;
        }
        .cart-item-info { flex: 1; }
        .cart-item-name { font-weight: 600; color: var(--dark); margin-bottom: 4px; }
        .cart-item-price { color: var(--primary); font-weight: 700; }
        .qty-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .qty-btn {
            width: 32px;
            height: 32px;
            border: 2px solid var(--accent);
            background: white;
            border-radius: 8px;
            font-weight: 700;
            color: var(--primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .qty-btn:hover { background: var(--light); }
        .qty-value {
            font-weight: 600;
            min-width: 30px;
            text-align: center;
        }
        .btn-hapus {
            background: none;
            border: none;
            color: #e74c3c;
            cursor: pointer;
            font-size: 1.2rem;
        }
        .summary-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            position: sticky;
            top: 80px;
        }
        .summary-card h4 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
            margin-bottom: 15px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-top: 10px;
        }
        .btn-checkout {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 15px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-checkout:hover { background: var(--secondary); }
        .btn-checkout:disabled { background: #ccc; cursor: not-allowed; }
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        .empty-cart i { font-size: 4rem; margin-bottom: 15px; display: block; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>🛒 Keranjang Belanja</h1>
            <a href="produk.php" class="text-white text-decoration-none">
                <i class="bi bi-arrow-left"></i> Kembali Belanja
            </a>
        </div>
    </header>

    <div class="container my-4">
        <?php if (empty($_SESSION['keranjang'])) { ?>
            <!-- Keranjang Kosong -->
            <div class="empty-cart">
                <i class="bi bi-cart-x"></i>
                <h3>Keranjang Anda Kosong</h3>
                <p>Belum ada produk yang ditambahkan ke keranjang</p>
                <a href="produk.php" class="btn btn-success mt-3">
                    <i class="bi bi-shop"></i> Mulai Belanja
                </a>
            </div>
        <?php } else { ?>
            <div class="row">
                <!-- Daftar Item -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><?php echo $total_item; ?> item di keranjang</h5>
                        <form method="POST">
                            <button type="submit" name="kosongkan" class="btn btn-outline-danger btn-sm" onclick="return confirm('Kosongkan keranjang?')">
                                <i class="bi bi-trash"></i> Kosongkan
                            </button>
                        </form>
                    </div>

                    <?php foreach ($_SESSION['keranjang'] as $index => $item) { 
                        $subtotal = $item['harga'] * $item['jumlah'];
                    ?>
                        <div class="cart-item">
                            <div class="cart-item-img" style="background-image: url('<?php echo $item['gambar']; ?>')"></div>
                            <div class="cart-item-info">
                                <div class="cart-item-name"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
                                <div class="cart-item-price">Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></div>
                                
                                <div class="qty-control mt-2">
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                                        <input type="hidden" name="jumlah" value="<?php echo $item['jumlah'] - 1; ?>">
                                        <button type="submit" name="update_qty" class="qty-btn">−</button>
                                    </form>
                                    
                                    <span class="qty-value"><?php echo $item['jumlah']; ?></span>
                                    
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                                        <input type="hidden" name="jumlah" value="<?php echo $item['jumlah'] + 1; ?>">
                                        <button type="submit" name="update_qty" class="qty-btn">+</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <div class="fw-bold text-success mb-2">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                                <form method="POST">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <button type="submit" name="hapus_item" class="btn-hapus" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Ringkasan -->
                <div class="col-lg-4">
                    <div class="summary-card">
                        <h4>Ringkasan Belanja</h4>
                        
                        <?php foreach ($_SESSION['keranjang'] as $item) { ?>
                            <div class="summary-row">
                                <span><?php echo htmlspecialchars($item['nama_barang']); ?> x<?php echo $item['jumlah']; ?></span>
                                <span>Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></span>
                            </div>
                        <?php } ?>

                        <div class="summary-total">
                            <span>Total</span>
                            <span>Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                        </div>

                        <a href="pemesanan.php" class="btn-checkout d-block text-center text-decoration-none">
                            <i class="bi bi-bag-check"></i> Lanjut ke Pemesanan
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>