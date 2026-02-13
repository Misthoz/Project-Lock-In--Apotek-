-- Sample Data untuk tabel barang
-- Jalankan query ini untuk menambahkan data contoh produk

INSERT INTO `barang` (`nama_barang`, `harga`, `deskripsi`, `gambar`) VALUES
('Paracetamol 500mg', '15000', 'Obat pereda demam dan nyeri. Dosis 500mg per tablet. Aman untuk dewasa dan anak-anak di atas 12 tahun.', ''),
('Vitamin C 1000mg', '45000', 'Suplemen vitamin C dosis tinggi untuk meningkatkan daya tahan tubuh. Cocok dikonsumsi setiap hari.', ''),
('Obat Batuk Herbal', '35000', 'Sirup obat batuk dari bahan herbal alami. Meredakan batuk berdahak dan kering. Kemasan 100ml.', ''),
('Minyak Kayu Putih', '18000', 'Minyak kayu putih asli untuk menghangatkan badan, meredakan masuk angin, dan perut kembung.', ''),
('Plester Luka Steril', '12000', 'Plester luka steril berbagai ukuran. Isi 10 pcs. Anti air dan breathable.', ''),
('Hand Sanitizer 100ml', '25000', 'Hand sanitizer dengan kandungan alkohol 70%. Membunuh 99.9% kuman dan bakteri.', ''),
('Masker Medis 3 Ply', '28000', 'Masker medis 3 lapis earloop. Isi 50 pcs per box. Standar medis.', ''),
('Thermometer Digital', '65000', 'Thermometer digital akurat dan cepat. Hasil dalam 10 detik. LCD display.', ''),
('Vitamin B Complex', '38000', 'Suplemen vitamin B kompleks untuk metabolisme energi dan kesehatan saraf.', ''),
('Obat Maag Antasida', '22000', 'Obat maag untuk meredakan gejala maag, heartburn, dan gangguan pencernaan.', ''),
('Salep Luka Bakar', '32000', 'Salep untuk pertolongan pertama luka bakar ringan. Mempercepat penyembuhan.', ''),
('Koyo Pereda Nyeri', '19000', 'Koyo hangat untuk meredakan nyeri otot dan sendi. Isi 5 lembar.', '');

-- Query untuk melihat semua produk
-- SELECT * FROM barang ORDER BY id_barang DESC;

-- Query untuk melihat produk berdasarkan harga
-- SELECT * FROM barang WHERE harga >= 20000 ORDER BY harga ASC;

-- Query untuk mencari produk
-- SELECT * FROM barang WHERE nama_barang LIKE '%vitamin%' OR deskripsi LIKE '%vitamin%';
