<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Marcydap Apotek</title>
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

        .hero-about {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            padding: 80px 0; text-align: center; color: white; position: relative; overflow: hidden;
        }
        .hero-about::before {
            content: ''; position: absolute; top: -50%; right: -50%; width: 100%; height: 200%;
            background: radial-gradient(circle, rgba(82, 183, 136, 0.1) 0%, transparent 60%);
        }
        .hero-about h1 { font-family: 'Playfair Display', serif; font-size: 48px; margin-bottom: 15px; }
        .hero-about p { font-size: 18px; opacity: 0.9; }

        .section-title { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 36px; margin-bottom: 15px; }
        .section-subtitle { color: #666; font-size: 16px; }

        .story-section { padding: 80px 0; }
        .story-image {
            width: 100%; height: 400px;
            background: linear-gradient(135deg, var(--light-green), var(--accent-green));
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            font-size: 80px;
        }
        .story-text p { color: #555; line-height: 1.8; font-size: 16px; }

        .mission-card {
            background: white; border-radius: 20px; padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); height: 100%;
            border-left: 5px solid var(--accent-green);
        }
        .mission-card h3 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 24px; margin-bottom: 15px; }
        .mission-card p { color: #555; line-height: 1.8; }

        .values-section { padding: 80px 0; background: white; }
        .value-card {
            background: var(--bg-cream); border-radius: 20px; padding: 35px; text-align: center;
            transition: all 0.4s ease; height: 100%;
        }
        .value-card:hover { transform: translateY(-8px); box-shadow: 0 12px 40px rgba(26, 71, 42, 0.15); }
        .value-icon {
            width: 80px; height: 80px; margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 36px;
        }
        .value-card h4 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 20px; margin-bottom: 12px; }
        .value-card p { color: #555; font-size: 14px; line-height: 1.7; }

        .timeline-section { padding: 80px 0; }
        .timeline { position: relative; padding-left: 40px; }
        .timeline::before { content: ''; position: absolute; left: 15px; top: 0; bottom: 0; width: 3px; background: linear-gradient(180deg, var(--accent-green), var(--light-green)); }
        .timeline-item { position: relative; margin-bottom: 40px; }
        .timeline-dot {
            position: absolute; left: -33px; top: 5px; width: 20px; height: 20px;
            background: var(--accent-green); border-radius: 50%; border: 4px solid white;
            box-shadow: 0 2px 8px rgba(82, 183, 136, 0.4);
        }
        .timeline-year { font-family: 'Playfair Display', serif; color: var(--secondary-green); font-size: 20px; font-weight: 700; margin-bottom: 5px; }
        .timeline-desc { color: #555; font-size: 15px; line-height: 1.6; }

        .team-section { padding: 80px 0; background: white; }
        .team-card {
            background: var(--bg-cream); border-radius: 20px; overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.4s ease; height: 100%;
        }
        .team-card:hover { transform: translateY(-8px); box-shadow: 0 12px 40px rgba(26, 71, 42, 0.15); }
        .team-avatar {
            width: 100%; height: 260px;
            background: linear-gradient(135deg, var(--light-green), var(--accent-green));
            display: flex; align-items: center; justify-content: center; font-size: 60px;
        }
        .team-info { padding: 25px; text-align: center; }
        .team-info h4 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 20px; margin-bottom: 5px; }
        .team-info .role { color: var(--accent-green); font-size: 14px; font-weight: 600; margin-bottom: 10px; }
        .team-info p { color: #666; font-size: 13px; line-height: 1.6; }

        .cta-section {
            padding: 80px 0; text-align: center;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            color: white;
        }
        .cta-section h2 { font-family: 'Playfair Display', serif; font-size: 36px; margin-bottom: 15px; }
        .cta-btn {
            display: inline-block; padding: 16px 40px; background: white;
            color: var(--primary-green); border-radius: 30px; font-weight: 700; font-size: 16px;
            text-decoration: none; transition: all 0.3s ease;
        }
        .cta-btn:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.2); color: var(--primary-green); }

        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.8s ease forwards; }

        .footer {
            background: #0a1f1a;
            color: white;
            padding: 80px 0 40px;
        }

        .footer-brand h3 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 20px;
        }

        .footer-brand p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .footer-section h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #b7e4c7;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
        }
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
                        <li class="nav-item"><a class="nav-link nav-link-custom active" href="tentangkami.php">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="hubungikami.php">Kontak</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero-about">
        <div class="container position-relative">
            <h1 class="fade-in">Tentang Kami</h1>
            <p class="fade-in">Mengenal lebih dekat Marcydap Apotek, mitra kesehatan terpercaya Anda.</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="story-image">🏥</div>
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">Cerita Kami</h2>
                    <div class="story-text">
                        <p>Marcydap Apotek berdiri sejak tahun 2010 dengan satu tujuan sederhana: menyediakan obat-obatan berkualitas dengan harga yang terjangkau untuk semua kalangan masyarakat.</p>
                        <p>Berawal dari sebuah apotek kecil di sudut kota, kami terus berkembang menjadi jaringan apotek modern yang mengutamakan kualitas pelayanan dan keamanan produk. Setiap langkah kami didasari oleh komitmen untuk memberikan yang terbaik bagi kesehatan masyarakat Indonesia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="mission-card">
                        <h3>🎯 Misi Kami</h3>
                        <p>Menyediakan produk farmasi berkualitas tinggi yang aman, efektif, dan terjangkau. Memberikan pelayanan kesehatan yang profesional dengan pendekatan yang ramah dan personal kepada setiap pelanggan.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mission-card">
                        <h3>🌟 Visi Kami</h3>
                        <p>Menjadi apotek digital terdepan di Indonesia yang memudahkan akses masyarakat terhadap produk kesehatan berkualitas, dengan memanfaatkan teknologi untuk memberikan pengalaman pelayanan kesehatan yang lebih baik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="values-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Nilai-Nilai Kami</h2>
                <p class="section-subtitle">Prinsip yang menjadi landasan setiap langkah kami</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">🤝</div>
                        <h4>Integritas</h4>
                        <p>Menjunjung tinggi kejujuran dan transparansi dalam setiap layanan yang kami berikan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">✅</div>
                        <h4>Kualitas</h4>
                        <p>Hanya menyediakan produk berkualitas tinggi dari distributor resmi dan terpercaya.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">❤️</div>
                        <h4>Kepedulian</h4>
                        <p>Memberikan pelayanan dengan hati, memahami kebutuhan kesehatan setiap pelanggan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">💡</div>
                        <h4>Inovasi</h4>
                        <p>Terus berinovasi dalam teknologi dan pelayanan untuk kemudahan akses kesehatan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline -->
    <section class="timeline-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Perjalanan Kami</h2>
                <p class="section-subtitle">Milestone penting dalam sejarah Marcydap Apotek</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="timeline">
                        <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-year">2010</div><div class="timeline-desc">Marcydap Apotek didirikan sebagai apotek konvensional pertama di pusat kota, melayani kebutuhan obat-obatan masyarakat sekitar.</div></div>
                        <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-year">2015</div><div class="timeline-desc">Membuka cabang kedua dan memulai digitalisasi sistem inventori untuk pelayanan yang lebih efisien.</div></div>
                        <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-year">2019</div><div class="timeline-desc">Meluncurkan platform online untuk pemesanan obat, memperluas jangkauan pelayanan ke seluruh kota.</div></div>
                        <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-year">2022</div><div class="timeline-desc">Mendapatkan sertifikasi ISO dan penghargaan sebagai Apotek Digital Terbaik tingkat nasional.</div></div>
                        <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-year">2024</div><div class="timeline-desc">Terus berinovasi dengan fitur konsultasi online dan pengiriman obat yang lebih cepat ke seluruh Indonesia.</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <h2>Ingin Mengenal Kami Lebih Dekat?</h2>
            <p class="mb-4" style="opacity:0.9;">Hubungi kami untuk informasi lebih lanjut tentang layanan dan produk kami.</p>
            <a href="hubungikami.php" class="cta-btn">Hubungi Kami →</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-5"><div class="footer-brand"><h3>MARCYDAP</h3><p>Platform kesehatan terpercaya yang menghubungkan Anda dengan produk berkualitas dan layanan profesional.</p></div></div>
                <div class="col-lg-2"><div class="footer-section"><h4>Layanan</h4><ul class="footer-links"><li><a href="#">Belanja Online</a></li><li><a href="#">Upload Resep</a></li></ul></div></div>
                <div class="col-lg-2"><div class="footer-section"><h4>Perusahaan</h4><ul class="footer-links"><li><a href="tentangkami.php">Tentang Kami</a></li></ul></div></div>
                <div class="col-lg-3"><div class="footer-section"><h4>Bantuan</h4><ul class="footer-links"><li><a href="#">FAQ</a></li><li><a href="hubungikami.php">Hubungi Kami</a></li><li><a href="#">Syarat & Ketentuan</a></li><li><a href="#">Kebijakan Privasi</a></li><li><a href="#">Cara Pemesanan</a></li></ul></div></div>
            </div>
            <div class="footer-bottom"><p>© 2024 Marcydap. All rights reserved. Made with in Indonesia</p></div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
