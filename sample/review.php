<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Pelanggan - Marcydap Apotek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/review.css">
</head>
<body>
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

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-5"><div class="footer-brand"><h3>MARCYDAP</h3><p>Platform kesehatan terpercaya yang menghubungkan Anda dengan produk berkualitas dan layanan profesional.</p></div></div>
                <div class="col-lg-2"><div class="footer-section"><h4>Layanan</h4><ul class="footer-links"><li><a href="#">Belanja Online</a></li><li><a href="#">Upload Resep</a></li></ul></div></div>
                <div class="col-lg-2"><div class="footer-section"><h4>Perusahaan</h4><ul class="footer-links"><li><a href="tentangkami.php">Tentang Kami</a></li></ul></div></div>
                <div class="col-lg-3"><div class="footer-section"><h4>Bantuan</h4><ul class="footer-links"><li><a href="#">FAQ</a></li><li><a href="hubungikami.php">Hubungi Kami</a></li><li><a href="#">Syarat & Ketentuan</a></li><li><a href="#">Kebijakan Privasi</a></li><li><a href="#">Cara Pemesanan</a></li></ul></div></div>
            </div>
            <div class="footer-bottom"><p>© 2024 Marcydap. All rights reserved. Made with 💚 in Indonesia</p></div>
        </div>
    </footer>

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
