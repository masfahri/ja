-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2016 at 02:42 PM
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
  `pin` int(10) NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_pulang` datetime NOT NULL,
  `ver` int(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_data_absen`
--

INSERT INTO `ja_data_absen` (`id`, `pin`, `jam_masuk`, `jam_pulang`, `ver`, `status`) VALUES
(1, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(2, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(3, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(4, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(5, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(6, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(7, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(8, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(9, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(10, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0),
(11, 4, '2016-11-10 00:59:45', '2016-11-10 01:00:48', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pin` (`pin`) USING BTREE,
  ADD KEY `pin_2` (`pin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  ADD CONSTRAINT `ja_data_absen_ibfk_1` FOREIGN KEY (`pin`) REFERENCES `ja_siswa` (`pin`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
