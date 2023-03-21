-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Mar 2023 pada 03.56
-- Versi server: 10.5.16-MariaDB
-- Versi PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20458347_pengaduanhafidh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'kabanjiran'),
(2, 'kehutanan'),
(7, 'bencana'),
(8, 'kebakaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `telpon` varchar(13) NOT NULL,
  `active` enum('aktif','suspended') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `nik`, `nama`, `username`, `password`, `telpon`, `active`) VALUES
(17, '6544232', 'andika', 'asas', '$2y$10$.BrSTm7AL3HttoAHkO2AkOtBIobSPUIBTNG01pLnQar6q.OO5SOW2', '09876534', 'aktif'),
(18, '7456', 'geni', 'wewe', '$2y$10$nGyT6o.sgj9zZnjzV2yRUuB.btRatGOEhGHiU4m0TyZBayvtu1LAm', '068766234', 'aktif'),
(19, '0000000000', 'amat', 'adis', '$2y$10$vl6iS2V3ipAFhSKzcaUwQ.xDe/hQx3VD5kHyvxWEMUZ3yuwtjDkiC', '08784945445', 'aktif'),
(20, '235433', 'andika', 'dewe', '$2y$10$guo.RE3Q0IRx/Y9z8LvYruFjjInwl/PV3ca.lb/I81zVK.WDihI3O', '7545265', 'aktif'),
(21, '123', 'umi', 'umi', '$2y$10$6HYBq3mJ5bbKaPliIZNgdOv6dKxx3XasWoHp/giO8o/Je6Jar5kma', '08292929299', 'aktif'),
(22, '7866', 'hafidh', 'zull', 'asd', '0795678', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `nik` char(35) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('0','proses','selesai') NOT NULL,
  `subkategori` int(11) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`, `subkategori`, `kategori`) VALUES
(19, '2023-03-16', '0000000000', 'bgvbgg', 'derrick-chia-kwLKgt24adg-unsplash.jpg', 'selesai', 6, 8),
(20, '2023-03-16', '0000000000', 'esrsed', '256px-Spacewar!-PDP-1-20070512.jpg', 'selesai', 2, 1),
(21, '2023-03-16', '0000000000', 'hdhdhshdhhdh', 'IMG-20230316-WA0008.jpg', 'selesai', 6, 8),
(22, '2023-03-21', '6544232', 'kami meminta bantuan', 'yusril-permana-ali-IudBpcHKV3k-unsplash.jpg', 'selesai', 2, 1),
(23, '2023-03-21', '6544232', 'terkena macet dijalan', '640-Article Text-1495-1-10-20200611.pdf', '0', 4, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `telpon` varchar(13) NOT NULL,
  `level` enum('admin','petugas') NOT NULL,
  `status` enum('active','suspend') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `telpon`, `level`, `status`) VALUES
(1, 'andika', 'amat', '$2y$10$9.jXQH9kUUxQC3ruNhXPT.cLIejs2f7jwpmAppiP3Y7rxgVq7tL8.', '08477354', 'admin', 'active'),
(4, 'admin1', 'admin', '$2y$10$BvNo.Daz06GdxhwKBplOIepx47BH9x.VARUzSuclzlc.a5V4MgO7e', '09686753', 'admin', 'active'),
(5, 'petugas1', 'petugas', '$2y$10$WBL0MThZEV9mc4xST0XyGOgBOVxB7rosRr14bpYXAco6gRL9tjGjO', '097543141', 'petugas', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkategori`
--

CREATE TABLE `subkategori` (
  `id_subkategori` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `subkategori` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `subkategori`
--

INSERT INTO `subkategori` (`id_subkategori`, `id_kategori`, `subkategori`) VALUES
(2, 1, 'bencana'),
(3, 2, 'afergrgtggerg'),
(4, 7, 'gfjhf,mdmy'),
(6, 8, 'bucrvfyhvbhfv'),
(7, 1, 'air laut meluap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(25) NOT NULL,
  `id_pengaduan` int(25) NOT NULL,
  `tgl_tanggapan` int(11) NOT NULL,
  `tanggapan` int(11) NOT NULL,
  `id_petugas` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES
(1, 12, 2023, 0, 1),
(2, 21, 2023, 0, 1),
(3, 20, 2023, 0, 1),
(4, 19, 2023, 0, 1),
(5, 22, 2023, 0, 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`id_subkategori`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `id_subkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
