<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCYDAP - Temukan Apotek Terdekat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #d9d9d9;
            font-family: 'Georgia', serif;
            min-height: 100vh;
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .top-header {
            background-color: #f5f5f5;
            padding: 15px 30px;
            display: flex;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background-color: #2d6e5d;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon i {
            font-size: 28px;
            color: white;
        }

        .brand-info h1 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .brand-info p {
            font-size: 11px;
            margin: 0;
            color: #666;
            font-family: 'Georgia', serif;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #2D6A4F 0%, #5eb89a 100%);
            padding: 50px 30px;
            color: white;
            text-align: center;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 400;
            margin-bottom: 15px;
            font-family: 'Georgia', serif;
        }

        .hero-subtitle {
            font-size: 15px;
            margin-bottom: 35px;
            line-height: 1.6;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-family: 'Georgia', serif;
        }

        /* Search Section */
        .search-section {
            background: white;
            padding: 25px 30px;
            margin: 0 30px;
            margin-top: -20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
        }

        .search-container {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .search-input-group {
            flex: 1;
            position: relative;
        }

        .search-input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
        }

        .search-input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: none;
            background-color: #e8e8e8;
            font-size: 14px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        .search-input:focus {
            outline: none;
            background-color: #e8e8e8;
        }

        .type-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #e8e8e8;
            padding: 12px 20px;
            cursor: pointer;
            white-space: nowrap;
        }

        .type-selector i {
            font-size: 16px;
        }

        .type-selector span {
            font-size: 14px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        .type-selector .dropdown-circle {
            width: 20px;
            height: 20px;
            background-color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 5px;
        }

        .type-selector .dropdown-circle::after {
            content: '';
            width: 0;
            height: 0;
            border-left: 3px solid transparent;
            border-right: 3px solid transparent;
            border-top: 4px solid white;
        }

        .btn-search {
            background-color: #5eb89a;
            color: white;
            border: none;
            padding: 12px 35px;
            font-size: 15px;
            font-family: 'Georgia', serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-search:hover {
            background-color: #4fa385;
        }

        .btn-search i {
            font-size: 16px;
        }

        /* Stats Section */
        .stats-section {
            padding: 40px 30px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: white;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .stat-label {
            font-size: 14px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        /* Location Section */
        .location-section {
            padding: 0 30px 40px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 400;
            margin-bottom: 8px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .section-subtitle {
            font-size: 14px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        .location-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .location-card {
            background: white;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .location-map {
            background: linear-gradient(135deg, #2D6A4F 0%, #52B788 100%);
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .map-icon {
            font-size: 80px;
            color: rgba(0, 0, 0, 0.3);
        }

        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: white;
            padding: 5px 15px;
            border-radius: 3px;
            font-size: 12px;
            font-family: 'Georgia', serif;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-badge i {
            font-size: 14px;
        }

        .location-info {
            padding: 20px;
        }

        .location-name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 13px;
            color: #666;
            font-family: 'Georgia', serif;
        }

        .info-item i {
            font-size: 16px;
            color: #000;
            margin-top: 2px;
        }

        @media (max-width: 1024px) {
            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }

            .location-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
            }

            .type-selector,
            .btn-search {
                width: 100%;
                justify-content: center;
            }

            .hero-title {
                font-size: 32px;
            }

            .section-title {
                font-size: 28px;
            }

            .stats-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="top-header">
        <div class="logo-container">
            <div class="logo-icon">
                <i class="bi bi-plus-lg"></i>
            </div>
            <div class="brand-info">
                <h1>MARCYDAP</h1>
                <p>Apotek Terpercaya</p>
            </div>
        </div>
    </div>

    <div class="main-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h2 class="hero-title">Temukan Apotek Terdekat</h2>
            <p class="hero-subtitle">Kami melayani dengan sepenuh hati di berbagai lokasi untuk kemudahan akses kesehatan Anda dan keluarga</p>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <div class="search-container">
                <div class="search-input-group">
                    <i class="bi bi-geo-alt-fill search-input-icon"></i>
                    <input type="text" class="search-input" placeholder="Masukan kota atau alamat...">
                </div>
                
                <div class="type-selector">
                    <i class="bi bi-building"></i>
                    <span>Semua Tipe</span>
                    <div class="dropdown-circle"></div>
                </div>
                
                <button class="btn-search">
                    <i class="bi bi-search"></i>
                    Cari Lokasi
                </button>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-capsule" style="transform: rotate(45deg); display: inline-block;"></i>
                </div>
                <div class="stat-number">45+</div>
                <div class="stat-label">Cabang Apotek</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-number">24/7</div>
                <div class="stat-label">Layanan non-stop</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="stat-number">150+</div>
                <div class="stat-label">Apoteker Profesional</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-star-fill"></i>
                </div>
                <div class="stat-number">5.0</div>
                <div class="stat-label">Rating Pelanggan</div>
            </div>
        </div>

        <!-- Location Section -->
        <div class="location-section">
            <div class="section-header">
                <h3 class="section-title">Lokasi Apotek Kami</h3>
                <p class="section-subtitle">Pilih cabang yang paling cocok untuk Anda</p>
            </div>

            <div class="location-grid">
                <!-- Location Card 1 -->
                <div class="location-card">
                    <div class="location-map">
                        <i class="bi bi-shop map-icon"></i>
                        <div class="status-badge">
                            <i class="bi bi-shop"></i>
                            Buka
                        </div>
                    </div>
                    <div class="location-info">
                        <h4 class="location-name">Marcydap Pesut</h4>
                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Jl. Mulawarman Pesut, Rt 01, Samarinda Ilir, Kalimantan Timur</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>0800 Kapan Kapan kita balikan</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-clock-fill"></i>
                            <span>Setiap buka 24/7 hanya untuk mu</span>
                        </div>
                    </div>
                </div>

                <!-- Location Card 2 -->
                <div class="location-card">
                    <div class="location-map">
                        <i class="bi bi-shop map-icon"></i>
                        <div class="status-badge">
                            <i class="bi bi-shop"></i>
                            Tutup
                        </div>
                    </div>
                    <div class="location-info">
                        <h4 class="location-name">Marcydap Seberang</h4>
                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Jl. Acbon Sekerang, Rt 4, Samarinda Ilir, Kalimantan Timur</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-telephone-fill"></i>
                            <span>0800 Kapan Kapan kita ngoding barengon</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-clock-fill"></i>
                            <span>Senin - Minggu : 07.00 - 22.00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>