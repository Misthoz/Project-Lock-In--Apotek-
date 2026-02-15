# Detail Produk - Reusable Component

## 📄 File Structure

```
main/
├── detail_produk.php          # Main detail product page
├── css/
│   └── detail_produk.css      # Styles for detail page
└── components/
    └── product-card.php       # Updated with links to detail page
```

## 🎯 Fitur

### 1. **Halaman Detail Produk** (`detail_produk.php`)
- ✅ Menampilkan informasi lengkap produk dari database
- ✅ Gambar produk yang besar dan jelas
- ✅ Informasi kategori/jenis barang dengan badge berwarna
- ✅ Deskripsi lengkap produk
- ✅ Harga dengan format Rupiah
- ✅ Quantity selector (tambah/kurang jumlah)
- ✅ Tombol "Tambah ke Keranjang"
- ✅ Tombol "Lihat Keranjang"
- ✅ Breadcrumb navigation
- ✅ Produk terkait (related products)
- ✅ Tabel informasi produk (kategori, status, kode produk)
- ✅ Toast notification setelah tambah ke keranjang

### 2. **Product Card Component (Updated)**
- ✅ Link ke halaman detail di gambar produk
- ✅ Link ke halaman detail di judul produk
- ✅ Hover effect "Lihat Detail"
- ✅ Tetap bisa langsung tambah ke keranjang dari card

### 3. **CSS Styling**
- ✅ Responsive design untuk mobile, tablet, desktop
- ✅ Badge berwarna untuk setiap jenis barang:
  - 🩸 Darah: Merah gradient
  - 🌿 Herbal: Hijau gradient
  - 💪 Tubuh: Biru gradient
  - 🧠 Kepala: Ungu gradient
- ✅ Smooth transitions dan animations
- ✅ Sticky product image pada desktop

## 🔧 Cara Menggunakan

### Akses Halaman Detail:

**URL Format:**
```
detail_produk.php?id={id_barang}
```

**Contoh:**
```
detail_produk.php?id=1
detail_produk.php?id=2
```

### Dari Product Card:
- Klik pada gambar produk
- Klik pada judul produk
- Akan otomatis redirect ke halaman detail dengan ID yang sesuai

### Dari Kode PHP:
```php
// Link manual ke detail produk
$product_url = "detail_produk.php?id=" . $product['id_barang'];
echo "<a href='$product_url'>Lihat Detail</a>";
```

## 📊 Data yang Diambil dari Database

File `detail_produk.php` mengambil data dari tabel `barang`:

```sql
SELECT * FROM barang WHERE id_barang = {id}
```

**Kolom yang digunakan:**
- `id_barang` - ID unik produk
- `nama_barang` - Nama produk
- `jenis_barang` - Kategori (darah/herbal/tubuh/kepala)
- `harga` - Harga produk
- `deskripsi` - Deskripsi lengkap produk
- `gambar` - URL gambar produk

## 🎨 Badge Kategori

Setiap jenis barang memiliki badge dengan warna dan icon berbeda:

| Jenis    | Icon | Warna     | Label        |
|----------|------|-----------|--------------|
| darah    | 🩸   | Merah     | Obat Darah   |
| herbal   | 🌿   | Hijau     | Obat Herbal  |
| tubuh    | 💪   | Biru      | Obat Tubuh   |
| kepala   | 🧠   | Ungu      | Obat Kepala  |

## ⚙️ Fitur Tambahan

### Related Products (Produk Terkait)
Otomatis menampilkan hingga 4 produk dengan jenis yang sama:
```php
SELECT * FROM barang 
WHERE jenis_barang = '{current_product_jenis}' 
AND id_barang != {current_id} 
LIMIT 4
```

### Quantity Selector
JavaScript functions untuk mengatur jumlah:
- `increaseQty()` - Tambah jumlah (max 99)
- `decreaseQty()` - Kurang jumlah (min 1)

### Auto-redirect
Jika ID produk tidak valid atau tidak ditemukan, otomatis redirect ke `produk.php`

## 🎯 Integrasi dengan Keranjang

**Form Add to Cart:**
```php
<form method="POST">
    <input type="number" name="quantity" value="1" min="1" max="99">
    <button type="submit" name="add_to_cart">Tambah ke Keranjang</button>
</form>
```

**Data yang disimpan ke session:**
- `id_barang` - ID produk
- `nama_barang` - Nama produk
- `harga` - Harga satuan
- `gambar` - URL gambar
- `jumlah` - Quantity yang dipilih

## 📱 Responsive Design

**Desktop (>991px):**
- Gambar sticky di sebelah kiri
- Info produk di sebelah kanan
- Layout 2 kolom

**Tablet (768px - 991px):**
- Gambar full width di atas
- Info produk di bawah
- Layout 1 kolom

**Mobile (<576px):**
- Padding dikurangi
- Button full width
- Font size lebih kecil

## 🔄 Reusability

Komponen ini 100% reusable karena:

1. **Dynamic Content** - Semua data dari database
2. **URL Parameter** - Menggunakan GET parameter untuk ID
3. **No Hard-coded Values** - Tidak ada nilai yang di-hardcode
4. **Shared Components** - Menggunakan product-card.php untuk related products
5. **Consistent Design** - Menggunakan CSS variables yang sama

## 🚀 Contoh Penggunaan di Halaman Lain

### Di Dashboard (Featured Products):
```php
<?php
$query = "SELECT * FROM barang ORDER BY id_barang DESC LIMIT 8";
$result = mysqli_query($db, $query);
while ($product = mysqli_fetch_assoc($result)) {
    ?>
    <a href="detail_produk.php?id=<?= $product['id_barang'] ?>">
        <img src="<?= $product['gambar'] ?>">
        <h3><?= $product['nama_barang'] ?></h3>
    </a>
    <?php
}
?>
```

### Di Halaman Promo:
```php
$query = "SELECT * FROM barang WHERE harga < 20000";
// Sama seperti di atas, link ke detail_produk.php?id={id}
```

## 📝 Catatan Penting

1. **Security**: Semua input divalidasi dan di-escape dengan `mysqli_real_escape_string()` dan `htmlspecialchars()`
2. **Error Handling**: Auto-redirect jika produk tidak ditemukan
3. **Session Management**: Keranjang menggunakan PHP Session
4. **Image URLs**: Gambar disimpan sebagai URL (CDN atau path relatif)

## 🎨 Customization

### Mengubah Warna Badge:
Edit file `css/detail_produk.css`:
```css
.badge-darah {
    background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
}
```

### Mengubah Jumlah Related Products:
Edit file `detail_produk.php` line ~55:
```php
LIMIT 4  // Ubah angka ini
```

### Menambahkan Field Baru:
1. Tambahkan kolom di database
2. Update query SELECT
3. Tampilkan di HTML
4. Tambahkan styling jika perlu

---

✅ **Status**: Ready to use & fully functional
🔧 **Maintenance**: Easy to update and customize
📱 **Compatible**: All modern browsers & devices
