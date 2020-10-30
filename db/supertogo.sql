-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2020 at 08:36 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supertogo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `temp_password` varchar(50) NOT NULL DEFAULT '',
  `temp_expiry` time NOT NULL DEFAULT '00:00:00',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `pincode` varchar(50) NOT NULL DEFAULT '',
  `village` varchar(255) NOT NULL DEFAULT '',
  `district` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `state` varchar(50) NOT NULL DEFAULT '',
  `profile_image` varchar(50) NOT NULL DEFAULT '',
  `is_active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1 for active, 0 for inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `name`, `email`, `password`, `temp_password`, `temp_expiry`, `mobile`, `address`, `pincode`, `village`, `district`, `city`, `state`, `profile_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '123456', '', '00:00:00', '8153826710', 'admin addess', '395006', '', '', '', '', '1935317355_Penguins.jpg', '1', '2019-07-03 12:37:51', '2020-05-26 08:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `banner_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`banner_id`, `image`) VALUES
(8, '624861709_capa_551.png'),
(9, '669676094_grocerybanner.jpg'),
(10, '1002280752_grocerybanner1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `name`) VALUES
(1, 'Amul'),
(2, 'Britania');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_card_detail`
--

CREATE TABLE `tbl_card_detail` (
  `card_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(100) NOT NULL,
  `exp_month` varchar(100) NOT NULL,
  `exp_year` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_card_detail`
--

INSERT INTO `tbl_card_detail` (`card_id`, `user_id`, `card_number`, `exp_month`, `exp_year`) VALUES
(1, 1, '4242424242424242', '10', '22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `city_id` int(11) NOT NULL DEFAULT 0,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `user_id`, `city_id`, `item_id`, `qty`) VALUES
(2, 3, 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `name`, `image`) VALUES
(1, 'Fruits & Vegetables', '1817978440_fruitsandvegitable.png'),
(2, 'Food Grains - Oils & Spices', '1175283204_foodgrain.png'),
(3, 'Diary & Meat', '80413184_dairyproduct.png'),
(4, 'Confectionery', '1242177298_confectionary.png'),
(5, 'Pantry', '1232655193_pantry.png'),
(6, 'Beverages', '458555518_Bevrages.png'),
(7, 'Personal Care', '1315114402_personalcare.png'),
(8, 'Miscellaneous', '1019486192_Miscellaneous.png'),
(9, 'Grocery', '1740551257_groceryicone.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `name`) VALUES
(3, 'Chihuahua'),
(4, 'Maxico City'),
(5, 'Acapulco'),
(6, 'Puerto');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_db_temp_request`
--

CREATE TABLE `tbl_db_temp_request` (
  `request_id` int(11) NOT NULL,
  `db_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','send') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_address`
--

CREATE TABLE `tbl_delivery_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `house_no` varchar(100) NOT NULL,
  `apartment` varchar(1000) NOT NULL,
  `street` varchar(1000) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipcode` varchar(100) NOT NULL,
  `address` varchar(10000) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lon` varchar(100) NOT NULL,
  `type` int(11) NOT NULL COMMENT '0=Home 1=Work 2=Other'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_boy`
--

CREATE TABLE `tbl_delivery_boy` (
  `db_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lon` varchar(100) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `device_token` varchar(1000) NOT NULL,
  `device_type` varchar(50) NOT NULL,
  `timezone` varchar(50) NOT NULL,
  `is_online` int(11) NOT NULL DEFAULT 0,
  `status` enum('Active','Inactive','Delete') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_delivery_boy`
--

INSERT INTO `tbl_delivery_boy` (`db_id`, `first_name`, `last_name`, `avatar`, `email`, `password`, `mobile`, `lat`, `lon`, `device_id`, `device_token`, `device_type`, `timezone`, `is_online`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bipin', 'Nakrani', '', 'nakrani0108@gmail.com', 'MHTN93ERW', '8000366136', '', '', '', '', '', '', 0, 'Active', '2020-06-18 07:49:49', '2020-07-18 08:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favourite`
--

CREATE TABLE `tbl_favourite` (
  `favourite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `city_id` int(11) NOT NULL DEFAULT 0,
  `isfavourite` int(11) NOT NULL DEFAULT 0 COMMENT '0=Unfavourite 1=Favourite'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification_list`
--

CREATE TABLE `tbl_notification_list` (
  `notify_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `db_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `message` varchar(10000) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Unread 1=Read',
  `type` int(11) NOT NULL COMMENT '0=User 1=Driver 2=Admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `city_id` int(11) NOT NULL DEFAULT 0,
  `db_id` int(11) NOT NULL DEFAULT 0,
  `order_no` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `order_time` varchar(100) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lon` varchar(100) NOT NULL,
  `delivery_charge` double NOT NULL DEFAULT 0,
  `promocode` varchar(100) NOT NULL,
  `promocode_price` double NOT NULL DEFAULT 0,
  `sub_total` double NOT NULL DEFAULT 0,
  `grand_price` double NOT NULL DEFAULT 0,
  `adjust_amt` double NOT NULL DEFAULT 0,
  `delivery_date` varchar(100) NOT NULL,
  `delivery_time` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `is_cancel` int(11) DEFAULT 0,
  `cancel_by` varchar(255) NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `user_id`, `city_id`, `db_id`, `order_no`, `order_date`, `order_time`, `address`, `lat`, `lon`, `delivery_charge`, `promocode`, `promocode_price`, `sub_total`, `grand_price`, `adjust_amt`, `delivery_date`, `delivery_time`, `status_id`, `is_cancel`, `cancel_by`, `notes`, `created_at`, `updated_at`) VALUES
(1, 15, 3, 0, '10000', '2020-07-06', '04:59 PM', 'A,402,Chihuahua 2000', '28.726003', '-106.1198699', 10, 'SuperToGo', 15, 0, 185, 0, '2020-07-07', '10:00 AM to 6:00 PM', 1, 0, '', 'handel with care', '2020-07-06 11:29:20', '2020-07-06 11:29:20'),
(2, 15, 3, 0, '10001', '2020-07-06', '04:59 PM', 'A,402,Chihuahua 2000', '28.726003', '-106.1198699', 10, 'SuperToGo', 15, 0, 185, 0, '2020-07-07', '10:00 AM to 6:00 PM', 1, 0, '', 'handel with care', '2020-07-06 11:29:30', '2020-07-06 11:29:30'),
(3, 15, 3, 0, '10002', '2020-07-06', '05:01 PM', 'A,402,Chihuahua 2000', '28.726003', '-106.1198699', 10, 'SuperToGo', 15, 0, 185, 0, '2020-07-07', '10:00 AM to 6:00 PM', 1, 0, '', 'handel with care', '2020-07-06 11:31:26', '2020-07-06 11:31:26'),
(4, 15, 3, 0, '10003', '2020-07-06', '05:04 PM', 'A,402,Chihuahua 2000', '28.726003', '-106.1198699', 10, 'SuperToGo', 15, 0, 185, 0, '2020-07-07', '10:00 AM to 6:00 PM', 1, 0, '', 'handel with care', '2020-07-06 11:34:29', '2020-07-06 11:34:29'),
(5, 1, 3, 0, '10004', '2020-07-06', '05:07 PM', '710,Arista ,Sindhu bhavan Road,Ahmedabad-08854', '23.0734311', '72.6243823', 10, '', 0, 0, 275, 0, '2020-06-15', '10:00 AM to 7:00 PM', 1, 0, '', '', '2020-07-06 11:37:40', '2020-07-06 11:37:40'),
(6, 15, 3, 0, '10005', '2020-07-06', '05:15 PM', 'A,402,Chihuahua 2000', '28.726003', '-106.1198699', 10, 'SuperToGo', 15, 0, 185, 0, '2020-07-07', '10:00 AM to 6:00 PM', 1, 0, '', 'handel with care', '2020-07-06 11:45:05', '2020-07-06 11:45:05'),
(7, 1, 3, 0, '10006', '2020-07-06', '05:18 PM', '710,Arista ,Sindhu bhavan Road,Ahmedabad-08854', '23.0734311', '72.6243823', 10, '', 0, 0, 275, 0, '2020-06-15', '10:00 AM to 7:00 PM', 1, 0, '', '', '2020-07-06 11:48:52', '2020-07-06 11:48:52'),
(8, 1, 3, 0, '10007', '2020-07-06', '05:19 PM', '710,Arista ,Sindhu bhavan Road,Ahmedabad-08854', '23.0734311', '72.6243823', 10, '', 0, 0, 275, 0, '2020-06-15', '10:00 AM to 7:00 PM', 1, 0, '', '', '2020-07-06 11:49:25', '2020-07-06 11:49:25'),
(9, 15, 3, 0, '10008', '2020-07-06', '05:21 PM', 'A,402,Chihuahua 2000', '28.726003', '-106.1198699', 10, 'SuperToGo', 15, 0, 185, 0, '2020-07-07', '10:00 AM to 6:00 PM', 1, 0, '', 'handel with care', '2020-07-06 11:51:04', '2020-07-06 11:51:04'),
(10, 15, 3, 0, '10009', '2020-07-06', '05:21 PM', 'A,402,Chihuahua 2000', '28.726003', '-106.1198699', 10, 'SuperToGo', 15, 0, 185, 0, '2020-07-07', '10:00 AM to 6:00 PM', 1, 0, '', 'handel with care', '2020-07-06 11:51:09', '2020-07-06 11:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

CREATE TABLE `tbl_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `item_count` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_status`
--

CREATE TABLE `tbl_order_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_status`
--

INSERT INTO `tbl_order_status` (`status_id`, `status_name`) VALUES
(1, 'Payment Confirmed'),
(2, 'Order Accepted'),
(3, 'Order Ready to Pickup'),
(4, 'Order On the Way'),
(5, 'Order Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_status_history`
--

CREATE TABLE `tbl_order_status_history` (
  `status_history_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT 0,
  `status_id` int(11) DEFAULT 0,
  `lat` varchar(50) DEFAULT '',
  `lon` varchar(50) DEFAULT '',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pages`
--

INSERT INTO `tbl_pages` (`page_id`, `title`, `description`) VALUES
(1, 'Terms And Condition', '<p>Hello</p>\r\n'),
(2, 'About Us', ''),
(3, 'Privacy Policy', ''),
(4, 'Call and Email', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `txn_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `payment_date` varchar(100) NOT NULL,
  `payment_time` varchar(100) NOT NULL,
  `last4` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `exp_month` varchar(100) NOT NULL,
  `exp_year` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `card_type` varchar(100) NOT NULL,
  `payment_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `store_ids` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `cat_id`, `brand_id`, `name`, `description`, `image`, `store_ids`, `created_at`, `updated_at`) VALUES
(1, 9, 0, 'Potato', 'Potato', '1074510163_potato.jpeg', '1,2,3,4,5,6', '2020-05-28 10:54:15', '2020-05-29 07:13:52'),
(2, 1, 0, 'Onion', 'Onion', '2059296457_onion.jpg', '1,2,3,4,5,6', '2020-05-29 07:17:54', '2020-05-29 12:47:36'),
(3, 1, 0, 'Garlic', 'Garlic', '805409530_garlic.jpg', '1,2,3,4,5,6', '2020-05-29 09:01:01', '2020-05-29 09:01:01'),
(4, 2, 0, 'Aashirvad Aata', 'whole wheat Aata', '882370571_Aashirvadaata.jpg', '3,4', '2020-05-29 09:11:19', '2020-05-29 10:38:36'),
(5, 2, 0, 'Besan', 'Besan ', '586436936_besan.jpg', '1,2,3,4', '2020-05-29 09:13:11', '2020-05-29 09:13:11'),
(6, 2, 0, 'Maida', 'Maida', '738082350_maida.jpg', '1,2,3,4,5,6', '2020-05-29 09:14:29', '2020-05-29 09:14:29'),
(7, 3, 1, 'Amul Butter', 'Butter', '225424330_AmulButter.jpg', '1,2,3,4,5,6', '2020-05-29 10:03:24', '2020-05-29 12:03:03'),
(8, 3, 1, 'Cheese', 'Cheese', '1667843156_cheese.jpg', '1,2,3,4,5,6', '2020-05-29 10:07:34', '2020-05-29 12:16:52'),
(9, 3, 1, 'Amul Kool Sweet Milk', 'Amul kool sweet milk', '1675029101_Amukool.jpg', '1,2,3,4,5,6', '2020-05-29 10:15:35', '2020-05-29 12:11:52'),
(10, 4, 0, 'Cadbury Dairy Milk ', 'Cadbury Dairy Milk Home Treats Chocolate : 126 gms', '949787396_dairymilk.jpg', '1,2,3,4,5,6', '2020-05-29 10:23:04', '2020-05-29 10:39:34'),
(11, 4, 0, 'Sunfeast Dark Fantasy', 'Sunfeast Dark Fantasy Choco Fills Cookies : 300 gms', '966767450_darkfantacybiscuit.jpg', '1,2,3,4,5,6', '2020-05-29 10:25:54', '2020-05-29 10:25:54'),
(12, 4, 2, 'Khari Tost', 'Royal Fresh Elaichi Toast : 200 gms', '1370177810_royaltost.jpg', '1,2,3,4,5,6', '2020-05-29 10:34:13', '2020-05-30 05:55:20'),
(15, 4, 2, 'Mari Gold', 'Britania Marygold', '223667279_Britaniamarigold.jpg', '3', '2020-05-30 13:39:04', '2020-06-08 05:24:28'),
(16, 0, 0, '', '', '', '', '2020-05-30 13:39:04', '2020-05-30 13:39:04'),
(17, 2, 1, 'TEst', 'Tewst', '933256688_Penguins.jpg', '3', '2020-06-01 08:51:27', '2020-06-01 08:51:27'),
(18, 1, 0, 'Try', 'Treste', '170936791_Penguins.jpg', '3', '2020-06-01 08:55:48', '2020-06-01 08:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_item`
--

CREATE TABLE `tbl_product_item` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT 0,
  `weight` double NOT NULL,
  `unit` varchar(255) NOT NULL,
  `qty` double NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product_item`
--

INSERT INTO `tbl_product_item` (`item_id`, `product_id`, `store_id`, `city_id`, `brand_id`, `weight`, `unit`, `qty`, `price`) VALUES
(1, 12, 3, 3, 0, 1, 'Kg', 20, 20),
(2, 12, 3, 3, 0, 500, 'gms', 10, 10),
(3, 12, 3, 3, 0, 250, 'gms', 5, 5),
(4, 13, 3, 3, 0, 20, 'gms', 0, 15),
(7, 17, 3, 3, 1, 50, 'gms', 15, 45),
(8, 17, 3, 3, 0, 25, 'gms', 10, 25),
(9, 17, 3, 4, 0, 50, 'gms', 15, 45),
(10, 17, 3, 4, 0, 25, 'gms', 10, 25),
(21, 15, 3, 3, 1, 100, 'gms', 10, 100),
(22, 15, 3, 3, 1, 90, 'gms', 10, 50),
(23, 15, 3, 4, 2, 80, 'gms', 15, 75),
(24, 15, 3, 4, 2, 75, 'gms', 10, 65);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promocode`
--

CREATE TABLE `tbl_promocode` (
  `promo_id` int(11) NOT NULL,
  `promocode` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `discount_type` int(11) NOT NULL COMMENT '1=Percent 2=Flat',
  `min_price` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=Inactive 1=Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_promocode`
--

INSERT INTO `tbl_promocode` (`promo_id`, `promocode`, `discount`, `discount_type`, `min_price`, `start_date`, `end_date`, `description`, `image`, `status`) VALUES
(1, 'Free30', '30', 2, '100', '07/08/2020', '07/20/2020', 'Minimum Cart value is above $100.', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `val` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `key`, `val`) VALUES
(1, 'android_version_user', '1'),
(2, 'ios_version_user', '1'),
(13, 'delivery_charge', '10'),
(14, 'currency', '$'),
(15, 'min_cart_price', '100'),
(16, 'fcm_api_key', 'AAAAUpW3SEo:APA91bE4GIMULK-BefdppX0wCL1xetbBjQdh8Pzxa4a-x9e5vWUMuXG7Uj4GWLGWt4x5ZztjmwjtrYP_pa0GYbuYgTBwRTzuouRzX2ezPWJZtEy_bxs6rasXQcezhu_bqFjlU0HF5Ehx'),
(17, 'emergency_message', ''),
(18, 'android_version_driver', '1'),
(19, 'ios_version_driver', '1'),
(20, 'stripe_pk_test', 'pk_test_jqlr2EZYLdUroU1B7qGM574J00gKCu329l'),
(21, 'stripe_sk_test', 'sk_test_hD3HU5OB3Fh1QoZFmjanakAw00iktsn1L4'),
(22, 'stripe_pk_live', 'pk_live_FQV5hWTUU147ggJ8oopGamJf00sp67aVhQ'),
(23, 'stripe_sk_live', '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'),
(24, 'is_stripe', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

CREATE TABLE `tbl_store` (
  `store_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_ids` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`store_id`, `name`, `store_icon`, `store_banner`, `city_ids`, `created_at`, `updated_at`) VALUES
(1, 'Alsuper', '1155816422_Koala.jpg', '803255853_Lighthouse.jpg', '3', '2020-05-27 09:43:53', '2020-06-17 08:20:27'),
(2, 'Smart', '2015104084_Smartsupermarketi.png', '', '3', '2020-05-27 09:45:30', '2020-05-28 11:12:40'),
(3, 'Costco', '804062974_Costco-Wholesale.png', '', '3,4', '2020-05-27 09:48:16', '2020-06-01 06:32:36'),
(4, 'Wal Mart', '592685204_walmart.png', '', '3', '2020-05-27 09:50:05', '2020-05-29 06:32:04'),
(5, 'Soriana', '1337818293_Soriana.jpg', '', '3', '2020-05-27 09:51:11', '2020-05-29 06:34:12'),
(6, 'Fresh market', '368389984_Penguins.jpg', '1348018731_Koala.jpg', '3', '2020-05-27 09:52:51', '2020-06-08 10:17:43'),
(7, 'Test', '1055811842_Penguins.jpg', '1458887402_Koala.jpg', '4', '2020-06-08 07:12:47', '2020-06-08 07:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_time`
--

CREATE TABLE `tbl_store_time` (
  `time_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `day` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `open_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `close_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 close, 1 open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_store_time`
--

INSERT INTO `tbl_store_time` (`time_id`, `store_id`, `day`, `open_time`, `close_time`, `status`) VALUES
(99, 2, 'Mon', '09:00 AM', '10:00 PM', 1),
(100, 2, 'Tue', '09:00 AM', '10:00 PM', 1),
(101, 2, 'Wed', '09:00 AM', '10:00 PM', 1),
(102, 2, 'Thu', '09:00 AM', '10:00 PM', 1),
(103, 2, 'Fri', '09:00 AM', '10:00 PM', 1),
(104, 2, 'Sat', '09:00 AM', '10:00 PM', 1),
(105, 2, 'Sun', '09:00 AM', '10:00 PM', 1),
(120, 4, 'Mon', '09:00 AM', '10:00 PM', 1),
(121, 4, 'Tue', '09:00 AM', '10:00 PM', 1),
(122, 4, 'Wed', '09:00 AM', '10:00 PM', 1),
(123, 4, 'Thu', '09:00 AM', '10:00 PM', 1),
(124, 4, 'Fri', '09:00 AM', '10:00 PM', 1),
(125, 4, 'Sat', '09:00 AM', '10:00 PM', 1),
(126, 4, 'Sun', '09:00 AM', '10:00 PM', 1),
(127, 5, 'Mon', '09:00 AM', '10:00 PM', 1),
(128, 5, 'Tue', '09:00 AM', '10:00 PM', 1),
(129, 5, 'Wed', '09:00 AM', '10:00 PM', 1),
(130, 5, 'Thu', '09:00 AM', '10:00 PM', 1),
(131, 5, 'Fri', '09:00 AM', '10:00 PM', 1),
(132, 5, 'Sat', '09:00 AM', '10:00 PM', 1),
(133, 5, 'Sun', '09:00 AM', '10:00 PM', 1),
(141, 3, 'Mon', '09:00 AM', '10:00 PM', 1),
(142, 3, 'Tue', '09:00 AM', '10:00 PM', 1),
(143, 3, 'Wed', '09:00 AM', '10:00 PM', 1),
(144, 3, 'Thu', '09:00 AM', '10:00 PM', 1),
(145, 3, 'Fri', '09:00 AM', '10:00 PM', 1),
(146, 3, 'Sat', '09:00 AM', '10:00 PM', 1),
(147, 3, 'Sun', '09:00 AM', '10:00 PM', 1),
(162, 6, 'Mon', '09:00 AM', '10:00 PM', 1),
(163, 6, 'Tue', '09:00 AM', '10:00 PM', 1),
(164, 6, 'Wed', '09:00 AM', '10:00 PM', 1),
(165, 6, 'Thu', '09:00 AM', '10:00 PM', 1),
(166, 6, 'Fri', '09:00 AM', '10:00 PM', 1),
(167, 6, 'Sat', '09:00 AM', '10:00 PM', 1),
(168, 6, 'Sun', '09:00 AM', '10:00 PM', 1),
(169, 1, 'Mon', '09:00 AM', '10:00 PM', 1),
(170, 1, 'Tue', '09:00 AM', '10:00 PM', 1),
(171, 1, 'Wed', '09:00 AM', '10:00 PM', 1),
(172, 1, 'Thu', '09:00 AM', '10:00 PM', 1),
(173, 1, 'Fri', '09:00 AM', '10:00 PM', 1),
(174, 1, 'Sat', '09:00 AM', '10:00 PM', 1),
(175, 1, 'Sun', '09:00 AM', '10:00 PM', 1),
(176, 7, 'Mon', '12:30 PM', '12:30 PM', 1),
(177, 7, 'Tue', '12:30 PM', '12:30 PM', 1),
(178, 7, 'Wed', '12:30 PM', '12:30 PM', 1),
(179, 7, 'Thu', '12:30 PM', '12:30 PM', 1),
(180, 7, 'Fri', '12:30 PM', '12:30 PM', 1),
(181, 7, 'Sat', '12:30 PM', '12:30 PM', 1),
(182, 7, 'Sun', '12:30 PM', '12:30 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time_slot`
--

CREATE TABLE `tbl_time_slot` (
  `slot_id` int(11) NOT NULL,
  `slot_date` varchar(100) NOT NULL,
  `from_hour` varchar(100) NOT NULL,
  `from_min` varchar(100) NOT NULL,
  `before_midday` varchar(100) NOT NULL,
  `to_hour` varchar(100) NOT NULL,
  `to_min` varchar(100) NOT NULL,
  `after_midday` varchar(100) NOT NULL,
  `full_time` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_time_slot`
--

INSERT INTO `tbl_time_slot` (`slot_id`, `slot_date`, `from_hour`, `from_min`, `before_midday`, `to_hour`, `to_min`, `after_midday`, `full_time`) VALUES
(1, '2020-06-08', '10', '30', 'AM', '6', '30', 'PM', '10:30 AM to 6:30 PM'),
(2, '2020-06-09', '10', '30', 'AM', '6', '30', 'PM', '10:30 AM to 6:30 PM'),
(3, '2020-06-10', '10', '30', 'AM', '6', '30', 'PM', '10:30 AM to 6:30 PM'),
(4, '2020-07-20', '10', '00', 'AM', '1', '00', 'PM', '10:00 AM to 1:00 PM'),
(5, '2020-07-20', '2', '00', 'PM', '7', '00', 'PM', '2:00 PM to 7:00 PM'),
(6, '2020-07-18', '10', '00', 'AM', '1', '00', 'PM', '10:00 AM to 1:00 PM'),
(7, '2020-07-18', '2', '00', 'PM', '7', '00', 'PM', '2:00 PM to 7:00 PM'),
(8, '2020-07-19', '10', '00', 'AM', '1', '00', 'PM', '10:00 AM to 1:00 PM'),
(9, '2020-07-19', '2', '00', 'PM', '7', '00', 'PM', '2:00 PM to 7:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `unit_id` int(11) NOT NULL,
  `unit` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`unit_id`, `unit`) VALUES
(1, 'Lbs'),
(2, 'Ltr'),
(4, 'Pcs'),
(5, 'gms'),
(6, 'Kg'),
(7, 'oz'),
(8, 'ml'),
(9, 'Packet');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Delete') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `device_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `device_token` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `device_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `avatar`, `status`, `device_id`, `device_token`, `device_type`, `timezone`, `created_at`, `updated_at`) VALUES
(1, 'Bipin', 'Nakrani', 'nakrani0108@gmail.com', '8000366136', '123456', '', 'Inactive', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-25 10:17:36', '2020-06-08 09:11:16'),
(2, 'Bipin1', 'Nakrani1', 'nakrani0109@gmail.com', '8000366138', '123456', 'Koala.jpg', 'Inactive', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-26 10:23:20', '2020-06-08 09:11:17'),
(3, 'Bipin1', 'Nakrani1', 'nakrani0107@gmail.com', '8000366137', '123456', 'Koala.jpg', 'Inactive', 'F824BBD5-6EAB-4210-B3CE-8122B770B7E8', '123456789', 'ios', 'Asia/Kolkata', '2020-05-26 10:52:48', '2020-06-08 09:11:18'),
(4, 'Bipin1', 'Nakrani1', 'vivek@gmail.com', '1234567890', '123456', '', 'Active', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-26 11:09:22', '2020-05-27 10:53:01'),
(5, 'Bipin1', 'Nakrani1', 'vivek12@gmail.com', '1234567899', '123456', 'commingsoon.png', 'Active', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-26 11:12:19', '2020-05-27 10:53:01'),
(6, 'Bipin1', 'Nakrani1', 'sumit@gmail.com', '9998777540', '123456', 'ic_logoiPadApp_76pt.png', 'Active', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-27 10:47:04', '2020-05-27 10:53:01'),
(7, 'Bhaumik', 'Shah', 'bhaumik.teamtech@gmail.com', '9898599880', 'Abc@123', '', 'Active', 'B3EBBBD1-A8CB-4B1A-93FA-AB09DF3BBF82', '123456789', 'ios', 'Asia/Kolkata', '2020-05-28 11:16:26', '2020-05-29 13:53:55'),
(8, 'Bhaumik', 'Shah', 'bhaumik.teamtech@gmail.com', '9898599880', 'Abc@123', '', 'Active', 'B3EBBBD1-A8CB-4B1A-93FA-AB09DF3BBF82', '123456789', 'ios', 'Asia/Kolkata', '2020-05-28 11:16:26', '2020-05-29 13:53:55'),
(9, 'Bipin', 'Nakrani', 'nakrani0108@gmail.com', '8000366136', '123456', '', 'Inactive', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-25 10:17:36', '2020-06-08 09:11:16'),
(10, 'Bipin1', 'Nakrani1', 'nakrani0109@gmail.com', '8000366138', '123456', 'Koala.jpg', 'Inactive', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-26 10:23:20', '2020-06-08 09:11:17'),
(11, 'Bipin1', 'Nakrani1', 'nakrani0107@gmail.com', '8000366137', '123456', 'Koala.jpg', 'Inactive', 'F824BBD5-6EAB-4210-B3CE-8122B770B7E8', '123456789', 'ios', 'Asia/Kolkata', '2020-05-26 10:52:48', '2020-06-08 09:11:18'),
(12, 'Bipin1', 'Nakrani1', 'vivek@gmail.com', '1234567890', '123456', '', 'Active', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-26 11:09:22', '2020-05-27 10:53:01'),
(13, 'Bipin1', 'Nakrani1', 'vivek12@gmail.com', '1234567899', '123456', 'commingsoon.png', 'Active', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-26 11:12:19', '2020-05-27 10:53:01'),
(14, 'Bipin1', 'Nakrani1', 'sumit@gmail.com', '9998777540', '123456', 'ic_logoiPadApp_76pt.png', 'Active', 'sdfdsfsdf', 'weuihkbksdf', 'ios', 'Asia/Kolkata', '2020-05-27 10:47:04', '2020-05-27 10:53:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_card_detail`
--
ALTER TABLE `tbl_card_detail`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`,`city_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_db_temp_request`
--
ALTER TABLE `tbl_db_temp_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `db_id` (`db_id`,`order_id`);

--
-- Indexes for table `tbl_delivery_address`
--
ALTER TABLE `tbl_delivery_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_delivery_boy`
--
ALTER TABLE `tbl_delivery_boy`
  ADD PRIMARY KEY (`db_id`);

--
-- Indexes for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  ADD PRIMARY KEY (`favourite_id`),
  ADD KEY `user_id` (`user_id`,`store_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `tbl_notification_list`
--
ALTER TABLE `tbl_notification_list`
  ADD PRIMARY KEY (`notify_id`),
  ADD KEY `user_id` (`user_id`,`order_id`),
  ADD KEY `db_id` (`db_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`,`city_id`,`db_id`);

--
-- Indexes for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`,`store_id`,`item_id`);

--
-- Indexes for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_order_status_history`
--
ALTER TABLE `tbl_order_status_history`
  ADD PRIMARY KEY (`status_history_id`),
  ADD KEY `order_id` (`order_id`,`status_id`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `tbl_product_item`
--
ALTER TABLE `tbl_product_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `tbl_store_time`
--
ALTER TABLE `tbl_store_time`
  ADD PRIMARY KEY (`time_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `tbl_time_slot`
--
ALTER TABLE `tbl_time_slot`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_card_detail`
--
ALTER TABLE `tbl_card_detail`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_db_temp_request`
--
ALTER TABLE `tbl_db_temp_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_delivery_address`
--
ALTER TABLE `tbl_delivery_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_delivery_boy`
--
ALTER TABLE `tbl_delivery_boy`
  MODIFY `db_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_favourite`
--
ALTER TABLE `tbl_favourite`
  MODIFY `favourite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notification_list`
--
ALTER TABLE `tbl_notification_list`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_status`
--
ALTER TABLE `tbl_order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order_status_history`
--
ALTER TABLE `tbl_order_status_history`
  MODIFY `status_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_product_item`
--
ALTER TABLE `tbl_product_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_store_time`
--
ALTER TABLE `tbl_store_time`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `tbl_time_slot`
--
ALTER TABLE `tbl_time_slot`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
