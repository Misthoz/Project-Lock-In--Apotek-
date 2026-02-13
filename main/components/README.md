# Reusable Product Card Component

## Deskripsi
Component ini adalah card produk yang dapat digunakan kembali di berbagai halaman. Component ini mengambil data dari database dan menampilkannya dengan format yang konsisten.

## Lokasi File
- **Component**: `main/components/product-card.php`
- **Contoh Penggunaan**: `main/produk.php`

## Cara Penggunaan

### 1. Basic Usage
```php
<?php
// Ambil data produk dari database
$query = "SELECT * FROM barang WHERE id_barang = 1";
$result = mysqli_query($db, $query);
$product = mysqli_fetch_assoc($result);

// Include component
include 'components/product-card.php';
?>
```

### 2. Penggunaan dengan Loop
```php
<?php
// Ambil semua produk
$query = "SELECT * FROM barang ORDER BY id_barang DESC";
$result = mysqli_query($db, $query);

while($row = mysqli_fetch_assoc($result)) {
    $product = $row;
    ?>
    <div class="col-xl-3 col-lg-4 col-md-6">
        <?php include 'components/product-card.php'; ?>
    </div>
    <?php
}
?>
```

### 3. Penggunaan dengan Badge
```php
<?php
$product = mysqli_fetch_assoc($result);
$show_badge = true;
$badge_text = "PROMO 30%";
$badge_class = "badge-promo"; // badge-promo, badge-new, badge-best, badge-prescription

include 'components/product-card.php';
?>
```

## Parameter Component

### Required Parameters:
- `$product` (array) - Data produk dengan struktur:
  - `id_barang` (int) - ID produk
  - `nama_barang` (string) - Nama produk
  - `harga` (numeric) - Harga produk
  - `deskripsi` (text) - Deskripsi produk
  - `gambar` (blob) - Gambar produk dalam format blob

### Optional Parameters:
- `$show_badge` (boolean) - Tampilkan badge atau tidak. Default: `false`
- `$badge_text` (string) - Text untuk badge. Default: `''`
- `$badge_class` (string) - CSS class untuk badge. Default: `'badge-new'`
  - Available classes:
    - `badge-promo` - Merah (untuk promo)
    - `badge-new` - Biru (untuk produk baru)
    - `badge-best` - Orange (untuk best seller)
    - `badge-prescription` - Hijau (untuk produk resep)

## Struktur Database

Tabel `barang`:
```sql
CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` blob NOT NULL,
  PRIMARY KEY (`id_barang`)
);
```

## JavaScript Functions

Component ini menggunakan fungsi JavaScript:
- `addToCart(productId)` - Menambahkan produk ke keranjang

Pastikan include JavaScript di footer halaman:
```html
<script>
function addToCart(productId) {
    alert('Produk dengan ID ' + productId + ' ditambahkan ke keranjang!');
    // TODO: Implementasi AJAX untuk menambah ke keranjang
}
</script>
```

## CSS Requirements

Component ini memerlukan CSS classes berikut (sudah termasuk di produk.php):
- `.product-card`
- `.product-badges`
- `.product-badge`
- `.wishlist-btn`
- `.product-image`
- `.product-content`
- `.product-title`
- `.product-rating`
- `.price-current`
- `.add-btn`

## Tips
1. Pastikan koneksi database sudah ter-include sebelum menggunakan component
2. Untuk performa optimal, gunakan pagination jika produk lebih dari 50 item
3. Gambar akan otomatis di-convert dari blob ke base64
4. Deskripsi akan dipotong maksimal 50 karakter, tambahkan "..." di akhir

## Contoh Lengkap

```php
<?php
include '../config/db.php';

// Query produk
$query = "SELECT * FROM barang WHERE kategori = 'Vitamin' LIMIT 8";
$result = mysqli_query($db, $query);
?>

<div class="container">
    <div class="row g-4">
        <?php 
        while($row = mysqli_fetch_assoc($result)) {
            $product = $row;
            
            // Optional: Tambahkan badge untuk produk tertentu
            if($row['id_barang'] <= 3) {
                $show_badge = true;
                $badge_text = "NEW";
                $badge_class = "badge-new";
            }
        ?>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <?php include 'components/product-card.php'; ?>
        </div>
        <?php 
            // Reset badge settings
            $show_badge = false;
        } 
        ?>
    </div>
</div>
```

## Update Log
- 13 Feb 2026: Initial release - Reusable product card component
