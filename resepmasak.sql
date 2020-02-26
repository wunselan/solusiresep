-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2019 at 07:40 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resepmasak`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `id_resep` int(12) NOT NULL,
  `komentar` text NOT NULL,
  `rating` int(11) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_user`, `id_resep`, `komentar`, `rating`, `create_add`, `update_add`) VALUES
(7, 12, 2, 'enakla', 5, '2019-09-05 23:44:13', '2019-09-05 23:44:13'),
(8, 1, 2, 'asik', 5, '2019-09-08 01:08:44', '2019-09-08 01:08:44'),
(9, 2, 2, 'a', 5, '2019-09-08 14:54:03', '2019-09-08 14:54:03'),
(10, 1, 4, 'a', 5, '2019-09-12 13:50:23', '2019-09-12 13:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `id_komentar` int(12) DEFAULT NULL,
  `id_teman` int(12) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `id_komentar`, `id_teman`, `status`) VALUES
(17, 2, NULL, 15, 1),
(18, 2, 7, NULL, 1),
(19, 2, 8, NULL, 1),
(20, 12, NULL, 16, 0),
(21, 2, 9, NULL, 0),
(22, 1, 10, NULL, 1),
(23, 2, NULL, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resepmasakan`
--

CREATE TABLE `resepmasakan` (
  `id_resep` int(12) NOT NULL,
  `id_user` int(12) NOT NULL,
  `nama_resep` varchar(50) NOT NULL,
  `durasi` int(11) NOT NULL,
  `porsi` int(11) NOT NULL,
  `bahan_makanan` text NOT NULL,
  `langkah_memasak` text NOT NULL,
  `resep_foto` varchar(50) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resepmasakan`
--

INSERT INTO `resepmasakan` (`id_resep`, `id_user`, `nama_resep`, `durasi`, `porsi`, `bahan_makanan`, `langkah_memasak`, `resep_foto`, `create_add`, `update_add`) VALUES
(2, 2, 'Nasi Goreng', 15, 1, 'nasi, kecap, ayam, bawang merah, bawang putih', 'masukkan nasi, tambahkan kecap', 'img_30072019051544.jpg', '2019-07-30 22:15:44', '2019-10-27 20:43:16'),
(3, 2, 'pecel ayam', 10, 4, 'nasi, ayam, sayur', 'dwadawda, awdawda, wawww', 'img_08092019112036.jpg', '2019-09-08 16:08:25', '2019-10-27 20:12:52'),
(4, 1, 'pecel ayam bakar', 20, 2, 'ayam, kecap, mentega', 'nasi, ayam jamur', 'img_08092019035333.jpg', '2019-09-08 20:53:33', '2019-10-27 20:39:35'),
(6, 1, 'Soto ayam lamongan', 10, 2, 'air, bawang, ayam', 'sdadsa', 'img_08092019112036.jpg', '2019-10-27 22:09:20', '2019-10-28 13:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `teman`
--

CREATE TABLE `teman` (
  `id_teman` int(12) NOT NULL,
  `id_usera` int(12) NOT NULL,
  `id_ikuti` int(12) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teman`
--

INSERT INTO `teman` (`id_teman`, `id_usera`, `id_ikuti`, `create_add`, `update_add`) VALUES
(15, 12, 2, '2019-09-05 23:29:36', '2019-09-05 23:29:36'),
(16, 2, 12, '2019-09-08 14:13:07', '2019-09-08 14:13:07'),
(17, 1, 2, '2019-09-12 16:20:08', '2019-09-12 16:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nomor_telepon` varchar(50) NOT NULL,
  `user_foto` varchar(50) NOT NULL,
  `create_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `jenis_kelamin`, `username`, `password`, `email`, `nomor_telepon`, `user_foto`, `create_add`, `update_add`) VALUES
(1, 'Wunsel Arto Negoro', 'Laki-laki', 'wunselan', '1234', 'wunselan@gmail.com', '082222222', 'img_30072019044605.jpg', '2019-07-30 21:36:55', '2019-08-29 23:15:29'),
(2, 'Rizki Ramadhan', 'Laki-laki', 'rizki2500', '123', 'rizki2500@gmail.com', '081231231321', 'img_30072019045615.jpg', '2019-07-30 21:56:15', '2019-07-30 21:56:15'),
(12, 'albert', 'Laki-laki', 'albert', '123', 'al@gmail.com', '123', 'img_05092019062335.jpeg', '2019-09-05 23:23:35', '2019-09-05 23:23:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_user(komentar)` (`id_user`),
  ADD KEY `id_resep(komentar)` (`id_resep`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user(notifikasi)` (`id_user`),
  ADD KEY `id_komentar(notifikasi)` (`id_komentar`),
  ADD KEY `id_teman(notifikasi)` (`id_teman`);

--
-- Indexes for table `resepmasakan`
--
ALTER TABLE `resepmasakan`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `teman`
--
ALTER TABLE `teman`
  ADD PRIMARY KEY (`id_teman`),
  ADD KEY `id_usera(teman)` (`id_usera`),
  ADD KEY `id_ikuti(teman)` (`id_ikuti`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `resepmasakan`
--
ALTER TABLE `resepmasakan`
  MODIFY `id_resep` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teman`
--
ALTER TABLE `teman`
  MODIFY `id_teman` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `id_resep(komentar)` FOREIGN KEY (`id_resep`) REFERENCES `resepmasakan` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user(komentar)` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `id_komentar(notifikasi)` FOREIGN KEY (`id_komentar`) REFERENCES `komentar` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_teman(notifikasi)` FOREIGN KEY (`id_teman`) REFERENCES `teman` (`id_teman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user(notifikasi)` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resepmasakan`
--
ALTER TABLE `resepmasakan`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teman`
--
ALTER TABLE `teman`
  ADD CONSTRAINT `id_ikuti(teman)` FOREIGN KEY (`id_ikuti`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_usera(teman)` FOREIGN KEY (`id_usera`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
