-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 11:12 AM
-- Server version: 8.0.29
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flaying`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandara`
--

CREATE TABLE `bandara` (
  `kode_bandara` int NOT NULL,
  `nama_bandara` varchar(30) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bandara`
--

INSERT INTO `bandara` (`kode_bandara`, `nama_bandara`, `kota`) VALUES
(1, 'Halim Perdanakusuma', 'Jakarta'),
(2, 'Sultan Syarif Kasim II', 'Pekanbaru');

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `no_maskapai` int NOT NULL,
  `nama_maskapai` varchar(30) DEFAULT NULL,
  `alamat_kantor` varchar(30) DEFAULT NULL,
  `kontak` int DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `jumlah_pesawat` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`no_maskapai`, `nama_maskapai`, `alamat_kantor`, `kontak`, `email`, `jumlah_pesawat`) VALUES
(1, 'Lion Air', 'Jakarta Pusat', 63798000, 'customercare@lionairgroup.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `memesan`
--

CREATE TABLE `memesan` (
  `id_pemesanan` int NOT NULL,
  `no_penerbangan` int NOT NULL,
  `no_penumpang` int DEFAULT NULL,
  `no_kursi` int DEFAULT NULL,
  `waktu_pemesanan` datetime DEFAULT NULL,
  `terbayar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `memesan`
--

INSERT INTO `memesan` (`id_pemesanan`, `no_penerbangan`, `no_penumpang`, `no_kursi`, `waktu_pemesanan`, `terbayar`) VALUES
(3, 2, 1, 2, '2022-08-19 09:32:32', 1),
(4, 2, 1, 2, '2022-08-19 09:50:59', 1),
(7, 2, 3, 2, '2022-08-20 03:56:51', 1),
(8, 2, 3, 2, '2022-08-20 03:57:31', 1),
(9, 3, 3, 2, '2022-08-20 04:11:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menaungi`
--

CREATE TABLE `menaungi` (
  `kode_bandara` int NOT NULL,
  `no_maskapai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menaungi`
--

INSERT INTO `menaungi` (`kode_bandara`, `no_maskapai`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penerbangan`
--

CREATE TABLE `penerbangan` (
  `no_penerbangan` int NOT NULL,
  `bandara_keberangkatan` varchar(30) DEFAULT NULL,
  `bandara_tujuan` varchar(30) DEFAULT NULL,
  `tanggal_keberangkatan` date DEFAULT NULL,
  `jam_keberangkatan` varchar(10) DEFAULT NULL,
  `jam_kedatangan` varchar(10) DEFAULT NULL,
  `no_gate` int DEFAULT NULL,
  `harga` int NOT NULL,
  `no_maskapai` int DEFAULT NULL,
  `no_pesawat` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penerbangan`
--

INSERT INTO `penerbangan` (`no_penerbangan`, `bandara_keberangkatan`, `bandara_tujuan`, `tanggal_keberangkatan`, `jam_keberangkatan`, `jam_kedatangan`, `no_gate`, `harga`, `no_maskapai`, `no_pesawat`) VALUES
(1, 'Jakarta', 'Pekanbaru', '2022-08-23', '10:00', '12:00', 2, 0, 1, 1),
(2, 'Pekanbaru', 'Jakarta', '2022-08-23', '13:00', '15:10', 3, 1000000, 1, 1),
(3, 'Pekanbaru', 'Pontianak', '2022-08-24', '08:00', '11:00', 1, 1800000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `no_penumpang` int NOT NULL,
  `nama_penumpang` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`no_penumpang`, `nama_penumpang`, `email`, `password`) VALUES
(1, 'Alaik', 'alaik@gmail.com', 'alaik'),
(2, 'Bambang', 'bambang@gmail.com', 'bambang'),
(3, 'ridho', 'ridho@gmail.com', 'ridho');

-- --------------------------------------------------------

--
-- Table structure for table `pesawat`
--

CREATE TABLE `pesawat` (
  `no_pesawat` int NOT NULL,
  `jenis` varchar(30) DEFAULT NULL,
  `kapasitas_penumpang` int DEFAULT NULL,
  `no_maskapai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesawat`
--

INSERT INTO `pesawat` (`no_pesawat`, `jenis`, `kapasitas_penumpang`, `no_maskapai`) VALUES
(1, 'BOEING', 100, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandara`
--
ALTER TABLE `bandara`
  ADD PRIMARY KEY (`kode_bandara`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`no_maskapai`);

--
-- Indexes for table `memesan`
--
ALTER TABLE `memesan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `no_penerbangan` (`no_penerbangan`,`no_penumpang`),
  ADD KEY `no_penumpang` (`no_penumpang`);

--
-- Indexes for table `menaungi`
--
ALTER TABLE `menaungi`
  ADD PRIMARY KEY (`kode_bandara`),
  ADD KEY `no_maskapai` (`no_maskapai`);

--
-- Indexes for table `penerbangan`
--
ALTER TABLE `penerbangan`
  ADD PRIMARY KEY (`no_penerbangan`),
  ADD KEY `no_maskapai` (`no_maskapai`),
  ADD KEY `no_pesawat` (`no_pesawat`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`no_penumpang`);

--
-- Indexes for table `pesawat`
--
ALTER TABLE `pesawat`
  ADD PRIMARY KEY (`no_pesawat`),
  ADD KEY `no_maskapai` (`no_maskapai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memesan`
--
ALTER TABLE `memesan`
  MODIFY `id_pemesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `no_penumpang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memesan`
--
ALTER TABLE `memesan`
  ADD CONSTRAINT `memesan_ibfk_1` FOREIGN KEY (`no_penerbangan`) REFERENCES `penerbangan` (`no_penerbangan`),
  ADD CONSTRAINT `memesan_ibfk_2` FOREIGN KEY (`no_penumpang`) REFERENCES `penumpang` (`no_penumpang`);

--
-- Constraints for table `menaungi`
--
ALTER TABLE `menaungi`
  ADD CONSTRAINT `menaungi_ibfk_1` FOREIGN KEY (`kode_bandara`) REFERENCES `bandara` (`kode_bandara`),
  ADD CONSTRAINT `menaungi_ibfk_2` FOREIGN KEY (`no_maskapai`) REFERENCES `maskapai` (`no_maskapai`);

--
-- Constraints for table `penerbangan`
--
ALTER TABLE `penerbangan`
  ADD CONSTRAINT `penerbangan_ibfk_1` FOREIGN KEY (`no_maskapai`) REFERENCES `maskapai` (`no_maskapai`),
  ADD CONSTRAINT `penerbangan_ibfk_2` FOREIGN KEY (`no_pesawat`) REFERENCES `pesawat` (`no_pesawat`);

--
-- Constraints for table `pesawat`
--
ALTER TABLE `pesawat`
  ADD CONSTRAINT `pesawat_ibfk_1` FOREIGN KEY (`no_maskapai`) REFERENCES `maskapai` (`no_maskapai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
