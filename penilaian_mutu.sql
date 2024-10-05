-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2024 pada 06.08
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian_mutu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `path_doc_nilai` varchar(256) NOT NULL,
  `path_doc_remedial` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `document`
--

INSERT INTO `document` (`id`, `id_mapel`, `waktu`, `path_doc_nilai`, `path_doc_remedial`) VALUES
(1, 1, '2024-10-05 04:06:01', '.\\src\\document\\penilaian\\Informatika.pdf', '.\\src\\document\\remedial\\Informatika.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `kode_mapel` varchar(12) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kkm` int(3) NOT NULL,
  `mutu` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `id_guru`, `kode_mapel`, `nama`, `kkm`, `mutu`) VALUES
(1, 2, 'TIK001', 'Informatika', 75, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_mutu`
--

CREATE TABLE `penilaian_mutu` (
  `id` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kepsek` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `doc_nilai` tinyint(1) DEFAULT NULL,
  `doc_remedial` tinyint(1) DEFAULT NULL,
  `sesuai_jadwal` tinyint(1) NOT NULL,
  `metode_beragam` tinyint(1) NOT NULL,
  `berkelanjutan` tinyint(1) NOT NULL,
  `peningkatan` tinyint(1) NOT NULL,
  `mutu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian_mutu`
--

INSERT INTO `penilaian_mutu` (`id`, `id_doc`, `id_mapel`, `id_kepsek`, `waktu`, `doc_nilai`, `doc_remedial`, `sesuai_jadwal`, `metode_beragam`, `berkelanjutan`, `peningkatan`, `mutu`) VALUES
(1, 1, 1, 2, '2024-10-05 04:07:39', 1, 1, 1, 0, 1, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `npsm` int(8) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `status` enum('Negeri','Swasta') DEFAULT NULL,
  `bp` enum('SD','SMP','SMA','SMK') DEFAULT NULL,
  `akreditasi` enum('A','B','C','TT') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `npsm`, `nama`, `status`, `bp`, `akreditasi`) VALUES
(1, 10403968, 'SMP NEGERI 13 PEKANBARU', 'Negeri', 'SMP', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tendik`
--

CREATE TABLE `tendik` (
  `id` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `nip` bigint(18) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `jabatan` enum('Kepsek','Guru') NOT NULL,
  `pendidikan` enum('SMA/SMK','D1','D2','D3','D4','S1','S2','S3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tendik`
--

INSERT INTO `tendik` (`id`, `id_sekolah`, `nama`, `nip`, `jk`, `jabatan`, `pendidikan`) VALUES
(1, 1, 'Muhammad', 2596414538113106, 'L', 'Kepsek', 'S2'),
(2, 1, 'Jonathan', 2824263437853327, 'L', 'Guru', 'S1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doc_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_guru` (`id_guru`);

--
-- Indeks untuk tabel `penilaian_mutu`
--
ALTER TABLE `penilaian_mutu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mutu_doc` (`id_doc`),
  ADD KEY `fk_mutu_kepsek` (`id_kepsek`),
  ADD KEY `fk_mutu_mapel` (`id_mapel`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tendik`
--
ALTER TABLE `tendik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tendik_sekolah` (`id_sekolah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penilaian_mutu`
--
ALTER TABLE `penilaian_mutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tendik`
--
ALTER TABLE `tendik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `fk_doc_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`);

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `fk_mapel_guru` FOREIGN KEY (`id_guru`) REFERENCES `tendik` (`id`);

--
-- Ketidakleluasaan untuk tabel `penilaian_mutu`
--
ALTER TABLE `penilaian_mutu`
  ADD CONSTRAINT `fk_mutu_doc` FOREIGN KEY (`id_doc`) REFERENCES `document` (`id`),
  ADD CONSTRAINT `fk_mutu_kepsek` FOREIGN KEY (`id_kepsek`) REFERENCES `tendik` (`id`),
  ADD CONSTRAINT `fk_mutu_mapel` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`);

--
-- Ketidakleluasaan untuk tabel `tendik`
--
ALTER TABLE `tendik`
  ADD CONSTRAINT `fk_tendik_sekolah` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
