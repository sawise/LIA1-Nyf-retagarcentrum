-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2013 at 02:15 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nfc`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `branch_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alt_title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `billed` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `visit_address` varchar(255) NOT NULL,
  `visit_zip_code` int(11) DEFAULT NULL,
  `visit_city` varchar(255) NOT NULL,
  `mail_address` varchar(255) NOT NULL,
  `mail_zip_code` int(11) DEFAULT NULL,
  `mail_city` varchar(255) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `billing_zip_code` int(11) DEFAULT NULL,
  `billing_city` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- Table structure for table `companies_contracts_branches`
--

CREATE TABLE IF NOT EXISTS `companies_contracts_branches` (
  `company_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `written` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `contact_person` tinyint(1) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=178 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts_activities`
--

CREATE TABLE IF NOT EXISTS `contacts_activities` (
  `contact_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_activities`
--

INSERT INTO `contacts_activities` (`contact_id`, `activity_id`) VALUES
(125, 3),
(125, 4),
(125, 2),
(127, 4),
(127, 4),
(131, 4),
(131, 4),
(131, 4),
(131, 4),
(131, 4),
(131, 4),
(131, 4),
(131, 4),
(142, 3),
(142, 4),
(142, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contacts_branches_contact_types`
--

CREATE TABLE IF NOT EXISTS `contacts_branches_contact_types` (
  `contact_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `contact_type_id` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_branches_contact_types`
--

INSERT INTO `contacts_branches_contact_types` (`contact_id`, `branch_id`, `contact_type_id`, `date`) VALUES
(172, 1, 1, '2013-12-01'),
(172, NULL, 24, NULL),
(172, 1, 1, '2013-12-01'),
(172, NULL, 17, NULL),
(172, NULL, 24, NULL),
(172, 1, 1, '2013-12-01'),
(172, NULL, 17, NULL),
(172, NULL, 24, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts_mailshots_branches`
--

CREATE TABLE IF NOT EXISTS `contacts_mailshots_branches` (
  `contact_id` int(11) NOT NULL,
  `mailshot_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_types`
--

CREATE TABLE IF NOT EXISTS `contact_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` tinyint(1) NOT NULL,
  `branch` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` tinyint(1) NOT NULL,
  `branch` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailshots`
--

CREATE TABLE IF NOT EXISTS `mailshots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
