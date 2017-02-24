-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 09:34 AM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `absensi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kelas`
--

CREATE TABLE IF NOT EXISTS `anggota_kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `anggota_kelas`
--

INSERT INTO `anggota_kelas` (`id`, `id_kelas`, `id_siswa`) VALUES
(7, 6, 2),
(8, 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_jabatan` (`nama_jabatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
(3, 'Guru'),
(1, 'Kepala Sekolah'),
(4, 'Tata Usaha'),
(2, 'Wakil Kepala Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran_siswa`
--

CREATE TABLE IF NOT EXISTS `kehadiran_siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `keterangan` enum('HADIR','ALPA','SAKIT','IJIN') NOT NULL,
  `tanggal` date NOT NULL,
  `id_operator` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `kehadiran_siswa`
--

INSERT INTO `kehadiran_siswa` (`id`, `id_siswa`, `keterangan`, `tanggal`, `id_operator`) VALUES
(11, 2, 'HADIR', '2017-02-24', 21),
(12, 8, 'ALPA', '2017-02-24', 21);

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran_staff`
--

CREATE TABLE IF NOT EXISTS `kehadiran_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_staff` int(11) NOT NULL,
  `keterangan` enum('HADIR','ALPA','SAKIT','IJIN') NOT NULL,
  `tanggal` date NOT NULL,
  `id_operator` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kehadiran_staff`
--

INSERT INTO `kehadiran_staff` (`id`, `id_staff`, `keterangan`, `tanggal`, `id_operator`) VALUES
(14, 19, 'HADIR', '2017-02-24', 21),
(15, 21, 'ALPA', '2017-02-24', 21),
(16, 22, 'ALPA', '2017-02-24', 21);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_wali_kelas` int(11) DEFAULT NULL,
  `nama_kelas` varchar(250) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `id_wali_kelas`, `nama_kelas`, `tahun_ajaran`, `status`) VALUES
(1, NULL, '3 TKJ', '2016/2017', 0),
(2, NULL, '2 TKJ', '2016/2017', 0),
(3, NULL, '1 TKJ', '2016/2017', 0),
(4, NULL, '3 RPL', '2016/2017', 0),
(5, NULL, '2 RPL', '2016/2017', 0),
(6, NULL, '1 RPL', '2016/2017', 0),
(8, NULL, '1 AK', '2017/2018', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `peran` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `terakhir_loggedin` date NOT NULL,
  PRIMARY KEY (`id_pengguna`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `peran`, `status`, `terakhir_loggedin`) VALUES
(21, 'admin', 'admin', 'ADMINISTRATOR', 1, '0000-00-00'),
(24, 'staff', 'staff', 'STAFF', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` char(100) NOT NULL,
  `module_id` char(100) NOT NULL,
  `module_name` varchar(250) NOT NULL,
  `create_action` tinyint(1) NOT NULL,
  `read_action` tinyint(1) NOT NULL,
  `update_action` tinyint(1) NOT NULL,
  `delete_action` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_index` (`role`,`module_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `module_id`, `module_name`, `create_action`, `read_action`, `update_action`, `delete_action`) VALUES
(1, 'ADMINISTRATOR', 'absensi_siswa', 'Absensi Siswa', 1, 1, 1, 1),
(2, 'ADMINISTRATOR', 'absensi_staff', 'Absensi Staff', 1, 1, 1, 1),
(3, 'ADMINISTRATOR', 'kelas', 'Kelas', 1, 1, 1, 1),
(4, 'ADMINISTRATOR', 'laporan', 'Laporan', 1, 1, 1, 1),
(5, 'ADMINISTRATOR', 'pengguna', 'Pengguna', 1, 1, 1, 1),
(6, 'ADMINISTRATOR', 'siswa', 'Siswa', 1, 1, 1, 1),
(7, 'ADMINISTRATOR', 'staff', 'Staff', 1, 1, 1, 1),
(8, 'STAFF', 'absensi_siswa', 'Absensi Siswa', 1, 1, 1, 0),
(9, 'STAFF', 'absensi_staff', 'Absensi Staff', 1, 1, 1, 0),
(10, 'STAFF', 'kelas', 'Kelas', 0, 0, 0, 0),
(11, 'STAFF', 'laporan', 'Laporan', 0, 0, 0, 0),
(12, 'STAFF', 'pengguna', 'Pengguna', 0, 0, 0, 0),
(13, 'STAFF', 'siswa', 'Siswa', 0, 0, 0, 0),
(14, 'STAFF', 'staff', 'Staff', 0, 0, 0, 0),
(15, 'ADMINISTRATOR', 'role', 'Hak Akses', 1, 1, 1, 1),
(16, 'STAFF', 'role', 'Hak Akses', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id siswa',
  `nomor_induk` varchar(250) NOT NULL,
  `nama_lengkap` varchar(250) NOT NULL,
  `alamat` text,
  `jenis_kelamin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_induk` (`nomor_induk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nomor_induk`, `nama_lengkap`, `alamat`, `jenis_kelamin`) VALUES
(8, '100000001', 'Basuki Cahaya ', 'Alamat ahok', 1),
(9, '6123', 'Steven', 'Indo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` text,
  `id_jabatan` int(11) DEFAULT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `pendidikan_terakhir` char(50) DEFAULT NULL,
  `status` enum('AKTIF','NON_AKTIF','VOID','') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `nip`, `nama`, `alamat`, `id_jabatan`, `jenis_kelamin`, `pendidikan_terakhir`, `status`) VALUES
(19, '1003', 'Saeful Rahman', '', 2, 1, 'S1', 'AKTIF'),
(21, '10002', 'Stevan', 'alamat ali', 1, 1, 'S1', 'AKTIF'),
(22, '3434343', 'test', 'ini test', 4, 1, 'SMA', 'NON_AKTIF'),
(23, '1000101', 'testing lagi', 'asdf', 3, 1, 'S1', 'NON_AKTIF'),
(24, '764', 'Ervan', 'Indo', 3, 1, 'SMA', 'AKTIF');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
