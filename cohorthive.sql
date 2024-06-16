-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 09:03 AM
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
(2, '3isjcsp2mh', 'o72cu023k9oyy3zr13ha');

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
('ms1tfowklqg7y2rinx2a', 'Rajeev\'s Room', '$2y$10$gBecGJsPnnPBDkhVbF7OzuggxF2hYcs2PDyoCKXIsL2S67z1YKy1C', 'zbg3a90idc3uuih1rzap', '2024-06-16 11:59:13');

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
('38506s6xi5djie0rmigb', 'Rajeev Manhas', 'rajeevsingh_24', 'rajeevsingh089345@gmail.com', '$2y$10$C7z/OE3rQrF9Ss5H66V/ruBPL5ysYNYFVY3zTjo7AnbXpndKHTmPG', '2024-06-15 16:38:37'),
('zbg3a90idc3uuih1rzap', 'Rajeev Manhas', 'rajeevmanhas', 'rajeevsingh89345@gmail.com', '$2y$10$PtC4HERRKWLma4AoHc09zuRGaYFtFYH7DsLbCIG6gVRkLsQqD4Alq', '2024-06-16 11:54:56');

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
(2, '38506s6xi5djie0rmigb', 'o72cu023k9oyy3zr13ha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codetoroomid`
--
ALTER TABLE `codetoroomid`
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
-- AUTO_INCREMENT for table `codetoroomid`
--
ALTER TABLE `codetoroomid`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertoroom`
--
ALTER TABLE `usertoroom`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
