<?php
include 'config/db.php';

// Proses tambah ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id_barang = (int) $_POST['id_barang'];
    
    // Cek apakah barang sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['keranjang'] as &$item) {
        if ($item['id_barang'] == $id_barang) {
            $item['jumlah'] += 1;
            $found = true;
            break;
        }
    }
    unset($item);
    
    // Jika belum ada, tambahkan
    if (!$found) {
        $query = "SELECT * FROM barang WHERE id_barang = $id_barang";
        $result_item = mysqli_query($db, $query);
        $barang = mysqli_fetch_assoc($result_item);
        
        if ($barang) {
            $_SESSION['keranjang'][] = [
                'id_barang' => $barang['id_barang'],
                'nama_barang' => $barang['nama_barang'],
                'harga' => $barang['harga'],
                'gambar' => $barang['gambar'],
                'jumlah' => 1
            ];
        }
    }
    
    // Redirect untuk mencegah resubmit form
    header("Location: produk.php?added=1");
    exit;
}

// Query untuk mengambil semua produk dari database
$query = "SELECT * FROM barang ORDER BY id_barang DESC";
$result = mysqli_query($db, $query);

// Hitung total item di keranjang
$total_keranjang = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total_keranjang += $item['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Obat-obatan - Marcydap Apotek</title>
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

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 1.5rem;
            margin: 0;
        }

        .cart-link {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            background-color: #eee;
        }

        .product-content {
            padding: 15px;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .product-desc {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .btn-add-cart {
            background: var(--accent);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn-add-cart:hover {
            background: var(--secondary);
            color: white;
        }

        .alert-toast {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container">
            <h1>🏥 Marcydap Apotek</h1>
            <a href="keranjang.php" class="cart-link">
                <i class="bi bi-cart3"></i> Keranjang
                <?php if ($total_keranjang > 0) { ?>
                    <span class="cart-badge"><?php echo $total_keranjang; ?></span>
                <?php } ?>
            </a>
        </div>
    </header>

    <!-- Toast notification -->
    <?php if (isset($_GET['added'])) { ?>
        <div class="alert alert-success alert-toast alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> Produk ditambahkan ke keranjang!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

    <div class="container my-4">
        <h2 style="font-family: 'Playfair Display', serif; color: var(--dark);">Produk Kami</h2>
        <p class="text-muted">Temukan obat dan produk kesehatan yang Anda butuhkan</p>

        <div class="product-grid">
            <?php while ($product = mysqli_fetch_assoc($result)) { 
                $harga_format = number_format($product['harga'], 0, ',', '.');
            ?>
                <div class="product-card">
                    <div class="product-image" style="<?php if (!empty($product['gambar'])) echo 'background-image: url(' . $product['gambar'] . ');'; ?>"></div>
                    <div class="product-content">
                        <h3 class="product-title"><?php echo htmlspecialchars($product['nama_barang']); ?></h3>
                        <p class="product-desc"><?php echo htmlspecialchars(substr($product['deskripsi'], 0, 60)); ?>...</p>
                        <div class="product-price">Rp <?php echo $harga_format; ?></div>
                        <form method="POST">
                            <input type="hidden" name="id_barang" value="<?php echo $product['id_barang']; ?>">
                            <button type="submit" name="add_to_cart" class="btn-add-cart">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide toast after 3 detik
        setTimeout(() => {
            const toast = document.querySelector('.alert-toast');
            if (toast) toast.remove();
        }, 3000);
    </script>
</body>

</html>