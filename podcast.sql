-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2020 at 11:20 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `podcast`
--
CREATE DATABASE IF NOT EXISTS `podcast` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `podcast`;

-- --------------------------------------------------------

--
-- Table structure for table `rss_streaming`
--
-- Creation: Feb 28, 2020 at 09:42 PM
-- Last update: Feb 28, 2020 at 09:43 PM
--

DROP TABLE IF EXISTS `rss_streaming`;
CREATE TABLE IF NOT EXISTS `rss_streaming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 NOT NULL,
  `stream_url` text CHARACTER SET utf8 NOT NULL,
  `thumbnail` text CHARACTER SET utf8 NOT NULL,
  `fanart` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `category` text CHARACTER SET utf8 NOT NULL,
  `author` text CHARACTER SET utf8 NOT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rss_streaming`
--

INSERT INTO `rss_streaming` (`id`, `title`, `stream_url`, `thumbnail`, `fanart`, `description`, `category`, `author`, `created_date`) VALUES
(1, 'Zeskullz @ Record Club', 'http://92.255.66.40/tmp_audio/itunes2/zeskullz_-_rc_2020-02-20.mp3', 'http://www.radiorecord.ru/upload/iblock/ef7/ef77f1ee17a2b6451226695c2f3de68e.jpg', 'https://png.kodi.al/tv/albdroid/black.png', 'RSS Streaming', 'Radio Record', 'BUBI', '2020-02-20 23:55:32'),
(2, 'Record Club #399 (19-02-2020)', 'http://92.255.66.40/tmp_audio/itunes1/rc_-_rc_2020-02-19.mp3', 'http://www.radiorecord.ru/upload/iblock/49f/49ffce42e43336687a673614d148174f.jpg', 'https://png.kodi.al/tv/albdroid/black.png', 'RSS Streaming', 'Radio Record', 'BUBI', '2020-02-20 23:55:32'),
(3, 'Nejtrino and Baur @ Record Club #153 (19-02-2020)', 'http://92.255.66.40/tmp_audio/itunes1/nejtrino_and_baur_-_rr_2020-02-19.mp3', 'http://www.radiorecord.ru/upload/iblock/ae7/ae77bf40dffccbac36b95cadd8aa531a.jpg', 'https://png.kodi.al/tv/albdroid/black.png', 'RSS Streaming', 'Radio Record', 'BUBI', '2020-02-20 23:55:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
