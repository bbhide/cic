-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2012 at 06:33 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eduservemain`
--

-- --------------------------------------------------------

--
-- Table structure for table `default_cic`
--

CREATE TABLE IF NOT EXISTS `default_cic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pin` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cic_type` int(11) NOT NULL,
  `comp_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mailing` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cp` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `cp_same` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `default_cic`
--

INSERT INTO `default_cic` (`id`, `pin`, `cic_type`, `comp_email`, `c_name`, `title`, `fname`, `mname`, `lname`, `mailing`, `city`, `country`, `state`, `pincode`, `email`, `mobile`, `c_code`, `phone`, `cp`, `cp_same`, `author_id`) VALUES
(1, '0001', 2, 'info@eduserve.in', 'Eduserve', '1', 'Mahavir', 'J', 'Deshlehra', 'Aarey Road, Goregaon West', 'Mumbai', 'India', 'Maharashtra', '400062', 'bhavesh.bhide@eduserve.in', '9870772267', '022', '28996800', '1', 0, 1),
(2, '0002', 1, '', '', '1', 'Karan', '', 'More', 'Andheri East', 'Mumbai', 'India', 'Maharashtra', '400092', 'karan.more@eduserve.in', '9870777226', '', '', '2', 0, 1),
(3, '0003', 2, 'info@osianinternational.in', 'Osian', '1', 'Mahavir', 'J', 'Deshlehra', 'Aarey Road, Goregaon West', 'Mumbai', 'India', 'Maharashtra', '400067', 'mahavir@eduserve.in', '9867267282', '022', '28996800', '1,2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `default_cic_cp`
--

CREATE TABLE IF NOT EXISTS `default_cic_cp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `mobile` mediumtext COLLATE utf8_unicode_ci,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `default_cic_cp`
--

INSERT INTO `default_cic_cp` (`id`, `title`, `fname`, `mname`, `lname`, `email`, `mobile`, `author_id`) VALUES
(1, '1', 'Bhavesh', 'Sudhir', 'Bhide', 'bhavesh.bhide@gmail.com,bhavesh.bhide@eduserve.in', '9870772267', 1),
(2, '1', 'Karan', '', 'More', 'karan.nore@eduserve.in', '9029501257', 1),
(3, '1', 'Vishal', 'Ashok', 'Patil', 'vishal.patil@eduserve.in', '', 1),
(4, '1', 'Praveen', '', 'Sharma', 'praveen@eduserve.in', '', 1),
(5, '0', 'Nilesh', '', 'Bhandari', 'nilesh@yahoo.com', '', 1),
(6, '0', 'Mahavir', '', 'Deshlehra', 'mahavir@eduserve.in', '', 1),
(7, '4', 'B', '', 'Singh', 'drb.singh@spicefoundation.com', '9873173122', 1);
