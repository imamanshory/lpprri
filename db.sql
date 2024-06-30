-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 03:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `lap_id` int(11) NOT NULL,
  `lap_nip` int(11) NOT NULL,
  `lap_kegiatan` varchar(255) NOT NULL,
  `lap_tanggal` date NOT NULL,
  `lap_jam_mulai` int(11) NOT NULL,
  `lap_jam_selesai` int(11) NOT NULL,
  `lap_satuan_kegiatan` varchar(100) NOT NULL,
  `lap_jumlah_satuan` int(3) NOT NULL,
  `lap_tempat_kegiatan` varchar(200) NOT NULL,
  `lap_penyelenggara` varchar(200) NOT NULL,
  `lap_keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`lap_id`, `lap_nip`, `lap_kegiatan`, `lap_tanggal`, `lap_jam_mulai`, `lap_jam_selesai`, `lap_satuan_kegiatan`, `lap_jumlah_satuan`, `lap_tempat_kegiatan`, `lap_penyelenggara`, `lap_keterangan`) VALUES
(8, 21029, 'Streaming YT', '2024-02-15', 11, 11, 'kegiatan siang', 3, 'NET Pro 1', 'programa etis 1', 'steaming yt di net pro 1'),
(10, 21023, 'siaran', '2024-06-12', 23, 23, 'berita terkini', 3, 'NET', 'ERVI', 'pada kegiatan hari ini kami melakukan penyiaran berita terkini tentang kasus yang kini terjadi yaitu tentang fina'),
(11, 21023, 'siaran', '2024-06-12', 8, 9, 'berita terkini', 1, 'NET', 'ERVI', 'pada kegiatan hari ini kami melakukan penyiaran berita terkini tentang kasus yang kini terjadi yaitu tentang fina'),
(13, 21023, 'siaran', '2024-06-06', 10, 16, 'berita terkini', 2, 'NET', 'ervi', 'uwteagshjdvkUWGF'),
(15, 21023, 'siaran', '2024-06-06', 10, 16, 'berita terkini', 2, 'NET', 'ervi', 'uwteagshjdvkUWGF'),
(18, 21023, 'siaran 4', '2024-06-07', 11, 15, 'siaran', 1, 'NET', 'programa etis 2', 'qweqwr'),
(19, 21020, 'siaran', '2024-06-11', 11, 15, 'berita terkini', 1, 'NET', 'programa etis 2', 'qwertyu');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `peg_id` int(11) NOT NULL,
  `peg_nip` int(11) NOT NULL,
  `peg_nama` varchar(100) NOT NULL,
  `peg_pangkat` varchar(100) NOT NULL,
  `peg_unit_kerja` varchar(150) NOT NULL,
  `peg_jabatan` varchar(100) NOT NULL,
  `peg_atasan` varchar(100) NOT NULL,
  `peg_atasan2` varchar(100) NOT NULL,
  `peg_tugas_pokok` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`peg_id`, `peg_nip`, `peg_nama`, `peg_pangkat`, `peg_unit_kerja`, `peg_jabatan`, `peg_atasan`, `peg_atasan2`, `peg_tugas_pokok`) VALUES
(6, 21023, 'Anshory', 'pegawai', 'programa 1', 'presenter', '', '', 'siaran harian'),
(8, 21029, 'Admin RRI', 'Atasan', 'NET Pro1', 'Admin NET', '', '', 'konfigurasi NET'),
(10, 21020, 'ervi safitri', 'mahasiswa', 'program pro 1', 'staf', '', '', 'siaran harian');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_status` int(1) NOT NULL,
  `user_nip` int(11) NOT NULL,
  `user_kata_sandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `user_status`, `user_nip`, `user_kata_sandi`) VALUES
(6, 'ryhisto02@gmail.com', 1, 21023, '$2y$10$fO5YJ25zOgR1IQO9EFEyYOwJT9AWLou9iEEnpbDSU6o4/3wDGJIZq'),
(8, '', 1, 21029, '$2y$10$nLTDRA/52mU3CDRhK.QD0OmHbSoqbCMtaYiLDpmD5OGcMzrwWgElG'),
(10, '', 0, 21020, '$2y$10$2ifhhI3/BodfeNAbFLVNCe7Xb8YWidwL2uzUr/nyZocti6IFrodky');

-- --------------------------------------------------------

--
-- Table structure for table `users_token`
--

CREATE TABLE `users_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_token`
--

INSERT INTO `users_token` (`id`, `email`, `token`, `date_create`) VALUES
(1, 'ryhisto02@gmail.com', 'D1QEN+ZfA75Q8znlfJkJscJbIHqp0nKQQmlztlaJVCo=', 1718852018),
(2, 'ryhisto02@gmail.com', '', 0),
(3, 'ryhisto02@gmail.com', '5fgQi90Kq+zg9QKirye2fi+YLZrvDh7vCjuebm0Qc+M=', 1718852158),
(4, 'ryhisto02@gmail.com', '7+sgGt5bjeVAJhgGYezLxPR5FyC3IsCbdK7zkljMaho=', 1718852282),
(5, 'ryhisto02@gmail.com', 'TcfcTG+8MabinNQg+u/di42dxDx/Z6VJI1K8aBFABeY=', 0),
(6, 'ryhisto02@gmail.com', 'zsmORXNn707t6SpfrLPPqv+h9cGLkYTYMURAYy3EBLE=', 1718852629),
(7, 'ryhisto02@gmail.com', '5Vl3IcGTMKCoVsNKGZEDgek1GObtSX9nZ5BZScGkNZ8=', 1718852743),
(8, 'ryhisto02@gmail.com', '0uPvSs5OXB9lBGjX1NKrl3COIVF+LTbs74e0DWlytRY=', 1718853029),
(9, 'ryhisto02@gmail.com', 'haKmmndVMpMMgCL33wHTc1voF7Dxk6DuoXY6me/jy9U=', 1718853284),
(10, 'ryhisto02@gmail.com', 'aCu8cfsF0NVAHF6eRv83wJAaMqAfm1SbIyJfMUPXv+k=', 1718853376),
(11, 'ryhisto02@gmail.com', '', 0),
(12, 'ryhisto02@gmail.com', 'y//vjYGsUUrTwO0BUv01XxxpojTOJ++f47dG+LjBOtQ=', 1718853497),
(13, 'ryhisto02@gmail.com', 'e7cEoyCejRui6CMZfuUoDBiOhgsfoXxhqLHFBc1C53Q=', 1718853773),
(14, 'ryhisto02@gmail.com', 'jrbYOIbTpFPnjaoaluvvVc4kEsYhviaUvwz9/+mBU2I=', 1718854116);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`lap_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`peg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_token`
--
ALTER TABLE `users_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `lap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `peg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_token`
--
ALTER TABLE `users_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
