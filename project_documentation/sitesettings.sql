-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2018 at 05:15 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lap`
--

-- --------------------------------------------------------

--
-- Table structure for table `sitesettings`
--

CREATE TABLE IF NOT EXISTS `sitesettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `key` varchar(40) NOT NULL,
  `value` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '''0''=>''inactive'',''1''=>''active''',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sitesettings`
--

INSERT INTO `sitesettings` (`id`, `title`, `key`, `value`, `status`) VALUES
(1, 'Company Name', 'Site.company_name', 'LARIYA ART PALACE', 1),
(2, 'Contact us Mail', 'Site.email', 'cupcherry2@gmail.com', 1),
(3, 'Company Phone', 'Site.mobile', '1234567890', 1),
(5, 'Skype', 'Site.skype', 'lariya', 1),
(6, 'facebook', 'Site.facebook', 'https://www.facebook.com/profile.php?id=100008674901990', 1),
(7, 'twitter', 'Site.twitter', 'www.twitter.com/lariya', 1),
(8, 'linkedin', 'Site.linkedin', 'www.linkedin.com/lariya', 1),
(9, 'Address', 'Site.address', 'Lariya Village, Pal Chopasni <br>Ring Road - Jodhpur <br> Rajasthan INDIA 342008', 1),
(10, 'Registered address', 'Site.registeredaddress', 'Lariya Village, Pal Chopasni <br>Ring Road - Jodhpur <br> Rajasthan INDIA 342008', 1),
(11, 'Music File', 'Site.musicfile', '3553', 0),
(12, 'Music Play', 'Site.play', '1', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
