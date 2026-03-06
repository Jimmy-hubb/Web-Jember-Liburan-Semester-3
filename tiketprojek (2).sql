-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2024 pada 08.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiketprojek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `destinasi` varchar(50) DEFAULT NULL,
  `jumlah_tiket` int(11) DEFAULT NULL,
  `tanggal_kunjungan` date DEFAULT NULL,
  `total_bayar` decimal(15,2) DEFAULT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `nama`, `email`, `telepon`, `alamat`, `destinasi`, `jumlah_tiket`, `tanggal_kunjungan`, `total_bayar`, `tanggal_pemesanan`) VALUES
(7, 'dawam', 'dawam@gmail.com', '0967675565', 'jember', 'Pantai Kuta', 2, '2024-10-28', 100000.00, '2024-10-25 07:48:23'),
(8, 'ok okrdbh', 'tfrojer56@gmail.com', '085704755731', 'perum biting.sukodono.lumajang.jatim', 'Pantai Kuta', 4, '2024-10-28', 200000.00, '2024-10-28 13:54:49'),
(9, 'jimmy', 'jimmy@gmail.com', '087126712621', 'Banyuwangi', 'Pantai Kuta', 2, '2024-11-01', 100000.00, '2024-10-31 02:32:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('pembeli','admin') NOT NULL DEFAULT 'pembeli'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'fhanwam@gmail.com', '$2y$10$Od85UpqrYQ9.jXGmHQks5.g6MdnKYeTIR72sBzvFu.vCs5YLkLAvO', '2024-09-17 01:37:58', 'pembeli'),
(2, 'tfrojer56@gmail.com', '$2y$10$YYd3/8Uw0Wwn9p8DOd4EVePta4/zKwLkgfUQDjM6O/8PW/7uHugPm', '2024-09-30 01:13:04', 'pembeli'),
(3, 'usernoorcell123@gmail.com', '$2y$10$sKoKfBsEp1NiQt00TYsVhugRGVldfXTJO4i4NX2/GZI95/rvH5zyq', '2024-10-23 14:56:00', 'pembeli'),
(12, 'jimmy@gmail.com', '$2y$10$1bhtbya9yrxSjgZwgv1CVOwV0EiQJ5br1E/b5IhELjNT8B/Oq.UgC', '2024-10-31 02:28:07', 'pembeli'),
(13, 'admin2@gmail.com', '$2y$10$xK3rBE5FfuqWOVgDtE.vPOHETGVeb0WCo1yb7S2JjiQOjRxcjp1xa', '2024-11-04 03:13:15', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id` int(11) NOT NULL,
  `id_wisata` varchar(10) GENERATED ALWAYS AS (concat('jbr',lpad(`id`,3,'0'))) VIRTUAL,
  `nama_wisata` varchar(100) DEFAULT NULL,
  `alamat_wisata` varchar(255) DEFAULT NULL,
  `deskripsi_wisata` text DEFAULT NULL,
  `operasional` varchar(20) DEFAULT NULL,
  `harga_tiket` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id`, `nama_wisata`, `alamat_wisata`, `deskripsi_wisata`, `operasional`, `harga_tiket`) VALUES
(1, 'Papuma', 'Wuluhan', 'dknwinid', '09.00-17.00', 200000),
(2, 'dnwindiwd', 'ndiwndi', 'jwndwnd', '09.00-17.00', 888888);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
