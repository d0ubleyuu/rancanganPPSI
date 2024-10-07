-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2024 pada 03.46
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
(1, 1, '2024-10-05 04:06:01', 'penilaian_informatika.pdf', 'remedial_informatik.pdf'),
(8, 4, '2024-10-06 16:40:52', 'MSI2101_Basis Data_Febri Putri_2024-10-06_Catatan_Penilaian.pdf', 'MSI2101_Basis Data_Febri Putri_2024-10-06_Laporan_Remedial.pdf');

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
  `mutu` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `id_guru`, `kode_mapel`, `nama`, `kkm`, `mutu`) VALUES
(1, 2, 'TIK001', 'Informatika', 75, 4),
(4, 3, 'MSI2101', 'Basis Data', 80, NULL);

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
(3, 1, 1, 1, '2024-10-06 03:22:50', 1, 1, 1, 1, 1, 1, 4);

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
(1, 10403968, 'SMP NEGERI 13 PEKANBARU', 'Negeri', 'SMP', 'A'),
(3, 10404376, ' SD DHARMA LOKA', 'Swasta', 'SD', 'A'),
(4, 10495040, ' SD IT BINTANG CENDEKIA', 'Swasta', 'SD', 'B');

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
  `jabatan` enum('Kepsek','Guru','Pengawas') NOT NULL,
  `pendidikan` enum('SMA/SMK','D1','D2','D3','D4','S1','S2','S3') NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tendik`
--

INSERT INTO `tendik` (`id`, `id_sekolah`, `nama`, `nip`, `jk`, `jabatan`, `pendidikan`, `email`, `password`) VALUES
(1, 1, 'Muhammad', 2596414538113106, 'L', 'Kepsek', 'S2', 'muhammad3106@kepsek.disdindik.sch.id', '38113106'),
(2, 1, 'Jonathan', 2824263437853327, 'L', 'Guru', 'S1', 'jonathan3327@guru.disdindik.sch.id', '37853327'),
(3, 1, 'Febri Putri', 552641401216153813, 'P', 'Pengawas', 'D4', 'febri.putri3813@pengawas.disdindik.sch.id', '16153813');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penilaian_mutu`
--
ALTER TABLE `penilaian_mutu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tendik`
--
ALTER TABLE `tendik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
