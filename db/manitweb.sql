-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2018 at 09:41 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manitweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(6, 14, 1, 'hi i am fine', 'Amar', '2018-03-29 21:52:27'),
(7, 14, 2, 'where are you', 'Sagar Gupta', '2018-03-29 21:53:17'),
(8, 14, 1, 'i am in hostel and you ?', 'Amar', '2018-03-29 21:54:59'),
(9, 14, 2, 'i am too.', 'Sagar Gupta', '2018-03-29 21:55:41'),
(10, 16, 3, 'jhj', 'Ashutosh', '2018-03-30 14:39:52'),
(11, 13, 1, 'hi', 'Amar', '2018-03-30 14:41:20'),
(12, 13, 1, 'how are you\r\n', 'Amar', '2018-03-30 14:41:28'),
(13, 13, 1, 'hi', 'Amar', '2018-03-30 14:44:01'),
(14, 5, 1, 'Hi Bro', 'Amarjeet kumar', '2018-03-30 17:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `reciever` varchar(255) NOT NULL,
  `msg_subject` text NOT NULL,
  `reply` text NOT NULL,
  `status` text NOT NULL,
  `msg_date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `sender`, `reciever`, `msg_subject`, `reply`, `status`, `msg_date`) VALUES
(1, '1', '2', 'Hi Sagar', 'no_reply', 'read', '2018-03-30 20:42:17'),
(2, '1', '2', 'Kanha Ho Bro Kanha Ho Bro Kanha Ho Bro Kanha Ho Bro Kanha Ho Bro Kanha Ho Bro Kanha Ho Bro Kanha Ho Bro ', 'no_reply', 'read', '2018-03-30 20:40:47'),
(3, '2', '1', 'Hostel mein', 'thik hai', 'read', '2018-03-30 21:27:17'),
(4, '1', '2', 'jabab to de de', 'no_reply', 'read', '2018-03-30 20:44:00'),
(5, '1', '2', 'Hello', 'no_reply', 'read', '2018-03-30 20:53:35'),
(6, '1', '2', 'Bye', 'no_reply', 'read', '2018-03-30 20:54:50'),
(7, '2', '1', 'Ok Good night', 'Ok bro', 'read', '2018-03-30 21:25:00'),
(8, '1', '2', 'exam', 'no_reply', 'read', '2018-03-30 21:05:03'),
(9, '1', '2', 'so ja ', 'no_reply', 'read', '2018-03-30 21:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_content`, `post_date`) VALUES
(3, 1, NULL, 'hi i am amarjeet kumar', '2018-03-29 06:13:49'),
(4, 1, NULL, 'good morning friends', '2018-03-29 06:15:48'),
(5, 1, NULL, 'hi ', '2018-03-29 06:17:49'),
(14, 2, NULL, 'Hi Amarjeet how are you ?', '2018-03-29 21:50:43'),
(16, 3, NULL, 'Hi amarjeet', '2018-03-30 12:55:17'),
(17, 1, NULL, 'Hi Sagar What are u doing', '2018-03-30 17:37:37'),
(11, 1, NULL, 'hi Ashutosh', '2018-03-29 09:57:48'),
(13, 1, NULL, 'Hi Amarjeet', '2018-03-29 15:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `desc_user` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_country` varchar(50) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_img` varchar(50) NOT NULL,
  `user_reg_date` varchar(50) NOT NULL,
  `status` text NOT NULL,
  `verifycode` varchar(11) NOT NULL,
  `posts` text NOT NULL,
  `dob` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `desc_user`, `relation`, `user_pass`, `user_country`, `user_gender`, `user_img`, `user_reg_date`, `status`, `verifycode`, `posts`, `dob`) VALUES
(1, 'Amarjeet kumar', 'amar@gmail.com', 'Cse From MANIT Bhopal', '----', '123456789', 'India', 'Male', 'IMG_20161129_173341.jpg', '2018-03-29 00:08:33', 'verified', '2449', 'yes', '2000-01-15'),
(2, 'Sagar Gupta', 'sagar@gmail.com', 'Welcome to Manit Web', '----', '789456123', 'India', 'Male', 'userdefault_img.png', '2018-03-30 03:19:44', 'verified', '7440', 'yes', '1997-10-15'),
(3, 'Ashutosh', 'ashu@gmail.com', 'I am doing B.Tech from MANIT Bhopal', '----', '789456123', 'India', 'Male', 'amar.jpg', '2018-03-30 12:30:12', 'verified', '6954', 'yes', '1997-12-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
