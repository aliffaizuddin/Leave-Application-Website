-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 08:33 PM
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
-- Database: `leave_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `ID` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `role` enum('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `applicationID` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `leaveType` varchar(50) DEFAULT NULL,
  `fromDate` date DEFAULT NULL,
  `untilDate` date DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationID`, `username`, `leaveType`, `fromDate`, `untilDate`, `description`, `status`) VALUES
(1, 'staff', 'Casual Leave', '2023-06-26', '2023-06-27', 'wedding', 'pending'),
(2, 'staff', 'Medical Leave', '2023-06-26', '2023-06-30', 'Dengue', 'pending'),
(3, 'staff', 'Emergency Leave', '2023-06-21', '2023-06-26', 'Family matters', 'pending'),
(4, 'alif', 'Medical Leave', '2023-06-25', '2023-06-27', 'Fever', 'pending'),
(5, 'alif', 'Casual Leave', '2023-06-30', '2023-07-03', 'Family matters', 'pending'),
(6, 'alif', 'Restricted Holiday (RH)', '2023-06-21', '2023-06-24', 'Holiday', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `manager_profile`
--

CREATE TABLE `manager_profile` (
  `ID` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `role` enum('manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manager_profile`
--

INSERT INTO `manager_profile` (`ID`, `first_name`, `last_name`, `gender`, `dob`, `address`, `email`, `mobile_number`, `role`) VALUES
(2, 'John', 'Smith', 'Male', '1985-12-12', '123 Main Street, Anytown, USA', ' john.smith@example.com', '+1 (555) 123-4567', 'manager'),
(5, 'Sarah', 'Johnson', 'Female', '1992-03-25', '456 Elm Avenue, Cityville, Canada', '  sarah.johnson@example.com', '+44 1234 567890', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `staff_profile`
--

CREATE TABLE `staff_profile` (
  `ID` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `role` enum('staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_profile`
--

INSERT INTO `staff_profile` (`ID`, `first_name`, `last_name`, `gender`, `dob`, `address`, `email`, `mobile_number`, `role`) VALUES
(3, 'Michael', 'Williams', 'Male', '1978-01-03', '789 Oak Lane, Townsville, UK', 'michael.williams@example.com', '+61 9876 543210', 'staff'),
(6, ' Emily', 'Brown', 'Female', '2001-07-19', '321 Maple Court, Villageland, Australia', 'emily.brown@example.com', '+49 123 456789,', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(12) DEFAULT NULL,
  `level` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `level`) VALUES
(1, 'admin', 'user1', 1),
(2, 'manager', 'user2', 2),
(3, 'staff', 'user3', 3),
(4, 'nabil', 'nabil1', 1),
(5, 'najmi', 'najmi2', 2),
(6, 'alif', 'alif3', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`applicationID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `manager_profile`
--
ALTER TABLE `manager_profile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff_profile`
--
ALTER TABLE `staff_profile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `applicationID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manager_profile`
--
ALTER TABLE `manager_profile`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_profile`
--
ALTER TABLE `staff_profile`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
