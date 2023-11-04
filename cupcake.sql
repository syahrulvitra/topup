-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2023 at 03:38 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cupcake`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` enum('On','Off') NOT NULL,
  `date_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `status`, `date_create`) VALUES
(1, 'irvanshihap', '$2y$10$Rk6OmBfcF7Ry/Uw1FJ7kyO0DG/veEDH/hRQPRm6xPYM4HW6zHarOO', 'On', '2022-07-01 15:49:45'),
(4, 'Admin123', '$2y$10$INKEAfFx6KjHxp5yrPBW/OmQjCczJl2Kl.tsbuQgOJg.Cx6j24rtC', 'On', '2022-07-20 13:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`) VALUES
(1, '1656590023_6cb7bc741bca8d0316cc.png'),
(2, '1656590057_eb5f92993519eb611181.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(250) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `sort`) VALUES
(1, 'Top Up Game', 1),
(2, 'Produk Lainnya', 2),
(3, 'Manual Proses', 4),
(7, 'Pulsa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `games` varchar(100) NOT NULL,
  `category` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `target` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('On','Off') NOT NULL,
  `check_status` enum('Y','N') NOT NULL,
  `check_code` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `games`, `category`, `image`, `slug`, `target`, `sort`, `content`, `status`, `check_status`, `check_code`) VALUES
(1, 'Mobile Legends', 'Top Up Game', 'ml.png', 'mobile-legends', 'ml', 2, '<p>Top Up Diamond Mobile Legends</p>\r\n\r\n<ol>\r\n	<li>Masukkan ID (SERVER)</li>\r\n	<li>Pilih Nominal Diamond</li>\r\n	<li>Pilih Metode Pembayaran</li>\r\n	<li>Tulis nomor WhatsApp</li>\r\n	<li>Klik Order Now &amp; lakukan Pembayaran</li>\r\n	<li>Diamond masuk otomatis ke akun Anda</li>\r\n</ol>\r\n\r\n<p><strong>Layanan Aktif 24 Jam<br />\r\nEstimasi Proses Otomatis 1-5 Menit </strong></p>', 'On', 'Y', 'ml'),
(3, 'Be The King', 'Top Up Game', '1654748859_a1361eed59ff829ecafe.png', 'be-the-king', 'default', 1, '<p>Top up Be The King dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Be The King akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'Off', 'N', ''),
(4, 'Chimeraland', 'Top Up Game', '1654748953_52c2da30bdcbd1634bdd.png', 'chimeraland', 'default', 2, '<p>Top up Chimeraland dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Chimeraland akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'Off', 'N', ''),
(5, 'Dragon Raja', 'Top Up Game', '1654749003_c7e89d96df749b91aebd.png', 'dragon-raja', 'default', 3, '<p>Top up Dragon Raja dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Dragon Raja akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'On', 'N', ''),
(6, 'Free Fire', 'Top Up Game', '1654749104_95da69c150adab906a40.png', 'free-fire', 'default', 1, '<p>Top Up Diamond Free Fire</p>\r\n\r\n<ol>\r\n	<li>Masukkan ID</li>\r\n	<li>Pilih Nominal Diamond</li>\r\n	<li>Pilih Metode Pembayaran</li>\r\n	<li>Tulis nomor WhatsApp</li>\r\n	<li>Klik Order Now &amp; lakukan Pembayaran</li>\r\n	<li>Diamond masuk otomatis ke akun Anda</li>\r\n</ol>\r\n\r\n<p><strong>Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</strong></p>', 'On', 'Y', 'ff'),
(7, 'Genshin Impact', 'Top Up Game', '1654749155_538539a0feaa58c1b7dc.png', 'genshin-impact', 'gi', 5, '<p>Top up Genshin Impact dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Genshin Impact akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'On', 'N', ''),
(8, 'League of Legends', 'Top Up Game', '1654749483_edcd68f5a656d1d4df6a.png', 'league-of-legends', 'default', 6, 'Top up dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(9, 'Life After', 'Top Up Game', '1654749680_35313e4ce787ab1be256.png', 'life-after', 'default', 7, 'Top up dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(10, 'Light of Thel', 'Top Up Game', '1654749737_e80ee873ae732a927559.png', 'light-of-thel', 'default', 8, 'Top up Light of Thel dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Light of Thel akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(11, 'Lords Mobile', 'Top Up Game', '1654749815_884a1fe90a52c6ac82e6.png', 'lords-mobile', 'default', 9, 'Top up Lords Mobile dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Lords Mobile akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(12, 'Marvel Super War', 'Top Up Game', '1654749864_8bf4e259f3fbc0f75c6c.png', 'marvel-super-war', 'default', 10, '<p>Top up Marvel Super War dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Marvel Super War akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'Off', 'N', ''),
(13, 'Mobile Legends A', 'Top Up Game', '1654749910_4a55141b2495feb629f4.png', 'mobile-legends-a', 'ml', 11, '<p>Top Up Diamond Mobile Legends</p>\r\n\r\n<ol>\r\n	<li>Masukkan ID (SERVER)</li>\r\n	<li>Pilih Nominal Diamond</li>\r\n	<li>Pilih Metode Pembayaran</li>\r\n	<li>Tulis nomor WhatsApp</li>\r\n	<li>Klik Order Now &amp; lakukan Pembayaran</li>\r\n	<li>Diamond masuk otomatis ke akun Anda</li>\r\n</ol>\r\n\r\n<p><strong>Layanan Aktif 24 Jam<br />\r\nEstimasi Proses Otomatis 1-5 Menit</strong></p>', 'On', 'Y', 'ml'),
(14, 'Mobile Legends B', 'Top Up Game', '1654749966_e17860a54d5b4578b1b5.png', 'mobile-legends-b', 'ml', 12, '<p>Top Up Diamond Mobile Legends</p>\r\n\r\n<ol>\r\n	<li>Masukkan ID (SERVER)</li>\r\n	<li>Pilih Nominal Diamond</li>\r\n	<li>Pilih Metode Pembayaran</li>\r\n	<li>Tulis nomor WhatsApp</li>\r\n	<li>Klik Order Now &amp; lakukan Pembayaran</li>\r\n	<li>Diamond masuk otomatis ke akun Anda</li>\r\n</ol>\r\n\r\n<p><strong>Layanan Aktif 24 Jam<br />\r\nEstimasi Proses Otomatis 1-5 Menit</strong></p>', 'On', 'Y', 'ml'),
(15, 'Omega Legends', 'Top Up Game', '1654750073_83a9b7548734e9316bd7.png', 'omega-legends', 'default', 13, 'Top up Omega Legends dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Omega Legends akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(16, 'PB Zepetto', 'Top Up Game', '1654752443_1528df85c556ef6de6a0.png', 'pb-zepetto', 'default', 14, 'Top up dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(17, 'Playstation Network (PSN)', 'Top Up Game', '1654752850_6380ae94a97457d752ba.png', 'playstation-network-psn', 'default', 15, 'Top up dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(18, 'PUBGM GLOBAL', 'Top Up Game', '1654752892_3a80a5aba471d0175c5c.png', 'pubgm-global', 'default', 16, 'Top up dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(19, 'PUBG MOBILE', 'Top Up Game', '1654752940_82b0120f8f8919532e57.png', 'pubgm-indo-a', 'default', 17, '<p>Top up dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'On', 'N', ''),
(20, 'PUBGM New State', 'Top Up Game', '1654753974_eb3a9f3e62e363893a73.png', 'pubgm-new-state', 'default', 18, 'Top up PUBGM New State dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu PUBGM New State akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(21, 'RagnaroK X Next Generation', 'Top Up Game', '1654754052_d26fd5bd1a4c3ddd98a6.png', 'ragnarok-x-next-generation', 'default', 19, 'Top up RagnaroK X Next Generation dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu RagnaroK X Next Generation akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(22, 'Sausage Man', 'Top Up Game', '1654754177_fb6c2c7e2508cad9bbb8.png', 'sausage-man', 'default', 20, 'Top up Sausage Man dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Sausage Man akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(23, 'Super Sus', 'Top Up Game', '1654754240_a38b315bdb42087972d7.png', 'super-sus', 'default', 21, '<p>Top up Super Sus dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Super Sus akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'Off', 'N', ''),
(24, 'Tom and Jerry Chase', 'Top Up Game', '1654754289_3243c67fd0df775f6cb3.png', 'tom-and-jerry-chase', 'default', 22, '<p>Top up Tom and Jerry Chase dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Tom and Jerry Chase akan langsung bertambah ke akun kamu. Layanan Aktif 24 Jam Estimasi Proses Otomatis 1-5 Menit</p>', 'Off', 'N', ''),
(25, 'Canva Pro', 'Produk Lainnya', '1654754387_24f75340168a8c49e0db.png', 'canva-pro', 'default', 1, 'Top up Canva Pro dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Canva Pro akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(26, 'Disney Hotstar', 'Produk Lainnya', '1654754484_82be26a66f70a71e5cc7.png', 'disney-hotstar', 'default', 2, 'Top up Disney Hotstar dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Disney Hotstar akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(27, 'Netflix Premium', 'Produk Lainnya', '1654754527_212cfe86691c5fc13700.png', 'netflix-premium', 'default', 3, 'Top up Netflix Premium dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Netflix Premium akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(28, 'Spotify Premium', 'Produk Lainnya', '1654754570_efa00f291b86638007c6.png', 'spotify-premium', 'default', 4, 'Top up Spotify Premium dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Spotify Premium akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(29, 'WeTV Premium', 'Produk Lainnya', '1654754670_61241555f7bafac2c4e9.png', 'wetv-premium', 'default', 5, 'Top up WeTV Premium dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu WeTV Premium akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(30, 'Youtube Premium', 'Produk Lainnya', '1654754712_b651982a768555b7b170.png', 'youtube-premium', 'default', 6, 'Top up Youtube Premium dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Youtube Premium akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(31, 'Vidio Premier', 'Produk Lainnya', '1654754828_f5c27094968689c95f81.png', 'vidio-premier', 'default', 7, 'Top up Vidio Premier dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu Vidio Premier akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(32, 'GIFTSKIN', 'Manual Proses', '1654756296_4e7d9dbfb97766c245b3.png', 'giftskin', 'default', 1, 'Top up GIFTSKIN dengan murah dan cepat. Caranya mudah, cukup input data game, pilih nominal yang diinginkan, lakukan pembayaran, lalu GIFTSKIN akan langsung bertambah ke akun kamu.\r\n\r\nLayanan Aktif 24 Jam\r\nEstimasi Proses Otomatis 1-5 Menit', 'On', 'N', ''),
(33, 'Three', 'Pulsa', '1656665199_d70cfb783fc081423749.png', 'three', 'default', 1, '<p>Mohon masukan nomor 3 dengan benar<br />\r\nProses hanya dalam hitungan detik</p>', 'On', 'N', ''),
(34, 'Telkomsel', 'Pulsa', '1656933262_e4ab1d9e2cf8d34d45aa.jpeg', 'telkomsel', 'default', 2, '<p>Masukan nomor telkomsel anda dengan benar<br />\r\nProses hanya dalam hitungan detik</p>', 'On', 'N', ''),
(35, 'Indosat', 'Pulsa', '1656933360_d57c164cc757dd5b1bd2.png', 'indosat', 'default', 3, '<p>Mohon masukan nomor Indosat dengan benar<br />\r\nProses hanya dalam hitungan detik</p>', 'On', 'N', ''),
(36, 'Axis', 'Pulsa', '1656933455_5419cf63399f86cfc884.png', 'axis', 'default', 4, '<p>Mohon masukan nomor Axis dengan benar<br />\r\nProses hanya dalam hitungan detik</p>', 'On', 'N', ''),
(37, 'XL', 'Pulsa', '1656933552_b8fd4bbb23e89bb23acd.png', 'xl', 'default', 5, '<p>Mohon masukan nomor XL dengan benar<br />\r\nProses hanya dalam hitungan detik</p>', 'On', 'N', ''),
(38, 'Apex Legends', 'Top Up Game', '1657035882_070f649b3258e74e2d17.png', 'apex-legends', 'default', 4, '<p>Top Up Syndicate Gold Apex Legends Mobile</p>\r\n\r\n<ol>\r\n	<li>Masukkan ID</li>\r\n	<li>Pilih Nominal SG</li>\r\n	<li>Pilih Metode Pembayaran</li>\r\n	<li>Tulis nomor WhatsApp</li>\r\n	<li>Klik Order Now &amp; lakukan Pembayaran</li>\r\n	<li>Syndicate Gold masuk otomatis ke akun Anda.</li>\r\n</ol>\r\n\r\n<p><strong>Layanan Aktif 24 Jam<br />\r\nEstimasi Proses Otomatis 1-5 Menit</strong></p>', 'On', 'N', '');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id` int(11) NOT NULL,
  `method` varchar(55) NOT NULL,
  `image` varchar(250) NOT NULL,
  `uniq` enum('Y','N') NOT NULL,
  `provider` varchar(100) NOT NULL,
  `code` varchar(55) NOT NULL,
  `rek` varchar(250) NOT NULL,
  `instruksi` longtext NOT NULL,
  `status` enum('On','Off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`id`, `method`, `image`, `uniq`, `provider`, `code`, `rek`, `instruksi`, `status`) VALUES
(1, 'BRI VIRTUAL ACCOUNT QR', '1654748513_99f671d877eb6e2b6f70.png', 'N', 'Tripay', 'QRISC', '', '&lt;p&gt;Ini adalah cara / instruksi&lt;/p&gt;', 'Off'),
(4, 'BCA VIRTUAL ACCOUNT', '1654746918_6604380a47574b6ea568.png', 'N', 'Tripay', 'BCAVA', '', '', 'Off'),
(5, 'ALFAMART', '1654747423_98aa253fe2c9a2098148.png', 'N', 'Tripay', 'ALFAMART', '', '', 'On'),
(6, 'ALFAMIDI', '1654747483_d0dab20e8a32e2f6d867.png', 'N', 'Tripay', 'ALFAMIDI', '', '', 'Off'),
(7, 'BNI VIRTUAL ACCOUNT', '1654747663_361252a9e71f20ca8b7a.png', 'N', 'Tripay', 'BNIVA', '', '', 'Off'),
(8, 'BSI VIRTUAL ACCOUNT', '1654747759_5c3634dc136591ae07ec.png', 'N', 'Tripay', 'BSIVA', '', '', 'Off'),
(9, 'MANDIRI VIRTUAL ACCOUNT', '1654747903_c36c3301db79a529a741.png', 'N', 'Tripay', 'MANDIRIVA', '', '', 'Off'),
(10, 'INDOMARET', '1654747984_186dea58029f6d391184.png', 'N', 'Tripay', 'INDOMARET', '', '', 'On'),
(11, 'OVO', '1654748030_b0f3ce8f5560eb546634.png', 'N', 'Tripay', 'OVO', '', '', 'Off'),
(12, 'QRIS (SHOPEEPAY)', '1654748586_72ef66e7b12ecf9ef4ef.png', 'N', 'Tripay', 'QRIS', '', '', 'On'),
(13, 'QRIS (DANA)', '1654748280_ff009bf6f39374804f5d.png', 'N', 'Tripay', 'QRISD', '', '', 'On'),
(14, 'PERMATA VIRTUAL ACCOUNT', '1654748334_3051ded225b1859541c4.png', 'N', 'Tripay', 'PERMATAVA', '', '', 'Off'),
(15, 'CIMB VIRTUAL ACCOUNT', '1654748416_5ba17a28df441ab04b71.png', 'N', 'Tripay', 'CIMBVA', '', '', 'Off'),
(16, 'SAMPOERNA VIRTUAL ACCOUNT', '1654748456_11edb89b731274fe3fda.png', 'N', 'Tripay', 'SAMPOERNAVA', '', '', 'Off'),
(17, 'BCA', '1654748613_e1eedcd57d498f1b6dfa.png', 'Y', 'Manual', '', '', '', 'Off'),
(18, 'BRI', '1654748626_76660b20fba6fba74d2c.png', 'Y', 'Manual', '', '', '', 'Off'),
(19, 'BNI', '1654748638_ef950ca4a74933350a2a.png', 'Y', 'Manual', '', '', '', 'Off'),
(20, 'MANDIRI', '1654748652_2d522be9706ae3c0f9f7.png', 'Y', 'Manual', '', '', '', 'Off'),
(21, 'DANA Manual', '1656655399_11d68a78858b6422b817.png', 'Y', 'Manual', '', '089615657999', '&lt;p&gt;Transfer sesuai total pembayaran ke nomer DANA berikut ini:&lt;/p&gt;\r\n\r\n&lt;p&gt;089615657999 A/N Qomarul Irvan&lt;/p&gt;', 'On');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `username` varchar(55) NOT NULL,
  `wa` varchar(250) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product` varchar(250) NOT NULL,
  `price` bigint(20) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `zone_id` varchar(250) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `method_id` int(11) NOT NULL,
  `method` varchar(100) NOT NULL,
  `games` varchar(100) NOT NULL,
  `games_id` int(11) NOT NULL,
  `status` enum('Pending','Processing','Success','Canceled','Expired') NOT NULL,
  `ket` longtext NOT NULL,
  `payment_code` varchar(100) NOT NULL,
  `provider` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_process` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `username`, `wa`, `product_id`, `product`, `price`, `user_id`, `zone_id`, `nickname`, `method_id`, `method`, `games`, `games_id`, `status`, `ket`, `payment_code`, `provider`, `date`, `date_create`, `date_process`) VALUES
(1, '202206091308', '', '085654008642', 2, '3 Diamonds', 10000, '150370579', '2755', 'Khun', 1, 'BRI VIRTUAL ACCOUNT QR', 'Mobile Legends', 1, 'Pending', '', 'https://tripay.co.id/qr/T78993100716ZUWBH', '', '2022-06-09', '2022-06-09 04:35:33', '2022-06-09 04:35:33'),
(3, '202206093709', '', '085654008642', 7, '1080 Diamonds', 10000, '570098876', '1', 'kuroka1358T', 4, 'BCA VIRTUAL ACCOUNT', 'Free Fire', 6, 'Pending', '', '140933101231', '', '2022-06-09', '2022-06-09 05:44:07', '2022-06-09 05:44:07'),
(4, '202206115505', 'frendysantoso', '085654008642', 1, '12 Diamons', 10000, '150370579', '2755', 'Khun', 10001, 'Saldo Akun', 'Mobile Legends', 1, 'Processing', 'Gagal memproses API Buyer -', 'Saldo Akun', 'DF', '2022-06-11', '2022-06-11 02:22:20', '2022-06-11 02:22:20'),
(5, '20220701430', '', '089615657999', 6, '5 Diamons', 3740, '552992060', '1', 'EVOS RASYAH!', 18, 'BRI', 'Free Fire', 6, 'Pending', 'Menunggu Pembayaran', '', 'DF', '2022-07-01', '2022-07-01 11:12:24', '2022-07-01 11:12:24'),
(6, '202207013258', '', '089615657999', 4, '53 Diamonds + 6 Bonus', 17627, '282055369', '9470', 'dhenavri', 21, 'DANA Manual', 'Mobile Legends', 1, 'Pending', 'Menunggu Pembayaran', '089615657999', 'DF', '2022-07-01', '2022-07-01 13:06:29', '2022-07-01 13:06:29'),
(7, '202207019581', '', '089615657999', 19, '1000', 1579, '089615657999', '1', '', 21, 'DANA Manual', 'Three', 33, 'Success', 'Proses', '089615657999', 'DF', '2022-07-01', '2022-07-01 15:56:52', '2022-07-01 15:56:52'),
(8, '20220701105', 'irvanshihap', '089615657999', 19, '1000', 1500, '089615657999', '1', '', 10001, 'Saldo Akun', 'Three', 33, 'Canceled', 'Gagal memproses API Buyer -nuroyuoJKV3D', 'Saldo Akun', 'DF', '2022-07-01', '2022-07-01 16:03:19', '2022-07-01 16:03:19'),
(9, '202207013924', 'irvanshihap', '089615657999', 19, '1000', 2181, '089615657999', '1', '', 21, 'DANA Manual', 'Three', 33, 'Processing', 'Menunggu Pembayaran', '089615657999', 'DF', '2022-07-01', '2022-07-01 16:06:04', '2022-07-01 16:06:04'),
(10, '202207011273', 'irvanshihap', '089615657999', 19, '1000', 1500, '089615657999', '1', '', 10001, 'Saldo Akun', 'Three', 33, 'Success', 'Transaksi Succes', 'Saldo Akun', 'DF', '2022-07-01', '2022-07-01 16:09:31', '2022-07-01 16:09:31'),
(11, '202207018904', '', '081225927594', 10, '70 Diamond', 10000, '567572693', '1', 'NXSᅠJoooᅠ', 13, 'QRIS (DANA)', 'Free Fire', 6, 'Pending', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T132753375719FYNZQ', 'DF', '2022-07-01', '2022-07-01 20:12:27', '2022-07-01 20:12:27'),
(12, '202207014932', '', '089615657999', 19, '1000', 1500, '089615657999', '1', '', 13, 'QRIS (DANA)', 'Three', 33, 'Processing', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T132753375849G62LC', 'DF', '2022-07-01', '2022-07-01 20:21:44', '2022-07-01 20:21:44'),
(13, '202207027981', 'irvanshihap', '089615657999', 19, '1000', 1500, '089615657999', '1', '', 10001, 'Saldo Akun', 'Three', 33, 'Success', 'Transaksi Pending', 'Saldo Akun', 'DF', '2022-07-02', '2022-07-02 11:15:42', '2022-07-02 11:15:42'),
(14, '202207023285', '', '089615657999', 3, '25 Diamonds + 3 Bonus', 10498, '282055369', '9470', 'dhenavri', 21, 'DANA Manual', 'Mobile Legends', 1, 'Expired', 'Menunggu Pembayaran', '089615657999', 'DF', '2022-07-02', '2022-07-02 15:29:25', '2022-07-02 15:29:25'),
(15, '202207032998', '', '089615657999', 4, '86 (78+8) Diamonds', 20150, '282055369', '9470', 'dhenavri', 13, 'QRIS (DANA)', 'Mobile Legends', 1, 'Expired', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T13275343765417Z6V', 'DF', '2022-07-03', '2022-07-03 11:52:22', '2022-07-03 11:52:22'),
(16, '202207038689', 'irvanshihap', '089615657999', 20, '5 Diamonds ( 5 + 0 Bonus )', 2000, '282055369', '9470', 'dhenavri', 10001, 'Saldo Akun', 'Mobile Legends B', 14, 'Success', 'Sukses Terkirim - 2022-07-03 21:40:32 WIB', 'Saldo Akun', 'VP', '2022-07-03', '2022-07-03 21:40:25', '2022-07-03 21:40:25'),
(17, '202207036669', 'irvanshihap', '089615657999', 20, '5 Diamonds ( 5 + 0 Bonus )', 2000, '282055369', '9470', 'dhenavri', 10001, 'Saldo Akun', 'Mobile Legends B', 14, 'Success', '', 'Saldo Akun', 'VP', '2022-07-03', '2022-07-03 21:52:46', '2022-07-03 21:52:46'),
(18, '202207048764', 'irvanshihap', '089615657999', 1, '14 (13+1) Diamonds', 3500, '282055369', '9470', 'dhenavri', 13, 'QRIS (DANA)', 'Mobile Legends', 1, 'Expired', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T132753458458QSUIM', 'DF', '2022-07-04', '2022-07-04 09:01:16', '2022-07-04 09:01:16'),
(19, '202207059211', '', '089615657999', 19, '1000', 1500, '089615657999', '1', '', 13, 'QRIS (DANA)', 'Three', 33, 'Success', 'Transaksi Pending', 'https://tripay.co.id/qr/T132753475971NWIZS', 'DF', '2022-07-05', '2022-07-05 01:57:49', '2022-07-05 01:57:49'),
(20, '20220705501', 'irvanshihap', '089615657999', 19, '1000', 1500, '089615657999', '1', '', 12, 'QRIS (SHOPEEPAY)', 'Three', 33, 'Success', 'Tidak support transaksi multi', 'https://tripay.co.id/qr/T132753476062S4DLB', 'DF', '2022-07-05', '2022-07-05 02:20:28', '2022-07-05 02:20:28'),
(21, '202207057051', '', '089615657999', 3, '70 (64+6) Diamonds', 17500, '282055369', '9470', 'dhenavri', 13, 'QRIS (DANA)', 'Mobile Legends', 1, 'Expired', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T132753478404GCK1L', 'DF', '2022-07-05', '2022-07-05 09:23:44', '2022-07-05 09:23:44'),
(22, '202207059612', 'irvanshihap', '089615657999', 4, '86 (78+8) Diamonds', 20150, '282055369', '9470', 'dhenavri', 12, 'QRIS (SHOPEEPAY)', 'Mobile Legends', 1, 'Expired', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T1327534796242IR9L', 'DF', '2022-07-05', '2022-07-05 10:43:17', '2022-07-05 10:43:17'),
(23, '20220705111', '', '089615657999', 4, '86 (78+8) Diamonds', 20150, '282055369', '9470', 'dhenavri', 12, 'QRIS (SHOPEEPAY)', 'Mobile Legends', 1, 'Expired', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T132753489923PWELR', 'DF', '2022-07-05', '2022-07-05 22:05:40', '2022-07-05 22:05:40'),
(24, '20220705702', '', '089615656999', 4, '86 (78+8) Diamonds', 20150, '282055369', '9470', 'dhenavri', 12, 'QRIS (SHOPEEPAY)', 'Mobile Legends', 1, 'Expired', 'Menunggu Pembayaran', 'https://tripay.co.id/qr/T1327534900412YL5U', 'DF', '2022-07-05', '2022-07-05 22:20:29', '2022-07-05 22:20:29'),
(25, '20220716705', 'irvanshihap', '6289615657999', 7, '50 Diamonds', 6800, '2811483668', '1', '《CAKRA》RIDHX', 10001, 'Saldo Akun', 'Free Fire', 6, 'Canceled', 'Gagal memproses API Buyer -', 'Saldo Akun', 'DF', '2022-07-16', '2022-07-16 07:31:39', '2022-07-16 07:31:39'),
(26, '2022071668', 'irvanshihap', '6289615657999', 7, '50 Diamonds', 6800, '2811483668', '1', '《CAKRA》RIDHX', 10001, 'Saldo Akun', 'Free Fire', 6, 'Canceled', 'Failed Order', 'Saldo Akun', 'VP', '2022-07-16', '2022-07-16 07:33:52', '2022-07-16 07:33:52'),
(27, '202207169396', 'irvanshihap', '6289615657999', 7, '50 Diamonds', 6800, '1489145326', '1', 'MSC`Emperor1', 10001, 'Saldo Akun', 'Free Fire', 6, 'Canceled', 'Failed Order', 'Saldo Akun', 'VP', '2022-07-16', '2022-07-16 07:37:08', '2022-07-16 07:37:08'),
(28, '202207168553', 'irvanshihap', '6289615657999', 7, '50 Diamonds', 6800, '797982885', '1', 'ᴵᴬᴹＱｕｅｅｎ•', 10001, 'Saldo Akun', 'Free Fire', 6, 'Success', 'Sukses Terkirim - 2022-07-16 09:16:06 WIB', 'Saldo Akun', 'VP', '2022-07-16', '2022-07-16 09:16:05', '2022-07-16 09:16:05'),
(29, '202207161220', 'irvanshihap', '6289615657999', 7, '50 Diamonds', 6800, '2198690224', '1', 'ᏞᎾᎡᎠᴳᵀ', 10001, 'Saldo Akun', 'Free Fire', 6, 'Success', 'Sukses Terkirim - 2022-07-16 09:37:18 WIB', 'Saldo Akun', 'VP', '2022-07-16', '2022-07-16 09:37:17', '2022-07-16 09:37:17'),
(30, '202207169609', 'irvanshihap', '6289615657999', 7, '50 Diamonds', 6800, '2042509704', '1', 'EZRAㅤㅤ!!', 10001, 'Saldo Akun', 'Free Fire', 6, 'Success', 'Sukses Terkirim - 2022-07-16 09:49:11 WIB', 'Saldo Akun', 'VP', '2022-07-16', '2022-07-16 09:49:10', '2022-07-16 09:49:10'),
(31, '202207198081', '', '085157805539', 5, '140 (127+13) Diamonds', 35321, '39009599', '2061', 'MyersZa.', 21, 'DANA Manual', 'Mobile Legends', 1, 'Pending', 'Menunggu Pembayaran', '089615657999', 'DF', '2022-07-19', '2022-07-19 14:59:19', '2022-07-19 14:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `method_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `product_id`, `method_id`, `price`) VALUES
(1, 16, 20, 10000),
(2, 2, 10001, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `games_id` int(11) NOT NULL,
  `product` varchar(250) NOT NULL,
  `price` bigint(20) NOT NULL,
  `provider` varchar(250) NOT NULL,
  `sku` varchar(250) NOT NULL,
  `status` enum('On','Off') NOT NULL,
  `check_status` enum('Y','N') NOT NULL,
  `check_code` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `games_id`, `product`, `price`, `provider`, `sku`, `status`, `check_status`, `check_code`) VALUES
(1, 1, '14 (13+1) Diamonds', 3500, 'DF', 'ML14', 'On', 'Y', 'ml'),
(2, 1, '42 (38+14) Diamonds', 10500, 'DF', '4QiM06', 'On', 'Y', ''),
(3, 1, '70 (64+6) Diamonds', 17500, 'DF', '4QiO08', 'On', 'Y', ''),
(4, 1, '86 (78+8) Diamonds', 20150, 'DF', '4QiP09', 'On', 'Y', ''),
(5, 1, '140 (127+13) Diamonds', 35100, 'DF', '4QiQ10', 'On', 'Y', ''),
(6, 6, '25 Diamonds', 4000, 'VP', 'FF25-S24', 'On', 'Y', ''),
(7, 6, '50 Diamonds', 6800, 'VP', 'FF50-S24', 'On', 'Y', ''),
(8, 6, '70 Diamonds', 9500, 'VP', 'FF70-S24', 'On', 'Y', ''),
(9, 6, '100 Diamonds', 13600, 'DF', '4Rdj63', 'On', 'Y', ''),
(10, 6, '140 Diamonds', 18700, 'DF', '4Rdi62', 'On', 'Y', ''),
(11, 6, '210 Diamonds', 28100, 'DF', '4Rdn67', 'On', 'Y', ''),
(12, 6, '355 Diamonds', 46850, 'DF', '4Re282', 'On', 'Y', ''),
(13, 19, '35 UC', 7800, 'DF', 'PM35', 'On', 'Y', ''),
(14, 19, '50 UC', 10000, 'DF', 'PM50', 'On', 'Y', ''),
(15, 19, '70 UC', 14500, 'DF', 'PM70', 'On', 'Y', ''),
(16, 19, '125 UC', 24000, 'DF', 'PM125', 'On', 'Y', ''),
(17, 19, '250 UC', 46200, 'DF', 'PM250', 'On', 'Y', ''),
(18, 19, '500 UC', 95000, 'DF', 'PM500', 'On', 'Y', ''),
(19, 33, '1000', 1500, 'DF', '4crX03', 'On', 'Y', ''),
(20, 14, '5 Diamonds ( 5 + 0 Bonus )', 2000, 'VP', 'ML5_0-S13', 'On', 'Y', ''),
(21, 1, '172 (156+16) Diamonds', 40300, 'DF', '4QiR11', 'On', 'Y', ''),
(22, 1, '257 (234+23) Diamonds', 60450, 'DF', '4Qiu40', 'On', 'Y', ''),
(23, 1, '284 (254+30) Diamonds', 70150, 'DF', 'ML284', 'On', 'Y', ''),
(24, 1, '429 (390+39) Diamonds', 100750, 'DF', 'ML429', 'On', 'Y', ''),
(25, 1, 'Starlight Member', 125000, 'DF', 'MLSL', 'On', 'Y', ''),
(26, 1, 'Startlight Member Plus', 303500, 'DF', 'MLSLP', 'On', 'Y', ''),
(27, 1, 'Twilight Pass', 133600, 'DF', 'MLTP', 'On', 'Y', ''),
(28, 6, '425 Diamonds', 56250, 'DF', '4Re686', 'On', 'Y', ''),
(29, 6, 'Member Mingguan', 28400, 'DF', 'FFM', 'On', 'Y', ''),
(30, 6, 'Member Bulanan', 142000, 'DF', 'FFB', 'On', 'Y', ''),
(31, 14, '14 Diamonds ( 13 + 1 Bonus )', 4000, 'VP', 'ML13_1-S27', 'On', 'Y', ''),
(32, 14, '28 Diamonds ( 26 + 2 Bonus )', 7500, 'VP', 'ML26_2-S27', 'On', 'Y', ''),
(33, 14, '42 Diamonds ( 38 + 4 Bonus )', 10700, 'VP', 'ML38_4-S27', 'On', 'Y', ''),
(34, 14, '56 Diamonds ( 51 + 5 Bonus )', 14100, 'VP', 'ML51_5-S27', 'On', 'Y', ''),
(35, 14, '70 Diamonds ( 64 + 6 Bonus )', 17500, 'VP', 'ML64_6-S27', 'On', 'Y', ''),
(36, 14, '86 Diamonds ( 78 + 8 Bonus )', 20000, 'VP', 'ML78_8-S42', 'On', 'Y', ''),
(37, 13, '86 Diamonds (78 +8 Bonus)', 19500, 'VP', 'ML86-S2', 'On', 'Y', ''),
(38, 13, '172 Diamonds (156 +16 Bonus)', 38500, 'VP', 'ML172-S2', 'On', 'Y', ''),
(39, 13, '257 Diamonds (234+23 Bonus)', 57500, 'VP', 'ML257-S2', 'On', 'Y', ''),
(40, 38, '90 SG', 14700, 'VP', 'APEX90-S17', 'On', 'Y', ''),
(41, 38, '280 SG', 31500, 'VP', 'APEX280-S17', 'On', 'Y', ''),
(42, 38, '500 (465+35) SG', 58500, 'VP', 'APEX500-S17', 'On', 'Y', ''),
(43, 7, '60 GC', 12000, 'VP', 'GI60-S24', 'On', 'Y', ''),
(44, 7, '330 (300 + 30) GC', 60000, 'VP', 'GI330-S24', 'On', 'Y', ''),
(45, 7, 'Blessing of The Welkin Moon', 60000, 'VP', 'GIBWM-S24', 'On', 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE `topup` (
  `id` int(11) NOT NULL,
  `topup_id` varchar(55) NOT NULL,
  `username` varchar(250) NOT NULL,
  `method_id` int(11) NOT NULL,
  `method` varchar(250) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `status` enum('Pending','Success','Canceled') NOT NULL,
  `payment_code` varchar(500) NOT NULL,
  `date_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`id`, `topup_id`, `username`, `method_id`, `method`, `amount`, `status`, `payment_code`, `date_create`) VALUES
(3, '202207051012', 'irvanshihap', 21, 'DANA Manual', 50735, 'Success', '089615657999', '2022-07-05 07:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(250) NOT NULL,
  `balance` bigint(20) NOT NULL,
  `wa` varchar(100) NOT NULL,
  `status` enum('On','Off') NOT NULL,
  `date_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `balance`, `wa`, `status`, `date_create`) VALUES
(1, 'irvanshihap', '$2y$10$BgcVvjYLJ2pAtefA7b0NvOIjuCvR9oKjEI4qVQWBCXYzIGjKzCpc.', 51435, '089615657999', 'On', '2022-07-01 16:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `utility`
--

CREATE TABLE `utility` (
  `id` int(11) NOT NULL,
  `u_key` varchar(250) NOT NULL,
  `u_value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utility`
--

INSERT INTO `utility` (`id`, `u_key`, `u_value`) VALUES
(1, 'web-title', 'Layanan Top Up Games #1 Indonesia'),
(2, 'web-name', 'SquareStore'),
(3, 'web-logo', '1656586826_035b3f14018b95f0b0b1.png'),
(4, 'web-keywords', 'games'),
(5, 'web-description', '<p>Irvanshihap Game merupakan website TopUp Termurah, tercepat, dan terpercaya untuk layanan games dan entertainment.</p>\r\n'),
(6, 'tripay-key', '-'),
(7, 'tripay-private', 'ydhL0-2NavW-xUiQQ-lOXYz-jbOhI'),
(8, 'tripay-merchant', 'T13275'),
(9, 'digi-user', '-'),
(10, 'digi-key', '-'),
(11, 'ag-merchant', '-'),
(12, 'ag-secret', '-'),
(13, 'square-license', '58c5d93a-593f-4395-b161-071c88cf86be'),
(14, 'sm-wa', 'https://wa.me/6285157165223'),
(15, 'sm-ig', 'https://instagram.com/square_storeid'),
(16, 'sm-yt', 'https://youtube.com/c/irvanshihap'),
(17, 'sm-tw', 'https://twitter.com/#'),
(18, 'sm-fb', 'https://facebook.com/irvan.naru'),
(19, 'pay_balance', 'Y'),
(20, 'page_sk', '<p><strong>Kebijakan Privasi Irvanshihap Game melindungi penggunaan data dan informasi penting pengguna situs Irvanshihap Game. Data dan informasi yang dikumpulkan pada saat melakukan pendaftaran, mengakses dan menggunakan layanan di Irvanshihap Game, seperti email, nomor telepon, password dan lain-lain akan dilindungi oleh kebijakan privasi dari Irvanshihap Game.<br />\r\nKebijakan-kebijakan tersebut adalah:</strong></p>\r\n\r\n<p><strong>- 1. Dengan mendaftar atau telah terdaftar otomatis anda telah menyetujui ketentuan layanan Irvanshihap Game.<br />\r\n- 2. Saldo pada Irvanshihap Game tidak dapat di tarik, ke bank, pulsa, maupun ke e-wallet anda.<br />\r\n- 3. Irvanshihap Game berhak memblokir akun bila terdapat malakukan perbuatan yang dapat merugikan kami seperti hacking.<br />\r\n- 4. Irvanshihap Game tidak bertanggung jawab atas kehilangan akun anda.<br />\r\n- 5. Harga layanan kami dapat berubah sewaktu-waktu tanpa pemberitahuan anda.<br />\r\n- 6. Pesanan dalam status success tidak dapat di refund.<br />\r\n- 7. Irvanshihap Game tidak menjamin keamanan akun anda.<br />\r\n- 8. Kesalahan Penulisan Format bukan Tanggung Jawab Kami</strong></p>\r\n'),
(21, 'vp-user', ''),
(22, 'vp-key', ''),
(23, 'wa-key', '-'),
(24, 'wa-nomer', '6285157165223'),
(25, 'wa-fonnte', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utility`
--
ALTER TABLE `utility`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `topup`
--
ALTER TABLE `topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utility`
--
ALTER TABLE `utility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
