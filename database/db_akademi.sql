-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2018 at 06:29 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_akademi`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dosen` varchar(255) NOT NULL,
  `kode_dosen` varchar(255) NOT NULL,
  `no_hp` varchar(250) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_dosen`),
  UNIQUE KEY `nama_dosen` (`nama_dosen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`, `kode_dosen`, `no_hp`, `keterangan`) VALUES
(1, 'Dr. Ir. Agus Susanto, MM', 'AS', '2147483647', 'Keterangan saja'),
(2, 'bella swan', 'bs', '876', 'wdwd');

-- --------------------------------------------------------

--
-- Table structure for table `matkul_akuntansi`
--

CREATE TABLE IF NOT EXISTS `matkul_akuntansi` (
  `id_matkul_akuntansi` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(20) NOT NULL,
  `subject_name` text NOT NULL,
  `credits` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `dosen` varchar(20) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_matkul_akuntansi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `matkul_akuntansi`
--

INSERT INTO `matkul_akuntansi` (`id_matkul_akuntansi`, `subject_code`, `subject_name`, `credits`, `semester`, `dosen`, `kode`, `keterangan`) VALUES
(1, 'GEED-101', 'Pancasila dan Kewarganegaraan', 3, 1, 'Drs. H Arjuna Wiwaha', 'AW', 'Pagi, Sore');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasiltes`
--

CREATE TABLE IF NOT EXISTS `tb_hasiltes` (
  `id_hasiltes` varchar(6) NOT NULL,
  `nilai_mat` int(11) NOT NULL,
  `nilai_bing` int(11) NOT NULL,
  `nilai_psikotes` int(11) NOT NULL,
  `no_pendaftaran` varchar(6) NOT NULL,
  PRIMARY KEY (`id_hasiltes`),
  KEY `no_pendaftaran` (`no_pendaftaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_intake`
--

CREATE TABLE IF NOT EXISTS `tb_intake` (
  `id_intake` varchar(6) NOT NULL,
  `intake` varchar(10) NOT NULL,
  PRIMARY KEY (`id_intake`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `id_jurusan` varchar(6) NOT NULL,
  `id_sekolah` varchar(6) NOT NULL,
  `nama_jurusan` text NOT NULL,
  PRIMARY KEY (`id_jurusan`),
  KEY `id_sekolah` (`id_sekolah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `id_sekolah`, `nama_jurusan`) VALUES
('JU001', 'SE001', 'RPL'),
('JU002', 'SE002', 'RPL'),
('JU003', 'SE001', 'TKJ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_konsentrasi`
--

CREATE TABLE IF NOT EXISTS `tb_konsentrasi` (
  `id_konsentrasi` varchar(6) NOT NULL,
  `nama_konsentrasi` varchar(20) NOT NULL,
  `id_prodi` varchar(6) NOT NULL,
  PRIMARY KEY (`id_konsentrasi`),
  KEY `id_prodi` (`id_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konsentrasi`
--

INSERT INTO `tb_konsentrasi` (`id_konsentrasi`, `nama_konsentrasi`, `id_prodi`) VALUES
('KO001', 'Marketing Management', 'PR001'),
('KO002', 'Finance Management', 'PR001'),
('KO003', 'Auditing', 'PR002'),
('KO004', 'Taxation', 'PR002');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftar`
--

CREATE TABLE IF NOT EXISTS `tb_pendaftar` (
  `no_pendaftaran` varchar(6) NOT NULL,
  `nama_pendaftar` varchar(100) NOT NULL,
  `jk_pendaftar` varchar(12) NOT NULL,
  `tpt_lahir_pendaftar` varchar(20) NOT NULL,
  `tgl_lahir_pendaftar` date NOT NULL,
  `alamat_pendaftar` text NOT NULL,
  `no_telp_pendaftar` varchar(15) NOT NULL,
  `no_telpm_pendaftar` varchar(30) NOT NULL,
  `email_pendaftar` varchar(50) NOT NULL,
  `agama_pendaftar` text NOT NULL,
  `nik_pendaftar` varchar(50) NOT NULL,
  `ibu_kandung_pendaftar` text NOT NULL,
  `id_sekolah` varchar(5) NOT NULL,
  `id_prodi` varchar(5) NOT NULL,
  `id_konsentrasi` varchar(6) NOT NULL,
  `id_intake` varchar(6) NOT NULL,
  `waktu` text NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL,
  PRIMARY KEY (`no_pendaftaran`),
  KEY `id_sekolah` (`id_sekolah`),
  KEY `id_prodi` (`id_prodi`),
  KEY `id_prodi_2` (`id_prodi`),
  KEY `id_konsentrasi` (`id_konsentrasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pendaftar`
--

INSERT INTO `tb_pendaftar` (`no_pendaftaran`, `nama_pendaftar`, `jk_pendaftar`, `tpt_lahir_pendaftar`, `tgl_lahir_pendaftar`, `alamat_pendaftar`, `no_telp_pendaftar`, `no_telpm_pendaftar`, `email_pendaftar`, `agama_pendaftar`, `nik_pendaftar`, `ibu_kandung_pendaftar`, `id_sekolah`, `id_prodi`, `id_konsentrasi`, `id_intake`, `waktu`, `status`) VALUES
('PE001', 'Aldi', 'Male', '', '2018-05-01', 'Malang', '0987654', '987654', 'aldi@gmail.com', 'islam', '98765', 'Bu Wati', 'SE001', 'PR002', '', '', 'Pagi', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE IF NOT EXISTS `tb_prodi` (
  `id_prodi` varchar(6) NOT NULL,
  `nama_prodi` varchar(20) NOT NULL,
  `ketua_prodi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `nama_prodi`, `ketua_prodi`) VALUES
('PR001', 'Management', 'Dr. Iqbal'),
('PR002', 'Accounting', 'Dra. Tiffany'),
('PR003', 'halu', 'haa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sekolah`
--

CREATE TABLE IF NOT EXISTS `tb_sekolah` (
  `id_sekolah` varchar(6) NOT NULL,
  `nama_sekolah` varchar(30) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  PRIMARY KEY (`id_sekolah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`id_sekolah`, `nama_sekolah`, `alamat_sekolah`) VALUES
('SE001', 'SMK Telkom Malang', 'Jl. Danau Ranau Sawojajar Malang'),
('SE002', 'SMAN 3 Jakarta', 'Jl. Supriyadi No 47 jakarta');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_hasiltes`
--
ALTER TABLE `tb_hasiltes`
  ADD CONSTRAINT `tb_hasiltes_ibfk_1` FOREIGN KEY (`no_pendaftaran`) REFERENCES `tb_pendaftar` (`no_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD CONSTRAINT `tb_jurusan_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `tb_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_konsentrasi`
--
ALTER TABLE `tb_konsentrasi`
  ADD CONSTRAINT `tb_konsentrasi_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `tb_prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pendaftar`
--
ALTER TABLE `tb_pendaftar`
  ADD CONSTRAINT `tb_pendaftar_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `tb_prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pendaftar_ibfk_2` FOREIGN KEY (`id_sekolah`) REFERENCES `tb_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;