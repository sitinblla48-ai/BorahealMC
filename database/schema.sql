-- Hospital Patient Registration System Schema (Indonesian Naming)
-- Fully compatible with MySQL 5.7+ and MariaDB

SET FOREIGN_KEY_CHECKS = 0;

-- Drop old incompatible tables first
DROP TABLE IF EXISTS `pendaftaran`;
DROP TABLE IF EXISTS `dokter`;
DROP TABLE IF EXISTS `pasien`;
DROP TABLE IF EXISTS `admin`;

-- 1. Create Dokter Table
CREATE TABLE `dokter` (
  `id_dokter` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_dokter` VARCHAR(100) NOT NULL,
  `spesialis` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Seed Dokter (10 required specialties)
INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialis`) VALUES
(1, 'Dr. Andi Pratama, Sp.PD', 'Internal Medicine'),
(2, 'Dr. Budi Santosa, Sp.A', 'Pediatrics'),
(3, 'Dr. Citra Lestari, Sp.OG', 'Obstetrics'),
(4, 'Dr. Dewi Sartika, Sp.M', 'Ophthalmology'),
(5, 'Dr. Eko Prasetyo, Sp.THT', 'ENT'),
(6, 'Dr. Fajar Hidayat, Sp.B', 'Surgery'),
(7, 'Dr. Gita Ningrum, Sp.S', 'Neurology'),
(8, 'Dr. Hani Wijaya, Sp.JP', 'Cardiology'),
(9, 'Dr. Indra Kusuma, Sp.KK', 'Dermatology'),
(10, 'Dr. Joko Susilo, Sp.KG', 'Dentistry');

-- 2. Create Admin Table
CREATE TABLE `admin` (
  `id_admin` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Seed Default Admin (username: admin_bora, password: admin123)
INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin_bora', '$2y$10$S.f4GvNLUIQCD.vyd58LQ.DLOFAhT8Q5ig1W02Tn0OIcFBQAktBry');

-- 3. Create Pasien Table
CREATE TABLE `pasien` (
  `id_pasien` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_lengkap` VARCHAR(100) NOT NULL,
  `tanggal_lahir` DATE NOT NULL,
  `alamat` TEXT NOT NULL,
  `no_telepon` VARCHAR(20) NOT NULL,
  `username` VARCHAR(50) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Seed Default Patient (username: pasien_budi, password: budi123)
INSERT INTO `pasien` (`id_pasien`, `nama_lengkap`, `tanggal_lahir`, `alamat`, `no_telepon`, `username`, `password`) VALUES
(1, 'Budi Santoso', '2000-05-15', 'Jl. Sudirman No. 10', '081234567890', 'pasien_budi', '$2y$10$aYU/siRGKX7gA7pw.hjNtOwBOuA5MOu4Gvyc0l157C3jYC5oft8eK');

-- 4. Create Pendaftaran Table
CREATE TABLE `pendaftaran` (
  `id_pendaftaran` INT AUTO_INCREMENT PRIMARY KEY,
  `id_pasien` INT NOT NULL,
  `nama_lengkap` VARCHAR(100) NOT NULL,
  `tanggal_lahir` DATE NOT NULL,
  `alamat` TEXT NOT NULL,
  `no_telepon` VARCHAR(20) NOT NULL,
  `keluhan` TEXT NOT NULL,
  `tanggal_kunjungan` DATE NOT NULL,
  `jam_kunjungan` TIME NOT NULL,
  `id_dokter` INT NOT NULL,
  `status_pendaftaran` ENUM('Pending', 'Disetujui', 'Ditolak') DEFAULT 'Pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE,
  FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
