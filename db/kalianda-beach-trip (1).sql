-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2025 at 03:16 PM
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
  `kontak_pengelola` varchar(15) NOT NULL,
  `harga_per_orang` int(11) NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `tagline_aktivitas` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinasi_wisata`
--

INSERT INTO `destinasi_wisata` (`id_destinasi`, `nama_destinasi`, `lokasi`, `kontak_pengelola`, `harga_per_orang`, `jam_buka`, `jam_tutup`, `no_hp`, `tagline_aktivitas`, `gambar`) VALUES
(1, 'Pantai Marina', 'Kalianda, Lampung Selatan', '6285162642703', 50000, '08:00:00', '21:00:00', '085173200421', 'Family Beach, Picnic, Gathering', 'marina.jpg'),
(2, 'Senaya Beach', 'Kalianda, Lampung Selatan', '6285162642703', 35000, '08:00:00', '20:00:00', '082111111', 'CAMPING, SUNSET VIEW', 'senaya.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `role` enum('admin','wisatawan') DEFAULT 'wisatawan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `foto_profil`, `role`) VALUES
(1, 'Laila', 'laila1', 'laila1', 'laila.jpg', 'admin'),
(6, 'testestes', 'testestes', 'testestes', 'tes.png', 'wisatawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  ADD PRIMARY KEY (`id_destinasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  MODIFY `id_destinasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
