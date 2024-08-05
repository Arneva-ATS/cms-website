-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 05, 2024 at 09:47 AM
-- Server version: 10.5.22-MariaDB
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `nama_agenda` varchar(100) NOT NULL,
  `tanggal_agenda` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `jam` varchar(25) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `nama_agenda`, `tanggal_agenda`, `tanggal_selesai`, `jam`, `foto`, `keterangan`) VALUES
(2, 'Rapat  Pengurus Baznas', '2024-08-28', '2024-09-01', '18:57', '57425DSC01797.JPG', '<p>pada jam 13.00 wib <br />bertempat di&nbsp; Kantor Sekretariat BAZNAS Kota Payakumbuh (Lantai II Mushalla Baiturrahmah)</p>\r\n<p>Dalam Rangka membicarakan tentang :<br />&nbsp;1. Evaluasi Pelaksanaan Tugas</p>\r\n<p>&nbsp;2. Perencanaan Pendistribusian Bantuan Modal USaha /Produktif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; tahun&nbsp;&nbsp; 2014</p>\r\n<p>&nbsp;3. Hal -hal lain yang dianggap perlu</p>'),
(3, 'Rapat Baznas Kota Payakumbuh', '2024-10-27', '2024-11-05', '15:54', '13468DSC01916.JPG', '<p>Rapat anggota Baznas Kota Payakumbuh, pada jam 10.00 wib<br />bertempat di secretariat Baznas Kota Payakumbuh.hal:</p>\r\n<p>Penyempurnaan Program</p>');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `judul_seo` varchar(150) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `id_kategori`, `judul`, `judul_seo`, `keterangan`, `foto`, `tgl`, `id_user`, `username`, `hits`) VALUES
(2, 10, 'Dalam Program Payakumbuh Cerdas BAZNAS Kota Payakumbuh', 'dalam-program-payakumbuh-cerdas-baznas-kota-payakumbuh', '<p><span>Dalam Program Payakumbuh Cerdas, Penyerahan Bantuan Biaya Pendidikan Dari BAZNAS Kota Payakumbuh kepada Prilia Eka Putri di Kel. Balai Baru Kec. Payakumbuh Utara.</span></p>', '7701850176IMG_20191119_111116.jpg', '2020-06-13', 1, 'admin', 7),
(3, 10, 'Dalam Program Payakumbuh Sehat BAZNAS Kota Payakumbuh', 'dalam-program-payakumbuh-sehat-baznas-kota-payakumbuh', '<p><span>Dalam Program Payakumbuh Sehat, Penyerahan Bantuan Biaya Pengobatan Dari BAZNAS Kota Payakumbuh kepada Bapak Hendri Mustaqin di Kel. Labuah Basilang Kec. Payakumbuh Barat.</span></p>', '6923681028IMG_8072.jpeg', '2020-06-13', 1, 'admin', 4),
(4, 10, 'Penerimaan Zakat Profesi Dari Muzakki Yang Diterima Oleh Staff BAZNAS Kota Payakumbuh', 'penerimaan-zakat-profesi-dari-muzakki-yang-diterima-oleh-staff-baznas-kota-payakumbuh', '<p>Semoga Allah memberikan pahala kepadamu pada barang yang engkau berikan (zakatkan) dan semoga Allah memberimu berkah dalam harta-harta yang masih engkau sisakan dan semoga pula menjadikannya sebagai pembersih (dosa) bagimu.</p>\r\n<p>Penerimaan Zakat Profesi dari Muzakki yg diterima oleh Staff BAZNAS Kota Payakumbuh sebanyak Rp 8.750.000.00.</p>', '746352907IMG_8085.jpeg', '2020-06-13', 1, 'admin', 6),
(5, 10, 'Penerimaan Zakat Mal Dari Kapolres Kota Payakumbuh', 'penerimaan-zakat-mal-dari-kapolres-kota-payakumbuh', '<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\">\r\n<div dir=\"auto\">Semoga Allah memberikan pahala kepadamu pada barang yang engkau berikan (zakatkan) dan semoga Allah memberimu berkah dalam harta-harta yang masih engkau sisakan dan semoga pula menjadikannya sebagai pembersih (dosa) bagimu.</div>\r\n</div>\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql ii04i59q\">\r\n<div dir=\"auto\">Penerimaan Zakat Mal dari Kapolres Kota Payakumbuh.</div>\r\n</div>', '6752914586IMG_8268.jpeg', '2020-06-13', 1, 'admin', 7);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `id_kategori`, `foto`, `keterangan`) VALUES
(13, 2, '9757158781DSC01684.jpeg', '<p><span>Penyerahan bantuan pesantren ramadhan 1435 H kepada Dinas Pendidikan</span></p>'),
(14, 2, '8331262224DSC02253.jpeg', '<p><span>Penyerahan dana Pengobatan bertempat di RSUD Payakumbuh</span></p>'),
(15, 2, '3034052022DSC01743.jpeg', '<p><span>Penyerahan bantuan konsumtif 2011 secara simbolis oleh bapak walikota</span></p>'),
(16, 2, '148474920DSC01687.jpeg', '<p>Penyerahan dana untuk pengobatan di sekretariat Baznas Kota payakumbuh</p>'),
(17, 2, '8423074878DSC01835.jpeg', '<p>Penyerahan bantuan Modal Usaha kepada kaum mustahiq atau warga kurang mampu pada lima kecamatan di &nbsp;Kota Payakumbuh , bertempat di aula KEMENAG Kota Payakumbuh , pada Hari Sabtu , 20 September 2014 .</p>'),
(18, 2, '375995102211.jpg', '<p>Wakil walikota Payakumbuh Suwandel Muchtar lantik pengurus BAZNAS KOTA PAYAKUMBUH Periode 2013-2018</p>'),
(19, 2, '24964393741495DSC01789.jpeg', '<p>acara buka puasa bersama pengurus BAZNAS Kota Payakumbuh Selasa 22 Juli 2014</p>'),
(20, 2, '3313717499DSC01568.jpeg', '<p>Penyerahan dana untuk 70 orang Mahasiswa sekota Payakumbuh yang diselenggarakan pada 15 Mei 2014 .</p>');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_berita`
--

INSERT INTO `kategori_berita` (`id_kategori`, `nama_kategori`) VALUES
(10, 'KEGIATAN BAZNAS'),
(11, 'TRAVEL'),
(12, 'OLAHRAGA'),
(13, 'EKONOMI'),
(14, 'ALAM BUDAYA'),
(15, 'PENDIDIKAN'),
(16, 'AGAMA'),
(17, 'POLITIK'),
(18, 'UMUM'),
(19, 'BERITA'),
(20, 'Pendistribusian BAZNAS'),
(21, 'PROGRAM dan PERSYARATAN'),
(22, 'BANTUAN PENGOBATAN'),
(23, 'PAYAKUMBUH SEJAHTERA'),
(24, 'PAYAKUMBUH CERDAS'),
(25, 'PAYAKUMBUH RELAGIUS'),
(26, 'PAYAKUMBUH PEDULI'),
(27, 'PAYAKUMBUH SEHAT');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_galeri`
--

CREATE TABLE `kategori_galeri` (
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_galeri`
--

INSERT INTO `kategori_galeri` (`id_kategori`, `judul`) VALUES
(1, 'Penyerahan Dana'),
(2, 'Kegiatan Baznas');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `keterangan`) VALUES
(1, '<p>Untuk Kontak Kami, Bisa dihubuni no. dibawah ini :</p>\r\n<p><strong>muhammad45rifki@gmail.com</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profile` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profile`, `foto`, `keterangan`) VALUES
(1, '5692043406struktur_oranisasi_baznas1.jpg', '<p align=\"center\"><strong>VISI DAN MISI BAZNAS</strong></p>\r\n<p align=\"center\"><strong>KOTA PAYAKUMBUH</strong></p>\r\n<p align=\"center\"><strong>VISI</strong></p>\r\n<p align=\"center\">&ldquo;Terwujudnya BAZNAS yang Amanah, Transparan dan Profesional Untuk Keberkahan dan Kesejahteraan Ummat di Kota Payakumbuh\"</p>\r\n<p align=\"center\"><strong>MISI</strong></p>\r\n<p>1.&nbsp;Meningkatkan kesadaran umat untuk membayar zakat melalui Badan Amil Zakat</p>\r\n<p><br />2.&nbsp;Meningkatkan upaya penghimpunan dan pendayagunaan zakat umat sesuai dengan ketentuan syari&rsquo;ah dan prinsip manajemen modern</p>\r\n<p><br />3.&nbsp;Meningkatkan pengetahuan dan keterampilan pengelola amil zakat sehingga menjadi amil zakat yang amanah dan professional</p>\r\n<p><br />4.&nbsp;Mewujudkan pusat data zakat nasional di kota Payakumbuh</p>\r\n<p><br />5.&nbsp;Memaksimalkan peran zakat dalam menanggulangi kemiskinan, kebodohan dan menciptakan masyarakat yang sehat</p>');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status_user` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `email`, `alamat`, `tanggal_lahir`, `foto`, `status_user`) VALUES
(1, 'admin', 'rifqi', '827ccb0eea8a706c4c34a16891f84e7b', 'muhammad45rifki@gmail.com', '<p>ciputat</p>', '2020-06-09', '98918images.jpeg', 'admin'),
(2, 'rifki-dev', 'muhammad rifki', '827ccb0eea8a706c4c34a16891f84e7b', 'muhammad45rifki@gmail.com', '<p>ciputat</p>', '2020-06-13', '60194images.jpeg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_galeri`
--
ALTER TABLE `kategori_galeri`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kategori_galeri`
--
ALTER TABLE `kategori_galeri`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
