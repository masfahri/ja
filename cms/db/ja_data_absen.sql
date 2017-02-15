-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 25 Jan 2017 pada 07.32
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 5.6.19

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
-- Struktur dari tabel `ja_data_absen`
--

CREATE TABLE `ja_data_absen` (
  `id` int(10) NOT NULL,
  `pin` int(10) DEFAULT NULL,
  `id_kelas` int(222) DEFAULT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_pulang` datetime NOT NULL,
  `tanggal` date NOT NULL,
  `ver` int(10) NOT NULL,
  `telat` enum('0','1') NOT NULL DEFAULT '0',
  `status` int(10) NOT NULL,
  `kehadiran` int(6) NOT NULL,
  `sms_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ja_data_absen`
--

INSERT INTO `ja_data_absen` (`id`, `pin`, `id_kelas`, `jam_masuk`, `jam_pulang`, `tanggal`, `ver`, `telat`, `status`, `kehadiran`, `sms_status`) VALUES
(1, 1, 1, '2017-01-20 04:19:31', '0000-00-00 00:00:00', '0000-00-00', 0, '1', 0, 4, '1'),
(2, 2, 1, '2017-01-20 04:19:36', '0000-00-00 00:00:00', '0000-00-00', 0, '1', 0, 4, '1'),
(3, 3, 1, '2017-01-20 04:19:38', '0000-00-00 00:00:00', '0000-00-00', 0, '1', 0, 4, '1'),
(4, 6, 2, '2017-01-20 04:19:46', '0000-00-00 00:00:00', '0000-00-00', 0, '1', 0, 4, '1'),
(5, 9, 3, '2017-01-20 04:19:53', '0000-00-00 00:00:00', '0000-00-00', 0, '1', 0, 4, '1'),
(6, 10, 3, '2017-01-20 00:00:00', '2017-01-20 00:00:00', '2017-01-20', 0, '0', 0, 2, '0'),
(7, 8, 2, '2017-01-20 00:00:00', '2017-01-20 00:00:00', '2017-01-20', 0, '0', 0, 3, '0'),
(8, 11, 3, '2017-01-20 00:00:00', '2017-01-20 00:00:00', '2017-01-20', 0, '0', 0, 3, '0'),
(9, 4, 1, '2017-01-22 00:00:00', '2017-01-22 00:00:00', '2017-01-22', 0, '0', 0, 3, '0'),
(11, 5, 1, '2017-01-22 00:00:00', '2017-01-22 00:00:00', '2017-01-22', 0, '0', 0, 2, '0'),
(12, 1, 1, '2017-01-22 13:50:25', '0000-00-00 00:00:00', '0000-00-00', 0, '0', 0, 4, '1'),
(13, 14, 10, '2017-01-22 15:28:16', '0000-00-00 00:00:00', '0000-00-00', 0, '0', 0, 4, '2');

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
  ADD KEY `kehadiran` (`kehadiran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  ADD CONSTRAINT `ja_data_absen_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `ja_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ja_data_absen_ibfk_2` FOREIGN KEY (`pin`) REFERENCES `ja_siswa` (`pin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
