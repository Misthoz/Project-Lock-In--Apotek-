<?php
include '../config/db.php';

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

        .nav-link-custom {
            color: var(--text-dark) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            color: var(--secondary-green) !important;
        }

        .search-bar {
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            padding: 20px 0;
        }

        .search-wrapper {
            position: relative;
            flex: 1;
        }

        .search-wrapper input {
            width: 100%;
            padding: 14px 20px 14px 50px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            font-family: 'DM Sans', sans-serif;
            background: white;
        }

        .search-wrapper input:focus {
            outline: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .search-wrapper .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: var(--accent-green);
        }

        .search-btn {
            padding: 14px 30px;
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: #143d22;
            transform: scale(1.02);
        }

        .filter-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .filter-section h3 {
            font-size: 18px;
            color: var(--primary-green);
            margin-bottom: 20px;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-option:hover {
            padding-left: 5px;
        }

        .filter-option input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--accent-green);
        }

        .filter-option label {
            font-size: 14px;
            color: #555;
            cursor: pointer;
            flex: 1;
            margin: 0;
        }

        .filter-count {
            font-size: 12px;
            color: #999;
        }

        .clear-filters {
            width: 100%;
            padding: 12px;
            background: white;
            border: 2px solid var(--accent-green);
            color: var(--secondary-green);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .clear-filters:hover {
            background: var(--light-green);
        }

        .products-count {
            font-size: 16px;
            color: #666;
        }

        .products-count strong {
            color: var(--primary-green);
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.4s ease;
            position: relative;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(26, 71, 42, 0.15);
        }

        .product-badges {
            position: absolute;
            top: 12px;
            left: 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            z-index: 2;
        }

        .product-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
        }

        .badge-promo {
            background: #ff6b6b;
        }

        .badge-new {
            background: #4dabf7;
        }

        .badge-best {
            background: #ffa500;
        }

        .badge-prescription {
            background: var(--secondary-green);
        }

        .wishlist-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 38px;
            height: 38px;
            background: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 2;
            transition: all 0.3s ease;
        }

        .wishlist-btn:hover {
            background: var(--accent-green);
            transform: scale(1.1);
        }

        .product-image {
            height: 220px;
            background: linear-gradient(135deg, #f8f9fa, #e8f5e9);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-image::before {
            font-size: 70px;
            opacity: 0.3;
        }

        .quick-view {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: var(--secondary-green);
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .product-card:hover .quick-view {
            bottom: 15px;
        }

        .product-content {
            padding: 18px;
        }

        .product-category {
            color: var(--accent-green);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-green);
            margin-bottom: 8px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-clamp: 2;
            overflow: hidden;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .stars {
            color: #ffa500;
            font-size: 14px;
        }

        .rating-count {
            font-size: 12px;
            color: #999;
        }

        .product-meta {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 12px;
            color: #666;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .price-original {
            font-size: 12px;
            color: #999;
            text-decoration: line-through;
        }

        .price-current {
            font-size: 20px;
            font-weight: 700;
            color: var(--secondary-green);
        }

        .add-btn {
            padding: 10px 18px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45, 106, 79, 0.3);
        }

        .page-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #e8f5e9;
            background: white;
            color: var(--text-dark);
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--accent-green);
            color: white;
            border-color: var(--accent-green);
        }

        .floating-cart {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            color: white;
            padding: 18px 30px;
            border-radius: 50px;
            box-shadow: 0 8px 30px rgba(45, 106, 79, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .floating-cart:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(45, 106, 79, 0.5);
            color: white;
        }

        .cart-count {
            background: white;
            color: var(--secondary-green);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .sidebar-sticky {
            position: sticky;
            top: 100px;
        }

        .footer {
            background: #0a1f1a;
            color: white;
            padding: 80px 0 40px;
        }

        .footer-brand h3 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .footer-brand p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .footer-section h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #b7e4c7;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <a href="dashboard.php" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="logo-icon"></div>
                    <div class="logo-text">
                        <h1>MARCYDAP</h1>
                        <p>APOTEK</p>
                    </div>
                </a>
                <nav class="d-none d-lg-flex align-items-center gap-3">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="dashboard.php">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom active" href="produk.php">Produk</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="tentangkami.php">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="hubungikami.php">Kontak</a></li>
                    </ul>
                    <a href="pemesanan/cek_pesanan.php" class="btn btn-outline-success btn-sm rounded-pill px-3">
                        <i class="bi bi-search"></i> Cek Pesanan
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="search-bar">
        <div class="container">
            <div class="d-flex gap-3">
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Cari obat">
                </div>
                <button class="search-btn">Cari</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row g-4">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="sidebar-sticky">
                    <div class="filter-section">
                        <h3>Kategori</h3>
                        <div class="filter-option"><input type="checkbox" id="cat2"><label for="cat2">Obat Bebas</label><span class="filter-count">(156)</span></div>
                    </div>
                    <div class="filter-section">
                        <button class="clear-filters">Reset Filter</button>
                    </div>
                </div>
            </div>

            <!-- Products Area -->
            <div class="col-lg-9">
                <div class="mb-4">
                    <?php
                    $total_produk = mysqli_num_rows($result);
                    ?>
                    <div class="products-count">Menampilkan <strong>1-<?php echo $total_produk; ?></strong> dari <strong><?php echo $total_produk; ?></strong> produk</div>
                </div>
                <div class="row g-4">
                    <?php
                    // Cek apakah ada data produk
                    if (mysqli_num_rows($result) > 0) {
                        // Loop untuk menampilkan setiap produk
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Set product data untuk component
                            $product = $row;
                    ?>

                            <!-- Product Card -->
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <?php include 'components/product-card.php'; ?>
                            </div>

                    <?php
                        } // End while
                    } else {
                        // Jika tidak ada produk
                        echo '<div class="col-12"><div class="alert alert-info">Belum ada produk tersedia.</div></div>';
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center gap-2 mt-5">
                    <button class="page-btn">←</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast notification -->
    <?php if (isset($_GET['added'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="position:fixed; top:80px; right:20px; z-index:9999; animation: slideIn 0.5s ease; border-radius:12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <i class="bi bi-check-circle-fill"></i> Produk ditambahkan ke keranjang!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

    <!-- Floating Cart -->
    <a href="pemesanan/keranjang.php" class="floating-cart">
        <span>🛒</span>
        <span>Keranjang</span>
        <?php if ($total_keranjang > 0) { ?>
            <span class="cart-count"><?php echo $total_keranjang; ?></span>
        <?php } ?>
    </a>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-5">
                    <div class="footer-brand">
                        <h3>MARCYDAP</h3>
                        <p>Platform kesehatan terpercaya yang menghubungkan Anda dengan produk berkualitas dan layanan profesional.</p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-section">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-section">
                        <h4>Perusahaan</h4>
                        <ul class="footer-links">
                            <li><a href="tentangkami.php">Tentang Kami</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-section">
                        <h4>Bantuan</h4>
                        <ul class="footer-links">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="hubungikami.php">Hubungi Kami</a></li>
                            <li><a href="#">Syarat & Ketentuan</a></li>
                            <li><a href="#">Kebijakan Privasi</a></li>
                            <li><a href="#">Cara Pemesanan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 Marcydap. All rights reserved. Made with 💚 in Indonesia</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide toast after 3 detik
        setTimeout(() => {
            const toast = document.querySelector('.alert');
            if (toast) toast.remove();
        }, 3000);

        // Fungsi untuk wishlist
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.innerHTML === '♡') {
                    this.innerHTML = '♥';
                    this.style.color = '#ff6b6b';
                } else {
                    this.innerHTML = '♡';
                    this.style.color = '';
                }
            });
        });
    </script>
</body>

</html>