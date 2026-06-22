-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 07:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ci3`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `no_anggota` varchar(10) NOT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `no_anggota`, `nama_anggota`, `alamat`, `telepon`, `email`, `tanggal`, `status`) VALUES
(1, 'A001', 'Agnez Mo', 'Jakarta', '0812342001', 'agnezmo@gmail.com', '2025-12-02', 'Aktif'),
(2, 'A002', 'Bunga Citra Lestari', 'Jakarta', '0812342002', 'bcl@gmail.com', '2025-11-18', 'Nonaktif'),
(3, 'A003', 'Dian Sastrowardoyo', 'Jakarta', '0812342003', 'dian@gmail.com', '2025-10-25', 'Aktif'),
(4, 'A004', 'Reza Rahadian', 'Jakarta', '0812342004', 'reza@gmail.com', '2025-09-12', 'Aktif'),
(5, 'A005', 'Jeon Jungkook', 'Seoul', '0812342005', 'jungkook@gmail.com', '2025-08-09', 'Aktif'),
(6, 'A006', 'Kim Taehyung', 'Daegu', '0812342006', 'taehyung@gmail.com', '2025-07-14', 'Aktif'),
(7, 'A007', 'Lalisa Manoban', 'Bangkok', '0812342007', 'lisa@gmail.com', '2025-06-28', 'Aktif'),
(8, 'A008', 'Zendaya', 'Los Angeles', '0812342008', 'zendaya@gmail.com', '2025-05-30', 'Aktif'),
(9, 'A009', 'Tom Holland', 'London', '0812342009', 'tomholland@gmail.com', '2025-04-22', 'Nonaktif'),
(10, 'A010', 'Cha Eun Woo', 'Gunpo', '0812342010', 'eunwoo@gmail.com', '2025-03-15', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_anggota` (`no_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
