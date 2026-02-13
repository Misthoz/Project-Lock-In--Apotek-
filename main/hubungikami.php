<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Marcydap Apotek</title>
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

        .hero-contact {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            padding: 80px 0; text-align: center; color: white; position: relative; overflow: hidden;
        }
        .hero-contact::before {
            content: ''; position: absolute; top: -50%; right: -50%; width: 100%; height: 200%;
            background: radial-gradient(circle, rgba(82, 183, 136, 0.1) 0%, transparent 60%);
        }
        .hero-contact h1 { font-family: 'Playfair Display', serif; font-size: 48px; margin-bottom: 15px; }
        .hero-contact p { font-size: 18px; opacity: 0.9; }

        .section-title { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 36px; margin-bottom: 15px; }
        .section-subtitle { color: #666; font-size: 16px; }

        .contact-method-card {
            background: white; border-radius: 20px; padding: 35px; text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: all 0.4s ease; height: 100%;
        }
        .contact-method-card:hover { transform: translateY(-8px); box-shadow: 0 12px 40px rgba(26, 71, 42, 0.15); }
        .contact-icon {
            width: 70px; height: 70px; margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 30px;
        }
        .contact-method-card h4 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 20px; margin-bottom: 10px; }
        .contact-method-card p { color: #666; font-size: 14px; margin-bottom: 5px; }
        .contact-method-card .contact-detail { color: var(--secondary-green); font-weight: 600; font-size: 15px; }

        .contact-form-section { padding: 80px 0; }
        .contact-form-wrapper {
            background: white; border-radius: 20px; padding: 50px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .form-label-custom { font-weight: 600; color: var(--primary-green); font-size: 14px; margin-bottom: 8px; }
        .form-input {
            width: 100%; padding: 14px 18px; border: 2px solid #e8f5e9;
            border-radius: 12px; font-size: 15px; font-family: 'DM Sans', sans-serif;
            transition: all 0.3s ease;
        }
        .form-input:focus { outline: none; border-color: var(--accent-green); box-shadow: 0 0 0 4px rgba(82, 183, 136, 0.1); }
        textarea.form-input { resize: vertical; min-height: 120px; }
        .submit-btn {
            width: 100%; padding: 16px; background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            color: white; border: none; border-radius: 12px; font-size: 16px; font-weight: 700;
            cursor: pointer; transition: all 0.3s ease;
        }
        .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(45, 106, 79, 0.3); }

        .office-card {
            background: white; border-radius: 16px; padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); height: 100%;
        }
        .office-card h4 { font-family: 'Playfair Display', serif; color: var(--primary-green); font-size: 18px; margin-bottom: 12px; }
        .office-card p { color: #555; font-size: 14px; margin-bottom: 5px; }

        .faq-section { padding: 80px 0; background: white; }
        .faq-item {
            background: var(--bg-cream); border-radius: 16px; margin-bottom: 15px;
            overflow: hidden; transition: all 0.3s ease;
        }
        .faq-question {
            padding: 20px 25px; cursor: pointer; display: flex; justify-content: space-between;
            align-items: center; font-weight: 600; color: var(--primary-green); font-size: 16px;
        }
        .faq-question .toggle-icon { font-size: 20px; transition: transform 0.3s ease; }
        .faq-answer { padding: 0 25px 20px; color: #555; line-height: 1.7; font-size: 14px; display: none; }
        .faq-item.active .faq-answer { display: block; }
        .faq-item.active .toggle-icon { transform: rotate(45deg); }

        .map-placeholder {
            width: 100%; height: 350px;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            font-size: 60px; margin-top: 40px;
        }

        .customer-service {
            background: linear-gradient(135deg, var(--secondary-green), var(--accent-green));
            border-radius: 20px; padding: 40px; color: white; text-align: center;
        }
        .customer-service h3 { font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 10px; }

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
                        <li class="nav-item"><a class="nav-link nav-link-custom" href="tentangkami.php">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link nav-link-custom active" href="hubungikami.php">Kontak</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero-contact">
        <div class="container position-relative">
            <h1 class="fade-in">Hubungi Kami</h1>
            <p class="fade-in">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami kapan saja.</p>
        </div>
    </section>

    <!-- Contact Methods -->
    <section class="py-5">
        <div class="container" style="margin-top: -60px; position: relative; z-index: 2;">
            <div class="row g-4">
                
                <div class="col-lg-3 col-md-6">
                    <div class="contact-method-card">
                        <h4>Email</h4>
                        <p>Respon dalam 1x24 jam</p>
                        <div class="contact-detail">marcydap@gmail.com</div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                    <div class="contact-method-card">
                        <h4>Live Chat</h4>
                        <p>Respon cepat & real-time</p>
                        <div class="contact-detail">24/7 Online</div>
                    </div>
                </div> -->
                <div class="col-lg-3 col-md-6">
                    <div class="contact-method-card">
                        <h4>WhatsApp / Telepon</h4>
                        <p>Chat langsung dengan tim kami</p>
                        <div class="contact-detail">+62 812-xxxx-xxxx</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="contact-form-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="contact-form-wrapper">
                        <h2 class="section-title mb-2">Kirim Pesan</h2>
                        <p class="section-subtitle mb-4">Isi formulir di bawah dan kami akan menghubungi Anda secepatnya.</p>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Nama Lengkap</label>
                                    <input type="text" class="form-input" placeholder="Masukkan nama lengkap">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Email</label>
                                    <input type="email" class="form-input" placeholder="email@contoh.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">No. Telepon</label>
                                    <input type="tel" class="form-input" placeholder="+62 xxx-xxxx-xxxx">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Subjek</label>
                                    <select class="form-input">
                                        <option value="">Pilih subjek</option>
                                        <option>Pertanyaan Umum</option>
                                        <option>Pemesanan Obat</option>
                                        <option>Keluhan & Saran</option>
                                        <option>Kerjasama Bisnis</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Pesan</label>
                                    <textarea class="form-input" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="submit-btn">Kirim Pesan →</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-4">
                        <div class="office-card">
                            <h4>Kantor Pusat</h4>
                            <p>Jl. Kesehatan No. 123</p>
                            <p>Jakarta Selatan, DKI Jakarta 12345</p>
                            <p>Indonesia</p>
                        </div>
                        <div class="office-card">
                            <h4>Jam Operasional</h4>
                            <p><strong>Senin - Jumat:</strong> 08.00 - 21.00 WIB</p>
                            <p><strong>Sabtu:</strong> 09.00 - 18.00 WIB</p>
                            <p><strong>Minggu:</strong> 10.00 - 15.00 WIB</p>
                        </div>
                        <div class="customer-service">
                            <h3>Butuh Bantuan Segera?</h3>
                            <p style="opacity:0.9;">Tim customer service kami siap membantu Anda. Hubungi hotline kami untuk bantuan darurat.</p>
                            <p class="mt-3" style="font-size:24px; font-weight:700;">(021) xxxx xxxx</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Pertanyaan Umum</h2>
                <p class="section-subtitle">Jawaban untuk pertanyaan yang sering ditanyakan</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item active">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Bagaimana cara memesan obat secara online?</span>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer">Anda dapat memesan obat melalui website kami dengan memilih produk, menambahkannya ke keranjang, dan melakukan pembayaran. Untuk obat resep, Anda perlu mengunggah resep dokter terlebih dahulu.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Apakah bisa konsultasi dengan apoteker?</span>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer">Ya, kami menyediakan layanan konsultasi gratis dengan apoteker profesional melalui live chat atau WhatsApp pada jam operasional.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>Metode pembayaran apa saja yang tersedia?</span>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="faq-answer">Kami menerima pembayaran melalui, e-wallet (GoPay, OVO, Dana, ShopeePay), dan CIP (Cash in Place).</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-5"><div class="footer-brand"><h3>MARCYDAP</h3><p>Platform kesehatan terpercaya yang menghubungkan Anda dengan produk berkualitas dan layanan profesional.</p></div></div>                <div class="col-lg-2"><div class="footer-section"><h4>Perusahaan</h4><ul class="footer-links"><li><a href="tentangkami.php">Tentang Kami</a></li></ul></div></div>
                <div class="col-lg-3"><div class="footer-section"><h4>Bantuan</h4><ul class="footer-links"><li><a href="#">FAQ</a></li><li><a href="hubungikami.php">Hubungi Kami</a></li><li><a href="#">Syarat & Ketentuan</a></li><li><a href="#">Kebijakan Privasi</a></li><li><a href="#">Cara Pemesanan</a></li></ul></div></div>
            </div>
            <div class="footer-bottom"><p>© 2024 Marcydap. All rights reserved. Made with 💚 in Indonesia</p></div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleFaq(el) {
            const item = el.parentElement;
            const wasActive = item.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
            if (!wasActive) item.classList.add('active');
        }
    </script>
</body>
</html>
