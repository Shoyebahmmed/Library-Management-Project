-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2022 at 10:50 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `Book_No` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` text NOT NULL,
  `Title` text NOT NULL,
  `Author` text NOT NULL,
  `Publisher` text NOT NULL,
  `Status` text NOT NULL,
  `Regular_Cost` text NOT NULL,
  `Extended_Cost` text NOT NULL,
  PRIMARY KEY (`Book_No`)
) ENGINE=MyISAM AUTO_INCREMENT=2013 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_No`, `ISBN`, `Title`, `Author`, `Publisher`, `Status`, `Regular_Cost`, `Extended_Cost`) VALUES
(1993, '111111111111', 'Lawrence in Arabia', 'Scott Anderson\r\n', 'Doubleday', 'Borrowed', '5.6', '3.2'),
(1994, '222222222222', '1493', 'Charles C. Mann', 'Alfred A. Knopf (NY)', 'Extended', '5.4', '2.4'),
(1995, '333333333333', 'Waterloo', 'Bernard Cornwell', 'William Collins', 'Borrowed', '6.7', '2.8'),
(1996, '444444444444', 'A Distant Mirror - The Calamitous 14th Century', 'Barbara W. Tuchman', 'Unknown', 'Available', '3.4', '1.4'),
(1997, '555555555555', 'Argo - How the CIA & Hollywood Pulled Off the Most Audacious Rescue in History', 'Antonio J. Mendez', 'Unknown', 'Available', '3.8', '2.1'),
(1998, '666666666666', 'Nikola Tesla - Imagination and the Man That Invented the 20th Century', 'Sean Patrick', 'Oculus Publishers', 'Available', '7.5', '3.3'),
(1999, '777777777777', 'Mud, Sweat and Tears', 'Bear Grylls', 'Transworld Publishers Ltd', 'Available', '4.14', '1.9'),
(2000, '888888888888', 'The Walking Dead, Compendium 1', 'Robert Kirkman\r\n', 'Image Comics', 'Available', '3.6', '1.7'),
(2001, '999999999999', 'The Joker', 'Brian Azzarello', 'DC Comics', 'Available', '6.7', '3.2'),
(2002, '101010101010', 'All-Star Superman, Vol - 1', 'Frank Quitely', 'DC Comics', 'Available', '5.4', '2.4'),
(2003, '1a1a1a1a1a1a', 'Spider-Man: Miles Morales, Vol. 1', 'Brian Michael Bendis', 'Marvel', 'Available', '7.1', '4.2'),
(2004, '121212121212', 'The Mighty Thor - 2015', 'Jason Aaron', 'Marvel', 'Available', '5.8', '3.4'),
(2005, '131313131313', 'Batman - Time and the Batman', 'Fabian Nicieza', 'DC Comics', 'Available', '4.7', '3.7'),
(2006, '141414141414', 'The Dead Key', 'D.M. Pulley\r\n', 'Unknown', 'Available', '4.3', '2.1'),
(2007, '151515151515', 'The Nature of the Beast - Chief Inspector Armand Gamache : Book 11', 'Louise Penny', 'Minotaur Books', 'Available', '5.2', '2.3'),
(2008, '171717171717', 'Dauntless - The Lost Fleet : Book 1', 'Jack Campbell\r\n', 'Penguin', 'Available', '5.7', '2.6'),
(2009, '181818181818', 'Guardian - The Lost Fleet: Beyond the Frontier : Book 3\r\n', 'Jack Campbell', 'Ace', 'Available', '5.6', '2.1'),
(2010, '212121212121', 'A Map of the World', 'Jane Hamilton', 'Unknown', 'Available', '4.7', '1.5'),
(2011, '2b2b2b2b2b2b', 'Imperfect Birds\r\n', 'Anne Lamott', 'Riverhead Books', 'Available', '4.6', '1.7'),
(2012, 'abcdefghijklmn', 'Harry Potter and the Order of the Phoenix', 'J. K. Rowling ', 'Bloomsbury (UK)', 'Borrowing', '6.7', '3.5');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed`
--

DROP TABLE IF EXISTS `borrowed`;
CREATE TABLE IF NOT EXISTS `borrowed` (
  `Bor_ID` text NOT NULL,
  `ISBN` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrowed`
--

INSERT INTO `borrowed` (`Bor_ID`, `ISBN`) VALUES
('Sh738', '222222222222'),
('Sh738', '333333333333'),
('Sh738', '111111111111');

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

DROP TABLE IF EXISTS `borrower`;
CREATE TABLE IF NOT EXISTS `borrower` (
  `ID` text NOT NULL,
  `Name` text NOT NULL,
  `Surname` text NOT NULL,
  `Phone` text NOT NULL,
  `Email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`ID`, `Name`, `Surname`, `Phone`, `Email`) VALUES
('Sh738', 'Shoyeb Ahmmed', 'Ahmmed', '11 1111 1111', 'ahmmad.ef22@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

DROP TABLE IF EXISTS `librarian`;
CREATE TABLE IF NOT EXISTS `librarian` (
  `ID` text NOT NULL,
  `Name` text NOT NULL,
  `Surname` text NOT NULL,
  `Phone` text NOT NULL,
  `Email` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`ID`, `Name`, `Surname`, `Phone`, `Email`) VALUES
('Jh150', 'Jhon', 'Smith', '22 2222 2222', 'ahmmad.ef22@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `ID` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `Password`) VALUES
('Sh738', 'e11170b8cbd2d74102651cb967fa28e5'),
('Jh150', '9f0863dd5f0256b0f586a7b523f8cfe8');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
