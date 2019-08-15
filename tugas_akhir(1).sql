-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2019 pada 18.14
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_detail_pinjam` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_inventaris_brg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_detail_pinjam`, `id_pinjam`, `id_inventaris_brg`) VALUES
(1, 14, 16),
(2, 14, 17),
(3, 14, 16),
(4, 14, 16),
(5, 54, 18),
(6, 69, 16),
(7, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen_staf`
--

CREATE TABLE `dosen_staf` (
  `id` int(11) NOT NULL,
  `nidn` varchar(100) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen_staf`
--

INSERT INTO `dosen_staf` (`id`, `nidn`, `nip`, `nik`, `nama`, `jabatan`) VALUES
(5, '0001089001', '199008012019031', '160390014542324', ' Iryanto, S.Si., M.Si', ' Dosen & Ketua Jurusan  '),
(6, '0409078101', '', ' 08048123', 'Eka Ismantohadi, S.Kom., M.Eng  ', 'Dosen & Sekretaris Jurusan '),
(7, '0404108601', '1986100420190310', ' 08098642', ' Willy Permana Putra, S.T., M.Eng', ' Dosen & Ka. Laboratorium');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris_brg`
--

CREATE TABLE `inventaris_brg` (
  `id` int(11) NOT NULL,
  `kode_brg` varchar(255) NOT NULL,
  `nama_brg` varchar(255) NOT NULL,
  `id_kategori_brg` int(11) NOT NULL,
  `jumlah_brg` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inventaris_brg`
--

INSERT INTO `inventaris_brg` (`id`, `kode_brg`, `nama_brg`, `id_kategori_brg`, `jumlah_brg`, `foto`) VALUES
(16, '828321858', 'CPU', 1, '3', '1565150927_cpu.jpg'),
(17, '76543644', 'printer', 1, '20', '1565151013_printer.jpg'),
(18, '0010697247', 'kabel RJ-45', 2, '15', '1565151778_rj-45.jpg'),
(19, '12345678', 'mouse', 1, '20', '1565151091_mouse.jpg'),
(20, '897564442435235', 'proyektor acer', 1, '30', '1565152275_proyektor.jpg'),
(21, '9876544334', 'kabel VGA', 1, '23', '1565152311_vga.jpg'),
(22, '765453425', 'led', 2, '400', '1565152409_led.jpg'),
(23, 'AR-543643643', 'arduino uno', 1, '5', '1565152505_arduino.jpg'),
(24, 'USB-69593599493', 'usb cable arduino', 1, '10', '1565152620_usb-arduino.jpg'),
(25, 'JU-49395435834', 'kabel jumper', 2, '2500', '1565152758_jumper.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`) VALUES
(1, 'Teknik Informatika'),
(2, 'Teknik Mesin'),
(3, 'Teknik Pendingin dan Tata Udara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_brg`
--

CREATE TABLE `kategori_brg` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_brg`
--

INSERT INTO `kategori_brg` (`id`, `nama`) VALUES
(1, 'Alat'),
(2, 'Bahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mhs`
--

CREATE TABLE `mhs` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mhs`
--

INSERT INTO `mhs` (`id`, `nama`, `id_jurusan`, `foto`, `nim`) VALUES
(52, 'nurinayatun mahmuda', 1, '1565149673_nur inayatun mahmuda.jpg', '1603109'),
(53, 'luvi', 1, '1565173233_luvi khaerunisa.jpg', '1603105'),
(55, 'Jenia Adellia', 1, '1565173343_Jenia Adellia Puspita.JPG', '1603102'),
(56, 'fauzi al', 1, '1565174240_muhammad fauji alfariz.jpg', '1603107'),
(57, 'jenia adellia', 1, '1565174369_Jenia Adellia Puspita.JPG', '1603102'),
(58, 'koriah', 1, '1565174673_koriah.jpg', '1603103'),
(59, 'Wulan', 1, '1565755530_Image4.jpg', '1603118'),
(60, 'suji', 1, '1565776983_sujiyanto.jpg', '1603101'),
(61, 'lelo', 1, '1565778115_muhroz alfarizi.jpg', '43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian_lab`
--

CREATE TABLE `pemakaian_lab` (
  `id` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `nama_lab` varchar(255) NOT NULL,
  `mata_kuliah` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemakaian_lab`
--

INSERT INTO `pemakaian_lab` (`id`, `nama_pengguna`, `nama_lab`, `mata_kuliah`, `date`) VALUES
(19, 'Shafa Dhiyanti', 'pemrograman', 'pemrograman', '2019-07-14'),
(20, 'Fauzi al fariz', 'sistem operasi', 'sistem operasi', '2019-07-22'),
(21, 'Luvi Haerunisah', 'RPL', 'Proyek II', '2019-07-16'),
(25, 'Nurinayatun Mahmuda', 'RPL', 'Proyek III', '2019-07-18'),
(26, 'PEMROGRAMAN', 'PEMRO', 'OOP', '2019-08-09'),
(27, 'PEMROGRAMAN', 'PEMRO', 'OOP', '2019-08-09'),
(28, 'dia', 'apan', 'bodo', '2019-08-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_dosen_staf` int(11) NOT NULL,
  `id_inventaris_brg` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `id_detail_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_dosen_staf`, `id_inventaris_brg`, `id_mhs`, `tgl_pinjam`, `tgl_kembali`, `keterangan`, `status`, `id_detail_pinjam`) VALUES
(14, 7, 16, 52, '2019-09-05', '2019-08-14', 'treg', 2, 0),
(15, 7, 17, 58, '2019-08-07', '2019-08-07', 'untuk ngeprint', 2, 0),
(16, 6, 16, 52, '2019-08-29', '2019-09-05', 'bdf', 2, 0),
(17, 5, 16, 52, '2019-09-04', '0000-00-00', 'fg', 2, 0),
(18, 6, 18, 52, '2019-09-04', '2019-08-09', 'fjdjgdf', 3, 0),
(19, 6, 16, 52, '2019-09-04', '2019-08-12', 'gfhgf', 2, 0),
(20, 7, 17, 52, '2019-09-06', '2019-08-12', 'oke', 3, 0),
(21, 6, 17, 52, '2019-09-04', '2019-08-12', 'oke', 2, 0),
(22, 6, 19, 52, '2019-08-28', '0000-00-00', 'sfdx', 2, 0),
(33, 5, 20, 59, '2019-08-01', '0000-00-00', 'gggg', 2, 0),
(34, 5, 17, 59, '2019-08-14', '0000-00-00', 'hjvjh', 2, 0),
(35, 5, 19, 59, '2019-09-05', '0000-00-00', 'bbb', 2, 0),
(36, 5, 19, 59, '2019-07-30', '0000-00-00', 'kjkj', 2, 0),
(37, 5, 19, 59, '2019-08-28', '0000-00-00', 'nnn', 1, 0),
(38, 5, 21, 59, '2019-08-14', '0000-00-00', 'nnnkh', 2, 0),
(39, 5, 18, 52, '2019-08-09', '0000-00-00', 'nkjkj', 2, 0),
(40, 5, 19, 52, '2019-08-15', '0000-00-00', 'fdmg', 1, 0),
(52, 7, 17, 52, '2019-09-03', '2019-09-05', 'esdf', 1, 0),
(53, 5, 22, 52, '2019-09-07', '2019-09-07', 'iya', 1, 0),
(54, 7, 0, 52, '2019-08-01', '2019-08-01', 'abc', 2, 0),
(55, 6, 0, 52, '2019-08-08', '2019-09-06', 'iya', 2, 0),
(56, 5, 0, 52, '2019-08-01', '2019-08-01', 'oce', 2, 0),
(57, 6, 0, 52, '2019-08-01', '2019-08-01', 'bismilah', 2, 0),
(58, 6, 0, 52, '2019-08-07', '2019-08-07', 'wow', 2, 0),
(59, 7, 0, 52, '2019-08-01', '2019-08-01', 'oce', 2, 0),
(60, 7, 0, 52, '2019-08-01', '2019-08-01', 'oce', 2, 0),
(61, 7, 0, 52, '2019-08-01', '2019-08-01', 'oce', 2, 0),
(62, 7, 0, 52, '2019-08-13', '2019-08-29', 'sdf', 2, 0),
(63, 6, 0, 52, '2019-08-14', '2019-08-14', 'dgr', 2, 0),
(64, 6, 0, 52, '2019-08-10', '2019-08-10', 'sdfk', 2, 0),
(65, 6, 0, 52, '2019-08-10', '2019-08-10', 'sdfk', 2, 0),
(66, 7, 0, 52, '2019-08-10', '2019-08-10', 'rr', 2, 0),
(67, 5, 0, 52, '2019-08-03', '2019-08-15', 'skfdk', 3, 0),
(68, 6, 0, 53, '2019-08-01', '2019-08-01', 'da', 2, 0),
(69, 6, 0, 53, '2019-08-24', '2019-08-15', 'rdfre', 2, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_user_role` int(11) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `id_mhs`, `id_user_role`, `token`) VALUES
(1, 'admin', '$2y$13$MSTQJKYv9O9Cmhs0izn3wO0hlso23fk1ucW8Iu0/iDK4ivS32oqjy', 0, 1, ''),
(14, 'muda1', '$2y$13$nm51Xh4HMS1hoIO7zoMS6OI.haJvyKAg/hge0Zgxk.fOMKuLNanqK', 52, 2, 'vts4XsGmitr4MLEH7sNXh3fakG55dDumTHLvHqCpU89pViG4Pq'),
(15, 'luvi', '$2y$13$LRzMxde.8HetUdDhHzHICu8JpNbik9.tT1XQGJPGjenNa5EopviWK', 53, 2, 'yN6i0hd0EusJqLjOTizmE6AMmXUepFoiUTRC_nmBXJRNcmevSe'),
(16, 'jo1', '$2y$13$M50NnXmaNaPGFnUkuZVgZewa.fuBe7MKz6maX9BUG1ZBHS8uGMgTm', 54, 2, '7szXXv5FgMXg1W8jN1HDKjHcug2omyIsqyLTCO8whfjxryt2LD'),
(17, 'Jenia Adellia', '$2y$13$2efKR7m6T0ebB7noZ/WdzOgKI86nbcdt1cMCX7fXBL4fYJyycbxUq', 55, 2, 'zl2F-cez982uhu8URGHYjfN_qe1PXokBI6OrTrenBxV8Fcofqg'),
(18, 'fauzi al', '$2y$13$DoCQc8gxCU6qdRvAdBhNMuwCLI2bjmkIwT6XuIfZUi1H1Ma1qIvRK', 56, 2, 'VVALjl4Qjrg_LsH8bX0COnSL602HJ2JwSJposjl_9XPaZaIyvs'),
(19, 'jenia adellia', '$2y$13$Xg8ErgkKVSROZTyPlH0wd.Sy2l0vnV/Iu6Vq5QwYjeR0dLRShLhuC', 57, 2, 'UacG2hm4vn7djQEfXx2k_BJB4E1PvE70ewpcfuf63_KGIz7ey3'),
(20, 'koriah', '$2y$13$7Xfm5crd23iWqfNVoAvHbOQOswRYg2tSIJO.dWOe.UmK7FiWawzR6', 58, 2, 'rOIf_4RceAM_7T7x1csInBSXw-gbBoiKbdSY_qvhWK5p2wBKMq'),
(21, 'Wulan', '$2y$13$J7MS7VId3bRBK1mpDFXVEO/DtysMQd9q4l9.JLdmLSyaReNPEVQmm', 59, 2, 'Ui26YwAg0YuNzPKcyN0znB6Pzgz2QfxVBkxR2NSrtAiqLnxJzj'),
(22, 'suji', '$2y$13$mDIRNDnzbDmExHbYPACY2OharmM46q1Oac6meDoV76VOa4ofr1DA2', 60, 2, 'pB4B0tJZAu1mpSqubvMIeFihSGWapMMTyc9_s4p2BuT8sycTmW'),
(23, 'lelo', '$2y$13$d.AMWcrnIRaBrwV0ISbW..9v6gldQzxgVx/fz65PbunqtuSWlviQu', 61, 2, 'rZcsOUThULS8twVsg-5BvAe4NMPZfxm4p6bsfAY9DFSHkvpWTo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `nama`) VALUES
(1, 'admin'),
(2, 'mhs');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_detail_pinjam`);

--
-- Indeks untuk tabel `dosen_staf`
--
ALTER TABLE `dosen_staf`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inventaris_brg`
--
ALTER TABLE `inventaris_brg`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_brg`
--
ALTER TABLE `kategori_brg`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemakaian_lab`
--
ALTER TABLE `pemakaian_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_detail_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `dosen_staf`
--
ALTER TABLE `dosen_staf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `inventaris_brg`
--
ALTER TABLE `inventaris_brg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `kategori_brg`
--
ALTER TABLE `kategori_brg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `pemakaian_lab`
--
ALTER TABLE `pemakaian_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
