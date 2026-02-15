<?php
include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcydap - Kesehatan dalam Genggaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;500;600;700;800&family=Fraunces:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="dashboard.php">
                <div class="logo-icon"></div>
                <div class="logo-text">
                    <h1>MARCYDAP</h1>
                    <p>APOTEK</p>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="tentangkami.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="hubungikami.php">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 hero-text">
                    <span class="hero-badge">Platform Kesehatan Terpercaya</span>
                    <h1>Kesehatan<br><span class="highlight">dalam</span><br>Genggaman</h1>
                    <p class="hero-description">Akses mudah ke ribuan produk kesehatan berkualitas, konsultasi profesional, dan pengiriman cepat ke seluruh Indonesia. Karena kesehatan Anda adalah prioritas kami.</p>
                    <div class="hero-actions mb-5">
                        <a href="produk.php" class="btn btn-primary-custom">Mulai Belanja 🛒</a>
                    </div>
                </div>
                <div class="col-lg-5 hero-visual">
                    <div class="hero-card">
                        <span class="card-tag">Mengapa Marcydap?</span>
                        <h3 class="card-title">Solusi Kesehatan Lengkap</h3>
                        <div class="feature"><div class="feature-icon">✓</div><div class="feature-text">Produk 100% Original & Terjamin</div></div>
                        <div class="feature"><div class="feature-icon">✓</div><div class="feature-text">Harga Terjangkau & Promo Menarik</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan -->
    <section class="services">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">Layanan Kami</span>
                <h2 class="section-title">Solusi Kesehatan untuk Setiap Kebutuhan</h2>
                <p class="section-description mx-auto" style="max-width:700px;">Dari konsultasi hingga pengiriman, kami hadir untuk memudahkan perjalanan kesehatan Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4"><div class="service-card"><h3>Belanja Online</h3><p>Akses ribuan produk kesehatan berkualitas dengan harga terbaik. Cari, pilih, dan pesan dengan mudah dari rumah.</p><a href="produk.php" class="service-link">Mulai Belanja →</a></div></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-5"><div class="footer-brand"><h3>MARCYDAP</h3><p>Platform kesehatan terpercaya yang menghubungkan Anda dengan produk berkualitas dan layanan profesional.</p></div></div>
                <div class="col-lg-2"><div class="footer-section"><h4>Perusahaan</h4><ul class="footer-links"><li><a href="tentangkami.php">Tentang Kami</a></li></ul></div></div>
                <div class="col-lg-3"><div class="footer-section"><h4>Bantuan</h4><ul class="footer-links"><li><a href="#">FAQ</a></li><li><a href="hubungikami.php">Hubungi Kami</a></li><li><a href="#">Syarat & Ketentuan</a></li><li><a href="#">Kebijakan Privasi</a></li><li><a href="#">Cara Pemesanan</a></li></ul></div></div>
            </div>
            <div class="footer-bottom"><p>© 2024 Marcydap. All rights reserved. Made with 💚 in Indonesia</p></div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        });
    </script>
</body>
</html>
