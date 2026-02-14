<?php
include 'config/db.php';

$daftar_pesanan = [];
$pesanan_detail = null;
$items = [];
$error = '';
$no_hp_input = '';
$mode = 'search'; // search | list | detail

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
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            color: white;
            font-size: 1.5rem;
            margin: 0;
        }

        .btn-back-link {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-back-link:hover {
            color: var(--light);
        }

        /* Search Card */
        .search-card {
            background: white;
            max-width: 500px;
            margin: 30px auto;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .search-card h4 {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            text-align: center;
            margin-bottom: 5px;
        }

        .search-card .subtitle {
            text-align: center;
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .search-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: var(--light);
            color: var(--primary);
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.85rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.15);
        }

        .btn-cari {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.3s;
        }

        .btn-cari:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(27, 67, 50, 0.3);
        }

        .alert-error {
            background: #fff0f0;
            border: 1px solid #ffcdd2;
            color: #c62828;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .input-hint {
            font-size: 0.78rem;
            color: #aaa;
            margin-top: 4px;
        }

        /* List Pesanan */
        .list-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .list-header h5 {
            font-family: 'Playfair Display', serif;
            color: var(--primary);
            margin: 0;
        }

        .list-header .jumlah {
            background: var(--light);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .card-pesanan {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s;
            cursor: pointer;
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .card-pesanan:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            color: inherit;
        }

        .card-pesanan .kode {
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
        }

        .card-pesanan .tanggal {
            color: #999;
            font-size: 0.82rem;
        }

        .card-pesanan .total {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .card-pesanan .metode {
            font-size: 0.8rem;
            color: #777;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
        }

        .status-batal {
            background: #f8d7da;
            color: #721c24;
        }

        .btn-cari-ulang {
            background: white;
            color: var(--secondary);
            border: 2px solid var(--secondary);
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .btn-cari-ulang:hover {
            background: var(--secondary);
            color: white;
        }

        /* Struk Detail */
        .struk {
            background: white;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .struk-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            text-align: center;
            padding: 30px 20px;
        }

        .struk-header .check-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--accent);
            color: white;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .struk-header h3 {
            font-family: 'Playfair Display', serif;
            margin: 0;
        }

        .struk-header p {
            margin: 5px 0 0;
            opacity: 0.8;
        }

        .struk-body {
            padding: 25px;
        }

        .struk-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px dashed #eee;
        }

        .struk-info-item label {
            display: block;
            font-size: 0.8rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .struk-info-item span {
            font-weight: 600;
            color: var(--dark);
        }

        .struk-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .struk-item-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background-size: cover;
            background-position: center;
            background-color: #eee;
            flex-shrink: 0;
        }

        .struk-item-info {
            flex: 1;
        }

        .struk-item-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .struk-item-qty {
            color: #999;
            font-size: 0.8rem;
        }

        .struk-item-price {
            font-weight: 700;
            color: var(--primary);
            white-space: nowrap;
        }

        .struk-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #eee;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
        }

        .struk-footer {
            text-align: center;
            padding: 20px;
            background: #fafafa;
            border-top: 1px solid #eee;
        }

        .struk-footer p {
            color: #999;
            font-size: 0.85rem;
            margin: 0;
        }

        .btn-home {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .btn-home:hover {
            background: var(--secondary);
            color: white;
        }

        .btn-print {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
        }

        .btn-print:hover {
            background: var(--primary);
            color: white;
        }

        .btn-kembali-list {
            background: white;
            color: var(--secondary);
            border: 2px solid var(--secondary);
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .btn-kembali-list:hover {
            background: var(--secondary);
            color: white;
        }

        @media print {

            .header,
            .btn-home,
            .btn-print,
            .btn-kembali-list,
            .struk-footer .no-print {
                display: none !important;
            }

            .struk {
                box-shadow: none;
            }

            body {
                background: white;
            }
        }

        @media (max-width: 576px) {
            .struk-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>🔍 Cek Pesanan</h1>
            <a href="produk.php" class="btn-back-link"><i class="bi bi-arrow-left"></i> Kembali</a>
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
                    <div class="no-print">
                        <button class="btn-print" onclick="window.print()">
                            <i class="bi bi-printer"></i> Cetak Struk
                        </button>
                        <br>
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