<?php
include '../../config/db.php';

$daftar_pesanan = [];
$pesanan_detail = null;
$items = [];
$error = '';
$success = '';
$no_hp_input = '';
$mode = 'search'; // search | list | detail

// Handler Pembatalan Pesanan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_pesanan'])) {
    $id_pemesanan = (int) $_POST['id_pemesanan'];
    $hp_param = mysqli_real_escape_string($db, trim($_POST['no_hp']));
    
    // Verifikasi pesanan milik user ini dan statusnya masih menunggu
    $query_check = "SELECT p.*, u.no_hp FROM pemesanan p 
                    JOIN user u ON p.id_user = u.id_user 
                    WHERE p.id_pemesanan = $id_pemesanan 
                    AND u.no_hp = '$hp_param' 
                    AND (p.status IS NULL OR p.status = 'menunggu')";
    $result_check = mysqli_query($db, $query_check);
    
    if (mysqli_num_rows($result_check) > 0) {
        // Update status menjadi batal
        $query_cancel = "UPDATE pemesanan SET status = 'batal' WHERE id_pemesanan = $id_pemesanan";
        if (mysqli_query($db, $query_cancel)) {
            $success = 'Pesanan berhasil dibatalkan.';
        } else {
            $error = 'Gagal membatalkan pesanan.';
        }
    } else {
        $error = 'Pesanan tidak dapat dibatalkan.';
    }
}

// Mode 1: Cari berdasarkan No HP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['no_hp'])) {
    $no_hp_input = trim($_POST['no_hp']);

    if (empty($no_hp_input)) {
        $error = 'Harap masukkan nomor HP.';
    } else {
        $no_hp_escaped = mysqli_real_escape_string($db, $no_hp_input);
        $query = "SELECT p.*, u.nama, u.no_hp 
                  FROM pemesanan p 
                  JOIN user u ON p.id_user = u.id_user 
                  WHERE u.no_hp = '$no_hp_escaped' 
                  ORDER BY p.tanggal_pesan DESC";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) === 0) {
            $error = 'Tidak ditemukan pesanan dengan nomor HP tersebut.';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $daftar_pesanan[] = $row;
            }
            $mode = 'list';
        }
    }
}

// Mode 2: Lihat detail struk tertentu (via GET)
if (isset($_GET['id']) && isset($_GET['hp'])) {
    $id_pemesanan = (int) $_GET['id'];
    $hp_param = mysqli_real_escape_string($db, trim($_GET['hp']));

    $query = "SELECT p.*, u.nama, u.umur, u.no_hp 
              FROM pemesanan p 
              JOIN user u ON p.id_user = u.id_user 
              WHERE p.id_pemesanan = $id_pemesanan 
              AND u.no_hp = '$hp_param'";
    $result = mysqli_query($db, $query);
    $pesanan_detail = mysqli_fetch_assoc($result);

    if ($pesanan_detail) {
        $query_items = "SELECT dp.*, b.nama_barang, b.gambar 
                        FROM detail_pemesanan dp 
                        JOIN barang b ON dp.id_barang = b.id_barang 
                        WHERE dp.id_pemesanan = $id_pemesanan";
        $result_items = mysqli_query($db, $query_items);
        while ($row = mysqli_fetch_assoc($result_items)) {
            $items[] = $row;
        }
        $mode = 'detail';
        $no_hp_input = $hp_param;
    } else {
        $error = 'Pesanan tidak ditemukan.';
    }
}

// Helper fungsi status
function getStatusInfo($status)
{
    $status = $status ?? 'menunggu';
    switch ($status) {
        case 'selesai':
            return ['text' => 'Selesai', 'class' => 'status-selesai'];
        case 'batal':
            return ['text' => 'Dibatalkan', 'class' => 'status-batal'];
        default:
            return ['text' => 'Menunggu', 'class' => 'status-menunggu'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Pesanan - Marcydap Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/cek_pesanan.css">
</head>

<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>Cek Pesanan</h1>
            <a href="../produk.php" class="btn-back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
    </header>

    <div class="container my-4">

        <?php if ($mode === 'search') { ?>
            <!-- ========== MODE: FORM PENCARIAN ========== -->
            <div class="search-card">
                <div class="search-icon">
                    <i class="bi bi-phone"></i>
                </div>
                <h4>Cek Pesanan Anda</h4>
                <p class="subtitle">Masukkan nomor HP yang digunakan saat memesan untuk melihat semua riwayat pesanan Anda</p>

                <?php if ($error) { ?>
                    <div class="alert-error">
                        <i class="bi bi-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                <?php } ?>
                <?php if ($success) { ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> <?php echo $success; ?>
                    </div>
                <?php } ?>

                <form method="POST" action="">
                    <div class="mb-4">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control"
                            placeholder="Contoh: 081234567890"
                            value="<?php echo htmlspecialchars($no_hp_input); ?>"
                            required>
                        <div class="input-hint">Nomor HP yang Anda gunakan saat mengisi data pemesanan</div>
                    </div>
                    <button type="submit" class="btn-cari">
                        <i class="bi bi-search"></i> Cari Pesanan Saya
                    </button>
                </form>
            </div>


        <?php } elseif ($mode === 'list') { ?>
            <!-- ========== MODE: DAFTAR PESANAN ========== -->
            <div class="list-container">
                <div class="list-header">
                    <h5>📋 Pesanan Anda</h5>
                    <span class="jumlah"><?php echo count($daftar_pesanan); ?> pesanan</span>
                </div>

                <div class="mb-3 p-3 rounded" style="background: var(--light);">
                    <small><i class="bi bi-phone"></i> Menampilkan pesanan untuk: <strong><?php echo htmlspecialchars($no_hp_input); ?></strong></small>
                </div>

                <?php foreach ($daftar_pesanan as $p) {
                    $tgl = date('d M Y, H:i', strtotime($p['tanggal_pesan']));
                    $metode = $p['metode_pembayaran'] === 'ewallet' ? 'E-Wallet' : 'COD';
                    $si = getStatusInfo($p['status'] ?? 'menunggu');
                ?>
                    <a href="cek_pesanan.php?id=<?php echo $p['id_pemesanan']; ?>&hp=<?php echo urlencode($no_hp_input); ?>" class="card-pesanan">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="kode">
                                    #MRC-<?php echo str_pad($p['id_pemesanan'], 5, '0', STR_PAD_LEFT); ?>
                                    <span class="status-badge <?php echo $si['class']; ?> ms-2"><?php echo $si['text']; ?></span>
                                </div>
                                <div class="tanggal mt-1">
                                    <i class="bi bi-calendar3"></i> <?php echo $tgl; ?> &nbsp;|&nbsp;
                                    <i class="bi bi-credit-card"></i> <?php echo $metode; ?>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="total">Rp <?php echo number_format($p['total_harga'], 0, ',', '.'); ?></div>
                                <div class="metode"><i class="bi bi-chevron-right"></i> Lihat Struk</div>
                            </div>
                        </div>
                    </a>
                <?php } ?>

                <div class="text-center mt-4">
                    <a href="cek_pesanan.php" class="btn-cari-ulang">
                        <i class="bi bi-arrow-left"></i> Cari Nomor Lain
                    </a>
                </div>
            </div>


        <?php } elseif ($mode === 'detail') {
            // ========== MODE: DETAIL STRUK ==========
            $tanggal_fmt = date('d F Y, H:i', strtotime($pesanan_detail['tanggal_pesan']));
            $metode = $pesanan_detail['metode_pembayaran'] === 'ewallet' ? 'E-Wallet' : 'Bayar di Tempat (COD)';
            $si = getStatusInfo($pesanan_detail['status'] ?? 'menunggu');
        ?>
            <div class="struk">
                <div class="struk-header">
                    <div class="check-icon"><i class="bi bi-receipt"></i></div>
                    <h3>Pesanan #MRC-<?php echo str_pad($pesanan_detail['id_pemesanan'], 5, '0', STR_PAD_LEFT); ?></h3>
                    <p>Marcydap Apotek</p>
                </div>

                <div class="struk-body">
                    <div class="struk-info">
                        <div class="struk-info-item">
                            <label>No. Pesanan</label>
                            <span>#MRC-<?php echo str_pad($pesanan_detail['id_pemesanan'], 5, '0', STR_PAD_LEFT); ?></span>
                        </div>
                        <div class="struk-info-item">
                            <label>Tanggal</label>
                            <span><?php echo $tanggal_fmt; ?></span>
                        </div>
                        <div class="struk-info-item">
                            <label>Nama Pemesan</label>
                            <span><?php echo htmlspecialchars($pesanan_detail['nama']); ?></span>
                        </div>
                        <div class="struk-info-item">
                            <label>No. HP</label>
                            <span><?php echo htmlspecialchars($pesanan_detail['no_hp']); ?></span>
                        </div>
                        <div class="struk-info-item">
                            <label>Pembayaran</label>
                            <span><?php echo $metode; ?></span>
                        </div>
                        <div class="struk-info-item">
                            <label>Status</label>
                            <span class="status-badge <?php echo $si['class']; ?>"><?php echo $si['text']; ?></span>
                        </div>
                    </div>

                    <div class="mb-3 p-3 rounded" style="background: var(--light);">
                        <small class="text-muted d-block mb-1"><i class="bi bi-geo-alt-fill"></i> Lokasi Pengambilan:</small>
                        <strong style="color: var(--primary);">Apotek Marcydap — Jl. Gurami No. 123</strong>
                    </div>

                    <h6 class="fw-bold mb-3">Item Pesanan</h6>
                    <?php foreach ($items as $item) {
                        $subtotal = $item['jumlah'] * $item['harga_satuan'];
                    ?>
                        <div class="struk-item">
                            <div class="struk-item-img" style="background-image: url('<?php echo $item['gambar']; ?>')"></div>
                            <div class="struk-item-info">
                                <div class="struk-item-name"><?php echo htmlspecialchars($item['nama_barang']); ?></div>
                                <div class="struk-item-qty"><?php echo $item['jumlah']; ?> x Rp <?php echo number_format($item['harga_satuan'], 0, ',', '.'); ?></div>
                            </div>
                            <div class="struk-item-price">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                        </div>
                    <?php } ?>

                    <div class="struk-total">
                        <span>TOTAL</span>
                        <span>Rp <?php echo number_format($pesanan_detail['total_harga'], 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="struk-footer">
                    <p>Silakan ambil pesanan Anda di lokasi apotek.</p>
                    <p>Tunjukkan struk ini saat pengambilan.</p>
                    
                    <?php if ($success) { ?>
                        <div class="alert alert-success mb-3">
                            <i class="bi bi-check-circle"></i> <?php echo $success; ?>
                        </div>
                    <?php } ?>
                    <?php if ($error) { ?>
                        <div class="alert alert-danger mb-3">
                            <i class="bi bi-exclamation-circle"></i> <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    
                    <div class="no-print">
                        <button class="btn-print" onclick="window.print()">
                            <i class="bi bi-printer"></i> Cetak Struk
                        </button>
                        <br>
                        
                        <?php 
                        // Tombol batal hanya muncul jika status masih menunggu
                        $status_pesanan = $pesanan_detail['status'] ?? 'menunggu';
                        if ($status_pesanan === 'menunggu' || $status_pesanan === NULL) { 
                        ?>
                        <form method="POST" action="cek_pesanan.php?id=<?php echo $pesanan_detail['id_pemesanan']; ?>&hp=<?php echo urlencode($no_hp_input); ?>" 
                              style="display:inline;" 
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                            <input type="hidden" name="id_pemesanan" value="<?php echo $pesanan_detail['id_pemesanan']; ?>">
                            <input type="hidden" name="no_hp" value="<?php echo htmlspecialchars($no_hp_input); ?>">
                            <button type="submit" name="cancel_pesanan" class="btn-cancel" style="background: #dc3545; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; font-weight: 500; margin-top: 10px;">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </button>
                        </form>
                        <br>
                        <?php } ?>
                        
                        <!-- Kembali ke daftar pesanan -->
                        <form method="POST" action="cek_pesanan.php" style="display:inline;">
                            <input type="hidden" name="no_hp" value="<?php echo htmlspecialchars($no_hp_input); ?>">
                            <button type="submit" class="btn-kembali-list">
                                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
                            </button>
                        </form>
                        <br>
                        <a href="produk.php" class="btn-home">
                            <i class="bi bi-house"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

        <?php } ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>