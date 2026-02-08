<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARCYDAP - Katalog Produk</title>
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
            background-color: #e8e8e8;
        }

        /* Header */
        .header {
            background-color: #2d4a44;
            padding: 12px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-logo {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .header-logo i {
            font-size: 28px;
            color: #2d6e5d;
        }

        .header-title {
            font-size: 18px;
            font-weight: 700;
            color: white;
            font-family: 'Georgia', serif;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
        }

        .search-input {
            width: 100%;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background-color: #c4c4c4;
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        .search-input:focus {
            outline: none;
            background-color: #d0d0d0;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
        }

        .icon-button {
            width: 40px;
            height: 40px;
            background-color: #7a7a7a;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .icon-button.cart {
            background-color: #5a5a5a;
        }

        .icon-button i {
            color: white;
            font-size: 18px;
        }

        /* Promo Banner */
        .promo-banner {
            background-color: #2d6e5d;
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .promo-icon {
            font-size: 24px;
            color: #e74c3c;
        }

        .promo-text {
            font-size: 14px;
            font-family: 'Georgia', serif;
        }

        /* Main Content */
        .main-container {
            display: flex;
            gap: 20px;
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            flex-shrink: 0;
        }

        .category-card {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        }

        .category-icon {
            width: 35px;
            height: 35px;
            background-color: #000;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-icon i {
            color: white;
            font-size: 18px;
        }

        .category-title {
            font-size: 20px;
            font-weight: 700;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .category-list {
            list-style: none;
        }

        .category-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .category-item:hover {
            padding-left: 5px;
        }

        .category-checkbox {
            width: 20px;
            height: 20px;
            background-color: #000;
            border-radius: 2px;
        }

        .category-name {
            font-size: 15px;
            color: #333;
            font-family: 'Georgia', serif;
        }

        .reset-filter {
            background-color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 8px;
            margin-top: 20px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            font-family: 'Georgia', serif;
        }

        .reset-filter:hover {
            background-color: #f5f5f5;
        }

        /* Products Area */
        .products-area {
            flex: 1;
        }

        .products-header {
            font-size: 16px;
            color: #333;
            margin-bottom: 25px;
            font-family: 'Georgia', serif;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .product-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            background-color: #e8e8e8;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            font-family: 'Georgia', serif;
        }

        .badge-resep {
            background-color: #e74c3c;
        }

        .badge-umum {
            background-color: #5eb89a;
        }

        .product-image i {
            font-size: 60px;
            color: #000;
        }

        .product-info {
            padding: 18px;
        }

        .product-category {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            font-family: 'Georgia', serif;
        }

        .product-name {
            font-size: 15px;
            font-weight: 700;
            color: #000;
            margin-bottom: 8px;
            font-family: 'Georgia', serif;
        }

        .product-description {
            font-size: 12px;
            color: #999;
            margin-bottom: 12px;
            font-family: 'Georgia', serif;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #666;
            margin-bottom: 15px;
            font-family: 'Georgia', serif;
        }

        .product-meta i {
            font-size: 12px;
        }

        .product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            font-family: 'Georgia', serif;
        }

        .btn-add-cart {
            background-color: #5eb89a;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Georgia', serif;
            transition: background-color 0.3s;
        }

        .btn-add-cart:hover {
            background-color: #4fa385;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .pagination-btn {
            width: 45px;
            height: 45px;
            background-color: white;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            font-family: 'Georgia', serif;
            transition: all 0.3s;
        }

        .pagination-btn:hover {
            background-color: #f0f0f0;
        }

        .pagination-btn.active {
            background-color: #2d6e5d;
            color: white;
        }

        .pagination-dots {
            font-size: 18px;
            font-weight: 700;
        }

        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-wrap: wrap;
                gap: 10px;
            }

            .search-bar {
                order: 3;
                width: 100%;
                max-width: 100%;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-logo">
            <i class="bi bi-plus-lg"></i>
        </div>
        <h1 class="header-title">MARCYDAP</h1>
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="">
        </div>
        <div class="header-icons">
            <button class="icon-button">
                <i class="bi bi-heart"></i>
            </button>
            <button class="icon-button cart">
                <i class="bi bi-cart3"></i>
            </button>
            <button class="icon-button">
                <i class="bi bi-person"></i>
            </button>
        </div>
    </div>

    <!-- Promo Banner -->
    <div class="promo-banner">
        <i class="bi bi-megaphone-fill promo-icon"></i>
        <div class="promo-text">
            PROMO HARI INI - Diskon hingga 30% untuk semua produk vitamin! Gratis ongkir min. belanja Rp 100.000
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="category-card">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="bi bi-list"></i>
                    </div>
                    <h2 class="category-title">Kategori</h2>
                </div>
                <ul class="category-list">
                    <li class="category-item">
                        <div class="category-checkbox"></div>
                        <span class="category-name">Obat Resep</span>
                    </li>
                    <li class="category-item">
                        <div class="category-checkbox"></div>
                        <span class="category-name">Obat Umum</span>
                    </li>
                    <li class="category-item">
                        <div class="category-checkbox"></div>
                        <span class="category-name">-------------------</span>
                    </li>
                    <li class="category-item">
                        <div class="category-checkbox"></div>
                        <span class="category-name">-------------------</span>
                    </li>
                </ul>
            </div>
            <button class="reset-filter">
                <i class="bi bi-arrow-clockwise"></i>
                Reset Filter
            </button>
        </aside>

        <!-- Products Area -->
        <main class="products-area">
            <div class="products-header">
                Menampilkan 1-4 dari 1000 Produk
            </div>

            <div class="products-grid">
                <!-- Product Card 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge badge-resep">Resep</span>
                        <i class="bi bi-capsule" style="transform: rotate(45deg);"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-category">Obat Demam</div>
                        <h3 class="product-name">Paracetamol 500mg - Demam</h3>
                        <p class="product-description">(PV) Syinal</p>
                        <div class="product-meta">
                            <i class="bi bi-tag"></i>
                            <span>Isi 10 Tablet</span>
                        </div>
                        <div class="product-footer">
                            <div class="product-price">Rp . 20.000</div>
                            <button class="btn-add-cart">+ Tambah</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge badge-umum">Umum</span>
                        <i class="bi bi-capsule" style="transform: rotate(45deg);"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-category">Obat Darah</div>
                        <h3 class="product-name">Paracetamol 500mg - Demam</h3>
                        <p class="product-description">(PV) Syinal</p>
                        <div class="product-meta">
                            <i class="bi bi-tag"></i>
                            <span>Isi 10 Tablet</span>
                        </div>
                        <div class="product-footer">
                            <div class="product-price">Rp . 20.000</div>
                            <button class="btn-add-cart">+ Tambah</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge badge-resep">Resep</span>
                        <i class="bi bi-capsule" style="transform: rotate(45deg);"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-category">Obat Demam</div>
                        <h3 class="product-name">Paracetamol 500mg - Demam</h3>
                        <p class="product-description">(PV) Syinal</p>
                        <div class="product-meta">
                            <i class="bi bi-tag"></i>
                            <span>Isi 10 Tablet</span>
                        </div>
                        <div class="product-footer">
                            <div class="product-price">Rp . 20.000</div>
                            <button class="btn-add-cart">+ Tambah</button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge badge-umum">Umum</span>
                        <i class="bi bi-capsule" style="transform: rotate(45deg);"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-category">Obat Darah</div>
                        <h3 class="product-name">Paracetamol 500mg - Demam</h3>
                        <p class="product-description">(PV) Syinal</p>
                        <div class="product-meta">
                            <i class="bi bi-tag"></i>
                            <span>Isi 10 Tablet</span>
                        </div>
                        <div class="product-footer">
                            <div class="product-price">Rp . 20.000</div>
                            <button class="btn-add-cart">+ Tambah</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination-container">
                <button class="pagination-btn">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <div class="pagination-dots">...</div>
                <button class="pagination-btn">10</button>
                <button class="pagination-btn">
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>