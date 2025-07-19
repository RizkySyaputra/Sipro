-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 18, 2025 at 10:29 AM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipro2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `k_kegiatan_baru_temp_api`
--

CREATE TABLE `k_kegiatan_baru_temp_api` (
  `id_fkb` varchar(30) NOT NULL,
  `id_sumber` varchar(255) DEFAULT NULL,
  `sumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_diusulkan` year DEFAULT NULL,
  `kd_prog` varchar(255) DEFAULT NULL,
  `kd_kgiat` varchar(255) DEFAULT NULL,
  `kd_kro` varchar(255) DEFAULT NULL,
  `kd_ro` varchar(255) DEFAULT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `volume` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kawasan` varchar(20) DEFAULT NULL,
  `id_kabkot` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `anggaran` bigint DEFAULT NULL,
  `tahun_pelaksanaan` year DEFAULT NULL,
  `id_pembiayaan` int DEFAULT NULL,
  `catatan` text,
  `renc_induk` varchar(255) DEFAULT NULL,
  `dok_renc_induk` varchar(255) DEFAULT NULL,
  `fs` varchar(255) DEFAULT NULL,
  `dok_fs` varchar(255) DEFAULT NULL,
  `ded` varchar(255) DEFAULT NULL,
  `dok_ded` varchar(255) DEFAULT NULL,
  `dokling` varchar(255) DEFAULT NULL,
  `dok_dokling` varchar(255) DEFAULT NULL,
  `lahan` varchar(255) DEFAULT NULL,
  `dok_lahan` varchar(255) DEFAULT NULL,
  `pasca_kons` varchar(255) DEFAULT NULL,
  `dok_pasca_kons` varchar(255) DEFAULT NULL,
  `terima_bantuan` varchar(255) DEFAULT NULL,
  `dok_terima_bantuan` varchar(255) DEFAULT NULL,
  `id_tematik` int DEFAULT NULL,
  `geotag` json DEFAULT NULL,
  `uraian_geotag` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `k_kegiatan_baru_temp_api`
--
-- --------------------------------------------------------

--
-- Table structure for table `k_kegiatan_wajib_temp_api`
--

CREATE TABLE `k_kegiatan_wajib_temp_api` (
  `id_fkw` varchar(30) NOT NULL,
  `id_sumber` varchar(225) DEFAULT NULL,
  `sumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_diusulkan` int DEFAULT NULL,
  `kd_prog` varchar(255) DEFAULT NULL,
  `kd_kgiat` varchar(255) DEFAULT NULL,
  `kd_kro` varchar(255) DEFAULT NULL,
  `kd_ro` varchar(255) DEFAULT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `pekerjaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `volume` float DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `kode_kabkot` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `rpm` int DEFAULT NULL,
  `phln` int DEFAULT NULL,
  `sbsn` int DEFAULT NULL,
  `anggaran` bigint DEFAULT NULL,
  `waktu_pelaksanaan` int DEFAULT NULL,
  `id_pembiayaan` int DEFAULT NULL,
  `catatan` text,
  `id_tematik` int DEFAULT NULL,
  `geotag` json DEFAULT NULL,
  `uraian_geotag` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `k_kegiatan_wajib_temp_api`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `k_kegiatan_baru_temp_api`
--
ALTER TABLE `k_kegiatan_baru_temp_api`
  ADD PRIMARY KEY (`id_fkb`);

--
-- Indexes for table `k_kegiatan_wajib_temp_api`
--
ALTER TABLE `k_kegiatan_wajib_temp_api`
  ADD PRIMARY KEY (`id_fkw`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
