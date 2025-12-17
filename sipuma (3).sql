-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 06:01 AM
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
-- Database: `sipuma`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(150) DEFAULT NULL,
  `pesan` text NOT NULL,
  `status` enum('baru','dibaca') DEFAULT 'baru',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `aktivitas` varchar(255) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `waktu`) VALUES
(1, 4, 'Admin logout', '2025-08-26 08:54:23'),
(18, 2, 'Logout (User)', '2025-08-27 14:21:38'),
(19, 2, 'User login ke sistem', '2025-08-27 14:21:42'),
(20, 4, 'Admin logout', '2025-08-27 14:26:41'),
(21, 2, 'User login ke sistem', '2025-08-28 13:12:45'),
(22, 2, 'Logout (User)', '2025-08-28 13:12:47'),
(23, 2, 'User login ke sistem', '2025-08-28 13:12:50'),
(24, 2, 'Logout (User)', '2025-08-28 13:13:08'),
(26, 2, 'User login ke sistem', '2025-08-28 14:23:51'),
(27, 2, 'User login ke sistem', '2025-08-30 17:10:44'),
(28, 2, 'User login ke sistem', '2025-09-01 12:25:05'),
(29, 2, 'User login ke sistem', '2025-09-02 14:21:09'),
(30, 4, 'Admin logout', '2025-09-02 14:22:55'),
(31, 4, 'Admin logout', '2025-09-03 00:58:24'),
(32, 5, 'User login ke sistem', '2025-09-03 01:09:02'),
(33, 2, 'User login ke sistem', '2025-09-03 01:19:43'),
(36, 2, 'User login ke sistem', '2025-09-03 01:26:35'),
(37, 2, 'User login ke sistem', '2025-09-03 05:00:53'),
(38, 2, 'User login ke sistem', '2025-09-03 05:21:21'),
(39, 2, 'User login ke sistem', '2025-09-03 06:30:42'),
(40, 2, 'User login ke sistem', '2025-09-03 07:15:39'),
(41, 4, 'Admin logout', '2025-09-03 07:50:46'),
(42, 2, 'User login ke sistem', '2025-09-03 08:06:20'),
(43, 2, 'Logout (User)', '2025-09-03 08:14:14'),
(44, 2, 'User login ke sistem', '2025-09-03 08:28:13'),
(45, 2, 'User login ke sistem', '2025-09-11 13:22:19'),
(46, 2, 'Logout (User)', '2025-09-11 13:23:02'),
(47, 2, 'User login ke sistem', '2025-09-28 20:38:11'),
(48, 6, 'User login ke sistem', '2025-09-29 04:10:04'),
(49, 4, 'Admin logout', '2025-09-29 04:14:06'),
(50, 7, 'User login ke sistem', '2025-09-29 07:21:06'),
(51, 2, 'User login ke sistem', '2025-10-02 15:39:45'),
(52, 4, 'Admin logout', '2025-10-02 15:43:42'),
(53, 2, 'User login ke sistem', '2025-11-09 13:43:47'),
(54, 4, 'Login Berhasil: admin', '2025-11-18 16:10:47'),
(55, 4, 'Login Berhasil: admin', '2025-11-18 16:10:59'),
(56, 4, 'Logout (Admin)', '2025-11-18 16:11:34'),
(57, 4, 'Login Berhasil: admin', '2025-11-18 16:11:53'),
(58, 2, 'Login Berhasil: user', '2025-11-18 16:12:18'),
(59, 2, 'Logout (User)', '2025-11-18 16:12:24'),
(60, 8, 'Login Berhasil: user', '2025-11-18 16:26:44'),
(61, 8, 'Logout (User)', '2025-11-18 16:58:02'),
(62, 4, 'Login Berhasil: admin', '2025-11-18 16:58:04'),
(63, 4, 'Logout (Admin)', '2025-11-18 16:59:37'),
(64, 4, 'Login Berhasil: admin', '2025-11-26 03:11:02'),
(65, 4, 'Logout (Admin)', '2025-11-26 03:11:21'),
(66, 4, 'Login Berhasil: admin', '2025-12-03 03:09:10'),
(67, 4, 'Logout (Admin)', '2025-12-03 03:09:18'),
(68, 2, 'Login Berhasil: user', '2025-12-03 03:38:09'),
(69, 2, 'Logout (User)', '2025-12-03 03:38:15'),
(70, 4, 'Login Berhasil: admin', '2025-12-03 03:38:22'),
(71, 4, 'Logout (Admin)', '2025-12-03 03:42:34'),
(72, 2, 'Login Berhasil: user', '2025-12-03 03:44:34'),
(73, 2, 'Logout (User)', '2025-12-03 03:44:55'),
(74, 4, 'Login Berhasil: admin', '2025-12-03 03:45:01'),
(75, 4, 'Logout (Admin)', '2025-12-03 03:45:15'),
(76, 2, 'Login Berhasil: user', '2025-12-03 03:51:05'),
(77, 2, 'Logout (User)', '2025-12-03 03:51:12'),
(78, 2, 'Login Berhasil: user', '2025-12-03 03:51:19'),
(79, 2, 'Logout (User)', '2025-12-03 03:55:18'),
(80, 4, 'Login Berhasil: admin', '2025-12-08 12:15:06'),
(81, 4, 'Logout (Admin)', '2025-12-08 12:15:16'),
(82, 4, 'Login Berhasil: admin', '2025-12-10 04:14:13'),
(83, 4, 'Login Berhasil: admin', '2025-12-10 04:19:56'),
(84, 9, 'Login Berhasil: user', '2025-12-10 04:46:06'),
(85, 9, 'Logout (User)', '2025-12-10 04:46:37'),
(86, 4, 'Login Berhasil: admin', '2025-12-10 04:46:43'),
(87, 4, 'Logout (Admin)', '2025-12-10 04:47:01'),
(88, 4, 'Login Berhasil: admin', '2025-12-10 04:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(255) DEFAULT NULL,
  `pesan` text NOT NULL,
  `status` enum('baru','terbaca') DEFAULT 'baru',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `nama_lengkap`, `email`, `subjek`, `pesan`, `status`, `created_at`) VALUES
(6, 'Lisa Mulyana', 'lisamulyana9282@gmail.com', 'Tes', 'Sangat Membantu', 'baru', '2025-09-03 03:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status_perkawinan` varchar(50) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `alamat_domisili` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `disabilitas` varchar(50) NOT NULL,
  `perempuan_tpk` varchar(50) NOT NULL,
  `kepala_keluarga` varchar(50) NOT NULL,
  `jumlah_anggota_keluarga` int(11) NOT NULL,
  `jumlah_tanggungan` int(11) NOT NULL,
  `tulang_punggung` varchar(50) NOT NULL,
  `nama_usaha` varchar(100) NOT NULL,
  `tahun_mulai` year(4) NOT NULL,
  `jenis_usaha` varchar(100) NOT NULL,
  `bidang_usaha` varchar(100) NOT NULL,
  `jumlah_pegawai` int(11) NOT NULL,
  `kapasitas_produksi` varchar(100) NOT NULL,
  `omzet` decimal(15,2) NOT NULL,
  `modal_awal` decimal(15,2) NOT NULL,
  `target_pasar` varchar(100) NOT NULL,
  `legalitas` varchar(100) NOT NULL,
  `nib` varchar(100) NOT NULL,
  `haki` varchar(100) NOT NULL,
  `pencatatan` varchar(100) NOT NULL,
  `saluran_digital` varchar(100) NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `status_produksi` varchar(100) NOT NULL,
  `tempat_usaha` varchar(100) NOT NULL,
  `sumber_modal` varchar(100) NOT NULL,
  `ikut_pelatihan` varchar(50) NOT NULL,
  `butuh_pelatihan` varchar(50) NOT NULL,
  `jenis_pelatihan` varchar(150) NOT NULL,
  `hambatan_usaha` text NOT NULL,
  `foto_usaha` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `level_umkm` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id`, `nama_lengkap`, `nik`, `gender`, `tanggal_lahir`, `status_perkawinan`, `pendidikan`, `alamat_domisili`, `no_hp`, `disabilitas`, `perempuan_tpk`, `kepala_keluarga`, `jumlah_anggota_keluarga`, `jumlah_tanggungan`, `tulang_punggung`, `nama_usaha`, `tahun_mulai`, `jenis_usaha`, `bidang_usaha`, `jumlah_pegawai`, `kapasitas_produksi`, `omzet`, `modal_awal`, `target_pasar`, `legalitas`, `nib`, `haki`, `pencatatan`, `saluran_digital`, `pembayaran`, `status_produksi`, `tempat_usaha`, `sumber_modal`, `ikut_pelatihan`, `butuh_pelatihan`, `jenis_pelatihan`, `hambatan_usaha`, `foto_usaha`, `created_at`, `updated_at`, `level_umkm`) VALUES
(16, 'Siti Aisyah', '3201123456789001', 'Perempuan', '1990-02-14', 'Menikah', 'SMA', 'Jl. Melati No. 5, Bandung', '081234567890', 'Tidak', 'Ya', 'Tidak', 4, 2, 'Ya', 'Warung Bu Ais', '2022', 'Warung Nasi', 'Kuliner', 1, '300', 5000000.00, 3000000.00, 'Lokal', 'Tidak Ada', '', 'Tidak', 'Tidak Ada', 'Tidak Ada', 'Tunai', 'Produksi Sendiri', 'Sewa', 'Pribadi', 'Tidak', 'Ya', 'Manajemen Usaha Kecil', 'Modal terbatas, belum ada pelanggan tetap', 'uploads/1756877464_2913.png', '2025-09-03 05:31:04', '2025-09-03 05:31:55', 1),
(18, 'Rudi Santoso', '3201765432109876', 'Laki-laki', '1985-09-08', 'Menikah', 'SMA', 'Jl. Anggrek No. 7, Bekasi', '081311223344', 'Tidak', 'Tidak', 'Ya', 4, 2, 'Ya', 'Roti Enak Jaya', '2019', 'Roti Rumahan', 'Kuliner', 3, '2000', 75000000.00, 25000000.00, 'Lokal', 'NIB', '12345678', 'Tidak', 'Manual', 'Tidak Ada', 'Tunai,Transfer Bank', 'Produksi Sendiri', 'Milik Sendiri', 'Pribadi', 'Ya', 'Ya', 'Prioduksi Efektif', 'Tenaga kerja terbatas', 'uploads/1756878697_2652.jpg', '2025-09-03 05:51:37', '2025-09-03 05:51:37', 2),
(19, 'Dewi Lestari', '3201456789012345', 'Perempuan', '1992-07-15', 'Menikah', 'D3', 'Jl. Kenanga No. 20, Depok', '081322334455', 'Tidak', 'Tidak', 'Tidak', 4, 2, 'Ya', 'Konveksi Muslimah', '2018', 'Konveksi ', 'Fashion', 5, '500', 90000000.00, 40000000.00, 'Nasional', 'NIB,SIUP', '23456789', 'Tidak', 'Excel', 'Marketplace', 'Tunai,Transfer Bank,QRIS', 'Produksi Sendiri', 'Sewa', 'Pinjaman', 'Ya', 'Tidak', '-', '-', 'uploads/1756878906_6615.png', '2025-09-03 05:55:06', '2025-09-03 05:55:06', 2),
(20, 'Hartono', '3201678901234567', 'Laki-laki', '1991-03-12', 'Menikah', 'S1', 'Jl. Sudirman No. 15, Jakarta', '081355667788', 'Tidak', 'Tidak', 'Ya', 6, 3, 'Ya', 'Pupuk Nusantara', '2017', 'Pupuk Organik', 'Pupuk', 8, '5000', 150000000.00, 75000000.00, 'Nasional', 'NIB,SIUP', '34567890', 'Tidak', 'Excel', 'Instagram', 'Tunai,QRIS,E-wallet', 'Produksi Sendiri', 'Milik Sendiri', 'Pribadi', 'Ya', 'Ya', 'Manajemen Keuangan', 'Persaingan banyak pengusaha pupuk baru', 'uploads/1756879250_8798.png', '2025-09-03 06:00:50', '2025-09-03 06:00:50', 3),
(21, 'Rahmadini', '3201789012345678', 'Perempuan', '1999-04-09', 'Belum Menikah', 'S1', 'Jl. Diponegoro No. 22, Medan', '081399887766', 'Tidak', 'Ya', 'Tidak', 4, 2, 'Ya', 'Hijab Trendy', '2000', 'Fashion Muslim', 'Fashion', 10, '1000', 30000000000.00, 10000000000.00, 'Nasional', 'NIB,SIUP,NPWP', '56789012', 'Ya', 'Aplikasi', 'Website, Marketplance', 'Transfer Bank,QRIS,E-wallet', 'Produksi Sendiri', 'Milik Sendiri', 'Pribadi', 'Ya', 'Tidak', '', 'Permintaan tinggi, stok sering habis', 'uploads/1756881905_7986.png', '2025-09-03 06:45:05', '2025-09-03 06:52:58', 3),
(22, 'Ratna Widya', '3201890123456789', 'Perempuan', '1982-04-25', 'Menikah', 'S2', 'Jl. Pahlawan No. 5, Solo', '081377665544', 'Tidak', 'Tidak', 'Ya', 7, 3, 'Ya', 'Batik Heritage', '2010', 'Batik Tulis dan Cap', 'Fashion', 20, '2000', 750000000.00, 200000000.00, 'Internasional', 'NIB,SIUP,BPOM,Sertifikat Halal', 'BPOM, Halal 56789012', 'Ya', 'Aplikasi', 'Website', 'Transfer Bank,QRIS,E-wallet', 'Produksi Sendiri', 'Milik Sendiri', 'Pribadi', 'Ya', 'Tidak', '', 'Bersaing dengan batik printing murah', 'uploads/1756883028_7275.png', '2025-09-03 07:03:48', '2025-09-03 07:03:48', 4),
(23, 'Ahmad Fauzi', '3201901234567890', 'Laki-laki', '1980-11-02', 'Belum Menikah', 'S1', 'Jl. Merdeka No. 99, Semarang', '081311445566', 'Tidak', 'Tidak', 'Ya', 6, 4, 'Ya', 'Kopi Arabica Premium', '2012', 'Kopi Kemasan', 'Kuliner', 15, '5000', 1200000000.00, 500000000.00, 'Internasional', 'NIB,SIUP,BPOM,Sertifikat Halal', '67890123', 'Ya', 'Aplikasi', 'Marketplace', 'Transfer Bank,QRIS,E-wallet', 'Produksi Sendiri', 'Milik Sendiri', 'Pinjaman', 'Ya', 'Ya', 'Ekspor dan Branding', 'Persyaratan ekspor cukup rumit', 'uploads/1756883260_7646.png', '2025-09-03 07:07:40', '2025-09-03 07:07:40', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `role` enum('admin','user','guest') NOT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `nama_lengkap`, `role`, `tanggal_daftar`) VALUES
(2, 'Lisa', 'lisamulyana9282@gmail.com', '$2y$10$F/9imf2QPHGEJcoUE66GzO2l7enpmRwCkY/PMZxO6RALZfpr9Pu8u', 'Lisa Mulyana', 'user', '2025-08-25 06:50:35'),
(4, 'admin', 'admin@example.com', '$2y$10$sezrUQWhupukvL2l0dh2T.E6zGueCVxUGwCGR1yfo/naPmnFyyerC', 'Administrator', 'admin', '2025-08-25 07:01:40'),
(5, 'Rika', 'rika90224@gmail.com', '$2y$10$V.9nuTSWgyHNxOUq0KrmmOp8RG/vzKtSNyu9GMOg8q/HeCBJFJ0/q', 'Rika Cintia', 'user', '2025-09-03 01:08:45'),
(8, 'Sarah', 'sarah0000@gmail.com', '$2y$10$sm/54AypCIagzmmRC0Sute99rVqpJNBqSK6tNvrCS10lcgsy0Kx6W', 'sarah', 'user', '2025-11-18 16:26:27'),
(9, 'Yeni', 'yeni123@gmail.com', '$2y$10$X2MT/YHFoipzF.hXtzu73.XNElTNTnzQGvKaPnLE2WyDmNk6Cb9Y.', 'YeniT', 'user', '2025-12-10 04:45:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
