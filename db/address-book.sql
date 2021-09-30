-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2021 at 08:13 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `address-book`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `ID` int(11) NOT NULL,
  `Village_Name` varchar(100) NOT NULL,
  `Taluka_Name` varchar(100) NOT NULL,
  `District_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`ID`, `Village_Name`, `Taluka_Name`, `District_Name`) VALUES
(1, 'Rajkot', '', ''),
(2, 'khitla', '', ''),
(3, 'બોરીપીપડી', '', ''),
(4, 'બોટાદ', '', ''),
(5, 'લીંબાળા', '', ''),
(6, 'રાયપર', '', ''),
(7, 'રાયપર', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `ID` int(11) NOT NULL,
  `Amount` varchar(50) NOT NULL,
  `First_Name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `Last_Name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `Surname` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `Village_Name` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Persons';

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`ID`, `Amount`, `First_Name`, `Last_Name`, `Surname`, `Village_Name`) VALUES
(15, '101', 'ભરતભાઈ', 'હરસુરભાઈ', 'ગોવાળીયા', '6'),
(16, '101', 'ભરતભાઈ', 'નાંગભાઈ', 'ગોવાળીયા', '6'),
(17, '5001', 'ભગીરથભાઈ', 'વલકુભાઈ', 'ગોવાળીયા', '6'),
(18, '101', 'શાંતુભાઈ', 'ભુરાભાઇ', 'ગોવાળીયા', '5'),
(19, '101', 'બાબભાઇ', 'જેઠુરભાઈ', 'ઘાઘલ', '4'),
(20, '501', 'હરેશભાઇ', 'જોરૃભાઈ', 'ભાભળા', '4'),
(28, '101', 'કનુભાઈ', 'દાદભાઈ', 'કરપડા', '3'),
(29, '252', 'Yuvraj', 'Test', 'test', '1'),
(30, '10', 'Yuvraj', 'f', 'ff', '2'),
(31, '888', 'Yuvraj', 'Ravubhai', 'Khavad', '7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `Last_Login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `First_Name`, `Last_Name`, `Username`, `Password`, `Last_Login`) VALUES
(3, 'Yuvraj', 'Khavad', 'yuvraj', '1abda3d4214514af16a5a7c1a2443c48', '17 September 2021 07:52 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
