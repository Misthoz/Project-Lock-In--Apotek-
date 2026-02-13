// filepath: d:\laragon\www\PHP\Project-Lock-In--Apotek-\main\pemesanan\pembayaran.php
<?php
include '../../config/db.php';

// Cek data lengkap
if (empty($_SESSION['keranjang']) || empty($_SESSION['data_pemesan'])) {
    header("Location: keranjang.php");
    exit;
}

// Proses pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bayar'])) {
    $metode = $_POST['metode_pembayaran'];
    $data = $_SESSION['data_pemesan'];
    
    // 1. Insert user
    $nama = mysqli_real_escape_string($db, $data['nama']);
    $umur = (int) $data['umur'];
    $no_hp = mysqli_real_escape_string($db, $data['no_hp']);
    
    $query_user = "INSERT INTO user (nama, umur, no_hp) VALUES ('$nama', $umur, '$no_hp')";
    mysqli_query($db, $query_user);
    $id_user = mysqli_insert_id($db);
    
    // 2. Hitung total harga
    $total_harga = 0;
    foreach ($_SESSION['keranjang'] as $item) {
        $total_harga += $item['harga'] * $item['jumlah'];
    }
    
    // 3. Insert pemesanan
    $query_pesan = "INSERT INTO pemesanan (id_user, metode_pembayaran, total_harga) 
                    VALUES ($id_user, '$metode', $total_harga)";
    mysqli_query($db, $query_pesan);
    $id_pemesanan = mysqli_insert_id($db);
    
    // 4. Insert detail pemesanan
    foreach ($_SESSION['keranjang'] as $item) {
        $id_barang = (int) $item['id_barang'];
        $jumlah = (int) $item['jumlah'];
        $harga_satuan = (int) $item['harga'];
        
        $query_detail = "INSERT INTO detail_pemesanan (id_pemesanan, id_barang, jumlah, harga_satuan) 
                         VALUES ($id_pemesanan, $id_barang, $jumlah, $harga_satuan)";
        mysqli_query($db, $query_detail);
    }
    
    // 5. Simpan id_pemesanan ke session lalu bersihkan keranjang
    $_SESSION['id_pemesanan'] = $id_pemesanan;
    $_SESSION['keranjang'] = [];
    $_SESSION['data_pemesan'] = [];
    
    header("Location: detailpemesanan.php");
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
    <title>Pembayaran - Marcydap Apotek</title>
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
        .stepper { display: flex; justify-content: center; gap: 0; margin: 30px 0; }
        .step { display: flex; align-items: center; gap: 8px; color: #aaa; font-size: 0.9rem; }
        .step.active { color: var(--primary); font-weight: 600; }
        .step.done { color: var(--accent); }
        .step-circle {
            width: 32px; height: 32px; border-radius: 50%; background: #ddd;
            color: white; display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.85rem;
        }
        .step.active .step-circle { background: var(--primary); }
        .step.done .step-circle { background: var(--accent); }
        .step-line { width: 40px; height: 2px; background: #ddd; margin: 0 10px; align-self: center; }
        .step-line.done { background: var(--accent); }

        .payment-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }
        .payment-card h4 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
            margin-bottom: 20px;
        }
        .payment-option {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 12px;
        }
        .payment-option:hover { border-color: var(--accent); background: #fafffe; }
        .payment-option.selected { border-color: var(--accent); background: var(--light); }
        .payment-option input[type="radio"] { display: none; }
        .payment-option .option-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .payment-icon {
            width: 50px; height: 50px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
        }
        .ewallet-icon { background: #e8f5e9; color: #2e7d32; }
        .cod-icon { background: #fff3e0; color: #e65100; }
        .btn-bayar {
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }
        .btn-bayar:hover { background: var(--dark); }
        .btn-bayar:disabled { background: #ccc; cursor: not-allowed; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>💳 Pembayaran</h1>
            <a href="pemesanan.php" class="text-white text-decoration-none">
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
            <div class="step done">
                <div class="step-circle">✓</div>
                <span>Pemesanan</span>
            </div>
            <div class="step-line done"></div>
            <div class="step active">
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
                <form method="POST" id="formBayar">
                    <div class="payment-card">
                        <h4><i class="bi bi-credit-card"></i> Pilih Metode Pembayaran</h4>

                        <!-- E-Wallet -->
                        <label class="payment-option" id="opt-ewallet">
                            <input type="radio" name="metode_pembayaran" value="ewallet" required>
                            <div class="option-content">
                                <div class="payment-icon ewallet-icon">
                                    <i class="bi bi-phone"></i>
                                </div>
                                <div>
                                    <strong>E-Wallet</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">GoPay, OVO, DANA, ShopeePay</p>
                                </div>
                            </div>
                        </label>

                        <!-- COD -->
                        <label class="payment-option" id="opt-cod">
                            <input type="radio" name="metode_pembayaran" value="cod" required>
                            <div class="option-content">
                                <div class="payment-icon cod-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div>
                                    <strong>Bayar di Tempat (COD)</strong>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">Bayar saat mengambil pesanan di apotek</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <button type="submit" name="bayar" class="btn-bayar" id="btnBayar" disabled>
                        <i class="bi bi-shield-check"></i> Konfirmasi & Bayar — Rp <?php echo number_format($total_harga, 0, ',', '.'); ?>
                    </button>
                </form>
            </div>

            <div class="col-lg-5">
                <!-- Info Pemesan -->
                <div class="payment-card">
                    <h4><i class="bi bi-person"></i> Data Pemesan</h4>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="text-muted">Nama</td>
                            <td class="fw-bold"><?php echo htmlspecialchars($_SESSION['data_pemesan']['nama']); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Umur</td>
                            <td class="fw-bold"><?php echo $_SESSION['data_pemesan']['umur']; ?> tahun</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. HP</td>
                            <td class="fw-bold"><?php echo htmlspecialchars($_SESSION['data_pemesan']['no_hp']); ?></td>
                        </tr>
                    </table>
                </div>

                <!-- Ringkasan -->
                <div class="payment-card">
                    <h4><i class="bi bi-receipt"></i> Ringkasan</h4>
                    <?php foreach ($_SESSION['keranjang'] as $item) { ?>
                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                            <span><?php echo htmlspecialchars($item['nama_barang']); ?> x<?php echo $item['jumlah']; ?></span>
                            <span class="fw-bold">Rp <?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></span>
                        </div>
                    <?php } ?>
                    <div class="d-flex justify-content-between mt-2 pt-2" style="font-size: 1.2rem; font-weight: 700; color: var(--primary);">
                        <span>Total</span>
                        <span>Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Payment option selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
                document.getElementById('btnBayar').disabled = false;
            });
        });
    </script>
</body>
</html>