-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 02:42 PM
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
(5, '646f26733d9d8.png', 'Bola Voli', 'Jadwal Latihan Rutin: Senin 16.00 - 20.00 CP Sparing/Kerjasama  📲 0878-5316-0824 (Humas) CP Oprec : 📲 0812-4901-3915 (Zahra) 📲 0888-3880-004 (Yahya)', 'https://www.instagram.com/ukmvoliupnjatim/', 2),
(7, '646f48a8e4f1c.png', 'Bola Basket', '[SELAMAT DATANG MAHASISWA BARU JALUR SNPB 2023]\r\n\r\nPengumuman SNBP hari ini lohh, gimana hasilnya? aman? buat teman-teman yang diterima di Univ pilihannya selamat yaa, buat yang belum masih ada utbk dan jalur lainnya!\r\nsemangat terusss!!!', 'https://www.instagram.com/upnvjt_basketball/', 1),
(8, '647032ba187b4.png', 'Futsal', 'Latihan Rutin👇🏻\r\n🗓️ : Jumat\r\n🕕 : 18.00 - Selesai\r\n📍 : Giri Loka UPNV Jatim', 'https://www.instagram.com/futsal_upnvjatim/', 1),
(9, '647edb550cfaf.png', 'Tari', 'UPN \"Veteran\" Jawa Timur\r\n🏠 Gedung Serba Guna Giri Loka Sayap Timur Lt. 2\r\nContact Person : line📲 @532fmpfz\r\n⬇️⬇️⬇️\r\nlinktr.ee/ukmtariupnjatim', 'https://www.instagram.com/ukmtari_upnjatim/', 1);

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
  `sp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `jk`, `npm`, `fak`, `jur`, `wa`, `ukm`, `sp`) VALUES
(7, 'Volem Alvaro Azira', 'Laki - laki', '21081010003', 'FASILKOM', 'Teknik Informatika', '+62 85156727386', 'Bola Voli', '64717da2836ae.png'),
(8, 'M. Arif', 'Laki - laki', '21081010199', 'FASILKOM', 'Teknik Informatika', '+62 817371738', 'Futsal', '647187e40b0c8.png'),
(10, 'Kesya Nursyahada', 'Perempuan', '21081010120', 'FASILKOM', 'Teknik Informatika', '+62 888', 'Bola Basket', '647187ee4c2a4.png'),
(11, 'Anya Ningrum Nurafifah', 'Perempuan', '21081010112', 'FASILKOM', 'Teknik Informatika', '+62 ', 'Tari', '647187f897250.png'),
(12, 'Gilang Enggar Saputra', 'Laki - laki', '21081010237', 'FASILKOM', 'Teknik Informatika', '+62 ', 'Bola Voli', '647188000ea26.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
