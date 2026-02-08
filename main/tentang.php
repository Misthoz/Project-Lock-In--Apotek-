<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCYDAP - Tentang Marcydap</title>
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

        /* Header */
        .header {
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #e0e0e0;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-logo {
            width: 40px;
            height: 40px;
            background-color: #2d6e5d;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo i {
            font-size: 24px;
            color: white;
        }

        .header-title {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            font-family: 'Georgia', serif;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #2d6e5d 0%, #5eb89a 100%);
            padding: 60px 30px;
            color: white;
            text-align: center;
        }

        .hero-badge {
            background-color: rgba(255, 255, 255, 0.3);
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            font-size: 13px;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 400;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
            line-height: 1.2;
        }

        .hero-description {
            font-size: 14px;
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto;
            font-family: 'Georgia', serif;
        }

        /* Story Section */
        .story-section {
            background-color: #f5f5f5;
            padding: 60px 30px;
        }

        .story-container {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .story-image {
            background: linear-gradient(135deg, #2d6e5d 0%, #5eb89a 100%);
            border-radius: 12px;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .story-content h2 {
            font-size: 32px;
            font-weight: 400;
            margin-bottom: 20px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .story-text {
            font-size: 14px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 20px;
            font-family: 'Georgia', serif;
        }

        .commitment-box {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .commitment-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .commitment-title i {
            color: #e74c3c;
        }

        .commitment-text {
            font-size: 12px;
            line-height: 1.7;
            color: #666;
            font-family: 'Georgia', serif;
        }

        /* Vision Mission Section */
        .vision-mission-section {
            background-color: white;
            padding: 60px 30px;
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

        .vm-grid {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .vm-card {
            background-color: #f5f5f5;
            padding: 35px;
            border-radius: 8px;
        }

        .vm-icon-wrapper {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2d6e5d 0%, #5eb89a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .vm-icon {
            font-size: 28px;
            color: white;
        }

        .vm-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .vm-description {
            font-size: 13px;
            line-height: 1.8;
            color: #666;
            font-family: 'Georgia', serif;
        }

        @media (max-width: 768px) {
            .story-container {
                grid-template-columns: 1fr;
            }

            .story-image {
                height: 250px;
            }

            .hero-title {
                font-size: 32px;
            }

            .section-title {
                font-size: 28px;
            }

            .vm-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-logo">
                <i class="bi bi-plus-lg"></i>
            </div>
            <h1 class="header-title">MARCYDAP</h1>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-badge">Tentang Marcydap</div>
        <h2 class="hero-title">Dedikasi Untuk Kesehatan Anda</h2>
        <p class="hero-description">
            Sejak 2018, kami telah menjadi mitra kesehatan dengan komitmen untuk anda kualitas, keamanan, dan kepercayaan dalam setiap layanan kesehatan yang kami berikan
        </p>
    </div>

    <!-- Story Section -->
    <div class="story-section">
        <div class="story-container">
            <div class="story-image">
                <!-- Placeholder untuk gambar -->
            </div>
            
            <div class="story-content">
                <h2>Cerita Kami Dimulai</h2>
                <p class="story-text">
                    Marcydap dilahirkan dengan visi sederhana namun bermakna: memastikan setiap keluarga berkualitas dapat diakses oleh semua orang. Berangkat dari satu apotek kecil di Jakarta, kami kini telah berkembang menjadi jaringan apotek terpercaya dengan lebih dari 45+ cabang yang tersebar di seluruh Nusantara.
                </p>
                <p class="story-text">
                    Perjalanan kami didorong oleh komitmen untuk terus selalu mengutamakan kesehatan dan kepuasan pelanggan sebagai prioritas utama. Setiap produk yang kami tawarkan telah melalui seleksi ketat untuk memastikan kualitas dan keasliannya.
                </p>

                <div class="commitment-box">
                    <div class="commitment-title">
                        <i class="bi bi-heart-fill"></i>
                        Komitmen Kami
                    </div>
                    <p class="commitment-text">
                        Memberikan layanan kesehatan yang dapat diakses, terjangkau, dan berkualitas tinggi. Setiap langkah yang kami ambil didorong oleh misi untuk membantu orang hidup lebih sehat, lebih bahagia, dan lebih lama. Dengan kepercayaan yang telah Anda berikan kepada kami, kami berjanji untuk selalu memberikan yang terbaik dalam setiap produk dan layanan yang kami hadirkan
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Vision & Mission Section -->
    <div class="vision-mission-section">
        <div class="section-header">
            <h3 class="section-title">Visi & Misi Kami</h3>
            <p class="section-subtitle">Fondasi yang menggerakkan setiap langkah kami</p>
        </div>

        <div class="vm-grid">
            <!-- Visi Card -->
            <div class="vm-card">
                <div class="vm-icon-wrapper">
                    <i class="bi bi-bullseye vm-icon"></i>
                </div>
                <h4 class="vm-title">Visi</h4>
                <p class="vm-description">
                    Menjadi apotek terdepan di Indonesia yang dikenal karena layanan kesehatan berkualitas, inovasi digital, dan kepercayaan pelanggan yang berkelanjutan di seluruh nusantara.
                </p>
            </div>

            <!-- Misi Card -->
            <div class="vm-card">
                <div class="vm-icon-wrapper">
                    <i class="bi bi-rocket-takeoff vm-icon"></i>
                </div>
                <h4 class="vm-title">Misi</h4>
                <p class="vm-description">
                    Memastikan akses mudah dan cepat terhadap obat-obatan berkualitas, menyediakan konsultasi kesehatan profesional, dan memanfaatkan teknologi kesehatan untuk meningkatkan kualitas hidup masyarakat Indonesia.
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>