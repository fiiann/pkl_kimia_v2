-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2016 at 01:17 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sip`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`nim`, `nama`, `password`, `alamat`, `kota`, `email`, `no_telp`) VALUES
('24010314120010', 'Anggit Gusti', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang aja', 'Semarang', 'anggit@gmail.com', '081200100200'),
('24010314120014', 'Wiladhiyanti', 'd1610aa2317f20fef05766813a58d1c1', 'Semarang', 'Semarang', 'wila@gmail.com', '085645991500'),
('24010314120044', 'Garfianto', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang', 'Semarang', 'fiann@gmail.com', '085645991500'),
('24010314120054', 'Aditia Prasetio', '55f2b7f0101ef7ec0f73d3e48c2065c2', 'Jl. TanjungSari VIII, Banyumanik', 'Semarang', 'aditia.prasetio12@gmail.com', '085645991577'),
('24010314120057', 'Rizal Muhammad', 'b77d7d2c9241775b5d3eed6016278199', 'Gondang Barat 1', 'Purbalingga', 'rizal.muhammad@gmail.com', '085641282142'),
('24010314170001', 'Yasmin', 'b77d7d2c9241775b5d3eed6016278199', 'Semarang Bawah', 'Semarang', 'yasmin9658@gmail.com', '085645991576');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `idbuku` int(11) NOT NULL,
  `isbn` char(13) NOT NULL,
  `judul` varchar(60) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `penerbit` varchar(30) NOT NULL,
  `kota_terbit` varchar(30) NOT NULL,
  `editor` varchar(30) NOT NULL,
  `file_gambar` varchar(60) NOT NULL,
  `tgl_update` date NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_tersedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`idbuku`, `isbn`, `judul`, `idkategori`, `pengarang`, `penerbit`, `kota_terbit`, `editor`, `file_gambar`, `tgl_update`, `stok`, `stok_tersedia`) VALUES
(1, '1-000-00000-7', '100 Keajaiban Dunia1', 2, 'Tim Sunrise Pictures', 'Cikal Aksara', 'Semarang', '1', '2016-12-10_0-212-60200-1.jpg', '2016-12-12', 10, 9),
(2, '0-212-60200-2', 'Atlas Ruang Angkasa', 0, 'Nicholas Haris', 'Erlangga', 'Semarang', '', '2016-12-02_0-212-60200-2.jpg', '2016-12-03', 10, 9),
(3, '0-212-60200-3', 'Pengantar Teknologi Informasi', 1, 'Tata Sutabri', 'Andi Publisher', 'Jogjakarta', '', '2016-12-02_0-212-60200-3.jpg', '2016-12-02', 10, 7),
(4, '0-212-60200-4', 'Pengenalan Sistem Infomasi Rev', 1, 'Abdul Kadir', 'Andi Publisher', 'Jogjakarta', '', '2016-12-02_0-212-60200-4.jpg', '2016-12-02', 10, 9),
(5, '0-212-60200-5', 'Seoulmate', 3, 'Lia Indra Andriana', 'Haru Media', 'Jakarta', '', '2016-12-02_0-212-60200-5.jpg', '2016-12-02', 10, 10),
(6, '0-212-60200-6', 'Heart of Friendship', 3, 'Aulia Saad', 'Mizan', 'Jakarta', '', '2016-12-02_0-212-60200-6.jpg', '2016-12-02', 10, 10),
(7, '0-212-60200-7', 'Unstoppable Hopes', 4, 'Gloria Morgen', 'Buana Ilmu Populer', 'Bandung', '', '2016-12-02_0-212-60200-7.jpg', '2016-12-02', 10, 9),
(8, '0-212-60200-8', 'Jangan Sampai Menyerah', 4, 'Insan Nurrohim', 'Laksana', 'Bandung', '', '2016-12-02_0-212-60200-8.jpg', '2016-12-02', 10, 10),
(9, '0-212-60200-9', 'Batik Indonesia', 5, 'Murdijati Gardjito', 'Kaki Langit', 'Jogjakarta', '', '2016-12-02_0-212-60200-9.jpg', '2016-12-02', 10, 9),
(10, '0-212-60201-5', 'Sejarah Makanan Indonesia', 5, 'Fadly Rahman', 'Gramedia Pustaka Utama', 'Jakarta', '1', '2016-12-02_0-212-60201-0.jpg', '2016-12-12', 10, 9),
(11, '0-212-60200-1', 'Judulnya Apa ya', 0, 'Pengarang', 'Penerbit', 'Kota', '1', '2016-12-02_1-000-00000-7.png', '2016-12-12', 20, 18);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `idbuku` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`idtransaksi`, `idbuku`, `tgl_kembali`, `denda`) VALUES
(1, 1, '2016-12-11', 0),
(1, 11, '2016-12-11', 0),
(2, 1, '2016-12-11', 0),
(2, 11, '2016-12-11', 0),
(3, 3, '2016-12-12', 0),
(4, 1, '0000-00-00', 0),
(4, 10, '0000-00-00', 0),
(5, 1, '2016-12-12', 0),
(6, 2, '0000-00-00', 0),
(6, 3, '0000-00-00', 0),
(7, 3, '0000-00-00', 0),
(7, 7, '0000-00-00', 0),
(8, 11, '0000-00-00', 0),
(9, 4, '0000-00-00', 0),
(9, 11, '0000-00-00', 0),
(10, 3, '0000-00-00', 0),
(10, 9, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama`) VALUES
(1, 'Teknologi'),
(2, 'Ensiklopedia'),
(3, 'Novel'),
(4, 'Psikologi'),
(5, 'Sejarah dan Budaya'),
(11, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idtransaksi` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `idpetugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`idtransaksi`, `nim`, `tgl_pinjam`, `idpetugas`) VALUES
(1, '24010314120054', '2016-12-11', 1),
(2, '24010314170001', '2016-12-11', 1),
(3, '24010314120054', '2016-12-11', 1),
(4, '24010314170001', '2016-12-11', 1),
(5, '24010314120054', '2016-12-12', 1),
(6, '24010314120010', '2016-12-12', 1),
(7, '24010314120014', '2016-12-12', 1),
(8, '24010314120057', '2016-12-12', 1),
(9, '24010314120044', '2016-12-12', 1),
(10, '24010314120054', '2016-12-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `idpetugas` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`idpetugas`, `nama`, `email`, `password`) VALUES
(1, 'Aditia Prasetio', 'aditia@if.undip.ac.id', 'b77d7d2c9241775b5d3eed6016278199'),
(2, 'Yasmin', 'yasmin9658@gmail.com', 'b77d7d2c9241775b5d3eed6016278199');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idbuku`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`idtransaksi`,`idbuku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`idpetugas`),
  ADD UNIQUE KEY `idpetugas` (`idpetugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `idbuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `idpetugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
