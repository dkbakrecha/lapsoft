-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2018 at 06:20 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lapsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_contents`
--

CREATE TABLE IF NOT EXISTS `email_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `modified` datetime NOT NULL,
  `status` smallint(2) NOT NULL COMMENT '0:Disabled; 1:Enabled; 2:Deleted',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`unique_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `email_contents`
--

INSERT INTO `email_contents` (`id`, `unique_name`, `title`, `subject`, `content`, `keywords`, `modified`, `status`) VALUES
(1, 'FORGOT_PASSWORD', 'Forget Password', 'Reset Password', '<p>Hi, <strong>{{receiver}}</strong>:</p><p>We have received a request to reset your password. \r\nUsername : {{username}}\r\npassword : {{password}}\r\n</p><p><strong></strong></p><p>Thanks!<br /></p>', '{{receiver}},{{username}},{{password}}', '2014-10-08 20:25:07', 0),
(2, 'COMPOSE_MAIL', 'Compose mail admin', 'Greeting', '<p>Hi, <strong>{{receiver}}</strong>:</p>', '{{receiver}}', '2014-10-08 20:25:10', 0),
(3, 'CONTACT_US', 'Contact Us', 'User Mail Inquiry', '<p>Dear Admin:</p><p>You have received an inquiry mail from <strong>{{name}}</strong>.</p><p><strong>E-mail:</strong> {{email}} <br><strong>Contact:</strong> {{contact}} <br> <strong>Message</strong>: {{message}}</p><p>Thanks!</p><p>Team <strong>&quot;Lariya Art Palace</strong>&quot;</p>', '{{name}},{{email}},{{message}},{{contact}}', '2014-09-25 09:24:48', 1),
(4, 'ENQUIRY', 'ENQUIRY', 'USER ENQUIRY', '<p>Dear Admin:</p><p>You have received an product inquiry from <strong>{{name}}</strong>.</p><p><strong>Product Code :</strong> {{pcode}}<strong><br>Product Link :</strong> {{product_id}}<br><strong>E-mail :</strong> {{email}}<br><strong>Contact No. :</strong>{{contact}}<br><strong>Message :</strong>{{message}}</p><p>Thanks!</p><p>Team <strong>&quot;Lariya Art Palace</strong>&quot;</p>', '{{type}},{{product_id}}{{pcode}},{{name}},{{email}},{{contactNo}},{{message}}', '2015-01-01 00:00:00', 1),
(5, 'USER_MAIL', 'USER MAIL', 'USER MAIL', '<p>Dear {{name}}:</p><p>We have received an product inquiry from you. We will contact you soon. </p><p><strong>Product Code :</strong> {{pcode}}<strong><br>Product Link :</strong> {{product_id}}<br><strong>E-mail :</strong> {{email}}<br><strong>Contact No. :</strong>{{contact}}<br><strong>Message :</strong>{{message}}</p><p>Thanks for Visiting our Website.</p><p>Team <strong>&quot;Lariya Art Exports</strong>&quot;</p>', '{{type}},{{product_id}}{{pcode}},{{name}},{{email}},{{contactNo}},{{message}}', '2015-01-01 00:00:00', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `created`, `modified`) VALUES
(4, 'admin@admin.com', '3f019e5ddb983cee2f0a0f9b118f377e28076748', 'admin', '', '2018-04-22 21:22:50', '2018-04-22 21:22:50'),
(8, 'member', '4128738af1f8597682daea9af2ef156308d37797', 'member', '', '2018-04-22 21:30:26', '2018-04-22 21:30:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
