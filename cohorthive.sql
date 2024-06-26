-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 10:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cohorthive`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `ID` int(11) NOT NULL,
  `Room_ID` varchar(20) NOT NULL,
  `User_ID` varchar(20) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(400) NOT NULL,
  `Created_On` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_users`
--

CREATE TABLE `chat_users` (
  `ID` int(11) NOT NULL,
  `User_ID` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Room_ID` varchar(20) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_users`
--

INSERT INTO `chat_users` (`ID`, `User_ID`, `Name`, `Room_ID`, `Status`) VALUES
(12, 'iooab0fut365u9wi5uwd', 'testid1', 'byspd950x8jutv1t1g7k', 'Active Now'),
(13, 'iooab0fut365u9wi5uwd', 'testid1', '7fbuv8ii2i1nt2zy9lca', 'Active Now'),
(14, 'iooab0fut365u9wi5uwd', 'testid1', 'ilunhpfcpvzi2ot10iuy', 'Active Now'),
(15, 'x93i0w7kskeo1aes5tva', 'Test User 2', 'byspd950x8jutv1t1g7k', 'Active Now'),
(16, 'o9x4xg6djpef0w9xqn3v', 'testid3', 'byspd950x8jutv1t1g7k', 'Active Now'),
(17, 'iooab0fut365u9wi5uwd', 'testid1', 'bvpqcgp9ang6fotc2lnz', 'Active Now'),
(18, 'x93i0w7kskeo1aes5tva', 'Test User 2', 'bvpqcgp9ang6fotc2lnz', 'Active Now');

-- --------------------------------------------------------

--
-- Table structure for table `codetoroomid`
--

CREATE TABLE `codetoroomid` (
  `ID` int(11) NOT NULL,
  `Room_code` varchar(10) NOT NULL,
  `Room_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `codetoroomid`
--

INSERT INTO `codetoroomid` (`ID`, `Room_code`, `Room_ID`) VALUES
(12, 'cf40uzlwcd', 'byspd950x8jutv1t1g7k'),
(13, 'jl3wavil2b', '7fbuv8ii2i1nt2zy9lca'),
(14, 'o6iuqh5wov', 'ilunhpfcpvzi2ot10iuy'),
(15, 'eo7loo92ay', 'bvpqcgp9ang6fotc2lnz');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `Room_ID` varchar(20) NOT NULL,
  `Incomming_ID` varchar(20) NOT NULL,
  `Outgoing_ID` varchar(20) NOT NULL,
  `Message` varchar(201) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `Room_ID`, `Incomming_ID`, `Outgoing_ID`, `Message`) VALUES
(24, '', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'hlo'),
(25, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'hlo'),
(26, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'hlo'),
(27, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'ye kya ha'),
(28, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'klo'),
(29, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'rjdf'),
(30, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'hnji'),
(31, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'good ediom'),
(32, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'lo'),
(33, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', ','),
(34, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'lol'),
(35, 'byspd950x8jutv1t1g7k', 'iooab0fut365u9wi5uwd', 'o9x4xg6djpef0w9xqn3v', 'hi'),
(36, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'o9x4xg6djpef0w9xqn3v', 'hlo'),
(37, 'byspd950x8jutv1t1g7k', 'o9x4xg6djpef0w9xqn3v', 'iooab0fut365u9wi5uwd', 'hlo'),
(38, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'hnji'),
(39, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'lol'),
(40, 'byspd950x8jutv1t1g7k', 'x93i0w7kskeo1aes5tva', 'iooab0fut365u9wi5uwd', 'l');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `ID` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Owner_ID` varchar(20) NOT NULL,
  `Created_On` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`ID`, `Name`, `Password`, `Owner_ID`, `Created_On`) VALUES
('7fbuv8ii2i1nt2zy9lca', 'Test Room 2', 'testid2', 'iooab0fut365u9wi5uwd', '2024-06-18 21:27:22'),
('bvpqcgp9ang6fotc2lnz', 'Test Room 4', '1234567', 'iooab0fut365u9wi5uwd', '2024-06-19 10:55:58'),
('byspd950x8jutv1t1g7k', 'Test Room 1', '1234567', 'iooab0fut365u9wi5uwd', '2024-06-18 21:26:43'),
('ilunhpfcpvzi2ot10iuy', 'Test Room 3', 'testid3', 'iooab0fut365u9wi5uwd', '2024-06-18 21:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(20) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Created_On` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Username`, `Email`, `Password`, `Created_On`) VALUES
('iooab0fut365u9wi5uwd', 'testid1', 'testid1', 'testid1@gmail.com', '$2y$10$j4c6KuMO99kpKMXZp4lXn.t68ig8eenSTeu7cQ0VKddWLxxxGNuq.', '2024-06-18 21:25:37'),
('o9x4xg6djpef0w9xqn3v', 'testid3', 'testid3', 'testid3@gmail.com', '$2y$10$Upx.VGvN0D35eMsBPRwMN.C4772jD03NL0x6p88IAc.9XBF2kxTpS', '2024-06-19 10:38:50'),
('x93i0w7kskeo1aes5tva', 'Test User 2', 'testid2', 'testid2@gmail.com', '$2y$10$XiDBw4rTIqDgqe.9kwUh7uaoE3CndJKlqiH3lnUDZG5YYLMof9NIS', '2024-06-18 23:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `usertoroom`
--

CREATE TABLE `usertoroom` (
  `ID` int(11) NOT NULL,
  `User_ID` varchar(20) NOT NULL,
  `Room_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertoroom`
--

INSERT INTO `usertoroom` (`ID`, `User_ID`, `Room_ID`) VALUES
(19, 'iooab0fut365u9wi5uwd', 'byspd950x8jutv1t1g7k'),
(20, 'iooab0fut365u9wi5uwd', '7fbuv8ii2i1nt2zy9lca'),
(21, 'iooab0fut365u9wi5uwd', 'ilunhpfcpvzi2ot10iuy'),
(24, 'iooab0fut365u9wi5uwd', 'bvpqcgp9ang6fotc2lnz'),
(25, 'x93i0w7kskeo1aes5tva', 'bvpqcgp9ang6fotc2lnz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `chat_users`
--
ALTER TABLE `chat_users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `codetoroomid`
--
ALTER TABLE `codetoroomid`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usertoroom`
--
ALTER TABLE `usertoroom`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_users`
--
ALTER TABLE `chat_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `codetoroomid`
--
ALTER TABLE `codetoroomid`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `usertoroom`
--
ALTER TABLE `usertoroom`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
