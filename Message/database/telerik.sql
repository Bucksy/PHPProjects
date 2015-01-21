-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2015 at 10:24 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `telerik`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(250) NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_name`) VALUES
(1, 'Profile Pictures'),
(2, 'My photos');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(1, 'Пратчет'),
(2, 'Лили');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(250) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`) VALUES
(1, 'Php for begginers'),
(2, 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `books_authors`
--

CREATE TABLE IF NOT EXISTS `books_authors` (
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  KEY `author_id` (`author_id`),
  KEY `book_id` (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books_authors`
--

INSERT INTO `books_authors` (`author_id`, `book_id`) VALUES
(1, 1),
(2, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`title`, `message`, `date`, `author`) VALUES
('Hello', 'hello, nice to meet ya!', '2015-01-21 22:17:18', 'user'),
('Hello from Pesho', 'Nice to meet u too!', '2015-01-21 22:18:11', 'pesho'),
('Hello from Bobby', 'My Name is Bobby!', '2015-01-21 22:19:15', 'bobby');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(250) NOT NULL,
  `album_id` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_name`, `album_id`, `url`) VALUES
(1, 'Photo1', 0, 'banner.jpg'),
(2, 'Photo2', 0, 'g.jpg'),
(3, 'Photo3', 0, '1.jpg'),
(4, 'Photo4', 0, 'footer.jpg'),
(5, 'Photo5', 0, 'coffee.png'),
(6, 'Mi', 0, 'banner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `picture_name` varchar(250) NOT NULL,
  PRIMARY KEY (`picture_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`picture_id`, `user_id`, `picture_name`) VALUES
(1, 1, 'picture1'),
(2, 1, 'picture2'),
(3, 2, 'picture3'),
(4, 3, 'picture33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `user_id`, `password`) VALUES
('user', 1, 'qwerty'),
('pesho', 2, 'qwerty'),
('bobby', 3, 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=502 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `age`, `is_active`) VALUES
(1, 'test1', 'qwerty', 49, 1),
(3, 'test3', 'qwerty', 40, 0),
(4, 'test4', 'qwerty', 17, 0),
(5, 'test5', 'qwerty', 14, 1),
(6, 'test6', 'qwerty', 30, 0),
(7, 'test7', 'qwerty', 40, 0),
(8, 'test8', 'qwerty', 38, 1),
(9, 'test9', 'qwerty', 28, 1),
(11, 'test11', 'qwerty', 49, 0),
(12, 'test12', 'qwerty', 34, 1),
(13, 'test13', 'qwerty', 12, 1),
(14, 'test14', 'qwerty', 32, 0),
(16, 'test16', 'qwerty', 50, 1),
(17, 'test17', 'qwerty', 14, 0),
(18, 'test18', 'qwerty', 45, 1),
(19, 'test19', 'qwerty', 32, 0),
(20, 'test20', 'qwerty', 9, 1),
(21, 'test21', 'qwerty', 17, 1),
(22, 'test22', 'qwerty', 24, 0),
(23, 'test23', 'qwerty', 37, 1),
(24, 'test24', 'qwerty', 20, 0),
(25, 'test25', 'qwerty', 5, 1),
(26, 'test26', 'qwerty', 17, 1),
(28, 'test28', 'qwerty', 5, 0),
(29, 'test29', 'qwerty', 27, 1),
(30, 'test30', 'qwerty', 7, 1),
(32, 'test32', 'qwerty', 12, 0),
(33, 'test33', 'qwerty', 3, 0),
(34, 'test34', 'qwerty', 41, 1),
(35, 'test35', 'qwerty', 47, 1),
(36, 'test36', 'qwerty', 23, 0),
(37, 'test37', 'qwerty', 43, 1),
(38, 'test38', 'qwerty', 42, 0),
(40, 'test40', 'qwerty', 25, 0),
(41, 'test41', 'qwerty', 6, 0),
(43, 'test43', 'qwerty', 17, 1),
(46, 'test46', 'qwerty', 5, 0),
(47, 'test47', 'qwerty', 31, 0),
(49, 'test49', 'qwerty', 15, 0),
(51, 'test51', 'qwerty', 23, 1),
(53, 'test53', 'qwerty', 30, 0),
(54, 'test54', 'qwerty', 21, 1),
(55, 'test55', 'qwerty', 41, 0),
(57, 'test57', 'qwerty', 30, 1),
(59, 'test59', 'qwerty', 4, 0),
(60, 'test60', 'qwerty', 19, 1),
(62, 'test62', 'qwerty', 27, 0),
(63, 'test63', 'qwerty', 25, 0),
(64, 'test64', 'qwerty', 6, 0),
(66, 'test66', 'qwerty', 42, 0),
(67, 'test67', 'qwerty', 23, 1),
(69, 'test69', 'qwerty', 40, 0),
(70, 'test70', 'qwerty', 23, 0),
(71, 'test71', 'qwerty', 46, 1),
(72, 'test72', 'qwerty', 43, 1),
(73, 'test73', 'qwerty', 15, 0),
(74, 'test74', 'qwerty', 17, 1),
(75, 'test75', 'qwerty', 16, 1),
(77, 'test77', 'qwerty', 23, 0),
(78, 'test78', 'qwerty', 9, 1),
(79, 'test79', 'qwerty', 42, 1),
(80, 'test80', 'qwerty', 39, 0),
(81, 'test81', 'qwerty', 48, 0),
(82, 'test82', 'qwerty', 46, 1),
(83, 'test83', 'qwerty', 46, 1),
(84, 'test84', 'qwerty', 21, 1),
(85, 'test85', 'qwerty', 11, 1),
(86, 'test86', 'qwerty', 49, 0),
(87, 'test87', 'qwerty', 12, 1),
(89, 'test89', 'qwerty', 24, 0),
(93, 'test93', 'qwerty', 6, 0),
(94, 'test94', 'qwerty', 15, 1),
(95, 'test95', 'qwerty', 20, 0),
(96, 'test96', 'qwerty', 32, 0),
(97, 'test97', 'qwerty', 5, 1),
(98, 'test98', 'qwerty', 11, 0),
(99, 'test99', 'qwerty', 30, 0),
(100, 'test100', 'qwerty', 5, 0),
(101, 'test101', 'qwerty', 6, 0),
(102, 'test102', 'qwerty', 35, 0),
(104, 'test104', 'qwerty', 30, 1),
(106, 'test106', 'qwerty', 10, 1),
(107, 'test107', 'qwerty', 47, 0),
(108, 'test108', 'qwerty', 29, 1),
(109, 'test109', 'qwerty', 12, 0),
(110, 'test110', 'qwerty', 45, 1),
(111, 'test111', 'qwerty', 22, 1),
(112, 'test112', 'qwerty', 49, 0),
(113, 'test113', 'qwerty', 49, 1),
(115, 'test115', 'qwerty', 38, 1),
(116, 'test116', 'qwerty', 12, 0),
(117, 'test117', 'qwerty', 25, 0),
(118, 'test118', 'qwerty', 45, 1),
(119, 'test119', 'qwerty', 16, 0),
(120, 'test120', 'qwerty', 27, 0),
(121, 'test121', 'qwerty', 49, 1),
(122, 'test122', 'qwerty', 42, 0),
(123, 'test123', 'qwerty', 3, 0),
(124, 'test124', 'qwerty', 16, 0),
(125, 'test125', 'qwerty', 43, 1),
(126, 'test126', 'qwerty', 35, 0),
(127, 'test127', 'qwerty', 47, 1),
(128, 'test128', 'qwerty', 27, 1),
(130, 'test130', 'qwerty', 11, 1),
(131, 'test131', 'qwerty', 6, 0),
(132, 'test132', 'qwerty', 42, 1),
(133, 'test133', 'qwerty', 4, 1),
(134, 'test134', 'qwerty', 16, 1),
(136, 'test136', 'qwerty', 48, 1),
(138, 'test138', 'qwerty', 34, 1),
(139, 'test139', 'qwerty', 46, 0),
(140, 'test140', 'qwerty', 27, 1),
(141, 'test141', 'qwerty', 34, 1),
(142, 'test142', 'qwerty', 49, 0),
(143, 'test143', 'qwerty', 33, 0),
(144, 'test144', 'qwerty', 28, 0),
(145, 'test145', 'qwerty', 19, 0),
(146, 'test146', 'qwerty', 47, 0),
(148, 'test148', 'qwerty', 34, 0),
(149, 'test149', 'qwerty', 6, 1),
(150, 'test150', 'qwerty', 10, 0),
(152, 'test152', 'qwerty', 29, 0),
(153, 'test153', 'qwerty', 42, 0),
(154, 'test154', 'qwerty', 50, 1),
(155, 'test155', 'qwerty', 50, 1),
(157, 'test157', 'qwerty', 48, 0),
(158, 'test158', 'qwerty', 24, 1),
(159, 'test159', 'qwerty', 43, 0),
(161, 'test161', 'qwerty', 8, 1),
(162, 'test162', 'qwerty', 43, 0),
(163, 'test163', 'qwerty', 13, 1),
(164, 'test164', 'qwerty', 49, 1),
(165, 'test165', 'qwerty', 33, 1),
(166, 'test166', 'qwerty', 28, 1),
(167, 'test167', 'qwerty', 9, 0),
(168, 'test168', 'qwerty', 34, 1),
(169, 'test169', 'qwerty', 43, 0),
(170, 'test170', 'qwerty', 26, 1),
(171, 'test171', 'qwerty', 14, 1),
(173, 'test173', 'qwerty', 23, 1),
(174, 'test174', 'qwerty', 22, 1),
(175, 'test175', 'qwerty', 13, 1),
(176, 'test176', 'qwerty', 38, 1),
(177, 'test177', 'qwerty', 21, 1),
(180, 'test180', 'qwerty', 24, 1),
(181, 'test181', 'qwerty', 19, 1),
(182, 'test182', 'qwerty', 7, 0),
(185, 'test185', 'qwerty', 4, 1),
(186, 'test186', 'qwerty', 27, 0),
(188, 'test188', 'qwerty', 13, 1),
(189, 'test189', 'qwerty', 22, 1),
(190, 'test190', 'qwerty', 44, 0),
(191, 'test191', 'qwerty', 7, 1),
(192, 'test192', 'qwerty', 47, 0),
(194, 'test194', 'qwerty', 43, 1),
(196, 'test196', 'qwerty', 23, 1),
(197, 'test197', 'qwerty', 30, 0),
(198, 'test198', 'qwerty', 9, 0),
(202, 'test202', 'qwerty', 50, 0),
(203, 'test203', 'qwerty', 13, 1),
(205, 'test205', 'qwerty', 44, 1),
(206, 'test206', 'qwerty', 26, 0),
(207, 'test207', 'qwerty', 24, 0),
(208, 'test208', 'qwerty', 17, 0),
(210, 'test210', 'qwerty', 47, 0),
(211, 'test211', 'qwerty', 12, 1),
(212, 'test212', 'qwerty', 46, 1),
(214, 'test214', 'qwerty', 34, 0),
(215, 'test215', 'qwerty', 26, 1),
(218, 'test218', 'qwerty', 35, 1),
(219, 'test219', 'qwerty', 49, 1),
(221, 'test221', 'qwerty', 27, 1),
(222, 'test222', 'qwerty', 33, 0),
(224, 'test224', 'qwerty', 10, 0),
(225, 'test225', 'qwerty', 11, 0),
(226, 'test226', 'qwerty', 12, 1),
(228, 'test228', 'qwerty', 30, 1),
(230, 'test230', 'qwerty', 21, 0),
(231, 'test231', 'qwerty', 16, 1),
(232, 'test232', 'qwerty', 39, 1),
(233, 'test233', 'qwerty', 30, 1),
(234, 'test234', 'qwerty', 43, 0),
(235, 'test235', 'qwerty', 44, 1),
(236, 'test236', 'qwerty', 22, 0),
(237, 'test237', 'qwerty', 34, 1),
(239, 'test239', 'qwerty', 4, 0),
(240, 'test240', 'qwerty', 27, 1),
(243, 'test243', 'qwerty', 4, 0),
(244, 'test244', 'qwerty', 37, 1),
(245, 'test245', 'qwerty', 14, 1),
(246, 'test246', 'qwerty', 31, 0),
(247, 'test247', 'qwerty', 29, 0),
(248, 'test248', 'qwerty', 36, 0),
(249, 'test249', 'qwerty', 23, 1),
(250, 'test250', 'qwerty', 11, 0),
(252, 'test252', 'qwerty', 10, 0),
(255, 'test255', 'qwerty', 29, 0),
(256, 'test256', 'qwerty', 4, 0),
(258, 'test258', 'qwerty', 13, 0),
(259, 'test259', 'qwerty', 35, 1),
(260, 'test260', 'qwerty', 4, 0),
(263, 'test263', 'qwerty', 3, 0),
(265, 'test265', 'qwerty', 39, 0),
(266, 'test266', 'qwerty', 4, 1),
(267, 'test267', 'qwerty', 44, 1),
(268, 'test268', 'qwerty', 21, 1),
(270, 'test270', 'qwerty', 4, 1),
(271, 'test271', 'qwerty', 15, 1),
(272, 'test272', 'qwerty', 6, 1),
(273, 'test273', 'qwerty', 25, 1),
(274, 'test274', 'qwerty', 48, 1),
(275, 'test275', 'qwerty', 27, 1),
(280, 'test280', 'qwerty', 39, 0),
(281, 'test281', 'qwerty', 16, 0),
(282, 'test282', 'qwerty', 20, 1),
(283, 'test283', 'qwerty', 47, 1),
(285, 'test285', 'qwerty', 6, 1),
(286, 'test286', 'qwerty', 41, 0),
(287, 'test287', 'qwerty', 24, 1),
(288, 'test288', 'qwerty', 30, 0),
(289, 'test289', 'qwerty', 13, 0),
(290, 'test290', 'qwerty', 44, 1),
(291, 'test291', 'qwerty', 42, 0),
(292, 'test292', 'qwerty', 11, 0),
(293, 'test293', 'qwerty', 22, 1),
(294, 'test294', 'qwerty', 14, 0),
(295, 'test295', 'qwerty', 22, 0),
(296, 'test296', 'qwerty', 44, 1),
(297, 'test297', 'qwerty', 17, 1),
(299, 'test299', 'qwerty', 12, 0),
(301, 'test301', 'qwerty', 44, 0),
(302, 'test302', 'qwerty', 39, 1),
(304, 'test304', 'qwerty', 16, 1),
(305, 'test305', 'qwerty', 26, 0),
(307, 'test307', 'qwerty', 18, 0),
(308, 'test308', 'qwerty', 49, 0),
(309, 'test309', 'qwerty', 9, 1),
(311, 'test311', 'qwerty', 4, 0),
(312, 'test312', 'qwerty', 9, 0),
(313, 'test313', 'qwerty', 41, 0),
(316, 'test316', 'qwerty', 7, 1),
(317, 'test317', 'qwerty', 43, 0),
(320, 'test320', 'qwerty', 25, 1),
(322, 'test322', 'qwerty', 45, 0),
(323, 'test323', 'qwerty', 18, 0),
(324, 'test324', 'qwerty', 48, 0),
(325, 'test325', 'qwerty', 20, 0),
(327, 'test327', 'qwerty', 10, 1),
(329, 'test329', 'qwerty', 26, 1),
(330, 'test330', 'qwerty', 20, 0),
(331, 'test331', 'qwerty', 11, 0),
(332, 'test332', 'qwerty', 49, 1),
(334, 'test334', 'qwerty', 44, 0),
(335, 'test335', 'qwerty', 6, 1),
(338, 'test338', 'qwerty', 49, 1),
(339, 'test339', 'qwerty', 41, 0),
(340, 'test340', 'qwerty', 8, 0),
(342, 'test342', 'qwerty', 20, 1),
(343, 'test343', 'qwerty', 39, 1),
(344, 'test344', 'qwerty', 12, 0),
(345, 'test345', 'qwerty', 35, 0),
(346, 'test346', 'qwerty', 5, 1),
(347, 'test347', 'qwerty', 46, 1),
(349, 'test349', 'qwerty', 48, 1),
(350, 'test350', 'qwerty', 50, 0),
(351, 'test351', 'qwerty', 47, 0),
(353, 'test353', 'qwerty', 16, 1),
(354, 'test354', 'qwerty', 14, 0),
(355, 'test355', 'qwerty', 25, 1),
(357, 'test357', 'qwerty', 49, 0),
(358, 'test358', 'qwerty', 7, 1),
(359, 'test359', 'qwerty', 29, 1),
(360, 'test360', 'qwerty', 48, 1),
(361, 'test361', 'qwerty', 4, 0),
(362, 'test362', 'qwerty', 13, 0),
(363, 'test363', 'qwerty', 42, 1),
(364, 'test364', 'qwerty', 16, 0),
(366, 'test366', 'qwerty', 17, 0),
(367, 'test367', 'qwerty', 48, 1),
(368, 'test368', 'qwerty', 5, 1),
(371, 'test371', 'qwerty', 33, 0),
(373, 'test373', 'qwerty', 4, 1),
(374, 'test374', 'qwerty', 17, 1),
(375, 'test375', 'qwerty', 42, 0),
(376, 'test376', 'qwerty', 46, 1),
(378, 'test378', 'qwerty', 44, 0),
(380, 'test380', 'qwerty', 3, 0),
(381, 'test381', 'qwerty', 22, 0),
(382, 'test382', 'qwerty', 7, 1),
(383, 'test383', 'qwerty', 11, 1),
(384, 'test384', 'qwerty', 45, 0),
(386, 'test386', 'qwerty', 14, 0),
(388, 'test388', 'qwerty', 30, 1),
(389, 'test389', 'qwerty', 46, 1),
(390, 'test390', 'qwerty', 50, 0),
(391, 'test391', 'qwerty', 16, 0),
(392, 'test392', 'qwerty', 3, 0),
(393, 'test393', 'qwerty', 13, 0),
(394, 'test394', 'qwerty', 37, 1),
(395, 'test395', 'qwerty', 41, 1),
(396, 'test396', 'qwerty', 14, 1),
(397, 'test397', 'qwerty', 13, 1),
(398, 'test398', 'qwerty', 21, 1),
(400, 'test400', 'qwerty', 46, 1),
(401, 'test401', 'qwerty', 30, 0),
(402, 'test402', 'qwerty', 50, 0),
(404, 'test404', 'qwerty', 21, 0),
(405, 'test405', 'qwerty', 49, 1),
(406, 'test406', 'qwerty', 45, 1),
(407, 'test407', 'qwerty', 14, 1),
(408, 'test408', 'qwerty', 48, 1),
(411, 'test411', 'qwerty', 45, 0),
(412, 'test412', 'qwerty', 49, 0),
(413, 'test413', 'qwerty', 27, 0),
(415, 'test415', 'qwerty', 6, 0),
(416, 'test416', 'qwerty', 8, 0),
(417, 'test417', 'qwerty', 19, 0),
(418, 'test418', 'qwerty', 46, 0),
(419, 'test419', 'qwerty', 8, 0),
(420, 'test420', 'qwerty', 36, 0),
(421, 'test421', 'qwerty', 12, 1),
(423, 'test423', 'qwerty', 36, 0),
(426, 'test426', 'qwerty', 29, 1),
(427, 'test427', 'qwerty', 9, 0),
(428, 'test428', 'qwerty', 44, 0),
(431, 'test431', 'qwerty', 39, 1),
(433, 'test433', 'qwerty', 31, 0),
(434, 'test434', 'qwerty', 3, 0),
(435, 'test435', 'qwerty', 47, 1),
(436, 'test436', 'qwerty', 11, 1),
(438, 'test438', 'qwerty', 41, 1),
(439, 'test439', 'qwerty', 18, 0),
(440, 'test440', 'qwerty', 19, 0),
(441, 'test441', 'qwerty', 15, 0),
(442, 'test442', 'qwerty', 29, 0),
(446, 'test446', 'qwerty', 15, 1),
(447, 'test447', 'qwerty', 33, 1),
(448, 'test448', 'qwerty', 3, 0),
(449, 'test449', 'qwerty', 4, 0),
(450, 'test450', 'qwerty', 46, 1),
(451, 'test451', 'qwerty', 47, 0),
(452, 'test452', 'qwerty', 11, 1),
(453, 'test453', 'qwerty', 9, 0),
(454, 'test454', 'qwerty', 43, 1),
(455, 'test455', 'qwerty', 23, 1),
(456, 'test456', 'qwerty', 8, 0),
(459, 'test459', 'qwerty', 9, 0),
(460, 'test460', 'qwerty', 43, 1),
(461, 'test461', 'qwerty', 23, 0),
(464, 'test464', 'qwerty', 35, 1),
(466, 'test466', 'qwerty', 50, 0),
(467, 'test467', 'qwerty', 7, 0),
(468, 'test468', 'qwerty', 33, 1),
(469, 'test469', 'qwerty', 43, 0),
(470, 'test470', 'qwerty', 6, 0),
(472, 'test472', 'qwerty', 21, 0),
(473, 'test473', 'qwerty', 8, 0),
(474, 'test474', 'qwerty', 38, 1),
(475, 'test475', 'qwerty', 44, 0),
(476, 'test476', 'qwerty', 46, 1),
(477, 'test477', 'qwerty', 6, 0),
(478, 'test478', 'qwerty', 4, 0),
(479, 'test479', 'qwerty', 29, 1),
(480, 'test480', 'qwerty', 29, 0),
(481, 'test481', 'qwerty', 22, 0),
(482, 'test482', 'qwerty', 15, 1),
(484, 'test484', 'qwerty', 17, 1),
(485, 'test485', 'qwerty', 38, 0),
(487, 'test487', 'qwerty', 42, 1),
(489, 'test489', 'qwerty', 41, 0),
(490, 'test490', 'qwerty', 46, 0),
(491, 'test491', 'qwerty', 39, 0),
(492, 'test492', 'qwerty', 10, 0),
(493, 'test493', 'qwerty', 13, 0),
(494, 'test494', 'qwerty', 34, 0),
(495, 'test495', 'qwerty', 30, 0),
(496, 'test496', 'qwerty', 46, 0),
(497, 'test497', 'qwerty', 3, 1),
(498, 'test498', 'qwerty', 4, 0),
(500, 'test500', 'qwerty', 24, 0),
(501, 'test', '', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
