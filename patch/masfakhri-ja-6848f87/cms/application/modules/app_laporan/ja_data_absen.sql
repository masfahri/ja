-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 25, 2016 at 02:21 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jempolasik`
--

-- --------------------------------------------------------

--
-- Table structure for table `ja_data_absen`
--

CREATE TABLE `ja_data_absen` (
  `id` int(10) NOT NULL,
  `pin` int(10) DEFAULT NULL,
  `absen` int(11) NOT NULL,
  `id_kelas` int(222) DEFAULT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_pulang` datetime NOT NULL,
  `tanggal` date NOT NULL,
  `ver` int(10) NOT NULL,
  `telat` enum('0','1') NOT NULL DEFAULT '0',
  `status` int(10) NOT NULL,
  `sms_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_data_absen`
--

INSERT INTO `ja_data_absen` (`id`, `pin`, `absen`, `id_kelas`, `jam_masuk`, `jam_pulang`, `tanggal`, `ver`, `telat`, `status`, `sms_status`) VALUES
(1, 2, 1, 1, '2016-12-11 17:40:31', '0000-00-00 00:00:00', '2016-12-11', 0, '0', 1, '1'),
(2, 3, 2, 1, '2016-12-11 17:40:34', '0000-00-00 00:00:00', '2016-12-11', 0, '0', 1, '1'),
(3, 4, 3, 1, '2016-12-11 17:40:36', '0000-00-00 00:00:00', '2016-12-11', 0, '0', 1, '1'),
(4, 5, 1, 2, '2016-12-11 17:40:41', '0000-00-00 00:00:00', '2016-12-11', 0, '0', 1, '1'),
(5, 6, 2, 2, '2016-12-11 17:40:42', '0000-00-00 00:00:00', '2016-12-11', 0, '0', 1, '1'),
(6, 7, 1, 3, '2016-12-11 17:40:44', '0000-00-00 00:00:00', '2016-12-11', 0, '0', 1, '1'),
(7, 2, 1, 1, '2016-11-11 17:40:31', '0000-00-00 00:00:00', '2016-11-11', 0, '0', 1, '1'),
(8, 3, 2, 1, '2016-11-11 17:40:34', '0000-00-00 00:00:00', '2016-11-11', 0, '0', 1, '1'),
(9, 4, 3, 1, '2016-11-11 17:40:36', '0000-00-00 00:00:00', '2016-11-11', 0, '0', 1, '1'),
(10, 5, 1, 2, '2016-11-11 17:40:41', '0000-00-00 00:00:00', '2016-11-11', 0, '0', 1, '1'),
(11, 6, 2, 2, '2016-11-11 17:40:42', '0000-00-00 00:00:00', '2016-11-11', 0, '0', 1, '1'),
(12, 7, 1, 3, '2016-11-11 17:40:44', '0000-00-00 00:00:00', '2016-11-11', 0, '0', 1, '1'),
(13, 2, 1, 1, '2016-11-12 17:40:31', '0000-00-00 00:00:00', '2016-11-12', 0, '0', 1, '1'),
(14, 3, 2, 1, '2016-11-12 17:40:34', '0000-00-00 00:00:00', '2016-11-12', 0, '0', 1, '1'),
(15, 4, 3, 1, '2016-11-12 17:40:36', '0000-00-00 00:00:00', '2016-11-12', 0, '0', 1, '1'),
(16, 5, 1, 2, '2016-11-12 17:40:41', '0000-00-00 00:00:00', '2016-11-12', 0, '0', 1, '1'),
(17, 6, 2, 2, '2016-11-12 17:40:42', '0000-00-00 00:00:00', '2016-11-12', 0, '0', 1, '1'),
(18, 7, 1, 3, '2016-11-12 17:40:44', '0000-00-00 00:00:00', '2016-11-12', 0, '0', 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pin` (`pin`) USING BTREE,
  ADD KEY `pin_2` (`pin`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `absen` (`absen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  ADD CONSTRAINT `ja_data_absen_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `ja_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ja_data_absen_ibfk_2` FOREIGN KEY (`pin`) REFERENCES `ja_siswa` (`pin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
