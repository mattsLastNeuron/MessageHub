-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 04:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messagehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `messagedata`
--

CREATE TABLE `messagedata` (
  `messageID` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messagedata`
--

INSERT INTO `messagedata` (`messageID`, `sender_id`, `receiver_id`, `title`, `message`, `sent_date`, `is_read`) VALUES
(20, 1, 4, 'The Bible & Mario Matters', 'Dear Mark, Your request for \"more bible\" has been denied as we can not as you so confidently recommended \"ask big J for more hot fire verses.\" We would also like to inform you that you can not stone Mario for being a fictional character and a representation of Satan in the media. This offense will count as a strike on your employee card. As a reminder 2 more strikes and your employment will be terminated', '2023-11-29 02:04:34', 0),
(25, 1, NULL, 'Pizza Party On Friday', 'The company will be hosting a pizza party on Friday in recognition of all of your hard work. We know you would all rather have bonuses however we the company do not feel like spending that much money on you pathetic apes now get back to work. ', '2023-12-02 01:05:39', 0),
(26, 4, 1, 'Re The Bible & Mario Matters', 'I feel ignored and unappreciated that this company can not find a way to produce more verses of the bible as they are some how the hottest bars in the realm. I would like the further state that if the company does not see an issue with Mario and his satanic role in the media and his negative influence on children then this is not a company worth working for in the first place. I will rack up new next 2 strikes. 1 for stoning Mario again and the next for stoning you Chris.', '2023-12-02 01:18:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `Position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`ID`, `UserName`, `UserPassword`, `Position`) VALUES
(1, 'ChrisJones', 'bingbong', 'admin'),
(2, 'JohnSmith', 'helloworld1', 'staff'),
(3, 'Mario', 'itsame', 'staff'),
(4, 'MarkLuke', 'thebible', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messagedata`
--
ALTER TABLE `messagedata`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messagedata`
--
ALTER TABLE `messagedata`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messagedata`
--
ALTER TABLE `messagedata`
  ADD CONSTRAINT `messagedata_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `userlogin` (`ID`),
  ADD CONSTRAINT `messagedata_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `userlogin` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
