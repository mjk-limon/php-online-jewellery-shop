-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2019 at 07:41 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ratri`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `date_added` varchar(900) COLLATE latin1_general_ci NOT NULL,
  `Token` varchar(2000) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `date_added`, `Token`) VALUES
(1, 'admin', '12345', '21/11/17', '7j0jf39Yn56VPDK4');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `Name` varchar(900) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(900) COLLATE latin1_general_ci NOT NULL,
  `Subject` text COLLATE latin1_general_ci NOT NULL,
  `Message` varchar(9000) COLLATE latin1_general_ci NOT NULL,
  `admin_read` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

DROP TABLE IF EXISTS `contact_information`;
CREATE TABLE IF NOT EXISTS `contact_information` (
  `address` text NOT NULL,
  `address2` text NOT NULL,
  `mobile1` varchar(90) NOT NULL,
  `mobile2` varchar(90) NOT NULL,
  `mobile3` varchar(90) NOT NULL,
  `phone` varchar(90) NOT NULL,
  `email` varchar(90) NOT NULL,
  `facebook` varchar(900) DEFAULT NULL,
  `twitter` varchar(900) DEFAULT NULL,
  `instagram` varchar(900) DEFAULT NULL,
  `linkedin` varchar(900) NOT NULL,
  `googleplus` varchar(900) DEFAULT NULL,
  `gmail` varchar(900) DEFAULT NULL,
  `youtube` varchar(900) DEFAULT NULL,
  `yahoo` varchar(900) DEFAULT NULL,
  `skype` varchar(900) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`address`, `address2`, `mobile1`, `mobile2`, `mobile3`, `phone`, `email`, `facebook`, `twitter`, `instagram`, `linkedin`, `googleplus`, `gmail`, `youtube`, `yahoo`, `skype`) VALUES
('87, BNS Center, Level 5, Room 618 ,Sector 7, Uttara,\r\n                  Dhaka - 1230. Bangladesh .', '', '+88 01709 309 110', '+88 01956 758 055', '', '+88 02 4895 4862', 'info@dhakasolution.com', 'https://www.facebook.com/dhakasolutions', 'http://twitter.com/', 'http://instagram.com', '', 'http://plus.google.com/', 'info@dhakasolution.com', 'http://pinterest.com/', 'http://yahoo.com/', 'http://skype.com/');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(90) NOT NULL,
  `coupon` varchar(900) NOT NULL,
  `discount` int(11) NOT NULL,
  `used_order_no` varchar(999) DEFAULT NULL,
  `used_amount` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `username`, `coupon`, `discount`, `used_order_no`, `used_amount`) VALUES
(8, '', 'Testing', 1600, '10286', '400'),
(4, 'jhmasterlimon11@gmail.com', 'Limon360', 0, '', ''),
(3, 'jhmasterlimon11@gmail.com', 'asdfg1234', 0, '55955', '0'),
(9, '', 'Saiful360', 1000, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(1, 'mjk.limon@outlook.com'),
(2, 'jhmasterlimon@gmail.com'),
(3, 'jhmasterlimon11@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

DROP TABLE IF EXISTS `page_contents`;
CREATE TABLE IF NOT EXISTS `page_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(99) NOT NULL,
  `header` varchar(900) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `page`, `header`, `content`) VALUES
(1, 'about-us', 'About Us', '<p>About my shop:</p><p>Our shop location: http//ornamentsworld.com<br></p>'),
(3, 'term-and-condition', 'Terms &amp; Condition', 'Hihjlakjfkljafdab '),
(4, 'our-certification', 'Our certification', ''),
(5, 'stores', 'Stores', ''),
(6, 'refund-policy', 'Refund Policy', '<div class=\"page-title\"><p>\r\n        </p><p style=\"\"><b><span style=\"font-family: &quot;Arial&quot;;\" impact\";\"=\"\">No Questions Asked Refund Policy</span></b></p><p>\r\n    </p></div>\r\n<p class=\"MsoNormal\">If the customer wishes to return \r\nour product, he/she can do so within 14 days. We will ensure that the \r\nentire amount is refunded to the customerâ€™s account within 10 working \r\ndays. Below mentioned conditions are applicable for refund.&nbsp;</p>\r\n<ul><li><p>If the customers do not like our product, he/ she can send the \r\nproduct back to us within 14days. We will make sure to refund the entire\r\n amount back to customerâ€™s account within 10 working days</p></li></ul>\r\n<ul><li><p>\r\n</p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-indent: -.25in; mso-list: l0 level1 lfo1;\"><span style=\"font-family: Symbol; mso-fareast-font-family: Symbol; mso-bidi-font-family: Symbol;\"><span style=\"mso-list: Ignore;\"><span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span>You\r\n can find registered address on www.malabargoldanddiamonds.com and the \r\nrefund will be applicable only if the product is shipped to the \r\nregistered address within 14 days</p><p>\r\n</p></li><li><p>\r\n</p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -.25in; mso-list: l0 level1 lfo1;\"><span style=\"font-family: Symbol; mso-fareast-font-family: Symbol; mso-bidi-font-family: Symbol;\"><span style=\"mso-list: Ignore;\"><span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span>This refund facility is available only through www.malabargoldanddiamonds.com and not through other stores in India</p><p>\r\n</p></li><li><p>\r\n</p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -.25in; mso-list: l0 level1 lfo1;\"><span style=\"font-family: Symbol; mso-fareast-font-family: Symbol; mso-bidi-font-family: Symbol;\"><span style=\"mso-list: Ignore;\"><span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span>This\r\n refund is subject to quality confirmation by our skilled quality \r\nassurance team and on verification that the packaging of the same is \r\ncomplete with all the&nbsp; documents like insurance certificate, original \r\ninvoice and product certificate</p><p>\r\n</p></li><li><p>\r\n</p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -.25in; mso-list: l0 level1 lfo1;\"><span style=\"font-family: Symbol; mso-fareast-font-family: Symbol; mso-bidi-font-family: Symbol;\"><span style=\"mso-list: Ignore;\"><span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span>This\r\n policy is not applicable for products that are ordered with specific \r\nindications like smart buy, customization, engraving, purchase using \r\npromotion code or by discount coupon.</p><p>\r\n</p></li><li><p>\r\n</p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-indent: -.25in; mso-list: l0 level1 lfo1;\"><span style=\"font-family: Symbol; mso-fareast-font-family: Symbol; mso-bidi-font-family: Symbol;\"><span style=\"mso-list: Ignore;\"><span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span>To\r\n initiate return, we would send a â€˜Return Packaging Kitâ€™ to the customer\r\n to pack the product in such packaging and handover the same to courier \r\nperson. The whole reverse pick up procedure would take atleast 7-10 \r\nworking days. It is also advised to note down the courier airway bill \r\nnumber.</p><p>\r\n</p></li><li><p>\r\n</p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent: -.25in; mso-list: l0 level1 lfo1;\"><span style=\"font-family: Symbol; mso-fareast-font-family: Symbol; mso-bidi-font-family: Symbol;\"><span style=\"mso-list: Ignore;\"><span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span>Once the product is received and successfully undergoes the quality check, the refund shall be done.</p><p>\r\n</p></li><li><p>\r\n</p><p class=\"MsoListParagraphCxSpLast\" style=\"text-indent: -.25in; mso-list: l0 level1 lfo1;\">&nbsp; &nbsp; &nbsp; 14 days refund policy is not applicable for gold coins, silver articles and gold rakhi. &nbsp;&nbsp;</p><p>\r\n</p></li></ul>'),
(11, 'certified-jewellery', 'Certified Jewellery', ''),
(8, 'free-shipping', 'Free Shipping', ''),
(9, 'privacy-policy', 'Privacy Policy', ''),
(10, 'lifetime-product-service', 'Lifetime Product Service', '');

-- --------------------------------------------------------

--
-- Table structure for table `procat`
--

DROP TABLE IF EXISTS `procat`;
CREATE TABLE IF NOT EXISTS `procat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main` varchar(90) NOT NULL,
  `main_bn` varchar(900) DEFAULT NULL,
  `sub` varchar(90) NOT NULL,
  `header` varchar(900) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `procat`
--

INSERT INTO `procat` (`id`, `main`, `main_bn`, `sub`, `header`, `position`) VALUES
(146, 'gold', '', 'ring', 'ring', 100),
(147, 'gold', '', 'earring', 'ring', 100),
(148, 'gold', '', 'locket', 'ring', 100),
(149, 'gold', '', 'nosepin', 'ring', 100),
(150, 'gold', '', 'bangle', 'ring', 100),
(151, 'gold', '', 'necklace', 'ring', 100),
(152, 'gold', '', 'bracelet', 'ring', 100),
(153, 'gold', '', 'pendant set', 'ring', 100),
(154, 'diamond', '', 'ring', 'all', 100),
(155, 'diamond', '', 'earring', 'all', 100),
(156, 'diamond', '', 'locket', 'all', 100),
(157, 'diamond', '', 'nosepin', 'all', 100),
(158, 'diamond', '', 'bracelet', 'all', 100),
(159, 'diamond', '', 'necklace', 'all', 100),
(162, 'silver', '', 'ring', 'all', 100),
(163, 'silver', '', 'locket', 'all', 100),
(164, 'silver', '', 'anklets', 'all', 100),
(165, 'silver', '', 'earring', 'all', 100),
(166, 'men\'s collection', '', 'ring', 'all', 100),
(168, 'men\'s collection', '', 'chain', 'all', 100),
(169, 'men\'s collection', '', 'bracelet', 'all', 100);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(900) NOT NULL,
  `category` varchar(900) NOT NULL,
  `subcategory` varchar(900) NOT NULL,
  `brand` varchar(90) NOT NULL,
  `size` varchar(90) NOT NULL,
  `colors` varchar(9000) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `views` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `images` varchar(900) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `item_left` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL DEFAULT '0-0',
  `others` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `subcategory`, `brand`, `size`, `colors`, `description`, `price`, `views`, `discount`, `images`, `date_added`, `item_left`, `rating`, `others`) VALUES
(100123, 'Yutika Hearts Gold Ring', 'gold', 'ring', '', '3,4,7,10,17,2.4', '', '<p><font color=\"#afafaf\" face=\"Open Sans, sans-serif\"><span style=\"white-space: nowrap;\">Style no -&nbsp;</span></font><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">GR00103</span></p><p><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">Height -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">21.00 mm</span></p><p><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Width -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">19.75 mm</span></p><p><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Bottom Thickness -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">2.00 mm</span></p><p><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Top Thickness -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">7.60 mm</span></p><p><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Top Height -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">3.00 mm</span></p><p><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Total Weight -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">3.53 Gms</span></p><p><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Metal -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">Yellow Gold</span></p><p><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Purity -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">22K</span></p>', 19427, 0, 0, '1', '2019-03-27 00:00:00', 35, '0-0', ''),
(100124, 'CARI ZIAH DIAMOND RING', 'diamond', 'ring', '', '2.6,3,4,7,10,16,19,20', '', '<p style=\"margin-bottom: 0px;\"><font color=\"#afafaf\" face=\"Open Sans, sans-serif\"><span style=\"white-space: nowrap;\">Style no -&nbsp;</span></font><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">KC00032</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">Height - 3.55</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">&nbsp;mm</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Width - </span><span style=\"font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap; font-size: 15px;\"><font color=\"#716f6f\">1.68Gms</font></span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Bottom Thickness - 1.30</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">&nbsp;mm</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Top Thickness - 7.65</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">&nbsp;mm</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Top Height -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">3.00 mm</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Total Weight - </span><span style=\"font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap; font-size: 15px;\"><font color=\"#716f6f\">0.19 Ct</font></span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Total No. of Diamonds - 17</span><span style=\"font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap; font-size: 15px;\"><font color=\"#716f6f\"><br></font></span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Metal - Rose</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">&nbsp;Gold</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\">Purity - 18</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\">K</span></p>', 27872, 0, 0, '1', '2019-03-27 00:00:00', 32, '0-0', ''),
(100125, 'BRIANNE DIAMOND EARRINGS', 'diamond', 'earring', '', '', '', '<p style=\"margin-bottom: 0px;\"><font face=\"Open Sans, sans-serif\" color=\"#afafaf\"><span style=\"white-space: nowrap; font-family: &quot;Times New Roman&quot;;\">Style no -&nbsp;</span></font><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">C002667</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">Height -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">15.80 mm</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Width -&nbsp;</span><span style=\"font-family: &quot;Times New Roman&quot;; white-space: nowrap; font-size: 15px;\"><font color=\"#716f6f\">14.00 mm</font></span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Total Weight -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">3.43 Gms</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Total No. of Diamonds - 14</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Setting Type - Prong</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Diamond Weight (Approx) - 0.28Ct</span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Metal Weight (Approx) - 3.40Gms</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\"><br></span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Metal - White</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">&nbsp;Gold</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; white-space: nowrap;\"><br></span></p><p style=\"margin-bottom: 0px;\"><span style=\"color: rgb(175, 175, 175); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Purity - 14</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">K</span></p>', 35996, 0, 0, '1', '2019-04-13 00:00:00', 40, '0-0', ''),
(100126, 'Mandala Traditional Silver Earrings', 'silver', 'earring', 'Joker & Witch', '', '', '<p style=\"margin-bottom: 10px; color: rgb(102, 102, 102); font-family: &quot;Source Sans Pro&quot;, sans-serif; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Length- 6.5</span></p><p style=\"margin-bottom: 10px; color: rgb(102, 102, 102); font-family: &quot;Source Sans Pro&quot;, sans-serif; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Width- 3.5</span></p><p style=\"margin-bottom: 10px; color: rgb(102, 102, 102); font-family: &quot;Source Sans Pro&quot;, sans-serif; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Color:</span><span style=\"font-weight: bold; font-family: &quot;Times New Roman&quot;;\">&nbsp;</span><span style=\"font-family: &quot;Times New Roman&quot;;\">Silver</span></p><p style=\"margin-bottom: 10px; color: rgb(102, 102, 102); font-family: &quot;Source Sans Pro&quot;, sans-serif; font-size: 16px;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Material:</span><span style=\"font-weight: bold; font-family: &quot;Times New Roman&quot;;\">&nbsp;</span><span style=\"font-family: &quot;Times New Roman&quot;;\">Metal/Alloy</span></p>', 647, 0, 0, '1', '2019-03-28 15:21:46', 25, '0-0', NULL),
(100127, 'MRIDANI GOLD EARRINGS', 'gold', 'earring', '', '', '', '<p style=\"text-align: left; margin-left: 25px;\"><font color=\"#afafaf\" face=\"Open Sans, sans-serif\"><span style=\"white-space: nowrap; font-family: &quot;Times New Roman&quot;;\">Style No-&nbsp;</span></font><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">VRGE014</span></p><p style=\"text-align: left; margin-left: 25px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Height -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">55.23 mm</span></p><p style=\"text-align: left; margin-left: 25px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Width -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">24.04 mm</span></p><p style=\"text-align: left; margin-left: 25px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Total Weight -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">19.11 Gms</span></p><p style=\"text-align: left; margin-left: 25px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Metal -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">Yellow Gold</span></p><p style=\"text-align: left; margin-left: 25px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Purity - 22K</span></p><p style=\"margin-left: 25px;\"><div style=\"text-align: left;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; white-space: nowrap;\">Metal Weight (Approx) -&nbsp;</span><span style=\"color: rgb(113, 111, 111); font-family: &quot;Times New Roman&quot;; font-size: 15px; white-space: nowrap;\">19.11 Gms</span></div><div style=\"text-align: left;\"><font color=\"#716f6f\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px; white-space: nowrap;\"><br></span></font></div><div style=\"text-align: left;\"><font color=\"#716f6f\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px; white-space: nowrap;\"><br></span></font></div><div style=\"text-align: left;\"><font color=\"#716f6f\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px; white-space: nowrap;\"><br></span></font></div><div style=\"text-align: left;\"><font color=\"#716f6f\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 15px; white-space: nowrap;\"><br></span></font></div></p><p style=\"text-align: left; margin-left: 25px;\"><span style=\"color: rgb(113, 111, 111); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 15px; white-space: nowrap;\"><br></span></p>', 109641, 0, 0, '1', '2019-03-28 15:36:48', 15, '0-0', NULL),
(100128, 'Wedding Heavy Silver Anklet', 'silver', 'anklets', 'SEVAK 70', '', '', '<p><span style=\"color: rgb(132, 132, 132); font-family: &quot;Times New Roman&quot;; font-size: 16px;\">Brand -&nbsp;</span><span style=\"font-family: &quot;Times New Roman&quot;; font-size: 16px;\">SEVAK 70</span><br></p><p><span style=\"color: rgb(132, 132, 132); font-family: &quot;Times New Roman&quot;; font-size: 16px;\">Purity -&nbsp;</span><span style=\"font-family: &quot;Times New Roman&quot;; font-size: 16px;\">67%</span></p><p><span style=\"color: rgb(132, 132, 132); font-family: &quot;Times New Roman&quot;; font-size: 16px;\">Polish Type -&nbsp;</span><span style=\"font-family: &quot;Times New Roman&quot;; font-size: 16px;\">Platinum Polish</span></p><p><span style=\"color: rgb(132, 132, 132); font-family: &quot;Times New Roman&quot;; font-size: 16px;\">Minimum Order Quantity -&nbsp;</span><span style=\"font-family: &quot;Times New Roman&quot;; font-size: 16px;\">5 Kilogram</span><span style=\"font-family: arial; font-size: 16px;\"><br></span><span style=\"font-family: arial; font-size: 16px;\"><br></span><span style=\"font-family: arial; font-size: 16px;\"><br></span><br></p>', 608, 0, 0, '1', '2019-03-28 16:04:55', 17, '0-0', NULL),
(100129, 'TYCOON CUT MEN\'S DIAMOND RING', 'men\'s collection', 'ring', 'Talori', '4,7,10,18,19,20', '', '<p><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">Stones: - 4 Round &amp; 4 Princess Cut F color,</span><br></p><p><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">VS clarity&nbsp;</span><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">Diamonds 0.72cttw. - 12 Princess Cut Black Sapphires 0.76cttw</span></p><p><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">Metal: 18KT Rose Gold</span><br></p>', 2625, 0, 0, '1', '2019-03-29 18:00:02', 10, '0-0', NULL),
(100130, 'Rivertree Gold Classic Anchor Braided Leather Bracele', 'men\'s collection', 'bracelet', 'Rivertree', '', 'black', '<h3><font color=\"#111111\" face=\"Arial, sans-serif\"><span style=\"font-size: 13px; text-transform: none; background-color: rgb(243, 243, 243); font-family: &quot;Times New Roman&quot;;\"><span style=\"font-family: Roboto;\">Metal - Gold_plated</span><br></span></font><h3><font color=\"#111111\" face=\"Arial, sans-serif\"><span style=\"font-size: 13px; text-transform: none; background-color: rgb(243, 243, 243); font-family: &quot;Times New Roman&quot;;\"><span style=\"font-family: Roboto;\"><span style=\"font-family: Roboto;\">Material Type - Leather</span><br></span></span></font><font color=\"#111111\" face=\"Arial, sans-serif\"><span style=\"font-size: 13px; text-transform: none; background-color: rgb(243, 243, 243); font-family: &quot;Times New Roman&quot;;\"><span style=\"font-family: Roboto;\"><span style=\"font-family: Roboto;\">Gem Type - No Stone</span><br></span></span></font><font color=\"#111111\" face=\"Arial, sans-serif\"><span style=\"font-size: 13px; text-transform: none; background-color: rgb(243, 243, 243); font-family: &quot;Times New Roman&quot;;\"><span style=\"font-family: Roboto;\"><span style=\"font-family: Roboto;\">Model Number - 2655</span><br></span></span></font><font color=\"#111111\" face=\"Times New Roman\"><span style=\"font-size: 13px; text-transform: none; font-family: Roboto;\">Re-sizable</span></font><font color=\"#111111\" face=\"Arial, sans-serif\"><span style=\"font-size: 13px; text-transform: none; background-color: rgb(243, 243, 243); font-family: Roboto;\">&nbsp;- No</span></font><font color=\"#111111\" face=\"Arial, sans-serif\"><span style=\"font-size: 13px; text-transform: none; background-color: rgb(243, 243, 243); font-family: &quot;Times New Roman&quot;;\"><br></span></font><font color=\"#111111\" face=\"Arial, sans-serif\"><span style=\"font-size: 13px; text-transform: none; background-color: rgb(243, 243, 243); font-family: &quot;Times New Roman&quot;;\"><br></span></font><br><table id=\"technicalSpecifications_section_1\" class=\"a-keyvalue a-spacing-mini\" style=\"margin-bottom: 22px; width: 652px; border-bottom: 1px solid rgb(231, 231, 231); color: rgb(17, 17, 17); font-family: Arial, sans-serif; font-size: 13px; text-transform: none; background-color: rgb(255, 255, 255);\"><tbody></tbody></table></h3></h3>', 767, 0, 0, '1', '2019-04-05 17:56:02', 30, '0-0', NULL),
(100131, 'Stainless Steel Vintage Silicone Bracelet', 'men\'s collection', 'bracelet', '', '', 'black', '<h4><strong style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: Lato; color: rgb(68, 68, 68);\"></strong></h4><h4 style=\"font-family: Roboto, sans-serif; color: rgb(0, 0, 0);\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 14px; line-height: inherit; font-family: Lato; color: rgb(68, 68, 68); text-transform: none;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"font-weight: 700; margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit;\"></span></span></span></h4><h4 style=\"\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Brand Name:</span><span style=\"font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;liujun</span></span></span></h4><h4 style=\"\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Material:</span><span style=\"font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Metal</span></span><br></span></h4><h4><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Metals Type:</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Stainless Steel</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">ï»¿</span></h4><h4><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Style:</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Trendy</span><br style=\"\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Shape\\pattern:</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Geometric</span></span></h4><h4><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">is_customized:</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Yes</span><br><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Clasp Type:</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Hidden-safety-clasp</span></span><br><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Chain Type:</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Rope Chain</span></span></h4><h4><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">Feature:</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Times New Roman&quot;;\">High Quality in EU and AU</span><br></span></h4><h4><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><span style=\"margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit;\"><br></span><br></span><span style=\"font-family: &quot;Times New Roman&quot;;\"><br></span></h4>', 321, 0, 0, '1', '2019-04-05 18:13:17', 15, '0-0', NULL),
(100132, 'Malabar Gold Pendant NZPN049', 'gold', 'locket', 'Malabar', '', 'yellow', '<h3 style=\"line-height:normal\"><h4 style=\"line-height:normal\"><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Product Code : NZPN</span><span lang=\"BN-BD\" style=\"font-family: &quot;Times New Roman&quot;;\">049</span></span></h4></h3><h3 style=\"line-height:normal\"><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Product Type</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\"> </span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">- </span><span style=\"font-size:15.0pt;mso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Pendant<br></span><o:p></o:p></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Brands</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\"> </span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">- </span><span style=\"font-size:15.0pt;mso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Malabar<br></span><o:p></o:p></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Item package quantity</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\"> </span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">- 1<br></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Gold Purity</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\"> </span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">- 22</span><span style=\"font-size:15.0pt;mso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\"> KT (</span><span lang=\"BN-BD\" style=\"font-family: &quot;Times New Roman&quot;;\">916)<br></span><o:p></o:p></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Metal Color</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\"> </span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">- </span><span style=\"font-size:15.0pt;mso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Yellow<br></span><o:p></o:p></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Gross Weight (Approx Gms)</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\"> </span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">- 2.65<br></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Net Weight (Approx Gms)</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\"> </span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">- 2.65<br></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Gold Certification</span><span lang=\"BN-BD\" style=\"font-family: &quot;Times New Roman&quot;;\"> - 916</span></span></h3><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span>', 12247, 0, 0, '1', '2019-04-05 18:29:33', 35, '0-0', NULL),
(100133, 'Women\'s Beautiful Moon & Star Design Pendant', 'gold', 'locket', '', '', '', '<h3 style=\"line-height:normal\"><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Arial Unicode MS&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Jewellery Type : Pendant<br></span></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Arial Unicode MS&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Stone : Cubic Zirconia<br></span></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Material :</span><span lang=\"BN-BD\" style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">14</span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Arial Unicode MS&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">K Gold Plated<br></span><o:p></o:p></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Arial Unicode MS&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Stone Shape :Round<br></span></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Arial Unicode MS&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Stone Colour :White</span></span></h3><p><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span></p>', 3649, 0, 0, '1', '2019-04-05 18:38:19', 12, '0-0', NULL),
(100134, 'CaratLane 18K Yellow Gold and Diamond Ring', 'gold', 'ring', 'CaratLane ', '7,10,16,4', '', '<h3 style=\"line-height:normal\"><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Material : </span><span style=\"font-family: &quot;Times New Roman&quot;;\" lang=\"BN-BD\">18</span><span style=\"font-family: &quot;Times New Roman&quot;;\">k\r\ngold<br></span></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Product height </span><span style=\"font-family: &quot;Times New Roman&quot;;\" lang=\"BN-BD\">- 7.25</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\nmm<br> </span></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">width </span><span style=\"font-family: &quot;Times New Roman&quot;;\" lang=\"BN-BD\">- 14.96</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\nmm<br></span></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">Diamond carat </span><span style=\"font-family: &quot;Times New Roman&quot;;\" lang=\"BN-BD\">- 0.17</span><span style=\"font-family: &quot;Times New Roman&quot;;\">,<br></span></span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">Stone Clarity</span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\">ï»¿</span><span style=\"font-size: 15pt; font-family: &quot;Times New Roman&quot;;\" lang=\"BN-BD\"> - </span><span style=\"font-size:15.0pt;mso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">SI </span><span style=\"font-family: &quot;Times New Roman&quot;;\">&nbsp;<br></span><o:p></o:p></span><span style=\"font-size:15.0pt;\r\nmso-bidi-font-family:&quot;Times New Roman&quot;\"><span style=\"font-family: &quot;Times New Roman&quot;;\">color IJ, This ring has been adorned\r\nwith real diamonds</span><span style=\"font-family: &quot;Times New Roman&quot;;\" lang=\"BN-BD\"> </span><span style=\"font-family: &quot;Times New Roman&quot;;\">verified by IGI</span><span style=\"font-family: &quot;Times New Roman&quot;;\" lang=\"BN-BD\">.</span></span></h3><p><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span><span style=\"font-family: &quot;Times New Roman&quot;;\">\r\n\r\n</span></p>', 18, 0, 0, '1', '2019-04-13 00:00:00', 13, '0-0', '2');

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

DROP TABLE IF EXISTS `product_comments`;
CREATE TABLE IF NOT EXISTS `product_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `name` varchar(900) NOT NULL,
  `email` varchar(90) NOT NULL,
  `message` text NOT NULL,
  `prid` int(11) NOT NULL,
  `admin_read` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`id`, `date`, `name`, `email`, `message`, `prid`, `admin_read`) VALUES
(8, '2000-01-01 00:00:00', 'Limon', 'jhmasterlimon11@gmail.com', 'This is testing', 100100, 1),
(12, '2000-01-01 00:00:00', 'Limon', 'jhmasterlimon11@gmail.com', 'I want this product. Which color availabe do you have ??.. simply wow this product', 100101, 1),
(14, '2000-01-01 00:00:00', 'Aladin Kids', 'info@dhakasolution.com', '@Limon No more color available thank you', 100101, 1),
(15, '2000-01-01 00:00:00', 'Aladin Kids', 'info@dhakasolution.com', '@Limon sample', 100100, 1),
(16, '2000-01-01 00:00:00', 'Solayman', 'solayman@gmail.com', 'I love this product', 100100, 0),
(17, '2000-01-01 00:00:00', 'Chandny', 'c_handi@gmail.com', 'à¦•à§Ÿà¦Ÿà¦¾ à¦•à¦¾à¦²à¦¾à¦° à¦†à¦›à§‡ ??', 100120, 0);

-- --------------------------------------------------------

--
-- Table structure for table `p_order`
--

DROP TABLE IF EXISTS `p_order`;
CREATE TABLE IF NOT EXISTS `p_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` int(11) NOT NULL,
  `date` varchar(90) NOT NULL,
  `name` varchar(900) DEFAULT NULL,
  `phone` varchar(90) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `address` text NOT NULL,
  `location` varchar(90) NOT NULL,
  `shipment` varchar(99) DEFAULT NULL,
  `payment` varchar(99) NOT NULL,
  `payment_number` varchar(99) DEFAULT NULL,
  `payment_trxn_id` varchar(99) DEFAULT NULL,
  `pr_id` varchar(9000) NOT NULL,
  `pr_size` varchar(9000) NOT NULL,
  `pr_qty` varchar(9000) NOT NULL,
  `pr_color` varchar(9000) NOT NULL,
  `admin_read` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_order`
--

INSERT INTO `p_order` (`id`, `order_no`, `date`, `name`, `phone`, `email`, `address`, `location`, `shipment`, `payment`, `payment_number`, `payment_trxn_id`, `pr_id`, `pr_size`, `pr_qty`, `pr_color`, `admin_read`) VALUES
(38, 85053, '28-03-2018', 'jhmasterlimon11@gmail.com', '', 'jhmasterlimon11@gmail.com', ', ', '', NULL, 'cod', NULL, NULL, '100100', 'XL', '1', 'Red', 2),
(34, 25938, '01-11-2017', 'jhmasterlimon11@gmail.com', '', 'jhmasterlimon11@gmail.com', ', ', '', NULL, 'cod', NULL, NULL, '100100', 'XL', '1', 'Red', 2),
(42, 20895, '20-01-2018', 'jhmasterlimon11@gmail.com', '', 'jhmasterlimon11@gmail.com', ', ', '', NULL, 'cod', NULL, NULL, '100110', 'XL', '1', 'N/A', 0),
(44, 77873, '03-02-2018', 'jhmasterlimon11@gmail.com', '', 'jhmasterlimon11@gmail.com', ', ', '', NULL, 'cod', NULL, NULL, '100127,100126,100125', 'N/A,N/A,N/A', '1,1,2', 'N/A,N/A,N/A', 2),
(45, 67516, '20-02-2018', '', '019546758055', NULL, '87, BNS CENTER,  UTTARA, DHAKA, BANGLADESH, Dhaka', '', NULL, 'cod', NULL, NULL, '100126', 'L', '3', 'N/A', 1),
(57, 38287, '09-04-2018', '', '01675234677', '', 'House 8, Road 7, Sector 9, Uttara, Dhaka', 'dhaka', 'Normal', 'cod', '', '', '100110', 'N/A', '6', 'N/A', 0),
(114, 46414, '11-09-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100132,100127', '4-6 Years,N/A', '2,1', 'N/A,N/A', 0),
(93, 63558, '04-05-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100131', 'N/A', '1', 'N/A', 0),
(94, 91046, '05-05-2018', '', '1642993991', '', 'Ashkona Community Center\nAshkona, Dhaka, Bangladesh', 'dhaka', 'Normal', 'cod', '', '', '100125,100110', 'L,N/A', '1,1', 'N/A,N/A', 0),
(95, 97311, '05-05-2018', '', '1642993991', '', 'Ashkona Community Center\nAshkona, Dhaka, Bangladesh', 'other', 'Normal', 'cod', '', '', '100125,100110', 'L,N/A', '1,1', 'N/A,N/A', 0),
(102, 20200, '07-05-2018', 'Sonya Mirza ', '01942432941', 'sonyamirza@gmail.com', 'Kualalampur, Rong City, , Abroad', 'Abroad', 'Normal', 'cod', '', '', '100123', 'M', '1', 'N/A', 0),
(103, 99189, '16-07-2018', '', '1956758055', '', 'House # 5, Road # 7/C, Sector # 9\nUttara, Dhaka-1230, Bangladesh', 'dhaka', 'Normal', 'cod', '', '', '100127', 'N/A', '1', 'N/A', 0),
(104, 66683, '16-07-2018', '', '1956758055', '', 'House # 5, Road # 7/C, Sector # 9\nUttara, Dhaka-1230, Bangladesh', 'dhaka', 'Normal', 'cod', '', '', '100127', 'N/A', '1', 'N/A', 0),
(105, 37386, '16-07-2018', '', '1956758055', '', 'House # 5, Road # 7/C, Sector # 9\nUttara, Dhaka-1230, Bangladesh', 'dhaka', 'Normal', 'cod', '', '', '100127', 'N/A', '1', 'N/A', 0),
(106, 66030, '16-07-2018', '', '1956758055', '', 'House # 5, Road # 7/C, Sector # 9\nUttara, Dhaka-1230, Bangladesh', 'dhaka', 'Normal', 'cod', '', '', '100127', 'N/A', '1', 'N/A', 0),
(107, 37770, '16-07-2018', '', '1956758055', '', 'House # 5, Road # 7/C, Sector # 9\nUttara, Dhaka-1230, Bangladesh', 'dhaka', 'Normal', 'bkash', '01956758055', 'asdfg1234', '100127', 'N/A', '1', 'N/A', 0),
(108, 77230, '15-08-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100108', 'M', '2', 'green', 0),
(109, 17380, '15-08-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100108,100100', 'M,XL', '2,2', 'green,red', 0),
(110, 73489, '15-08-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100108,100100', 'M,XL', '2,2', 'green,red', 0),
(111, 73989, '11-09-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100132,100127', '4-6 Years,N/A', '2,1', 'N/A,N/A', 0),
(112, 22249, '11-09-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100132,100127', '4-6 Years,N/A', '2,1', 'N/A,N/A', 0),
(113, 12254, '11-09-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100132,100127', '4-6 Years,N/A', '2,1', 'N/A,N/A', 0),
(115, 61490, '11-09-2018', 'Md Jahid Khan Limon', '01675234677', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100132,100127', '4-6 Years,N/A', '2,1', 'N/A,N/A', 1),
(116, 71432, '06-03-2019', '', '1956758055', '', 'House # 5, Road # 7/C, Sector # 9\nUttara, Dhaka-1230, Bangladesh', 'dhaka', 'Normal', 'cod', '', '', '100101', 'XL', '1', 'N/A', 0),
(117, 47680, '06-03-2019', '', '1956758055', '', 'House # 5, Road # 7/C, Sector # 9\nUttara, Dhaka-1230, Bangladesh', 'dhaka', 'Normal', 'cod', '', '', '100101', 'XL', '1', 'N/A', 0),
(118, 27545, '2019-03-12 12:03:10', 'Guest', '', '', '', '', 'Normal', '', '', '', '', '', '', '', 0),
(122, 46121, '2019-03-12 13:08:38', 'Guest', '01614500115', '', 'Sample', 'other', 'Normal', 'cod', '', '', '100107', 'L', '2', 'green', 0),
(123, 46898, '2019-03-26 10:16:25', 'Guest', '01614500115', '', 'Ashkona community center', 'dhaka', 'Normal', 'cod', '', '', '100102', 'L', '1', 'N/A', 0),
(121, 76251, '2019-03-12 12:21:58', 'Guest', '+8801956758055', '', 'House 8, Road 7, Sector 9, Uttara Dhaka-1230', 'dhaka', 'Normal', 'cod', '', '', '100110', 'L', '1', 'green', 0),
(124, 99749, '2019-03-30 05:18:02', 'Rakiba Ratri', '01624813545', 'rakiba.ratri00@gmail.com', 'Tongi, Gazipur, dhaka', 'Gazipur', 'Normal', 'cod', '', '', '100129,100124,100123', '7,3,3', '1,2,1', 'N/A,N/A,N/A', 0),
(125, 47413, '2019-04-05 17:20:50', 'Rakiba Ratri', '01624813545', 'rakiba.ratri00@gmail.com', 'Tongi, Gazipur, dhaka', 'Gazipur', 'Normal', 'bkash', '565757', '767858', '100123,100129', '4,10', '1,2', 'N/A,N/A', 0),
(126, 59492, '2019-04-09 08:04:42', 'Rakiba Ratri', '01624813545', 'rakiba.ratri00@gmail.com', 'Tongi, Gazipur, dhaka', 'Gazipur', 'Normal', 'cod', '', '', '100134', '10', '1', 'N/A', 0),
(127, 10357, '2019-04-09 08:06:08', 'Rakiba Ratri', '01624813545', 'rakiba.ratri00@gmail.com', 'Tongi, Gazipur, dhaka', 'Gazipur', 'Normal', 'bkash', '65675', '6757', '100134', '10', '2', 'N/A', 0),
(128, 15897, '2019-04-13 16:44:02', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100134', '4', '3', 'N/A', 1),
(129, 75890, '2019-04-25 15:42:38', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100125', 'N/A', '1', 'N/A', 0),
(130, 26735, '2019-04-25 15:43:06', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100125', 'N/A', '1', 'N/A', 2),
(131, 26556, '2019-04-30 14:38:22', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100134', '4', '12', 'N/A', 2),
(132, 98580, '2019-04-30 14:42:43', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100125', 'N/A', '5', 'N/A', 2),
(133, 42379, '2019-04-30 14:54:08', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100129', '18', '10', 'N/A', 2),
(134, 73776, '2019-04-30 15:13:30', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'cod', '', '', '100129', '18', '10', 'N/A', 0),
(135, 49160, '2019-04-30 15:14:08', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'bkash', '0195675805s', 'asda11', '100129', '18', '10', 'N/A', 0),
(136, 28248, '2019-04-30 15:19:15', 'Md Jahid Khan Limon', '01675234678', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara, Dhaka, Dhaka', 'Dhaka', 'Normal', 'bkash', '01956758055', 'asdfas', '100129', '18', '10', 'N/A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `title` varchar(900) NOT NULL,
  `page_view` int(11) NOT NULL,
  `caret_price` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`title`, `page_view`, `caret_price`) VALUES
('Home || Dhaka Solution E-Commerce Project', 1, 3500);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(900) DEFAULT NULL,
  `image_heading` varchar(900) DEFAULT NULL,
  `image_text1` varchar(900) DEFAULT NULL,
  `image_text2` varchar(900) DEFAULT NULL,
  `image_text3` varchar(900) DEFAULT NULL,
  `image_link` varchar(900) DEFAULT NULL,
  `heading_link` varchar(900) DEFAULT NULL,
  `text1_link` varchar(900) DEFAULT NULL,
  `text2_link` varchar(900) DEFAULT NULL,
  `text3_link` varchar(900) DEFAULT NULL,
  `page` varchar(900) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `image_heading`, `image_text1`, `image_text2`, `image_text3`, `image_link`, `heading_link`, `text1_link`, `text2_link`, `text3_link`, `page`, `position`) VALUES
(7, 'images/slider/index-47.jpg', '', '', '', '', '', '', '', '', '', 'index', 4),
(9, 'images/slider/sub5.jpg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 6),
(38, 'images/slider/index-1-2019-02-23_07-11-34.jpg', '', '', '', '', '', '', '', '', '', 'index', 1),
(8, 'images/slider/sub4.jpg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 5),
(2, 'images/slider/2.jpg', '', '', '', '', '', '', '', '', '', 'index', 1),
(6, 'images/slider/sub2.jpg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 3),
(3, 'images/slider/3.jpg', '', '12345', '', '', '', '', '123', '', '', 'index', 1),
(5, 'images/slider/sub1.jpg?1222259157.415', '', 'hats', 'wide variant', 'view', 'index', '', '', '', 'index', 'index', 2),
(10, 'images/slider/sub6.jpg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 7),
(11, 'images/slider/blog_img_01.jpg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 8),
(36, 'images/slider/blog_img_02.jpg?1222259157.415', '', '', '', '', '', '', '', '', '', 'index', 8),
(4, 'images/slider/4.jpg', '', 'Fuss', '', '', '', '', 'Fussus', '', '', 'index', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(900) NOT NULL,
  `password` varchar(90) NOT NULL,
  `token` varchar(90) NOT NULL,
  `first_name` varchar(900) NOT NULL,
  `last_name` varchar(900) NOT NULL,
  `email` varchar(900) NOT NULL,
  `address` varchar(900) NOT NULL,
  `city` varchar(900) NOT NULL,
  `district` varchar(900) NOT NULL,
  `country` varchar(99) NOT NULL,
  `postalcode` varchar(900) NOT NULL,
  `mobile_number` varchar(900) NOT NULL,
  `wishlists` varchar(900) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `token`, `first_name`, `last_name`, `email`, `address`, `city`, `district`, `country`, `postalcode`, `mobile_number`, `wishlists`) VALUES
(15, 'rakiba.ratri00@gmail.com', '8948', 'tN1Qog3OWnJ1A4tO', 'Rakiba', 'Ratri', 'rakiba.ratri00@gmail.com', 'Tongi', 'dhaka', 'Gazipur', 'Bangladesh', '1230', '01624813545', '100123,100125'),
(10, 'test@mail.com', 'test1234', 'ShJmS1G1nxNzz68y', 'Rakiba', 'Ratri', 'test@mail.com', 'Secor 9, Uttara, Dhaka, Bangladesh', 'Tongi', 'Gazipur', 'Bangladesh', '1230', '+8801956758055', '100131'),
(11, 'jhmasterlimon11@gmail.com', 'limonk123', 'ycTg7JWfIwVhL1xw', 'Md Jahid Khan', 'Limon', 'jhmasterlimon11@gmail.com', 'House # 3, Road # 7/C, Sector # 9, Uttara', 'Dhaka', 'Dhaka', '', '', '01675234678', '100131,100130,100124,100126'),
(12, 'sonyamirza@gmail.com', 'sonyamirza', 'ItN2GslnCjZCTZLf', 'Sonya', 'Mirza ', 'sonyamirza@gmail.com', 'Kualalampur, Rong City', 'Abroad', '', 'Malaysia', '', '01942432941', ''),
(16, 'mjk.limon@outlook.com', 'limon123', 'm2JyCzkw9aX12xUP', 'Md Jahid Khan', 'Limon', 'mjk.limon@outlook.com', 'Uttara Dhaka', 'dhaka', 'Dhaka', 'Bangladesh', '1230', '01614500115', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
