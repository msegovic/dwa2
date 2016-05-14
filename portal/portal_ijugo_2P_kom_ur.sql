-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2016 at 05:03 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `portal_ijugo`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanci`
--

CREATE TABLE IF NOT EXISTS `clanci` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) NOT NULL,
  `vk_autora` int(5) unsigned NOT NULL,
  `vk_kategorije` int(5) unsigned NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `objavljen` tinyint(1) unsigned NOT NULL,
  `uvod` text NOT NULL,
  `tekst` text NOT NULL,
  `pogledi` int(10) unsigned NOT NULL,
  `suma_ocjena` int(5) unsigned NOT NULL,
  `broj_ocjena` int(5) unsigned NOT NULL,
  `kom_ur` text,
  `vk_kom_ur` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `clanci`
--

INSERT INTO `clanci` (`id`, `naslov`, `vk_autora`, `vk_kategorije`, `datum`, `objavljen`, `uvod`, `tekst`, `pogledi`, `suma_ocjena`, `broj_ocjena`, `kom_ur`, `vk_kom_ur`) VALUES
(1, 'OOP u PHP', 1, 1, '2014-04-10 07:11:27', 1, 'Objektno programiranje u PHP-u', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium quam quis elit molestie, at sollicitudin arcu pretium. Pellentesque vel sem eu libero ullamcorper vestibulum quis a metus. Vestibulum dignissim magna ac mi sagittis blandit. Suspendisse mattis lectus leo, hendrerit imperdiet leo tristique eget. Nulla laoreet sem ac facilisis facilisis. Duis in massa vitae sem auctor suscipit pharetra id nisi. Ut at nulla non justo feugiat ornare. Integer non nisl accumsan, rhoncus nulla id, aliquet dui. Nullam interdum accumsan ligula, vel lobortis nisl sodales eu. Donec aliquet ullamcorper bibendum. Maecenas scelerisque urna sed condimentum blandit. Quisque arcu tellus, commodo quis dignissim eget, sollicitudin eget enim. Mauris pellentesque mi et tempus auctor.\r\n\r\nQuisque pharetra purus ut dui gravida volutpat. Donec luctus aliquam molestie. Etiam ac nunc et ligula faucibus tincidunt eu vel augue. Maecenas ac massa neque. Quisque sapien augue, blandit id aliquet vel, malesuada et nisl. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi id dictum ipsum. Donec nec massa nisl. Nullam a velit lobortis purus pulvinar tincidunt. Donec at massa sodales, malesuada arcu ut, lobortis turpis. Cras purus felis, cursus at nunc nec, gravida venenatis magna. Morbi vitae elementum mauris, id egestas mauris. Pellentesque tempus sem et diam adipiscing consequat. ', 233, 0, 0, 'jhkjhkjhkjhkj', 3),
(2, 'Uvod u HTML5', 1, 2, '2014-04-22 12:34:53', 1, 'Blah blah', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pretium quam quis elit molestie, at sollicitudin arcu pretium. Pellentesque vel sem eu libero ullamcorper vestibulum quis a metus. Vestibulum dignissim magna ac mi sagittis blandit. Suspendisse mattis lectus leo, hendrerit imperdiet leo tristique eget. Nulla laoreet sem ac facilisis facilisis. Duis in massa vitae sem auctor suscipit pharetra id nisi. Ut at nulla non justo feugiat ornare. Integer non nisl accumsan, rhoncus nulla id, aliquet dui. Nullam interdum accumsan ligula, vel lobortis nisl sodales eu. Donec aliquet ullamcorper bibendum. Maecenas scelerisque urna sed condimentum blandit. Quisque arcu tellus, commodo quis dignissim eget, sollicitudin eget enim. Mauris pellentesque mi et tempus auctor.\r\n\r\nQuisque pharetra purus ut dui gravida volutpat. Donec luctus aliquam molestie. Etiam ac nunc et ligula faucibus tincidunt eu vel augue. Maecenas ac massa neque. Quisque sapien augue, blandit id aliquet vel, malesuada et nisl. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi id dictum ipsum. Donec nec massa nisl. Nullam a velit lobortis purus pulvinar tincidunt. Donec at massa sodales, malesuada arcu ut, lobortis turpis. Cras purus felis, cursus at nunc nec, gravida venenatis magna. Morbi vitae elementum mauris, id egestas mauris. Pellentesque tempus sem et diam adipiscing consequat. ', 4, 0, 0, NULL, NULL),
(3, 'sadasdsa', 2, 2, '2016-04-11 12:09:04', 0, 'sadsad', 'sadsad', 4, 0, 0, 'Komentari ovdje', 3),
(4, 'jljkjlkj', 2, 2, '2016-04-11 13:00:18', 0, 'kljlkj', 'lkjlkj', 6, 0, 0, NULL, NULL),
(5, 'kjhkjhkjh', 2, 2, '2016-04-11 14:29:38', 0, 'kjhkj', 'sdsa', 2, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clanci_tagovi`
--

CREATE TABLE IF NOT EXISTS `clanci_tagovi` (
  `vk_clanka` int(10) unsigned NOT NULL,
  `vk_taga` int(10) unsigned NOT NULL,
  PRIMARY KEY (`vk_clanka`,`vk_taga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clanci_tagovi`
--

INSERT INTO `clanci_tagovi` (`vk_clanka`, `vk_taga`) VALUES
(3, 1),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE IF NOT EXISTS `kategorije` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(1, 'PHP'),
(2, 'HTML5');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vk_clanka` int(10) unsigned NOT NULL,
  `tekst` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `datum_unosa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `up` int(5) NOT NULL DEFAULT '0',
  `down` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `vk_clanka`, `tekst`, `username`, `datum_unosa`, `up`, `down`) VALUES
(1, 1, 'dsfsd', '', '2016-04-04 14:44:03', 0, 0),
(2, 1, 'wsdsfsfsdf', '', '2016-04-04 14:44:03', 0, 0),
(3, 1, 'dsadsad', '', '2016-04-04 14:44:03', 0, 0),
(4, 1, 'tteksksks', 'proba', '2016-04-04 14:47:10', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(40) NOT NULL,
  `vk_tip` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `username`, `password`, `vk_tip`) VALUES
(1, 'Igor', 'Jugo', 'ijugo', '202cb962ac59075b964b07152d234b70', 3),
(2, 'Igor', 'Jugo', 'ijugo1', '202cb962ac59075b964b07152d234b70', 1),
(3, 'Igor', 'Jugo', 'ijugo2', '202cb962ac59075b964b07152d234b70', 2),
(4, 'Igor', 'Jugo', 'ijugo3', '202cb962ac59075b964b07152d234b70', 3);

-- --------------------------------------------------------

--
-- Table structure for table `prijave`
--

CREATE TABLE IF NOT EXISTS `prijave` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_korisnika` int(10) unsigned NOT NULL,
  `ip_adresa` varchar(15) NOT NULL,
  `ulazak` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `izlazak` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `prijave`
--

INSERT INTO `prijave` (`id`, `id_korisnika`, `ip_adresa`, `ulazak`, `izlazak`) VALUES
(1, 2, '::1', '2016-04-25 08:28:27', NULL),
(2, 3, '::1', '2016-04-25 08:28:35', '2016-04-25 08:28:36'),
(3, 4, '::1', '2016-04-25 08:28:41', '2016-04-25 09:16:34'),
(4, 3, '::1', '2016-04-25 09:17:00', NULL),
(5, 4, '::1', '2016-04-25 09:39:35', NULL),
(6, 4, '::1', '2016-05-02 08:28:17', '2016-05-02 08:43:45'),
(7, 3, '::1', '2016-05-02 08:43:52', '2016-05-02 09:30:02'),
(8, 3, '::1', '2016-05-02 09:30:07', '2016-05-02 09:35:02'),
(9, 2, '::1', '2016-05-02 09:35:08', NULL),
(10, 3, '::1', '2016-05-02 09:40:35', '2016-05-02 09:41:48'),
(11, 2, '::1', '2016-05-02 09:41:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tagovi`
--

CREATE TABLE IF NOT EXISTS `tagovi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) NOT NULL,
  `klikova` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tagovi`
--

INSERT INTO `tagovi` (`id`, `naziv`, `klikova`) VALUES
(1, 'HTML', 0),
(2, 'PHP', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE IF NOT EXISTS `tip_korisnika` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`id`, `naziv`) VALUES
(1, 'Autori'),
(2, 'Urednici'),
(3, 'Administratori');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
