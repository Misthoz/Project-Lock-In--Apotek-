<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCYDAP - Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background-color: #f5f5f5;
        }

        /* Navigation */
        .navbar-custom {
            background-color: #2d4a44;
            padding: 15px 40px;
        }

        .navbar-container {
            display: flex;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
        }

        .navbar-logo {
            width: 50px;
            height: 50px;
            background-color: #2d6e5d;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-logo i {
            font-size: 28px;
            color: white;
        }

        .navbar-brand-info {
            display: flex;
            flex-direction: column;
        }

        .navbar-brand-text {
            font-size: 20px;
            font-weight: 700;
            font-family: 'Georgia', serif;
            line-height: 1;
            margin-bottom: 2px;
        }

        .navbar-brand-tagline {
            font-size: 11px;
            font-family: 'Georgia', serif;
            opacity: 0.9;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 35px;
            margin-left: auto;
        }

        .nav-link-custom {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Georgia', serif;
            transition: opacity 0.3s;
        }

        .nav-link-custom:hover {
            opacity: 0.8;
            color: white;
        }

        .nav-link-custom i {
            font-size: 16px;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('hero-background.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 40px;
            color: white;
            text-align: left;
            min-height: 500px;
            display: flex;
            align-items: center;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero-title {
            font-size: 56px;
            font-weight: 400;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
            line-height: 1.2;
        }

        .hero-title .highlight {
            color: #5eb89a;
        }

        .hero-subtitle {
            font-size: 18px;
            margin-bottom: 25px;
            font-family: 'Georgia', serif;
        }

        .hero-subtitle .highlight {
            color: #5eb89a;
        }

        .hero-description {
            font-size: 16px;
            line-height: 1.8;
            font-family: 'Georgia', serif;
            max-width: 700px;
        }

        /* Services Section */
        .services-section {
            padding: 60px 30px;
            background-color: #f5f5f5;
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 400;
            margin-bottom: 10px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .section-subtitle {
            font-size: 14px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        .services-grid {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .service-card {
            background: white;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
        }

        .service-icon-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2d6e5d 0%, #5eb89a 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .service-icon {
            font-size: 36px;
            color: white;
        }

        .service-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .service-description {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
            font-family: 'Georgia', serif;
        }

        /* Footer */
        .footer {
            background-color: #2d4a44;
            color: white;
            padding: 50px 30px 20px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-brand h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            font-family: 'Georgia', serif;
        }

        .footer-brand p {
            font-size: 13px;
            line-height: 1.7;
            color: #ccc;
            font-family: 'Georgia', serif;
        }

        .footer-column h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            font-size: 13px;
            font-family: 'Georgia', serif;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
            font-family: 'Georgia', serif;
        }

        @media (max-width: 768px) {
            .navbar-custom {
                padding: 15px 20px;
            }

            .navbar-container {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-menu {
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
            }

            .hero-section {
                padding: 60px 30px;
                min-height: 400px;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .hero-description {
                font-size: 14px;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar-custom">
        <div class="navbar-container">
            <a href="#" class="navbar-brand-custom">
                <div class="navbar-logo">
                    <i class="bi bi-plus-lg"></i>
                </div>
                <div class="navbar-brand-info">
                    <span class="navbar-brand-text">MARCYDAP</span>
                    <span class="navbar-brand-tagline">Apotek Terpercaya</span>
                </div>
            </a>
            <div class="navbar-menu">
                <a href="katalog.php" class="nav-link-custom">
                    <i class="bi bi-bookmark"></i>
                    Katalog Produk
                </a>
                <a href="lokasi.php" class="nav-link-custom">
                    <i class="bi bi-geo-alt"></i>
                    Lokasi Kami
                </a>
                <a href="tentang.php" class="nav-link-custom">
                    <i class="bi bi-info-circle"></i>
                    Tentang Kami
                </a>
                <a href="contact.php" class="nav-link-custom">
                    <i class="bi bi-telephone"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Tentang <span class="highlight">Marcydap</span></h1>
            <p class="hero-subtitle">Marcydap : <span class="highlight">Solusi</span> Cerdas, Hidup Sehat</p>
            <p class="hero-description">
                Marcydap bukan sekadar toko obat online. Kami adalah ekosistem kesehatan yang siap mendampingi kebutuhan Anda melalui konsultasi ringan, memastikan resep obat tepat, hingga mengantarkan kesehatan langsung ke rumah Anda.
            </p>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section">
        <div class="section-header">
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle">Solusi kesehatan lengkap untuk Anda dan keluarga</p>
        </div>

        <div class="services-grid">
            <!-- Service 1 -->
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <i class="bi bi-capsule service-icon" style="transform: rotate(45deg);"></i>
                </div>
                <h3 class="service-title">Obat Resep</h3>
                <p class="service-description">Pesan obat dengan resep digital, aman dan terjamin kualitas</p>
            </div>

            <!-- Service 2 -->
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <i class="bi bi-clock service-icon"></i>
                </div>
                <h3 class="service-title">Buka 24 Jam</h3>
                <p class="service-description">Layanan non-stop untuk kebutuhan kesehatan mendesak Anda</p>
            </div>

            <!-- Service 3 -->
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <i class="bi bi-chat-dots service-icon"></i>
                </div>
                <h3 class="service-title">Kontak aktif 24 Jam</h3>
                <p class="service-description">Layanan Konsultasi untuk apri 24/7-hari kerja Atau kontak kami</p>
            </div>

            <!-- Service 4 -->
            <div class="service-card">
                <div class="service-icon-wrapper">
                    <i class="bi bi-credit-card service-icon"></i>
                </div>
                <h3 class="service-title">All Payment</h3>
                <p class="service-description">Menyediakan uang tunai, pembayaran apa? memudahkan saat pembelian apapun transaksi</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>MARCYDAP</h3>
                <p>Ekosistem kesehatan terpercaya yang siap melayani kesehatan kesehatan Anda dan keluarga dengan layanan terbaik dan produk berkualitas</p>
            </div>

            <div class="footer-column">
                <h4>Layanan</h4>
                <ul class="footer-links">
                    <li><a href="#">Pesan Obat</a></li>
                    <li><a href="#">Artikel Kesehatan</a></li>
                    <li><a href="#">Promo</a></li>
                    <li><a href="#">Dan lain lain</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Perusahaan</h4>
                <ul class="footer-links">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Lokasi Cabang</a></li>
                    <li><a href="#">Karir</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Legal</h4>
                <ul class="footer-links">
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            2024 Marcydap. All rights reserved
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>