-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 21, 2017 at 05:01 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamedb`
--
CREATE DATABASE IF NOT EXISTS `gamedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gamedb`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_with_join`()
BEGIN
SELECT * FROM game JOIN publisher ON game.publisherID = publisher.publisherID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `gameID` int(11) NOT NULL,
  `gameName` varchar(255) NOT NULL,
  `gamePrice` varchar(255) NOT NULL,
  `gameDescription` varchar(255) NOT NULL,
  `gameLink` varchar(255) NOT NULL,
  `gameReleaseDate` date NOT NULL,
  `publisherID` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`gameID`, `gameName`, `gamePrice`, `gameDescription`, `gameLink`, `gameReleaseDate`, `publisherID`) VALUES
(1, 'Assassin''s Creed II', '$9.99', 'A game where you play as an assassin!', 'http://store.steampowered.com/app/33230/', '2010-03-05', 1),
(2, 'Call of Duty', '19.99€', 'A sloppy shooter', 'http://store.steampowered.com/app/2620/', '2003-10-29', 2),
(3, 'Rocket League', '19.99€', 'Imagine playing football in a car with rockets attached to it!', 'http://store.steampowered.com/app/252950/', '2015-07-07', 4),
(4, 'Far Cry 3', '$29.99', 'Assassin''s Creed but with guns', 'http://store.steampowered.com/app/220240/', '2012-11-29', 1),
(5, 'Counter-Strike: Global Offensive', '13.99€', 'A proper shooter', 'http://store.steampowered.com/app/730/', '2012-08-21', 3),
(6, 'Crusader Kings II', '39.99€', 'Grand strategy set during late medieval', 'http://store.steampowered.com/app/203770/', '2012-02-14', 5),
(7, 'Cities Skylines', '$29,99', 'Build your own city', 'http://store.steampowered.com/app/255710/', '2015-03-10', 5),
(8, 'Watch_Dogs', '29.99€', 'Weird spying game with GTA features', 'http://store.steampowered.com/app/243470/', '2014-05-27', 1),
(9, 'Left 4 Dead 2', '19.99€', 'A zombie shooting game', 'http://store.steampowered.com/app/550/', '2009-11-17', 3);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `publisherID` int(11) NOT NULL,
  `publisherName` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisherID`, `publisherName`) VALUES
(1, 'Ubisoft'),
(2, 'Activision'),
(3, 'Valve'),
(4, 'Psyonix'),
(5, 'Paradox Interactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameID`),
  ADD KEY `publisherID` (`publisherID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisherID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `gameID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisherID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`publisherID`) REFERENCES `publisher` (`publisherID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
