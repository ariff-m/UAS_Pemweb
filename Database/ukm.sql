-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 06:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukm`
--

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE `kartu` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `ukm` varchar(30) NOT NULL,
  `desk` text NOT NULL,
  `instagram` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`id`, `img`, `ukm`, `desk`, `instagram`, `total`) VALUES
(5, '646f26733d9d8.png', 'Bola Voli', 'Jadwal Latihan Rutin: Senin 16.00 - 20.00 CP Sparing/Kerjasama  📲 0878-5316-0824 (Humas) CP Oprec : 📲 0812-4901-3915 (Zahra) 📲 0888-3880-004 (Yahya)', 'https://www.instagram.com/ukmvoliupnjatim/', 1),
(7, '646f48a8e4f1c.png', 'Bola Basket', '[SELAMAT DATANG MAHASISWA BARU JALUR SNPB 2023]\r\n\r\nPengumuman SNBP hari ini lohh, gimana hasilnya? aman? buat teman-teman yang diterima di Univ pilihannya selamat yaa, buat yang belum masih ada utbk dan jalur lainnya!\r\nsemangat terusss!!!', 'https://www.instagram.com/upnvjt_basketball/', 2),
(8, '647032ba187b4.png', 'Futsal', 'Latihan Rutin👇🏻\r\n🗓️ : Jumat\r\n🕕 : 18.00 - Selesai\r\n📍 : Giri Loka UPNV Jatim', 'https://www.instagram.com/futsal_upnvjatim/', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `npm` varchar(30) NOT NULL,
  `fak` varchar(30) NOT NULL,
  `jur` varchar(30) NOT NULL,
  `wa` varchar(30) NOT NULL,
  `ukm` varchar(50) NOT NULL,
  `ktm` text NOT NULL,
  `sp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `jk`, `npm`, `fak`, `jur`, `wa`, `ukm`, `ktm`, `sp`) VALUES
(7, 'Volem Alvaro Azira', 'Laki - laki', '21081010003', 'FASILKOM', 'Informatika', '+62 85156727386', 'Futsal', '646f27fd3a222.png', '64717da2836ae.png'),
(8, 'M. Arif', 'Laki - laki', '21081012319', 'FASILKOM', 'Teknik Informatika', '+62 817371738', 'Bola Basket', '64702ec96b3af.png', '647187e40b0c8.png'),
(10, 'Kesya', 'Perempuan', '210810100', 'FT', 'Teknik', '+62 ', 'Bola Basket', '6470305ab818b.jpeg', '647187ee4c2a4.png'),
(11, 'Anya Ningrum', 'Perempuan', '2108101', 'FASILKOM', 'Teknik Informatika', '+62 ', 'Futsal', '647033cce6042.png', '647187f897250.png'),
(12, 'Gilang Enggar', 'Laki - laki', '21081010', 'FASILKOM', 'Teknik', '+62 ', 'Bola Voli', '', '647188000ea26.png');

--
-- Triggers `mahasiswa`
--
DELIMITER $$
CREATE TRIGGER `update_total` AFTER INSERT ON `mahasiswa` FOR EACH ROW BEGIN
    UPDATE kartu
    SET total = (SELECT COUNT(*) FROM mahasiswa WHERE ukm = NEW.ukm)
    WHERE ukm = NEW.ukm;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_delete` AFTER DELETE ON `mahasiswa` FOR EACH ROW BEGIN
    UPDATE kartu
    SET total = (SELECT COUNT(*) FROM mahasiswa WHERE ukm = OLD.ukm)
    WHERE ukm = OLD.ukm;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total_update` AFTER UPDATE ON `mahasiswa` FOR EACH ROW BEGIN
    UPDATE kartu
    SET total = (SELECT COUNT(*) FROM mahasiswa WHERE ukm = NEW.ukm)
    WHERE ukm = NEW.ukm;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `pass`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
