-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2026 at 05:01 AM
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
-- Database: `db_boraheal_rs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `created_at`) VALUES
(1, 'admin_bora', '$2y$10$S.f4GvNLUIQCD.vyd58LQ.DLOFAhT8Q5ig1W02Tn0OIcFBQAktBry', '2026-06-21 17:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `spesialis` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `created_at`) VALUES
(1, 'Dr. Andi Pratama, Sp.PD', 'Internal Medicine', '2026-06-21 17:52:01'),
(2, 'Dr. Budi Santosa, Sp.A', 'Pediatrics', '2026-06-21 17:52:01'),
(3, 'Dr. Citra Lestari, Sp.OG', 'Obstetrics', '2026-06-21 17:52:01'),
(4, 'Dr. Dewi Sartika, Sp.M', 'Ophthalmology', '2026-06-21 17:52:01'),
(5, 'Dr. Eko Prasetyo, Sp.THT', 'ENT', '2026-06-21 17:52:01'),
(6, 'Dr. Fajar Hidayat, Sp.B', 'Surgery', '2026-06-21 17:52:01'),
(7, 'Dr. Gita Ningrum, Sp.S', 'Neurology', '2026-06-21 17:52:01'),
(8, 'Dr. Hani Wijaya, Sp.JP', 'Cardiology', '2026-06-21 17:52:01'),
(9, 'Dr. Indra Kusuma, Sp.KK', 'Dermatology', '2026-06-21 17:52:01'),
(10, 'Dr. Joko Susilo, Sp.KG', 'Dentistry', '2026-06-21 17:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_lengkap`, `tanggal_lahir`, `alamat`, `no_telepon`, `username`, `password`, `created_at`) VALUES
(1, 'Budi Santoso', '2000-05-15', 'Jl. Sudirman No. 10', '081234567890', 'pasien_budi', '$2y$10$aYU/siRGKX7gA7pw.hjNtOwBOuA5MOu4Gvyc0l157C3jYC5oft8eK', '2026-06-21 17:52:01'),
(2, 'Apip suhendi', '2011-06-09', 'lalalal', '9876272828', 'apip', '$2y$10$jAid0yjRFRnfJOuABZx50.M1oDtTIl.6cBTP8oaOLt2lUye1Twimi', '2026-06-21 18:01:36'),
(3, 'Laura Kinanti', '2008-08-06', 'Jalan Maroko', '098998789625', 'Laurakinanti2', '$2y$10$Rd3x4mqGDKOkpylm7zts0.QC5P9Eoz6v0oGhiCitWYDraPnFKgt.m', '2026-06-23 02:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `keluhan` text NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `jam_kunjungan` time NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `status_pendaftaran` enum('Pending','Disetujui','Ditolak') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_pasien`, `nama_lengkap`, `tanggal_lahir`, `alamat`, `no_telepon`, `keluhan`, `tanggal_kunjungan`, `jam_kunjungan`, `id_dokter`, `status_pendaftaran`, `created_at`) VALUES
(1, 1, 'Budi Santoso', '2000-05-15', 'Jl. Sudirman No. 10', '081234567890', 'llalal', '2026-06-23', '14:00:00', 6, 'Disetujui', '2026-06-21 17:57:33'),
(2, 2, 'Apip suhendi', '2011-06-09', 'lalalal', '9876272828', 'ghgg', '2026-06-26', '13:00:00', 1, 'Ditolak', '2026-06-21 18:02:35'),
(5, 2, 'Apip suhendi', '2011-06-09', 'lalalal', '9876272828', 'jdjdj', '2026-06-29', '12:08:00', 7, 'Disetujui', '2026-06-21 18:22:59'),
(9, 3, 'Laura Kinanti', '2008-08-06', 'Jalan Maroko', '098998789625', 'Sakit Dalam', '2026-06-29', '15:00:00', 9, 'Disetujui', '2026-06-23 02:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `specialists`
--

CREATE TABLE `specialists` (
  `id_specialist` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specialists`
--

INSERT INTO `specialists` (`id_specialist`, `name`, `created_at`) VALUES
(1, 'Internal Medicine', '2026-06-21 16:14:08'),
(2, 'Pediatrics', '2026-06-21 16:14:08'),
(3, 'Obstetrics', '2026-06-21 16:14:08'),
(4, 'Ophthalmology', '2026-06-21 16:14:08'),
(5, 'ENT', '2026-06-21 16:14:08'),
(6, 'Surgery', '2026-06-21 16:14:08'),
(7, 'Neurology', '2026-06-21 16:14:08'),
(8, 'Cardiology', '2026-06-21 16:14:08'),
(9, 'Dermatology', '2026-06-21 16:14:08'),
(10, 'Dentistry', '2026-06-21 16:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pasien') NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`, `last_login`) VALUES
(1, 'admin_bora', 'admin123', 'admin', '2026-06-17 09:52:59'),
(2, 'pasien_budi', 'budi123', 'pasien', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `specialists`
--
ALTER TABLE `specialists`
  ADD PRIMARY KEY (`id_specialist`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `specialists`
--
ALTER TABLE `specialists`
  MODIFY `id_specialist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
