-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2020 at 01:23 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aucanteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aID` int(11) NOT NULL,
  `aPassword` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aID`, `aPassword`) VALUES
(1000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `foodstall`
--

CREATE TABLE `foodstall` (
  `stallName` char(20) NOT NULL,
  `stallStatus` char(6) DEFAULT NULL,
  `soID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodstall`
--

INSERT INTO `foodstall` (`stallName`, `stallStatus`, `soID`) VALUES
('stall1', 'closed', 1),
('stall2', 'open', 2),
('stall3', 'open', 3),
('stall4', 'open', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `foodID` int(11) NOT NULL,
  `foodName` tinytext,
  `price` float DEFAULT NULL,
  `stallName` char(20) NOT NULL,
  `statuses` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`foodID`, `foodName`, `price`, `stallName`, `statuses`) VALUES
(1, 'Rice with crispy pork and basil', 60, 'stall2', 'preparing'),
(2, 'Rice with garlic shrimp', 80, 'stall2', 'finished'),
(3, 'Fried rice with chicken', 55, 'stall2', 'picked up'),
(4, 'Khao Man Kai', 45, 'stall3', 'preparing'),
(5, 'Rice with chicken curry', 65, 'stall4', 'finished'),
(6, 'Chicken wings', 60, 'stall1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `ID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `foodID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`ID`, `orderID`, `quantity`, `foodID`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `dates` date DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `timed` time DEFAULT NULL,
  `uID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `dates`, `totalPrice`, `timed`, `uID`) VALUES
(1, '2019-04-12', 60, '12:00:09', 1234),
(2, '2019-12-12', 55, '01:15:00', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `shopowner`
--

CREATE TABLE `shopowner` (
  `soID` int(11) NOT NULL,
  `soPassword` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopowner`
--

INSERT INTO `shopowner` (`soID`, `soPassword`) VALUES
(1, '$2y$10$Lr3lx9aEeSV.PyLreEc30O74VMSDNLuf76Q6FvCLzo6j.VxUqmWS2'),
(2, '$2y$10$mm302mmF3Mv8YgyVZL1smuvZyg2VdmrmYC718vQL4VdTSPzODLRKC'),
(3, '$2y$10$BEbywZDdivwP52mtoZp90.6C0ZHovFX3KDY6hM1g9tgWSrOY76wmu'),
(4, '$2y$10$UUuykKhoZa2h1myTuV8z7.gkKOPFwDeqmd/o8DW4CshG.jj2ou8j2'),
(6, '$2y$10$8ZdMm2yLSLmKnVdHRRP7duGrkqY7jz3PEeDVbaONk7cPrTnc.S7FC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uID` int(11) NOT NULL,
  `uPassword` longtext,
  `balance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `uPassword`, `balance`) VALUES
(1234, '$2y$10$MQXDZUnkfvt1PZHo4RiJquARZNQizbJmnAknlIbcylGOSZwAarSQa', 100),
(6017564, '$2y$10$/VRHOitM5hl8vttiV18GouJH5HqIRDD0emnAcEJSaLgNDijHq/sP.', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aID`);

--
-- Indexes for table `foodstall`
--
ALTER TABLE `foodstall`
  ADD PRIMARY KEY (`stallName`),
  ADD UNIQUE KEY `soID` (`soID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`foodID`),
  ADD KEY `stallName` (`stallName`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`ID`,`orderID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `foodID` (`foodID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `shopowner`
--
ALTER TABLE `shopowner`
  ADD PRIMARY KEY (`soID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foodstall`
--
ALTER TABLE `foodstall`
  ADD CONSTRAINT `foodstall_ibfk_1` FOREIGN KEY (`soID`) REFERENCES `shopowner` (`soID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`stallName`) REFERENCES `foodstall` (`stallName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`foodID`) REFERENCES `menu` (`foodID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `users` (`uID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
