-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2023 at 03:39 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pln`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `level`, `aktif`) VALUES
(1, 'admin', 'admin', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meter`
--

CREATE TABLE `meter` (
  `id_meter` int NOT NULL,
  `no_meter` varchar(12) DEFAULT NULL,
  `pemilik` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `id_tarif` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meter`
--

INSERT INTO `meter` (`id_meter`, `no_meter`, `pemilik`, `alamat`, `telp`, `id_tarif`) VALUES
(38, '1111', 'Budi', 'Jalanan', '08234324234', 4),
(39, '5555', 'budi', 'bumi', '08434234234', 4),
(40, '2222', 'Jajang', 'Bumi', '08435453534', 4),
(41, '3232', 'Kaka', 'Jalan', '0823443231', 4),
(42, '2121', 'Jordy', 'Bumi', '08342876678', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_login` int NOT NULL,
  `id_tagihan` int NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `biaya_admin` int NOT NULL,
  `biaya_tagihan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_login`, `id_tagihan`, `tanggal_bayar`, `biaya_admin`, `biaya_tagihan`) VALUES
(7, 1, 84, '2019-10-23', 2000, 202000),
(8, 1, 81, '2019-10-23', 2000, 1002000),
(9, 1, 88, '2019-10-23', 2000, 77000),
(10, 1, 89, '2019-10-23', 2000, 32000),
(11, 1, 82, '2019-10-23', 2000, 202000),
(12, 1, 83, '2019-10-23', 2000, 402000),
(13, 1, 85, '2019-10-23', 2000, 1002000),
(14, 1, 86, '2019-10-23', 2000, 6002000),
(15, 1, 87, '2019-10-23', 2000, 3002000),
(16, 1, 91, '2019-10-23', 2000, 202000),
(17, 1, 92, '2019-10-23', 2000, 2102000),
(18, 1, 93, '2019-10-23', 2000, 602000),
(19, 1, 94, '2019-10-24', 2000, 3702000),
(20, 1, 95, '2019-10-24', 2000, 2002000),
(21, 1, 96, '2019-10-24', 2000, 2302000),
(22, 1, 97, '2019-10-24', 2000, 2002000),
(23, 1, 98, '2019-10-24', 2000, 1702000);

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `terbayar` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN
UPDATE tagihan SET tagihan.status = '1'
WHERE id_tagihan = new.id_tagihan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` int NOT NULL,
  `no_meter` varchar(12) NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `meter_awal` int NOT NULL,
  `meter_akhir` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `no_meter`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
(83, '1111', 10, 2019, 10, 60),
(84, '1111', 11, 2019, 60, 70),
(85, '1111', 12, 2019, 70, 90),
(86, '1111', 1, 2020, 90, 100),
(87, '1111', 2, 2020, 100, 150),
(88, '1111', 3, 2020, 150, 450),
(89, '1111', 4, 2020, 450, 600),
(90, '2121', 10, 2019, 30, 80),
(91, '2121', 11, 2019, 80, 100),
(92, '2121', 12, 2019, 100, 130),
(93, '2222', 10, 2019, 70, 80),
(94, '2222', 11, 2019, 80, 185),
(95, '2222', 12, 2019, 185, 215),
(96, '2222', 1, 2020, 215, 400),
(97, '2222', 2, 2020, 400, 500),
(98, '2222', 3, 2020, 500, 615),
(99, '1111', 5, 2020, 600, 700),
(100, '1111', 6, 2020, 700, 785);

--
-- Triggers `penggunaan`
--
DELIMITER $$
CREATE TRIGGER `tambah_tagihan` AFTER INSERT ON `penggunaan` FOR EACH ROW BEGIN
INSERT INTO tagihan SET id_penggunaan = new.id_penggunaan,
jumlah_meter = new.meter_akhir - new.meter_awal;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tagihan` AFTER UPDATE ON `penggunaan` FOR EACH ROW BEGIN
UPDATE tagihan SET tagihan.jumlah_meter = new.meter_akhir - new.meter_awal
WHERE tagihan.id_penggunaan = old.id_penggunaan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int NOT NULL,
  `id_penggunaan` int NOT NULL,
  `jumlah_meter` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `jumlah_meter`, `status`) VALUES
(81, 83, 50, 1),
(82, 84, 10, 1),
(83, 85, 20, 1),
(84, 86, 10, 1),
(85, 87, 50, 1),
(86, 88, 300, 1),
(87, 89, 150, 1),
(88, 90, 50, 1),
(89, 91, 20, 1),
(90, 92, 30, 0),
(91, 93, 10, 1),
(92, 94, 105, 1),
(93, 95, 30, 1),
(94, 96, 185, 1),
(95, 97, 100, 1),
(96, 98, 115, 1),
(97, 99, 100, 1),
(98, 100, 85, 1);

--
-- Triggers `tagihan`
--
DELIMITER $$
CREATE TRIGGER `deldel` AFTER DELETE ON `tagihan` FOR EACH ROW BEGIN
DELETE FROM penggunaan WHERE id_penggunaan = old.id_penggunaan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int NOT NULL,
  `daya` int NOT NULL,
  `tarif_kwh` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarif_kwh`) VALUES
(4, 3400, 20000),
(5, 900, 1500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `meter`
--
ALTER TABLE `meter`
  ADD PRIMARY KEY (`id_meter`),
  ADD UNIQUE KEY `no_meter` (`no_meter`),
  ADD KEY `id_tarif` (`id_tarif`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_login` (`id_login`),
  ADD KEY `id_tagihan` (`id_tagihan`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `no_meter` (`no_meter`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `id_penggunaan` (`id_penggunaan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`),
  ADD UNIQUE KEY `daya` (`daya`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `meter`
--
ALTER TABLE `meter`
  MODIFY `id_meter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meter`
--
ALTER TABLE `meter`
  ADD CONSTRAINT `meter_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`);

--
-- Constraints for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`no_meter`) REFERENCES `meter` (`no_meter`) ON UPDATE CASCADE;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
