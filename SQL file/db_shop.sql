-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2017 at 04:35 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Chayan roy', 'admin', 'chayanroycmt@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(12, 'CANON'),
(13, 'ACER'),
(16, 'SAMSUNG'),
(17, 'IPHONE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,3) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `sId`, `productId`, `productName`, `price`, `quantity`, `image`) VALUES
(36, 'e795jnjac8v27t2tlainkad557', 16, 'Lorem ipsum dolor .....', 500.000, 1, 'upload/1def9bf8c3.jpg'),
(37, 'e795jnjac8v27t2tlainkad557', 18, 'Lorem ipsum dolor .....', 500.000, 1, 'upload/9f18ce9548.jpg'),
(38, 'e795jnjac8v27t2tlainkad557', 11, 'Lorem ipsum dolor .....', 500.000, 1, 'upload/ac85c87e2c.jpg'),
(39, '1il60rtqp471359899agkdclhp', 23, 'Lorem ipsum dolor .....', 900.000, 2, 'upload/4b4159faa4.jpg'),
(41, '9ur4gf8hu0s14uooas3cpmr94i', 21, 'Lorem ipsum dolor .....', 600.540, 45, 'upload/9311f3b5e0.jpg'),
(42, '7f6e6nim554p0n7b08393a8tuj', 22, 'Lorem ipsum dolor .....', 800.000, 1, 'upload/ad10933176.jpg'),
(44, '9q23935v08iqt3kjdkr1qmhn16', 23, 'Lorem ipsum dolor .....', 900.000, 1, 'upload/ebcaf355fa.jpg'),
(45, '9q23935v08iqt3kjdkr1qmhn16', 19, 'Lorem ipsum dolor .....', 500.000, 1, 'upload/67b8453337.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(2, 'Desktop'),
(3, 'Laptop'),
(4, 'Accessories'),
(5, 'Software'),
(6, 'Sports &amp; Fitness'),
(7, 'Footwear'),
(8, 'Jewellery'),
(9, 'Clothes'),
(10, 'Home Decor &amp; Kitchen'),
(11, 'Beauty &amp; Healthcare'),
(16, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,3) NOT NULL,
  `image` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `password`) VALUES
(2, 'Chayan roy', 'Porishad para', 'thakurgaon', 'INDIA', '45321', '01780642054', 'chayanroycmt50@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrId`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(6, 2, 21, 'Lorem ipsum dolor .....', 1, 600.54, 'upload/9311f3b5e0.jpg', '2017-10-16 16:18:38', 0),
(10, 2, 21, 'Lorem ipsum dolor .....', 1, 600.54, 'upload/9311f3b5e0.jpg', '2017-11-04 23:05:04', 0),
(11, 2, 11, 'Lorem ipsum dolor .....', 2, 1000.00, 'upload/ac85c87e2c.jpg', '2017-11-05 08:16:13', 0),
(12, 2, 16, 'Lorem ipsum dolor .....', 1, 500.00, 'upload/350993cf75.jpg', '2017-11-07 14:17:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,3) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(11, 'Lorem ipsum dolor .....', 16, 17, '<p>amar sonar bangla ami tomay bhalo basi chirodin tomar akash tomay batash amar prane bajay basi amar sonar bangla ami tomay bhalo basi chirodin tomar akash tomay batash amar prane bajay basi amar sonar bangla ami tomay bhalo basi chirodin tomar akash tomay batash amar prane bajay basi amar sonar bangla ami tomay bhalo basi chirodin tomar akash tomay batash amar prane bajay basi</p>', 500.000, 'upload/ac85c87e2c.jpg', 0),
(14, 'Lorem ipsum dolor .....', 8, 13, '<p>amar sonar bangla ami tomay bhalo basi chirodin tomar akash tomay batash amar prane bajay basi</p>', 500.000, 'upload/e120e089b4.jpg', 0),
(15, 'Lorem ipsum dolor .....', 16, 12, '<p>amar sonar bangla amar sonar bangla amar sonar bangla amar sonar bangla amar sonar bangla</p>', 500.000, 'upload/983f8eb207.png', 0),
(16, 'Lorem ipsum dolor .....', 10, 12, '<p>amar sonar bangla ami tomay bhalo basi&nbsp;amar sonar bangla ami tomay bhalo basi&nbsp;amar sonar bangla ami tomay bhalo basi&nbsp;amar sonar bangla ami tomay bhalo basi</p>', 500.000, 'upload/350993cf75.jpg', 0),
(18, 'Lorem ipsum dolor .....', 16, 16, '<p>Over the last few years Glamox has launched many new products. All recent products have a name that begins with a letter and then a number. This first letter indicates the product category the luminaire belongs to</p>', 500.000, 'upload/2a41420ae7.jpg', 0),
(19, 'Lorem ipsum dolor .....', 5, 12, '<p>Over the last few years Glamox has launched many new products. All recent products have a name that begins with a letter and then a number. This first letter indicates the product category the luminaire belongs to</p>', 500.000, 'upload/67b8453337.jpg', 1),
(21, 'Lorem ipsum dolor .....', 10, 16, '<p>ff</p>', 600.540, 'upload/9311f3b5e0.jpg', 1),
(22, 'Lorem ipsum dolor .....', 3, 13, '<p>amar sonar bangla ami tomay bhalo basi chirodin tomar akash tomar batash amar prane bajay basi</p>', 800.000, 'upload/ad10933176.jpg', 1),
(23, 'Lorem ipsum dolor .....', 3, 16, '<p>amar sonar bangla ami tomay bhalo basi chirodin tomar akash tomar batash amar prane bajay basi</p>', 900.000, 'upload/ebcaf355fa.jpg', 1),
(24, 'Lorem ipsom dolor', 3, 12, '<p>As of 2017, text messages are used by youth and adults for personal, family and social purposes and in business. Governmental and non-governmental organizations use text messaging for communication between colleagues. As with <a title=\"Email\" href=\"https://en.wikipedia.org/wiki/Email\">emailing</a>, in the 2010s, the sending of short informal messages has become an accepted part of many cultures.<sup id=\"cite_ref-1\" class=\"reference\"><a href=\"https://en.wikipedia.org/wiki/Text_messaging#cite_note-1\">[1]</a></sup> This makes texting a quick and easy way to communicate with friends</p>', 220.000, 'upload/5808fcf25f.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist`
--

CREATE TABLE `tbl_wlist` (
  `id` int(11) NOT NULL,
  `cmrId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,3) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wlist`
--

INSERT INTO `tbl_wlist` (`id`, `cmrId`, `productId`, `productName`, `price`, `image`) VALUES
(3, 2, 23, 'Lorem ipsum dolor .....', 900.000, 'upload/ebcaf355fa.jpg'),
(4, 2, 24, 'Lorem ipsom dolor', 220.000, 'upload/5808fcf25f.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_wlist`
--
ALTER TABLE `tbl_wlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
