-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 07:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek`
--

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kota`, `tarif`) VALUES
(1, 'Jabodetabek', 25000),
(2, 'Kalimantan', 40000),
(3, 'Jawa Timur', 10000),
(4, 'Jawa Tengah', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `pw_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `pw_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(1, 'faizal@gmail.com', 'faizal01', 'Faizal Dwi Saputra', '081391147864'),
(3, 'testing01@gmail.com', 'faizal01', 'Faizal Dwi Saputra', '986864511'),
(4, 'ulin@gmail.com', '8888', 'linxaaa', '082243144930');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 7, 'Manwear', 'Bank BRI', 312000, '2024-06-26', 'ulin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `status_pembayaran` varchar(100) NOT NULL DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `kota`, `tarif`, `alamat`, `status_pembayaran`) VALUES
(7, 1, 4, '2024-06-26', 312000, 'Jawa Tengah', 12000, 'JLN Surakarta UMS (123123)', 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`) VALUES
(1, 7, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(1, 'Kaos Polos (Hitam)', 75000, 300, 'kaos2.png', 'Kaos Polos kami adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari 100% katun premium, kaos ini menawarkan kelembutan dan kenyamanan yang tak tertandingi. Desainnya yang sederhana membuatnya mudah dipadukan dengan berbagai jenis pakaian dan aksesori, menjadikannya pilihan yang fleksibel untuk berbagai kesempatan.', '96'),
(2, 'Kaos Polos (Pink) Oversize', 90000, 310, 'kaos3.png', 'Kaos Polos Oversize adalah pilihan sempurna bagi Anda yang mencari kenyamanan dan gaya dalam satu paket. Dibuat dari bahan katun berkualitas tinggi, kaos ini menawarkan kelembutan dan kenyamanan sepanjang hari. Desain oversize memberikan tampilan yang kasual dan trendi, cocok untuk berbagai kesempatan santai.', '200'),
(3, 'Kaos Polos (Biru)', 75000, 300, 'kaos1.png', 'Kaos Polos kami adalah pilihan sempurna untuk gaya santai dan nyaman sehari-hari. Terbuat dari 100% katun premium, kaos ini menawarkan kelembutan dan kenyamanan yang tak tertandingi. Desainnya yang sederhana membuatnya mudah dipadukan dengan berbagai jenis pakaian dan aksesori, menjadikannya pilihan yang fleksibel untuk berbagai kesempatan.', '100');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_admin`
--

CREATE TABLE `tabel_admin` (
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pw` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_admin`
--

INSERT INTO `tabel_admin` (`email`, `username`, `pw`) VALUES
('admin1@gmail.com', 'admin', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tabel_admin`
--
ALTER TABLE `tabel_admin`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
