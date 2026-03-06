-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Nov 2024 pada 08.19
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
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_id` varchar(30) NOT NULL,
  `status_transaksi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `nama`, `email`, `telepon`, `alamat`, `destinasi`, `jumlah_tiket`, `tanggal_kunjungan`, `total_bayar`, `tanggal_pemesanan`, `order_id`, `status_transaksi`) VALUES
(7, 'dawam', 'dawam@gmail.com', '0967675565', 'jember', 'Pantai Kuta', 2, '2024-10-28', 100000.00, '2024-10-25 07:48:23', '0007', ''),
(8, 'ok okrdbh', 'tfrojer56@gmail.com', '085704755731', 'perum biting.sukodono.lumajang.jatim', 'Pantai Kuta', 4, '2024-10-28', 200000.00, '2024-10-28 13:54:49', '0008', ''),
(9, 'jimmy', 'jimmy@gmail.com', '087126712621', 'Banyuwangi', 'Pantai Kuta', 2, '2024-11-01', 100000.00, '2024-10-31 02:32:03', '0009', ''),
(10, 'Zahra', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', '', 0, '0000-00-00', 75000.00, '2024-11-11 04:33:39', '0010', ''),
(74, 'araa', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', 'Pantai Kuta', 6, '2024-11-23', 300000.00, '2024-11-12 00:42:03', '853162826', '1'),
(76, 'Devi Zahra Safrida', 'devi.zahra87@gmail.com', '086545678766', 'Ambulu', '', 0, '0000-00-00', 750000.00, '2024-11-12 01:13:25', '2012185359', '1'),
(77, 'araaaaaa', 'E41232170@student.polije.ac.id', '086545678766', 'Ambulu', '', 0, '0000-00-00', 525000.00, '2024-11-12 02:01:06', 'order-1731376866-9153', '1'),
(78, 'Zahra', 'devi.zahra87@gmail.com', '086545678766', 'Ambulu', '', 0, '0000-00-00', 600000.00, '2024-11-12 07:24:46', 'order-1731396286-3963', '1'),
(79, 'ara', 'admin2@gmail.com', '086545678766', 'Ambulu', '', 0, '0000-00-00', 225000.00, '2024-11-12 08:59:15', 'order-1731401955-2723', '1'),
(81, 'araa', 'E41232170@student.polije.ac.id', '086545678766', 'Ambulu', 'Pantai Kuta', 6, '2024-11-29', 300000.00, '2024-11-13 06:23:13', 'order-1731478993-1613', '1'),
(82, 'yaya', 'E41232170@student.polije.ac.id', '086545678766', 'Ambulu', '', 0, '0000-00-00', 600000.00, '2024-11-13 06:33:23', 'order-1731479603-1993', '1'),
(83, 'araa', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', '', 0, '0000-00-00', 450000.00, '2024-11-13 07:11:46', 'order-1731481906-7559', '1'),
(84, 'araa', 'devi.zahra87@gmail.com', '086545678766', 'Ambulu', '', 0, '0000-00-00', 525000.00, '2024-11-13 08:13:28', 'order-1731485608-9060', '1'),
(85, 'araa', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', 'Pantai Kuta', 3, '2024-11-13', 150000.00, '2024-11-13 08:18:29', 'order-1731485909-7238', '1'),
(86, 'araa', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', 'Pantai Kuta - Rp 50.000/orang', 9, '2024-11-15', 450000.00, '2024-11-13 08:26:52', '', ''),
(87, 'araa', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', 'Pantai Kuta - Rp 50.000/orang', 9, '2024-11-15', 450000.00, '2024-11-13 08:39:09', '', ''),
(88, 'Devi', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', '', 0, '0000-00-00', 675000.00, '2024-11-13 13:09:34', 'order-1731503374-1187', '1'),
(89, 'araa', 'devi.zahra87@gmail.com', '0985735718819', 'Ambulu', 'Pantai Kuta', 6, '2024-11-30', 300000.00, '2024-11-14 00:55:52', 'order-1731545752-6705', '1'),
(90, 'Tae', 'fhanwam@gmail.com', '081237832005', 'Lumajang', 'Pantai Kuta', 1, '2024-11-16', 50000.00, '2024-11-15 07:41:55', 'order-1731656515-2437', '1'),
(91, 'Zidan', 'usernoorcell123@gmail.com', '085704755731', 'perum biting.sukodono.lumajang.jatim', 'Pantai Kuta', 4, '2024-11-20', 200000.00, '2024-11-19 00:55:22', 'order-1731977722-8644', '1');

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
(14, 'Dawam', 'fhanwam@gmail.com', '$2y$10$FxtHpIbMzvd89jioXTODH.iFHaSiioJl2FhAcbLavkoZnAoRSANmS', '2024-11-11 15:49:17', 'pembeli', NULL, NULL),
(16, 'Kingwam', 'usernoorcell123@gmail.com', '$2y$10$2kx6rhgb.8hDN0RZXNFMh.u4G7AFaSPjeTMfvrYsh.9u2hy.ZsNSC', '2024-11-12 12:10:19', 'admin', NULL, NULL),
(17, 'Jimm', 'jimmy@gmail.com', '$2y$10$SE4TwTItAUgVfS/D5HCpfucOuAuDxjMIAbWPH2GLAXPJ3DGZYKR2e', '2024-11-15 07:31:01', 'admin', NULL, NULL);

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
  `harga_tiket` decimal(10,0) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
