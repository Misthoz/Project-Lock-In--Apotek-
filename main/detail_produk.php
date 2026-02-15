<?php
include '../config/db.php';

// Ambil ID produk dari URL
$id_barang = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika tidak ada ID, redirect ke halaman produk
if ($id_barang == 0) {
    header("Location: produk.php");
    exit;
}

// Query untuk mengambil detail produk
$query = "SELECT * FROM barang WHERE id_barang = $id_barang";
$result = mysqli_query($db, $query);

// Cek apakah produk ditemukan
if (mysqli_num_rows($result) == 0) {
    header("Location: produk.php");
    exit;
}

$product = mysqli_fetch_assoc($result);

// Proses tambah ke keranjang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Cek apakah barang sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['keranjang'] as &$item) {
        if ($item['id_barang'] == $id_barang) {
            $item['jumlah'] += (int)$_POST['quantity'];
            $found = true;
            break;
        }
    }
    unset($item);

    // Jika belum ada, tambahkan
    if (!$found) {
        $_SESSION['keranjang'][] = [
            'id_barang' => $product['id_barang'],
            'nama_barang' => $product['nama_barang'],
            'harga' => $product['harga'],
            'gambar' => $product['gambar'],
            'jumlah' => (int)$_POST['quantity']
        ];
    }

    header("Location: detail_produk.php?id=$id_barang&added=1");
    exit;
}

// Ambil produk terkait (dengan jenis barang yang sama)
$query_related = "SELECT * FROM barang WHERE jenis_barang = '{$product['jenis_barang']}' AND id_barang != $id_barang LIMIT 4";
$result_related = mysqli_query($db, $query_related);

// Hitung total item di keranjang
$total_keranjang = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total_keranjang += $item['jumlah'];
}

// Format harga
$harga_format = number_format($product['harga'], 0, ',', '.');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['nama_barang']); ?> - Marcydap Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/produk.css">
    <link rel="stylesheet" href="css/detail_produk.css">
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

    <!-- Breadcrumb -->
    <!-- <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="produk.php">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['nama_barang']); ?></li>
                </ol>
            </nav>
            <a href="javascript:history.back()" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div> -->

    <!-- Produk Detail Section -->
    <div class="container my-5">
        <div class="row g-4">
            <!-- gambar produk -->
            <div class="col-lg-5">
                <div class="product-detail-image">
                    <img src="<?php echo htmlspecialchars($product['gambar']); ?>" 
                         alt="<?php echo htmlspecialchars($product['nama_barang']); ?>"
                         class="img-fluid">
                </div>
            </div>

            <!-- informasi produk -->
            <div class="col-lg-7">
                <div class="product-detail-info">
                    <div class="mb-3">
                        <span class="badge-category badge-<?php echo $product['jenis_barang']; ?>">
                            <?php 
                            $jenis_icons = [
                                'darah' => '',
                                'herbal' => '',
                                'tubuh' => '',
                                'kepala' => ''
                            ];
                            $jenis_labels = [
                                'darah' => 'Obat Darah',
                                'herbal' => 'Obat Herbal',
                                'tubuh' => 'Obat Tubuh',
                                'kepala' => 'Obat Kepala'
                            ];
                            echo $jenis_icons[$product['jenis_barang']] . ' ' . $jenis_labels[$product['jenis_barang']];
                            ?>
                        </span>
                    </div>
                    
                    <h1 class="product-detail-title"><?php echo htmlspecialchars($product['nama_barang']); ?></h1>
                    
                    <div class="product-rating mb-3">
                    </div>

                    <div class="product-price mb-4">
                        <span class="price-label">Harga:</span>
                        <span class="price-value">Rp <?php echo $harga_format; ?></span>
                    </div>

                    <div class="product-description mb-4">
                        <h5 class="section-subtitle">Deskripsi Produk</h5>
                        <p><?php echo nl2br(htmlspecialchars($product['deskripsi'])); ?></p>
                    </div>

                    <div class="product-info-box mb-4">
                        <h5 class="section-subtitle">Informasi Produk</h5>
                        <table class="info-table">
                            <tr>
                                <td><i class="bi bi-tag"></i> Kategori</td>
                                <td><strong><?php echo $jenis_labels[$product['jenis_barang']]; ?></strong></td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-shield-check"></i> Status</td>
                                <td><strong>Tersedia</strong></td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-box-seam"></i> Kode Produk</td>
                                <td><strong>BRG-<?php echo str_pad($product['id_barang'], 5, '0', STR_PAD_LEFT); ?></strong></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Form tambah ke keranjang -->
                    <form method="POST" class="add-to-cart-form">
                        <div class="quantity-selector mb-3">
                            <label>Jumlah:</label>
                            <div class="quantity-controls">
                                <button type="button" class="qty-btn" onclick="decreaseQty()">-</button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="99" readonly>
                                <button type="button" class="qty-btn" onclick="increaseQty()">+</button>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" name="add_to_cart" class="btn-add-cart">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                            <a href="pemesanan/keranjang.php" class="btn-view-cart">
                                <i class="bi bi-cart"></i> Lihat Keranjang
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Produk Lainnya -->
        <?php if (mysqli_num_rows($result_related) > 0) { ?>
        <div class="related-products mt-5">
            <h3 class="section-title mb-4">Produk Terkait</h3>
            <div class="row g-4">
                <?php while ($related = mysqli_fetch_assoc($result_related)) { 
                    $product = $related;
                ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <?php include 'components/product-card.php'; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- Notifikasi penambahan barang -->
    <?php if (isset($_GET['added'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="position:fixed; top:80px; right:20px; z-index:9999; animation: slideIn 0.5s ease; border-radius:12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <i class="bi bi-check-circle-fill"></i> Produk ditambahkan ke keranjang!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

    <!-- keranjang -->
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
        // Kontrol jumlah produk pada form detail produk
        function increaseQty() {
            let qty = document.getElementById('quantity');
            if (parseInt(qty.value) < 99) {
                qty.value = parseInt(qty.value) + 1;
            }
        }

        function decreaseQty() {
            let qty = document.getElementById('quantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        }

        // Auto-hide notifikasi setelah 3 detik
        setTimeout(() => {
            const toast = document.querySelector('.alert');
            if (toast) toast.remove();
        }, 3000);
    </script>
</body>
</html>
