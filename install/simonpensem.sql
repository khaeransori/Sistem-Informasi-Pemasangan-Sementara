-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 10 Apr 2014 pada 22.13
-- Versi Server: 5.6.12-log
-- Versi PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `simonpensem`
--

CREATE DATABASE IF NOT EXISTS `simonpensem` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `simonpensem`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_daftar` date NOT NULL,
  `nama_pemohon` varchar(255) NOT NULL,
  `jenis_pemohon` int(11) NOT NULL,
  `id_pelanggan_pemohon` varchar(255) NOT NULL,
  `daya_pemohon` int(11) NOT NULL,
  `no_registrasi_pemohon` varchar(255) NOT NULL,
  `alamat_pemohon` text NOT NULL,
  `daya_pesta` int(11) NOT NULL,
  `lama_pesta` int(11) NOT NULL,
  `tanggal_pasang` datetime NOT NULL,
  `id_petugas_pasang` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `tanggal_bongkar` datetime NOT NULL,
  `id_petugas_bongkar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `guest`
--

INSERT INTO `guest` (`id`, `user`, `pass`, `nama`) VALUES
(1, 'guest', 'guest', 'Guest');

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `nama`) VALUES
(1, 'admin', 'admin', 'Administrator');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
