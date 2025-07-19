-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 21, 2025 at 12:00 AM
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
-- Table structure for table `k_usulan_provinsi`
--

CREATE TABLE `k_usulan_provinsi` (
  `id_usulan` int NOT NULL,
  `id_pn` int DEFAULT NULL,
  `id_pp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_kp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_prop` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_diusulkan` int NOT NULL,
  `kd_prog` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_kgiat` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_kro` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_ro` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `nama_pekerjaan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `volume` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kawasan` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lokasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_kabkot` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `anggaran` double DEFAULT NULL,
  `tahun_pelaksanaan` int NOT NULL,
  `id_pendanaan` int DEFAULT NULL,
  `justifikasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ri` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ri_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fs` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fs_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dokling` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dokling_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ded` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ded_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lahan` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lahan_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pasca_kontruksi` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pasca_kontruksi_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menerima_bantuan` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menerima_bantuan_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_tematik` int NOT NULL,
  `tahun_pengerjaan` int DEFAULT NULL,
  `catatan_unor` text NOT NULL,
  `geotag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `uraian_geotag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `FKS` int NOT NULL,
  `no_prioritas` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `k_usulan_provinsi`
--
ALTER TABLE `k_usulan_provinsi`
  ADD PRIMARY KEY (`id_usulan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `k_usulan_provinsi`
--
ALTER TABLE `k_usulan_provinsi`
  MODIFY `id_usulan` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
