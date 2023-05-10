-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2023 at 02:19 PM
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
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `nama`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', '$2y$10$z64.jBdEu9wKR/BeUrAKieC7o3Cuh0P86qyCSb1npnA1cTS0Qesy2', 'admin'),
(2, 'staff', 'staff', '$2y$10$HzHWdSY9rc.CUB6vIHcqdul2DQdHc6IFfkUFFzZRQ.LzEMTgp/CwO', 'staff'),
(3, 'Rizky', 'rizky', '$2y$10$zlriOSeaO9KcFrRN7TsAMe3NTmeIaU8bKeg.HJXph9iqDYFpJETH2', 'user'),
(4, 'Indra Maulana', 'indra', '$2y$10$LIXoZqe3e19K4m3dSNWDwuRenMIjnUUHZnysRosaRqeWw4kXIqdUa', 'user'),
(5, 'ali', 'ali', '$2y$10$oXiwmMm2Ly89lxgOC3YIQuOIBVBCWA6csJnN0yxnJqEJ.YkYlWqeq', 'user');

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
  `id_tarif` int NOT NULL,
  `id_login` int NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meter`
--

INSERT INTO `meter` (`id_meter`, `no_meter`, `pemilik`, `alamat`, `telp`, `id_tarif`, `id_login`, `status`) VALUES
(1, '0232120417', 'Rizky Anugrah', 'Jalan Biawan', '085754612468', 1, 3, 1),
(3, '5542872143', 'Ali Khatami', 'Lambung Mangkurat', '0872713881', 1, 5, 1);

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
(1, 1, 26, '2023-05-07', 2000, 452000),
(2, 1, 27, '2023-05-07', 2000, 3002000);

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
(1, '0232120417', 5, 2023, 750, 900),
(2, '3969545812', 5, 2023, 900, 1200),
(3, '5542872143', 5, 2023, 750, 900),
(4, '5542872143', 6, 2023, 900, 1200);

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
(25, 1, 150, 0),
(26, 2, 300, 1),
(27, 3, 150, 1),
(28, 4, 300, 0);

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
  `tarif_kwh` int NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarif_kwh`, `status`) VALUES
(1, 3400, 20000, 1),
(2, 900, 10000, 1);

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
  ADD KEY `id_tarif` (`id_tarif`),
  ADD KEY `id_login` (`id_login`);

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
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meter`
--
ALTER TABLE `meter`
  MODIFY `id_meter` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  ADD CONSTRAINT `meter_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meter_ibfk_2` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
