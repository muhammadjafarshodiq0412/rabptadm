-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 Okt 2019 pada 12.36
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ahs`
--

CREATE TABLE `ahs` (
  `id_ahs` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `nm_ahs` varchar(255) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ahs`
--

INSERT INTO `ahs` (`id_ahs`, `id_pekerjaan`, `nm_ahs`, `satuan`, `total`) VALUES
(3, 4, 'testes', 'ls', 5000000),
(6, 3, 'Cleaning', 'ls', 3150700),
(8, 3, 'nnnn', 'ls', 3150700);

-- --------------------------------------------------------

--
-- Struktur dari tabel `background`
--

CREATE TABLE `background` (
  `id_background` int(15) NOT NULL,
  `nama_background` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `background`
--

INSERT INTO `background` (`id_background`, `nama_background`, `gambar`) VALUES
(1, 'background', 'background.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bua`
--

CREATE TABLE `bua` (
  `id_bua` int(15) NOT NULL,
  `id_kategori` varchar(15) NOT NULL,
  `nama_bua` varchar(150) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `ukuran` varchar(100) NOT NULL,
  `spesifikasi` varchar(200) NOT NULL,
  `merk` varchar(150) NOT NULL,
  `warna` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bua`
--

INSERT INTO `bua` (`id_bua`, `id_kategori`, `nama_bua`, `satuan`, `ukuran`, `spesifikasi`, `merk`, `warna`, `harga`) VALUES
(1, '1', 'sewa alat angkut material', 'hr', '', '', '', '', 350000),
(2, '1', 'sewa alat angkut peralatan kerja', 'hr', '', '', '', '', 350000),
(3, '2', 'biaya angkut bahan/material kuli kawasan', 'org', '', '', '', '', 150000),
(4, '2', 'pekerja', 'OH', '', '', '', '', 99000),
(5, '1', 'material', 'm2', '', '', '', '', 27500),
(6, '1', 'seragam', 'pcs', '', '', '', '', 25000),
(7, '1', 'helmet', 'pcs', '', '', '', '', 42500),
(8, '1', 'kacamata safety', 'pcs', '', '', '', '', 20000),
(9, '1', 'sarung tangan', 'pcs', '', '', '', '', 5000),
(10, '1', 'testes1', 'ls', '', '', '', '', 90000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_ahs`
--

CREATE TABLE `detail_ahs` (
  `id_ahs` int(11) NOT NULL,
  `id_bua` int(11) NOT NULL,
  `koefisien` float NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_ahs`
--

INSERT INTO `detail_ahs` (`id_ahs`, `id_bua`, `koefisien`, `subtotal`) VALUES
(6, 1, 9, 3150000),
(6, 2, 0.002, 700),
(8, 1, 0.002, 700),
(8, 2, 9, 3150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_proyek`
--

CREATE TABLE `detail_proyek` (
  `id_proyek` int(15) NOT NULL,
  `id_pekerjaan` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_proyek`
--

INSERT INTO `detail_proyek` (`id_proyek`, `id_pekerjaan`) VALUES
(3, 8),
(3, 3),
(4, 3),
(5, 4),
(5, 3),
(4, 4),
(5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_proyek_ahs`
--

CREATE TABLE `detail_proyek_ahs` (
  `id_ahs` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `volume` float NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_proyek_ahs`
--

INSERT INTO `detail_proyek_ahs` (`id_ahs`, `id_proyek`, `id_pekerjaan`, `volume`, `subtotal`) VALUES
(3, 5, 4, 2, 10000000),
(6, 5, 3, 5, 15753500),
(8, 5, 3, 1, 3150700),
(6, 4, 3, 0.01, 31507),
(8, 4, 3, 0.001, 3151),
(3, 4, 4, 0.1, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id_informasi` int(15) NOT NULL,
  `nama_informasi` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id_informasi`, `nama_informasi`, `gambar`) VALUES
(3, 'informasi', 'informasi.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(15) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `aktif`) VALUES
(1, 'Bahan', 'Y'),
(2, 'Upah', 'Y'),
(3, 'Alat', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pekerjaan`
--

CREATE TABLE `kategori_pekerjaan` (
  `id_pekerjaan` int(15) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_pekerjaan`
--

INSERT INTO `kategori_pekerjaan` (`id_pekerjaan`, `nama_kategori`) VALUES
(2, 'Pekerjaan Bongkaran'),
(3, 'Pekerjaan Sipil'),
(4, 'Pekerjaan M/E'),
(5, 'Pekerjaan Persiapan'),
(7, 'Coba-coba');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `main_menu` varchar(11) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `link`, `icon`, `main_menu`, `level`) VALUES
(10, 'Admin', 'users', 'fa fa-user', '13', 'admin'),
(13, 'SETING', '#', 'fa fa-gear', '0', 'admin'),
(14, 'INFO RAB', '#', 'fa fa-globe', '0', 'admin'),
(15, 'BUA', 'bua', 'fa fa-server', '14', 'admin'),
(16, 'AHS', 'ahs', 'fa fa-server', '14', 'admin'),
(17, 'User', 'user', 'fa fa-server', '14', 'admin'),
(18, 'Informasi', 'informasi', 'fa fa-server', '14', 'admin'),
(19, 'Kategori Pekerjaan', 'kategori_pekerjaan', 'fa fa-server', '14', 'admin'),
(20, 'Background', 'background', 'fa fa-server', '14', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL,
  `user_id` int(15) NOT NULL,
  `revision` varchar(100) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `kontraktor` int(11) NOT NULL,
  `approved` varchar(100) NOT NULL,
  `checked` varchar(100) NOT NULL,
  `prepared` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `user_id`, `revision`, `project_name`, `create_date`, `due_date`, `status`, `total`, `kontraktor`, `approved`, `checked`, `prepared`) VALUES
(3, 1, '', 'tes', '2019-09-17', '2019-09-30', 'open', 0, 0, '', '', ''),
(4, 1, '9', 'hfghgfhgf', '2019-09-20', '2019-09-17', 'return', 534658, 53466, 'Jafar', 'Iqbal', 'Izzul'),
(5, 1, '', 'jhhj', '2019-09-22', '2019-09-26', 'open', 28904200, 2890420, 'abbi', 'iqbal', 'chandra');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `ext` varchar(100) NOT NULL,
  `plant_name` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `departement`, `ext`, `plant_name`, `level`) VALUES
(1, 'abbi', '517f0832b8aaba47a2269ef12b8c0449', 'abbisatria4@gmail.com', 'GA', '123', 'Abbi', 'proyek_created'),
(2, 'jafar', 'b6e7eab5f8a65aa2821b63ca694bc251', 'jafarshodiq0412@gmail.com', 'Menyala', 'jafar', 'jafar', 'approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin5@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ahs`
--
ALTER TABLE `ahs`
  ADD PRIMARY KEY (`id_ahs`);

--
-- Indexes for table `background`
--
ALTER TABLE `background`
  ADD PRIMARY KEY (`id_background`);

--
-- Indexes for table `bua`
--
ALTER TABLE `bua`
  ADD PRIMARY KEY (`id_bua`);

--
-- Indexes for table `detail_ahs`
--
ALTER TABLE `detail_ahs`
  ADD KEY `id_ahs` (`id_ahs`);

--
-- Indexes for table `detail_proyek`
--
ALTER TABLE `detail_proyek`
  ADD KEY `id_proyek` (`id_proyek`);

--
-- Indexes for table `detail_proyek_ahs`
--
ALTER TABLE `detail_proyek_ahs`
  ADD KEY `id_ahs` (`id_ahs`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_pekerjaan`
--
ALTER TABLE `kategori_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ahs`
--
ALTER TABLE `ahs`
  MODIFY `id_ahs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `background`
--
ALTER TABLE `background`
  MODIFY `id_background` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bua`
--
ALTER TABLE `bua`
  MODIFY `id_bua` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id_informasi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori_pekerjaan`
--
ALTER TABLE `kategori_pekerjaan`
  MODIFY `id_pekerjaan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_ahs`
--
ALTER TABLE `detail_ahs`
  ADD CONSTRAINT `detail_ahs_ibfk_1` FOREIGN KEY (`id_ahs`) REFERENCES `ahs` (`id_ahs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_proyek`
--
ALTER TABLE `detail_proyek`
  ADD CONSTRAINT `detail_proyek_ibfk_1` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_proyek_ahs`
--
ALTER TABLE `detail_proyek_ahs`
  ADD CONSTRAINT `detail_proyek_ahs_ibfk_1` FOREIGN KEY (`id_ahs`) REFERENCES `ahs` (`id_ahs`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
