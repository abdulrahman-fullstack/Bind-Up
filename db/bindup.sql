-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2018 at 08:56 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bindup`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('a2b278a09185c78ce08ccd69d602329b1c7a05de', 'a2b278a09185c78ce08ccd69d602329b1c7a05de');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `user1` int(10) UNSIGNED NOT NULL,
  `user2` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `user1`, `user2`) VALUES
(1, 14, 16),
(2, 15, 14),
(3, 14, 25),
(4, 14, 17),
(5, 14, 19),
(6, 14, 29),
(7, 14, 21),
(8, 14, 20),
(9, 25, 20),
(10, 25, 27),
(11, 25, 29),
(12, 25, 26),
(14, 25, 31),
(15, 14, 18);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `follower_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`) VALUES
(21, 16, 17),
(22, 18, 17),
(23, 14, 17),
(24, 15, 17),
(26, 19, 17),
(36, 17, 16),
(37, 18, 16),
(38, 19, 16),
(39, 14, 15),
(40, 16, 15),
(41, 17, 15),
(42, 18, 15),
(43, 19, 15),
(44, 14, 18),
(45, 15, 18),
(46, 16, 18),
(47, 17, 18),
(48, 19, 18),
(49, 14, 19),
(50, 15, 19),
(51, 16, 19),
(52, 17, 19),
(53, 18, 19),
(54, 20, 15),
(56, 14, 21),
(83, 16, 26),
(87, 22, 26),
(88, 25, 26),
(90, 21, 26),
(92, 20, 26),
(93, 19, 26),
(94, 24, 26),
(95, 23, 26),
(96, 18, 26),
(97, 15, 26),
(98, 14, 26),
(99, 17, 26),
(117, 24, 14),
(118, 25, 14),
(127, 31, 14),
(130, 17, 14),
(135, 16, 14),
(136, 20, 14),
(137, 26, 16),
(140, 31, 16),
(143, 28, 16),
(144, 27, 16),
(146, 21, 16),
(147, 30, 14),
(149, 28, 14),
(151, 22, 14),
(152, 18, 14),
(154, 16, 29),
(156, 20, 16),
(157, 15, 20),
(158, 14, 20),
(159, 26, 20),
(160, 16, 20),
(161, 31, 20),
(162, 29, 20),
(163, 27, 20),
(164, 18, 20),
(165, 17, 20),
(166, 22, 20),
(167, 28, 20),
(168, 30, 20),
(169, 24, 20),
(170, 19, 20),
(171, 23, 20),
(172, 25, 20),
(173, 21, 20),
(174, 15, 16),
(176, 15, 29),
(178, 20, 29),
(179, 17, 29),
(180, 14, 29),
(181, 14, 16),
(182, 26, 25),
(183, 14, 25),
(184, 20, 25),
(185, 31, 25),
(186, 29, 25),
(187, 27, 25);

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(1, '464adb19111a090c9bd5158b21cee725a216cf65', 14);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `sender` int(10) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `sender`, `receiver`, `read`) VALUES
(1, 'hi hannan', 14, 15, 0),
(2, 'its abdul rahman', 14, 15, 0),
(3, 'just checking ', 14, 15, 0),
(4, 'hey there', 14, 16, 0),
(5, 'its my first message', 14, 15, 0),
(6, 'its my first message', 14, 17, 0),
(7, 'assalamu alaikum', 14, 16, 0),
(8, 'second message', 14, 17, 0),
(9, 'second message', 14, 16, 0),
(10, 'yo man', 14, 25, 0),
(11, 'hello', 14, 17, 0),
(12, 'choco man', 14, 25, 0),
(13, 'choco man', 14, 19, 0),
(14, 'hey there', 14, 29, 0),
(15, 'you are crazy', 14, 19, 0),
(16, 'you are crazy', 14, 21, 0),
(17, 'nizam', 14, 21, 0),
(18, 'nizam', 14, 20, 0),
(19, 'va rahmathullahi va barakathuhu', 14, 16, 0),
(20, 'jkbnilllllllllllllllllllllllllllsajdbckbckijbkijbscpikabjsp;bivbjcsipkjbipaksjbvcpiksjbvcpiakbjspicvkbsvcpikabsvckabspivkbaipkbuvpiubsvpibvpibjuvpijbqaedbapibkjasbkjvbsakjbkasjbkjasbvkjbaskjfbwhf-9h[olksanfouhasunshellooyjergibnaia,agoimg to onmssllnojnAS', 14, 25, 0),
(21, 'nmfosnonwas\nopfhpaowsfnj\nwoosifpwjn', 14, 25, 0),
(22, 'hello', 25, 14, 0),
(23, 'hello', 25, 20, 0),
(24, 'hello', 25, 20, 0),
(25, 'hello', 25, 27, 0),
(26, 'hi there', 25, 14, 0),
(27, 'hi there', 25, 14, 0),
(28, 'hi there', 25, 29, 0),
(29, 'hi there', 25, 20, 0),
(30, 'hi there', 25, 20, 0),
(31, 'first message', 25, 26, 0),
(33, 'hi jarj', 25, 20, 0),
(34, 'hi jarj', 25, 31, 0),
(35, 'hin thjerefe\niam suing \nchats', 25, 14, 0),
(36, 'Are u there', 14, 16, 0),
(37, 'yes', 16, 14, 0),
(38, 'va alaikum salam ', 16, 14, 0),
(39, 'do we have college today.......?', 16, 14, 0),
(40, 'yes ofcourse ', 14, 16, 0),
(41, 'are you going to somewhere else', 14, 16, 0),
(42, 'no i just asked', 16, 14, 0),
(43, 'did you finished your as.net assignment', 16, 14, 0),
(44, 'not yet', 14, 16, 0),
(45, 'but will finish today', 14, 16, 0),
(46, 'hi there', 14, 15, 0),
(47, 'hi there', 14, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `receiver`, `sender`) VALUES
(11, 1, 16, 29),
(12, 1, 16, 14),
(13, 1, 16, 14),
(14, 1, 16, 14),
(15, 1, 16, 14),
(16, 1, 16, 14),
(17, 1, 16, 14),
(18, 1, 16, 14),
(19, 1, 16, 14),
(20, 1, 16, 14),
(21, 1, 16, 14),
(23, 2, 20, 16),
(24, 2, 15, 20),
(25, 2, 14, 20),
(26, 2, 26, 20),
(27, 2, 16, 20),
(28, 2, 31, 20),
(29, 2, 29, 20),
(30, 2, 27, 20),
(31, 2, 18, 20),
(32, 2, 17, 20),
(33, 2, 22, 20),
(34, 2, 28, 20),
(35, 2, 30, 20),
(36, 2, 24, 20),
(37, 2, 19, 20),
(38, 2, 23, 20),
(39, 2, 25, 20),
(40, 2, 21, 20),
(41, 1, 16, 20),
(42, 1, 16, 20),
(43, 1, 15, 20),
(44, 1, 21, 20),
(45, 1, 15, 20),
(46, 1, 15, 20),
(47, 1, 15, 20),
(48, 2, 15, 16),
(49, 1, 15, 16),
(50, 1, 20, 16),
(51, 1, 16, 20),
(52, 1, 16, 20),
(53, 1, 16, 29),
(54, 1, 16, 29),
(55, 1, 14, 29),
(56, 1, 14, 29),
(57, 1, 14, 29),
(58, 1, 14, 29),
(59, 1, 14, 29),
(60, 2, 17, 29),
(61, 2, 15, 29),
(62, 1, 15, 29),
(63, 1, 15, 29),
(64, 1, 17, 29),
(65, 2, 20, 29),
(66, 2, 20, 29),
(67, 2, 17, 29),
(68, 2, 14, 29),
(69, 1, 16, 14),
(70, 2, 14, 16),
(71, 2, 26, 25),
(72, 2, 14, 25),
(73, 2, 20, 25),
(74, 2, 31, 25),
(75, 2, 29, 25),
(76, 2, 27, 25);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_body` varchar(5000) NOT NULL,
  `posted_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_body`, `posted_at`, `user_id`, `likes`) VALUES
(1, 'hey there', '2018-02-20 14:19:07', 14, 3),
(2, 'hey there its binup', '2018-02-20 14:22:20', 14, 4),
(4, 'hey there', '2018-02-20 16:49:48', 14, 3),
(11, 'test', '2018-02-27 19:15:12', 14, 4),
(12, 'Testing 2', '2018-02-27 21:03:11', 14, 6),
(13, 'Testing 03', '2018-02-27 21:05:05', 14, 4),
(14, 'Hey iam Abdur Rahman iam going to \r\nparticipate in my college''s simposium\r\n\r\n#newcollege #simposium #events\r\n\r\n@newians, @bunkers\r\n\r\n\r\nthank you  \r\n', '2018-02-28 09:19:34', 14, 5),
(15, '<h1>Hello World </h1>\nhey <br>\nthere <br>\n', '2018-02-28 09:29:16', 14, 5),
(16, '<h1>I am going to script up and hack your site</h1>\n<br><br><br><br><br><br><br><br>\nhey iam just kidding....  ;-)\n', '2018-02-28 09:30:39', 14, 7),
(17, 'Started sharing my status with bindup and going to rock with _________  ?', '2018-02-28 15:03:07', 19, 5),
(18, '<h1>Javid''s Post</h1>\n<br><br><br><br><br><br>\nhey there\n', '2018-02-28 15:37:32', 17, 6),
(19, '<h1>Hey there</h1>\n<br><br><br><br><br><br>\n<b>he he he he he </b>\n', '2018-03-04 11:35:25', 19, 4),
(20, 'manndy session has cancelled today', '2018-03-04 11:44:35', 15, 8),
(21, '#grill_chicken,#yummy,#restaurant\n<br><br>\nTasty grill chicken today at dubai_kitchen\n', '2018-03-04 11:46:20', 15, 8),
(22, 'hey there its my first post', '2018-03-07 11:13:31', 20, 2),
(23, 'i gonna post without any\n\nxss [ cross site sripting ]\n', '2018-03-08 11:05:23', 15, 3),
(24, 'test', '2018-03-11 11:37:16', 15, 4),
(25, 'Hey iam just going to share my first post\n', '2018-03-13 17:48:30', 21, 3),
(26, 'College project submision \n\n\nso afraid of review\n', '2018-03-16 19:39:15', 20, 2),
(27, 'HEY this is Atheeq\n\n\nBurger Off\n', '2018-03-17 17:52:05', 16, 4),
(28, 'Shawarma , grill chicken yummy\n\nhot touch with atti\n', '2018-03-17 17:52:51', 16, 2),
(29, 'Peace be upon you all', '2018-03-17 17:53:25', 16, 4),
(30, 'saturday holiday\n\njolly outing with friends\n\non mannady\n', '2018-03-17 17:54:02', 16, 4),
(31, 'Hey its Bilal Ahmed\n\njust to post it\n', '2018-03-18 16:50:03', 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `liker_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `liker_id`) VALUES
(33, 1, 15),
(34, 2, 15),
(35, 4, 15),
(36, 10, 15),
(37, 11, 15),
(38, 12, 15),
(39, 13, 15),
(40, 14, 15),
(46, 15, 15),
(50, 18, 15),
(51, 17, 15),
(52, 16, 15),
(57, 19, 15),
(61, 17, 14),
(62, 18, 14),
(63, 6, 14),
(64, 21, 16),
(71, 18, 16),
(72, 19, 16),
(73, 21, 17),
(74, 19, 17),
(75, 16, 17),
(76, 17, 17),
(77, 2, 17),
(79, 20, 17),
(81, 20, 18),
(82, 19, 18),
(83, 18, 18),
(84, 16, 18),
(85, 17, 18),
(86, 21, 18),
(87, 12, 18),
(100, 20, 19),
(101, 15, 19),
(102, 21, 19),
(103, 18, 19),
(104, 16, 19),
(105, 14, 19),
(106, 13, 19),
(107, 12, 19),
(108, 11, 19),
(109, 10, 19),
(110, 4, 19),
(111, 2, 19),
(112, 1, 19),
(114, 20, 15),
(116, 21, 15),
(117, 22, 15),
(118, 16, 14),
(119, 15, 14),
(120, 14, 14),
(121, 13, 14),
(122, 12, 14),
(123, 11, 14),
(124, 10, 14),
(125, 4, 14),
(130, 23, 14),
(132, 16, 21),
(133, 15, 21),
(134, 14, 21),
(135, 12, 21),
(136, 25, 21),
(137, 25, 14),
(138, 24, 26),
(139, 23, 26),
(140, 20, 26),
(141, 14, 26),
(142, 12, 26),
(143, 17, 26),
(148, 2, 14),
(155, 22, 14),
(157, 21, 14),
(159, 20, 14),
(161, 26, 14),
(162, 27, 16),
(163, 28, 16),
(164, 29, 16),
(165, 30, 16),
(176, 25, 16),
(177, 24, 16),
(179, 23, 16),
(185, 1, 14),
(186, 24, 14),
(189, 30, 29),
(190, 30, 14),
(191, 29, 14),
(193, 27, 14),
(194, 30, 20),
(195, 29, 20),
(196, 24, 20),
(197, 25, 20),
(198, 23, 20),
(199, 21, 20),
(200, 20, 20),
(201, 20, 16),
(202, 26, 16),
(203, 28, 20),
(204, 27, 20),
(205, 29, 29),
(206, 27, 29),
(207, 15, 29),
(209, 16, 29),
(210, 13, 29),
(211, 11, 29),
(212, 24, 29),
(213, 21, 29),
(214, 18, 29),
(215, 31, 29);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `ph_num` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(64) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `dob`, `gender`, `ph_num`, `email`, `password`, `img`, `created_at`) VALUES
(14, 'Abdul', 'Rahman', '1998-04-21', 'Male', 2147483647, 'mail@mm', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'IMG-20170323-WA0001.jpg', '2018-03-23 21:32:12'),
(15, 'Mohammed ', 'Hannan', '1970-01-01', 'Male', 89879643, 'aa@ss.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'IMG-20170412-WA0008.jpg', '2018-03-23 21:32:12'),
(16, 'Mohammed ', 'Atheeq', '1997-07-01', 'Male', 9876567, 'atheeq@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default_user.png', '2018-03-23 21:32:12'),
(17, 'Javeed', 'Ahamed', '1995-11-27', 'Male', 5363872, 'javeed@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(18, 'Fazlur', 'Rahman', '1989-12-09', 'Male', 7865599, 'faz@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(19, 'Rahman', 'Lathif', '1990-06-25', 'Male', 85859656, 'lathif@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(20, 'Nizzy', 'Nizam', '1997-01-06', 'Male', 65544376, 'nizam@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(21, 'Mohammed ', 'Faizal', '1989-01-01', 'Male', 9877665, 'faizal@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(22, 'Abdul', 'Rahim', '2000-07-01', 'Male', 65768798, 'rahim@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(23, 'Gulam', 'Gulam', '1989-08-18', 'Male', 76655889, 'gulam@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(24, 'Mohammed ', 'Ibrahim', '1998-04-09', 'Male', 7654432, 'ibrahim@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(25, 'Imbran', 'Basha', '1998-04-10', 'Male', 98765443, 'imbran@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(26, 'Imbran', 'Khan', '2003-12-10', 'Male', 98889899, 'imbrankhan@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(27, 'Abu', 'Bakker', '1998-04-09', 'Male', 878987664, 'abu@new.cokm', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(28, 'Abdul', 'Wahab', '1999-09-05', 'Male', 67987678, 'wahab@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(29, 'Bilal', 'Ahamed', '1998-04-21', 'Male', 989878, 'bilal@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(30, 'Mohammed ', 'Arshad', '1998-04-09', 'Male', 89098989, 'arshad@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(31, 'Mohammed ', 'Jarjis', '1998-04-09', 'Male', 89989888, 'jarjis@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(32, 'Zubair', 'Ahamed', '1997-06-12', 'Male', 98876565, 'zubair@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:32:12'),
(33, 'Aleem', 'Khan', '1987-09-01', 'Male', 98765431, 'aleem@new.com', 'a2b278a09185c78ce08ccd69d602329b1c7a05de', 'default.png', '2018-03-23 21:37:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;
--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
