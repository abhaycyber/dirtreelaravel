-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2020 at 06:07 PM
-- Server version: 5.7.32-0ubuntu0.16.04.1
-- PHP Version: 7.2.33-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `directorytree`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `fileId` int(11) NOT NULL,
  `fileName` varchar(200) NOT NULL,
  `folderId` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT '1',
  `createdOn` datetime NOT NULL,
  `modifiedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`fileId`, `fileName`, `folderId`, `IsActive`, `createdOn`, `modifiedOn`) VALUES
(1, 'file1', 1, 1, '2020-11-05 00:00:00', '0000-00-00 00:00:00'),
(2, 'file2', 2, 1, '2020-11-05 00:00:00', '0000-00-00 00:00:00'),
(3, 'file3', 2, 1, '2020-11-05 00:00:00', '0000-00-00 00:00:00'),
(4, 'file4', 3, 1, '2020-11-05 00:00:00', '2020-11-06 00:00:00'),
(5, 'file5', 8, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'file6', 7, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `folderId` int(11) NOT NULL,
  `foldeName` varchar(200) NOT NULL,
  `parentId` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL,
  `modifiedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`folderId`, `foldeName`, `parentId`, `IsActive`, `createdOn`, `modifiedOn`) VALUES
(1, 'folder1', 0, 1, '2020-11-05 00:00:00', '0000-00-00 00:00:00'),
(2, 'folder2', 1, 1, '2020-11-05 00:00:00', '0000-00-00 00:00:00'),
(3, 'folder3', 2, 1, '2020-11-13 00:00:00', '2020-11-18 00:00:00'),
(4, 'folder4', 1, 1, '2020-11-13 00:00:00', '0000-00-00 00:00:00'),
(5, 'folder5', 1, 1, '2020-11-10 00:00:00', '0000-00-00 00:00:00'),
(6, 'folder6', 5, 1, '2020-11-13 00:00:00', '0000-00-00 00:00:00'),
(7, 'folder7', 6, 1, '2020-11-10 00:00:00', '0000-00-00 00:00:00'),
(8, 'folder8', 7, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'folder9', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'folder10', 3, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'folder11', 10, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'folder12', 9, 1, '2020-11-20 00:00:00', '0000-00-00 00:00:00'),
(13, 'folder13', 1, 1, '2020-11-11 00:00:00', '2020-11-14 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileId`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`folderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `folderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
