<?php
include 'config/db.php';

// Cek ada id_pemesanan
if (!isset($_SESSION['id_pemesanan'])) {
    header("Location: ../produk.php");
    exit;
}

$id_pemesanan = (int) $_SESSION['id_pemesanan'];

// Query ambil data pemesanan + user
$query = "SELECT p.*, u.nama, u.umur, u.no_hp 
          FROM pemesanan p 
          JOIN user u ON p.id_user = u.id_user 
          WHERE p.id_pemesanan = $id_pemesanan";
$result = mysqli_query($db, $query);
$pesanan = mysqli_fetch_assoc($result);

if (!$pesanan) {
    header("Location: ../produk.php");
    exit;
}

// Query ambil detail item
$query_detail = "SELECT dp.*, b.nama_barang, b.gambar 
                 FROM detail_pemesanan dp 
                 JOIN barang b ON dp.id_barang = b.id_barang 
                 WHERE dp.id_pemesanan = $id_pemesanan";
$result_detail = mysqli_query($db, $query_detail);

// Format tanggal
$tanggal = date('d F Y, H:i', strtotime($pesanan['tanggal_pesan']));

// Metode pembayaran label
$metode_label = $pesanan['metode_pembayaran'] === 'ewallet' ? 'E-Wallet' : 'Bayar di Tempat (COD)';

// Bersihkan session id_pemesanan
unset($_SESSION['id_pemesanan']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan - Marcydap Apotek</title>
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

        /* Stepper */
        .stepper {
            display: flex;
            justify-content: center;
            gap: 0;
            margin: 30px 0;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #aaa;
            font-size: 0.9rem;
        }

        .step.done {
            color: var(--accent);
            font-weight: 600;
        }

        .step.active {
            color: var(--primary);
            font-weight: 600;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ddd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .step.done .step-circle {
            background: var(--accent);
        }

        .step.active .step-circle {
            background: var(--primary);
        }

        .step-line {
            width: 40px;
            height: 2px;
            background: #ddd;
            margin: 0 10px;
            align-self: center;
        }

        .step-line.done {
            background: var(--accent);
        }

        /* Struk */
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

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            background: #fff3cd;
            color: #856404;
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
            margin-top: 20px;
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

        @media print {

            .header,
            .stepper,
            .btn-home,
            .btn-print,
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
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container">
            <h1>🧾 Detail Pemesanan</h1>
        </div>
    </header>

    <div class="container my-4">
        <!-- Stepper -->
        <div class="stepper">
            <div class="step done">
                <div class="step-circle">✓</div>
                <span>Keranjang</span>
            </div>
            <div class="step-line done"></div>
            <div class="step done">
                <div class="step-circle">✓</div>
                <span>Pemesanan</span>
            </div>
            <div class="step-line done"></div>
            <div class="step done">
                <div class="step-circle">✓</div>
                <span>Pembayaran</span>
            </div>
            <div class="step-line done"></div>
            <div class="step active">
                <div class="step-circle">4</div>
                <span>Selesai</span>
            </div>
        </div>

        <!-- Struk Pemesanan -->
        <div class="struk">
            <div class="struk-header">
                <div class="check-icon">✓</div>
                <h3>Pesanan Berhasil!</h3>
                <p>Terima kasih telah berbelanja di Marcydap Apotek</p>
            </div>

            <div class="struk-body">
                <!-- Info Pemesanan -->
                <div class="struk-info">
                    <div class="struk-info-item">
                        <label>No. Pesanan</label>
                        <span>#MRC-<?php echo str_pad($pesanan['id_pemesanan'], 5, '0', STR_PAD_LEFT); ?></span>
                    </div>
                    <div class="struk-info-item">
                        <label>Tanggal</label>
                        <span><?php echo $tanggal; ?></span>
                    </div>
                    <div class="struk-info-item">
                        <label>Nama Pemesan</label>
                        <span><?php echo htmlspecialchars($pesanan['nama']); ?></span>
                    </div>
                    <div class="struk-info-item">
                        <label>No. HP</label>
                        <span><?php echo htmlspecialchars($pesanan['no_hp']); ?></span>
                    </div>
                    <div class="struk-info-item">
                        <label>Pembayaran</label>
                        <span><?php echo $metode_label; ?></span>
                    </div>
                    <div class="struk-info-item">
                        <label>Status</label>
                        <span class="status-badge">Menunggu</span>
                    </div>
                </div>

                <!-- Lokasi Pengambilan -->
                <div class="mb-3 p-3 rounded" style="background: var(--light);">
                    <small class="text-muted d-block mb-1"><i class="bi bi-geo-alt-fill"></i> Lokasi Pengambilan:</small>
                    <strong style="color: var(--primary);">Apotek Marcydap — Jl. Gurami No. 123</strong>
                </div>

                <!-- Daftar Item -->
                <h6 class="fw-bold mb-3">Item Pesanan</h6>
                <?php while ($item = mysqli_fetch_assoc($result_detail)) {
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

                <!-- Total -->
                <div class="struk-total">
                    <span>TOTAL</span>
                    <span>Rp <?php echo number_format($pesanan['total_harga'], 0, ',', '.'); ?></span>
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
                    <a href="produk.php" class="btn-home">
                        <i class="bi bi-house"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>