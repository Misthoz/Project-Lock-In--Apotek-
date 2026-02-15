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

// Ambil parameter filter dan search dari URL
$jenis_filter = isset($_GET['jenis']) ? mysqli_real_escape_string($db, $_GET['jenis']) : '';
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';

// Build query dengan kondisi filter dan search
$query = "SELECT * FROM barang WHERE 1=1";

// Filter berdasarkan jenis_barang
if (!empty($jenis_filter) && in_array($jenis_filter, ['darah', 'herbal', 'tubuh', 'kepala'])) {
    $query .= " AND jenis_barang = '$jenis_filter'";
}

// Search berdasarkan nama atau deskripsi
if (!empty($search_query)) {
    $query .= " AND (nama_barang LIKE '%$search_query%' OR deskripsi LIKE '%$search_query%')";
}

$query .= " ORDER BY id_barang DESC";
$result = mysqli_query($db, $query);

// Hitung jumlah produk per jenis untuk filter
$count_query = "SELECT jenis_barang, COUNT(*) as jumlah FROM barang GROUP BY jenis_barang";
$count_result = mysqli_query($db, $count_query);
$jenis_counts = [];
while ($row = mysqli_fetch_assoc($count_result)) {
    $jenis_counts[$row['jenis_barang']] = $row['jumlah'];
}
$total_semua = array_sum($jenis_counts);

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
    <link rel="stylesheet" href="css/produk.css">
</head>

<body>

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
            <form method="GET" action="produk.php" class="d-flex gap-3">
                <?php if (!empty($jenis_filter)) { ?>
                    <input type="hidden" name="jenis" value="<?php echo htmlspecialchars($jenis_filter); ?>">
                <?php } ?>
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="search" placeholder="Cari obat..." value="<?php echo htmlspecialchars($search_query); ?>">
                </div>
                <button type="submit" class="search-btn">Cari</button>
            </form>
        </div>
    </div>

    <!-- Konten utamat -->
    <div class="container my-5">
        <div class="row g-4">
            <!-- Kategori FIlter -->
            <div class="col-lg-3">
                <div class="sidebar-sticky">
                    <div class="filter-section">
                        <h3>Jenis Barang</h3>
                        <div class="filter-option">
                            <a href="produk.php<?php echo !empty($search_query) ? '?search='.urlencode($search_query) : ''; ?>" 
                               class="filter-link <?php echo empty($jenis_filter) ? 'active' : ''; ?>">
                                <span> Semua Produk</span>
                                <span class="filter-count">(<?php echo $total_semua; ?>)</span>
                            </a>
                        </div>
                        <div class="filter-option">
                            <a href="produk.php?jenis=darah<?php echo !empty($search_query) ? '&search='.urlencode($search_query) : ''; ?>" 
                               class="filter-link <?php echo $jenis_filter == 'darah' ? 'active' : ''; ?>">
                                <span> Obat Darah</span>
                                <span class="filter-count">(<?php echo isset($jenis_counts['darah']) ? $jenis_counts['darah'] : 0; ?>)</span>
                            </a>
                        </div>
                        <div class="filter-option">
                            <a href="produk.php?jenis=herbal<?php echo !empty($search_query) ? '&search='.urlencode($search_query) : ''; ?>" 
                               class="filter-link <?php echo $jenis_filter == 'herbal' ? 'active' : ''; ?>">
                                <span> Obat Herbal</span>
                                <span class="filter-count">(<?php echo isset($jenis_counts['herbal']) ? $jenis_counts['herbal'] : 0; ?>)</span>
                            </a>
                        </div>
                        <div class="filter-option">
                            <a href="produk.php?jenis=tubuh<?php echo !empty($search_query) ? '&search='.urlencode($search_query) : ''; ?>" 
                               class="filter-link <?php echo $jenis_filter == 'tubuh' ? 'active' : ''; ?>">
                                <span> Obat Tubuh</span>
                                <span class="filter-count">(<?php echo isset($jenis_counts['tubuh']) ? $jenis_counts['tubuh'] : 0; ?>)</span>
                            </a>
                        </div>
                        <div class="filter-option">
                            <a href="produk.php?jenis=kepala<?php echo !empty($search_query) ? '&search='.urlencode($search_query) : ''; ?>" 
                               class="filter-link <?php echo $jenis_filter == 'kepala' ? 'active' : ''; ?>">
                                <span> Obat Kepala</span>
                                <span class="filter-count">(<?php echo isset($jenis_counts['kepala']) ? $jenis_counts['kepala'] : 0; ?>)</span>
                            </a>
                        </div>
                    </div>
                    <?php if (!empty($jenis_filter) || !empty($search_query)) { ?>
                    <div class="filter-section">
                        <a href="produk.php" class="clear-filters">Reset Filter</a>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Produk Area -->
            <div class="col-lg-9">
                <div class="mb-4">
                    <?php
                    $total_produk = mysqli_num_rows($result);
                    
                    // Filter indikator teks
                    $filter_text = '';
                    if (!empty($jenis_filter)) {
                        $jenis_labels = [
                            'darah' => 'Obat Darah',
                            'herbal' => 'Obat Herbal',
                            'tubuh' => 'Obat Tubuh',
                            'kepala' => 'Obat Kepala'
                        ];
                        $filter_text = ' - Kategori: <strong>' . $jenis_labels[$jenis_filter] . '</strong>';
                    }
                    if (!empty($search_query)) {
                        $filter_text .= ' - Pencarian: <strong>"' . htmlspecialchars($search_query) . '"</strong>';
                    }
                    ?>
                    <div class="products-count">
                        Menampilkan <strong><?php echo $total_produk; ?></strong> produk<?php echo $filter_text; ?>
                        <?php if (!empty($jenis_filter) || !empty($search_query)) { ?>
                            <a href="produk.php" class="ms-3 text-danger" style="font-size: 14px; text-decoration: none;">
                                <i class="bi bi-x-circle"></i> Hapus Filter
                            </a>
                        <?php } ?>
                    </div>
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
                        $no_product_msg = 'Tidak ada produk ditemukan';
                        if (!empty($search_query)) {
                            $no_product_msg .= ' untuk pencarian "' . htmlspecialchars($search_query) . '"';
                        }
                        if (!empty($jenis_filter)) {
                            $jenis_labels = [
                                'darah' => 'Obat Darah',
                                'herbal' => 'Obat Herbal',
                                'tubuh' => 'Obat Tubuh',
                                'kepala' => 'Obat Kepala'
                            ];
                            $no_product_msg .= ' pada kategori ' . $jenis_labels[$jenis_filter];
                        }
                        ?>
                        <div class="col-12">
                            <div class="alert alert-info text-center" style="padding: 40px;">
                                <i class="bi bi-search" style="font-size: 48px; color: #999; display: block; margin-bottom: 20px;"></i>
                                <h5><?php echo $no_product_msg; ?></h5>
                                <p class="mb-3">Coba gunakan kata kunci lain atau lihat semua produk</p>
                                <a href="produk.php" class="btn btn-primary">Lihat Semua Produk</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Pindah Halaman-->
                <div class="d-flex justify-content-center gap-2 mt-5">
                    <button class="page-btn">←</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php if (isset($_GET['added'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="position:fixed; top:80px; right:20px; z-index:9999; animation: slideIn 0.5s ease; border-radius:12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <i class="bi bi-check-circle-fill"></i> Produk ditambahkan ke keranjang!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

    <!-- Keranjang -->
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