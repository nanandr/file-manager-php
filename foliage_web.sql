-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2022 at 01:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foliage_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_manager`
--

CREATE TABLE `file_manager` (
  `id` int(11) NOT NULL,
  `file_name` varchar(125) DEFAULT NULL,
  `real_name` varchar(125) DEFAULT NULL,
  `file_size` varchar(45) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `folder` int(11) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT current_timestamp(),
  `fileowner` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `file_manager_folder`
--

CREATE TABLE `file_manager_folder` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `folderowner` varchar(20) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `file_user`
--

CREATE TABLE `file_user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_manager`
--
ALTER TABLE `file_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_manager_folder`
--
ALTER TABLE `file_manager_folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_user`
--
ALTER TABLE `file_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_manager`
--
ALTER TABLE `file_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `file_manager_folder`
--
ALTER TABLE `file_manager_folder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `file_user`
--
ALTER TABLE `file_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
