-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2019 at 11:02 AM
-- Server version: 5.7.19
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ums`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `last_login`, `is_deleted`) VALUES
(3, 'Nalin', 'Sanka', 'nalin4uaz@gmail.com', '011c945f30ce2cbafc452f39840f025693339c42', '2019-09-04 19:03:28', 0),
(4, 'Sahini', 'Nayanthara', 'sahi@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2019-10-17 14:10:24', 0),
(5, 'Chandrani', 'Hewapathirana', 'cha@gmail.com', 'fea7f657f56a2a448da7d4b535ee5e279caf3d9a', '2019-09-05 12:12:49', 1),
(6, 'Sudharma', 'Wanigarathna', 'su@gmail.com', '4c1b52409cf6be3896cf163fa17b32e4da293f2e', '2019-09-11 22:57:43', 0),
(7, 'shehani', 'nethmini', 'she@gmail.com', 'f56d6351aa71cff0debea014d13525e42036187a', '2019-09-10 11:20:57', 0),
(8, 'shahini', 'ravindi', 'sha@gmail.com', '92f2fd99879b0c2466ab8648afb63c49032379c1', '2019-09-10 11:21:47', 0),
(9, 'Gayani', 'Weerasinghe', 'gaya@gmail.com', 'ab874467a7d1ff5fc71a4ade87dc0e098b458aae', '2019-09-11 22:53:30', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
