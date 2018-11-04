-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2018 at 01:55 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `canID` int(11) NOT NULL,
  `canName` varchar(30) NOT NULL,
  `canGender` varchar(10) NOT NULL,
  `canDob` date NOT NULL,
  `canPhone` varchar(11) NOT NULL,
  `canCity` varchar(20) NOT NULL,
  `canAddress` varchar(100) NOT NULL,
  `canParty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`canID`, `canName`, `canGender`, `canDob`, `canPhone`, `canCity`, `canAddress`, `canParty`) VALUES
(7, 'Amit Kumar', 'male', '1982-04-04', '9876543210', 'Bangalore', 'Bangalore', 'BJP'),
(8, 'Alok Mehta', 'male', '1968-11-09', '9876543210', 'Lucknow', 'Lucknow', 'Congress'),
(9, 'Nand Kishor', 'male', '1981-12-05', '9876543210', 'Bangalore', 'Bangalore', 'BSP'),
(10, 'Suresh Naidu', 'male', '1982-06-05', '9876543210', 'Chennai', 'Chennai', 'AAP'),
(11, 'Anita Kumari', 'female', '1986-12-08', '9876543210', 'Kolkata', 'Kolkata', 'BSP'),
(12, 'Darshan Kumar', 'male', '1996-10-10', '9876543210', 'Bangalore', 'Bangalore', 'CSE'),
(13, 'Sai Kumar', 'male', '1996-02-09', '9876543210', 'Bangalore', 'Bangalore', 'CSE'),
(14, 'Alka P', 'female', '1996-01-06', '9876543210', 'Bangalore', 'Bangalore', 'ISE'),
(15, 'Hemant Kumar', 'male', '1997-01-09', '9876543210', 'Bangalore', 'Bangalore', 'MECH'),
(16, 'Ajay Gowda', 'male', '1996-10-03', '9876543210', 'Bangalore', 'Bangalore', 'ECE');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `electionID` int(11) NOT NULL,
  `electionTitle` varchar(60) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionID`, `electionTitle`, `startDate`, `endDate`) VALUES
(10, 'General Elections', '2018-11-10 10:10:00', '2018-11-10 18:00:00'),
(11, 'UVCE Placement Coordinator Election', '2018-11-16 09:00:00', '2018-11-16 11:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msgID` int(11) NOT NULL,
  `msgSender` int(11) NOT NULL,
  `msgReceiver` int(11) NOT NULL,
  `msgSubject` varchar(100) NOT NULL,
  `msgMsg` varchar(1000) DEFAULT NULL,
  `dateSent` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msgID`, `msgSender`, `msgReceiver`, `msgSubject`, `msgMsg`, `dateSent`) VALUES
(19, 11, 12, 'Congratulations! ', 'You are now approved to vote', '2018-11-04'),
(20, 14, 11, 'Request for Approval', 'Kindly verify the details.', '2018-11-04'),
(21, 11, 14, 'Request for Approval sent', 'Your request for approval has been sent to the administrator.', '2018-11-04'),
(22, 11, 14, 'Congratulations!', 'You are now approved to vote.', '2018-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `participated`
--

CREATE TABLE `participated` (
  `pid` int(11) NOT NULL,
  `electionID` int(11) NOT NULL,
  `canID` int(11) NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participated`
--

INSERT INTO `participated` (`pid`, `electionID`, `canID`, `votes`) VALUES
(18, 10, 7, 0),
(19, 10, 9, 1),
(20, 10, 10, 0),
(21, 10, 11, 0),
(22, 11, 12, 0),
(23, 11, 13, 0),
(24, 11, 14, 0),
(25, 11, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sid` int(11) NOT NULL,
  `sElectionID` int(11) NOT NULL,
  `sVoterNo` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sid`, `sElectionID`, `sVoterNo`, `status`) VALUES
(19, 10, 12, 0),
(20, 10, 13, 0),
(21, 10, 14, 1),
(22, 11, 12, 0),
(23, 11, 13, 0),
(24, 11, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `voterNo` int(11) NOT NULL,
  `voterID` varchar(11) NOT NULL,
  `voterName` varchar(30) NOT NULL,
  `voterGender` varchar(10) NOT NULL,
  `voterDob` date NOT NULL,
  `voterEmail` varchar(40) NOT NULL,
  `voterPassword` varchar(100) NOT NULL,
  `voterPhone` varchar(11) NOT NULL,
  `voterCity` varchar(20) NOT NULL,
  `voterAddress` varchar(100) NOT NULL,
  `voterIsApproved` int(1) NOT NULL,
  `superAccess` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`voterNo`, `voterID`, `voterName`, `voterGender`, `voterDob`, `voterEmail`, `voterPassword`, `voterPhone`, `voterCity`, `voterAddress`, `voterIsApproved`, `superAccess`) VALUES
(0, 'ALL', 'all', 'male', '1988-11-03', 'all@all.com', 'all', '9876543210', 'Bangalore', 'Bangalore', 0, 0),
(11, 'ADMIN', 'admin', 'male', '1990-06-06', 'admin@votingsystem.com', 'admin', '9876543210', 'Bangalore', 'Bangalore', 1, 1),
(12, 'VOTER0001', 'Sanjay Pandit', 'male', '1997-03-04', 'sanjay@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9876543210', 'Bangalore', '#42, Church Street, Bangalore', 1, 0),
(13, 'VOTER0002', 'Rupesh Krishnan', 'male', '1994-02-04', 'rupesh@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9876543210', 'Bangalore', '#19, Domlur, Bangalore', 0, 0),
(14, 'VOTER0056', 'Rajat Yadav', 'male', '1993-06-04', 'rajat@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9876543210', 'New Delhi', '#45, New Delhi', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`canID`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`electionID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msgID`),
  ADD KEY `msgSender` (`msgSender`),
  ADD KEY `msgReceiver` (`msgReceiver`);

--
-- Indexes for table `participated`
--
ALTER TABLE `participated`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `canID` (`canID`),
  ADD KEY `electionID` (`electionID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `sElectionID` (`sElectionID`),
  ADD KEY `sVoterNo` (`sVoterNo`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`voterNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `canID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `participated`
--
ALTER TABLE `participated`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `voterNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`msgSender`) REFERENCES `voter` (`voterNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`msgReceiver`) REFERENCES `voter` (`voterNo`) ON DELETE CASCADE;

--
-- Constraints for table `participated`
--
ALTER TABLE `participated`
  ADD CONSTRAINT `participated_ibfk_1` FOREIGN KEY (`canID`) REFERENCES `candidate` (`canID`) ON DELETE CASCADE,
  ADD CONSTRAINT `participated_ibfk_2` FOREIGN KEY (`electionID`) REFERENCES `election` (`electionID`) ON DELETE CASCADE;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`sElectionID`) REFERENCES `election` (`electionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`sVoterNo`) REFERENCES `voter` (`voterNo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
