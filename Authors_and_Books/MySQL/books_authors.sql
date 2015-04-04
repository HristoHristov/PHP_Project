-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `books_authors`
--

-- --------------------------------------------------------

--
-- Структура на таблица `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
`author_id` int(11) NOT NULL,
  `author_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(7, 'Lawrence PremKumar'),
(8, 'Praveen Mohan'),
(12, 'Светлин Наков'),
(13, 'Ben Klemens'),
(14, 'Chris Shiflett'),
(15, 'Terry Pratchett'),
(16, 'Стивън Хартов'),
(17, 'Брантън');

-- --------------------------------------------------------

--
-- Структура на таблица `books`
--

CREATE TABLE IF NOT EXISTS `books` (
`book_id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `file_name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `img`, `file_name`) VALUES
(11, 'JavaFX', 'beginning_javafx_platform.jpg', 'Beginning JavaFX Platform.pdf'),
(12, 'C# Basic', 'Intro-C_-Book-Nakov-front-cover-300x427.jpg', 'CSharp.pdf'),
(13, '21st Century C', '21st_century_c.jpg', '21st Century C.pdf'),
(14, 'Essential PHP Security', 'essentialphpsec.png', 'Essential-PHP-Security.pdf'),
(15, 'The.C.Programming', 'head_first_c.jpg', 'The.C.Programming.Language.2nd.Edition.pdf'),
(16, 'Автентичната котка', 'Teri-Pratchet-Avtentichnata-kotka.jpg', 'Teri-Pratchet-Avtentichnata-kotka.pdf'),
(17, 'Only You Can Save Mankind', 'Teri-Pratchet-Samo-ti-mojesh-da-spasish-chovechestvoto.jpg', 'Teri-Pratchet-Samo-ti-mojesh-da-spasish-chovechestvoto.pdf'),
(18, 'The Nylon Hand of God', 'Stivun-Hartov-Tretata-ruka-na-Boga.jpg', 'Stivun-Hartov-Tretata-ruka-na-Boga.pdf'),
(19, 'The Omega Files', 'Brantun-Failovete-Omega.jpg', 'Brantun-Failovete-Omega.pdf');

-- --------------------------------------------------------

--
-- Структура на таблица `books_authors`
--

CREATE TABLE IF NOT EXISTS `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
(11, 7),
(11, 8),
(12, 12),
(13, 13),
(14, 14),
(15, 8),
(16, 15),
(17, 15),
(18, 16),
(19, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
 ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
 ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `books_authors`
--
ALTER TABLE `books_authors`
 ADD PRIMARY KEY (`book_id`,`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
