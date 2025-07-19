-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 15, 2025 at 09:40 PM
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
-- Table structure for table `k_kegiatan_baru`
--

CREATE TABLE `k_kegiatan_baru` (
  `id_fkb` int NOT NULL,
  `id_sumber` int DEFAULT NULL,
  `sumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_diusulkan` year DEFAULT NULL,
  `kd_prog` int DEFAULT NULL,
  `kd_kgiat` int DEFAULT NULL,
  `kd_kro` int DEFAULT NULL,
  `kd_ro` int DEFAULT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `volume` float DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kawasan` varchar(20) DEFAULT NULL,
  `id_kabkot` int DEFAULT NULL,
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
  `geotag` point DEFAULT NULL,
  `uraian_geotag` text,
  `catatan_pradesk` text,
  `FKS` int DEFAULT NULL,
  `catatan_desk` text,
  `no_prioritas` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `k_kegiatan_baru_temp_api`
--

CREATE TABLE `k_kegiatan_baru_temp_api` (
  `id` int NOT NULL,
  `id_sumber` int DEFAULT NULL,
  `tahun_diusulkan` year DEFAULT NULL,
  `kd_prog` int DEFAULT NULL,
  `kd_kgiat` int DEFAULT NULL,
  `kd_kro` int DEFAULT NULL,
  `kd_ro` int DEFAULT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `volume` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kawasan` int DEFAULT NULL,
  `id_kabkot` int DEFAULT NULL,
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
  `geotag` point DEFAULT NULL,
  `uraian_geotag` text,
  `sumber` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `k_kegiatan_wajib`
--

CREATE TABLE `k_kegiatan_wajib` (
  `id_fkw` int NOT NULL,
  `id_sumber` int DEFAULT NULL,
  `sumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_diusulkan` year DEFAULT NULL,
  `kd_prog` int DEFAULT NULL,
  `kd_kgiat` int DEFAULT NULL,
  `kd_kro` int DEFAULT NULL,
  `kd_ro` int DEFAULT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `volume` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `kode_kabkot` int DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `rpm` int DEFAULT NULL,
  `phln` int DEFAULT NULL,
  `sbsn` int DEFAULT NULL,
  `anggaran` bigint DEFAULT NULL,
  `waktu_pelaksanaan` year DEFAULT NULL,
  `id_pembiayaan` int DEFAULT NULL,
  `catatan` text,
  `id_tematik` int DEFAULT NULL,
  `geotag` point DEFAULT NULL,
  `uraian_geotag` text,
  `catatan_pradesk` text,
  `FKS` int DEFAULT NULL,
  `catatan_desk` text,
  `no_prioritas` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `k_kegiatan_wajib_temp_api`
--

CREATE TABLE `k_kegiatan_wajib_temp_api` (
  `id` int NOT NULL,
  `id_sumber` int DEFAULT NULL,
  `tahun_diusulkan` year DEFAULT NULL,
  `kd_prog` int DEFAULT NULL,
  `kd_kgiat` int DEFAULT NULL,
  `kd_kro` int DEFAULT NULL,
  `kd_ro` int DEFAULT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `volume` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `kode_kabkot` int DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `rpm` int DEFAULT NULL,
  `phln` int DEFAULT NULL,
  `sbsn` int DEFAULT NULL,
  `anggaran` bigint DEFAULT NULL,
  `waktu_pelaksanaan` year DEFAULT NULL,
  `id_pembiayaan` int DEFAULT NULL,
  `catatan` text,
  `id_tematik` int DEFAULT NULL,
  `geotag` point DEFAULT NULL,
  `uraian_geotag` text,
  `sumber` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `k_usulan_provinsi`
--

CREATE TABLE `k_usulan_provinsi` (
  `id` int NOT NULL,
  `id_pn` int DEFAULT NULL,
  `id_pp` varchar(15) DEFAULT NULL,
  `id_kp` varchar(15) DEFAULT NULL,
  `id_prop` varchar(15) DEFAULT NULL,
  `kro` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ro` varchar(300) NOT NULL,
  `id_provinsi` int DEFAULT NULL,
  `id_unor` int DEFAULT NULL,
  `id_kawasan` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_pekerjaan` text,
  `lokasi` text,
  `justifikasi` text,
  `volume` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `anggaran` double DEFAULT NULL,
  `id_pendanaan` int DEFAULT NULL,
  `id_tematik` int NOT NULL,
  `ri` varchar(15) DEFAULT NULL,
  `ri_dokumen` text NOT NULL,
  `fs` varchar(15) DEFAULT NULL,
  `fs_dokumen` text NOT NULL,
  `dokling` varchar(15) DEFAULT NULL,
  `dokling_dokumen` text NOT NULL,
  `ded` varchar(15) DEFAULT NULL,
  `ded_dokumen` text NOT NULL,
  `lahan` varchar(15) DEFAULT NULL,
  `lahan_dokumen` text NOT NULL,
  `pasca_kontruksi` varchar(15) DEFAULT NULL,
  `pasca_kontruksi__dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menerima_bantuan` varchar(15) DEFAULT NULL,
  `menerima_bantuan__dokumen` text NOT NULL,
  `tahun_pengerjaan` int DEFAULT NULL,
  `catatan_unor` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_tematik`
--

CREATE TABLE `m_tematik` (
  `id_tematik` int NOT NULL,
  `tematik` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kategori` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `ket` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_tematik`
--

INSERT INTO `m_tematik` (`id_tematik`, `tematik`, `kategori`, `ket`) VALUES
(1, 'Jalan Akses Pelabuhan', 'AKSES PELABUHAN DAN AIRPORT', ''),
(2, 'Cadangan Darurat Bencana', 'CADANGAN DARURAT BENCANA', 'Cadangan Darurat Bencana'),
(3, 'PENGARUSUTAMAAN GENDER (PUG)', 'GENDER', ''),
(4, 'Jalan Lingkar 3T', 'JALAN', 'Jalan Lingkar 3 T'),
(5, 'KIT Batang', 'KIT BATANG', 'Peraturan Presiden (PERPRES) Nomor 106 Tahun 2022 tentang Percepatan Investasi Melalui Pengembangan Kawasan Industri Terpadu Batang di Provinsi Jawa Tengah'),
(6, 'KSPN SUPER PRIORITAS', 'KSPN', 'Danau Toba, Borobudur, Mandalika, Labuan Bajo, Manado-Bitung-Likupang'),
(7, 'RAN MAPI', 'MAPI', 'Peraturan Menteri Pekerjaan Umum dan Perumahan Rakyat Nomor 11/PRT/M/2012 Tahun 2012\n- Mitigasi - Survey dan pengumpulan data hidrologi dan hidrogeologi pada lahan bergambut\n- Mitigasi - Perbaikan dan pemeliharaan jaringan irigasi\n- Adaptasi - Peningkatan manajemen prasarana sumber daya air dalam rangka mendukung penyediaan air dan ketahanan pangan\n- Adaptasi - Pengembangan Disaster Risk Management untuk banjir (sungai, rob, lahar dingin), longsor, dan kekeringan\n- Adaptasi - Peningkatan manajemen dan mengembangkan prasarana sumber daya air untuk pengendalian daya rusak air\n- Adaptasi - Peningkatan kesadaran dan peran serta masyarakat tentang penyelamatan air'),
(8, 'RAN P4GN', 'P4GN', 'Instruksi Presiden (INPRES) Nomor 2 Tahun 2020 tentang Rencana Aksi Nasional Pencegahan dan Pemberantasan Penyalahgunaan dan Peredaran Gelap Narkotika dan Prekursor Narkotika Tahun 2020-2024\nInpres Nomor 2 Tahun 2020 : SDA@Provinsi Aceh'),
(9, 'PKE Dynamic Tagging Bappenas', 'PKE DYNAMIC TAGGING BAPPENAS', ''),
(10, 'PPDT', 'PPDT', ''),
(11, 'Percepatan Pembangunan Kesejahteraan di Provinsi Papua dan Provinsi Papua Barat', 'PAPUA', 'Instruksi Presiden (INPRES) Nomor 9 Tahun 2020 tentang Percepatan Pembangunan Kesejahteraan di Provinsi Papua dan Provinsi Papua Barat\nDITJEN SDA - Poin 23 - e \"Menyediakan dan meningkatkan pengelolaan air tanah dan air baku yang berkelanjutan, termasuk di kawasan perkotaan, kawasan strategis (KEK, KI, Kawasan Strategis Pariwisata Nasional/KSPN, destinasi wisata prioritas), dan pulau-pulau terpencil, terdepan, dan terluar.\"'),
(12, 'Jalan Trans Papua', 'PAPUA', ''),
(13, 'DOB Papua', 'PAPUA', ''),
(14, 'Perbatasan', 'PERBATASAN', 'PPKT - Tidak Berpenduduk 222 lokpri pada 54 kab/kota di 15 Provinsi. Berdasarkan Perka BNPP No. 3 tahun 2020 tentang Renstra BNPP dan Perpres 118 Tahun 2022 tentang Rencana Induk Pengelolaan Batas Wilayah Negara dan Kawasan Perbatasan Tahun 2020-2024\n- Perpres 118 Tahun 2022\n- Lampiran Perpres 118 Tahun 2022'),
(15, 'Inpres 1 tahun 2021 tentang Percepatan Pembangunan Ekonomi pada Kawasan Perbatasan Negara di Aruk, Motaain dan Skouw', 'PERBATASAN', 'Bagian Ketiga Inpres Berlaku sampai dengan 2023, Percepatan Pembangunan Ekonomi pada Kawasan Perbatasan Negara di Aruk, Motaain dan Skouw'),
(16, 'Rencana Aksi Pengelolaan Batas Wilayah Negara dan Kawasan Perbatasan (PBWN-KP)', 'PERBATASAN', 'Peraturan Badan Nasional Pengelola Perbatasan Nomor 3 Tahun 2023 Tentang Rencana Aksi Pengelolaan Batas Wilayah Negara dan Kawasan Perbatasan Tahun 2023'),
(17, 'Jalan Perbatasan', 'PERBATASAN', ''),
(18, 'Pos Lintas Batas Negara (PLBN)', 'PERBATASAN', ''),
(19, 'Penataan Kawasan Mandalika, NTB', 'PERPRES KAWASAN', 'Peraturan Presiden (PERPRES) Nomor 116 Tahun 2021 tentang Percepatan Pelaksanaan Pembangunan Infrastruktur untuk Mendukung Penyelenggaraan Acara Internasional di Provinsi Bali, Provinsi Daerah Khusus Ibukota Jakarta, Provinsi Nusa Tenggara Barat, dan Provinsi Nusa Tenggara Timur\n- Peraturan Presiden (PERPRES) Nomor 116 Tahun 2021'),
(20, 'Percepatan Pembangunan Ekonomi Kawasan Kendal - Semarang - Salatiga - Demak - Grobongan, Kawasan Purworejo - Wonosobo - Magelang - Temanggung, dan Kawasan Brebes - Tegal - Pemalang', 'PERPRES KAWASAN', 'Peraturan Presiden (PERPRES) Nomor 79 Tahun 2019 tentang Percepatan Pembangunan Ekonomi Kawasan Kendal - Semarang - Salatiga - Demak - Grobongan, Kawasan Purworejo - Wonosobo - Magelang - Temanggung, dan Kawasan Brebes - Tegal - Pemalang\n- Peraturan Presiden Nomor 79 Tahun 2019'),
(21, 'Percepatan Pembangunan Ekonomi di Kawasan Gresik - Bangkalan - Mojokerto - Surabaya - Sidoarjo - Lamongan, Kawasan Bromo - Tengger - Semeru, serta Kawasan Selingkar Wilis dan Lintas Selatan', 'PERPRES KAWASAN', 'Peraturan Presiden (PERPRES) Nomor 80 Tahun 2019 tentang Percepatan Pembangunan Ekonomi di Kawasan Gresik - Bangkalan - Mojokerto - Surabaya - Sidoarjo - Lamongan, Kawasan Bromo - Tengger - Semeru, serta Kawasan Selingkar Wilis dan Lintas Selatan\n- Peraturan Presiden Nomor 80 Tahun 2019\n- Lampiran Peraturan Presiden Nomor 80 Tahun 2019'),
(22, 'Percepatan Pembangunan Kawasan Rebana dan Kawasan Jawa Barat Bagian Selatan', 'PERPRES KAWASAN', 'Peraturan Presiden (PERPRES) Nomor 87 Tahun 2021 tentang Percepatan Pembangunan Kawasan Rebana dan Kawasan Jawa Barat Bagian Selatan\n- Peraturan Presiden (PERPRES) Nomor 87 Tahun 2021\n- Lampiran Peraturan Presiden (PERPRES) Nomor 87 Tahun 2021 Tabel IV.4'),
(23, 'Sentra Kelautan dan Perikanan Terpadu (SKPT)', 'SKPT', ''),
(24, 'DUKUNGAN PENANGGULANGAN TERORIS', 'TERORIS', 'Peraturan Presiden (PERPRES) Nomor 7 Tahun 2021 tentang Rencana Aksi Nasional Pencegahan dan Penanggulangan Ekstremisme Berbasis Kekerasan yang Mengarah pada Terorisme Tahun 2020-2024\n- Perpres Nomor 7 Tahun 2021\n- Lampiran Perpres Nomor 7 Tahun 2021'),
(25, 'RAN KUKM (Koordinator Kemenkop UKM)', 'UMKM', 'Peraturan Pemerintah (PP) Nomor 7 Tahun 2021 tentang Kemudahan, Pelindungan, dan Pemberdayaan Koperasi dan Usaha Mikro, Kecil, dan Menengah'),
(26, 'Percepatan Penurunan Stunting', 'STUNTING', 'Peraturan Presiden (PERPRES) Nomor 72 Tahun 2021 tentang Percepatan Penurunan Stunting');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `k_kegiatan_baru`
--
ALTER TABLE `k_kegiatan_baru`
  ADD PRIMARY KEY (`id_fkb`);

--
-- Indexes for table `k_kegiatan_baru_temp_api`
--
ALTER TABLE `k_kegiatan_baru_temp_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_kegiatan_wajib`
--
ALTER TABLE `k_kegiatan_wajib`
  ADD PRIMARY KEY (`id_fkw`);

--
-- Indexes for table `k_kegiatan_wajib_temp_api`
--
ALTER TABLE `k_kegiatan_wajib_temp_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_usulan_provinsi`
--
ALTER TABLE `k_usulan_provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_tematik`
--
ALTER TABLE `m_tematik`
  ADD PRIMARY KEY (`id_tematik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `k_kegiatan_baru`
--
ALTER TABLE `k_kegiatan_baru`
  MODIFY `id_fkb` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_kegiatan_baru_temp_api`
--
ALTER TABLE `k_kegiatan_baru_temp_api`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_kegiatan_wajib`
--
ALTER TABLE `k_kegiatan_wajib`
  MODIFY `id_fkw` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_kegiatan_wajib_temp_api`
--
ALTER TABLE `k_kegiatan_wajib_temp_api`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `k_usulan_provinsi`
--
ALTER TABLE `k_usulan_provinsi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
