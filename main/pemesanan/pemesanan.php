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
            --primary-green: #1a472a;
            --secondary-green: #2d6a4f;
            --accent-green: #52b788;
            --light-green: #95d5b2;
            --bg-cream: #faf8f3;
            --text-dark: #1a1a1a;
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg-cream); color: var(--text-dark); }

        .header { background: white; box-shadow: 0 2px 20px rgba(0,0,0,0.06); }
        .logo-icon {
            width: 45px; height: 45px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;
        }
        .logo-icon::before, .logo-icon::after { content: ''; position: absolute; background: white; }
        .logo-icon::before { width: 5px; height: 20px; }
        .logo-icon::after { width: 20px; height: 5px; }
        .logo-text h1 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 24px; margin: 0; }
        .logo-text p { color: var(--accent-green); font-size: 10px; letter-spacing: 2px; text-transform: uppercase; margin: 0; }

        .step-number {
            width: 35px; height: 35px; background: #e8f5e9; color: #999;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 14px;
        }
        .step.active .step-number { background: var(--accent-green); color: white; }
        .step.completed .step-number { background: var(--secondary-green); color: white; }
        .step-label { font-size: 14px; color: #999; font-weight: 500; }
        .step.active .step-label { color: var(--primary-green); font-weight: 600; }

        .section-card {
            background: white; border-radius: 16px; padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); margin-bottom: 25px;
        }
        .section-header { margin-bottom: 25px; }
        .section-header h2 { font-size: 20px; color: var(--primary-green); }
        .edit-btn {
            padding: 8px 16px; background: white; border: 2px solid var(--accent-green);
            color: var(--secondary-green); border-radius: 8px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease;
        }
        .edit-btn:hover { background: var(--light-green); }

        .address-card {
            background: #f0f8f4; padding: 20px; border-radius: 12px; border: 2px solid var(--accent-green);
        }
        .address-type {
            background: var(--accent-green); color: white; padding: 4px 12px;
            border-radius: 12px; font-size: 11px; font-weight: 600;
        }
        .address-name { font-weight: 600; color: var(--primary-green); font-size: 16px; margin-bottom: 5px; }
        .address-phone { color: #666; font-size: 14px; margin-bottom: 10px; }
        .address-detail { color: #555; font-size: 14px; line-height: 1.7; }
        .add-address-btn {
            width: 100%; padding: 15px; background: white; border: 2px dashed var(--accent-green);
            color: var(--secondary-green); border-radius: 12px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease; margin-top: 15px;
        }
        .add-address-btn:hover { background: #f0f8f4; }

        .cart-item {
            display: flex; gap: 20px; padding: 20px; background: #f8f9fa; border-radius: 12px;
        }
        .item-image {
            width: 100px; height: 100px; background: linear-gradient(135deg, #f0f0f0, #e8f5e9);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            font-size: 40px; flex-shrink: 0;
        }
        .item-category { color: var(--accent-green); font-size: 11px; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .item-name { font-weight: 600; color: var(--primary-green); font-size: 16px; margin-bottom: 8px; }
        .item-meta { font-size: 13px; color: #666; margin-bottom: 15px; }
        .qty-btn {
            width: 32px; height: 32px; background: white; border: 2px solid #e8f5e9;
            border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600;
            color: var(--secondary-green); transition: all 0.3s ease;
        }
        .qty-btn:hover { background: var(--light-green); border-color: var(--accent-green); }
        .qty-number { width: 50px; text-align: center; font-weight: 600; color: var(--primary-green); }
        .item-price { font-size: 20px; font-weight: 700; color: var(--secondary-green); }
        .remove-btn {
            color: #dc3545; font-size: 13px; font-weight: 600; cursor: pointer;
            background: none; border: none; padding: 8px 12px; border-radius: 6px; transition: all 0.3s ease;
        }
        .remove-btn:hover { background: #ffe8ea; }

        .voucher-input input {
            flex: 1; padding: 14px 18px; border: 2px solid #e8f5e9; border-radius: 10px; font-size: 14px;
        }
        .voucher-input input:focus { outline: none; border-color: var(--accent-green); }
        .apply-btn {
            padding: 14px 28px; background: var(--secondary-green); color: white; border: none;
            border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;
        }
        .apply-btn:hover { background: var(--primary-green); }

        .sidebar-sticky { position: sticky; top: 100px; }
        .summary-card {
            background: white; border-radius: 16px; padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .summary-card h2 { font-size: 20px; color: var(--primary-green); margin-bottom: 25px; }
        .summary-item { display: flex; justify-content: space-between; align-items: center; }
        .summary-label { color: #666; font-size: 14px; }
        .summary-value { font-weight: 600; color: var(--text-dark); font-size: 15px; }
        .summary-value.discount { color: #dc3545; }
        .summary-total { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-top: 2px solid #f0f0f0; margin-top: 20px; }
        .summary-total-label { font-size: 18px; font-weight: 600; color: var(--primary-green); }
        .summary-total-value { font-size: 28px; font-weight: 700; color: var(--secondary-green); }
        .checkout-btn {
            width: 100%; padding: 18px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            color: white; border: none; border-radius: 12px; font-size: 16px; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease; display: block; text-align: center; text-decoration: none; margin-top: 20px;
        }
        .checkout-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4); color: white; }
        .benefits-list { background: #f8fffe; padding: 20px; border-radius: 12px; margin-top: 20px; }
        .benefits-list h3 { font-size: 14px; color: var(--primary-green); margin-bottom: 12px; }
        .benefit-item { font-size: 13px; color: #555; margin-bottom: 10px; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <a href="../dashboard.php" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="logo-icon"></div>
                    <div class="logo-text"><h1>MARCYDAP</h1><p>APOTEK</p></div>
                </a>
                <div class="d-none d-md-flex gap-4 align-items-center">
                    <div class="step completed d-flex align-items-center gap-2"><div class="step-number">1</div><div class="step-label">Keranjang</div></div>
                    <div class="step active d-flex align-items-center gap-2"><div class="step-number">2</div><div class="step-label">Pemesanan</div></div>
                    <div class="step d-flex align-items-center gap-2"><div class="step-number">3</div><div class="step-label">Pembayaran</div></div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="row g-4">
            <!-- Left Section -->
            <div class="col-lg-8">
                <!-- Shipping Address -->
                <div class="section-card">
                    <div class="section-header d-flex justify-content-between align-items-center">
                        <h2>Alamat Penerimaan</h2>
                        <button class="edit-btn">Ubah</button>
                    </div>
                    <div class="address-card">
                        <div class="mb-3"><span class="address-type">Apotek</span></div>
                        <div class="address-name">Sarah Wijaya</div>
                        <div class="address-phone">+62 812-3456-7890</div>
                        <div class="address-detail">
                            Jl. Kemang Raya No. 45, RT 001/RW 005<br>
                            Bangka, Mampang Prapatan<br>
                            Jakarta Selatan, DKI Jakarta 12730
                        </div>
                    </div>
                    <button class="add-address-btn">+ Tambah Alamat Baru</button>
                </div>

                <!-- Cart Items -->
                <div class="section-card">
                    <div class="section-header"><h2>Produk yang Dipesan</h2></div>
                    <div class="d-flex flex-column gap-3">
                    </div>
                </div>

                <!-- Voucher -->
                <div class="section-card">
                    <div class="section-header"><h2>🎟️ Voucher Diskon</h2></div>
                    <div class="voucher-input d-flex gap-3">
                        <input type="text" placeholder="Masukkan kode voucher">
                        <button class="apply-btn">Gunakan</button>
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="summary-card">
                        <h2>Ringkasan Pesanan</h2>
                        <!-- <div class="d-flex flex-column gap-3 mb-3 pb-3 border-bottom">
                            <div class="summary-item"><span class="summary-label">Subtotal (3 item)</span><span class="summary-value">Rp 95.750</span></div>
                            <div class="summary-item"><span class="summary-label">Biaya Pengiriman</span><span class="summary-value">Rp 15.000</span></div>
                            <div class="summary-item"><span class="summary-label">Diskon Voucher</span><span class="summary-value discount">- Rp 10.000</span></div>
                        </div>
                        <div class="summary-total"><span class="summary-total-label">Total Pembayaran</span><span class="summary-total-value">Rp 100.750</span></div> -->
                        <a href="pembayaran.php" class="checkout-btn">Lanjut ke Pembayaran</a>
                        <div class="text-center text-muted mt-3" style="font-size:13px;">🔒 Transaksi aman & terenkripsi</div>
                        <div class="benefits-list">
                            <h3>✨ Keuntungan Berbelanja</h3>
                            <div class="benefit-item">✓ Produk 100% original</div>
                            <div class="benefit-item">✓ Gratis konsultasi apoteker</div>
                            <div class="benefit-item">✓ Poin reward setiap transaksi</div>
                            <div class="benefit-item">✓ Kemudahan retur & refund</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
