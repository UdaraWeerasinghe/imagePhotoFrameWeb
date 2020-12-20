-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2020 at 02:25 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bit_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_status` int(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_status`) VALUES
(1, 'Metal', 1),
(2, 'Wood', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_sub_category`
--

CREATE TABLE `category_sub_category` (
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_sub_category`
--

INSERT INTO `category_sub_category` (`cat_id`, `sub_cat_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_fName` varchar(30) NOT NULL,
  `customer_lName` varchar(30) NOT NULL,
  `customer_tel` varchar(10) NOT NULL,
  `customer_email` text NOT NULL,
  `customer_address` text NOT NULL,
  `customer_longitude` double NOT NULL,
  `customer_latitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_fName`, `customer_lName`, `customer_tel`, `customer_email`, `customer_address`, `customer_longitude`, `customer_latitude`) VALUES
(1, 'Sachini', 'Ruwanthika', '0718817067', 'sachi.sjp@gmail.com', 'No.36, R.B 01, Somapura, Trincomalee.', 8.325152, 81.302178);

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `login_id` int(11) NOT NULL,
  `customer_user_name` varchar(50) NOT NULL,
  `customer_password` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`login_id`, `customer_user_name`, `customer_password`, `customer_id`, `status`) VALUES
(1, 'ruwanthika@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `customer_id`, `order_date`, `order_time`, `order_status`) VALUES
(1, 1, '2020-09-21', '18:57:25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_username` varchar(80) NOT NULL,
  `login_password` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_username`, `login_password`, `user_id`, `login_status`) VALUES
(1, 'Udara@gmail.com', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF', 1, 1),
(2, 'busubexud@mailinator.com', '426543f0c357d829ead0e51f9102c5eb71f9ce97', 2, 1),
(3, 'udaraw1997@gmail.com', '3a4e6072a2627df6a001ad49c056875ec7a58882', 3, 1),
(4, 'fypudyxyte@mailinator.com', 'bf59b993ae2927cfaae24406f8bf8764a3f0c4d7', 4, 1),
(5, 'fenozehy@mailinator.com', 'd9322f4ce0d5499944510024da6a118dee46af41', 2, 1),
(6, 'zasebywe@mailinator.com', '1b6c095eede95d6ba98f7ee5e55eac36e38b8469', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(100) NOT NULL,
  `material_type` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `material_name`, `material_type`, `qty`) VALUES
(1, 'Glass', 1, 100),
(2, 'Hardboard', 2, 100),
(3, 'Frame strip', 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(30) NOT NULL,
  `module_class` text NOT NULL,
  `module_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `module_class`, `module_url`) VALUES
(1, 'User management', 'far fa-users-cog', 'user.php'),
(2, 'Order management', 'far fa-shopping-cart', 'order.php'),
(3, 'Customer management', 'fad fa-user-edit', 'customer.php'),
(4, 'Delivery management ', 'fas fa-truck-container', 'delivery.php'),
(5, 'Suppliers management', 'fal fa-user-cog', 'supplier.php'),
(6, 'Inventory management', 'fas fa-inventory', 'inventory.php'),
(7, 'Product management', 'far fa-photo-video', 'product.php'),
(8, 'Payment management', 'far fa-file-invoice-dollar', 'payment.php'),
(9, 'Report generating', 'fad fa-clipboard-list', 'report.php');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_sub_total` double NOT NULL,
  `order_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_payment_status` int(11) NOT NULL DEFAULT '1',
  `order_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `customer_id`, `order_sub_total`, `order_timestamp`, `order_payment_status`, `order_status`) VALUES
(1, 1, 2490, '2020-12-10 05:36:29', 1, 1),
(2, 1, 2490, '2020-12-10 05:36:29', 1, 1),
(3, 1, 2490, '2020-12-10 05:36:29', 2, 1),
(4, 1, 3640, '2020-12-10 05:36:29', 2, 2),
(5, 1, 130, '2020-12-10 05:36:29', 3, 1),
(6, 1, 130, '2020-12-10 05:36:29', 2, 1),
(7, 1, 130, '2020-12-10 05:37:00', 2, 1),
(8, 1, 130, '2020-12-10 06:47:38', 1, 1),
(9, 1, 120, '2020-12-10 06:49:48', 1, 1),
(10, 1, 260, '2020-12-10 15:02:32', 1, 1),
(11, 1, 260, '2020-12-17 11:00:36', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `size_id`, `quantity`, `unit_price`) VALUES
(2, 1, 1, 1, 120),
(2, 7, 1, 1, 135),
(2, 7, 14, 3, 745),
(3, 1, 1, 1, 120),
(3, 7, 1, 1, 135),
(3, 7, 14, 3, 745),
(4, 2, 1, 28, 130),
(5, 2, 1, 1, 130),
(6, 2, 1, 1, 130),
(7, 2, 1, 1, 130),
(0, 2, 1, 1, 130),
(9, 1, 1, 1, 120),
(10, 2, 1, 2, 130),
(11, 2, 1, 2, 130);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'On Process'),
(3, 'Waitig For Payment'),
(4, 'On Delivery'),
(5, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `payment_amount`, `payment_type`) VALUES
(1, 9, 120, 1),
(2, 9, 60, 2),
(3, 9, 120, 2),
(4, 10, 260, 1),
(5, 10, 260, 1),
(6, 10, 260, 1),
(7, 10, 260, 1),
(8, 10, 260, 1),
(9, 10, 260, 1),
(10, 10, 260, 1),
(11, 10, 260, 1),
(12, 10, 260, 1),
(13, 10, 260, 1),
(14, 10, 260, 1),
(15, 10, 260, 1),
(16, 10, 260, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_code` text NOT NULL,
  `product_color` varchar(20) NOT NULL,
  `product_img_1` text NOT NULL,
  `product_img_2` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_code`, `product_color`, `product_img_1`, `product_img_2`, `cat_id`, `sub_cat_id`, `product_status`) VALUES
(1, 'Deep Gunmetal Gray Metal Canvas Floater Frame', '718GUN', 'Gray', '1603086975_718GUN_l_7.jpg', '1603086975_718GUN_l_7s.jpg', 1, 1, 1),
(2, 'Deep Black Metal Canvas Floater Frame', '718BLK', 'Black', '1603087223_718BLK_l.jpg', '1603087223_718BLK_ls.jpg', 1, 1, 1),
(3, 'Black Metal Canvas Floater Frame', '720BLK', 'Black', '1603089827_720BLK_l_8.jpg', '1603089827_720BLK_l_8s.jpg', 1, 1, 1),
(4, 'Gunmetal Gray Metal Canvas Floater Frame', '720GUN', 'Gray', '1603090010_720GUN_l_7.jpg', '1603090010_720GUN_l_7s.jpeg', 1, 1, 1),
(5, 'Deep Black with Gold Metal Canvas Floater Picture', '718GFB', 'Gold', '1603090218_718GFB_l_13.jpg', '1603090218_718GFB_l_13s.jpeg', 1, 1, 1),
(6, 'Modern Gold Leaf Canvas Floater Frame', 'CFS3', 'Gold', '1603090528_CFS3.jpg', '1603090528_CFS3s.jpeg', 2, 1, 1),
(7, 'Modern White Canvas Floater Frame', 'CFS9', 'White', '1603090689_CFS9_l_2.jpg', '1603090689_CFS9_l_2s.jpeg', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `product_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`product_id`, `size_id`, `product_price`) VALUES
(1, 1, 120),
(1, 2, 135),
(1, 3, 160),
(1, 4, 190),
(1, 5, 210),
(1, 6, 240),
(1, 7, 280),
(1, 8, 310),
(1, 9, 350),
(1, 10, 390),
(1, 11, 450),
(1, 12, 500),
(1, 13, 560),
(1, 14, 630),
(1, 15, 710),
(1, 16, 720),
(1, 17, 790),
(1, 18, 800),
(1, 19, 860),
(1, 20, 925),
(1, 21, 1000),
(2, 1, 130),
(2, 2, 140),
(2, 3, 195),
(2, 4, 210),
(2, 5, 230),
(2, 6, 250),
(2, 7, 290),
(2, 8, 330),
(2, 9, 385),
(2, 10, 460),
(2, 11, 500),
(2, 12, 555),
(2, 13, 590),
(2, 14, 660),
(2, 15, 695),
(2, 16, 720),
(2, 17, 780),
(2, 18, 850),
(2, 19, 890),
(2, 20, 960),
(2, 21, 1200),
(3, 1, 110),
(3, 2, 125),
(3, 3, 140),
(3, 4, 160),
(3, 5, 180),
(3, 6, 210),
(3, 7, 250),
(3, 8, 290),
(3, 9, 350),
(3, 10, 385),
(3, 11, 450),
(3, 12, 490),
(3, 13, 560),
(3, 14, 600),
(3, 15, 650),
(3, 16, 730),
(3, 17, 790),
(3, 18, 840),
(3, 19, 875),
(3, 20, 925),
(3, 21, 990),
(4, 1, 145),
(4, 2, 155),
(4, 3, 190),
(4, 4, 230),
(4, 5, 260),
(4, 6, 300),
(4, 7, 355),
(4, 8, 380),
(4, 9, 420),
(4, 10, 465),
(4, 11, 500),
(4, 12, 530),
(4, 13, 590),
(4, 14, 620),
(4, 15, 700),
(4, 16, 750),
(4, 17, 820),
(4, 18, 900),
(4, 19, 990),
(4, 20, 1250),
(4, 21, 1300),
(5, 1, 160),
(5, 2, 170),
(5, 3, 190),
(5, 4, 225),
(5, 5, 260),
(5, 6, 295),
(5, 7, 340),
(5, 8, 400),
(5, 9, 425),
(5, 10, 485),
(5, 11, 530),
(5, 12, 590),
(5, 13, 630),
(5, 14, 700),
(5, 15, 750),
(5, 16, 815),
(5, 17, 880),
(5, 18, 945),
(5, 19, 1050),
(5, 20, 1225),
(5, 21, 1300),
(6, 1, 100),
(6, 2, 120),
(6, 3, 145),
(6, 4, 180),
(6, 5, 210),
(6, 6, 250),
(6, 7, 290),
(6, 8, 330),
(6, 9, 390),
(6, 10, 430),
(6, 11, 500),
(6, 12, 530),
(6, 13, 700),
(6, 14, 785),
(6, 15, 810),
(6, 16, 865),
(6, 17, 900),
(6, 18, 930),
(6, 19, 980),
(6, 20, 1000),
(6, 21, 1100),
(7, 1, 135),
(7, 2, 150),
(7, 3, 190),
(7, 4, 235),
(7, 5, 260),
(7, 6, 300),
(7, 7, 350),
(7, 8, 380),
(7, 9, 430),
(7, 10, 480),
(7, 11, 550),
(7, 12, 610),
(7, 13, 680),
(7, 14, 745),
(7, 15, 800),
(7, 16, 850),
(7, 17, 925),
(7, 18, 1100),
(7, 19, 1225),
(7, 20, 1290),
(7, 21, 1340);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(30) NOT NULL,
  `role_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_status`) VALUES
(1, '	 Administrator', 1),
(2, 'Manager', 1),
(3, '	 Stock Keeper', 1),
(4, 'Product Supervisor', 1),
(5, 'Delivery Agent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_module`
--

CREATE TABLE `role_module` (
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_module`
--

INSERT INTO `role_module` (`role_id`, `module_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 5),
(3, 6),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 7),
(4, 9),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(11) NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `width`, `height`) VALUES
(1, 5, 5),
(2, 5, 7),
(3, 8, 8),
(4, 8, 10),
(5, 9, 12),
(6, 10, 10),
(7, 11, 14),
(8, 12, 12),
(9, 12, 16),
(10, 14, 18),
(11, 16, 20),
(12, 18, 24),
(13, 20, 20),
(14, 20, 24),
(15, 20, 30),
(16, 24, 24),
(17, 24, 30),
(18, 24, 36),
(19, 28, 32),
(20, 30, 40),
(21, 40, 60);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(50) NOT NULL,
  `sub_cat_status` int(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_cat_id`, `sub_cat_name`, `sub_cat_status`) VALUES
(1, 'Canvas floater', 1),
(2, 'Plein Air', 1),
(3, 'Document', 1),
(4, 'Collage', 1),
(5, 'Tabletop', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_size`
--

CREATE TABLE `sub_category_size` (
  `sub_cat_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category_size`
--

INSERT INTO `sub_category_size` (`sub_cat_id`, `size_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(4, 2),
(4, 4),
(4, 8),
(5, 1),
(5, 2),
(5, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(30) NOT NULL,
  `user_lname` varchar(30) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_gender` int(11) NOT NULL,
  `user_dob` date NOT NULL,
  `user_nic` varchar(20) NOT NULL,
  `user_cno` int(20) NOT NULL,
  `role_id` varchar(50) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1',
  `user_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_gender`, `user_dob`, `user_nic`, `user_cno`, `role_id`, `user_status`, `user_image`) VALUES
(1, 'Udara', 'Weerasinghe', 'Udara@gmail.com', 1, '1997-09-28', '987777777V', 711122666, '1', 0, 'defaultImage.jpg'),
(2, 'Tamekah Lyons', 'Roth Blackburn', 'fenozehy@mailinator.com', 0, '1996-09-08', '972720046v', 5, '3', 1, 'defaultImage.jpg'),
(3, 'Holmes Preston', 'Bethany Fuentes', 'zasebywe@mailinator.com', 0, '2018-12-02', '926810529V', 44, '2', 1, 'defaultImage.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `category_sub_category`
--
ALTER TABLE `category_sub_category`
  ADD PRIMARY KEY (`cat_id`,`sub_cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`product_id`,`size_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_module`
--
ALTER TABLE `role_module`
  ADD PRIMARY KEY (`role_id`,`module_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `sub_category_size`
--
ALTER TABLE `sub_category_size`
  ADD PRIMARY KEY (`sub_cat_id`,`size_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
