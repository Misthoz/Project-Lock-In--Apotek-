<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Pelanggan - Marcydap Apotek</title>
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
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            position: relative;
        }
        .logo-icon::before, .logo-icon::after { content: ''; position: absolute; background: white; }
        .logo-icon::before { width: 5px; height: 20px; }
        .logo-icon::after { width: 20px; height: 5px; }
        .logo-text h1 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 24px; margin: 0; }
        .logo-text p { color: var(--accent-green); font-size: 10px; letter-spacing: 2px; text-transform: uppercase; margin: 0; }
        .nav-link-custom { color: var(--text-dark) !important; font-weight: 500; transition: color 0.3s ease; }
        .nav-link-custom:hover, .nav-link-custom.active { color: var(--secondary-green) !important; }

        .hero-review {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            padding: 80px 0; text-align: center; color: white; position: relative; overflow: hidden;
        }
        .hero-review::before {
            content: ''; position: absolute; top: -50%; right: -50%; width: 100%; height: 200%;
            background: radial-gradient(circle, rgba(82, 183, 136, 0.1) 0%, transparent 60%);
        }
        .hero-review h1 { font-family: 'Playfair Display', serif; font-size: 48px; margin-bottom: 15px; }
        .hero-review p { font-size: 18px; opacity: 0.9; }

        .section-title { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 36px; margin-bottom: 15px; }
        .section-subtitle { color: #666; font-size: 16px; }

        .rating-summary {
            background: white; border-radius: 20px; padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .rating-big { font-size: 64px; font-weight: 700; color: var(--primary-green); line-height: 1; }
        .rating-stars-big { font-size: 24px; color: #ffa500; }
        .rating-bar-row { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
        .rating-bar-label { font-size: 14px; color: #666; min-width: 60px; }
        .rating-bar { flex: 1; height: 8px; background: #e8f5e9; border-radius: 4px; overflow: hidden; }
        .rating-bar-fill { height: 100%; background: linear-gradient(90deg, var(--accent-green), var(--light-green)); border-radius: 4px; }
        .rating-bar-count { font-size: 13px; color: #999; min-width: 35px; text-align: right; }

        .stats-grid .stat-card {
            background: white; border-radius: 16px; padding: 25px; text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); height: 100%;
        }
        .stat-number { font-size: 28px; font-weight: 700; color: var(--secondary-green); }
        .stat-label { font-size: 13px; color: #666; }

        .filter-tabs { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 25px; }
        .filter-tab {
            padding: 10px 20px; border: 2px solid #e8f5e9; background: white; color: #555;
            border-radius: 25px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;
        }
        .filter-tab:hover, .filter-tab.active { background: var(--accent-green); color: white; border-color: var(--accent-green); }
        .sort-select {
            padding: 10px 18px; border: 2px solid #e8f5e9; border-radius: 12px;
            font-family: 'DM Sans', sans-serif; font-size: 14px; background: white;
        }
        .sort-select:focus { outline: none; border-color: var(--accent-green); }

        .review-card {
            background: white; border-radius: 20px; padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .review-card:hover { box-shadow: 0 8px 30px rgba(26, 71, 42, 0.12); }
        .reviewer-avatar {
            width: 50px; height: 50px;
            background: linear-gradient(135deg, var(--light-green), var(--accent-green));
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .reviewer-name { font-weight: 600; color: var(--primary-green); font-size: 16px; }
        .reviewer-badge {
            display: inline-block; padding: 3px 10px;
            background: #e8f5e9; color: var(--secondary-green); border-radius: 12px;
            font-size: 11px; font-weight: 600;
        }
        .review-date { font-size: 13px; color: #999; }
        .review-stars { color: #ffa500; font-size: 16px; }
        .review-product {
            display: inline-block; padding: 6px 14px; background: var(--bg-cream);
            border-radius: 10px; font-size: 13px; color: #555; margin: 10px 0;
        }
        .review-text { color: #444; line-height: 1.7; font-size: 15px; }
        .review-images { display: flex; gap: 10px; margin-top: 15px; }
        .review-img {
            width: 80px; height: 80px; background: linear-gradient(135deg, #f0f0f0, #e8e8e8);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            font-size: 24px; cursor: pointer;
        }
        .review-actions { display: flex; gap: 20px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #f0f0f0; }
        .helpful-btn {
            display: flex; align-items: center; gap: 6px; padding: 6px 14px;
            border: 1px solid #e0e0e0; background: white; border-radius: 20px;
            font-size: 13px; color: #666; cursor: pointer; transition: all 0.3s ease;
        }
        .helpful-btn:hover { border-color: var(--accent-green); color: var(--secondary-green); }
        .reply-card {
            background: #f8fdf9; border-left: 3px solid var(--accent-green);
            border-radius: 0 12px 12px 0; padding: 15px 20px; margin-top: 15px;
        }
        .reply-name { font-weight: 600; color: var(--secondary-green); font-size: 14px; }
        .reply-text { color: #555; font-size: 14px; line-height: 1.6; margin-top: 5px; }

        .page-btn {
            width: 40px; height: 40px; border: 2px solid #e8f5e9; background: white;
            color: var(--text-dark); border-radius: 10px; cursor: pointer; font-size: 14px; font-weight: 600;
            transition: all 0.3s ease;
        }
        .page-btn:hover, .page-btn.active { background: var(--accent-green); color: white; border-color: var(--accent-green); }

        .cta-review {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border-radius: 20px; padding: 50px; text-align: center; color: white;
        }
        .cta-review h3 { font-family: 'Playfair Display', serif; font-size: 28px; margin-bottom: 10px; }
        .cta-review-btn {
            display: inline-block; padding: 14px 35px; background: white;
            color: var(--primary-green); border-radius: 25px; font-weight: 700;
            text-decoration: none; transition: all 0.3s ease; margin-top: 15px;
        }
        .cta-review-btn:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.2); color: var(--primary-green); }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.8s ease forwards; }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <a href="dashboard.php" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="logo-icon"></div>
                    <div class="logo-text"><h1>MARCYDAP</h1><p>APOTEK</p></div>
                </a>
                <nav class="d-none d-lg-block">
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="dashboard.php">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="produk.php">Produk</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="tentangkami.php">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="hubungikami.php">Kontak</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero-review">
        <div class="container position-relative">
            <h1 class="fade-in">Review Pelanggan</h1>
            <p class="fade-in">Apa kata mereka tentang pengalaman bersama Marcydap Apotek</p>
        </div>
    </section>

    <!-- Rating Summary & Stats -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="rating-summary">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <div class="rating-big">4.8</div>
                                <div class="rating-stars-big mt-2">⭐⭐⭐⭐⭐</div>
                                <p class="text-muted mt-1 mb-0">dari 2.847 ulasan</p>
                            </div>
                            <div class="col-md-8">
                                <div class="rating-bar-row"><span class="rating-bar-label">5 Bintang</span><div class="rating-bar"><div class="rating-bar-fill" style="width: 75%"></div></div><span class="rating-bar-count">2.135</span></div>
                                <div class="rating-bar-row"><span class="rating-bar-label">4 Bintang</span><div class="rating-bar"><div class="rating-bar-fill" style="width: 18%"></div></div><span class="rating-bar-count">512</span></div>
                                <div class="rating-bar-row"><span class="rating-bar-label">3 Bintang</span><div class="rating-bar"><div class="rating-bar-fill" style="width: 5%"></div></div><span class="rating-bar-count">142</span></div>
                                <div class="rating-bar-row"><span class="rating-bar-label">2 Bintang</span><div class="rating-bar"><div class="rating-bar-fill" style="width: 1.5%"></div></div><span class="rating-bar-count">40</span></div>
                                <div class="rating-bar-row"><span class="rating-bar-label">1 Bintang</span><div class="rating-bar"><div class="rating-bar-fill" style="width: 0.6%"></div></div><span class="rating-bar-count">18</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stats-grid">
                        <div class="row g-3">
                            <div class="col-6"><div class="stat-card"><div class="stat-number">98%</div><div class="stat-label">Pelanggan Puas</div></div></div>
                            <div class="col-6"><div class="stat-card"><div class="stat-number">85%</div><div class="stat-label">Repeat Order</div></div></div>
                            <div class="col-6"><div class="stat-card"><div class="stat-number">2.8K+</div><div class="stat-label">Total Ulasan</div></div></div>
                            <div class="col-6"><div class="stat-card"><div class="stat-number">4.8</div><div class="stat-label">Rating Rata-rata</div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter & Reviews -->
    <section class="pb-5">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                <div class="filter-tabs">
                    <button class="filter-tab active">Semua</button>
                    <button class="filter-tab">5 Bintang</button>
                    <button class="filter-tab">4 Bintang</button>
                    <button class="filter-tab">Dengan Foto</button>
                    <button class="filter-tab">Terverifikasi</button>
                </div>
                <select class="sort-select">
                    <option>Terbaru</option>
                    <option>Rating Tertinggi</option>
                    <option>Rating Terendah</option>
                    <option>Paling Membantu</option>
                </select>
            </div>

            <!-- Review 1 -->
            <div class="review-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="reviewer-avatar">👩</div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                            <div><span class="reviewer-name">Siti Nurhaliza</span> <span class="reviewer-badge">✓ Terverifikasi</span></div>
                            <span class="review-date">2 hari yang lalu</span>
                        </div>
                        <div class="review-stars mb-1">⭐⭐⭐⭐⭐</div>
                        <div class="review-product">📦 Paracetamol 500mg · Vitamin C 1000mg</div>
                        <p class="review-text">Pelayanan yang sangat cepat dan ramah! Obat dikirim dengan packaging yang aman dan rapi. Harga juga lebih murah dibanding apotek lain. Pasti akan order lagi di sini. Terima kasih Marcydap!</p>
                        <div class="review-images">
                            <div class="review-img">📷</div>
                            <div class="review-img">📷</div>
                        </div>
                        <div class="review-actions">
                            <button class="helpful-btn">👍 Membantu (24)</button>
                            <button class="helpful-btn">💬 Balas</button>
                        </div>
                        <div class="reply-card">
                            <div class="reply-name">Marcydap Apotek</div>
                            <div class="reply-text">Terima kasih atas ulasannya, Kak Siti! 😊 Kami senang bisa melayani dengan baik. Jangan ragu hubungi kami jika butuh bantuan lagi ya!</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="review-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="reviewer-avatar">👨</div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                            <div><span class="reviewer-name">Budi Hartono</span> <span class="reviewer-badge">✓ Terverifikasi</span></div>
                            <span class="review-date">5 hari yang lalu</span>
                        </div>
                        <div class="review-stars mb-1">⭐⭐⭐⭐⭐</div>
                        <div class="review-product">📦 Madu Murni Premium</div>
                        <p class="review-text">Madu premium yang benar-benar asli! Kualitasnya jauh berbeda dengan yang saya beli di tempat lain. Pengiriman cepat, sampai dalam 1 hari saja. Sangat merekomendasikan.</p>
                        <div class="review-actions">
                            <button class="helpful-btn">👍 Membantu (18)</button>
                            <button class="helpful-btn">💬 Balas</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="review-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="reviewer-avatar">👩</div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                            <div><span class="reviewer-name">Rina Wulandari</span> <span class="reviewer-badge">✓ Terverifikasi</span></div>
                            <span class="review-date">1 minggu yang lalu</span>
                        </div>
                        <div class="review-stars mb-1">⭐⭐⭐⭐</div>
                        <div class="review-product">📦 Multivitamin Daily Formula</div>
                        <p class="review-text">Produknya bagus dan kualitas terjamin. Satu-satunya hal yang bisa diperbaiki adalah waktu respons customer service yang kadang agak lama di jam sibuk. Tapi secara keseluruhan pengalaman belanja di sini sangat menyenangkan.</p>
                        <div class="review-images">
                            <div class="review-img">📷</div>
                        </div>
                        <div class="review-actions">
                            <button class="helpful-btn">👍 Membantu (12)</button>
                            <button class="helpful-btn">💬 Balas</button>
                        </div>
                        <div class="reply-card">
                            <div class="reply-name">Marcydap Apotek</div>
                            <div class="reply-text">Terima kasih atas masukannya, Kak Rina! Kami akan terus meningkatkan kecepatan respons customer service kami. Semoga pengalaman berikutnya lebih baik lagi ya! 🙏</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 4 -->
            <div class="review-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="reviewer-avatar">👨</div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                            <div><span class="reviewer-name">Ahmad Fauzi</span></div>
                            <span class="review-date">2 minggu yang lalu</span>
                        </div>
                        <div class="review-stars mb-1">⭐⭐⭐⭐⭐</div>
                        <div class="review-product">📦 Termometer Digital Infrared</div>
                        <p class="review-text">Termometernya akurat dan mudah digunakan. Cocok untuk keluarga yang butuh alat kesehatan di rumah. Saya sudah membandingkan hasilnya dengan termometer di klinik dan hasilnya sangat mendekati. Worth the price!</p>
                        <div class="review-actions">
                            <button class="helpful-btn">👍 Membantu (9)</button>
                            <button class="helpful-btn">💬 Balas</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review 5 -->
            <div class="review-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="reviewer-avatar">👩</div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                            <div><span class="reviewer-name">Maya Putri</span> <span class="reviewer-badge">✓ Terverifikasi</span></div>
                            <span class="review-date">2 minggu yang lalu</span>
                        </div>
                        <div class="review-stars mb-1">⭐⭐⭐⭐⭐</div>
                        <div class="review-product">📦 Obat Batuk Herbal Sirup · Masker Medis</div>
                        <p class="review-text">Obat batuk herbalnya ampuh sekali! Anak saya yang biasanya susah minum obat ternyata suka dengan rasa obat ini. Maskernya juga nyaman dipakai dan tidak bikin sesak. Packaging pengiriman rapi banget, semua produk dibungkus bubble wrap.</p>
                        <div class="review-images">
                            <div class="review-img">📷</div>
                            <div class="review-img">📷</div>
                            <div class="review-img">📷</div>
                        </div>
                        <div class="review-actions">
                            <button class="helpful-btn">👍 Membantu (31)</button>
                            <button class="helpful-btn">💬 Balas</button>
                        </div>
                        <div class="reply-card">
                            <div class="reply-name">Marcydap Apotek</div>
                            <div class="reply-text">Senang sekali mendengarnya, Kak Maya! 😊 Kami selalu berusaha memberikan yang terbaik untuk keluarga Indonesia. Terima kasih sudah mempercayakan kebutuhan kesehatan keluarga kepada kami!</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center gap-2 mt-4">
                <button class="page-btn">←</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">→</button>
            </div>
        </div>
    </section>

    <!-- Write Review CTA -->
    <section class="py-5">
        <div class="container">
            <div class="cta-review">
                <h3>Punya Pengalaman Bersama Kami?</h3>
                <p style="opacity:0.9;">Bagikan pengalaman Anda dan bantu pelanggan lain membuat keputusan terbaik.</p>
                <a href="#" class="cta-review-btn">✍️ Tulis Review</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });
    </script>
</body>
</html>
