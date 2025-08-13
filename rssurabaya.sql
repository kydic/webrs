-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Agu 2025 pada 22.10
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rssurabaya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` int(11) NOT NULL,
  `poli` varchar(50) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `spesialis` varchar(100) NOT NULL,
  `senin` varchar(50) DEFAULT '-',
  `selasa` varchar(50) DEFAULT '-',
  `rabu` varchar(50) DEFAULT '-',
  `kamis` varchar(50) DEFAULT '-',
  `jumat` varchar(50) DEFAULT '-',
  `sabtu` varchar(50) DEFAULT '-',
  `minggu` varchar(50) DEFAULT '-',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `poli`, `nama_dokter`, `spesialis`, `senin`, `selasa`, `rabu`, `kamis`, `jumat`, `sabtu`, `minggu`, `last_update`) VALUES
(2, 'Gigi', 'dr. Siti Aminah, Sp.A', 'Gigi', '-', '13:00-16:00', '13:00-16:00', '-', '08:00-12:00', '-', '-', '2025-08-11 19:32:41'),
(3, 'penyakit_dalam', 'dr. Agus Prasetyo, Sp.PD', 'Spesialis Penyakit Dalam', '08:00-12:00', '-', '08:00-12:00', '-', '-', '08:00-12:00', '-', '2025-08-11 17:48:15'),
(4, 'Jantung', 'dr. Andi Pratama, Sp.JP', 'Spesialis Jantung', '08:00-12:00', '08:00-12:00', '08:00-12:00', 'Libur', '08:00-12:00', 'Libur', 'Libur', '2025-08-11 17:54:12'),
(5, 'Bedah', 'dr. Budi Santoso, Sp.B', 'Spesialis Bedah', '13:00-16:00', 'Libur', '13:00-16:00', '13:00-16:00', 'Libur', '08:00-11:00', 'Libur', '2025-08-11 17:54:12'),
(6, 'Kebidanan', 'dr. Citra Lestari, Sp.OG', 'Spesialis Kebidanan', '09:00-12:00', '09:00-12:00', 'Libur', '09:00-12:00', '09:00-12:00', 'Libur', 'Libur', '2025-08-11 17:54:12'),
(7, 'Paru', 'dr. Dian Wijaya, Sp.P', 'Spesialis Paru', 'Libur', '10:00-13:00', '10:00-13:00', 'Libur', '10:00-13:00', 'Libur', 'Libur', '2025-08-11 17:54:12'),
(8, 'Anestesi', 'dr. Eka Saputra, Sp.An', 'Anestesi', '08:00-12:00', 'Libur', '08:00-12:00', '08:00-12:00', '08:00-12:00', 'Libur', 'Libur', '2025-08-11 19:33:19'),
(9, 'Kulit', 'dr. Fajar Maulana, Sp.KK', 'Spesialis Kulit dan Kelamin', '13:00-15:00', '13:00-15:00', 'Libur', '13:00-15:00', '13:00-15:00', 'Libur', 'Libur', '2025-08-11 17:54:12'),
(10, 'Gigi', 'drg. Gita Permata', 'Dokter Gigi', '08:00-12:00', '08:00-12:00', '08:00-12:00', 'Libur', '08:00-12:00', 'Libur', 'Libur', '2025-08-11 17:54:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`) VALUES
(1, 'Anak'),
(2, 'Jantung'),
(3, 'Bedah'),
(4, 'Kebidanan'),
(5, 'Paru'),
(6, 'Anestesi'),
(7, 'Kulit'),
(8, 'Gigi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
