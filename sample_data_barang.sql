-- Sample Data untuk tabel barang
-- Jalankan query ini untuk menambahkan data contoh produk
-- Kolom `gambar` bertipe VARCHAR(255) - menyimpan URL/path gambar

INSERT INTO `barang` (`nama_barang`, `harga`, `deskripsi`, `gambar`) VALUES
('Paracetamol 500mg', '15000', 'Obat pereda demam dan nyeri. Dosis 500mg per tablet. Aman untuk dewasa dan anak-anak di atas 12 tahun.', 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop'),
('Vitamin C 1000mg', '45000', 'Suplemen vitamin C dosis tinggi untuk meningkatkan daya tahan tubuh. Cocok dikonsumsi setiap hari.', 'https://images.unsplash.com/photo-1616671276441-2f2c277b8bf6?w=400&h=400&fit=crop'),
('Obat Batuk Herbal', '35000', 'Sirup obat batuk dari bahan herbal alami. Meredakan batuk berdahak dan kering. Kemasan 100ml.', 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400&h=400&fit=crop'),
('Minyak Kayu Putih', '18000', 'Minyak kayu putih asli untuk menghangatkan badan, meredakan masuk angin, dan perut kembung.', 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=400&h=400&fit=crop'),
('Plester Luka Steril', '12000', 'Plester luka steril berbagai ukuran. Isi 10 pcs. Anti air dan breathable.', 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=400&h=400&fit=crop'),
('Hand Sanitizer 100ml', '25000', 'Hand sanitizer dengan kandungan alkohol 70%. Membunuh 99.9% kuman dan bakteri.', 'https://images.unsplash.com/photo-1584744982491-665216d95f8b?w=400&h=400&fit=crop'),
('Masker Medis 3 Ply', '28000', 'Masker medis 3 lapis earloop. Isi 50 pcs per box. Standar medis.', 'https://images.unsplash.com/photo-1584634731339-252c581abfc5?w=400&h=400&fit=crop'),
('Thermometer Digital', '65000', 'Thermometer digital akurat dan cepat. Hasil dalam 10 detik. LCD display.', 'https://images.unsplash.com/photo-1584483766114-2cea6facdf57?w=400&h=400&fit=crop'),
('Vitamin B Complex', '38000', 'Suplemen vitamin B kompleks untuk metabolisme energi dan kesehatan saraf.', 'https://images.unsplash.com/photo-1550572017-edd951aa8f72?w=400&h=400&fit=crop'),
('Obat Maag Antasida', '22000', 'Obat maag untuk meredakan gejala maag, heartburn, dan gangguan pencernaan.', 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&h=400&fit=crop'),
('Salep Luka Bakar', '32000', 'Salep untuk pertolongan pertama luka bakar ringan. Mempercepat penyembuhan.', 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400&h=400&fit=crop'),
('Koyo Pereda Nyeri', '19000', 'Koyo hangat untuk meredakan nyeri otot dan sendi. Isi 5 lembar.', 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400&h=400&fit=crop');

-- Query untuk melihat semua produk
-- SELECT * FROM barang ORDER BY id_barang DESC;

-- Query untuk melihat produk berdasarkan harga
-- SELECT * FROM barang WHERE harga >= 20000 ORDER BY harga ASC;

-- Query untuk mencari produk
-- SELECT * FROM barang WHERE nama_barang LIKE '%vitamin%' OR deskripsi LIKE '%vitamin%';
