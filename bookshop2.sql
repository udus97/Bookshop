-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2017 at 12:47 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop2`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorID` bigint(20) UNSIGNED NOT NULL,
  `authorName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorID`, `authorName`) VALUES
(3, 'albert kempster'),
(21, 'allen g taylor'),
(23, 'allen taylor'),
(20, 'bill harlow'),
(11, 'chinua achebe'),
(18, 'christopher gray'),
(9, 'dr. maurice bucaille'),
(16, 'j.k rowling'),
(19, 'james mitchell'),
(1, 'john gadddum'),
(12, 'john m. chambers'),
(17, 'john radebe'),
(15, 'karen armstrong'),
(13, 'mark triola'),
(10, 'mathew hassan kukah'),
(2, 'maurice henry'),
(8, 'mike evans'),
(4, 'o.o ugbebor'),
(7, 'o.s adegboye'),
(14, 'robert kiyosaki'),
(5, 'u.n bassey'),
(22, 'wayne robin'),
(6, 'yusuf al-hajj ahmad');

-- --------------------------------------------------------

--
-- Table structure for table `base_table`
--

CREATE TABLE `base_table` (
  `bookID` bigint(20) UNSIGNED NOT NULL,
  `authorID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `base_table`
--

INSERT INTO `base_table` (`bookID`, `authorID`) VALUES
(1, 1),
(2, 1),
(3, 2),
(3, 3),
(4, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 11),
(11, 11),
(12, 11),
(13, 12),
(13, 13),
(14, 13),
(15, 14),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(19, 20),
(20, 21),
(21, 22),
(22, 23);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookID` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(356) NOT NULL,
  `bookType` varchar(20) DEFAULT ' ',
  `bookShelf` enum('A','B','C','D','E','F','G','H','I','J','L','M','N') DEFAULT NULL,
  `units` tinyint(3) UNSIGNED NOT NULL,
  `publisher` varchar(256) DEFAULT ' ',
  `isbn` char(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookID`, `title`, `bookType`, `bookShelf`, `units`, `publisher`, `isbn`) VALUES
(1, 'gaddum\'s pharmacology', 'paperback', 'H', 5, 'oxford university press', NULL),
(2, 'gaddum\'s pharmacology', 'hardcover', 'B', 2, 'oxford university press', NULL),
(3, 'workshop technology for technicians', 'paperback', 'B', 3, 'hodder and stoughton', NULL),
(4, 'mathematics for users', 'paperback', 'A', 4, 'y-books', NULL),
(5, 'the islamic guideline on medicine', 'hardcover', 'B', 3, 'darrusalam', NULL),
(6, 'descriptive statistics', 'paperback', 'A', 4, 'olad publishers', NULL),
(7, 'the final move beyond iraq: the final solution while the world sleeps', 'paperback', 'I', 1, 'oxford university press', ''),
(8, 'the bible,the qu\'ran and science: the holy scriptures examined in the light of modern knowledge', 'paperback', 'D', 0, 'penguin books', NULL),
(9, 'witness to justice', 'paperback', 'G', 4, 'hodder and stoughton', NULL),
(10, 'things fall apart', 'paperback', 'D', 2, 'heinmann', NULL),
(11, 'no longer at ease', 'hardcover', 'G', 8, 'heinmann', NULL),
(12, 'arrow of god', 'paperback', 'E', 1, 'heinmann', NULL),
(13, 'software for data analysis: programming with r (statistics and computing)', 'hardcover', 'C', 6, 'evans', NULL),
(14, 'elementary statistics (12th edition)', 'hardcover', 'E', 0, '', NULL),
(15, 'rich dad poor dad', ' paperback', 'F', 7, ' oxford', NULL),
(16, 'harry potter and the prisoner of azkaban', ' hardcover', 'D', 12, ' penguin', NULL),
(17, 'the rich too cry', ' paperback', 'F', 5, 'evans', NULL),
(18, 'from shy to social: the shy man\'s guide to personal and dating success', ' hardback', 'D', 2, ' heinmann', NULL),
(19, 'enhanced interrogation: inside the minds and motives of the islamic terrorists trying to destroy america', ' paperback', 'E', 11, ' evans', NULL),
(20, 'sql for dummies', 'hardback', 'F', 5, ' wiley', '9781118627839'),
(21, 'robbing pretoria', ' hardback', 'H', 12, 'heinmann', NULL),
(22, 'sql for dummies 8th edition', 'paperback', 'G', 12, ' john wiley & sons', '9781118607961');

-- --------------------------------------------------------

--
-- Stand-in structure for view `temp`
-- (See below for the actual view)
--
CREATE TABLE `temp` (
`title` varchar(356)
,`bookType` varchar(20)
,`bookShelf` enum('A','B','C','D','E','F','G','H','I','J','L','M','N')
,`units` tinyint(3) unsigned
,`publisher` varchar(256)
,`authorName` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `temp`
--
DROP TABLE IF EXISTS `temp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `temp`  AS  select `book`.`title` AS `title`,`book`.`bookType` AS `bookType`,`book`.`bookShelf` AS `bookShelf`,`book`.`units` AS `units`,`book`.`publisher` AS `publisher`,`author`.`authorName` AS `authorName` from ((`author` join `base_table`) join `book`) where ((`book`.`bookID` = `base_table`.`bookID`) and (`author`.`authorID` = `base_table`.`authorID`)) order by `book`.`title` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorID`),
  ADD UNIQUE KEY `authorID` (`authorID`),
  ADD UNIQUE KEY `authorName` (`authorName`),
  ADD KEY `authorName_2` (`authorName`);

--
-- Indexes for table `base_table`
--
ALTER TABLE `base_table`
  ADD PRIMARY KEY (`bookID`,`authorID`),
  ADD KEY `authorIDfK` (`authorID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD UNIQUE KEY `bookID` (`bookID`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `title` (`title`(35)),
  ADD KEY `publisher` (`publisher`(35)),
  ADD KEY `title_2` (`title`),
  ADD KEY `title_3` (`title`),
  ADD KEY `publisher_2` (`publisher`),
  ADD KEY `bookID_2` (`bookID`),
  ADD KEY `title_4` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `authorID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `base_table`
--
ALTER TABLE `base_table`
  ADD CONSTRAINT `authorIDfK` FOREIGN KEY (`authorID`) REFERENCES `author` (`authorID`),
  ADD CONSTRAINT `bookIDfK` FOREIGN KEY (`bookID`) REFERENCES `book` (`bookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
