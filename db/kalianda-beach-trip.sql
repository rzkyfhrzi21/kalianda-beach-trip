-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2025 at 04:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalianda-beach-trip`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinasi_wisata`
--

CREATE TABLE `destinasi_wisata` (
  `id_destinasi` int(11) NOT NULL,
  `nama_destinasi` varchar(150) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `harga_per_orang` int(11) NOT NULL,
  `jam_buka` varchar(60) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `tagline_aktivitas` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_wisata`
--

CREATE TABLE `transaksi_wisata` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_destinasi` int(11) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `nama_pemesan` varchar(120) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `status` enum('menunggu','diproses','dibayar','selesai','dibatalkan') DEFAULT 'menunggu',
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `no_hp` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `role` enum('admin','wisatawan') DEFAULT 'wisatawan',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  `diubah_pada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `email`, `no_hp`, `password`, `foto_profil`, `jenis_kelamin`, `role`, `dibuat_pada`, `diubah_pada`) VALUES
(1, 'Laila', 'laila1', 'lailanurmasv@gmail.com', '085162642703', 'laila1', 'user_69509cdaac2f4.png', 'Perempuan', 'admin', '2025-12-28 01:26:52', '2025-12-28 03:03:06'),
(2, 'Rizky Fahrezi', 'rizky666', 'rizky01011991@gmail.com', '082279731305', 'rizky666', 'user_6950a286ecb15.png', 'Laki-laki', 'wisatawan', '2025-12-28 03:22:47', '2025-12-28 03:31:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  ADD PRIMARY KEY (`id_destinasi`);

--
-- Indexes for table `transaksi_wisata`
--
ALTER TABLE `transaksi_wisata`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_destinasi` (`id_destinasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  MODIFY `id_destinasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_wisata`
--
ALTER TABLE `transaksi_wisata`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi_wisata`
--
ALTER TABLE `transaksi_wisata`
  ADD CONSTRAINT `transaksi_wisata_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_wisata_ibfk_2` FOREIGN KEY (`id_destinasi`) REFERENCES `destinasi_wisata` (`id_destinasi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
