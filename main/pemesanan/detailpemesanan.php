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

        .back-btn {
            display: flex; align-items: center; gap: 8px; padding: 10px 20px; background: white;
            border: 2px solid var(--accent-green); color: var(--secondary-green); border-radius: 10px;
            font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;
        }
        .back-btn:hover { background: var(--light-green); color: var(--secondary-green); }

        .status-banner {
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            border-radius: 20px; padding: 40px 50px; position: relative; overflow: hidden; color: white;
        }
        .status-banner::before {
            content: ''; position: absolute; width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            top: -200px; right: -100px;
        }
        .status-info h1 { font-family: 'Playfair Display', serif; font-size: 36px; margin-bottom: 10px; }
        .meta-label { color: rgba(255,255,255,0.8); font-size: 13px; }
        .meta-value { color: white; font-size: 16px; font-weight: 600; }
        .status-badge {
            background: rgba(33, 150, 243, 0.9); color: white; padding: 15px 30px;
            border-radius: 50px; font-size: 16px; font-weight: 600; border: 2px solid rgba(255,255,255,0.3);
        }

        .section-card {
            background: white; border-radius: 16px; padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); margin-bottom: 25px;
        }
        .section-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0;
        }
        .section-header h2 { font-size: 20px; color: var(--primary-green); margin: 0; }

        .tracking-timeline { position: relative; padding-left: 40px; }
        .timeline-line { position: absolute; left: 17px; top: 20px; bottom: 20px; width: 3px; background: #e8f5e9; }
        .timeline-item { position: relative; padding: 20px 0; }
        .timeline-dot {
            position: absolute; left: -40px; top: 24px; width: 38px; height: 38px;
            background: white; border: 4px solid #e8f5e9; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 16px; z-index: 2;
        }
        .timeline-item.completed .timeline-dot { background: var(--accent-green); border-color: var(--accent-green); }
        .timeline-item.active .timeline-dot { border-color: var(--accent-green); background: white; animation: pulse-ring 2s infinite; }
        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 0 0 0 rgba(82, 183, 136, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(82, 183, 136, 0); }
        }
        .timeline-content h3 { color: var(--primary-green); font-size: 16px; margin-bottom: 5px; }
        .timeline-date { color: #999; font-size: 13px; margin-bottom: 8px; }
        .timeline-desc { color: #666; font-size: 14px; line-height: 1.6; }

        .order-item {
            display: flex; gap: 20px; padding: 20px; background: #f8f9fa; border-radius: 12px;
        }
        .item-image {
            width: 80px; height: 80px; background: linear-gradient(135deg, #f0f0f0, #e8f5e9);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            font-size: 36px; flex-shrink: 0;
        }
        .item-category { color: var(--accent-green); font-size: 11px; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .item-name { font-weight: 600; color: var(--primary-green); font-size: 16px; margin-bottom: 8px; }
        .item-meta { font-size: 13px; color: #666; }
        .item-qty { color: #999; font-size: 13px; }
        .item-price { font-size: 18px; font-weight: 700; color: var(--secondary-green); }

        .info-block h3 { color: var(--primary-green); font-size: 16px; margin-bottom: 15px; }
        .info-block p { color: #555; font-size: 14px; line-height: 1.7; }
        .info-block strong { color: var(--primary-green); display: block; margin-bottom: 5px; }

        .payment-card {
            background: #f8fffe; padding: 20px; border-radius: 12px;
            border-left: 4px solid var(--accent-green);
        }
        .payment-logo {
            width: 60px; height: 40px; background: white; border-radius: 8px;
            display: flex; align-items: center; justify-content: center; font-size: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .payment-status {
            display: inline-flex; align-items: center; gap: 6px; background: #d4edda;
            color: #155724; padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600;
        }

        .sidebar-card {
            background: white; border-radius: 16px; padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); margin-bottom: 25px;
        }
        .sidebar-card h3 { font-size: 18px; color: var(--primary-green); margin-bottom: 20px; }

        .summary-item { display: flex; justify-content: space-between; align-items: center; }
        .summary-label { color: #666; font-size: 14px; }
        .summary-value { font-weight: 600; color: var(--text-dark); font-size: 15px; }
        .summary-value.discount { color: #dc3545; }
        .summary-total { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-top: 2px solid #f0f0f0; }
        .summary-total-label { font-size: 16px; font-weight: 600; color: var(--primary-green); }
        .summary-total-value { font-size: 24px; font-weight: 700; color: var(--secondary-green); }

        .action-btn {
            width: 100%; padding: 14px 20px; border-radius: 10px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center;
            justify-content: center; gap: 8px; border: none;
        }
        .action-btn-primary {
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green)); color: white;
        }
        .action-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(45, 106, 79, 0.3); }
        .action-btn-secondary { background: white; color: var(--secondary-green); border: 2px solid var(--accent-green) !important; }
        .action-btn-secondary:hover { background: var(--light-green); }
        .action-btn-outline { background: transparent; color: #dc3545; border: 2px solid #dc3545 !important; }
        .action-btn-outline:hover { background: #ffe8ea; }

        .invoice-card { background: white; border: 2px dashed var(--accent-green); }
        .help-card { background: linear-gradient(135deg, #f8fffe, #e8f5e9); text-align: center; }
        .help-card h3 { color: var(--primary-green); margin-bottom: 10px; }
        .help-card p { color: #666; font-size: 13px; margin-bottom: 15px; }
        .contact-item {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            background: white; padding: 12px; border-radius: 10px; font-size: 14px;
            color: var(--secondary-green); text-decoration: none; transition: all 0.3s ease;
        }
        .contact-item:hover { background: var(--light-green); color: var(--secondary-green); }
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
                <a href="#" class="back-btn">← Kembali ke Pesanan</a>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <!-- Status Banner -->
        <div class="status-banner mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-4 position-relative" style="z-index:1;">
                <div class="status-info">
                    <h1>Pesanan Sedang disiapkan</h1>
                    <div class="d-flex gap-4 flex-wrap">
                        <div><span class="meta-label d-block">No. Pesanan</span><span class="meta-value">-</span></div>
                        <div><span class="meta-label d-block">Tanggal Pesan</span><span class="meta-value">8 Februari 2024</span></div>
                    </div>
                </div>
                <div class="status-badge">Dalam Pemrosesan</div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Section -->
            <div class="col-lg-8">
                <!-- Tracking Timeline -->
                <div class="section-card">
                    <div class="section-header"><h2>Lacak Pesanan</h2></div>
                    <div class="tracking-timeline">
                        <div class="timeline-line"></div>
                        <div class="timeline-item completed">
                            <div class="timeline-dot">✓</div>
                            <div class="timeline-content">
                                <h3>Pesanan Dikonfirmasi</h3>
                                <div class="timeline-date">8 Feb 2024, 14:30 WIB</div>
                                <div class="timeline-desc">Pesanan Anda telah dikonfirmasi dan sedang diproses oleh apotek kami.</div>
                            </div>
                        </div>
                        <div class="timeline-item active">
                            <div class="timeline-dot">✓</div>
                            <div class="timeline-content">
                                <h3>Pesanan Diproses</h3>
                                <div class="timeline-date">8 Feb 2024, 15:45 WIB</div>
                                <div class="timeline-desc">Produk sedang disiapkan dan dikemas dengan hati-hati oleh tim kami.</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-dot">✓</div>
                            <div class="timeline-content">
                                <h3>Pesanan Diterima</h3>
                                <div class="timeline-date">8 Feb 2024, 18:20 WIB</div>
                                <div class="timeline-desc">Paket sedang menunggu penerima</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="section-card">
                    <div class="section-header"><h2>Produk yang Dipesan (3 item)</h2></div>
                    <!-- <div class="d-flex flex-column gap-3">
                        <div class="order-item">
                            <div class="item-image">💊</div>
                            <div class="flex-grow-1">
                                <div class="item-category">Obat Bebas</div>
                                <div class="item-name">Paracetamol 500mg</div>
                                <div class="item-meta d-flex gap-3"><span>📦 Strip 10 tablet</span><span>⭐ 4.8 (234 review)</span></div>
                            </div>
                            <div class="text-end"><div class="item-qty">Qty: 2</div><div class="item-price">Rp 22.500</div></div>
                        </div>
                        <div class="order-item">
                            <div class="item-image">💊</div>
                            <div class="flex-grow-1">
                                <div class="item-category">Vitamin</div>
                                <div class="item-name">Vitamin C 1000mg Effervescent</div>
                                <div class="item-meta d-flex gap-3"><span>📦 Tube 10 tablet</span><span>⭐ 4.9 (567 review)</span></div>
                            </div>
                            <div class="text-end"><div class="item-qty">Qty: 1</div><div class="item-price">Rp 35.000</div></div>
                        </div>
                        <div class="order-item">
                            <div class="item-image">💊</div>
                            <div class="flex-grow-1">
                                <div class="item-category">Alat Kesehatan</div>
                                <div class="item-name">Masker Medis 3 Ply Earloop</div>
                                <div class="item-meta d-flex gap-3"><span>📦 Box 50 pcs</span><span>⭐ 4.6 (1.2k review)</span></div>
                            </div>
                            <div class="text-end"><div class="item-qty">Qty: 1</div><div class="item-price">Rp 38.250</div></div>
                        </div>
                    </div> -->
                </div>

                <!-- Shipping & Payment Info -->
                <div class="section-card">
                    <div class="section-header"><h2>Informasi Pemesanan</h2></div>
                    <!-- <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="info-block">
                                <h3>Informasi Penerima</h3>
                                <p><strong>Sarah Wijaya</strong>+62 812-3456-7890<br><br>Jl. Kemang Raya No. 45, RT 001/RW 005<br>Bangka, Mampang Prapatan<br>Jakarta Selatan, DKI Jakarta 12730</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <h3>Alamat Apotek Pengambilan</h3>
                                <p><strong>Apotek Marcydap Kemang</strong>Jl. Kemang Raya No. 45, RT 001/RW 005<br><br>Bangka, Mampang Prapatan<br>Jakarta Selatan, DKI Jakarta 12730</p>
                            </div>
                        </div>
                    </div> 
                    <div class="payment-card">
                        <h3 style="color: var(--primary-green); font-size: 16px; margin-bottom: 15px;">💳 Metode Pembayaran</h3>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="payment-logo"></div>
                            <div class="flex-grow-1">
                                <h4 style="color: var(--primary-green); font-size: 15px; margin-bottom: 4px;">BCA Virtual Account</h4>
                                <p style="color: #666; font-size: 13px; margin: 0;">8808 1234 5678 9012</p>
                            </div>
                            <div class="payment-status">✓ Lunas</div>
                        </div>
                        <div class="d-flex justify-content-between pt-3 border-top">
                            <span style="color: #666; font-size: 14px;">Dibayar pada</span>
                            <span style="color: var(--primary-green); font-weight: 600; font-size: 14px;">8 Feb 2024, 14:25 WIB</span>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Order Summary -->
                <div class="sidebar-card">
                    <h3>Ringkasan Pembayaran</h3>
                    <div class="d-flex flex-column gap-3 mb-3 pb-3 border-bottom">
                        <div class="summary-item"><span class="summary-label">Subtotal (3 item)</span><span class="summary-value">Rp 95.750</span></div>
                        <div class="summary-item"><span class="summary-label">Biaya Pengiriman</span><span class="summary-value">Rp 15.000</span></div>
                        <div class="summary-item"><span class="summary-label">Diskon Voucher</span><span class="summary-value discount">- Rp 10.000</span></div>
                    </div>
                    <div class="summary-total"><span class="summary-total-label">Total</span><span class="summary-total-value">Rp 100.750</span></div>
                </div>

                <!-- Quick Actions -->
                <div class="sidebar-card">
                    <h3>Aksi Cepat</h3>
                    <div class="d-flex flex-column gap-3">
                        <button class="action-btn action-btn-secondary">Chat Customer Service</button>
                        <button class="action-btn action-btn-secondary">Tulis Review</button>
                        <button class="action-btn action-btn-outline">Batalkan Pesanan</button>
                    </div>
                </div>

                <!-- Invoice -->
                <div class="sidebar-card invoice-card text-center">
                    <h3>Invoice</h3>
                    <p style="color: #666; font-size: 13px; margin-bottom: 15px;">Download invoice untuk laporan keuangan Anda</p>
                    <button class="action-btn action-btn-primary">Download Invoice (PDF)</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
