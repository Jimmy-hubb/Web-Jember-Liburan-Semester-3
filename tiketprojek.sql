-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Nov 2024 pada 13.26
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
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('pembeli','admin') NOT NULL DEFAULT 'pembeli',
  `reset_token` varchar(100) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`, `reset_token`, `token_expiry`) VALUES
(14, 'Dawam', 'fhanwam@gmail.com', '$2y$10$MlTbww59PiVWP65mAcyn7.TlBaYdZR9CVDIbJq2G0r/5tK5qrJX6K', '2024-11-11 15:49:17', 'pembeli', NULL, NULL),
(15, 'Adminn', 'admin@gmail.com', '$2y$10$rhMZqb5A/trVVAy9Upur2eYvWFImKS4M6NTCEteiNxqHd12LTl1ye', '2024-11-11 15:52:47', 'admin', NULL, NULL),
(16, 'Kingwam', 'usernoorcell123@gmail.com', '$2y$10$5p.oECzKtDG2JlmSgdlQPOkPQxjt1Fjdys8S4O0fggAlReILJF78O', '2024-11-12 12:10:19', 'admin', 'c3feaa21d283e2c2f99e3149b81703109ff49ca4f0e030a05f7a425a75a33270635007c5bea1a8b1dc646fd3c0c361656beb', '2024-11-12 21:10:58');

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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
