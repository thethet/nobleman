-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2016 at 10:19 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nobleman_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_date` varchar(255) NOT NULL,
  `announcement_content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement_title`, `announcement_date`, `announcement_content`) VALUES
(1, 'A NEW EVENT ON 31 DEC 2016', '2015-11-19', 'HI DO JOIN US'),
(2, 'Testiing', '2016-04-30', 'This is testing for announcement!');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `lesson_id` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `attend` varchar(10) NOT NULL DEFAULT '0',
  `remind` int(255) NOT NULL,
  `trainer_id` varchar(255) NOT NULL,
  `booking_status` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reminder_email_status` varchar(255) NOT NULL,
  `sendby` varchar(255) NOT NULL,
  `senddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `student_id`, `course_id`, `lesson_id`, `date`, `session`, `attend`, `remind`, `trainer_id`, `booking_status`, `created_date`, `updated_date`, `reminder_email_status`, `sendby`, `senddate`) VALUES
(14, '30', '7', '13', '2016-05-06', '7pm - 9pm', '1', 0, '64', 'book', '2016-07-08 07:38:25', '2016-07-08 07:38:25', '', '', '0000-00-00 00:00:00'),
(15, '30', '7', '', '2016-05-10', '11am - 12pm', 'N/A', 0, '', 'book', '0000-00-00 00:00:00', '2016-05-10 10:49:55', '', '', '0000-00-00 00:00:00'),
(16, '31', '6', '', '2016-05-04', '10am - 12pm', '1', 0, '64', 'book', '2016-09-06 07:44:15', '2016-09-06 07:44:15', '', '', '0000-00-00 00:00:00'),
(21, '30', '7', '', '2016-05-15', '10am - 12pm', 'N/A', 0, '', 'unbook', '2016-05-11 18:11:27', '2016-05-11 23:11:27', '', '', '0000-00-00 00:00:00'),
(22, '30', '7', '', '2016-05-12', '7pm - 9pm', 'N/A', 0, '', 'unbook', '2016-07-13 05:05:37', '2016-07-13 05:05:37', '', '', '0000-00-00 00:00:00'),
(23, '30', '7', '', '2016-05-10', '10am - 12pm', 'N/A', 0, '', 'unbook', '2016-07-11 06:51:44', '2016-07-11 06:51:44', '', '', '0000-00-00 00:00:00'),
(24, '31', '6', '', '2016-07-10', '2pm - 4pm', '0', 0, '', 'book', '2016-07-11 06:53:17', '2016-07-11 06:53:17', '1', '56', '2016-07-11 02:53:17'),
(25, '30', '7', '', '2016-07-10', '7pm - 9pm', 'N/A', 0, '', 'book', '2016-07-08 09:09:25', '2016-07-08 09:09:25', '1', '', '0000-00-00 00:00:00'),
(28, '30', '7', '', '2016-05-15', '11am - 12pm', 'N/A', 0, '', 'unbook', '2016-05-11 18:20:36', '2016-05-11 23:20:36', '', '', '0000-00-00 00:00:00'),
(29, '30', '7', '', '2016-07-15', '11am - 12pm', 'N/A', 0, '', 'book', '2016-07-13 05:06:14', '2016-07-13 05:06:14', '', '', '0000-00-00 00:00:00'),
(30, '30', '8', '', '2016-07-18', '11am - 12pm', 'N/A', 0, '', 'book', '2016-07-14 05:52:37', '2016-07-14 04:22:37', '', '', '0000-00-00 00:00:00'),
(31, '30', '5', '', '2016-09-05', '11am - 12pm', 'N/A', 0, '', 'book', '2016-09-05 05:05:49', '2016-09-05 03:35:49', '', '', '0000-00-00 00:00:00'),
(32, '30', '6', '', '2016-09-07', '11am - 12pm', 'N/A', 0, '', 'book', '2016-09-05 05:31:26', '2016-09-05 04:01:26', '', '', '0000-00-00 00:00:00'),
(33, '30', '5', '', '2016-09-27', '2pm - 4pm', 'N/A', 0, '', 'book', '2016-09-23 09:55:02', '2016-09-23 06:55:02', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `information` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `code`, `name`, `information`, `created_at`, `updated_at`) VALUES
(1, 'S01', 'Singapore #1', 'singapore branch 1', '2016-07-12 22:48:41', '2016-09-22 02:34:18'),
(2, 'S02', 'Singapore #2', 'singapore branch 2', '2016-07-12 22:48:47', '2016-09-22 02:34:24'),
(3, 'M01', 'Malaysia #1', 'malaysia branch 1', '2016-07-12 22:49:47', '2016-09-22 02:34:35'),
(4, 'V01', 'Vietnam #1', 'vitenam branch 1', '2016-07-12 22:50:09', '2016-09-22 02:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `cert`
--

CREATE TABLE IF NOT EXISTS `cert` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `stdname` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `certid` varchar(255) NOT NULL,
  `received_certificate` tinyint(1) NOT NULL,
  `received_date` varchar(255) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `collection_date` date NOT NULL,
  `issued_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `cert`
--

INSERT INTO `cert` (`id`, `stdname`, `course`, `date`, `certid`, `received_certificate`, `received_date`, `created_by`, `collection_date`, `issued_by`) VALUES
(23, '35', '8', '2016-09-15', '1', 1, '2016-09-20', 'admin', '2016-09-15', 96),
(25, '30', '1', '2016-09-22', '1', 1, '2016-10-25', 'admin', '2016-09-22', 56);

-- --------------------------------------------------------

--
-- Table structure for table `certid`
--

CREATE TABLE IF NOT EXISTS `certid` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `serial` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `certid`
--

INSERT INTO `certid` (`id`, `course_id`, `serial`, `name`, `created_at`, `created_by`) VALUES
(1, 0, '1020385', 'Cert1', '0000-00-00 00:00:00', 'admin'),
(2, 0, '30000198', 'Cert3', '0000-00-00 00:00:00', 'admin'),
(3, 0, '30000200', 'Cert2', '0000-00-00 00:00:00', 'admin'),
(5, 0, '23232', 'Cert4', '2016-03-11 12:43:37', 'admin'),
(8, 1, 'CCN102', 'Basic Floral Design Course', '2016-09-22 03:53:57', 'admin'),
(9, 2, 'CCW901', 'Bridal Bouquet Couse Outline Module  1', '2016-09-22 04:04:35', 'admin'),
(10, 3, 'CCW902', 'Bridal Bouquet Couse Outline Module 2', '2016-09-22 04:06:17', 'admin'),
(11, 4, 'CCW903', 'Bridal Car Decoration Design  Couse', '2016-09-22 04:12:54', 'admin'),
(12, 5, 'CCW901-2', 'Creative Wedding Floral Design Course ', '2016-09-22 04:19:02', 'admin'),
(13, 6, 'CCCFDC', 'Customize Floral Design Course', '2016-09-22 04:25:09', 'admin'),
(14, 7, 'CF001', 'Floral Collagen Art 3-day Workshop', '2016-09-22 04:27:31', 'admin'),
(15, 8, 'CA702', 'Floral Structure Design Course (A702)', '2016-09-22 04:30:32', 'admin'),
(16, 9, 'CCN105', 'Gift Wrapping Course - Course Outline', '2016-09-22 04:32:26', 'admin'),
(17, 10, 'CCN108', 'Hamper Wrapping Course', '2016-09-22 04:34:18', 'admin'),
(18, 11, 'CCHBDL2', 'Hand-tied Bouqet Design Course - Level 2', '2016-09-22 04:35:54', 'admin'),
(19, 12, 'CCHTBD-L1', 'Hand-Tied Bouquet Design Course-Level 1', '2016-09-22 04:38:55', 'admin'),
(20, 13, 'CCN101-1', 'Lifestyle Floral Design Course ', '2016-09-22 04:39:51', 'admin'),
(21, 14, 'CCN101-2', 'Lifestyle Floral Design Course', '2016-09-22 04:41:11', 'admin'),
(22, 15, 'CCN109', 'Ribbon _ Bow Making Course', '2016-09-22 04:43:51', 'admin'),
(23, 16, 'CCA703', 'Sculpture Floral Design Course (A703)', '2016-09-22 04:45:27', 'admin'),
(24, 17, 'CCA705', 'Terrarium _ Live Plants Design Course A705', '2016-09-22 04:47:21', 'admin'),
(25, 18, 'CCT001', 'Trial Lesson for handtied bouquet', '2016-09-22 04:49:50', 'admin'),
(26, 19, 'CCT002', 'Trial Lesson for table arrangement', '2016-09-22 04:50:28', 'admin'),
(27, 20, '22', 'Lifestyle Floral Design Course', '2016-09-23 12:27:38', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(80) NOT NULL,
  `nationality` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=193 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `nationality`) VALUES
(1, 'Afghanistan', 'Afghan'),
(2, 'Albania', 'Albanian'),
(3, 'Algeria', 'Algerian'),
(4, 'Andorra', 'Andorran'),
(5, 'Angola', 'Angolan'),
(6, 'Antigua and Barbuda', 'Antiguans, Barbudans'),
(7, 'Argentina', 'Argentinean'),
(8, 'Armenia', 'Armenian'),
(9, 'Australia', 'Australian'),
(10, 'Austria', 'Austrian'),
(11, 'Azerbaijan', 'Azerbaijani'),
(12, 'The Bahamas', 'Bahamian'),
(13, 'Bahrain', 'Bahraini'),
(14, 'Bangladesh', 'Bangladeshi'),
(15, 'Barbados', 'Barbadian'),
(16, 'Belarus', 'Belarusian'),
(17, 'Belgium', 'Belgian'),
(18, 'Belize', 'Belizean'),
(19, 'Benin', 'Beninese'),
(20, 'Bhutan', 'Bhutanese'),
(21, 'Bolivia', 'Bolivian'),
(22, 'Bosnia and Herzegovina', 'Bosnian, Herzegovinian'),
(23, 'Botswana', 'Motswana (singular), Batswana (plural)'),
(24, 'Brazil', 'Brazilian'),
(25, 'Brunei', 'Bruneian'),
(26, 'Bulgaria', 'Bulgarian'),
(27, 'Burkina Faso', 'Burkinabe'),
(28, 'Burundi', 'Burundian'),
(29, 'Cambodia', 'Cambodian'),
(30, 'Cameroon', 'Cameroonian'),
(31, 'Canada', 'Canadian'),
(32, 'Cape Verde', 'Cape Verdian'),
(33, 'Central African Republic', 'Central African'),
(34, 'Chad', 'Chadian'),
(35, 'Chile', 'Chilean'),
(36, 'China', 'Chinese'),
(37, 'Colombia', 'Colombian'),
(38, 'Comoros', 'Comoran'),
(39, 'Congo, Republic of the', 'Congolese'),
(40, 'Congo, Democratic Republic of the', 'Congolese'),
(41, 'Costa Rica', 'Costa Rican'),
(42, 'Cote d''Ivoire', 'Ivorian'),
(43, 'Croatia', 'Croatian'),
(44, 'Cuba', 'Cuban'),
(45, 'Cyprus', 'Cypriot'),
(46, 'Czech Republic', 'Czech'),
(47, 'Denmark', 'Danish'),
(48, 'Djibouti', 'Djibouti'),
(49, 'Dominica', 'Dominican'),
(50, 'Dominican Republic', 'Dominican'),
(51, 'East Timor', 'East Timorese'),
(52, 'Ecuador', 'Ecuadorean'),
(53, 'Egypt', 'Egyptian'),
(54, 'El Salvador', 'Salvadoran'),
(55, 'Equatorial Guinea', 'Equatorial Guinean'),
(56, 'Eritrea', 'Eritrean'),
(57, 'Estonia', 'Estonian'),
(58, 'Ethiopia', 'Ethiopian'),
(59, 'Fiji', 'Fijian'),
(60, 'Finland', 'Finnish'),
(61, 'France', 'French'),
(62, 'Gabon', 'Gabonese'),
(63, 'The Gambia', 'Gambian'),
(64, 'Georgia', 'Georgian'),
(65, 'Germany', 'German'),
(66, 'Ghana', 'Ghanaian'),
(67, 'Greece', 'Greek'),
(68, 'Grenada', 'Grenadian'),
(69, 'Guatemala', 'Guatemalan'),
(70, 'Guinea', 'Guinean'),
(71, 'Guinea-Bissau', 'Guinea-Bissauan'),
(72, 'Guyana', 'Guyanese'),
(73, 'Haiti', 'Haitian'),
(74, 'Honduras', 'Honduran'),
(75, 'Hungary', 'Hungarian'),
(76, 'Iceland', 'Icelander'),
(77, 'India', 'Indian'),
(78, 'Indonesia', 'Indonesian'),
(79, 'Iran', 'Iranian'),
(80, 'Iraq', 'Iraqi'),
(81, 'Ireland', 'Irish'),
(82, 'Israel', 'Israeli'),
(83, 'Italy', 'Italian'),
(84, 'Jamaica', 'Jamaican'),
(85, 'Japan', 'Japanese'),
(86, 'Jordan', 'Jordanian'),
(87, 'Kazakhstan', 'Kazakhstani'),
(88, 'Kenya', 'Kenyan'),
(89, 'Kiribati', 'I-Kiribati'),
(90, 'Korea, North', 'North Korean'),
(91, 'Korea, South', 'South Korean'),
(92, 'Kuwait', 'Kuwaiti'),
(93, 'Kyrgyz Republic', 'Kirghiz'),
(94, 'Laos', 'Laotian'),
(95, 'Latvia', 'Latvian'),
(96, 'Lebanon', 'Lebanese'),
(97, 'Lesotho', 'Mosotho'),
(98, 'Liberia', 'Liberian'),
(99, 'Libya', 'Libyan'),
(100, 'Liechtenstein', 'Liechtensteiner'),
(101, 'Lithuania', 'Lithuanian'),
(102, 'Luxembourg', 'Luxembourger'),
(103, 'Macedonia', 'Macedonian'),
(104, 'Madagascar', 'Malagasy'),
(105, 'Malawi', 'Malawian'),
(106, 'Malaysia', 'Malaysian'),
(107, 'Maldives', 'Maldivan'),
(108, 'Mali', 'Malian'),
(109, 'Malta', 'Maltese'),
(110, 'Marshall Islands', 'Marshallese'),
(111, 'Mauritania', 'Mauritanian'),
(112, 'Mauritius', 'Mauritian'),
(113, 'Mexico', 'Mexican'),
(114, 'Federated States of Micronesia', 'Micronesian'),
(115, 'Moldova', 'Moldovan'),
(116, 'Monaco', 'Monegasque'),
(117, 'Mongolia', 'Mongolian'),
(118, 'Morocco', 'Moroccan'),
(119, 'Mozambique', 'Mozambican'),
(120, 'Myanmar (Burma)', 'Burmese'),
(121, 'Namibia', 'Namibian'),
(122, 'Nauru', 'Nauruan'),
(123, 'Nepal', 'Nepalese'),
(124, 'Netherlands', 'Dutch'),
(125, 'New Zealand', 'New Zealander'),
(126, 'Nicaragua', 'Nicaraguan'),
(127, 'Niger', 'Nigerien'),
(128, 'Nigeria', 'Nigerian'),
(129, 'Norway', 'Norwegian'),
(130, 'Oman', 'Omani'),
(131, 'Pakistan', 'Pakistani'),
(132, 'Palau', 'Palauan'),
(133, 'Panama', 'Panamanian'),
(134, 'Papua New Guinea', 'Papua New Guinean'),
(135, 'Paraguay', 'Paraguayan'),
(136, 'Peru', 'Peruvian'),
(137, 'Philippines', 'Filipino'),
(138, 'Poland', 'Polish'),
(139, 'Portugal', 'Portuguese'),
(140, 'Qatar', 'Qatari'),
(141, 'Romania', 'Romanian'),
(142, 'Russia', 'Russian'),
(143, 'Rwanda', 'Rwandan'),
(144, 'Saint Kitts and Nevis', 'Kittian and Nevisian'),
(145, 'Saint Lucia', 'Saint Lucian'),
(146, 'Samoa', 'Samoan'),
(147, 'San Marino', 'Sammarinese'),
(148, 'Sao Tome and Principe', 'Sao Tomean'),
(149, 'Saudi Arabia', 'Saudi Arabian'),
(150, 'Senegal', 'Senegalese'),
(151, 'Serbia and Montenegro', 'Serbian'),
(152, 'Seychelles', 'Seychellois'),
(153, 'Sierra Leone', 'Sierra Leonean'),
(154, 'Singapore', 'Singaporean'),
(155, 'Slovakia', 'Slovak'),
(156, 'Slovenia', 'Slovene'),
(157, 'Solomon Islands', 'Solomon Islander'),
(158, 'Somalia', 'Somali'),
(159, 'South Africa', 'South African'),
(160, 'Spain', 'Spanish'),
(161, 'Sri Lanka', 'Sri Lankan'),
(162, 'Sudan', 'Sudanese'),
(163, 'Suriname', 'Surinamer'),
(164, 'Swaziland', 'Swazi'),
(165, 'Sweden', 'Swedish'),
(166, 'Switzerland', 'Swiss'),
(167, 'Syria', 'Syrian'),
(168, 'Taiwan', 'Taiwanese'),
(169, 'Tajikistan', 'Tadzhik'),
(170, 'Tanzania', 'Tanzanian'),
(171, 'Thailand', 'Thai'),
(172, 'Togo', 'Togolese'),
(173, 'Tonga', 'Tongan'),
(174, 'Trinidad and Tobago', 'Trinidadian'),
(175, 'Tunisia', 'Tunisian'),
(176, 'Turkey', 'Turkish'),
(177, 'Turkmenistan', 'Turkmen'),
(178, 'Tuvalu', 'Tuvaluan'),
(179, 'Uganda', 'Ugandan'),
(180, 'Ukraine', 'Ukrainian'),
(181, 'United Arab Emirates', 'Emirian'),
(182, 'United Kingdom', 'British'),
(183, 'United States', 'American'),
(184, 'Uruguay', 'Uruguayan'),
(185, 'Uzbekistan', 'Uzbekistani'),
(186, 'Vanuatu', 'Ni-Vanuatu'),
(187, 'Vatican City (Holy See)', 'none'),
(188, 'Venezuela', 'Venezuelan'),
(189, 'Vietnam', 'Vietnamese'),
(190, 'Yemen', 'Yemeni'),
(191, 'Zambia', 'Zambian'),
(192, 'Zimbabwe', 'Zimbabwean');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_category` varchar(30) NOT NULL,
  `course_type` varchar(20) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `cost_of_course` varchar(255) NOT NULL,
  `duration_of_course` int(11) NOT NULL,
  `no_of_lesson` int(11) NOT NULL,
  `no_hours_per_lesson` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `module_category`, `course_type`, `course_code`, `course_name`, `cost_of_course`, `duration_of_course`, `no_of_lesson`, `no_hours_per_lesson`, `status`, `created_at`, `updated_at`, `updated_by`, `course_id`) VALUES
(1, '', 'Trial', 'N102', 'Basic Floral Design Course', '580', 0, 10, '1', 1, '2016-09-23 01:17:28', '2016-09-23 01:17:28', 56, 0),
(2, '', 'Individual Course', 'W901', 'Bridal Bouquet Couse Outline Module  1', '1575', 0, 10, '2', 1, '2016-09-22 04:14:13', '2016-09-22 04:14:13', 56, 0),
(3, '', 'Individual Course', 'W902', 'Bridal Bouquet Couse Outline Module 2', '1875', 0, 10, '2', 1, '2016-09-22 04:14:20', '2016-09-22 04:14:20', 56, 0),
(4, '', 'Individual Course', 'W903', 'Bridal Car Decoration Design  Couse', '500', 10, 2, '1', 1, '2016-09-22 04:14:28', '2016-09-22 04:14:28', 56, 0),
(5, '', 'Full Course', 'W901-2', 'Creative Wedding Floral Design Course ', '5500', 60, 10, '2', 1, '2016-09-22 04:19:02', '2016-09-22 04:19:02', 56, 0),
(6, '', 'Individual Course', 'CFDC', 'Customize Floral Design Course', '1412', 5, 10, '1', 1, '2016-09-22 04:25:09', '2016-09-22 04:25:09', 56, 0),
(7, '', 'Individual Course', 'F001', 'Floral Collagen Art 3-day Workshop', '1200', 3, 10, '2', 1, '2016-09-22 04:28:04', '2016-09-22 04:28:04', 56, 0),
(8, '', 'Individual Course', 'A702', 'Floral Structure Design Course (A702)', '1633', 20, 10, '2', 1, '2016-09-22 04:30:32', '2016-09-22 04:30:32', 56, 0),
(9, '', 'Individual Course', 'N105', 'Gift Wrapping Course - Course Outline', '180', 12, 4, '1', 1, '2016-09-22 04:32:26', '2016-09-22 04:32:26', 56, 0),
(10, '', 'Individual Course', 'N108', 'Hamper Wrapping Course', '200', 5, 10, '2', 1, '2016-09-22 04:34:18', '2016-09-22 04:34:18', 56, 0),
(11, '', 'Individual Course', 'HBDL2', 'Hand-tied Bouqet Design Course - Level 2', '1175', 15, 10, '2', 1, '2016-09-22 04:35:53', '2016-09-22 04:35:53', 56, 0),
(12, '', 'Individual Course', 'HTBD-L1', 'Hand-Tied Bouquet Design Course-Level 1', '975', 10, 10, '2', 1, '2016-09-22 04:38:55', '2016-09-22 04:38:55', 56, 0),
(13, '', 'Individual Course', 'N101-1', 'Lifestyle Floral Design Course ', '950', 20, 10, '2', 1, '2016-09-22 04:45:50', '2016-09-22 04:45:50', 56, 0),
(14, '', 'Individual Course', 'N101-2', 'Lifestyle Floral Design Course', '1250', 20, 10, '2', 1, '2016-09-22 04:41:11', '2016-09-22 04:41:11', 56, 0),
(15, '', 'Individual Course', 'N109', 'Ribbon _ Bow Making Course', '160', 22, 10, '2', 1, '2016-09-22 04:43:51', '2016-09-22 04:43:51', 56, 0),
(16, '', 'Individual Course', 'A703', 'Sculpture Floral Design Course (A703)', '1633', 20, 10, '2', 1, '2016-09-22 04:45:27', '2016-09-22 04:45:27', 56, 0),
(17, '', 'Individual Course', 'A705', 'Terrarium _ Live Plants Design Course A705', '950', 30, 10, '2', 1, '2016-09-22 04:47:21', '2016-09-22 04:47:21', 56, 0),
(18, '', 'Trial', 'T001', 'Trial Lesson for handtied bouquet', '45', 3, 5, '1', 1, '2016-09-22 04:49:50', '2016-09-22 04:49:50', 56, 0),
(19, '', 'Trial', 'T002', 'Trial Lesson for table arrangement', '45', 3, 5, '1', 1, '2016-09-22 04:50:28', '2016-09-22 04:50:28', 56, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses_old`
--

CREATE TABLE IF NOT EXISTS `courses_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `courses_old`
--

INSERT INTO `courses_old` (`id`, `course_code`, `course_name`, `course_type`, `created_at`) VALUES
(8, 'f001', 'Professional Certificate in Florist Development', 'full', '2016-07-14 12:06:43'),
(9, 'f002', 'Certificate in European Floral Design', 'full', '2016-07-14 12:07:02'),
(10, 'f003', 'Certificate in American Floral Design ', 'full', '2016-07-14 12:09:21'),
(11, 'f004', 'Creative Wedding Floral Design Course', 'full', '2016-07-14 12:09:48'),
(12, 'IC001', 'Basic Floral Design Cours', 'individual', '2016-07-14 12:12:06'),
(13, 'IC002', 'Lifestyle Floral Design Course 2', 'individual', '2016-07-14 12:25:18'),
(14, 'IC003', 'Handtied Bouquet Course 1', 'individual', '2016-07-14 12:25:42'),
(15, 'IC004', 'Handtied Bouquet Course 2', 'individual', '2016-07-14 12:26:00'),
(16, 'IC005', 'Bridal Bouquet Course 1', 'individual', '2016-07-14 12:26:26'),
(17, 'IC006', 'Bridal Bouquet Course 2', 'individual', '2016-07-14 12:28:45'),
(18, 'IC007', 'Bridal Car Decoration Course', 'individual', '2016-07-14 12:29:04'),
(19, 'IC008', 'Gift Wrapping Design Course', 'individual', '2016-07-14 12:29:23'),
(20, 'IC009', 'Hamper Wrapping Course', 'individual', '2016-07-14 12:29:43'),
(21, 'IC0010', 'Ribbon & Bow Making Course', 'individual', '2016-07-14 12:30:00'),
(22, 'IC0011', 'Sculpture Floral Design Course ', 'individual', '2016-07-14 12:30:15'),
(23, 'IC0012', 'Floral Structure Design Course', 'individual', '2016-07-14 12:30:37'),
(24, 'IC0013', 'Floral Collagen Art 3-day Workshop', 'individual', '2016-07-14 12:30:51'),
(25, 'IC0014', 'Terrarium & Live Plants Design Course', 'individual', '2016-07-14 12:31:06'),
(26, 'IC0015', 'How to Build a Successful Flower Business', 'individual', '2016-07-14 12:31:19'),
(27, 'IC0016', 'Customized Floral Design Course', 'individual', '2016-07-14 12:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hf_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `hf_date`, `ht_date`, `h_name`) VALUES
(1, '2016-07-16', '2016-07-16', 'Fullmoon day of Thasaungmone'),
(3, '2016-05-02', '2016-05-02', 'Labour Day');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_code` varchar(255) NOT NULL,
  `lesson_name` varchar(255) NOT NULL,
  `lesson_type` varchar(30) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `lesson_code`, `lesson_name`, `lesson_type`, `module_name`, `status`, `module_id`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'PF-1/123', 'Round', 'Normal Lesssons', 'Foundation ', 1, '5', '2015-12-04 10:03:38', '2015-12-04 10:03:38', '29'),
(2, 'PF-FML1', 'Round  Design', 'Normal Lesssons', 'Foundation ', 1, '5', '2015-10-09 08:33:47', '2015-10-09 08:33:47', '29'),
(3, 'PF-FML2', 'Horizontal Design', 'Normal Lesssons', 'Foundation ', 1, '5', '2015-10-09 08:34:24', '2015-10-09 08:34:24', '29'),
(4, 'PF- FML3', 'Cresent Design', 'Normal Lesssons', 'Foundation ', 1, '5', '2015-10-09 08:58:59', '2015-10-09 08:58:59', '29'),
(5, 'PF-FML4', 'Fan Design', 'Normal Lesssons', 'Foundation ', 1, '5', '2015-10-09 08:59:38', '2015-10-09 08:59:38', '29'),
(6, ' PF-FML5', 'Line Design', 'Normal Lesssons', 'Foundation ', 1, '5', '2015-10-09 09:00:25', '2015-10-09 09:00:25', '29'),
(7, 'PF-FML6', 'Assessment ', 'Normal Lesssons', 'Foundation ', 1, '5', '2015-10-09 09:01:12', '2015-10-09 09:01:12', '29'),
(8, 'PF- EML1', 'Symmetrical', 'Normal Lesssons', 'Elementary', 1, '6', '2015-10-09 09:04:22', '2015-10-09 09:04:22', '29'),
(9, 'PF-EML2', 'Asymentrical ', 'Normal Lesssons', 'Elementary', 1, '6', '2015-10-09 09:04:54', '2015-10-09 09:04:54', '29'),
(10, 'PF-EML4', 'Cone ', 'Normal Lesssons', 'Elementary', 1, '6', '2015-10-09 09:06:19', '2015-10-09 09:06:19', '29'),
(11, ' PF-EML5', 'Parallel', 'Normal Lesssons', 'Elementary', 1, '6', '2015-10-09 09:06:50', '2015-10-09 09:06:50', '29'),
(12, ' PF-EML6', 'Assessment', 'Normal Lesssons', 'Elementary', 1, '6', '2015-10-09 09:07:24', '2015-10-09 09:07:24', '29'),
(13, 'PF-HML1', 'Round', 'Normal Lesssons', 'Hand-tied', 1, '7', '2015-10-09 09:10:08', '2015-10-09 09:10:08', '29'),
(15, 'PF-HML2', 'Side Grouping ', 'Normal Lesssons', 'Hand-tied', 1, '7', '2015-10-09 09:15:13', '2015-10-09 09:15:13', '29'),
(18, 'PF-1/123', 'Round', 'Normal Lessons', 'Foundation', 1, '5', '2016-03-17 05:06:14', '2016-03-17 05:06:14', '56'),
(19, 'PF-1/126', 'Horizontal Design', 'Normal Lessons', 'Foundation', 1, '5', '2016-03-17 05:06:15', '2016-03-17 05:06:15', '56');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_sessions`
--

CREATE TABLE IF NOT EXISTS `lesson_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `session` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=912 ;

--
-- Dumping data for table `lesson_sessions`
--

INSERT INTO `lesson_sessions` (`id`, `day`, `session`, `course_id`, `status`) VALUES
(242, 'Mon', 'A', 5, 0),
(243, 'Tue', 'A', 5, 0),
(244, 'Wed', 'A', 5, 0),
(245, 'Thur', 'A', 5, 0),
(246, 'Fri', 'A', 5, 0),
(247, 'Sat', 'A', 5, 0),
(248, 'Sun', 'A', 5, 0),
(249, 'Mon', 'B', 5, 0),
(250, 'Tue', 'B', 5, 1),
(251, 'Wed', 'B', 5, 0),
(252, 'Thur', 'B', 5, 0),
(253, 'Fri', 'B', 5, 0),
(254, 'Sat', 'B', 5, 0),
(255, 'Sun', 'B', 5, 0),
(256, 'Mon', 'C', 5, 0),
(257, 'Tue', 'C', 5, 0),
(258, 'Wed', 'C', 5, 0),
(259, 'Thur', 'C', 5, 0),
(260, 'Fri', 'C', 5, 0),
(261, 'Sat', 'C', 5, 0),
(262, 'Sun', 'C', 5, 0),
(263, 'Mon', 'D', 5, 0),
(264, 'Tue', 'D', 5, 0),
(265, 'Wed', 'D', 5, 0),
(266, 'Thur', 'D', 5, 0),
(267, 'Fri', 'D', 5, 0),
(268, 'Sat', 'D', 5, 0),
(269, 'Sun', 'D', 5, 0),
(270, 'Mon', 'A', 6, 0),
(271, 'Tue', 'A', 6, 0),
(272, 'Wed', 'A', 6, 0),
(273, 'Thur', 'A', 6, 0),
(274, 'Fri', 'A', 6, 0),
(275, 'Sat', 'A', 6, 0),
(276, 'Sun', 'A', 6, 0),
(277, 'Mon', 'B', 6, 0),
(278, 'Tue', 'B', 6, 0),
(279, 'Wed', 'B', 6, 0),
(280, 'Thur', 'B', 6, 0),
(281, 'Fri', 'B', 6, 0),
(282, 'Sat', 'B', 6, 0),
(283, 'Sun', 'B', 6, 0),
(284, 'Mon', 'C', 6, 0),
(285, 'Tue', 'C', 6, 0),
(286, 'Wed', 'C', 6, 0),
(287, 'Thur', 'C', 6, 0),
(288, 'Fri', 'C', 6, 0),
(289, 'Sat', 'C', 6, 0),
(290, 'Sun', 'C', 6, 0),
(291, 'Mon', 'D', 6, 0),
(292, 'Tue', 'D', 6, 0),
(293, 'Wed', 'D', 6, 0),
(294, 'Thur', 'D', 6, 0),
(295, 'Fri', 'D', 6, 0),
(296, 'Sat', 'D', 6, 0),
(297, 'Sun', 'D', 6, 0),
(298, 'Mon', 'A', 7, 0),
(299, 'Tue', 'A', 7, 1),
(300, 'Wed', 'A', 7, 0),
(301, 'Thur', 'A', 7, 0),
(302, 'Fri', 'A', 7, 0),
(303, 'Sat', 'A', 7, 0),
(304, 'Sun', 'A', 7, 1),
(305, 'Mon', 'B', 7, 0),
(306, 'Tue', 'B', 7, 0),
(307, 'Wed', 'B', 7, 0),
(308, 'Thur', 'B', 7, 1),
(309, 'Fri', 'B', 7, 0),
(310, 'Sat', 'B', 7, 0),
(311, 'Sun', 'B', 7, 0),
(312, 'Mon', 'C', 7, 0),
(313, 'Tue', 'C', 7, 0),
(314, 'Wed', 'C', 7, 1),
(315, 'Thur', 'C', 7, 1),
(316, 'Fri', 'C', 7, 0),
(317, 'Sat', 'C', 7, 0),
(318, 'Sun', 'C', 7, 0),
(319, 'Mon', 'D', 7, 0),
(320, 'Tue', 'D', 7, 1),
(321, 'Wed', 'D', 7, 0),
(322, 'Thur', 'D', 7, 0),
(323, 'Fri', 'D', 7, 0),
(324, 'Sat', 'D', 7, 0),
(325, 'Sun', 'D', 7, 1),
(326, 'Mon', 'A', 8, 0),
(327, 'Tue', 'A', 8, 0),
(328, 'Wed', 'A', 8, 0),
(329, 'Thur', 'A', 8, 0),
(330, 'Fri', 'A', 8, 0),
(331, 'Sat', 'A', 8, 0),
(332, 'Sun', 'A', 8, 0),
(333, 'Mon', 'B', 8, 0),
(334, 'Tue', 'B', 8, 0),
(335, 'Wed', 'B', 8, 0),
(336, 'Thur', 'B', 8, 0),
(337, 'Fri', 'B', 8, 0),
(338, 'Sat', 'B', 8, 0),
(339, 'Sun', 'B', 8, 0),
(340, 'Mon', 'C', 8, 0),
(341, 'Tue', 'C', 8, 0),
(342, 'Wed', 'C', 8, 0),
(343, 'Thur', 'C', 8, 0),
(344, 'Fri', 'C', 8, 0),
(345, 'Sat', 'C', 8, 0),
(346, 'Sun', 'C', 8, 0),
(347, 'Mon', 'D', 8, 0),
(348, 'Tue', 'D', 8, 0),
(349, 'Wed', 'D', 8, 0),
(350, 'Thur', 'D', 8, 0),
(351, 'Fri', 'D', 8, 0),
(352, 'Sat', 'D', 8, 0),
(353, 'Sun', 'D', 8, 0),
(354, 'Mon', 'A', 9, 1),
(355, 'Tue', 'A', 9, 0),
(356, 'Wed', 'A', 9, 0),
(357, 'Thur', 'A', 9, 0),
(358, 'Fri', 'A', 9, 0),
(359, 'Sat', 'A', 9, 0),
(360, 'Sun', 'A', 9, 0),
(361, 'Mon', 'B', 9, 1),
(362, 'Tue', 'B', 9, 1),
(363, 'Wed', 'B', 9, 1),
(364, 'Thur', 'B', 9, 0),
(365, 'Fri', 'B', 9, 0),
(366, 'Sat', 'B', 9, 0),
(367, 'Sun', 'B', 9, 0),
(368, 'Mon', 'C', 9, 0),
(369, 'Tue', 'C', 9, 0),
(370, 'Wed', 'C', 9, 0),
(371, 'Thur', 'C', 9, 0),
(372, 'Fri', 'C', 9, 0),
(373, 'Sat', 'C', 9, 0),
(374, 'Sun', 'C', 9, 0),
(375, 'Mon', 'D', 9, 0),
(376, 'Tue', 'D', 9, 0),
(377, 'Wed', 'D', 9, 0),
(378, 'Thur', 'D', 9, 0),
(379, 'Fri', 'D', 9, 0),
(380, 'Sat', 'D', 9, 0),
(381, 'Sun', 'D', 9, 0),
(382, 'Mon', 'A', 10, 0),
(383, 'Tue', 'A', 10, 0),
(384, 'Wed', 'A', 10, 0),
(385, 'Thur', 'A', 10, 0),
(386, 'Fri', 'A', 10, 0),
(387, 'Sat', 'A', 10, 0),
(388, 'Sun', 'A', 10, 0),
(389, 'Mon', 'B', 10, 0),
(390, 'Tue', 'B', 10, 0),
(391, 'Wed', 'B', 10, 0),
(392, 'Thur', 'B', 10, 0),
(393, 'Fri', 'B', 10, 0),
(394, 'Sat', 'B', 10, 0),
(395, 'Sun', 'B', 10, 0),
(396, 'Mon', 'C', 10, 0),
(397, 'Tue', 'C', 10, 0),
(398, 'Wed', 'C', 10, 0),
(399, 'Thur', 'C', 10, 0),
(400, 'Fri', 'C', 10, 0),
(401, 'Sat', 'C', 10, 0),
(402, 'Sun', 'C', 10, 0),
(403, 'Mon', 'D', 10, 0),
(404, 'Tue', 'D', 10, 0),
(405, 'Wed', 'D', 10, 0),
(406, 'Thur', 'D', 10, 0),
(407, 'Fri', 'D', 10, 0),
(408, 'Sat', 'D', 10, 0),
(409, 'Sun', 'D', 10, 0),
(410, 'Mon', 'A', 13, 0),
(411, 'Tue', 'A', 13, 0),
(412, 'Wed', 'A', 13, 0),
(413, 'Thur', 'A', 13, 0),
(414, 'Fri', 'A', 13, 0),
(415, 'Sat', 'A', 13, 0),
(416, 'Sun', 'A', 13, 0),
(417, 'Mon', 'B', 13, 0),
(418, 'Tue', 'B', 13, 0),
(419, 'Wed', 'B', 13, 0),
(420, 'Thur', 'B', 13, 0),
(421, 'Fri', 'B', 13, 0),
(422, 'Sat', 'B', 13, 0),
(423, 'Sun', 'B', 13, 0),
(424, 'Mon', 'C', 13, 0),
(425, 'Tue', 'C', 13, 0),
(426, 'Wed', 'C', 13, 0),
(427, 'Thur', 'C', 13, 0),
(428, 'Fri', 'C', 13, 0),
(429, 'Sat', 'C', 13, 0),
(430, 'Sun', 'C', 13, 0),
(431, 'Mon', 'D', 13, 0),
(432, 'Tue', 'D', 13, 0),
(433, 'Wed', 'D', 13, 0),
(434, 'Thur', 'D', 13, 0),
(435, 'Fri', 'D', 13, 0),
(436, 'Sat', 'D', 13, 0),
(437, 'Sun', 'D', 13, 0),
(438, 'Mon', 'A', 14, 0),
(439, 'Tue', 'A', 14, 0),
(440, 'Wed', 'A', 14, 0),
(441, 'Thur', 'A', 14, 0),
(442, 'Fri', 'A', 14, 0),
(443, 'Sat', 'A', 14, 0),
(444, 'Sun', 'A', 14, 0),
(445, 'Mon', 'B', 14, 0),
(446, 'Tue', 'B', 14, 0),
(447, 'Wed', 'B', 14, 0),
(448, 'Thur', 'B', 14, 0),
(449, 'Fri', 'B', 14, 0),
(450, 'Sat', 'B', 14, 0),
(451, 'Sun', 'B', 14, 0),
(452, 'Mon', 'C', 14, 0),
(453, 'Tue', 'C', 14, 0),
(454, 'Wed', 'C', 14, 0),
(455, 'Thur', 'C', 14, 0),
(456, 'Fri', 'C', 14, 0),
(457, 'Sat', 'C', 14, 0),
(458, 'Sun', 'C', 14, 0),
(459, 'Mon', 'D', 14, 0),
(460, 'Tue', 'D', 14, 0),
(461, 'Wed', 'D', 14, 0),
(462, 'Thur', 'D', 14, 0),
(463, 'Fri', 'D', 14, 0),
(464, 'Sat', 'D', 14, 0),
(465, 'Sun', 'D', 14, 0),
(466, 'Mon', 'A', 15, 0),
(467, 'Tue', 'A', 15, 0),
(468, 'Wed', 'A', 15, 0),
(469, 'Thur', 'A', 15, 0),
(470, 'Fri', 'A', 15, 0),
(471, 'Sat', 'A', 15, 0),
(472, 'Sun', 'A', 15, 0),
(473, 'Mon', 'B', 15, 0),
(474, 'Tue', 'B', 15, 0),
(475, 'Wed', 'B', 15, 0),
(476, 'Thur', 'B', 15, 0),
(477, 'Fri', 'B', 15, 0),
(478, 'Sat', 'B', 15, 0),
(479, 'Sun', 'B', 15, 0),
(480, 'Mon', 'C', 15, 0),
(481, 'Tue', 'C', 15, 0),
(482, 'Wed', 'C', 15, 0),
(483, 'Thur', 'C', 15, 0),
(484, 'Fri', 'C', 15, 0),
(485, 'Sat', 'C', 15, 0),
(486, 'Sun', 'C', 15, 0),
(487, 'Mon', 'D', 15, 0),
(488, 'Tue', 'D', 15, 0),
(489, 'Wed', 'D', 15, 0),
(490, 'Thur', 'D', 15, 0),
(491, 'Fri', 'D', 15, 0),
(492, 'Sat', 'D', 15, 0),
(493, 'Sun', 'D', 15, 0),
(494, 'Mon', 'A', 11, 0),
(495, 'Tue', 'A', 11, 0),
(496, 'Wed', 'A', 11, 0),
(497, 'Thur', 'A', 11, 0),
(498, 'Fri', 'A', 11, 0),
(499, 'Sat', 'A', 11, 0),
(500, 'Sun', 'A', 11, 0),
(501, 'Mon', 'B', 11, 0),
(502, 'Tue', 'B', 11, 0),
(503, 'Wed', 'B', 11, 0),
(504, 'Thur', 'B', 11, 0),
(505, 'Fri', 'B', 11, 0),
(506, 'Sat', 'B', 11, 0),
(507, 'Sun', 'B', 11, 0),
(508, 'Mon', 'C', 11, 0),
(509, 'Tue', 'C', 11, 0),
(510, 'Wed', 'C', 11, 0),
(511, 'Thur', 'C', 11, 0),
(512, 'Fri', 'C', 11, 0),
(513, 'Sat', 'C', 11, 0),
(514, 'Sun', 'C', 11, 0),
(515, 'Mon', 'D', 11, 0),
(516, 'Tue', 'D', 11, 0),
(517, 'Wed', 'D', 11, 0),
(518, 'Thur', 'D', 11, 0),
(519, 'Fri', 'D', 11, 0),
(520, 'Sat', 'D', 11, 0),
(521, 'Sun', 'D', 11, 0),
(660, 'Mon', 'A', 12, 0),
(661, 'Mon', 'B', 12, 0),
(662, 'Mon', 'C', 12, 0),
(663, 'Mon', 'D', 12, 0),
(664, 'Tue', 'A', 12, 0),
(665, 'Tue', 'B', 12, 0),
(666, 'Tue', 'C', 12, 0),
(667, 'Tue', 'D', 12, 0),
(668, 'Wed', 'A', 12, 0),
(669, 'Wed', 'B', 12, 0),
(670, 'Wed', 'C', 12, 0),
(671, 'Wed', 'D', 12, 0),
(672, 'Thur', 'A', 12, 0),
(673, 'Thur', 'B', 12, 0),
(674, 'Thur', 'C', 12, 0),
(675, 'Thur', 'D', 12, 0),
(676, 'Fri', 'A', 12, 0),
(677, 'Fri', 'B', 12, 0),
(678, 'Fri', 'C', 12, 0),
(679, 'Fri', 'D', 12, 0),
(680, 'Sat', 'A', 12, 0),
(681, 'Sat', 'B', 12, 0),
(682, 'Sat', 'C', 12, 0),
(683, 'Sat', 'D', 12, 0),
(684, 'Sun', 'A', 12, 0),
(685, 'Sun', 'B', 12, 0),
(686, 'Sun', 'C', 12, 0),
(687, 'Sun', 'D', 12, 0),
(688, 'Mon', 'A', 19, 0),
(689, 'Tue', 'A', 19, 0),
(690, 'Wed', 'A', 19, 0),
(691, 'Thur', 'A', 19, 0),
(692, 'Fri', 'A', 19, 0),
(693, 'Sat', 'A', 19, 0),
(694, 'Sun', 'A', 19, 0),
(695, 'Mon', 'B', 19, 0),
(696, 'Tue', 'B', 19, 0),
(697, 'Wed', 'B', 19, 0),
(698, 'Thur', 'B', 19, 0),
(699, 'Fri', 'B', 19, 0),
(700, 'Sat', 'B', 19, 0),
(701, 'Sun', 'B', 19, 0),
(702, 'Mon', 'C', 19, 0),
(703, 'Tue', 'C', 19, 0),
(704, 'Wed', 'C', 19, 0),
(705, 'Thur', 'C', 19, 0),
(706, 'Fri', 'C', 19, 0),
(707, 'Sat', 'C', 19, 0),
(708, 'Sun', 'C', 19, 0),
(709, 'Mon', 'D', 19, 0),
(710, 'Tue', 'D', 19, 0),
(711, 'Wed', 'D', 19, 0),
(712, 'Thur', 'D', 19, 0),
(713, 'Fri', 'D', 19, 0),
(714, 'Sat', 'D', 19, 0),
(715, 'Sun', 'D', 19, 0),
(716, 'Mon', 'A', 1, 0),
(717, 'Mon', 'B', 1, 0),
(718, 'Mon', 'C', 1, 0),
(719, 'Mon', 'D', 1, 0),
(720, 'Tue', 'A', 1, 0),
(721, 'Tue', 'B', 1, 1),
(722, 'Tue', 'C', 1, 0),
(723, 'Tue', 'D', 1, 0),
(724, 'Wed', 'A', 1, 0),
(725, 'Wed', 'B', 1, 0),
(726, 'Wed', 'C', 1, 1),
(727, 'Wed', 'D', 1, 0),
(728, 'Thur', 'A', 1, 0),
(729, 'Thur', 'B', 1, 0),
(730, 'Thur', 'C', 1, 0),
(731, 'Thur', 'D', 1, 0),
(732, 'Fri', 'A', 1, 1),
(733, 'Fri', 'B', 1, 0),
(734, 'Fri', 'C', 1, 0),
(735, 'Fri', 'D', 1, 0),
(736, 'Sat', 'A', 1, 0),
(737, 'Sat', 'B', 1, 0),
(738, 'Sat', 'C', 1, 0),
(739, 'Sat', 'D', 1, 0),
(740, 'Sun', 'A', 1, 0),
(741, 'Sun', 'B', 1, 0),
(742, 'Sun', 'C', 1, 0),
(743, 'Sun', 'D', 1, 0),
(744, 'Mon', 'A', 2, 0),
(745, 'Mon', 'B', 2, 0),
(746, 'Mon', 'C', 2, 0),
(747, 'Mon', 'D', 2, 0),
(748, 'Tue', 'A', 2, 0),
(749, 'Tue', 'B', 2, 0),
(750, 'Tue', 'C', 2, 0),
(751, 'Tue', 'D', 2, 0),
(752, 'Wed', 'A', 2, 0),
(753, 'Wed', 'B', 2, 0),
(754, 'Wed', 'C', 2, 0),
(755, 'Wed', 'D', 2, 0),
(756, 'Thur', 'A', 2, 0),
(757, 'Thur', 'B', 2, 0),
(758, 'Thur', 'C', 2, 0),
(759, 'Thur', 'D', 2, 0),
(760, 'Fri', 'A', 2, 0),
(761, 'Fri', 'B', 2, 0),
(762, 'Fri', 'C', 2, 0),
(763, 'Fri', 'D', 2, 0),
(764, 'Sat', 'A', 2, 0),
(765, 'Sat', 'B', 2, 0),
(766, 'Sat', 'C', 2, 0),
(767, 'Sat', 'D', 2, 0),
(768, 'Sun', 'A', 2, 0),
(769, 'Sun', 'B', 2, 0),
(770, 'Sun', 'C', 2, 0),
(771, 'Sun', 'D', 2, 0),
(772, 'Mon', 'A', 3, 0),
(773, 'Mon', 'B', 3, 0),
(774, 'Mon', 'C', 3, 0),
(775, 'Mon', 'D', 3, 0),
(776, 'Tue', 'A', 3, 0),
(777, 'Tue', 'B', 3, 0),
(778, 'Tue', 'C', 3, 0),
(779, 'Tue', 'D', 3, 0),
(780, 'Wed', 'A', 3, 0),
(781, 'Wed', 'B', 3, 0),
(782, 'Wed', 'C', 3, 0),
(783, 'Wed', 'D', 3, 0),
(784, 'Thur', 'A', 3, 0),
(785, 'Thur', 'B', 3, 0),
(786, 'Thur', 'C', 3, 0),
(787, 'Thur', 'D', 3, 0),
(788, 'Fri', 'A', 3, 0),
(789, 'Fri', 'B', 3, 0),
(790, 'Fri', 'C', 3, 0),
(791, 'Fri', 'D', 3, 0),
(792, 'Sat', 'A', 3, 0),
(793, 'Sat', 'B', 3, 0),
(794, 'Sat', 'C', 3, 0),
(795, 'Sat', 'D', 3, 0),
(796, 'Sun', 'A', 3, 0),
(797, 'Sun', 'B', 3, 0),
(798, 'Sun', 'C', 3, 0),
(799, 'Sun', 'D', 3, 0),
(800, 'Mon', 'A', 4, 0),
(801, 'Mon', 'B', 4, 0),
(802, 'Mon', 'C', 4, 0),
(803, 'Mon', 'D', 4, 0),
(804, 'Tue', 'A', 4, 0),
(805, 'Tue', 'B', 4, 0),
(806, 'Tue', 'C', 4, 0),
(807, 'Tue', 'D', 4, 0),
(808, 'Wed', 'A', 4, 0),
(809, 'Wed', 'B', 4, 0),
(810, 'Wed', 'C', 4, 0),
(811, 'Wed', 'D', 4, 0),
(812, 'Thur', 'A', 4, 0),
(813, 'Thur', 'B', 4, 0),
(814, 'Thur', 'C', 4, 0),
(815, 'Thur', 'D', 4, 0),
(816, 'Fri', 'A', 4, 0),
(817, 'Fri', 'B', 4, 0),
(818, 'Fri', 'C', 4, 0),
(819, 'Fri', 'D', 4, 0),
(820, 'Sat', 'A', 4, 0),
(821, 'Sat', 'B', 4, 0),
(822, 'Sat', 'C', 4, 0),
(823, 'Sat', 'D', 4, 0),
(824, 'Sun', 'A', 4, 0),
(825, 'Sun', 'B', 4, 0),
(826, 'Sun', 'C', 4, 0),
(827, 'Sun', 'D', 4, 0),
(828, 'Mon', 'A', 16, 0),
(829, 'Mon', 'B', 16, 0),
(830, 'Mon', 'C', 16, 0),
(831, 'Mon', 'D', 16, 0),
(832, 'Tue', 'A', 16, 0),
(833, 'Tue', 'B', 16, 0),
(834, 'Tue', 'C', 16, 0),
(835, 'Tue', 'D', 16, 0),
(836, 'Wed', 'A', 16, 0),
(837, 'Wed', 'B', 16, 0),
(838, 'Wed', 'C', 16, 0),
(839, 'Wed', 'D', 16, 0),
(840, 'Thur', 'A', 16, 0),
(841, 'Thur', 'B', 16, 0),
(842, 'Thur', 'C', 16, 0),
(843, 'Thur', 'D', 16, 0),
(844, 'Fri', 'A', 16, 0),
(845, 'Fri', 'B', 16, 0),
(846, 'Fri', 'C', 16, 0),
(847, 'Fri', 'D', 16, 0),
(848, 'Sat', 'A', 16, 0),
(849, 'Sat', 'B', 16, 0),
(850, 'Sat', 'C', 16, 0),
(851, 'Sat', 'D', 16, 0),
(852, 'Sun', 'A', 16, 0),
(853, 'Sun', 'B', 16, 0),
(854, 'Sun', 'C', 16, 0),
(855, 'Sun', 'D', 16, 0),
(856, 'Mon', 'A', 17, 0),
(857, 'Mon', 'B', 17, 0),
(858, 'Mon', 'C', 17, 0),
(859, 'Mon', 'D', 17, 0),
(860, 'Tue', 'A', 17, 0),
(861, 'Tue', 'B', 17, 0),
(862, 'Tue', 'C', 17, 0),
(863, 'Tue', 'D', 17, 0),
(864, 'Wed', 'A', 17, 0),
(865, 'Wed', 'B', 17, 0),
(866, 'Wed', 'C', 17, 0),
(867, 'Wed', 'D', 17, 0),
(868, 'Thur', 'A', 17, 0),
(869, 'Thur', 'B', 17, 0),
(870, 'Thur', 'C', 17, 0),
(871, 'Thur', 'D', 17, 0),
(872, 'Fri', 'A', 17, 0),
(873, 'Fri', 'B', 17, 0),
(874, 'Fri', 'C', 17, 0),
(875, 'Fri', 'D', 17, 0),
(876, 'Sat', 'A', 17, 0),
(877, 'Sat', 'B', 17, 0),
(878, 'Sat', 'C', 17, 0),
(879, 'Sat', 'D', 17, 0),
(880, 'Sun', 'A', 17, 0),
(881, 'Sun', 'B', 17, 0),
(882, 'Sun', 'C', 17, 0),
(883, 'Sun', 'D', 17, 0),
(884, 'Mon', 'A', 18, 0),
(885, 'Mon', 'B', 18, 0),
(886, 'Mon', 'C', 18, 0),
(887, 'Mon', 'D', 18, 0),
(888, 'Tue', 'A', 18, 0),
(889, 'Tue', 'B', 18, 0),
(890, 'Tue', 'C', 18, 0),
(891, 'Tue', 'D', 18, 0),
(892, 'Wed', 'A', 18, 0),
(893, 'Wed', 'B', 18, 0),
(894, 'Wed', 'C', 18, 0),
(895, 'Wed', 'D', 18, 0),
(896, 'Thur', 'A', 18, 0),
(897, 'Thur', 'B', 18, 0),
(898, 'Thur', 'C', 18, 0),
(899, 'Thur', 'D', 18, 0),
(900, 'Fri', 'A', 18, 0),
(901, 'Fri', 'B', 18, 0),
(902, 'Fri', 'C', 18, 0),
(903, 'Fri', 'D', 18, 0),
(904, 'Sat', 'A', 18, 0),
(905, 'Sat', 'B', 18, 0),
(906, 'Sat', 'C', 18, 0),
(907, 'Sat', 'D', 18, 0),
(908, 'Sun', 'A', 18, 0),
(909, 'Sun', 'B', 18, 0),
(910, 'Sun', 'C', 18, 0),
(911, 'Sun', 'D', 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_07_05_033946_add_columns_on_trainers_table', 1),
('2016_07_05_055519_add_columns_on_cert_table', 1),
('2016_07_05_080407_add_columns_on_students_table', 1),
('2016_07_06_080645_create_branches_table', 1),
('2016_07_07_034814_test_db_create', 1),
('2016_07_01_101822_add_received_certificate_column_on_cert_table', 2),
('2016_07_07_124230_create_students_more_register', 3),
('2016_07_08_081210_add_reminder_email_address_on_appointment', 3),
('2016_07_08_093100_add_column_sendby_and_senddate', 4),
('2016_07_11_034632_add_reminder_email_status_on_trainer_schedule', 5),
('2016_07_11_042737_rename_students_more_register_table', 6),
('2016_07_07_043514_add_course_type_column_on_courses', 7),
('2016_07_07_144308_add_branch_id_on_students_table', 7),
('2016_07_07_160130_add_columns_on_student_module_table', 7),
('2016_07_11_112948_create_column_course_id_on_modules_table', 8),
('2016_07_14_033927_add_new_column_on_course_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `public_holidays`
--

CREATE TABLE IF NOT EXISTS `public_holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reminder_template`
--

CREATE TABLE IF NOT EXISTS `reminder_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reminder_template`
--

INSERT INTO `reminder_template` (`id`, `template_name`, `template_content`) VALUES
(1, 'Reminder Students', '<p>Hi,</p><p><br></p><p>Just a reminder, you have a lesson booked on DDMMYYYY at (timing). Do remember to bring your tools and see you!</p><p><br></p><p><br></p><p>Regards,</p><p>June Tan A.I.F.D</p><p>Nobleman School of Floral Design</p><p>Blk 10 North Bridge Road #02-5107</p><p>Singapore 190010</p><p>Tel : +65-62963977</p><p>Fax: +65-62913192&nbsp;</p>'),
(2, 'Reminder Trial Students', '<p>Hi,</p><p><br></p><p>Just a reminder, you have a trial lesson booked on DDMMYYY at (timing). You do not have to bring anything as tools will be provided on loan. Just bring a heart for flowers and be excited to try out our class. See you!</p><p><br></p><p><br></p><p>Regards,</p><p>June Tan A.I.F.D</p><p>Nobleman School of Floral Design</p><p>Blk 10 North Bridge Road #02-5107</p><p>Singapore 190010</p><p>Tel : +65-62963977</p><p>Fax: +65-62913192</p>'),
(3, 'Reminder Trainers', '<p>Hi,</p><p><br></p><p>Just a reminder, you have a class to teach on DDMMYYY at (timing). See you!</p><p><br></p><p><br></p><p>Regards,</p><p>June Tan A.I.F.D</p><p>Nobleman School of Floral Design</p><p>Blk 10 North Bridge Road #02-5107</p><p>Singapore 190010</p><p>Tel : +65-62963977</p><p>Fax: +65-62913192</p>'),
(4, 'Reminder Courses Expire', '<p>Hi,</p><p><br></p><p>Just a reminder, you have a lesson expired on (timing)!</p><p><br></p><p><br></p><p>Regards,</p><p>June Tan A.I.F.D</p><p>Nobleman School of Floral Design</p><p>Blk 10 North Bridge Road #02-5107</p><p>Singapore 190010</p><p>Tel : +65-62963977</p><p>Fax: +65-62913192</p>');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `nric` varchar(16) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `mobile_contact` varchar(18) DEFAULT NULL,
  `country_code` varchar(10) NOT NULL,
  `residential_contact` varchar(16) NOT NULL,
  `local_address` varchar(128) DEFAULT NULL,
  `unit_no` varchar(16) NOT NULL,
  `street_name` varchar(128) NOT NULL,
  `apartment_name` varchar(128) DEFAULT NULL,
  `postal_code` varchar(12) NOT NULL,
  `occupation` varchar(128) NOT NULL,
  `intro_lesson` varchar(10) NOT NULL,
  `floral_related` int(11) NOT NULL DEFAULT '0',
  `education` varchar(128) NOT NULL,
  `emergency_contact_person` varchar(225) NOT NULL,
  `emergency_contact_number` varchar(225) NOT NULL,
  `sponsorship` varchar(128) NOT NULL DEFAULT '0',
  `doby` varchar(255) NOT NULL,
  `dobm` varchar(255) NOT NULL,
  `dobd` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(75) DEFAULT NULL,
  `position` varchar(60) DEFAULT NULL,
  `gender` varchar(12) DEFAULT NULL,
  `nationality` varchar(128) DEFAULT NULL,
  `race` varchar(128) DEFAULT NULL,
  `payment_mode` varchar(20) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `date_of_payment` varchar(20) NOT NULL,
  `payment_note` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(128) NOT NULL,
  `supervisor` int(11) NOT NULL DEFAULT '0',
  `company_name` varchar(100) NOT NULL,
  `contact_person` varchar(30) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `company_address` varchar(150) NOT NULL,
  `company_postalcode` int(11) NOT NULL,
  `company_contact_no` int(11) NOT NULL,
  `company_fax` int(11) NOT NULL,
  `company_email` varchar(30) NOT NULL,
  `company_website` varchar(30) NOT NULL,
  `oversea_address` varchar(150) NOT NULL,
  `foreign_student` varchar(20) NOT NULL,
  `oversea_zipcode` int(11) NOT NULL,
  `oversea_contact` int(11) NOT NULL,
  `module_apply` varchar(50) NOT NULL,
  `module_code` varchar(30) NOT NULL,
  `module_type` varchar(20) NOT NULL,
  `module_fee` varchar(30) NOT NULL,
  `material` varchar(20) NOT NULL,
  `total_no_lesson` int(11) NOT NULL,
  `total_training_hour` varchar(10) NOT NULL,
  `module_duration` int(11) NOT NULL,
  `commencement_date` varchar(10) NOT NULL,
  `ecd` varchar(10) NOT NULL,
  `exp_flower_design` varchar(20) NOT NULL,
  `exp_detail` varchar(255) NOT NULL,
  `enrollment_reason` varchar(30) NOT NULL,
  `internet_site` varchar(50) NOT NULL,
  `news_directory` varchar(50) NOT NULL,
  `magazine` varchar(50) NOT NULL,
  `friend_company` varchar(50) NOT NULL,
  `others` varchar(50) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `payment_receive_by` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned DEFAULT NULL,
  `nobleman_student_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `profile_picture`, `nric`, `name`, `email`, `password`, `mobile_contact`, `country_code`, `residential_contact`, `local_address`, `unit_no`, `street_name`, `apartment_name`, `postal_code`, `occupation`, `intro_lesson`, `floral_related`, `education`, `emergency_contact_person`, `emergency_contact_number`, `sponsorship`, `doby`, `dobm`, `dobd`, `age`, `country`, `position`, `gender`, `nationality`, `race`, `payment_mode`, `payment_status`, `date_of_payment`, `payment_note`, `created_at`, `updated_at`, `updated_by`, `status`, `remember_token`, `supervisor`, `company_name`, `contact_person`, `designation`, `company_address`, `company_postalcode`, `company_contact_no`, `company_fax`, `company_email`, `company_website`, `oversea_address`, `foreign_student`, `oversea_zipcode`, `oversea_contact`, `module_apply`, `module_code`, `module_type`, `module_fee`, `material`, `total_no_lesson`, `total_training_hour`, `module_duration`, `commencement_date`, `ecd`, `exp_flower_design`, `exp_detail`, `enrollment_reason`, `internet_site`, `news_directory`, `magazine`, `friend_company`, `others`, `invoice_number`, `receipt_number`, `payment_receive_by`, `branch_id`, `nobleman_student_id`) VALUES
(30, 91, '1474534509.jpg', '2342423', 'Kalayar', 'kalayar@gmail.com', '$2y$10$.pCp.EIyUZtj5nnn4OnRV.LaVA4facHbURUq1Q6LTPYqjCyQMEpry', '4234234234', '+65', '', '234234', '', '', '', '', '', '', 0, 'University', 'ere', '2323223', 'Yes', '1990', '01', '01', 0, NULL, NULL, 'Female', 'Singaporean', 'Chinese', '', 0, '', '', '2016-09-14 05:33:12', '2016-09-22 04:55:08', 56, 1, '', 0, '', '', '', '', 0, 0, 0, '', '', '', 'Yes', 0, 0, '', '', '', '', '', 0, '', 0, '', '', 'Not at All', '', 'Interest', 'Google', 'Strait-Time', '', '', '', '', '', 0, 1, 'S011628001030'),
(32, 93, 'default-img-200x200.png', '2342423', 'Peter', 'peter@gmail.com', '$2y$10$6qZYNLTOoNg/PaCGqsuWw.loEoO0Rb35pFv5fYs748bbnA65eQ/Z.', '4234234234', '', '', '234234', '', '', '', '', '', '', 0, 'University', 'ere', '2323223', 'No', '1990', '01', '01', 0, NULL, NULL, 'Male', 'Singaporean', 'Chinese', '', 0, '', 'paid', '2016-02-14 12:01:35', '2016-09-22 04:54:50', 56, 1, '', 0, '', '', '', '', 0, 0, 0, '', '', '', 'Yes', 0, 0, '', '', '', '', '', 0, '', 0, '', '', 'Not at All', '', 'Interest', 'Google', 'Strait-Time', '', '', '', '', '', 0, 1, 'S011638001032'),
(35, 113, '1473051939.jpg', '32353453', 'PP', 'pp@gmail.com', '$2y$10$0mjAcRuO./jsdQcjnyQ.zO4iELu0u/oOI7MUmQwZHytYGGOajc0pq', '24234243242', '', '', 'Singapore', '', '', '', '', '', 'Yes', 0, 'University', 'wrwe', '2243242342', 'No', '1990', '01', '01', 0, NULL, NULL, 'Female', 'Singaporean', 'Chinese', '', 0, '', '', '2016-09-14 03:33:20', '2016-09-23 01:19:03', 56, 1, '', 0, '', '', '', '', 0, 0, 0, '', '', '', 'No', 0, 0, '', '', '', '', '', 0, '', 0, '', '', 'Not at All', '', 'Interest', 'Google', 'Strait-Time', '', '', '', '', '', 56, 1, 'S021636001035'),
(36, 114, '1474604681.jpg', '32353453', 'Alice', 'alicebiber19901@gmail.com', '', '24234243242', '', '', 'Singapore', '', 'Sims', '', '', '', 'No', 0, 'University', 'Miss Lynn', '2243242342', 'No', '1990', '01', '01', 0, NULL, NULL, 'Female', 'Singaporean', 'Chinese', '', 0, '', '', '2016-09-23 12:22:57', '2016-09-23 12:24:40', 56, 0, '', 0, '', '', '', '', 0, 0, 0, '', '', '', 'Yes', 0, 0, '', '', '', '', '', 0, '', 0, '', '', 'Not at All', '', 'Interest', 'Google', 'Strait-Time', '', '', '', '', '', 56, 1, 'S011638001036');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE IF NOT EXISTS `student_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date_of_registration` date NOT NULL,
  `date_of_commencement` date NOT NULL,
  `date_of_completion` date NOT NULL,
  `date_of_payment` date NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `payment_note` text NOT NULL,
  `transaction_code` varchar(50) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_receive_by` int(10) unsigned NOT NULL,
  `sm_payment_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `student_id`, `course_id`, `status`, `date_of_registration`, `date_of_commencement`, `date_of_completion`, `date_of_payment`, `invoice_number`, `receipt_number`, `payment_note`, `transaction_code`, `payment_mode`, `payment_receive_by`, `sm_payment_status`) VALUES
(30, '32', '6', 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, 0),
(35, '30', '6', 0, '0000-00-00', '2016-07-14', '2016-07-14', '2016-09-01', '13212', '1212', 'lsrtr jfsdfs', '5555', 'Direct Payment', 56, 1),
(36, '30', '5', 0, '2016-07-14', '2016-07-15', '0000-00-00', '0000-00-00', '', '', '', '', 'Bank Transfer', 56, 0),
(37, '30', '8', 0, '2016-07-14', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '32234234', 'Direct Payment', 0, 1),
(40, '35', '10', 0, '2016-09-06', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '', 'Bank Transfer', 0, 1),
(41, '36', '7', 0, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', '', 'Bank Transfer', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_course_register`
--

CREATE TABLE IF NOT EXISTS `student_course_register` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `std_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_course_register`
--

INSERT INTO `student_course_register` (`id`, `std_id`, `module_id`, `payment_mode`, `status`, `created_at`, `updated_at`) VALUES
(1, 91, 5, 'Bank Transfer', 0, '2016-07-10 20:58:32', '2016-07-10 20:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE IF NOT EXISTS `supervisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `period_start`, `period_end`, `active`) VALUES
(11, '2015-01-01', '2015-12-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE IF NOT EXISTS `trainers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `trainer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `nric` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `trainer_note` text NOT NULL,
  `joining_date` date NOT NULL,
  `date_of_birth` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `user_id`, `trainer_name`, `email`, `contact`, `status`, `created_at`, `updated_at`, `updated_by`, `profile_picture`, `nric`, `address`, `trainer_note`, `joining_date`, `date_of_birth`) VALUES
(2, 64, 'trainer', 'trainer@gmail.com', '34534535', '1', '2016-09-20 11:36:19', '2016-09-20 11:36:19', '56', '1474342580.tmp', '', '', '', '0000-00-00', '0000-00-00'),
(3, 96, 'WangLynn', 'wanglynn@hotmail.com', '34433434', '1', '2016-09-20 04:57:59', '2016-09-20 04:57:59', '56', '1474361880.tmp', '', '', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_schedule`
--

CREATE TABLE IF NOT EXISTS `trainer_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trainer_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `date` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reminder_email_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sendby` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senddate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `trainer_schedule`
--

INSERT INTO `trainer_schedule` (`id`, `trainer_id`, `course_id`, `lesson_id`, `date`, `session`, `reminder_email_status`, `sendby`, `senddate`) VALUES
(24, 64, 6, 8, '2016-09-15', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_schedule_session`
--

CREATE TABLE IF NOT EXISTS `trainer_schedule_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trainer_schedule_id` int(11) NOT NULL,
  `session` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `trainer_schedule_session`
--

INSERT INTO `trainer_schedule_session` (`id`, `trainer_schedule_id`, `session`) VALUES
(22, 24, '10am - 12pm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show_id` varchar(32) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `role` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `show_id`, `email`, `password`, `created_at`, `updated_at`, `updated_by`, `role`, `status`, `remember_token`) VALUES
(56, 'admin', 'admin@gmail.com', '$2y$10$uyIJtpXkxRi38efnDazdRuvUW4/W9TmxHaxCQAnoCaejBUio8MP1K', '2015-12-08 01:33:31', '2016-10-29 09:03:12', 0, 1, 1, '7C16amieExEl1n1rIQLAa0scNlmIxtIuT0gkTtToqLPOh7o6wrBFyUQ9rvSV'),
(64, 'trainer', 'trainer@gmail.com', '$2y$10$uyIJtpXkxRi38efnDazdRuvUW4/W9TmxHaxCQAnoCaejBUio8MP1K', '2016-01-16 12:21:53', '2016-09-23 05:14:04', 29, 2, 1, 'F3ldozfT7ZXVGZWAMcZPudZ21n16LPOIYEYSmbMGOxA7g1GTeMkd3MXpLWVh'),
(91, 'Kalayar', 'kalayar@gmail.com', '$2y$10$bZj49UvRwJiAcRlEPY6NtunZGz8hG4ZSGIEZbyrT1SqdMZdXEq92a', '2016-02-13 11:43:14', '2016-09-23 06:55:06', 56, 3, 1, '45wktWhL8RRVHoJ4QstxzgwbNxLG2SYCK2S9SXL5xQqWk9p7D5RMKae811Gi'),
(93, 'Peter', 'peter@gmail.com', '$2y$10$8KL1OYw7OIQAlV/xqy72YOoVneorVZQlKD3HZDJZE0fQ8q6Yc1rl.', '2016-02-13 11:59:54', '2016-02-13 16:07:35', 56, 3, 1, 'xlUXbdSEtrBpIcynrXhHiG7WyS1JHLbYmpyiZgRRFDZREhOQPVp4XoBFvMTs'),
(96, 'WangLynn', 'wanglynn@hotmail.com', '$2y$10$LeD/K7S9mdJgZHZVNxJtUeUUzrbC3R5z4IXMZOvRgvwuSnXVThrB6', '2016-04-30 10:57:56', '2016-05-06 03:20:30', 56, 2, 1, 'xH78dubQQgHa9D1f2LN6XjzVPMFDZdtRNJzMDbhUZLtWRmMsdx84AChqNMUh'),
(107, 'Alice', 'alice11@gmail.com', '$2y$10$V5ogAsq6QD8yu7fbciZ2wODRb1s9ZQLcVLO7tUuAuEqQDM9GsfdRq', '2016-07-14 03:51:37', '2016-07-14 03:51:37', 56, 2, 1, ''),
(109, 'KL', 'kl@gmail.com', '', '2016-08-31 06:10:25', '2016-08-31 06:10:25', 56, 3, 0, ''),
(110, 'KL', 'kl11@gmail.com', '', '2016-08-31 06:14:57', '2016-08-31 06:14:57', 56, 3, 0, ''),
(113, 'PP', 'pp@gmail.com', '$2y$10$VyzuToEwzpS1QrXM.bBHreAK8ANjtnm5/bFGay6KvBKqwX6aKUUoi', '2016-09-05 01:05:39', '2016-09-06 09:31:12', 56, 3, 1, ''),
(114, 'Alice', 'alicebiber19901@gmail.com', '', '2016-09-23 12:22:57', '2016-09-23 12:22:57', 56, 3, 0, ''),
(115, 'Hovaness Shim', 'ssh_autumnsky@yahoo.com', '', '2016-10-29 04:18:45', '2016-10-29 04:18:45', 56, 3, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Instructor'),
(3, 'Student');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
