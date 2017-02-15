-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2017 at 07:24 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jempolasik`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ads_id` smallint(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `ads_place_id` smallint(5) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `extension` varchar(50) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `expired` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ads_id`, `title`, `ads_place_id`, `file`, `extension`, `url`, `expired`, `status`) VALUES
(1, 'asd', 4, 'uploads/image/ads/adsbanner_160313060623.jpg', 'jpg', 'asd', '2016-04-03', 'publish'),
(3, 'ads', 3, 'uploads/image/ads/adsbanner2_160313054920.jpg', 'jpg', 'ads', '2016-03-19', 'publish'),
(4, 'google', 1, 'uploads/image/ads/adsbanner_160313065511.jpg', 'jpg', 'http://google.com', '2016-03-12', 'publish'),
(5, 'kaskus', 2, 'uploads/image/ads/adsbanner2_160313065902.jpg', 'jpg', 'http://kaskus.co.id', '2016-03-27', 'publish'),
(6, 'kaskus', 1, 'uploads/image/ads/adsbanner2_160313070106.jpg', 'jpg', 'http://kaskus.co.id', '2016-04-03', 'publish'),
(7, 'gmail', 2, 'uploads/image/ads/adsbanner_160313070208.jpg', 'jpg', 'https://gmail.com', '2016-04-03', 'publish'),
(8, 'detik', 3, 'uploads/image/ads/adsbanner2_160313070345.jpg', 'jpg', 'http://detik.com', '2016-03-27', 'publish'),
(9, 'okezone.com', 4, 'uploads/image/ads/adsbanner2_160313070432.jpg', 'jpg', 'http://okezone.com', '2016-04-03', 'publish'),
(10, 'kaskus', 5, 'uploads/image/ads/adsbanner_160316010620.jpg', 'jpg', 'http://kaskus.co.id', '2016-04-03', 'publish'),
(11, 'popup', 6, 'uploads/image/ads/pop-up_160321035921.jpg', 'jpg', '#', '2016-04-03', 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `ads_place`
--

CREATE TABLE `ads_place` (
  `ads_place_id` smallint(5) NOT NULL,
  `place_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads_place`
--

INSERT INTO `ads_place` (`ads_place_id`, `place_name`) VALUES
(1, 'Top Home'),
(2, 'Bottom Home'),
(3, 'Bottom Gallery'),
(4, 'Bottom Event'),
(5, 'Footer Page'),
(6, 'Home Popup');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` smallint(5) NOT NULL,
  `banner_page_id` smallint(5) NOT NULL,
  `banner_category_id` smallint(5) NOT NULL,
  `banner_size_id` smallint(5) NOT NULL,
  `banner_name` varchar(50) NOT NULL,
  `banner_caption` varchar(200) NOT NULL,
  `banner_url` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_page_id`, `banner_category_id`, `banner_size_id`, `banner_name`, `banner_caption`, `banner_url`, `file`, `extention`, `author`) VALUES
(1, 1, 1, 1, 'Banner 3', '', '', 'uploads/image/banners/12_160114070350.jpg', 'jpg', 27),
(2, 1, 1, 1, 'Banner 2', '<p>.</p>\r\n', '', 'uploads/image/banners/11_160114070341.jpg', 'jpg', 27),
(3, 1, 1, 1, 'Banner 1', '', '', 'uploads/image/banners/1_160114070332.jpg', 'jpg', 27);

-- --------------------------------------------------------

--
-- Table structure for table `banner_category`
--

CREATE TABLE `banner_category` (
  `banner_category_id` smallint(5) NOT NULL,
  `page_id` smallint(5) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_category`
--

INSERT INTO `banner_category` (`banner_category_id`, `page_id`, `category_name`) VALUES
(1, 1, 'Hero Banner'),
(2, 2, 'Static Banner'),
(3, 3, 'Static Banner'),
(4, 4, 'Static Banner'),
(5, 5, 'Static Banner'),
(6, 6, 'Static Banner');

-- --------------------------------------------------------

--
-- Table structure for table `banner_size`
--

CREATE TABLE `banner_size` (
  `banner_size_id` smallint(5) NOT NULL,
  `banner_category_id` smallint(5) NOT NULL,
  `size` varchar(50) NOT NULL,
  `size_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_size`
--

INSERT INTO `banner_size` (`banner_size_id`, `banner_category_id`, `size`, `size_name`) VALUES
(1, 1, '1606x508', '1606 x 508 (Slideshow)'),
(2, 2, '1606x508', '1606 x 508 (Slideshow)'),
(3, 3, '1606x508', '1606 x 508 (Slideshow)'),
(4, 4, '1606x508', '1606 x 508 (Slideshow)'),
(5, 5, '1606x508', '1606 x 508 (Slideshow)'),
(6, 6, '1606x508', '1606 x 508 (Slideshow)');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` smallint(5) NOT NULL,
  `blog_category_id` smallint(5) DEFAULT NULL,
  `page_id` smallint(5) NOT NULL,
  `status` enum('draft','publish') NOT NULL,
  `filetype` enum('image','pdf','youtube') NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `extention` varchar(30) DEFAULT NULL,
  `youtube_id` varchar(255) DEFAULT NULL,
  `view` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_category_id`, `page_id`, `status`, `filetype`, `file`, `extention`, `youtube_id`, `view`, `create_date`, `author`) VALUES
(1, 65, 2, 'publish', 'image', 'uploads/image/blog/azimut50_160115095803.jpg', 'jpg', NULL, 0, '2016-01-15 20:58:03', 27),
(2, 65, 2, 'publish', 'image', 'uploads/image/blog/Felicia_160115095831.jpg', 'jpg', NULL, 0, '2016-01-15 21:08:34', 27),
(3, 65, 2, 'publish', 'image', 'uploads/image/blog/uhuuh_160218082311.jpg', 'jpg', NULL, 0, '2016-02-18 19:23:11', 27);

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `blog_category_id` smallint(5) NOT NULL,
  `page_id` smallint(5) NOT NULL,
  `blog_category_name` varchar(100) NOT NULL,
  `blog_category_desc` text NOT NULL,
  `order_no` smallint(2) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`blog_category_id`, `page_id`, `blog_category_name`, `blog_category_desc`, `order_no`, `create_date`, `author`) VALUES
(65, 2, 'Default', '', 0, '2016-01-13 07:11:26', 27);

-- --------------------------------------------------------

--
-- Table structure for table `blog_child_category`
--

CREATE TABLE `blog_child_category` (
  `child_category_id` smallint(5) NOT NULL,
  `category_id` smallint(5) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_image_size`
--

CREATE TABLE `blog_image_size` (
  `blog_size_id` int(11) NOT NULL,
  `category_id` smallint(5) NOT NULL,
  `size` varchar(30) NOT NULL,
  `size_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_image_size`
--

INSERT INTO `blog_image_size` (`blog_size_id`, `category_id`, `size`, `size_name`) VALUES
(24, 44, '847x470', '(847x470) px - Top'),
(25, 45, '847x470', '(847x470) px - Top'),
(26, 46, '847x470', '(847x470) px - Top'),
(27, 47, '847x470', '(847x470) px - Top'),
(29, 53, '847x470', '(847x470) px - Top'),
(30, 2, '847x470', '(847x470) px - Top'),
(40, 65, '847x470', '(847x470) px - Top');

-- --------------------------------------------------------

--
-- Table structure for table `blog_static`
--

CREATE TABLE `blog_static` (
  `blog_id` smallint(5) NOT NULL,
  `blog_category_id` smallint(5) NOT NULL,
  `status` enum('draft','publish') NOT NULL,
  `filetype` enum('image','pdf','youtube') NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `extention` varchar(30) DEFAULT NULL,
  `youtube_id` varchar(255) DEFAULT NULL,
  `view` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_static`
--

INSERT INTO `blog_static` (`blog_id`, `blog_category_id`, `status`, `filetype`, `file`, `extention`, `youtube_id`, `view`, `create_date`, `author`) VALUES
(1, 1, 'publish', 'image', '', '', NULL, 0, '2015-11-21 08:53:23', 27),
(2, 2, 'draft', 'image', '', '', NULL, 0, '2015-11-22 13:44:58', 27),
(3, 3, 'draft', 'image', '', '', NULL, 0, '2015-11-23 04:13:18', 27),
(4, 4, 'draft', 'image', 'uploads/image/blog/8_151119035813.jpg', 'jpg', NULL, 0, '2015-11-19 14:58:13', 27),
(5, 5, 'draft', 'image', 'uploads/image/blog/blog1_151123051453.jpg', 'jpg', NULL, 0, '2015-11-23 04:14:53', 27),
(6, 6, 'draft', 'image', 'uploads/image/blog/blog1_151123051551.jpg', 'jpg', NULL, 0, '2015-11-23 04:15:52', 27);

-- --------------------------------------------------------

--
-- Table structure for table `blog_static_category`
--

CREATE TABLE `blog_static_category` (
  `blog_category_id` smallint(5) NOT NULL,
  `page_id` smallint(5) NOT NULL,
  `blog_category_name` varchar(100) NOT NULL,
  `order_no` smallint(2) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_static_category`
--

INSERT INTO `blog_static_category` (`blog_category_id`, `page_id`, `blog_category_name`, `order_no`, `create_date`, `author`) VALUES
(1, 5, 'Single Page', 1, '2015-11-19 09:46:18', 1),
(2, 6, 'About', 0, '2015-11-19 10:16:38', 1),
(3, 6, 'Help', 0, '2015-11-19 10:16:41', 1),
(4, 6, 'Developers', 0, '2015-11-19 10:22:43', 1),
(5, 6, 'Terms', 0, '2015-11-19 10:22:46', 1),
(6, 6, 'Privacy', 0, '2015-11-19 10:22:48', 1),
(37, 4, 'dasdas55', 0, '2015-11-19 07:29:13', 27),
(38, 5, 'Default', 0, '2015-11-19 07:31:45', 0),
(39, 6, 'Privacy', 0, '2015-11-19 08:04:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('3ad5c52cdd134ec1d467cd64d8f28a83', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 1477663494, ''),
('c383a84aabab94fd1fe660cd67ac017c', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 1462251450, '');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` smallint(3) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `file`, `extention`, `date`, `author`) VALUES
(2, 'Cakra Tunggal', 'uploads/image/client/cakra-tunggal-steel_160112083546.png', 'png', '2016-01-12 19:35:46', 27),
(3, 'Hotel Santika', 'uploads/image/client/hotel-santika_160112083608.png', 'png', '2016-01-12 19:36:08', 27),
(4, 'Mpti', 'uploads/image/client/mpti_160112083614.png', 'png', '2016-01-12 19:36:14', 27);

-- --------------------------------------------------------

--
-- Table structure for table `contact_message`
--

CREATE TABLE `contact_message` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_message`
--

INSERT INTO `contact_message` (`contact_id`, `name`, `email`, `subject`, `message`, `send_date`, `status`) VALUES
(5, 'Hilmy Syarif', 'hilmysyarif@gmail.com', 'aaaaaaaa', 'aaaa', '2016-03-24 08:35:08', ''),
(6, 'Hilmy Syarif', 'hilmysyarif@gmail.com', 'test', 'test message', '2016-03-24 08:36:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL,
  `countries_idx` varchar(20) NOT NULL,
  `countries_name` varchar(100) NOT NULL,
  `countries_name_flag` varchar(100) NOT NULL,
  `file` varchar(200) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `active` enum('no','yes') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `countries_idx`, `countries_name`, `countries_name_flag`, `file`, `extention`, `active`) VALUES
(1, 'AED', 'United Arab Emirates Dirham (AED)', '', '', '', 'no'),
(2, 'AFN', 'Afghan Afghani (AFN)', '', '', '', 'no'),
(3, 'ALL', 'Albanian Lek (ALL)', '', '', '', 'no'),
(4, 'AMD', 'Armenian Dram (AMD)', '', '', '', 'no'),
(5, 'ANG', 'Netherlands Antillean Guilder (ANG)', '', '', '', 'no'),
(6, 'AOA', 'Angolan Kwanza (AOA)', '', '', '', 'no'),
(7, 'ARS', 'Argentine Peso (ARS)', '', '', '', 'no'),
(8, 'AUD', 'Australian Dollar (A$)', 'Australian', '', '', 'no'),
(9, 'AWG', 'Aruban Florin (AWG)', '', '', '', 'no'),
(10, 'AZN', 'Azerbaijani Manat (AZN)', '', '', '', 'no'),
(11, 'BAM', 'Bosnia-Herzegovina Convertible Mark (BAM)', '', '', '', 'no'),
(12, 'BBD', 'Barbadian Dollar (BBD)', '', '', '', 'no'),
(13, 'BDT', 'Bangladeshi Taka (BDT)', '', '', '', 'no'),
(14, 'BGN', 'Bulgarian Lev (BGN)', '', '', '', 'no'),
(15, 'BHD', 'Bahraini Dinar (BHD)', '', '', '', 'no'),
(16, 'BIF', 'Burundian Franc (BIF)', '', '', '', 'no'),
(17, 'BMD', 'Bermudan Dollar (BMD)', '', '', '', 'no'),
(18, 'BND', 'Brunei Dollar (BND)', '', '', '', 'no'),
(19, 'BOB', 'Bolivian Boliviano (BOB)', '', '', '', 'no'),
(20, 'BRL', 'Brazilian Real (R$)', '', '', '', 'no'),
(21, 'BSD', 'Bahamian Dollar (BSD)', '', '', '', 'no'),
(22, 'BTN', 'Bhutanese Ngultrum (BTN)', '', '', '', 'no'),
(23, 'BWP', 'Botswanan Pula (BWP)', '', '', '', 'no'),
(24, 'BYR', 'Belarusian Ruble (BYR)', '', '', '', 'no'),
(25, 'BZD', 'Belize Dollar (BZD)', '', '', '', 'no'),
(26, 'CAD', 'Canadian Dollar (CA$)', '', '', '', 'no'),
(27, 'CDF', 'Congolese Franc (CDF)', '', '', '', 'no'),
(28, 'CHF', 'Swiss Franc (CHF)', '', '', '', 'no'),
(29, 'CLF', 'Chilean Unit of Account (UF) (CLF)', '', '', '', 'no'),
(30, 'CLP', 'Chilean Peso (CLP)', '', '', '', 'no'),
(31, 'CNH', 'CNH (CNH)', '', '', '', 'no'),
(32, 'CNY', 'Chinese Yuan (CN?)', '', '', '', 'no'),
(33, 'COP', 'Colombian Peso (COP)', '', '', '', 'no'),
(34, 'CRC', 'Costa Rican Col?n (CRC)', '', '', '', 'no'),
(35, 'CUP', 'Cuban Peso (CUP)', '', '', '', 'no'),
(36, 'CVE', 'Cape Verdean Escudo (CVE)', '', '', '', 'no'),
(37, 'CZK', 'Czech Republic Koruna (CZK)', '', '', '', 'no'),
(38, 'DEM', 'German Mark (DEM)', '', '', '', 'no'),
(39, 'DJF', 'Djiboutian Franc (DJF)', '', '', '', 'no'),
(40, 'DKK', 'Danish Krone (DKK)', '', '', '', 'no'),
(41, 'DOP', 'Dominican Peso (DOP)', '', '', '', 'no'),
(42, 'DZD', 'Algerian Dinar (DZD)', '', '', '', 'no'),
(43, 'EGP', 'Egyptian Pound (EGP)', '', '', '', 'no'),
(44, 'ERN', 'Eritrean Nakfa (ERN)', '', '', '', 'no'),
(45, 'ETB', 'Ethiopian Birr (ETB)', '', '', '', 'no'),
(46, 'EUR', 'Euro (?)', '', '', '', 'no'),
(47, 'FIM', 'Finnish Markka (FIM)', '', '', '', 'no'),
(48, 'FJD', 'Fijian Dollar (FJD)', '', '', '', 'no'),
(49, 'FKP', 'Falkland Islands Pound (FKP)', '', '', '', 'no'),
(50, 'FRF', 'French Franc (FRF)', '', '', '', 'no'),
(51, 'GBP', 'British Pound Sterling', 'English', 'uploads/image/lang/en_151110123506.png', 'png', 'no'),
(52, 'GEL', 'Georgian Lari (GEL)', '', '', '', 'no'),
(53, 'GHS', 'Ghanaian Cedi (GHS)', '', '', '', 'no'),
(54, 'GIP', 'Gibraltar Pound (GIP)', '', '', '', 'no'),
(55, 'GMD', 'Gambian Dalasi (GMD)', '', '', '', 'no'),
(56, 'GNF', 'Guinean Franc (GNF)', '', '', '', 'no'),
(57, 'GTQ', 'Guatemalan Quetzal (GTQ)', '', '', '', 'no'),
(58, 'GYD', 'Guyanaese Dollar (GYD)', '', '', '', 'no'),
(59, 'HKD', 'Hong Kong Dollar (HK$)', '', '', '', 'no'),
(60, 'HNL', 'Honduran Lempira (HNL)', '', '', '', 'no'),
(61, 'HRK', 'Croatian Kuna (HRK)', '', '', '', 'no'),
(62, 'HTG', 'Haitian Gourde (HTG)', '', '', '', 'no'),
(63, 'HUF', 'Hungarian Forint (HUF)', '', '', '', 'no'),
(64, 'IDR', 'Indonesian Rupiah (IDR)', 'Indonesian', 'uploads/image/lang/id_151110122934.png', 'png', 'yes'),
(65, 'IEP', 'Irish Pound (IEP)', '', '', '', 'no'),
(66, 'ILS', 'Israeli New Sheqel (?)', '', '', '', 'no'),
(67, 'INR', 'Indian Rupee (Rs.)', '', '', '', 'no'),
(68, 'IQD', 'Iraqi Dinar (IQD)', '', '', '', 'no'),
(69, 'IRR', 'Iranian Rial (IRR)', '', '', '', 'no'),
(70, 'ISK', 'Icelandic Kr?na (ISK)', '', '', '', 'no'),
(71, 'ITL', 'Italian Lira (ITL)', '', '', '', 'no'),
(72, 'JMD', 'Jamaican Dollar (JMD)', '', '', '', 'no'),
(73, 'JOD', 'Jordanian Dinar (JOD)', '', '', '', 'no'),
(74, 'JPY', 'Japanese Yen (?)', '', '', '', 'no'),
(75, 'KES', 'Kenyan Shilling (KES)', '', '', '', 'no'),
(76, 'KGS', 'Kyrgystani Som (KGS)', '', '', '', 'no'),
(77, 'KHR', 'Cambodian Riel (KHR)', '', '', '', 'no'),
(78, 'KMF', 'Comorian Franc (KMF)', '', '', '', 'no'),
(79, 'KPW', 'North Korean Won (KPW)', '', '', '', 'no'),
(80, 'KRW', 'South Korean Won (?)', '', '', '', 'no'),
(81, 'KWD', 'Kuwaiti Dinar (KWD)', '', '', '', 'no'),
(82, 'KYD', 'Cayman Islands Dollar (KYD)', '', '', '', 'no'),
(83, 'KZT', 'Kazakhstani Tenge (KZT)', '', '', '', 'no'),
(84, 'LAK', 'Laotian Kip (LAK)', '', '', '', 'no'),
(85, 'LBP', 'Lebanese Pound (LBP)', '', '', '', 'no'),
(86, 'LKR', 'Sri Lankan Rupee (LKR)', '', '', '', 'no'),
(87, 'LRD', 'Liberian Dollar (LRD)', '', '', '', 'no'),
(88, 'LSL', 'Lesotho Loti (LSL)', '', '', '', 'no'),
(89, 'LTL', 'Lithuanian Litas (LTL)', '', '', '', 'no'),
(90, 'LVL', 'Latvian Lats (LVL)', '', '', '', 'no'),
(91, 'LYD', 'Libyan Dinar (LYD)', '', '', '', 'no'),
(92, 'MAD', 'Moroccan Dirham (MAD)', '', '', '', 'no'),
(93, 'MDL', 'Moldovan Leu (MDL)', '', '', '', 'no'),
(94, 'MGA', 'Malagasy Ariary (MGA)', '', '', '', 'no'),
(95, 'MKD', 'Macedonian Denar (MKD)', '', '', '', 'no'),
(96, 'MMK', 'Myanma Kyat (MMK)', '', '', '', 'no'),
(97, 'MNT', 'Mongolian Tugrik (MNT)', '', '', '', 'no'),
(98, 'MOP', 'Macanese Pataca (MOP)', '', '', '', 'no'),
(99, 'MRO', 'Mauritanian Ouguiya (MRO)', '', '', '', 'no'),
(100, 'MUR', 'Mauritian Rupee (MUR)', '', '', '', 'no'),
(101, 'MVR', 'Maldivian Rufiyaa (MVR)', '', '', '', 'no'),
(102, 'MWK', 'Malawian Kwacha (MWK)', '', '', '', 'no'),
(103, 'MXN', 'Mexican Peso (MX$)', '', '', '', 'no'),
(104, 'MYR', 'Malaysian Ringgit (MYR)', '', '', '', 'no'),
(105, 'MZN', 'Mozambican Metical (MZN)', '', '', '', 'no'),
(106, 'NAD', 'Namibian Dollar (NAD)', '', '', '', 'no'),
(107, 'NGN', 'Nigerian Naira (NGN)', '', '', '', 'no'),
(108, 'NIO', 'Nicaraguan C?rdoba (NIO)', '', '', '', 'no'),
(109, 'NOK', 'Norwegian Krone (NOK)', '', '', '', 'no'),
(110, 'NPR', 'Nepalese Rupee (NPR)', '', '', '', 'no'),
(111, 'NZD', 'New Zealand Dollar (NZ$)', '', '', '', 'no'),
(112, 'OMR', 'Omani Rial (OMR)', '', '', '', 'no'),
(113, 'PAB', 'Panamanian Balboa (PAB)', '', '', '', 'no'),
(114, 'PEN', 'Peruvian Nuevo Sol (PEN)', '', '', '', 'no'),
(115, 'PGK', 'Papua New Guinean Kina (PGK)', '', '', '', 'no'),
(116, 'PHP', 'Philippine Peso (Php)', '', '', '', 'no'),
(117, 'PKG', 'PKG (PKG)', '', '', '', 'no'),
(118, 'PKR', 'Pakistani Rupee (PKR)', '', '', '', 'no'),
(119, 'PLN', 'Polish Zloty (PLN)', '', '', '', 'no'),
(120, 'PYG', 'Paraguayan Guarani (PYG)', '', '', '', 'no'),
(121, 'QAR', 'Qatari Rial (QAR)', '', '', '', 'no'),
(122, 'RON', 'Romanian Leu (RON)', '', '', '', 'no'),
(123, 'RSD', 'Serbian Dinar (RSD)', '', '', '', 'no'),
(124, 'RUB', 'Russian Ruble (RUB)', '', '', '', 'no'),
(125, 'RWF', 'Rwandan Franc (RWF)', '', '', '', 'no'),
(126, 'SAR', 'Saudi Riyal (SAR)', '', '', '', 'no'),
(127, 'SBD', 'Solomon Islands Dollar (SBD)', '', '', '', 'no'),
(128, 'SCR', 'Seychellois Rupee (SCR)', '', '', '', 'no'),
(129, 'SDG', 'Sudanese Pound (SDG)', '', '', '', 'no'),
(130, 'SEK', 'Swedish Krona (SEK)', '', '', '', 'no'),
(131, 'SGD', 'Singapore Dollar (SGD)', '', '', '', 'no'),
(132, 'SHP', 'Saint Helena Pound (SHP)', '', '', '', 'no'),
(133, 'SLL', 'Sierra Leonean Leone (SLL)', '', '', '', 'no'),
(134, 'SOS', 'Somali Shilling (SOS)', '', '', '', 'no'),
(135, 'SRD', 'Surinamese Dollar (SRD)', '', '', '', 'no'),
(136, 'STD', 'S?o Tom? and Pr?ncipe Dobra (STD)', '', '', '', 'no'),
(137, 'SVC', 'Salvadoran Col?n (SVC)', '', '', '', 'no'),
(138, 'SYP', 'Syrian Pound (SYP)', '', '', '', 'no'),
(139, 'SZL', 'Swazi Lilangeni (SZL)', '', '', '', 'no'),
(140, 'THB', 'Thai Baht (?)', '', '', '', 'no'),
(141, 'TJS', 'Tajikistani Somoni (TJS)', '', '', '', 'no'),
(142, 'TMT', 'Turkmenistani Manat (TMT)', '', '', '', 'no'),
(143, 'TND', 'Tunisian Dinar (TND)', '', '', '', 'no'),
(144, 'TOP', 'Tongan Pa?anga (TOP)', '', '', '', 'no'),
(145, 'TRY', 'Turkish Lira (TRY)', '', '', '', 'no'),
(146, 'TTD', 'Trinidad and Tobago Dollar (TTD)', '', '', '', 'no'),
(147, 'TWD', 'New Taiwan Dollar (NT$)', '', '', '', 'no'),
(148, 'TZS', 'Tanzanian Shilling (TZS)', '', '', '', 'no'),
(149, 'UAH', 'Ukrainian Hryvnia (UAH)', '', '', '', 'no'),
(150, 'UGX', 'Ugandan Shilling (UGX)', '', '', '', 'no'),
(151, 'USD', 'US Dollar ($)', '', '', '', 'no'),
(152, 'UYU', 'Uruguayan Peso (UYU)', '', '', '', 'no'),
(153, 'UZS', 'Uzbekistan Som (UZS)', '', '', '', 'no'),
(154, 'VEF', 'Venezuelan Bol?var (VEF)', '', '', '', 'no'),
(155, 'VND', 'Vietnamese Dong (?)', '', '', '', 'no'),
(156, 'VUV', 'Vanuatu Vatu (VUV)', '', '', '', 'no'),
(157, 'WST', 'Samoan Tala (WST)', '', '', '', 'no'),
(158, 'XAF', 'CFA Franc BEAC (FCFA)', '', '', '', 'no'),
(159, 'XCD', 'East Caribbean Dollar (EC$)', '', '', '', 'no'),
(160, 'XDR', 'Special Drawing Rights (XDR)', '', '', '', 'no'),
(161, 'XOF', 'CFA Franc BCEAO (CFA)', '', '', '', 'no'),
(162, 'XPF', 'CFP Franc (CFPF)', '', '', '', 'no'),
(163, 'YER', 'Yemeni Rial (YER)', '', '', '', 'no'),
(164, 'ZAR', 'South African Rand (ZAR)', '', '', '', 'no'),
(165, 'ZMK', 'Zambian Kwacha (1968-2012) (ZMK)', '', '', '', 'no'),
(166, 'ZMW', 'Zambian Kwacha (ZMW)', '', '', '', 'no'),
(167, 'ZWL', 'Zimbabwean Dollar (2009) (ZWL)', '', '', '', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` smallint(5) NOT NULL,
  `gallery_album_id` smallint(5) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url_link` varchar(255) NOT NULL,
  `video_intro` enum('no','yes') NOT NULL,
  `video_desc` text,
  `author` smallint(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `gallery_album_id`, `file`, `extention`, `type`, `title`, `url_link`, `video_intro`, `video_desc`, `author`, `date`) VALUES
(131, 16, '', '', 'video', '', 'oz6kKB8wlj8', 'no', NULL, 27, '2016-03-20 20:35:11'),
(132, 15, 'uploads/gallery/5_160321053315.jpg', 'jpg', 'image', '', '', 'no', NULL, 0, '2016-03-20 22:33:15'),
(133, 15, 'uploads/gallery/18_160321053315.jpg', 'jpg', 'image', '', '', 'no', NULL, 0, '2016-03-20 22:33:15'),
(134, 17, 'uploads/gallery/1_160321084436.JPG', 'JPG', 'image', '', '', 'no', NULL, 0, '2016-03-21 13:44:37'),
(135, 17, 'uploads/gallery/4_160321084437.jpg', 'jpg', 'image', '', '', 'no', NULL, 0, '2016-03-21 13:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_album`
--

CREATE TABLE `gallery_album` (
  `gallery_album_id` int(11) NOT NULL,
  `album_name` varchar(100) NOT NULL,
  `album_title` varchar(100) NOT NULL,
  `album_description` text NOT NULL,
  `date` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_album`
--

INSERT INTO `gallery_album` (`gallery_album_id`, `album_name`, `album_title`, `album_description`, `date`, `file`, `extention`, `author`) VALUES
(15, 'photo', 'photo', '<p>photo</p>', '2016-03-24', 'uploads/gallery/12_160114070350_thumb_160321030255.jpg', 'jpg', 0),
(16, 'asd', 'asd', '<p>asd</p>', '2016-03-06', 'uploads/gallery/1_160314034733_160321030544.jpg', 'jpg', 0),
(17, 'Album Pertama', 'Anyer', '<p>Lorem Ipsum</p>', '2016-03-31', 'uploads/gallery/6_160321084015.jpg', 'jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_get`
--

CREATE TABLE `gallery_get` (
  `id_banner` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `ext` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_get`
--

INSERT INTO `gallery_get` (`id_banner`, `file`, `ext`) VALUES
(1, 'uploads/image/about/5_160320095415.jpg', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `get_shop`
--

CREATE TABLE `get_shop` (
  `id` smallint(5) NOT NULL,
  `page_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `get_shop`
--

INSERT INTO `get_shop` (`id`, `page_desc`) VALUES
(1, '<h3 style="text-align: left;">Title.</h3>\n<p style="text-align: left;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>\n<blockquote class="serif">\n<p>Modi perferendis ipsa, dolorum eaque accusantium! Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam a ea ex hic, iusto atque, quas. Aliquam rerum dolores saepe sunt, assumenda voluptas.</p>\n</blockquote>\n<p style="text-align: left;">Ipsa in adipisci eius qui quos minima ratione velit reprehenderit fuga deleniti amet quidem commodi ducimus.</p>\n<h3 style="text-align: left;">In hac habitasse platea dictumst.</h3>\n<p style="text-align: left;">Sapiente amet eaque soluta perferendis. Quia ex sit sint voluptate ipsa culpa, veritatis:</p>\n<ul style="text-align: left;">\n<li>Proin elementum ante quis mauris</li>\n<li>Integer dictum magna vitae ullamcorper sodales</li>\n<li>Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.</li>\n<li>Vestibulum ante ipsum primis in faucibus</li>\n</ul>\n<p style="text-align: left;">Labore expedita officiis, in perspiciatis atque voluptates odio dignissimos doloribus quibusdam est minus ullam nulla quisquam nihil aspernatur rem laborum accusantium animi.aa</p>\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `ja_absensi_siswa`
--

CREATE TABLE `ja_absensi_siswa` (
  `id` int(111) NOT NULL,
  `nis` bigint(111) NOT NULL,
  `pin` int(5) NOT NULL,
  `keterangan` enum('Alpha','Hadir','Sakit','Izin','Telat') NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` varchar(222) NOT NULL,
  `tahun` varchar(111) DEFAULT NULL,
  `kd_kelas` int(222) NOT NULL,
  `selesai` varchar(222) DEFAULT NULL,
  `waktu` varchar(222) NOT NULL,
  `terlambat` varchar(222) NOT NULL,
  `in_out` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(111) NOT NULL,
  `semester` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ja_data_absen`
--

CREATE TABLE `ja_data_absen` (
  `id` int(10) NOT NULL,
  `pin` int(10) DEFAULT NULL,
  `id_kelas` int(222) DEFAULT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_pulang` datetime NOT NULL,
  `tanggal` date NOT NULL,
  `ver` int(10) NOT NULL,
  `telat` enum('0','1') NOT NULL DEFAULT '0',
  `status` int(10) NOT NULL,
  `kehadiran` int(6) NOT NULL,
  `sms_status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_data_absen`
--

INSERT INTO `ja_data_absen` (`id`, `pin`, `id_kelas`, `jam_masuk`, `jam_pulang`, `tanggal`, `ver`, `telat`, `status`, `kehadiran`, `sms_status`) VALUES
(1, 1, 1, '2017-01-18 21:00:00', '0000-00-00 00:00:00', '2017-01-18', 0, '0', 0, 4, '1'),
(2, 2, 1, '2017-01-18 21:00:00', '0000-00-00 00:00:00', '2017-01-18', 0, '0', 0, 4, '1'),
(3, 3, 1, '2017-01-18 21:00:00', '0000-00-00 00:00:00', '2017-01-18', 0, '0', 0, 4, '1'),
(4, 10, 1, '2017-01-18 21:00:00', '0000-00-00 00:00:00', '2017-01-18', 0, '0', 0, 4, '1'),
(5, 11, 1, '2017-01-18 21:00:00', '0000-00-00 00:00:00', '2017-01-18', 0, '0', 0, 4, '1'),
(6, 1, 1, '2017-01-19 21:00:00', '0000-00-00 00:00:00', '2017-01-19', 0, '0', 0, 4, '1'),
(7, 2, 1, '2017-01-19 21:00:00', '0000-00-00 00:00:00', '2017-01-19', 0, '0', 0, 4, '1'),
(8, 3, 1, '2017-01-19 21:00:00', '0000-00-00 00:00:00', '2017-01-19', 0, '0', 0, 4, '1'),
(9, 10, 1, '2017-01-19 21:00:00', '0000-00-00 00:00:00', '2017-01-19', 0, '0', 0, 4, '1'),
(10, 4, 2, '2017-01-18 21:00:00', '0000-00-00 00:00:00', '2017-01-18', 0, '0', 0, 4, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ja_fp`
--

CREATE TABLE `ja_fp` (
  `id` int(111) NOT NULL,
  `ip` varchar(111) NOT NULL,
  `key` int(111) NOT NULL,
  `keterangan` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_fp`
--

INSERT INTO `ja_fp` (`id`, `ip`, `key`, `keterangan`) VALUES
(3, '192.168.0.110', 1, 'Kelas X-1'),
(6, '192.168.0.19', 1, 'ruang guru');

-- --------------------------------------------------------

--
-- Table structure for table `ja_guru`
--

CREATE TABLE `ja_guru` (
  `No` int(50) NOT NULL,
  `nip` bigint(50) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `pasword` varchar(50) NOT NULL,
  `id_pel` int(244) DEFAULT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_guru`
--

INSERT INTO `ja_guru` (`No`, `nip`, `id_finger`, `nama`, `pasword`, `id_pel`, `foto`) VALUES
(26, 1, 1, 'Hilmy Syarif', 'fe703d258c7ef5f50b71e06565a65aa07194907f', NULL, 'uploads/image/user/berlin-maroon_161101010533.jpg'),
(27, 2, 2, 'hilmysyarif@gmail.com', '2589742ece77aca7be8c4ca22ed69257bdd229a3', NULL, ''),
(28, 3, 3, 'hilmysyarif@gmail.com2', '2589742ece77aca7be8c4ca22ed69257bdd229a3', NULL, ''),
(29, 4, 11, 'Mulyono', 'e87707b464effe788a434a32dbc92d52ccf8768e', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `ja_hari_libur`
--

CREATE TABLE `ja_hari_libur` (
  `id` int(111) NOT NULL,
  `tanggal_mulai` varchar(111) NOT NULL,
  `tanggal_akhir` varchar(111) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_hari_libur`
--

INSERT INTO `ja_hari_libur` (`id`, `tanggal_mulai`, `tanggal_akhir`, `keterangan`, `tipe`, `id_kelas`) VALUES
(4, '2016-11-09', '2016-11-10', 'test', 'Kelas', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ja_in_out`
--

CREATE TABLE `ja_in_out` (
  `id` int(11) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `type` enum('0','1') NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `keterangan` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('active','disabled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_in_out`
--

INSERT INTO `ja_in_out` (`id`, `hari`, `type`, `id_kelas`, `jam_masuk`, `jam_keluar`, `keterangan`, `user_id`, `status`) VALUES
(9, 'Mon', '0', 0, '01:00:00', '03:00:00', '', 0, 'active'),
(10, 'Tue', '0', 0, '22:00:00', '03:00:00', '', 0, 'active'),
(11, 'Wed', '0', 0, '21:00:00', '10:00:00', '', 0, 'active'),
(12, 'Thu', '0', 0, '01:00:00', '03:00:00', '', 0, 'active'),
(13, 'Fri', '0', 0, '15:00:00', '02:00:00', '', 0, 'active'),
(14, 'Sat', '1', 0, '11:00:00', '11:00:00', '', 0, 'active'),
(15, 'Sun', '0', 0, '00:00:00', '01:00:00', '', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ja_jurusan`
--

CREATE TABLE `ja_jurusan` (
  `id_jurusan` int(111) NOT NULL,
  `nama` varchar(111) NOT NULL,
  `keterangan` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_jurusan`
--

INSERT INTO `ja_jurusan` (`id_jurusan`, `nama`, `keterangan`) VALUES
(15, '1', 'TKJ'),
(16, '23', 'RPL'),
(17, '3', 'MM'),
(18, '4', 'TKJTKJTKJTKJTKJ'),
(19, '5', 'TKJTKJTKJTKJTKJTKJTKJTKJ'),
(20, 'ASD', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `ja_karyawan`
--

CREATE TABLE `ja_karyawan` (
  `id_karyawan` int(222) NOT NULL,
  `nup` bigint(222) NOT NULL,
  `id_finger` int(5) NOT NULL,
  `nama` varchar(222) NOT NULL,
  `kelamin` varchar(3) NOT NULL,
  `tempat_lahir` varchar(222) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(222) NOT NULL,
  `foto` varchar(222) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_karyawan`
--

INSERT INTO `ja_karyawan` (`id_karyawan`, `nup`, `id_finger`, `nama`, `kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `agama`, `foto`) VALUES
(1, 1, 10, '1k', 'Lak', '1k', '0000-00-00', '1k', 'Islam', ''),
(10, 3, 3, 'Hilmy2', 'Per', 'Tangerang Selatan', '1993-12-13', 'Perum. Pondok Aren Indah Jl. Akasia III blok B3/6\nPondok Aren, Tangerang selatan', 'Islam', '');

-- --------------------------------------------------------

--
-- Table structure for table `ja_kategori_izin`
--

CREATE TABLE `ja_kategori_izin` (
  `id` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_kategori_izin`
--

INSERT INTO `ja_kategori_izin` (`id`, `keterangan`) VALUES
(1, 'Alpha'),
(2, 'Izin'),
(3, 'Sakit'),
(4, 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `ja_kelas`
--

CREATE TABLE `ja_kelas` (
  `id_kelas` int(222) NOT NULL,
  `Nama_Kelas` varchar(222) NOT NULL,
  `id_jurusan` int(111) NOT NULL,
  `id_guru` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_kelas`
--

INSERT INTO `ja_kelas` (`id_kelas`, `Nama_Kelas`, `id_jurusan`, `id_guru`) VALUES
(1, 'X-1', 15, ''),
(2, 'X-2', 15, ''),
(3, 'X-3', 15, '');

-- --------------------------------------------------------

--
-- Table structure for table `ja_ortu`
--

CREATE TABLE `ja_ortu` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT '0',
  `nis_siswa` varchar(255) NOT NULL,
  `nama_ortu` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_ortu`
--

INSERT INTO `ja_ortu` (`id`, `group_id`, `nis_siswa`, `nama_ortu`, `no_hp`, `keterangan`) VALUES
(1, 1, '1411501438', 'DEDE', '087887496695', 'IBU2'),
(3, 3, '1411501490', 'Dewi', '0811964776', 'Ibu'),
(6, 2, '1411501439', 'Ibu Tasyah', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `ja_settings`
--

CREATE TABLE `ja_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_settings`
--

INSERT INTO `ja_settings` (`id`, `name`, `value`, `keterangan`) VALUES
(1, 'email', 'hsevfakhri@gmail.com', ''),
(2, 'password', 'H4rdjump', ''),
(3, 'device', '33026', '');

-- --------------------------------------------------------

--
-- Table structure for table `ja_siswa`
--

CREATE TABLE `ja_siswa` (
  `id` int(50) NOT NULL,
  `nis` int(11) NOT NULL,
  `pin` int(5) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `nama_panggilan` varchar(111) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(22) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_kelas` int(50) NOT NULL,
  `absen` int(111) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ja_siswa`
--

INSERT INTO `ja_siswa` (`id`, `nis`, `pin`, `nama_siswa`, `nama_panggilan`, `kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `alamat`, `password`, `id_kelas`, `absen`, `foto`) VALUES
(8, 1411501438, 1, 'Muhammad Fakhrizal', 'Fakhri', 'L', 'Jakarta', '1997-02-06', 'Islam', 'Komplek Pondok Kacang Prima Blok H5 No.3 rt 004/008', '', 1, 1, NULL),
(9, 1411501439, 2, 'cuhuy', 'wadaw', 'L', 'Jakarta', '2017-01-01', 'Islam', 'Jakarta Utara', '', 1, 2, NULL),
(10, 1411501440, 3, 'Hesti Lutfy', 'Hesti', 'P', 'Jakarta', '1996-10-31', 'Islam', 'Pondok Aren', '', 1, 3, NULL),
(11, 1511501438, 4, 'Hilmy Syarif', 'Bokir', 'L', 'Jakarta', '2017-01-14', 'Islam', 'Arinda 2', '', 2, 1, NULL),
(12, 1511501439, 5, 'Arif Tri Nugroho', 'Arif', 'L', 'Jakarta', '2017-01-21', 'Islam', 'Pondok Kacang Prima', '', 2, 2, NULL),
(13, 1511501440, 6, 'Lorem Ipsum', 'Lorem', 'L', 'Jakarta', '2017-02-04', 'Islam', 'Dolor Amet', '', 2, 3, NULL),
(14, 1611501438, 7, 'Upinin', 'Upin', 'L', 'Jauh', '2017-02-25', 'Islam', 'Malaysie', '', 3, 1, NULL),
(15, 1611501439, 8, 'Ipinan', 'Ipin', 'L', 'jauh bener', '2017-02-26', 'Islam', 'Malysie', '', 3, 2, NULL),
(16, 1611501440, 9, 'Jarjit Sigh', 'Jarjit', 'L', 'Jauh bener dah', '2017-03-26', 'Islam', 'Malysie', '', 3, 3, NULL),
(17, 1411501441, 10, 'Dharmawan Budi Aji', 'Budi', 'L', 'Jakarta', '2016-07-31', 'Islam', 'Pondok Kacang Prima', '', 1, 4, NULL),
(18, 1411501442, 11, 'Farhan Alify', 'Farhan', 'L', 'Jakarta', '2017-05-21', 'Islam', 'Pondok Kacang Prima', '', 1, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_album_loved`
--

CREATE TABLE `log_album_loved` (
  `id_log` int(11) NOT NULL,
  `album_id` smallint(5) NOT NULL,
  `loved` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_album_view`
--

CREATE TABLE `log_album_view` (
  `id_log` int(11) NOT NULL,
  `album_id` smallint(5) NOT NULL,
  `view` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_album_view`
--

INSERT INTO `log_album_view` (`id_log`, `album_id`, `view`, `date`) VALUES
(1, 16, 17, '2015-11-23 10:39:01'),
(2, 14, 11, '2015-11-23 10:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `log_article_loved`
--

CREATE TABLE `log_article_loved` (
  `log_id` int(11) NOT NULL,
  `blog_id` smallint(5) NOT NULL,
  `loved` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_article_loved`
--

INSERT INTO `log_article_loved` (`log_id`, `blog_id`, `loved`, `date`) VALUES
(1, 70, 1, '2015-11-23 12:19:10'),
(2, 69, 2, '2015-11-23 16:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `log_article_view`
--

CREATE TABLE `log_article_view` (
  `id_log` int(11) NOT NULL,
  `blog_id` smallint(5) DEFAULT NULL,
  `view` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_article_view`
--

INSERT INTO `log_article_view` (`id_log`, `blog_id`, `view`, `date`) VALUES
(12, 0, 2, '2015-11-22 08:46:49'),
(11, 70, 30, '2015-12-19 20:06:06'),
(10, 69, 26, '2015-12-19 20:06:30'),
(13, 55, 3, '2015-11-22 17:42:08'),
(14, 71, 15, '2015-11-23 16:32:57'),
(15, 72, 11, '2015-12-19 20:06:20'),
(16, 74, 1, '2015-11-23 11:02:56'),
(17, 73, 2, '2015-12-19 20:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id_membership` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `province` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `reg_date` varchar(50) NOT NULL,
  `no_member` varchar(50) NOT NULL,
  `ktp` varchar(50) NOT NULL,
  `sim` varchar(50) NOT NULL,
  `home_phone` varchar(30) NOT NULL,
  `office` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `blood_type` varchar(2) NOT NULL,
  `tsize` varchar(5) NOT NULL,
  `status` varchar(255) NOT NULL,
  `model2` varchar(255) NOT NULL,
  `chapter` varchar(255) NOT NULL,
  `mem2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id_membership`, `first_name`, `last_name`, `phone`, `province`, `address`, `zipcode`, `reg_date`, `no_member`, `ktp`, `sim`, `home_phone`, `office`, `email`, `blood_type`, `tsize`, `status`, `model2`, `chapter`, `mem2`) VALUES
(1, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '0815', '0099', 'asd', 'asd', 'asd', 'asd', 'asd', 'o', 's', 'status', '5614', '0021', '0099');

-- --------------------------------------------------------

--
-- Table structure for table `membership_car`
--

CREATE TABLE `membership_car` (
  `id_car` int(11) NOT NULL,
  `id_membership` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `seri_mc` varchar(255) NOT NULL,
  `year` varchar(4) NOT NULL,
  `license_plate` varchar(100) NOT NULL,
  `chasis_no` varchar(20) NOT NULL,
  `engine_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership_car`
--

INSERT INTO `membership_car` (`id_car`, `id_membership`, `model`, `seri_mc`, `year`, `license_plate`, `chasis_no`, `engine_no`) VALUES
(1, 1, '', 'A1', '2015', '000000', '00000', '0000'),
(2, 1, '', 'A2', '2014', '000000', '000000', '00000'),
(3, 1, '', 'a3', '2014', '00000', '00000', '00000');

-- --------------------------------------------------------

--
-- Table structure for table `membership_get`
--

CREATE TABLE `membership_get` (
  `get_id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `form_url` varchar(255) NOT NULL,
  `titone` varchar(100) NOT NULL,
  `descone` varchar(255) NOT NULL,
  `tittwo` varchar(100) NOT NULL,
  `desctwo` varchar(255) NOT NULL,
  `tittri` varchar(100) NOT NULL,
  `desctri` varchar(255) NOT NULL,
  `titco1` varchar(100) NOT NULL,
  `descco1` varchar(100) NOT NULL,
  `titco2` varchar(100) NOT NULL,
  `descco2` varchar(100) NOT NULL,
  `titco3` varchar(100) NOT NULL,
  `descco3` varchar(100) NOT NULL,
  `titco4` varchar(100) NOT NULL,
  `descco4` varchar(100) NOT NULL,
  `titco5` varchar(100) NOT NULL,
  `descco5` varchar(100) NOT NULL,
  `titco6` varchar(100) NOT NULL,
  `descco6` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership_get`
--

INSERT INTO `membership_get` (`get_id`, `desc`, `form_url`, `titone`, `descone`, `tittwo`, `desctwo`, `tittri`, `desctri`, `titco1`, `descco1`, `titco2`, `descco2`, `titco3`, `descco3`, `titco4`, `descco4`, `titco5`, `descco5`, `titco6`, `descco6`) VALUES
(1, '<p style="text-align: left;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>\n<blockquote class="serif">\n<p>Modi perferendis ipsa, dolorum eaque accusantium! Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam a ea ex hic, iusto atque, quas. Aliquam rerum dolores saepe sunt, assumenda voluptas.</p>\n</blockquote>\n<p style="text-align: left;">Ipsa in adipisci eius qui quos minima ratione velit reprehenderit fuga deleniti amet quidem commodi ducimus.</p>\n<h3 style="text-align: left;">In hac habitasse platea dictumst.</h3>\n<p style="text-align: left;">Sapiente amet eaque soluta perferendis. Quia ex sit sint voluptate ipsa culpa, veritatis:</p>\n<ul style="text-align: left;">\n<li>Proin elementum ante quis mauris</li>\n<li>Integer dictum magna vitae ullamcorper sodales</li>\n<li>Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.</li>\n<li>Vestibulum ante ipsum primis in faucibus</li>\n</ul>\n<p style="text-align: left;">Labore expedita officiis, in perspiciatis atque voluptates odio dignissimos doloribus quibusdam est minus ullam nulla quisquam nihil aspernatur rem laborum accusantium animi.aa</p>', 'http://google.com/asd', 'LOREM IPSUM DOLOR', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure pariatur ex rerum laudantium accusamus ab ut quidem ducimus veniam eveniet, voluptate.</p>', 'ADIPISICING ELIT', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure pariatur ex rerum laudantium accusamus ab ut quidem ducimus veniam eveniet, voluptate.</p>', 'QUIDEM DUCIMUS', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure pariatur ex rerum laudantium accusamus ab ut quidem ducimus veniam eveniet, voluptate.</p>', 'LOREM IPSUM DOLOR', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolores. Eum laudantium.', 'CONSECTETUR ADIPISICING', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolores. Eum laudantium.', 'EUM LAUDANTIUM', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolores. Eum laudantium.', 'ELIT INCIDUNTGGG', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolores. Eum laudantium.', 'EUM LAUDANTIUM', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolores. Eum laudantium.', 'DUCIMUS VENIAMS', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolores. Eum laudantium.'),
(2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `id` smallint(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `jobs` varchar(50) NOT NULL,
  `file` varchar(200) NOT NULL,
  `extention` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`id`, `name`, `jobs`, `file`, `extention`) VALUES
(10, 'John Doe', '<p>Owner</p>', 'uploads/image/about/1_160320100120.png', 'png'),
(11, 'John Doe', '<p>Management</p>', 'uploads/image/about/2_160320100331.png', 'png'),
(12, 'John Doe', '<p>Marketing</p>', 'uploads/image/about/3_160320100535.png', 'png'),
(13, 'Lorem Ipsum', '<p>Lorem</p>', 'uploads/image/about/8_160321090840.jpg', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` smallint(5) NOT NULL,
  `page_name` varchar(30) NOT NULL,
  `banner` enum('no','yes') NOT NULL,
  `blog` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `page_name`, `banner`, `blog`) VALUES
(1, 'Home', 'yes', 'no'),
(2, 'News', 'no', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `page_about`
--

CREATE TABLE `page_about` (
  `about_id` smallint(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_about`
--

INSERT INTO `page_about` (`about_id`, `title`, `desc`) VALUES
(3, '', '<h2>Title.</h2>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>\n<blockquote class="serif">\n<p>Modi perferendis ipsa, dolorum eaque accusantium! Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam a ea ex hic, iusto atque, quas. Aliquam rerum dolores saepe sunt, assumenda voluptas.</p>\n</blockquote>\n<p>Ipsa in adipisci eius qui quos minima ratione velit reprehenderit fuga deleniti amet quidem commodi ducimus.</p>\n<h3>In hac habitasse platea dictumst.</h3>\n<p>Sapiente amet eaque soluta perferendis. Quia ex sit sint voluptate ipsa culpa, veritatis:</p>\n<ul>\n<li>Proin elementum ante quis mauris</li>\n<li>Integer dictum magna vitae ullamcorper sodales</li>\n<li>Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.</li>\n<li>Vestibulum ante ipsum primis in faucibus</li>\n</ul>\n<p>Labore expedita officiis, in perspiciatis atque voluptates odio dignissimos doloribus quibusdam est minus ullam nulla quisquam nihil aspernatur rem laborum accusantium animi.aa</p>'),
(4, '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>\n<blockquote class="serif">\n<p>Modi perferendis ipsa, dolorum eaque accusantium! Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam a ea ex hic, iusto atque, quas. Aliquam rerum dolores saepe sunt, assumenda voluptas.</p>\n</blockquote>\n<p>Ipsa in adipisci eius qui quos minima ratione velit reprehenderit fuga deleniti amet quidem commodi ducimus.</p>\n<h3>In hac habitasse platea dictumst.</h3>\n<p>Sapiente amet eaque soluta perferendis. Quia ex sit sint voluptate ipsa culpa, veritatis:</p>\n<ul>\n<li>Proin elementum ante quis mauris</li>\n<li>Integer dictum magna vitae ullamcorper sodales</li>\n<li>Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.</li>\n<li>Vestibulum ante ipsum primis in faucibus</li>\n</ul>\n<p>Labore expedita officiis, in perspiciatis atque voluptates odio dignissimos doloribus quibusdam est minus ullam nulla quisquam nihil aspernatur rem laborum accusantium animi.a</p>'),
(5, '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>\n<blockquote class="serif">\n<p>Modi perferendis ipsa, dolorum eaque accusantium! Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam a ea ex hic, iusto atque, quas. Aliquam rerum dolores saepe sunt, assumenda voluptas.</p>\n</blockquote>\n<p>Ipsa in adipisci eius qui quos minima ratione velit reprehenderit fuga deleniti amet quidem commodi ducimus.</p>\n<h3>In hac habitasse platea dictumst.</h3>\n<p>Sapiente amet eaque soluta perferendis. Quia ex sit sint voluptate ipsa culpa, veritatis:</p>\n<ul>\n<li>Proin elementum ante quis mauris</li>\n<li>Integer dictum magna vitae ullamcorper sodales</li>\n<li>Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.</li>\n<li>Vestibulum ante ipsum primis in faucibus</li>\n</ul>\n<p>Labore expedita officiis, in perspiciatis atque voluptates odio dignissimos doloribus quibusdam est minus ullam nulla quisquam nihil aspernatur rem laborum accusantium animi.ssss</p>'),
(6, '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>\n<blockquote class="serif">\n<p>Modi perferendis ipsa, dolorum eaque accusantium! Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam a ea ex hic, iusto atque, quas. Aliquam rerum dolores saepe sunt, assumenda voluptas.</p>\n</blockquote>\n<p>Ipsa in adipisci eius qui quos minima ratione velit reprehenderit fuga deleniti amet quidem commodi ducimus.</p>\n<h3>In hac habitasse platea dictumst.</h3>\n<p>Sapiente amet eaque soluta perferendis. Quia ex sit sint voluptate ipsa culpa, veritatis:</p>\n<ul>\n<li>Proin elementum ante quis mauris</li>\n<li>Integer dictum magna vitae ullamcorper sodales</li>\n<li>Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.</li>\n<li>Vestibulum ante ipsum primis in faucibus</li>\n</ul>\n<p>Labore expedita officiis, in perspiciatis atque voluptates odio dignissimos doloribus quibusdam est minus ullam nulla quisquam nihil aspernatur rem laborum accusantium animi.aaa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `page_contact`
--

CREATE TABLE `page_contact` (
  `contact_id` smallint(5) NOT NULL,
  `contact_office` text NOT NULL,
  `opening_hour` text NOT NULL,
  `contact_email` varchar(200) NOT NULL,
  `contact_phone` text NOT NULL,
  `geolocation` varchar(200) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_contact`
--

INSERT INTO `page_contact` (`contact_id`, `contact_office`, `opening_hour`, `contact_email`, `contact_phone`, `geolocation`, `create_date`, `author`) VALUES
(1, 'Ruko lorem ipsum<br /> No.38 lorem pisum<br /> Jakarta Selatan 12312', '<ul>\r\n	<li>Monday - Friday: 08.00-20.00</li>\r\n	<li>Saturday: 09.00-15.00</li>\r\n	<li>Sunday and holidays: closed</li>\r\n</ul>\r\n', 'hilmysyarif@gmail.com', '082196753916 ', 'dsada555', '2016-03-23 06:36:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `page_content_id` int(11) NOT NULL,
  `page_category` varchar(100) NOT NULL,
  `content_id` smallint(5) NOT NULL,
  `id_countries` smallint(5) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_content`
--

INSERT INTO `page_content` (`page_content_id`, `page_category`, `content_id`, `id_countries`, `title`, `content`) VALUES
(1, 'blog', 1, 64, 'dasdaLorem Ipsum is simply dummy text of the printing and typesetting industry. ', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in clas</p>\r\n'),
(2, 'blog', 2, 64, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in clas</p>\r\n'),
(3, 'blog', 3, 64, '', '<p>asasdads</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `page_event`
--

CREATE TABLE `page_event` (
  `event_id` smallint(3) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `place` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `file2` varchar(255) NOT NULL,
  `extension2` varchar(30) NOT NULL,
  `file3` varchar(200) NOT NULL,
  `extension3` varchar(30) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `is_slide` enum('yes','no') NOT NULL,
  `status` enum('Soon','Past') NOT NULL,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_event`
--

INSERT INTO `page_event` (`event_id`, `event_name`, `place`, `desc`, `file`, `extention`, `file2`, `extension2`, `file3`, `extension3`, `date`, `is_slide`, `status`, `author`) VALUES
(9, 'paris', 'paris', '<p>paris</p>', 'true', 'jpg', 'uploads/event/1_160313035544.JPG', 'JPG', 'uploads/event/mini-cooper-ipad-wallpaper-wallpaper-8_160316125407.jpg', 'jpg', '2016-04-03', 'yes', 'Soon', 0),
(10, 'Trip to Bali', 'Bali', '<p>bali view</p>', 'uploads/event/3_160321020847.jpg', 'jpg', 'uploads/event/5_160313033717.jpg', 'jpg', 'uploads/event/slider_160316123706.jpg', '0', '2016-03-25', 'yes', 'Past', 0),
(11, 'test', 'test', '<p>test</p>', 'uploads/event/1_160309095417_160321021227.jpg', 'jpg', 'uploads/event/2_160315092641.jpg', 'jpg', 'uploads/event/img4_160316124024.jpg', 'jpg', '2016-03-06', 'yes', 'Soon', 0),
(16, 'EVENT Januari', 'Anyer', '<p>Jalan Jalan</p>', 'uploads/event/9_160321083419.jpg', 'jpg', 'uploads/event/8_160321083419.jpg', 'jpg', 'uploads/event/header_160321083420.jpg', 'jpg', '2016-03-31', 'yes', 'Soon', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_gallery`
--

CREATE TABLE `page_gallery` (
  `id` smallint(5) NOT NULL,
  `file` varchar(200) NOT NULL,
  `extention` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_gallery`
--

INSERT INTO `page_gallery` (`id`, `file`, `extention`) VALUES
(1, 'uploads/event/1_160309095417_160321021227.jpg', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `page_membership`
--

CREATE TABLE `page_membership` (
  `id_membership` smallint(5) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_membership`
--

INSERT INTO `page_membership` (`id_membership`, `desc`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae ut ratione similique temporibus tempora dicta soluta? Qui hic, voluptatem nemo quo corporis dignissimos voluptatum debitis cumque fugiat mollitia quasi quod. Repudiandae possimus quas odio nisi optio asperiores, vitae error laudantium, ratione odit ipsa obcaecati debitis deleniti minus, illo maiores placeat omnis magnam.</p>\n<blockquote class="serif">\n<p>Modi perferendis ipsa, dolorum eaque accusantium! Velit libero fugit dolores repellendus consequatur nisi, deserunt aperiam a ea ex hic, iusto atque, quas. Aliquam rerum dolores saepe sunt, assumenda voluptas.</p>\n</blockquote>\n<p>Ipsa in adipisci eius qui quos minima ratione velit reprehenderit fuga deleniti amet quidem commodi ducimus.</p>\n<h3>In hac habitasse platea dictumst.</h3>\n<p>Sapiente amet eaque soluta perferendis. Quia ex sit sint voluptate ipsa culpa, veritatis:</p>\n<ul>\n<li>Proin elementum ante quis mauris</li>\n<li>Integer dictum magna vitae ullamcorper sodales</li>\n<li>Integer non placerat diam, id ornare est. Curabitur sit amet lectus vitae urna.</li>\n<li>Vestibulum ante ipsum primis in faucibus</li>\n</ul>\n<p>Labore expedita officiis, in perspiciatis atque voluptates odio dignissimos doloribus quibusdam est minus ullam nulla quisquam nihil aspernatur rem laborum accusantium animi.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `page_merchant`
--

CREATE TABLE `page_merchant` (
  `id` smallint(5) NOT NULL,
  `page_desc` text NOT NULL,
  `merchant_name` varchar(200) NOT NULL,
  `merchant_place` varchar(200) NOT NULL,
  `merchant_desc` text NOT NULL,
  `file` varchar(200) NOT NULL,
  `extention` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_merchant`
--

INSERT INTO `page_merchant` (`id`, `page_desc`, `merchant_name`, `merchant_place`, `merchant_desc`, `file`, `extention`) VALUES
(1, '<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dolor diam, porta eget laoreet a, rhoncus at urna. Vestibulum a risus magna Aliquam non odio elementum, gravida massa ac, vehicula velit.</h4>', '', '', '', '', ''),
(3, '', 'Mini', 'http://www.google.com', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dolor diam, porta eget laoreet a, rhoncus at urna. Vestibulum a risus magna Aliquam non odio elementum, gravida massa ac, vehicula velit.</p>', 'uploads/image/merchant/1_160321041524.jpg', 'jpg'),
(4, '', 'Design and production', 'Jakarta, Indonesia', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dolor diam, porta eget laoreet a, rhoncus at urna. Vestibulum a risus magna Aliquam non odio elementum, gravida massa ac, vehicula velit.</p>', 'uploads/image/merchant/2_160321042207.jpg', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_price_disc` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_spec` text NOT NULL,
  `deals` enum('no','yes') NOT NULL,
  `location` varchar(70) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `url_link` varchar(255) NOT NULL,
  `author` smallint(5) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_category`, `product_brand`, `product_name`, `product_price`, `product_price_disc`, `product_desc`, `product_spec`, `deals`, `location`, `file`, `extention`, `url_link`, `author`, `create_date`) VALUES
(3, 't-shirts', '', 'asd', 11, '9', '<p>asd</p>', '', 'no', '', '', '', '', 27, '2016-03-20 17:40:23'),
(5, 'Accessories', '', 'Ring', 9000, '9000', '<p>Ring Gold</p>', '', 'yes', '', '', '', '', 27, '2016-03-20 18:44:20'),
(6, 'Ball', '', 'shoes', 9000, '9000', '<p>Shoess</p>', '', 'yes', '', '', '', '', 28, '2016-03-21 13:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` smallint(5) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `category_name`, `date`, `author`) VALUES
(7, 't-shirts', '2016-03-20 07:50:27', 27),
(8, 'Accessories', '2016-03-20 18:42:40', 27),
(9, 'Ball', '2016-03-21 13:56:23', 28);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` smallint(5) NOT NULL,
  `product_id` smallint(5) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `file`, `extention`) VALUES
(48, 37, 'uploads/image/product/Atasita_160117084559.jpg', 'jpg'),
(49, 37, 'uploads/image/product/Aneecha-Catamaran_160117084559.jpg', 'jpg'),
(50, 37, 'uploads/image/product/Amanikan_160117084559.jpg', 'jpg'),
(52, 38, 'uploads/image/product/Calico-Jack_160117085031.jpg', 'jpg'),
(53, 38, 'uploads/image/product/Komodo-Dancer_160117085031.jpg', 'jpg'),
(56, 40, 'uploads/image/product/5_160117085410.jpg', 'jpg'),
(57, 41, 'uploads/image/product/Burjuman-56_160117085617.jpg', 'jpg'),
(58, 41, 'uploads/image/product/Lady-Cruise_160117085617.jpg', 'jpg'),
(59, 37, 'uploads/image/product/Felicia_160117092805.jpg', 'jpg'),
(60, 42, 'uploads/image/product/Atasita_160117101116.jpg', 'jpg'),
(61, 43, 'uploads/image/product/Komodo-Dancer_160117101132.jpg', 'jpg'),
(62, 43, 'uploads/image/product/Burjuman-56_160117101228.jpg', 'jpg'),
(63, 43, 'uploads/image/product/Calico-Jack_160117101229.jpg', 'jpg'),
(64, 43, 'uploads/image/product/Datu-Bua_160117101229.jpg', 'jpg'),
(65, 44, 'uploads/image/product/1_160315045628.jpg', 'jpg'),
(66, 44, 'uploads/image/product/3_160315045629.jpg', 'jpg'),
(67, 44, 'uploads/image/product/4_160315045635.jpg', 'jpg'),
(68, 44, 'uploads/image/product/5_160315045638.jpg', 'jpg'),
(69, 45, 'uploads/image/product/1_160315045700.jpg', 'jpg'),
(70, 45, 'uploads/image/product/3_160315045701.jpg', 'jpg'),
(71, 45, 'uploads/image/product/4_160315045707.jpg', 'jpg'),
(72, 45, 'uploads/image/product/5_160315045710.jpg', 'jpg'),
(73, 46, 'uploads/image/product/1_160315045741.jpg', 'jpg'),
(74, 46, 'uploads/image/product/3_160315045743.jpg', 'jpg'),
(75, 46, 'uploads/image/product/4_160315045757.jpg', 'jpg'),
(76, 46, 'uploads/image/product/5_160315045804.jpg', 'jpg'),
(77, 47, 'uploads/image/product/11_160315053144.jpg', 'jpg'),
(78, 48, 'uploads/image/product/1_160315063723.png', 'png'),
(79, 48, 'uploads/image/product/2_160315063723.png', 'png'),
(80, 48, 'uploads/image/product/logo_toraja_160315063723.png', 'png'),
(81, 48, 'uploads/image/product/white_logo_160315063723.png', 'png'),
(82, 48, 'uploads/image/product/1_160315063723.jpg', 'jpg'),
(83, 49, 'uploads/image/product/promo-image-1_160315064217.png', 'png'),
(84, 49, 'uploads/image/product/promo-image-2_160315064218.png', 'png'),
(85, 49, 'uploads/image/product/promo-image-3_160315064219.png', 'png'),
(86, 49, 'uploads/image/product/promo-image-4_160315064219.png', 'png'),
(87, 50, 'uploads/image/product/single-1_160315065315.jpg', 'jpg'),
(88, 50, 'uploads/image/product/2_160315064513.jpg', 'jpg'),
(89, 50, 'uploads/image/product/3_160315064514.jpg', 'jpg'),
(90, 50, 'uploads/image/product/4_160315064516.jpg', 'jpg'),
(91, 50, 'uploads/image/product/5_160315064518.jpg', 'jpg'),
(97, 3, 'uploads/image/product/1_160312111901_thumb_160321124023.jpg', 'jpg'),
(100, 5, 'uploads/image/product/1_160321014420.JPG', 'JPG'),
(101, 5, 'uploads/image/product/2_160321014420.jpg', 'jpg'),
(102, 5, 'uploads/image/product/3_160321014420.jpg', 'jpg'),
(103, 5, 'uploads/image/product/4_160321014421.jpg', 'jpg'),
(104, 5, 'uploads/image/product/5_160321014421.jpg', 'jpg'),
(105, 6, 'uploads/image/product/1_160321085734.JPG', 'JPG'),
(106, 6, 'uploads/image/product/1c6fc53fae5ae1a3df8b45d9d5cf2cff_160321085734.jpg', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `quotes_id` smallint(5) NOT NULL,
  `layout` enum('left','right') NOT NULL,
  `word` varchar(255) NOT NULL,
  `moment_by` varchar(100) NOT NULL,
  `template` text NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `extention` varchar(30) NOT NULL,
  `use_for` enum('blog','paste') NOT NULL,
  `link` varchar(255) NOT NULL,
  `author` smallint(5) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`quotes_id`, `layout`, `word`, `moment_by`, `template`, `file`, `extention`, `use_for`, `link`, `author`, `create_date`) VALUES
(8, 'left', '<p>TAK sehatlah masyarakat itu, manakala salah satu pihak menindas kepada yang lain</p>', 'Kursus politik kepada para wanita, Istana Presiden Yogyakarta, 1947', '\r\n              \r\n                <div class="col-md-3 ta-c width100">\r\n                   <img src="uploads/image/quotes/quote_151122064114.jpg" alt="Kutipan Soekarno">\r\n                </div>  \r\n              <blockquote class="blog-post-quote quote-depan col-md-9">\r\n                 <p class="lead"><p>TAK sehatlah masyarakat itu, manakala salah satu pihak menindas kepada yang lain</p></p>\r\n                 <span class="quote-author">Kursus politik kepada para wanita, Istana Presiden Yogyakarta, 1947</span>\r\n              </blockquote>\r\n            ', 'uploads/image/quotes/quote_151122064114.jpg', 'jpg', 'blog', '70', 27, '2015-11-22 17:41:14'),
(9, 'left', '<p>Orang tidak dapat mengabdi kepada Tuhan dengan tidak mengabdi kepada sesama manusia. Tuhan Bersemayam di gubuknya si miskin</p>', 'Bung Karno, 23 Oktober 1946', '\r\n              \r\n                <div class="col-md-3 ta-c width100">\r\n                   <img src="" alt="Kutipan Soekarno">\r\n                </div>  \r\n              <blockquote class="blog-post-quote quote-depan col-md-9">\r\n                 <p class="lead"><p>Orang tidak dapat mengabdi kepada Tuhan dengan tidak mengabdi kepada sesama manusia. Tuhan Bersemayam di gubuknya si miskin</p></p>\r\n                 <span class="quote-author">Bung Karno, 23 Oktober 1946</span>\r\n              </blockquote>\r\n            ', 'uploads/image/quotes/quote_151122064015.jpg', 'jpg', 'blog', '72', 27, '2015-11-22 17:40:20'),
(10, 'right', '<p>Nasionalisme kita adalah nasionalisme yang membuat kita menjadi &quot;perkakasnya Tuhan&quot;, dan membuat kita menjadi &quot;hidup di dalam roh&quot;.</p>', 'Soekarno, Suluh Indonesia Muda, 1928', '\r\n              \r\n                <div class="col-md-3 col-md-push-9 ta-c width100">\r\n                    <img src="" alt="Kutipan Soekarno">\r\n                </div>\r\n              <blockquote class="blog-post-quote quote-depan col-md-9 col-md-pull-3">\r\n                <p class="lead"><p>Nasionalisme kita adalah nasionalisme yang membuat kita menjadi &quot;perkakasnya Tuhan&quot;, dan membuat kita menjadi &quot;hidup di dalam roh&quot;.</p></p>\r\n                <span class="quote-author">Soekarno, Suluh Indonesia Muda, 1928</span>\r\n              </blockquote>', 'uploads/image/quotes/quote_151122063959.jpg', 'jpg', 'blog', '70', 27, '2015-11-22 17:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `desc_prod` varchar(200) NOT NULL,
  `price_prod` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(100) NOT NULL,
  `file2` varchar(255) NOT NULL,
  `extention2` varchar(100) NOT NULL,
  `file3` varchar(255) NOT NULL,
  `extention3` varchar(100) NOT NULL,
  `file4` varchar(255) NOT NULL,
  `extention4` varchar(100) NOT NULL,
  `file5` varchar(255) NOT NULL,
  `extention5` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `prod_name`, `desc_prod`, `price_prod`, `file`, `extention`, `file2`, `extention2`, `file3`, `extention3`, `file4`, `extention4`, `file5`, `extention5`, `contact`) VALUES
(2, 'handphone', 'handphone asus murah banget', 2000000, 'true', '', 'true', '', 'true', '', 'true', '', 'true', '', 878787887),
(3, '', '', 0, 'true', '', 'true', '', 'true', '', 'true', '', 'true', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id_social` int(11) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `google` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id_social`, `facebook`, `twitter`, `google`, `instagram`, `youtube`) VALUES
(1, 'http://facebook.com/miniinc', 'https://twitter.com/miniinc', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `socmed`
--

CREATE TABLE `socmed` (
  `socmed_id` smallint(5) NOT NULL,
  `socmed_arrangement` tinyint(2) NOT NULL,
  `socmed_name` varchar(50) NOT NULL,
  `socmed_link` varchar(200) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `icon_class` varchar(30) NOT NULL,
  `author` smallint(5) NOT NULL,
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `socmed`
--

INSERT INTO `socmed` (`socmed_id`, `socmed_arrangement`, `socmed_name`, `socmed_link`, `file`, `extention`, `icon_class`, `author`, `create`) VALUES
(1, 1, 'Facebook', 'http://facebook.com3', '', '', 'e169', 0, '2015-10-24 05:21:01'),
(2, 2, 'Twitter', 'https://twitter.com', '', '', 'e16d', 0, '2015-09-16 04:16:15'),
(3, 3, 'Instagram', 'http://instagram', '', '', '', 0, '2016-01-18 06:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id_sponsors` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `desc_brand` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `ext` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id_sponsors`, `brand_name`, `desc_brand`, `file`, `ext`) VALUES
(1, 'Lorem ipsum', 'lorem ipsum', 'uploads/image/about/5_160320095415.jpg', 'jpg'),
(4, 'Lorem ipsum2', 'lorem ipsum2', 'uploads/image/about/2_160320095743.jpg', 'jpg'),
(5, 'Google', 'SO', 'uploads/image/about/1_160321091156.JPG', 'JPG');

-- --------------------------------------------------------

--
-- Table structure for table `sys_administrator`
--

CREATE TABLE `sys_administrator` (
  `id_administrator` smallint(5) NOT NULL,
  `id_privileges` smallint(2) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(15) NOT NULL,
  `image` varchar(255) NOT NULL COMMENT 'References to id_file',
  `extention` varchar(30) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_administrator`
--

INSERT INTO `sys_administrator` (`id_administrator`, `id_privileges`, `nickname`, `username`, `password`, `salt`, `image`, `extention`, `create_date`) VALUES
(27, 1, 'Administrator', 'hilmysyarif@gmail.com', '4423d50b5ebf4dd72e593aafbe03979bf1889987', '150920081442', 'uploads/image/1_160309095417.jpg', 'jpg', '2016-03-09 14:54:17'),
(29, 2, 'admin', 'admin@miniinc.id', '3484e06b285fc0f570e4a8b61fb870b66419aa9c', '160321091559', 'uploads/image/2_160321091559.jpg', 'jpg', '2016-03-21 14:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `sys_privileges`
--

CREATE TABLE `sys_privileges` (
  `sys_privileges_id` smallint(5) NOT NULL,
  `sys_privileges_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_privileges`
--

INSERT INTO `sys_privileges` (`sys_privileges_id`, `sys_privileges_name`) VALUES
(1, 'root'),
(2, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_charter`
--

CREATE TABLE `testimonial_charter` (
  `tc_id` smallint(5) NOT NULL,
  `charter_id` smallint(5) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extention` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial_charter`
--

INSERT INTO `testimonial_charter` (`tc_id`, `charter_id`, `file`, `extention`, `comment`, `user`, `date`) VALUES
(2, 40, 'uploads/image/testimonial/charter//author2_160121014511.png', 'png', 'Excellent - you found the right boat in the right place at the right time, and managed to change the dates for our convenience - brillian.', 'Cherish', '2016-01-21 06:45:13'),
(3, 41, 'uploads/image/testimonial/charter//author1_160121014144.png', 'png', 'Excellent - you found the right boat in the right place at the right time, and managed to change the dates for our convenience - brillian.', 'Marina Chamer', '2016-01-21 06:41:46'),
(4, 43, 'uploads/image/testimonial/charter//author2_160121013948.png', 'png', 'Excellent - you found the right boat in the right place at the right time,and managed to change the dates for our convenience - brillian.', 'Calista', '2016-01-21 06:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `u_subscribe`
--

CREATE TABLE `u_subscribe` (
  `u_subscribe_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `u_subscribe_email` varchar(70) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `u_subscribe`
--

INSERT INTO `u_subscribe` (`u_subscribe_id`, `name`, `u_subscribe_email`, `register_date`) VALUES
(1, '', 'hilmysyarif@gmail.com', '2016-02-18 19:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `web_setup`
--

CREATE TABLE `web_setup` (
  `web_setup_id` tinyint(2) NOT NULL,
  `status` enum('enable','disable') NOT NULL,
  `site_url` varchar(200) NOT NULL,
  `google_analytics` text NOT NULL,
  `file` varchar(225) NOT NULL,
  `extention` varchar(20) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `active_lang` smallint(5) NOT NULL COMMENT 'references to countries_id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_setup`
--

INSERT INTO `web_setup` (`web_setup_id`, `status`, `site_url`, `google_analytics`, `file`, `extention`, `favicon`, `active_lang`) VALUES
(1, '', 'http://www.kemprus.com', '', 'uploads/image/logo/logomini_160321073738.png', 'png', 'uploads/image/logo/logomini_160321073739.png', 64);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ads_id`);

--
-- Indexes for table `ads_place`
--
ALTER TABLE `ads_place`
  ADD PRIMARY KEY (`ads_place_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `banner_category`
--
ALTER TABLE `banner_category`
  ADD PRIMARY KEY (`banner_category_id`);

--
-- Indexes for table `banner_size`
--
ALTER TABLE `banner_size`
  ADD PRIMARY KEY (`banner_size_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`blog_category_id`);

--
-- Indexes for table `blog_child_category`
--
ALTER TABLE `blog_child_category`
  ADD PRIMARY KEY (`child_category_id`);

--
-- Indexes for table `blog_image_size`
--
ALTER TABLE `blog_image_size`
  ADD PRIMARY KEY (`blog_size_id`);

--
-- Indexes for table `blog_static`
--
ALTER TABLE `blog_static`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `blog_static_category`
--
ALTER TABLE `blog_static_category`
  ADD PRIMARY KEY (`blog_category_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `contact_message`
--
ALTER TABLE `contact_message`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`gallery_album_id`);

--
-- Indexes for table `gallery_get`
--
ALTER TABLE `gallery_get`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `ja_absensi_siswa`
--
ALTER TABLE `ja_absensi_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nis`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `nis_2` (`nis`),
  ADD KEY `nis_3` (`nis`),
  ADD KEY `nis_4` (`nis`);

--
-- Indexes for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pin` (`pin`) USING BTREE,
  ADD KEY `pin_2` (`pin`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `kehadiran` (`kehadiran`);

--
-- Indexes for table `ja_fp`
--
ALTER TABLE `ja_fp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ja_guru`
--
ALTER TABLE `ja_guru`
  ADD PRIMARY KEY (`No`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `pelajaran` (`id_pel`);

--
-- Indexes for table `ja_hari_libur`
--
ALTER TABLE `ja_hari_libur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ja_in_out`
--
ALTER TABLE `ja_in_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ja_jurusan`
--
ALTER TABLE `ja_jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `ja_karyawan`
--
ALTER TABLE `ja_karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nup` (`nup`);

--
-- Indexes for table `ja_kategori_izin`
--
ALTER TABLE `ja_kategori_izin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ja_kelas`
--
ALTER TABLE `ja_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `ja_ortu`
--
ALTER TABLE `ja_ortu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ja_settings`
--
ALTER TABLE `ja_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ja_siswa`
--
ALTER TABLE `ja_siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_finger` (`pin`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `log_album_loved`
--
ALTER TABLE `log_album_loved`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `log_album_view`
--
ALTER TABLE `log_album_view`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `log_article_loved`
--
ALTER TABLE `log_article_loved`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `log_article_view`
--
ALTER TABLE `log_article_view`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id_membership`);

--
-- Indexes for table `membership_car`
--
ALTER TABLE `membership_car`
  ADD PRIMARY KEY (`id_car`),
  ADD KEY `id_membership_2` (`id_membership`),
  ADD KEY `id_membership` (`id_membership`);

--
-- Indexes for table `membership_get`
--
ALTER TABLE `membership_get`
  ADD PRIMARY KEY (`get_id`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `page_about`
--
ALTER TABLE `page_about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `page_contact`
--
ALTER TABLE `page_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`page_content_id`);

--
-- Indexes for table `page_event`
--
ALTER TABLE `page_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `page_gallery`
--
ALTER TABLE `page_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_membership`
--
ALTER TABLE `page_membership`
  ADD PRIMARY KEY (`id_membership`);

--
-- Indexes for table `page_merchant`
--
ALTER TABLE `page_merchant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quotes_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id_social`);

--
-- Indexes for table `socmed`
--
ALTER TABLE `socmed`
  ADD PRIMARY KEY (`socmed_id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id_sponsors`);

--
-- Indexes for table `sys_administrator`
--
ALTER TABLE `sys_administrator`
  ADD PRIMARY KEY (`id_administrator`);

--
-- Indexes for table `sys_privileges`
--
ALTER TABLE `sys_privileges`
  ADD PRIMARY KEY (`sys_privileges_id`);

--
-- Indexes for table `testimonial_charter`
--
ALTER TABLE `testimonial_charter`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `u_subscribe`
--
ALTER TABLE `u_subscribe`
  ADD PRIMARY KEY (`u_subscribe_id`);

--
-- Indexes for table `web_setup`
--
ALTER TABLE `web_setup`
  ADD PRIMARY KEY (`web_setup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ads_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ads_place`
--
ALTER TABLE `ads_place`
  MODIFY `ads_place_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `banner_category`
--
ALTER TABLE `banner_category`
  MODIFY `banner_category_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `banner_size`
--
ALTER TABLE `banner_size`
  MODIFY `banner_size_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `blog_category_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `blog_child_category`
--
ALTER TABLE `blog_child_category`
  MODIFY `child_category_id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_image_size`
--
ALTER TABLE `blog_image_size`
  MODIFY `blog_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `blog_static`
--
ALTER TABLE `blog_static`
  MODIFY `blog_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `blog_static_category`
--
ALTER TABLE `blog_static_category`
  MODIFY `blog_category_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contact_message`
--
ALTER TABLE `contact_message`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `gallery_album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `gallery_get`
--
ALTER TABLE `gallery_get`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ja_absensi_siswa`
--
ALTER TABLE `ja_absensi_siswa`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ja_fp`
--
ALTER TABLE `ja_fp`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ja_guru`
--
ALTER TABLE `ja_guru`
  MODIFY `No` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ja_hari_libur`
--
ALTER TABLE `ja_hari_libur`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ja_in_out`
--
ALTER TABLE `ja_in_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `ja_jurusan`
--
ALTER TABLE `ja_jurusan`
  MODIFY `id_jurusan` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ja_karyawan`
--
ALTER TABLE `ja_karyawan`
  MODIFY `id_karyawan` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ja_kategori_izin`
--
ALTER TABLE `ja_kategori_izin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ja_kelas`
--
ALTER TABLE `ja_kelas`
  MODIFY `id_kelas` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ja_ortu`
--
ALTER TABLE `ja_ortu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ja_siswa`
--
ALTER TABLE `ja_siswa`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `log_album_loved`
--
ALTER TABLE `log_album_loved`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_album_view`
--
ALTER TABLE `log_album_view`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_article_loved`
--
ALTER TABLE `log_article_loved`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_article_view`
--
ALTER TABLE `log_article_view`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id_membership` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `membership_car`
--
ALTER TABLE `membership_car`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `membership_get`
--
ALTER TABLE `membership_get`
  MODIFY `get_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `page_about`
--
ALTER TABLE `page_about`
  MODIFY `about_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `page_contact`
--
ALTER TABLE `page_contact`
  MODIFY `contact_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `page_content`
--
ALTER TABLE `page_content`
  MODIFY `page_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `page_event`
--
ALTER TABLE `page_event`
  MODIFY `event_id` smallint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `page_gallery`
--
ALTER TABLE `page_gallery`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `page_membership`
--
ALTER TABLE `page_membership`
  MODIFY `id_membership` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `page_merchant`
--
ALTER TABLE `page_merchant`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `quotes_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `socmed`
--
ALTER TABLE `socmed`
  MODIFY `socmed_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id_sponsors` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sys_administrator`
--
ALTER TABLE `sys_administrator`
  MODIFY `id_administrator` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `sys_privileges`
--
ALTER TABLE `sys_privileges`
  MODIFY `sys_privileges_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `testimonial_charter`
--
ALTER TABLE `testimonial_charter`
  MODIFY `tc_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `u_subscribe`
--
ALTER TABLE `u_subscribe`
  MODIFY `u_subscribe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `web_setup`
--
ALTER TABLE `web_setup`
  MODIFY `web_setup_id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ja_absensi_siswa`
--
ALTER TABLE `ja_absensi_siswa`
  ADD CONSTRAINT `ja_absensi_siswa_ibfk_2` FOREIGN KEY (`kd_kelas`) REFERENCES `ja_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ja_data_absen`
--
ALTER TABLE `ja_data_absen`
  ADD CONSTRAINT `ja_data_absen_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `ja_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ja_data_absen_ibfk_2` FOREIGN KEY (`pin`) REFERENCES `ja_siswa` (`pin`);

--
-- Constraints for table `ja_siswa`
--
ALTER TABLE `ja_siswa`
  ADD CONSTRAINT `ja_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `ja_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
