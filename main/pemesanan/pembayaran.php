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
        .section-header h2 { font-size: 20px; color: var(--primary-green); margin-bottom: 8px; }
        .section-header p { color: #666; font-size: 14px; }

        .payment-tab {
            padding: 10px 20px; background: transparent; border: none;
            border-bottom: 3px solid transparent; font-size: 14px; font-weight: 600;
            color: #999; cursor: pointer; transition: all 0.3s ease;
        }
        .payment-tab.active { color: var(--secondary-green); border-bottom-color: var(--accent-green); }

        .va-details {
            background: #f8fffe; padding: 20px; border-radius: 12px;
            border-left: 4px solid var(--accent-green); margin-top: 20px;
        }
        .va-number {
            display: flex; justify-content: space-between; align-items: center;
            background: white; padding: 15px 20px; border-radius: 10px; margin-bottom: 15px;
        }
        .va-number-text { font-size: 20px; font-weight: 700; color: var(--primary-green); letter-spacing: 2px; }
        .copy-btn {
            padding: 8px 16px; background: var(--accent-green); color: white; border: none;
            border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;
        }
        .copy-btn:hover { background: var(--secondary-green); }

        .payment-deadline {
            background: #fff3cd; border: 1px solid #ffc107; padding: 15px;
            border-radius: 10px; margin-top: 15px; text-align: center;
        }
        .payment-deadline strong { color: #ff6b6b; font-size: 16px; }
        .payment-deadline p { color: #856404; font-size: 13px; margin-top: 5px; margin-bottom: 0; }

        .step-num {
            width: 28px; height: 28px; background: var(--accent-green); color: white;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 13px; flex-shrink: 0;
        }
        .step-text { color: #555; font-size: 14px; line-height: 1.7; padding-top: 2px; }

        .order-details-box { background: #f8f9fa; padding: 20px; border-radius: 12px; }
        .order-item {
            display: flex; justify-content: space-between; padding: 12px 0;
            border-bottom: 1px solid #e8f5e9;
        }
        .order-item:last-child { border-bottom: none; }
        .order-item-name { color: #555; font-size: 14px; }
        .order-item-qty { color: #999; font-size: 13px; }
        .order-item-price { font-weight: 600; color: var(--primary-green); font-size: 14px; }

        .sidebar-sticky { position: sticky; top: 100px; }
        .summary-card {
            background: white; border-radius: 16px; padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .summary-card h2 { font-size: 20px; color: var(--primary-green); margin-bottom: 25px; }
        .summary-item { display: flex; justify-content: space-between; align-items: center; }
        .summary-label { color: #666; font-size: 14px; }
        .summary-value { font-weight: 600; color: var(--text-dark); font-size: 15px; }
        .summary-total { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-top: 2px solid #f0f0f0; margin-top: 20px; }
        .summary-total-label { font-size: 18px; font-weight: 600; color: var(--primary-green); }
        .summary-total-value { font-size: 28px; font-weight: 700; color: var(--secondary-green); }

        .pay-btn {
            width: 100%; padding: 18px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            color: white; border: none; border-radius: 12px; font-size: 16px; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease; display: block; text-align: center; text-decoration: none; margin-top: 20px;
        }
        .pay-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(45, 106, 79, 0.4); color: white; }

        .security-badge-icon { font-size: 28px; }
        .security-badge-text { font-size: 11px; color: #999; text-align: center; }

        .help-section {
            background: linear-gradient(135deg, #f8fffe, #e8f5e9); padding: 25px;
            border-radius: 12px; margin-top: 20px; text-align: center;
        }
        .help-section h3 { color: var(--primary-green); font-size: 16px; margin-bottom: 10px; }
        .help-section p { color: #666; font-size: 14px; margin-bottom: 15px; }
        .help-btn {
            padding: 12px 30px; background: white; color: var(--secondary-green);
            border: 2px solid var(--accent-green); border-radius: 10px; font-size: 14px;
            font-weight: 600; cursor: pointer; transition: all 0.3s ease;
        }
        .help-btn:hover { background: var(--light-green); }

        .success-modal {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;
        }
        .success-content {
            background: white; border-radius: 24px; padding: 50px; text-align: center; max-width: 500px;
            animation: scaleIn 0.5s ease;
        }
        @keyframes scaleIn { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .success-icon {
            width: 100px; height: 100px;
            background: linear-gradient(135deg, var(--accent-green), var(--light-green));
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 50px; margin: 0 auto 25px;
        }
        .success-content h2 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 32px; margin-bottom: 15px; }
        .success-content p { color: #666; font-size: 16px; margin-bottom: 30px; }
        .success-btn {
            padding: 15px 40px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            color: white; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer;
        }
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
                    <div class="step completed d-flex align-items-center gap-2"><div class="step-number">2</div><div class="step-label">Pemesanan</div></div>
                    <div class="step active d-flex align-items-center gap-2"><div class="step-number">3</div><div class="step-label">Pembayaran</div></div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="row g-4">
            <!-- Left Section -->
            <div class="col-lg-8">
                <!-- Payment Methods -->
                <div class="section-card">
                    <div class="section-header">
                        <h2>Pilih Metode Pembayaran</h2>
                        <p>Pilih metode pembayaran yang paling nyaman untuk Anda</p>
                    </div>
                    <div class="mb-4 pb-3 border-bottom">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="ewallet" value="ewallet">
                            <label class="form-check-label" for="ewallet" style="font-size: 14px; font-weight: 600; color: var(--primary-green); cursor: pointer;">
                                E-Wallet
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod">
                            <label class="form-check-label" for="cod" style="font-size: 14px; font-weight: 600; color: var(--primary-green); cursor: pointer;">
                                CIP (Cash in Place)
                            </label>
                        </div>
                    </div>

                    <!-- VA Details -->
                    <div class="va-details">
                        <h3 style="color: var(--primary-green); font-size: 16px; margin-bottom: 15px;">📋 Detail Pembayaran</h3>
                        <div class="va-number">
                            <div>
                                <div style="color: #999; font-size: 12px; margin-bottom: 5px;">Nomor Virtual Account</div>
                                <div class="va-number-text">8808 1234 5678 9012</div>
                            </div>
                            <button class="copy-btn">Salin</button>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <span style="color:#666; font-size:14px;">Total Pembayaran</span>
                            <span style="font-size:24px; font-weight:700; color:var(--secondary-green);"></span>
                        </div>
                    </div>

                </div>

                <!-- Order Items -->
                <div class="section-card">
                    <div class="section-header"><h2>Detail Pesanan</h2></div>
                    <div class="order-details-box">
                    </div>
                </div>
            </div>

            <!-- Right: Summary -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="summary-card">
                        <h2>Ringkasan Pembayaran</h2>
                        <!-- <div class="d-flex flex-column gap-3 mb-3 pb-3 border-bottom">
                            <div class="summary-item"><span class="summary-label">Subtotal Produk</span><span class="summary-value">Rp 95.750</span></div>
                            <div class="summary-item"><span class="summary-label">Biaya Pengiriman</span><span class="summary-value">Rp 15.000</span></div>
                            <div class="summary-item"><span class="summary-label">Diskon Voucher</span><span class="summary-value" style="color:#dc3545;">- Rp 10.000</span></div>
                            <div class="summary-item"><span class="summary-label">Biaya Admin</span><span class="summary-value">Gratis</span></div>
                       
                        <div class="summary-total"><span class="summary-total-label">Total Bayar</span><span class="summary-total-value">Rp 100.750</span></div>
                         </div> -->
                        <a href="detailpemesanan.php" class="pay-btn">Konfirmasi Pemesanan</a>
                    </div>

                    <div class="help-section">
                        <h3>Butuh Bantuan?</h3>
                        <p>Tim kami siap membantu Anda 24/7</p>
                        <button class="help-btn">Hubungi Customer Service</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="success-modal" id="successModal">
        <div class="success-content">
            <div class="success-icon">✓</div>
            <h2>Pembayaran Berhasil!</h2>
            <p>Terima kasih atas pembayaran Anda. Pesanan sedang diproses dan akan segera dikirim.</p>
            <button class="success-btn" onclick="window.location.href='/'">Kembali ke Beranda</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('.copy-btn').addEventListener('click', function() {
            const vaNumber = '8808123456789012';
            navigator.clipboard.writeText(vaNumber);
            this.textContent = '✓ Tersalin';
            setTimeout(() => { this.textContent = '📋 Salin'; }, 2000);
        });
    </script>
</body>
</html>
