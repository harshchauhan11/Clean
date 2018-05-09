-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 08:53 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clean`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `que_id` int(10) NOT NULL,
  `ans` varchar(500) NOT NULL,
  `userid` int(10) NOT NULL,
  `dob` date NOT NULL,
  `time` varchar(30) NOT NULL,
  `no_of_item` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `que_id`, `ans`, `userid`, `dob`, `time`, `no_of_item`) VALUES
(45, 5, '5', 1, '2018-12-01', '5PM TO 7PM', 1),
(46, 6, 'cotton', 1, '2018-12-01', '5PM TO 7PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`) VALUES
(1, 'Aneri', 'am@gmail.com', 'agaagag'),
(2, 'Aneri', 'am@gmail.com', 'agaagag'),
(3, 'Aneri', 'am@gmail.com', 'sggsgs'),
(4, 'aanna', 'jjsjjs@gmail.com', 'ggggggg'),
(5, 'aanna', 'jjsjjs@gmail.com', 'ggggggg');

-- --------------------------------------------------------

--
-- Table structure for table `inner_service`
--

CREATE TABLE IF NOT EXISTS `inner_service` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `i_sname` varchar(50) NOT NULL,
  `path` varchar(150) NOT NULL,
  `outerid` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `info` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_OuterInner` (`outerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=422 ;

--
-- Dumping data for table `inner_service`
--

INSERT INTO `inner_service` (`id`, `i_sname`, `path`, `outerid`, `rate`, `info`) VALUES
(381, 'Home Deep Cleaning', 'service_image/692600 (2).png', 4, 3000, ' Month'),
(384, 'Kitchen Deep Cleaning', 'service_image/icon17.png', 4, 999, 'Day'),
(386, 'Bathroom Deep Cleaning', 'service_image/icon4.png', 4, 699, ' Bathroom'),
(388, 'Sofa Cleaning', 'service_image/icon22.png', 4, 199, ''),
(391, 'AC Service  & Repair', 'service_image/icone5.png', 5, 299, 'AC Service  & Repair'),
(395, 'Refrigerator Repair', 'service_image/icon7.png', 5, 249, 'Refrigerator Repair'),
(397, 'Water Purifier Repair', 'service_image/542536.png', 5, 199, 'Water Purifier Repai'),
(399, 'TV Repair', 'service_image/icon9.png', 5, 249, 'TV Repair'),
(403, 'Washing Machine Repair', 'service_image/150404.png', 5, 249, 'Washing Machine Repa'),
(405, 'Microwave  Repair', 'service_image/icon10png.png', 5, 299, 'Microwave  Repair'),
(409, 'Flour Mill Repair', 'service_image/icon13.png', 5, 199, 'Flour Mill Repair'),
(411, 'Water Heater Repair', 'service_image/icon16.png', 5, 199, 'Water Heater Repair'),
(415, 'Driver', 'service_image/driver.png', 6, 199, 'Day'),
(419, 'Gardener', 'service_image/gardener.png', 6, 199, 'Day'),
(421, 'Security', 'service_image/security.png', 6, 249, 'Month');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `work_time_id` int(11) NOT NULL,
  `inner_service_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `booking_date` timestamp NULL DEFAULT NULL,
  `request_date` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `worker_id`, `work_time_id`, `inner_service_id`, `amount`, `booking_date`, `request_date`, `status`, `start_date`) VALUES
(72, 1, 58, 1, 381, 3000, '2018-03-22 16:06:00', '0000-00-00 00:00:00', NULL, '2018-03-22'),
(73, 1, 58, 1, 381, 3000, '2018-03-22 16:31:49', '0000-00-00 00:00:00', NULL, '2018-03-22'),
(74, 96, 108, 3, 381, 3000, '2018-03-23 12:22:49', '0000-00-00 00:00:00', NULL, '2018-03-23'),
(75, 96, 109, 3, 381, 3000, '2018-03-23 12:24:19', '0000-00-00 00:00:00', 'ACCEPTED', '2018-03-23'),
(76, 96, 110, 3, 381, 3000, '2018-03-30 19:35:40', '2018-03-23 12:27:40', 'REJECTED', '2018-03-31'),
(77, 96, 109, 2, 381, 3000, '2018-03-23 12:30:16', '0000-00-00 00:00:00', 'ACCEPTED', '2018-03-23'),
(78, 96, 110, 4, 381, 3000, '2018-03-31 18:41:32', '2018-03-24 15:41:25', 'REJECTED', '2018-04-01'),
(79, 96, 108, 2, 381, 3000, '2018-03-25 16:27:43', '2018-03-24 22:02:08', 'ACCEPTED', '2018-03-25'),
(80, 96, 108, 5, 381, 3000, '2018-03-25 18:25:52', '2018-03-25 18:18:10', 'ACCEPTED', '2018-03-25'),
(81, 121, 114, 2, 391, 299, '2018-04-24 12:06:55', '2018-04-04 10:03:19', 'ACCEPTED', '2018-04-24'),
(82, 121, 112, 4, 391, 299, '2018-04-07 06:22:04', '2018-04-04 10:07:26', 'ACCEPTED', '2018-04-07'),
(83, 96, 112, 2, 391, 299, '2018-04-07 06:22:48', '2018-04-04 10:10:11', 'ACCEPTED', '2018-04-07'),
(84, 96, 113, 2, 391, 299, '2018-04-04 10:18:41', '2018-04-04 10:15:44', 'REJECTED', '2018-04-04'),
(85, 121, 116, 2, 415, 199, '2018-04-04 10:23:59', '2018-04-04 10:23:22', 'ACCEPTED', '2018-04-04'),
(86, 123, 138, 2, 395, 249, '2018-04-06 09:21:21', '2018-04-06 09:18:28', 'ACCEPTED', '2018-04-06'),
(87, 130, 117, 2, 415, 199, '2018-04-06 09:25:19', '2018-04-06 09:24:09', 'REJECTED', '2018-04-06'),
(88, 125, 122, 2, 386, 699, '2018-04-06 09:30:53', '2018-04-06 09:28:54', 'REJECTED', '2018-04-06'),
(89, 124, 138, 2, 395, 249, '2018-04-06 18:14:24', '2018-04-06 18:12:46', 'REJECTED', '2018-04-06'),
(90, 124, 132, 2, 384, 999, '2018-04-06 18:22:48', '2018-04-06 18:21:56', 'ACCEPTED', '2018-04-06'),
(91, 129, 138, 2, 395, 249, '2018-04-07 05:45:07', '2018-04-07 05:43:47', 'REJECTED', '2018-04-07'),
(92, 129, 138, 4, 395, 249, '2018-04-07 05:48:51', '2018-04-07 05:47:55', 'ACCEPTED', '2018-04-07'),
(93, 127, 138, 5, 395, 249, '2018-04-08 06:42:47', '2018-04-08 06:41:36', 'REJECTED', '2018-04-08'),
(94, 127, 132, 2, 384, 999, '2018-04-08 06:44:10', '2018-04-08 06:43:31', 'ACCEPTED', '2018-04-08'),
(95, 125, 131, 2, 384, 999, '2018-04-08 11:58:03', '2018-04-08 11:57:06', 'REJECTED', '2018-04-08'),
(96, 125, 133, 2, 384, 999, '2018-04-08 12:00:27', '2018-04-08 11:58:36', 'ACCEPTED', '2018-04-08'),
(97, 120, 112, 2, 391, 299, NULL, '2018-04-10 16:10:49', 'PENDING', NULL),
(98, 120, 113, 2, 391, 299, '2018-04-18 18:33:24', '2018-04-10 16:12:30', 'ACCEPTED', '2018-04-19'),
(99, 129, 138, 5, 395, 249, '2018-04-10 16:16:48', '2018-04-10 16:15:23', 'ACCEPTED', '2018-04-10'),
(100, 127, 110, 2, 381, 3000, '2018-04-10 16:27:51', '2018-04-10 16:27:07', 'ACCEPTED', '2018-04-10'),
(101, 124, 131, 2, 384, 999, '2018-04-10 16:31:54', '2018-04-10 16:30:46', 'ACCEPTED', '2018-04-10'),
(102, 96, 110, 2, 381, 3000, '2018-04-10 16:56:45', '2018-04-10 16:55:43', 'ACCEPTED', '2018-04-10'),
(103, 96, 131, 2, 384, 999, NULL, '2018-04-10 16:57:34', 'PENDING', NULL),
(104, 127, 113, 2, 391, 299, '2018-04-20 09:07:18', '2018-04-11 04:21:11', 'ACCEPTED', '2018-04-20'),
(105, 127, 112, 2, 391, 299, '2018-04-11 04:27:33', '2018-04-11 04:22:24', 'ACCEPTED', '2018-04-11'),
(106, 127, 114, 2, 391, 299, '2018-04-11 04:26:34', '2018-04-11 04:25:21', 'ACCEPTED', '2018-04-11'),
(107, 123, 114, 2, 391, 299, '2018-04-24 12:06:51', '2018-04-24 12:05:23', 'ACCEPTED', '2018-04-24'),
(108, 124, 110, 2, 381, 6000, '2018-04-24 14:11:25', '2018-04-24 14:06:06', 'ACCEPTED', '2018-04-24'),
(109, 120, 138, 3, 395, 249, '2018-04-26 02:03:20', '2018-04-26 02:02:12', 'ACCEPTED', '2018-04-27'),
(110, 120, 138, 5, 395, 249, '2018-04-26 02:06:08', '2018-04-26 02:05:53', 'ACCEPTED', '2018-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `outer_service`
--

CREATE TABLE IF NOT EXISTS `outer_service` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `upload` longblob NOT NULL,
  `sname` varchar(40) NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `outer_service`
--

INSERT INTO `outer_service` (`id`, `upload`, `sname`, `path`) VALUES
(4, '', 'Home Cleaning  & Care ', 'service_image/icon1.png'),
(5, '', 'Home  Appliances', 'service_image/icon2.png'),
(6, '', 'Outdoor', 'service_image/icon3.png');

-- --------------------------------------------------------

--
-- Table structure for table `quation`
--

CREATE TABLE IF NOT EXISTS `quation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `innerid` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `quation`
--

INSERT INTO `quation` (`id`, `innerid`, `title`) VALUES
(12, 391, 'Which type of your AC(SPLIT/WINDOW)?'),
(13, 395, 'What type of Refrigerator(No. of door)? '),
(14, 397, 'What issue you are facing?'),
(15, 399, 'Which type of your TV(LED)?'),
(17, 409, 'What issue you are facing?'),
(18, 411, 'What issue you are facing?'),
(19, 403, 'What type of Washing Machine(SEMI/AUTOMATIC)?');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `worker_id` int(8) NOT NULL,
  `rating` float DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_worker_rate` (`user_id`,`worker_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `worker_id`, `rating`, `time`) VALUES
(1, 96, 109, 3, '2018-04-01 02:58:50'),
(3, 96, 108, 3, '2018-04-01 15:46:07'),
(4, 121, 116, 5, '2018-04-04 15:54:37'),
(5, 123, 138, 3, '2018-04-06 14:52:11'),
(6, 96, 112, 3, '2018-04-07 11:51:42'),
(7, 127, 132, 3, '2018-04-08 12:14:23'),
(8, 125, 133, 3, '2018-04-08 17:30:53'),
(9, 124, 132, 1, '2018-04-10 22:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `reqFrom` int(6) NOT NULL,
  `reqTo` int(6) NOT NULL,
  `type` varchar(100) NOT NULL,
  `comment` text,
  `status` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reqFrom` (`reqFrom`),
  KEY `reqTo` (`reqTo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `reqFrom`, `reqTo`, `type`, `comment`, `status`, `date`, `order_id`) VALUES
(1, 110, 96, 'request', 'REJECTED', 'seen', '2018-04-07 06:20:51', 78),
(2, 113, 96, 'request', 'REJECTED', 'not_seen', '2018-04-04 10:18:41', NULL),
(3, 116, 121, 'request', 'ACCEPTED', 'not_seen', '2018-04-04 10:23:59', NULL),
(4, 138, 123, 'request', 'ACCEPTED', 'not_seen', '2018-04-06 09:21:21', NULL),
(5, 117, 130, 'request', 'REJECTED', 'not_seen', '2018-04-06 09:25:20', NULL),
(6, 122, 125, 'request', 'REJECTED', 'not_seen', '2018-04-06 09:30:53', NULL),
(7, 138, 124, 'request', 'REJECTED', 'seen', '2018-04-06 18:15:36', 89),
(8, 132, 124, 'request', 'ACCEPTED', 'seen', '2018-04-06 18:23:37', 90),
(9, 138, 129, 'request', 'REJECTED', 'seen', '2018-04-07 05:45:24', 91),
(10, 138, 129, 'request', 'ACCEPTED', 'seen', '2018-04-07 05:49:00', 92),
(11, 138, 127, 'request', 'REJECTED', 'seen', '2018-04-08 06:42:56', 93),
(12, 132, 127, 'request', 'ACCEPTED', 'seen', '2018-04-08 06:44:21', 94),
(13, 131, 125, 'request', 'REJECTED', 'seen', '2018-04-08 11:58:14', 95),
(14, 133, 125, 'request', 'ACCEPTED', 'seen', '2018-04-08 12:00:51', 96),
(15, 131, 124, 'request', 'ACCEPTED', 'seen', '2018-04-24 14:04:39', 101),
(16, 114, 127, 'request', 'ACCEPTED', 'seen', '2018-04-11 04:26:48', 106),
(17, 112, 127, 'request', 'ACCEPTED', 'seen', '2018-04-11 04:27:45', 105),
(18, 113, 120, 'request', 'ACCEPTED', 'seen', '2018-04-26 02:00:56', 98),
(19, 113, 127, 'request', 'ACCEPTED', 'not_seen', '2018-04-20 09:07:18', 104),
(20, 114, 123, 'request', 'ACCEPTED', 'seen', '2018-04-24 12:11:07', 107),
(21, 114, 121, 'request', 'ACCEPTED', 'not_seen', '2018-04-24 12:06:55', 81),
(22, 110, 124, 'request', 'ACCEPTED', 'not_seen', '2018-04-24 14:11:25', 108),
(23, 138, 120, 'request', 'ACCEPTED', 'not_seen', '2018-04-26 02:03:20', 109),
(24, 138, 120, 'request', 'ACCEPTED', 'not_seen', '2018-04-26 02:06:08', 110);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `role` varchar(20) NOT NULL,
  `service` varchar(100) NOT NULL,
  `time` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `age` int(5) NOT NULL,
  `que` varchar(100) NOT NULL,
  `area` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=140 ;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `role`, `service`, `time`, `email`, `address`, `phone`, `password`, `gender`, `age`, `que`, `area`) VALUES
(4, 'admin', 'admin', '', '00:00:00', 'admin@gmail.com', 'A-3', '2147483647', 'admin', 'male', 0, '', ''),
(96, 'ANNU', 'User', '381', '', 'sbsgssham@gmail.com', 'I-42 ARJUN AVENUE , PAVAPURIROAD , NR NALANDA SCHOOL GHATALODIA, CROOS KAMAL APARMENT', '9090909090', 'a', 'female', 0, '', 'Ranip'),
(108, 'sangita', 'Worker', '381', '', 'sangita@gmail.com', 'a-42 ARJUN AVENUE , PAVAPURIROAD , NR NALANDA SCHOOL GHATALODIA, CROOS KAMAL APARMENT', '9864763476', 'Sa@01', 'female', 40, 'HSC', 'Ghatlodiya'),
(109, 'Palak', 'Worker', '381', '', 'palak@gmail.com', 'I-42 BHARAT AVENUE , PAVAPURIROAD , NR NALANDA SCHOOL RANIP, CROOS GULAB APARMENT', '9876543210', 'Pa@01', 'female', 43, 'SSC', 'Ranip'),
(110, 'Raju', 'Worker', '381', '', 'Raju@gmail.com', 'h-42 suvarna app', '5643278901', 'Raju@12', 'male', 25, '10th pass', 'raniip'),
(111, 'Rima', 'Worker', '381', '', 'Rima@gmail.com', 'h-42 suvarna app', '8906754312', 'Ri@23', 'female', 30, '11th pass', 'new ranip'),
(112, 'Hetu', 'Worker', '391', '', 'hetu@gmail.com', 'm-10 someshvar socity,ahmedabad', '9078564321', 'He@88', 'male', 30, 'SSC', 'k k nager'),
(113, 'Ramesh', 'Worker', '391', '', 'ramesh@gmail.com', 'k-10 someshvarm APP,ahmedabad', '9870652341', 'Ramesh!0', 'male', 33, 'BE', 'prabhatchock'),
(114, 'Harsh', 'Worker', '391', '', 'harsh@gmail.com', '0 - 13 happy home,sastrinager,ahmedabad', '7865094231', 'Hc@123', 'male', 38, 'diploma', 'prabhatchock'),
(115, 'Bhoomil', 'Worker', '391', '', 'bhoomil@gmail.com', 'A-10 Ambikakrupa socity,ahmedabad', '890765432', 'Bh@00', 'male', 33, 'SSC', 'ranip'),
(116, 'Nikhil', 'Worker', '415', '', 'nikhil@gmail.com', 'h-9 suvrna app,ahmedabad', '7788906543', 'nik)', 'male', 34, 'ssc', 'prabhatchock'),
(117, 'Dhruv', 'Worker', '415', '', 'dhruv@gmail.com', 'M-14 purnapursotam app,ahmedabad', '9980765675', 'dhr*2', 'male', 26, '8th pass', 'C G Road'),
(118, 'Mohan', 'Worker', '415', '', 'mohen@gmail.com', 'k-1 manoram app,ahmedabad', '9087564321', 'Mo@3', 'male', 45, '9th pass', 'Akhbarnager'),
(119, 'Urvish', 'Worker', '415', '', 'urvish@gmail.com', 'S-203, kalasager,ahmedabad', '9898767605', 'Ur4%', 'male', 23, '11th pass', 'Naroda'),
(120, 'Harshida', 'User', '381', '', 'harshida@gmail.com', 'Ahmedabad', '9090909090', 'hc', 'female', 0, '', 'Naranpura'),
(122, 'Manali', 'Worker', '386', '', 'Manali@yahoo.com', 'a-1 Someswer Socity,Ahmedabad', '9887765634', 'Manali@34', 'female', 30, 'HSC', 'Akhbarnager'),
(123, 'Mira', 'User', '381', '', 'Mira@gmail.com', 'a-1 Ambika Socity,Ahmedabad', '9898785678', 'Mira@782', '0', 0, '', 'Maninager'),
(124, 'Hina', 'User', '381', '', 'Hina@gmail.com', 'F-1 HappyHome Socity,Ahmedabad', '9090909010', 'Hina@101', '0', 0, '', 'Bopal'),
(125, 'Radha', 'User', '381', '', 'Radha19@gmail.com', 'C-3 Radha Ternament,Ahmedabad', '9091489090', 'Radha@90', '0', 0, '', 'CTM'),
(126, 'Aneri', 'User', '381', '', 'Aneri199@gmail.com', 'a-3 Someswer Ternament,Ahmedabad', '9737709089', 'Aneri@1998', '0', 0, '', 'Ranip'),
(127, 'Ashvin', 'User', '381', '', 'Ashvin23@gmail.com', 'E-13 Suvarna Flat,Ahmedabad ', '9898675645', 'Ashvin@23', '0', 0, '', 'Chandlodiya'),
(128, 'Radhika', 'User', '381', '', 'Radhika@gmail.com', 'E-8 Taranga Hill Socity,Ahmedabad', '9898787865', 'Radhika@65', '0', 0, '', 'Nirnaynager'),
(129, 'Smit', 'User', '381', '', 'Smit@gmail.com', 'A-15 Datatrey Socity,Ahemdabad', '9898764534', 'Smit@121', '0', 0, '', 'PrabhatChock'),
(130, 'Dimpal', 'User', '381', '', 'Dimpal@gmail.com', 'C-10 Radha Ternament,Ahmedabad', '9878675645', 'Dimpal@45', '0', 0, '', 'New Vadaj'),
(131, 'Amrita', 'Worker', '384', '', 'Amrita@gmail.com', 'Q-10 Taranga Socity,Ahmedabad', '9067675465', 'Amrita@23', 'female', 34, 'HSC', 'Ankur'),
(132, 'Roshan', 'Worker', '384', '', 'Roshan@gmail.com', 'I-4 Rajeswari Socity,Ahmedabad', '9997979786', 'Roshan@86', 'female', 45, 'SSC', 'Vadaj'),
(133, 'Honey', 'Worker', '384', '', 'Honey@gmail.com', 'R-1 Suvarn Flat,Ahmedabad', '9898757545', 'Honey@45', 'female', 41, '4th pass', 'Balolnager'),
(134, 'Urvi', 'Worker', '384', '', 'Urvi@gmail.com', 'H-8 MAHALAXMI Tenament,Ahmedabad', '8989786858', 'Urvi@588', 'female', 32, '7th pass', 'Akhbarnager'),
(137, 'Ramesh', 'Worker', '397', '', 'Ramesh11@gmail.com', 'E-33 Suvarna Flat,Ahmedabad ', '9898989867', 'Ramesh@67', 'male', 30, 'HSC', 'Chandlodiya'),
(138, 'Suresh', 'Worker', '395', '', 'Suresh@gmail.com', 'a-1 Amravati Socity,Ahmedabad', '9090907080', 'Suresh@80', 'male', 41, 'SSC', 'Gota'),
(139, 'ashifa', 'Worker', '', '', 'ashifa@gmail.com', 'rajpurohit socity', '9087675645', 'Ashifa@12', 'female', 33, 'ssc', 'ranip');

-- --------------------------------------------------------

--
-- Table structure for table `worker_register`
--

CREATE TABLE IF NOT EXISTS `worker_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(300) NOT NULL,
  `outer_service` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `worker_register`
--

INSERT INTO `worker_register` (`id`, `name`, `email`, `outer_service`, `password`) VALUES
(4, 'a', 'anerishah@gmail.com', 'Home Cleaning  & Care ', 'A'),
(5, 'Aneri', 'anerishah@gmail.com', 'Home Cleaning  & Care ', 'a'),
(6, '', 'anerishah@gmail.com', '', 'ajja'),
(7, '', 'am@gmail.com', '', 'a'),
(8, '', 'am@gmail.com', '', 'amrita'),
(9, '', 'am', '', 'na'),
(10, '', 'am@gmail.com', '', 'amr'),
(11, '', 'am@gmail.com', '', 'amr');

-- --------------------------------------------------------

--
-- Table structure for table `worker_services`
--

CREATE TABLE IF NOT EXISTS `worker_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worker_id` int(11) NOT NULL,
  `inner_service_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_worker_services_signup` (`worker_id`),
  KEY `FK_worker_services_inner_service` (`inner_service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `worker_services`
--

INSERT INTO `worker_services` (`id`, `worker_id`, `inner_service_id`) VALUES
(1, 108, 381),
(2, 109, 381),
(3, 110, 381),
(4, 111, 381),
(5, 112, 391),
(6, 113, 391),
(7, 114, 391),
(8, 115, 391),
(9, 116, 415),
(10, 117, 415),
(11, 118, 415),
(12, 119, 415),
(13, 122, 386),
(14, 131, 384),
(15, 132, 384),
(16, 133, 384),
(17, 134, 384),
(18, 137, 397),
(19, 138, 395),
(32, 139, 384),
(33, 139, 388);

-- --------------------------------------------------------

--
-- Table structure for table `worker_timing`
--

CREATE TABLE IF NOT EXISTS `worker_timing` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `work_time_id` int(10) DEFAULT NULL,
  `worker_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_time_id` (`work_time_id`),
  KEY `worker_id` (`worker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `worker_timing`
--

INSERT INTO `worker_timing` (`id`, `work_time_id`, `worker_id`) VALUES
(5, 2, 108),
(6, 3, 108),
(7, 4, 108),
(8, 5, 108),
(9, 6, 108),
(10, 2, 109),
(11, 3, 109),
(12, 4, 109),
(13, 5, 109),
(14, 6, 109),
(15, 2, 110),
(16, 3, 110),
(17, 4, 110),
(18, 5, 111),
(19, 6, 111),
(20, 2, 112),
(21, 3, 112),
(22, 4, 112),
(23, 5, 112),
(24, 6, 112),
(25, 2, 113),
(26, 3, 113),
(27, 4, 113),
(28, 5, 113),
(29, 6, 113),
(30, 2, 114),
(31, 3, 114),
(32, 5, 115),
(33, 6, 115),
(34, 2, 116),
(35, 3, 116),
(36, 4, 116),
(37, 5, 116),
(38, 6, 116),
(39, 2, 117),
(40, 3, 117),
(41, 4, 117),
(42, 5, 117),
(43, 6, 117),
(44, 2, 118),
(45, 3, 118),
(46, 4, 118),
(47, 5, 119),
(48, 6, 119),
(49, 2, 122),
(50, 3, 122),
(51, 4, 122),
(52, 5, 122),
(53, 2, 131),
(54, 3, 131),
(55, 4, 131),
(56, 5, 131),
(57, 6, 131),
(58, 2, 132),
(59, 3, 132),
(60, 4, 132),
(61, 5, 132),
(62, 6, 132),
(63, 2, 133),
(64, 3, 133),
(65, 4, 133),
(66, 4, 134),
(67, 5, 134),
(68, 6, 134),
(69, 2, 137),
(70, 3, 137),
(71, 4, 137),
(72, 5, 137),
(73, 6, 137),
(74, 2, 138),
(75, 3, 138),
(76, 4, 138),
(77, 5, 138),
(78, 6, 138),
(79, 2, 139),
(80, 3, 139),
(81, 4, 139),
(82, 5, 139),
(83, 6, 139);

-- --------------------------------------------------------

--
-- Table structure for table `work_time`
--

CREATE TABLE IF NOT EXISTS `work_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `work_time`
--

INSERT INTO `work_time` (`id`, `time`) VALUES
(2, '8 AM to 10 AM'),
(3, '10 AM to 12 AM'),
(4, '1 PM to 3 PM'),
(5, '3 PM to 5 PM'),
(6, '5 PM to 7 PM');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inner_service`
--
ALTER TABLE `inner_service`
  ADD CONSTRAINT `FK_OuterInner` FOREIGN KEY (`outerid`) REFERENCES `outer_service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worker_services`
--
ALTER TABLE `worker_services`
  ADD CONSTRAINT `FK_worker_services_inner_service` FOREIGN KEY (`inner_service_id`) REFERENCES `inner_service` (`id`),
  ADD CONSTRAINT `FK_worker_services_signup` FOREIGN KEY (`worker_id`) REFERENCES `signup` (`id`);

--
-- Constraints for table `worker_timing`
--
ALTER TABLE `worker_timing`
  ADD CONSTRAINT `worker_timing_ibfk_1` FOREIGN KEY (`work_time_id`) REFERENCES `work_time` (`id`),
  ADD CONSTRAINT `worker_timing_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `signup` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
