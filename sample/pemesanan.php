<?php
include '../../config/db.php';

// Cek keranjang tidak kosong
if (empty($_SESSION['keranjang'])) {
    header("Location: keranjang.php");
    exit;
}

// Proses form data user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lanjut_bayar'])) {
    // Simpan data user ke session
    $_SESSION['data_pemesan'] = [
        'nama' => trim($_POST['nama']),
        'umur' => (int) $_POST['umur'],
        'no_hp' => trim($_POST['no_hp'])
    ];
    
    header("Location: pembayaran.php");
    exit;
}

// Hitung total
$total_harga = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total_harga += $item['harga'] * $item['jumlah'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Marcydap Apotek</title>
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
        .step.active { color: var(--primary); font-weight: 600; }
        .step.done { color: var(--accent); }
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
        .step.active .step-circle { background: var(--primary); }
        .step.done .step-circle { background: var(--accent); }
        .step-line {
            width: 40px;
            height: 2px;
            background: #ddd;
            margin: 0 10px;
            align-self: center;
        }
        .step-line.done { background: var(--accent); }

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }
        .form-card h4 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
            margin-bottom: 20px;
        }
        .lokasi-box {
            background: var(--light);
            border: 2px solid var(--accent);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }
        .lokasi-box i { font-size: 2rem; color: var(--primary); }
        .lokasi-box h5 { color: var(--primary); margin-top: 10px; }
        .lokasi-box p { color: #666; margin: 0; }
        .btn-next {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-next:hover { background: var(--secondary); color: white; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>📋 Pemesanan</h1>
            <a href="keranjang.php" class="text-white text-decoration-none">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
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
            <div class="step active">
                <div class="step-circle">2</div>
                <span>Pemesanan</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">3</div>
                <span>Pembayaran</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-circle">4</div>
                <span>Selesai</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <!-- Form Data Pemesan -->
                <div class="form-card">
                    <h4><i class="bi bi-person-fill"></i> Data Pemesan</h4>
                    <form method="POST" id="formPemesanan">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" required 
                                   value="<?php echo isset($_SESSION['data_pemesan']['nama']) ? htmlspecialchars($_SESSION['data_pemesan']['nama']) : ''; ?>"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="umur" name="umur" required min="1" max="120"
                                   value="<?php echo isset($_SESSION['data_pemesan']['umur']) ? $_SESSION['data_pemesan']['umur'] : ''; ?>"
                                   placeholder="Masukkan umur">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required
                                   value="<?php echo isset($_SESSION['data_pemesan']['no_hp']) ? htmlspecialchars($_SESSION['data_pemesan']['no_hp']) : ''; ?>"
                                   placeholder="Contoh: 08123456789">
                        </div>
                        <button type="submit" name="lanjut_bayar" class="btn-next w-100">
                            Lanjut ke Pembayaran <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <!-- Lokasi Pengambilan -->
                <div class="form-card">
                    <h4><i class="bi bi-geo-alt-fill"></i> Lokasi Pengambilan</h4>
                    <div class="lokasi-box">
                        <i class="bi bi-building"></i>
                        <h5>Apotek Marcydap Pusat</h5>
                        <p>Jl. Gurami No. 123, Kota Anda</p>
                        <hr>
                        <small class="text-muted">
                            <i class="bi bi-clock"></i> Buka: Senin - Sabtu, 08:00 - 21:00
                        </small>
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="form-card">
                    <h4><i class="bi bi-receipt"></i> Ringkasan Pesanan</h4>
                    <?php foreach ($_SESSION['keranjang'] as $item) { ?>
                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <span><?php echo htmlspecialchars($item['nama_barang']); ?> x<?php echo $item['jumlah']; ?></span>
                            <span class="fw-bold">Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></span>
                        </div>
                    <?php } ?>
                    <div class="d-flex justify-content-between mt-3 pt-2" style="font-size: 1.2rem; font-weight: 700; color: var(--primary);">
                        <span>Total</span>
                        <span>Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>