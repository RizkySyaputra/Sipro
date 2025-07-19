-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 07, 2025 at 11:01 PM
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
-- Table structure for table `k_pro_p`
--

CREATE TABLE `k_pro_p` (
  `id` int NOT NULL,
  `id_prop` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_kp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_prop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_prog` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kd_kgiat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kd_kro` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kd_ro` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `k_pro_p`
--

INSERT INTO `k_pro_p` (`id`, `id_prop`, `id_kp`, `nama_prop`, `kd_prog`, `kd_kgiat`, `kd_kro`, `kd_ro`) VALUES
(1, '02.12.09.01', '02.12.09', 'Pengendalian Daya Rusak Air', 'FC', 'FC.7692', 'FC.7692.RBH', 'FC.7692.RBH.003'),
(2, '02.12.09.01', '02.12.09', 'Pengendalian Daya Rusak Air', 'FC', 'FC.7692', 'FC.7692.RBS', 'FC.7692.RBS.002'),
(3, '02.12.09.02', '02.12.09', 'Penyediaan Air Baku dan Air Minum', 'FC', 'FC.7694', 'FC.7694.RBS', 'FC.7694.RBS.005'),
(4, '02.12.09.03', '02.12.09', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.001'),
(5, '02.12.09.03', '02.12.09', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.002'),
(6, '02.12.09.03', '02.12.09', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.005'),
(7, '02.12.09.03', '02.12.09', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.006'),
(8, '02.12.09.04', '02.12.09', 'Pemantauan Penurunan Muka Tanah', '', '', '', ''),
(9, '02.12.09.05', '02.12.09', 'Peningkatan Kualitas Lingkungan Hidup', '', '', '', ''),
(10, '02.12.09.06', '02.12.09', 'Pengembangan Kawasan', '', '', '', ''),
(11, '02.10.01.01', '02.10.01', 'Geospasial KSPP/Lumbung Pangan Kalimantan Tengah', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.007'),
(12, '02.10.01.01', '02.10.01', 'Geospasial KSPP/Lumbung Pangan Kalimantan Tengah', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.006'),
(13, '02.10.01.01', '02.10.01', 'Geospasial KSPP/Lumbung Pangan Kalimantan Tengah', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.007'),
(14, '02.10.01.01', '02.10.01', 'Geospasial KSPP/Lumbung Pangan Kalimantan Tengah', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.007'),
(15, '02.10.03.01', '02.10.03', 'Geospasial KSPP/Lumbung Pangan Sumatera Selatan', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.009'),
(16, '02.10.03.01', '02.10.03', 'Geospasial KSPP/Lumbung Pangan Sumatera Selatan', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.008'),
(17, '02.10.03.01', '02.10.03', 'Geospasial KSPP/Lumbung Pangan Sumatera Selatan', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.009'),
(18, '02.10.03.01', '02.10.03', 'Geospasial KSPP/Lumbung Pangan Sumatera Selatan', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.009'),
(19, '02.10.06.01', '02.10.06', 'Geospasial KSPP/Lumbung Pangan Papua Selatan', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.012'),
(20, '02.10.06.01', '02.10.06', 'Geospasial KSPP/Lumbung Pangan Papua Selatan', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.011'),
(21, '02.10.06.01', '02.10.06', 'Geospasial KSPP/Lumbung Pangan Papua Selatan', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.012'),
(22, '02.10.06.01', '02.10.06', 'Geospasial KSPP/Lumbung Pangan Papua Selatan', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.023'),
(23, '02.10.07.03', '02.10.07', 'Infrastruktur Pendukung KSPP/Lumbung Pangan Lainnya', 'FC', 'FC.7691', 'FC.7691.RBS', 'FC.7691.RBS.004'),
(24, '02.10.11.01', '02.10.11', 'Input dan Pendukung Pengembangan Pangan Lokal dan Nabati', '', '', '', ''),
(25, '02.12.04.01', '02.12.04', 'Perlindungan dan Pelestarian Sumber Air', '', '', '', ''),
(26, '02.12.04.02', '02.12.04', 'Pengawetan Air', '', '', '', ''),
(27, '02.12.04.03', '02.12.04', 'Peningkatan Kapasitas, Kelembagaan, Data, dan Informasi', '', '', '', ''),
(28, '02.12.04.05', '02.12.04', 'Penyelamatan Mata Air Kritis', '', '', '', ''),
(29, '02.12.04.06', '02.12.04', 'Pengendalian Pencemaran dan Pengelolaan Kualitas Air', '', '', '', ''),
(30, '02.12.05.01', '02.12.05', 'Pengembangan SPAM', 'IA', 'IA.7714', 'IA.7714.RBB', 'IA.7714.RBB.001'),
(31, '02.12.05.01', '02.12.05', 'Pengembangan SPAM', 'IA', 'IA.7714', 'IA.7714.RBB', 'IA.7714.RBB.002'),
(32, '02.12.05.01', '02.12.05', 'Pengembangan SPAM', 'IA', 'IA.7714', 'IA.7714.RBB', 'IA.7714.RBB.003'),
(33, '02.12.05.01', '02.12.05', 'Pengembangan SPAM', 'IA', 'IA.7714', 'IA.7714.RBB', 'IA.7714.RBB.006'),
(34, '02.12.05.02', '02.12.05', 'Pengelolaan SPAM', 'IA', '', '', ''),
(35, '02.12.05.03', '02.12.05', 'Pengawasan Kualitas Air Minum\r', 'IA', '', '', ''),
(36, '02.12.06.01', '02.12.06', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik Terpusat', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.001'),
(37, '02.12.06.01', '02.12.06', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik Terpusat', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.004'),
(38, '02.12.06.01', '02.12.06', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik Terpusat', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.007'),
(39, '02.12.06.02', '02.12.06', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik Setempat', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.002'),
(40, '02.12.06.02', '02.12.06', 'Pembangunan Sistem Pengelolaan Air Limbah Domestik Setempat', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.003'),
(41, '02.12.06.03', '02.12.06', 'Peningkatan, Optimalisasi, dan Rehabilitasi Sistem Pengelolaan Air Limbah Domestik', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.005'),
(42, '02.12.06.03', '02.12.06', 'Peningkatan, Optimalisasi, dan Rehabilitasi Sistem Pengelolaan Air Limbah Domestik', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.006'),
(43, '02.12.06.04', '02.12.06', 'Pemantauan dan Inspeksi Kualitas Sistem Pengelolaan Air Limbah Domestik', '', '', '', ''),
(44, '02.12.06.05', '02.12.06', 'Pengembangan Manajemen Layanan Sanitasi (Air Limbah Domestik)', 'IA', 'IA.7715', 'IA.7715.UBA', 'IA.7715.UBA.003'),
(45, '02.18.02.01', '02.18.02', 'Penyediaan dan Optimalisasi Fasilitas Pengolahan Sampah', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.008'),
(46, '02.18.02.01', '02.18.02', 'Penyediaan dan Optimalisasi Fasilitas Pengolahan Sampah', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.009'),
(47, '02.18.02.01', '02.18.02', 'Penyediaan dan Optimalisasi Fasilitas Pengolahan Sampah', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.010'),
(48, '02.18.02.01', '02.18.02', 'Penyediaan dan Optimalisasi Fasilitas Pengolahan Sampah', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.011'),
(49, '02.18.02.01', '02.18.02', 'Penyediaan dan Optimalisasi Fasilitas Pengolahan Sampah', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.012'),
(50, '02.18.02.01', '02.18.02', 'Penyediaan dan Optimalisasi Fasilitas Pengolahan Sampah', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.013'),
(51, '02.18.02.02', '02.18.02', 'Pembinaan dan Pengawasan Teknis Pengumpulan dan Pengangkutan Sampah', 'IA', 'IA.7715', 'IA.7715.PFA', 'IA.7715.PFA.002'),
(52, '02.18.02.03', '02.18.02', 'Pembinaan dan Pengawasan TPA Sanitary Landfill', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.011'),
(53, '02.18.02.03', '02.18.02', 'Pembinaan dan Pengawasan TPA Sanitary Landfill', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.013'),
(54, '02.18.02.04', '02.18.02', 'Pengelolaan Sampah Laut di Wilayah Pesisir dan Pulau-Pulau Kecil', '', '', '', ''),
(55, '02.18.02.05', '02.18.02', 'Penanganan Sampah dari Badan Air', '', '', '', ''),
(56, '03.05.01.001', '03.05.01', 'Aksesibilitas Pariwisata Borobudur-Yogyakarta-Prambanan', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.019'),
(57, '03.05.01.001', '03.05.01', 'Aksesibilitas Pariwisata Borobudur-Yogyakarta-Prambanan', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.018'),
(58, '03.05.01.001', '03.05.01', 'Aksesibilitas Pariwisata Borobudur-Yogyakarta-Prambanan', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.019'),
(59, '03.05.01.001', '03.05.01', 'Aksesibilitas Pariwisata Borobudur-Yogyakarta-Prambanan', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.024'),
(60, '03.05.01.003', '03.05.01', 'Pembangunan Prasarana Umum, Fasilitas Umum, dan Amenitas Penunjang Pariwisata Borobudur-Yogyakarta-Prambanan', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.004'),
(61, '03.05.05.001', '03.05.05', 'Aksesibilitas Pariwisata Lombok-Gili-Tramena', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.013'),
(62, '03.05.05.001', '03.05.05', 'Aksesibilitas Pariwisata Lombok-Gili-Tramena', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.012'),
(63, '03.05.05.001', '03.05.05', 'Aksesibilitas Pariwisata Lombok-Gili-Tramena', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.013'),
(64, '03.05.05.001', '03.05.05', 'Aksesibilitas Pariwisata Lombok-Gili-Tramena', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.013'),
(65, '03.05.05.003', '03.05.05', 'Pembangunan Prasarana Umum, Fasilitas Umum, dan Amenitas Penunjang Pariwisata Lombok-Gili-Tramena', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.005'),
(66, '03.05.08.001', '03.05.08', 'Aksesibilitas Pariwisata Danau Toba', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.016'),
(67, '03.05.08.001', '03.05.08', 'Aksesibilitas Pariwisata Danau Toba', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.015'),
(68, '03.05.08.001', '03.05.08', 'Aksesibilitas Pariwisata Danau Toba', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.016'),
(69, '03.05.08.001', '03.05.08', 'Aksesibilitas Pariwisata Danau Toba', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.016'),
(70, '03.05.08.003', '03.05.08', 'Pembangunan Prasarana Umum, Fasilitas Umum, dan Amenitas Penunjang Pariwisata Danau Toba', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.003'),
(71, '03.05.10.001', '03.05.10', 'Aksesibilitas Pariwisata Labuan Bajo', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.015'),
(72, '03.05.10.001', '03.05.10', 'Aksesibilitas Pariwisata Labuan Bajo', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.014'),
(73, '03.05.10.001', '03.05.10', 'Aksesibilitas Pariwisata Labuan Bajo', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.015'),
(74, '03.05.10.001', '03.05.10', 'Aksesibilitas Pariwisata Labuan Bajo', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.015'),
(75, '03.05.10.003', '03.05.10', 'Pembangunan Prasarana Umum, Fasilitas Umum, dan Amenitas Penunjang Pariwisata Labuan Bajo', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.006'),
(76, '04.11.02.02', '04.11.02', 'Penguatan Intervensi Sensitif Sunting', 'IA', 'IA.7714', 'IA.7714.RBB', 'IA.7714.RBB.007'),
(77, '04.11.02.02', '04.11.02', 'Penguatan Intervensi Sensitif Sunting', 'IA', 'IA.7715', 'IA.7715.RBB', 'IA.7715.RBB.003'),
(78, '05.02.02.02', '05.02.02', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.050'),
(79, '05.02.02.02', '05.02.02', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.050'),
(80, '05.02.02.02', '05.02.02', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.050'),
(81, '05.02.02.02', '05.02.02', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.050'),
(82, '05.02.02.03', '05.02.02', 'Pengembangan sarana prasarana pendukung (Pengolahan persampahan, limbah, dan air bersih)', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.012'),
(83, '05.02.09.01', '05.02.09', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.033'),
(84, '05.02.09.01', '05.02.09', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.033'),
(85, '05.02.09.01', '05.02.09', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.033'),
(86, '05.02.09.01', '05.02.09', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.033'),
(87, '05.02.09.02', '05.02.09', 'Pengembangan sarana prasarana pendukung (Pengolahan persampahan dan limbah)', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.013'),
(88, '05.02.22.02', '05.02.22', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RBC', 'GA.7696.RBC.046'),
(89, '05.02.22.02', '05.02.22', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RBF', 'GA.7696.RBF.046'),
(90, '05.02.22.02', '05.02.22', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RDC', 'GA.7696.RDC.046'),
(91, '05.02.22.02', '05.02.22', '\nPembangunan/pengembangan infrastruktur jalan/jembatan dan konektivitas simpul transportasi\n', 'GA', 'GA.7696', 'GA.7696.RDF', 'GA.7696.RDF.046'),
(92, '05.02.22.03', '05.02.22', 'Pengembangan sarana prasarana pendukung (Pengolahan persampahan, limbah, dan air bersih)', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.014'),
(93, '06.07.01.01', '06.07.01', 'Penguatan Pembangunan Layanan Dasar Kesehatan Desa', '', '', '', ''),
(94, '06.07.01.02', '06.07.01', 'Peningkatan Utilitas Dasar Desa', 'IA', 'IA.7714', 'IA.7714.RBB', 'IA.7714.RBB.005'),
(95, '06.07.01.02', '06.07.01', 'Peningkatan Utilitas Dasar Desa', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.017'),
(96, '06.07.01.02', '06.07.01', 'Peningkatan Utilitas Dasar Desa', 'IA', 'IA.7772', 'IA.7772.RBB', 'IA.7772.RBB.018'),
(97, '06.07.01.03', '06.07.01', 'Peningkatan Konektivitas Desa', '', '', '', ''),
(98, '08.03.01.04', '08.03.01', 'Pembangunan Prasarana Pengaman Pantai', 'FC', 'FC.7692', 'FC.7692.RBS', 'FC.7692.RBS.004');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `k_pro_p`
--
ALTER TABLE `k_pro_p`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `k_pro_p`
--
ALTER TABLE `k_pro_p`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
