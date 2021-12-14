-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 01:48 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `firstname`, `lastname`, `email`, `username`, `hashed_password`) VALUES
<<<<<<< HEAD
=======

(13, 'Daniel', 'Sun', 'jennyxixi11@gmail.com', 'danielsun', '$2y$10$clwsUGZV7FbEav6nLWRURuVwE8oalxU.mjcsZK18mdbac8PjbXZIG');

-- --------------------------------------------------------

--
-- Table structure for table `tblbook`
--

CREATE TABLE `tblbook` (
  `book_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `ISBN` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publication_year` int(10) NOT NULL,
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbook`
--

INSERT INTO `tblbook` (`book_id`, `title`, `ISBN`, `author`, `publication_year`, `category_id`) VALUES
(1, 'Power Play', '9780753554388', 'Tim Higgins', 2021, 3),
(2, 'Start With Why', '9786055409371', 'Simon Sinek', 2009, 3),
(3, 'The Great Gatsby', '9780743273565', 'F. Scott Fitzgerald', 2004, 5),
(4, 'Australia\'s Toughest Sports People', '9781922419538', 'Mick Colliss', 2021, 8),
(5, 'Introduction to Algorithms', '9780262033848', 'Thomas H. Cormen, Charles E. Leiserson', 2009, 2),
(7, 'Music as An Art', '9781472955715', 'Roger Scruton', 2018, 1),
(8, 'The Snowy', '9781742236223', 'Siobhan McHugh', 2019, 4),
(9, 'The Philosophy of Education', '9781847060198', 'Richard Bailey', 2010, 7),
(19, 'PHP basic11', '3453453456', 'asadssd', 2020, 2),
(25, '&lt;script&gt;alert(&quot;hello&quot;)&lt;/script&gt;', '3453453456', 'asads', 1234, 1),
(29, 'PHP new', '3453453456', 'sfsfsfs', 1998, 1),
(31, 'newchange', '3453453456', 'knownnn', 2020, 2),
(33, 'mybook new', '111112133', 'Tim Ben', 2007, 4),
(39, '&lt;script&gt;alert(&quot;moremore&quot;)&lt;/script&gt;', '345345345600', 'asa', 2011, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`category_id`, `category_name`) VALUES
(1, 'Art and Music'),
(2, 'Computer Science'),
(3, 'Business and Finance'),
(4, 'History'),
(5, 'Literature'),
(6, 'Building and Construction'),
(7, 'Education'),
(8, 'Sports');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbook`
--
ALTER TABLE `tblbook`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblbook`
--
ALTER TABLE `tblbook`
  MODIFY `book_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbook`
--
ALTER TABLE `tblbook`
  ADD CONSTRAINT `tblbook_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tblcategory` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
