-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 02, 2026 at 12:09 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartstock_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `harga_saham`
--

CREATE TABLE `harga_saham` (
  `id` int NOT NULL,
  `saham_id` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insight_log`
--

CREATE TABLE `insight_log` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `nilai_portofolio` decimal(12,2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `insight_log`
--

INSERT INTO `insight_log` (`id`, `user_id`, `nilai_portofolio`, `tanggal`) VALUES
(1, 1, 150000.00, '2025-01-01'),
(2, 1, 165000.00, '2025-01-03'),
(3, 1, 172000.00, '2025-01-05'),
(4, 1, 168000.00, '2025-01-07'),
(5, 1, 180500.00, '2025-01-10'),
(6, 1, 195000.00, '2025-01-13'),
(7, 1, 210000.00, '2025-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_history`
--

CREATE TABLE `portfolio_history` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tanggal` date NOT NULL,
  `total_nilai` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portofolio`
--

CREATE TABLE `portofolio` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `saham_id` int NOT NULL,
  `jumlah_lot` int NOT NULL,
  `harga_beli` decimal(12,2) NOT NULL,
  `tanggal_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `portofolio`
--

INSERT INTO `portofolio` (`id`, `user_id`, `saham_id`, `jumlah_lot`, `harga_beli`, `tanggal_beli`) VALUES
(5, 1, 1, 10, 9200.00, '2025-01-01'),
(6, 1, 2, 15, 4100.00, '2025-01-03'),
(7, 1, 3, 20, 2500.00, '2025-01-06'),
(8, 1, 4, 12, 1800.00, '2025-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `saham`
--

CREATE TABLE `saham` (
  `id` int NOT NULL,
  `kode_saham` varchar(10) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `sektor` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `saham`
--

INSERT INTO `saham` (`id`, `kode_saham`, `nama_perusahaan`, `sektor`, `created_at`) VALUES
(1, 'BBCA', 'Bank Central Asia', NULL, '2026-01-01 23:43:00'),
(2, 'TLKM', 'Telkom Indonesia', NULL, '2026-01-01 23:43:00'),
(3, 'BRIS', 'Bank Syariah Indonesia', NULL, '2026-01-01 23:43:00'),
(4, 'ANTM', 'Aneka Tambang', NULL, '2026-01-01 23:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `saham_id` int NOT NULL,
  `jenis` enum('beli','jual') NOT NULL,
  `jumlah_lot` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `saham_id`, `jenis`, `jumlah_lot`, `harga`, `tanggal`) VALUES
(7, 1, 1, 'beli', 10, 9200.00, '2025-01-01'),
(8, 1, 2, 'beli', 15, 4100.00, '2025-01-03'),
(9, 1, 3, 'beli', 20, 2500.00, '2025-01-06'),
(10, 1, 1, 'jual', 5, 9500.00, '2025-01-12'),
(11, 1, 4, 'beli', 12, 1800.00, '2025-01-15'),
(12, 1, 2, 'jual', 5, 4300.00, '2025-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','investor') DEFAULT 'investor',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Erfyan', 'erfyanjr@gmail.com', '$2y$10$Ln3jfi6XsoTCEoZrUWjXau5sCx8W43Gg56zA1y2uRKDoaU0gpfYUi', 'investor', '2025-12-30 14:10:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harga_saham`
--
ALTER TABLE `harga_saham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saham_id` (`saham_id`);

--
-- Indexes for table `insight_log`
--
ALTER TABLE `insight_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_history`
--
ALTER TABLE `portfolio_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `saham_id` (`saham_id`);

--
-- Indexes for table `saham`
--
ALTER TABLE `saham`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_saham` (`kode_saham`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `saham_id` (`saham_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harga_saham`
--
ALTER TABLE `harga_saham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insight_log`
--
ALTER TABLE `insight_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `portfolio_history`
--
ALTER TABLE `portfolio_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `saham`
--
ALTER TABLE `saham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `harga_saham`
--
ALTER TABLE `harga_saham`
  ADD CONSTRAINT `harga_saham_ibfk_1` FOREIGN KEY (`saham_id`) REFERENCES `saham` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD CONSTRAINT `portofolio_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `portofolio_ibfk_2` FOREIGN KEY (`saham_id`) REFERENCES `saham` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`saham_id`) REFERENCES `saham` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
