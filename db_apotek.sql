-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2026 at 01:01 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_barang` enum('darah','herbal','kepala','tubuh') COLLATE utf8mb4_general_ci NOT NULL,
  `harga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `jenis_barang`, `harga`, `deskripsi`, `gambar`) VALUES
(1, 'Paracetamol 500mg', 'tubuh', '15000', 'Obat pereda demam dan nyeri. Dosis 500mg per tablet. Aman untuk dewasa dan anak-anak di atas 12 tahun.', 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop'),
(2, 'Sangobion Strip 10 kapsul', 'darah', '10000', 'Sangobion adalah obat darah', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//84/MTA-2191224/sangobion_sangobion-kapsul--10-kapsul-strips-_full04.jpg'),
(3, 'Bodrex Extra', 'kepala', '3000', 'Bodrex Adalah obat sakit kepala', 'https://d3bbrrd0qs69m4.cloudfront.net/images/product/apotek_online_k24klik_20230308113005359225_BODREX-EXTRA.png'),
(4, 'Madu SJ', 'herbal', '50000', 'Ini adalah madu', 'https://d3bbrrd0qs69m4.cloudfront.net/images/product/apotek_online_k24klik_20230120023611359225_MADU-TJ-MURNI-1.png'),
(5, 'Promag', 'tubuh', '2000', 'ini adalah promag', 'https://d3bbrrd0qs69m4.cloudfront.net/images/product/apotek_online_k24klik_2021101902504923085_Promag-Tablet-10s-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_detail`, `id_pemesanan`, `id_barang`, `jumlah`, `harga_satuan`) VALUES
(1, 1, 1, 2, '15000'),
(2, 2, 1, 2, '15000'),
(3, 3, 1, 1, '15000'),
(4, 4, 1, 1, '15000'),
(5, 5, 1, 3, '15000'),
(6, 6, 1, 1, '15000'),
(7, 7, 1, 2, '15000'),
(8, 8, 5, 1, '2000'),
(9, 8, 4, 1, '50000'),
(10, 8, 3, 1, '3000'),
(11, 8, 2, 1, '10000');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int NOT NULL,
  `id_user` int NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `metode_pembayaran` enum('ewallet','cod') NOT NULL,
  `status` enum('menunggu','diproses','siap_diambil','selesai','dibatalkan') NOT NULL,
  `total_harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_user`, `tanggal_pesan`, `metode_pembayaran`, `status`, `total_harga`) VALUES
(1, 3, '2026-02-14 00:58:24', 'ewallet', 'menunggu', '30000'),
(2, 4, '2026-02-14 01:06:18', 'ewallet', 'menunggu', '30000'),
(3, 5, '2026-02-14 09:00:19', 'ewallet', 'menunggu', '15000'),
(4, 6, '2026-02-14 10:11:57', 'ewallet', 'menunggu', '15000'),
(5, 7, '2026-02-14 10:14:34', 'cod', 'menunggu', '45000'),
(6, 8, '2026-02-14 10:20:28', 'cod', 'menunggu', '15000'),
(7, 9, '2026-02-14 22:07:47', 'cod', 'menunggu', '30000'),
(8, 10, '2026-02-14 23:22:02', 'ewallet', 'menunggu', '65000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `umur` int NOT NULL,
  `no_hp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `umur`, `no_hp`) VALUES
(2, 'dapa', 15, '08123456789'),
(3, 'dapa', 15, '08123456789'),
(4, 'fawwaz', 17, '08123456789'),
(5, 'Maulid', 18, '08123456789'),
(6, 'Dewa', 16, '080987654321'),
(7, 'gilang', 17, '089977665544'),
(8, 'Adlan', 17, '085544332211'),
(9, 'Finn Seville', 20, '081348962272'),
(10, 'Finn Seville', 26, '081348962272');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
