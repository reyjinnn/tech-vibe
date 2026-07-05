-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tekno
CREATE DATABASE IF NOT EXISTS `tekno` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tekno`;

-- Dumping structure for table tekno.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `kuantiti` int NOT NULL,
  `gambar` varchar(191) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `total` int NOT NULL,
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.cart: ~2 rows (approximately)
INSERT INTO `cart` (`id_cart`, `id_user`, `id_produk`, `nama`, `harga`, `kuantiti`, `gambar`, `kategori`, `total`) VALUES
	(1, 1, 64, 'CPU Fan Water Cooler Blue', 1760000, 3, '2121010131311612084289fanwatercooler.jfif', 'Komputer', 1760000),
	(19, 8, 76, 'iPhone 12 purple', 9000000, 1, '252501010808173631339812.jpg', 'Ponsel', 9000000);

-- Dumping structure for table tekno.kontak
CREATE TABLE IF NOT EXISTS `kontak` (
  `id_kontak` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tentang` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `tgl` datetime NOT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.kontak: ~1 rows (approximately)
INSERT INTO `kontak` (`id_kontak`, `nama`, `email`, `tentang`, `pesan`, `tgl`) VALUES
	(3, 'Raihan ', 'raihan@gmail.com', 'apaya', 'apaya', '2025-10-13 01:44:50');

-- Dumping structure for table tekno.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int NOT NULL AUTO_INCREMENT,
  `id_pesan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nominal` int NOT NULL,
  `gambar` varchar(191) NOT NULL,
  PRIMARY KEY (`id_pembayaran`),
  UNIQUE KEY `id_pesan` (`id_pesan`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.pembayaran: ~7 rows (approximately)
INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesan`, `nama`, `nominal`, `gambar`) VALUES
	(3, '1219061106', 'Bayu Pamungkas', 9000000, '1171632372-2021-01-31-09-25-26-lenovoyoga.jpg'),
	(4, '184795202', 'Bayu Pamungkas', 6760000, '1044008663-2021-02-01-04-45-52-Bukti-Transfer-BRI-Terbaru-dan-Terlengkap.jpg'),
	(5, '1455538211', 'bayu', 62990000, '1688404207-2021-02-01-04-55-04-Bukti-Transfer-BRI-Terbaru-dan-Terlengkap.jpg'),
	(6, '1653968279', 'askogsanf', 124142, '38043315-2025-01-06-06-20-57-19862.jpg'),
	(7, '183649107', 'Logitech G Pro X mechanical gaming', 1, '1593250521-2025-01-07-09-57-46-19862.jpg'),
	(8, '217839995', 'dasdsa', 4194410, 'PAY_68ec57fca32297.25764861_2025-10-13-01-38-04_19984.jpg'),
	(9, '2032998553', 'test', 51000000, 'PAY_6a44b0f5164911.62656598_2026-07-01-06-17-25_LJK-filled2.png');

-- Dumping structure for table tekno.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `id_produk` int NOT NULL,
  `jual` int NOT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.penjualan: ~13 rows (approximately)
INSERT INTO `penjualan` (`id_penjualan`, `id_produk`, `jual`) VALUES
	(7, 63, 2),
	(8, 64, 2),
	(9, 59, 2),
	(10, 58, 2),
	(11, 61, 2),
	(12, 62, 2),
	(13, 57, 2),
	(14, 70, 2),
	(15, 68, 2),
	(16, 71, 2),
	(17, 60, 2),
	(18, 77, 2),
	(19, 75, 2);

-- Dumping structure for table tekno.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `gambar` varchar(191) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `createat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.produk: ~15 rows (approximately)
INSERT INTO `produk` (`id_produk`, `nama`, `harga`, `stok`, `gambar`, `kategori`, `deskripsi`, `createat`, `updateat`) VALUES
	(58, 'Laptop lenovo', 6000000, 5, '2121010124241611450092lenovothinkpade480.jpg', 'Laptop', '\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus officiis harum id voluptas fugit, voluptatem pariatur voluptatum vel culpa magnam, dolorum blanditiis quae ut illo libero non a, obcaecati iusto?', '2021-01-31 18:00:33', NULL),
	(60, 'Lenovo Yoga S', 12000000, 9, '2121010124241611487700lenovoyoga.jpg', 'Laptop', 'LAptop murah berkualitas cocok untuk anda yang sering bekerja memanfaatkan laptop, laptop dengan spesifikasi yang cukup bagus mampu bekerja setiap hari.', '2025-01-07 15:49:12', NULL),
	(62, 'Mobo MSI Gaming', 2600000, 5, '2121010131311612084164mobomsigaming.jfif', 'Komputer', 'Menampilkan pre-installed I/O shielding, membuat proses instalasi Anda lebih mudah dan lebih aman. Desain patent-pending yang melindungi port I / O Anda dan juga mencegah electrostatic discharge damage, menjadikan motherboard Anda fondasi gaming yang kuat', '2025-01-07 15:45:28', NULL),
	(64, 'CPU Fan Water Cooler Blue', 1760000, 3, '2121010131311612084289fanwatercooler.jfif', 'Komputer', 'Mendinginkan PC Anda adalah penting untuk kinerja yang andal. Motherboard MSI memiliki power design yang luar biasa dengan heatsink yang solid dan heavy. Kami telah memastikan untuk menyertakan fan headers yang cukup dengan kontrol penuh yang memungkinkan Anda untuk mendinginkan sistem sesuka Anda ', '2021-01-31 17:57:49', NULL),
	(67, 'Logitech MX Master 3', 1299000, 21, '2525010107071736225809mouselogitech.jpg', 'Komputer', 'Mouse ergonomis dengan teknologi Darkfield, dapat digunakan di berbagai permukaan termasuk kaca. Dikenal karena kenyamanan dan kemampuan multitasking.\r\nSpesifikasi:\r\nSensor: Darkfield High Precision\r\nDPI: 200-4000\r\nKonektivitas: Bluetooth &amp; USB receiver\r\nBaterai: Rechargeable, hingga 70 hari', '2025-01-07 05:56:49', NULL),
	(68, 'Razer DeathAdder V2', 499000, 15, '25250101070717362260121.jpg', 'Komputer', 'Mouse gaming dengan desain ergonomis, terkenal dengan performa tinggi dan kenyamanan saat digunakan dalam waktu lama.\r\nSpesifikasi:\r\nSensor: Razer Focus+ Optical Sensor\r\nDPI: Hingga 20.000\r\nKonektivitas: Wired\r\nTombol: 7 programmable buttons', '2025-01-07 15:56:22', NULL),
	(69, 'SteelSeries Rival 600', 1299000, 15, '25250101070717362263931.jpg', 'Komputer', 'Mouse gaming dengan dual sensor untuk akurasi tinggi dan sistem pengaturan berat yang unik.\r\nSpesifikasi:\r\nSensor: TrueMove3+\r\nDPI: Hingga 12.000\r\nKonektivitas: Wired\r\nTombol: 7 programmable buttons', '2025-01-07 06:01:37', '2025-01-07 06:06:33'),
	(70, 'NVIDIA GeForce RTX 4090', 23550000, 1, '25250101070717362262363.jpg', 'Komputer', 'Kartu grafis high-end untuk gaming dan pekerjaan grafis berat, mendukung ray tracing dan AI.\r\nSpesifikasi:\r\nMemori: 24GB GDDR6X\r\nCUDA Cores: 16.384\r\nTDP: 450W', '2025-01-09 11:31:42', NULL),
	(71, 'NVIDIA GeForce RTX 4080', 17500000, 5, '25250101070717362265494.jpg', 'Komputer', 'Kartu grafis premium yang menawarkan performa tinggi untuk gaming 4K dan aplikasi kreatif.\r\nSpesifikasi:\r\nMemori: 16GB GDDR6X\r\nCUDA Cores: 9.728\r\nTDP: 320W', '2025-01-07 15:45:28', NULL),
	(72, 'Corsair Vengeance LPX', 850000, 9, '25250101070717362266545.jpg', 'Komputer', 'RAM DDR4 yang dirancang untuk performa tinggi dengan heatsink rendah untuk kompatibilitas dengan casing kecil.\r\nSpesifikasi:\r\nKapasitas: 16GB (2 x 8GB)\r\nKecepatan: 3200MHz\r\nTipe: DDR4', '2025-01-07 06:10:54', NULL),
	(73, 'iPhone 11 black', 8000000, 20, '252501010808173631281211.jpg', 'Ponsel', 'Smartphone dengan layar Liquid Retina, kamera ganda, dan performa tinggi dari chip A13 Bionic.\r\n\r\nSpesifikasi:\r\n\r\nLayar: 6.1 inci Liquid Retina\r\n\r\nProsesor: A13 Bionic\r\n\r\nRAM: 4GB\r\n\r\nPenyimpanan: 128GB\r\n\r\nKamera Belakang: 12MP + 12MP', '2025-01-08 06:06:52', NULL),
	(74, 'iPhone 11 Pro midnight', 12000000, 17, '252501010808173631291411pro.jpg', 'Ponsel', 'Smartphone premium dengan layar Super Retina XDR, tiga kamera belakang, dan performa luar biasa.\r\n\r\nSpesifikasi:\r\n\r\nLayar: 5.8 inci Super Retina XDR\r\n\r\nProsesor: A13 Bionic\r\n\r\nRAM: 4GB\r\n\r\nPenyimpanan: 256GB\r\n\r\nKamera Belakang: 12MP + 12MP + 12MP', '2025-01-08 06:08:34', NULL),
	(75, 'iPhone 11 Pro Max midnight green', 14500000, 19, '252501010808173631370311promax.jpg', 'Ponsel', 'Versi terbesar dari iPhone 11 dengan layar lebih besar dan daya tahan baterai yang lebih baik.\r\nSpesifikasi:\r\nLayar: 6.5 inci Super Retina XDR\r\nProsesor: A13 Bionic\r\nRAM: 4GB\r\nPenyimpanan: 64GB/256GB/512GB\r\nKamera Belakang: 12MP + 12MP + 12MP', '2025-01-09 11:31:42', '2025-01-08 06:21:43'),
	(76, 'iPhone 12 purple', 9000000, 19, '252501010808173631339812.jpg', 'Ponsel', 'Smartphone dengan desain baru, chip A14 Bionic, dan dukungan 5G.\r\nSpesifikasi:\r\nLayar: 6.1 inci Super Retina XDR\r\nProsesor: A14 Bionic\r\nRAM: 4GB\r\nPenyimpanan: 64GB/128GB/256GB\r\nKamera Belakang: 12MP + 12MP', '2025-01-08 06:16:38', NULL),
	(77, 'iPhone 12 Pro midnight', 13000000, 33, '252501010808173631351412pro.jpg', 'Ponsel', 'Model pro dengan kamera lebih baik dan material premium.\r\nSpesifikasi:\r\nLayar: 6.1 inci Super Retina XDR\r\nProsesor: A14 Bionic\r\nRAM: 6GB\r\nPenyimpanan: 128GB\r\nKamera Belakang: 12MP + 12MP + 12MP', '2025-01-09 11:31:42', NULL);

-- Dumping structure for table tekno.status
CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.status: ~4 rows (approximately)
INSERT INTO `status` (`id_status`, `keterangan`) VALUES
	(0, ''),
	(1, 'Di proses'),
	(2, 'Di kirim'),
	(3, 'Di terima');

-- Dumping structure for table tekno.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pesan` int NOT NULL,
  `id_user` int NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `telepon` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `kuantiti_total` int NOT NULL,
  `total_akhir` int NOT NULL,
  `pembayaran` int NOT NULL,
  `id_status` int NOT NULL,
  `pesan_at` datetime NOT NULL,
  `kirim_at` datetime DEFAULT NULL,
  `terima_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pesan`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.transaksi: ~21 rows (approximately)
INSERT INTO `transaksi` (`id`, `id_pesan`, `id_user`, `pengirim`, `penerima`, `alamat`, `telepon`, `email`, `kuantiti_total`, `total_akhir`, `pembayaran`, `id_status`, `pesan_at`, `kirim_at`, `terima_at`) VALUES
	(20, 8634589, 9, 'Techvibe', 'dsad', 'dasa', 1, 'hi@dsad', 1, 14500000, 0, 0, '2025-10-13 01:14:26', NULL, NULL),
	(10, 183649107, 8, '', 'd', 'd', 0, 'd@f', 2, 26150000, 1, 3, '2025-01-07 09:09:01', '2025-01-07 09:58:18', NULL),
	(4, 184795202, 1, 'Bayu Pamungkas', 'Marniyem', 'Jawa Tengah , Wonosari , Jamaica, Rt 11 Rw 2', 2147483647, 'marniyem@gmail.com', 2, 6760000, 1, 2, '2021-01-31 11:41:38', '2021-02-01 04:53:09', NULL),
	(22, 217839995, 9, 'Techvibe', 'dsad', 'dasa', 1, 'hi@dsad', 1, 14500000, 1, 0, '2025-10-13 01:18:03', NULL, NULL),
	(12, 233098529, 8, '', 'w', 'fq', 0, 'fqf@f', 1, 23550000, 0, 0, '2025-01-07 09:11:07', NULL, NULL),
	(17, 267278412, 8, '', 'wt', 'q', 3, 'q@a', 1, 3299000, 0, 0, '2025-01-07 09:51:33', NULL, NULL),
	(13, 406253140, 8, '', 'dwqdq', 'dwq', 0, 'fqe@k', 1, 23550000, 0, 0, '2025-01-07 09:11:24', NULL, NULL),
	(14, 406507730, 8, '', 'q', 'q', 9, 'q@a', 6, 26298000, 0, 0, '2025-01-07 09:45:28', NULL, NULL),
	(9, 701741539, 6, '', '', '', 0, '', 0, 0, 0, 0, '2025-01-06 08:25:45', NULL, NULL),
	(8, 929627326, 6, '', '', '', 0, '', 1, 1909999, 0, 0, '2025-01-06 08:25:10', NULL, NULL),
	(3, 1098598934, 1, 'Narto Saminto', 'Saskeh ', 'Konoha. rt 02 Rw 03', 2147483647, 'saske@gmail.com', 1, 5000000, 0, 0, '2021-01-31 11:34:03', NULL, NULL),
	(2, 1219061106, 1, 'Bayu Pamungkas', 'bayu pamungkas', 'lopawon, Kebobang, Wonosari', 2147483647, 'bayu@gmail.com', 1, 9000000, 1, 3, '2021-01-31 04:56:21', NULL, NULL),
	(7, 1358849537, 6, '', '', '', 0, '', 1, 2600000, 0, 0, '2025-01-06 08:21:15', NULL, NULL),
	(11, 1402941721, 8, '', 'd', 'd', 0, 'd@f', 2, 26150000, 0, 0, '2025-01-07 09:10:32', NULL, NULL),
	(5, 1455538211, 1, 'Bayu Pamungkas', 'bayu pamungkas', 'lopawon, Kebobang, Wonosari', 2147483647, 'bayu@gmail.com', 15, 62990000, 1, 0, '2021-01-31 12:00:33', NULL, NULL),
	(16, 1610639440, 8, '', 'q', 'q', 2, 'q@a', 1, 12000000, 0, 0, '2025-01-07 09:49:12', NULL, NULL),
	(15, 1644762404, 8, '', 'q', 'q', 1, 'q@a', 1, 3299000, 0, 0, '2025-01-07 09:48:16', NULL, NULL),
	(6, 1653968279, 5, 'dwwqrq', 'reqrqw', 'ddqfqf', 2142, 'dwq@dsa', 1, 9000000, 1, 0, '2025-01-06 06:20:30', NULL, NULL),
	(21, 1886819494, 9, 'Techvibe', 'dsad', 'dasa', 1, 'hi@dsad', 1, 14500000, 0, 0, '2025-10-13 01:15:53', NULL, NULL),
	(19, 2032998553, 8, '', 'q', 'qq', 1, 'q@aq', 4, 51050000, 1, 0, '2025-01-09 05:31:42', NULL, NULL),
	(18, 2146723424, 8, '', 'q', 'q', 1, 'q@a', 1, 499000, 0, 0, '2025-01-07 09:56:22', NULL, NULL);

-- Dumping structure for table tekno.transaksi_detail
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_pesan` int NOT NULL,
  `id_produk` int NOT NULL,
  `kuantiti` int NOT NULL,
  `total` int NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.transaksi_detail: ~23 rows (approximately)
INSERT INTO `transaksi_detail` (`id_transaksi`, `id_pesan`, `id_produk`, `kuantiti`, `total`) VALUES
	(1, 1219061106, 61, 1, 9000000),
	(9, 1098598934, 63, 1, 5000000),
	(10, 184795202, 63, 1, 5000000),
	(11, 184795202, 64, 1, 1760000),
	(12, 1455538211, 59, 10, 32990000),
	(13, 1455538211, 58, 5, 30000000),
	(14, 1653968279, 61, 1, 9000000),
	(15, 1358849537, 62, 1, 2600000),
	(16, 929627326, 57, 1, 1909999),
	(17, 183649107, 62, 1, 2600000),
	(18, 183649107, 70, 1, 23550000),
	(19, 233098529, 70, 1, 23550000),
	(20, 406507730, 68, 2, 998000),
	(21, 406507730, 71, 1, 17500000),
	(22, 406507730, 62, 3, 7800000),
	(23, 1644762404, 59, 1, 3299000),
	(24, 1610639440, 60, 1, 12000000),
	(25, 267278412, 59, 1, 3299000),
	(26, 2146723424, 68, 1, 499000),
	(27, 2032998553, 70, 1, 23550000),
	(28, 2032998553, 77, 2, 13000000),
	(29, 2032998553, 75, 1, 14500000),
	(30, 217839995, 75, 1, 14500000);

-- Dumping structure for table tekno.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sandi` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `role` varchar(15) NOT NULL,
  `createat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table tekno.users: ~3 rows (approximately)
INSERT INTO `users` (`id_user`, `nama`, `email`, `sandi`, `image`, `role`, `createat`, `updateat`) VALUES
	(7, 'admin', 'admin@gmail.com', '$2y$10$Dpsqi3uV43iHcCczKcDopeyDPhvIspurdNeXreLKD00xUI1KzulNW', 'default.png', '1', '2025-01-07 09:39:54', NULL),
	(8, 'user', 'user@gmail.com', '$2y$10$QwW442DGaZpDbEw6nxZr1OxG/DddVS1iS7s96NGM9TW1UQW/VM2OW', 'default.png', '2', '2025-01-07 03:39:04', NULL),
	(9, 'apaya', 'apaya@gmail.com', '$2y$10$w5t48TELhmuzPeGc77tkru1SaFoCbbkiLFgBzZ1FRzoQRRYM4fQ56', 'default.png', '2', '2025-10-13 01:02:02', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
