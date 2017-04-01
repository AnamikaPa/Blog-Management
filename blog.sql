-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2017 at 07:30 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(256) NOT NULL,
  `EMAIL` varchar(256) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
  `CREATION_DATE` date NOT NULL,
  `UPDATED_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adminrequest`
--

CREATE TABLE `adminrequest` (
  `BLOG_ID` int(100) NOT NULL,
  `BLOGGER_ID` int(100) NOT NULL,
  `BLOG_TITLE` varchar(100) NOT NULL,
  `BLOG_DESC` text NOT NULL,
  `BLOG_CATEGORY` varchar(100) NOT NULL,
  `BLOG_AUTHOR` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogdetail`
--

CREATE TABLE `blogdetail` (
  `ID` int(11) NOT NULL,
  `BLOG_ID` int(11) NOT NULL,
  `IMAGE_NAME` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bloggerinfo`
--

CREATE TABLE `bloggerinfo` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(256) NOT NULL,
  `EMAIL` varchar(256) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
  `CREATION_DATE` date NOT NULL,
  `IS_ACTIVE` int(11) NOT NULL,
  `UPDATED_DATE` date NOT NULL,
  `END_DATE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogmaster`
--

CREATE TABLE `blogmaster` (
  `BLOG_ID` int(11) NOT NULL,
  `BLOGGER_ID` int(11) NOT NULL,
  `BLOG_TITLE` varchar(100) NOT NULL,
  `BLOG_DESC` text NOT NULL,
  `BLOG_CATEGORY` varchar(100) NOT NULL,
  `BLOG_AUTHOR` varchar(100) NOT NULL,
  `BLOG_IS_ACTIVE` smallint(2) NOT NULL,
  `CREATION_DATE` date NOT NULL,
  `UPDATED_DATE` date NOT NULL,
  `ADMIN_REVIEW` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(1000) NOT NULL,
  `Number` int(11) NOT NULL,
  `Comment` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `adminrequest`
--
ALTER TABLE `adminrequest`
  ADD KEY `BLOGGER_ID` (`BLOGGER_ID`),
  ADD KEY `BLOG_ID` (`BLOG_ID`);

--
-- Indexes for table `blogdetail`
--
ALTER TABLE `blogdetail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BLOG_ID` (`BLOG_ID`);

--
-- Indexes for table `bloggerinfo`
--
ALTER TABLE `bloggerinfo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blogmaster`
--
ALTER TABLE `blogmaster`
  ADD PRIMARY KEY (`BLOG_ID`),
  ADD KEY `BLOGGER_ID` (`BLOGGER_ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blogdetail`
--
ALTER TABLE `blogdetail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bloggerinfo`
--
ALTER TABLE `bloggerinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `blogmaster`
--
ALTER TABLE `blogmaster`
  MODIFY `BLOG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminrequest`
--
ALTER TABLE `adminrequest`
  ADD CONSTRAINT `adminrequest_ibfk_1` FOREIGN KEY (`BLOGGER_ID`) REFERENCES `bloggerinfo` (`ID`),
  ADD CONSTRAINT `adminrequest_ibfk_2` FOREIGN KEY (`BLOG_ID`) REFERENCES `blogmaster` (`BLOG_ID`);

--
-- Constraints for table `blogdetail`
--
ALTER TABLE `blogdetail`
  ADD CONSTRAINT `blogdetail_ibfk_1` FOREIGN KEY (`BLOG_ID`) REFERENCES `blogmaster` (`BLOG_ID`);

--
-- Constraints for table `blogmaster`
--
ALTER TABLE `blogmaster`
  ADD CONSTRAINT `blogmaster_ibfk_1` FOREIGN KEY (`BLOGGER_ID`) REFERENCES `bloggerinfo` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
