-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Mar 2018 pada 17.34
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ta_toko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `password` char(32) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `foto_ktp` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` int(11) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `agama` int(11) NOT NULL,
  `status_perkawinan` int(11) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_user`, `username`, `jabatan`, `status`, `password`, `salt`, `foto_ktp`, `nama`, `tempat_lahir`, `tgl_lahir`, `kelamin`, `alamat`, `agama`, `status_perkawinan`, `no_telp`) VALUES
(1, 'anas', 0, 1, '1b494107a740a02b813fc1432ded45e0', '06.2018', '5b8603ba95.jpg', 'Moh. Nasrullah', 'Surabaya', '1995-10-25', 1, 'Kapas Baru Gg 7No 1 Surabaya', 1, 0, '082250342617'),
(2, 'rina', 1, 1, '1b494107a740a02b813fc1432ded45e0', '06.2018', 'fe9cece935.jpg', 'Rinan Dina', 'surabaya', '1995-04-15', 0, 'Randu Alas Magelang Jawa Tengah', 1, 0, '081733079012'),
(4, 'jack', 1, 0, '1b494107a740a02b813fc1432ded45e0', '06.2018', 'ad8369f17a.jpg', 'Rahmat Jackaria', 'Solo', '1990-12-20', 1, 'Sidodadi Solo Jawa Tengah', 1, 0, '085733012079');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
