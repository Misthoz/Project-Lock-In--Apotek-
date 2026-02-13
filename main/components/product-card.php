<?php

/**
 * Reusable Product Card Component
 * 
 * Parameter yang diperlukan:
 * - $product: array dengan key (id_barang, nama_barang, harga, deskripsi, gambar)
 * - $show_badge: boolean (optional) - tampilkan badge atau tidak
 * - $badge_text: string (optional) - text untuk badge
 * - $badge_class: string (optional) - class CSS untuk badge
 */

if (!isset($product) || empty($product)) {
    return;
}

// Format harga
$harga_format = number_format($product['harga'], 0, ',', '.');

// Gambar disimpan sebagai URL (VARCHAR) di database
$gambar_src = '';
if (!empty($product['gambar'])) {
    $gambar_src = $product['gambar'];
}

// Badge settings (optional)
$show_badge = isset($show_badge) ? $show_badge : false;
$badge_text = isset($badge_text) ? $badge_text : '';
$badge_class = isset($badge_class) ? $badge_class : 'badge-new';
?>

<!-- Product Card -->
<div class="product-card">
    <?php if ($show_badge && !empty($badge_text)) { ?>
        <div class="product-badges">
            <span class="product-badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($badge_text); ?></span>
        </div>
    <?php } ?>

    <button class="wishlist-btn">♡</button>

    <div class="product-image" style="<?php if (!empty($gambar_src)) echo 'background-image: url(' . $gambar_src . '); background-size: cover; background-position: center;'; ?>">
        <?php if (empty($gambar_src)) { ?>
            <div class="quick-view">Lihat Detail</div>
        <?php } ?>
    </div>

    <div class="product-content">
        <div class="product-category">Produk Kesehatan</div>
        <h3 class="product-title"><?php echo htmlspecialchars($product['nama_barang']); ?></h3>
        <div class="product-rating">
            <span class="stars">⭐⭐⭐⭐⭐</span>
            <span class="rating-count">(5.0)</span>
        </div>
        <div class="product-meta">
            <span><?php echo substr(htmlspecialchars($product['deskripsi']), 0, 50); ?>...</span>
        </div>
        <div class="product-footer">
            <div>
                <span class="price-current">Rp <?php echo $harga_format; ?></span>
            </div>
            <button class="add-btn" onclick="addToCart('<?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES); ?>')">
                <span>🛒</span>
                <span>Tambah</span>
            </button>
        </div>
    </div>
</div>