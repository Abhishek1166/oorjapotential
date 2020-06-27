-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2020 at 06:19 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";

--
-- Database: `base_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post_type` enum('product','property','event','post') DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `image` text,
  `created_by` bigint(20) DEFAULT '1',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `post_type`, `slug`, `parent_id`, `image`, `created_by`, `created_date`, `modified_by`, `modified_date`, `status`) VALUES
(2, 'sell', 'property', 'sell', 0, 'https://base.dev/uploads/category/055fa69d4802236db91fbbd0fb1fba4f.jpeg', 1, '2020-02-22 01:09:55', 1, '2020-03-19 11:52:10', 1),
(3, 'rent', 'property', 'rent', 0, 'https://base.dev/uploads/category/880b1f8d3e565ffbc521dde8f9b8241f.jpeg', 1, '2020-02-22 01:10:18', 1, '2020-03-19 11:52:02', 1),
(4, 'groceries', 'product', 'groceries', 0, 'https://base.dev/uploads/category/f8447ea63c6ecdd9805ef2e97367a121.png', 1, '2020-03-11 10:55:33', 1, '2020-03-23 06:24:11', 1),
(5, 'blog post', 'post', 'blog-post', 0, '', 1, '2020-03-23 12:21:11', 1, '2020-03-23 12:22:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `id` bigint(20) NOT NULL,
  `filter_title` varchar(255) DEFAULT NULL,
  `post_type` enum('property','product','event') DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` text,
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '0 : Single | 1: Multiple',
  `auto_add` int(1) NOT NULL DEFAULT '0' COMMENT '0: false | 1 : Auto Add True',
  `status` int(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`id`, `filter_title`, `post_type`, `slug`, `image`, `type`, `auto_add`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'projects', 'property', 'projects', NULL, 0, 1, 1, 1, '2020-02-25 17:53:41', 1, '2020-03-11 09:11:57'),
(2, 'property type', 'property', 'property-type', NULL, 0, 1, 1, 1, '2020-02-25 17:57:04', 1, '2020-03-20 10:58:09'),
(3, 'no of beadrooms', 'property', 'no-of-beadrooms', NULL, 0, 1, 1, 1, '2020-02-25 17:57:23', 1, '2020-03-20 10:58:17'),
(4, 'locality', 'property', 'locality', NULL, 0, 1, 1, 1, '2020-02-25 17:57:48', 1, '2020-03-11 09:12:10'),
(5, 'amenities', 'property', 'amenities', NULL, 1, 1, 1, 1, '2020-02-25 17:58:50', 1, '2020-03-11 09:12:14'),
(6, 'electronic', 'product', 'electronic', 'https://base.dev/uploads/filter/a595cc8b1d9221ba3e76525f35900f8c.png', 0, 1, 1, 1, '2020-03-11 09:51:49', 1, '2020-03-21 17:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `filter_product_category_relations`
--

CREATE TABLE `filter_product_category_relations` (
  `id` bigint(20) NOT NULL,
  `key_id` bigint(20) DEFAULT NULL,
  `value_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filter_product_category_relations`
--

INSERT INTO `filter_product_category_relations` (`id`, `key_id`, `value_id`, `product_id`, `category_id`) VALUES
(31, 1, 6, 2, 2),
(32, 2, 7, 2, 2),
(33, 3, 2, 2, 2),
(34, 4, 3, 2, 2),
(36, 1, 28, 3, 3),
(37, 2, 7, 3, 3),
(38, 5, 8, 3, 3),
(40, 1, 29, 4, 3),
(41, 2, 7, 4, 3),
(42, 4, 32, 4, 3),
(43, 5, 5, 4, 3),
(45, 1, 30, 5, 3),
(46, 2, 31, 5, 3),
(47, 4, 11, 5, 3),
(48, 5, 4, 5, 3),
(50, 1, 30, 6, 2),
(51, 2, 31, 6, 2),
(52, 4, 11, 6, 2),
(53, 5, 5, 6, 2),
(60, 1, 29, 7, 3),
(61, 2, 31, 7, 3),
(62, 3, 10, 7, 3),
(63, 4, 32, 7, 3),
(80, 1, 1, 1, 2),
(81, 2, 27, 1, 2),
(82, 3, 14, 1, 2),
(83, 4, 32, 1, 2),
(92, 6, 45, 10, 4),
(100, 1, 42, 9, 2),
(101, 2, 27, 9, 2),
(102, 3, 43, 9, 2),
(103, 4, 44, 9, 2),
(104, 5, 4, 9, 2),
(105, 5, 35, 9, 2),
(106, 5, 41, 9, 2),
(135, 1, 33, 8, 2),
(136, 2, 27, 8, 2),
(137, 3, 2, 8, 2),
(138, 4, 34, 8, 2),
(139, 5, 4, 8, 2),
(140, 5, 5, 8, 2),
(141, 5, 8, 8, 2),
(142, 5, 35, 8, 2),
(143, 5, 36, 8, 2),
(144, 5, 37, 8, 2),
(145, 5, 38, 8, 2),
(146, 5, 39, 8, 2),
(147, 5, 40, 8, 2),
(148, 5, 41, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `filter_values`
--

CREATE TABLE `filter_values` (
  `id` bigint(20) NOT NULL,
  `filter_key_id` bigint(20) DEFAULT NULL,
  `filter_value_title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` text,
  `description` text,
  `status` int(1) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filter_values`
--

INSERT INTO `filter_values` (`id`, `filter_key_id`, `filter_value_title`, `slug`, `image`, `description`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 1, 'Govind Villa', 'govindvilla', NULL, NULL, 1, 1, '2020-02-25 18:13:42', 1, '2020-02-25 18:13:42'),
(2, 3, '1BHK', '1bhk', NULL, NULL, 1, 1, '2020-02-25 18:13:42', 1, '2020-02-25 18:13:42'),
(3, 4, 'Mahaveer Nager', 'mahaveernager', NULL, NULL, 1, 1, '2020-02-25 18:13:42', 1, '2020-02-25 18:13:42'),
(4, 5, 'Parking', 'parking', NULL, NULL, 1, 1, '2020-02-25 18:13:42', 1, '2020-02-25 18:13:42'),
(5, 5, 'Gym', 'gym', NULL, NULL, 1, 1, '2020-02-25 18:13:42', 1, '2020-02-25 18:13:42'),
(6, 1, 'Pukhraj', 'pukhraj', NULL, NULL, 1, 1, '2020-02-25 23:14:16', 1, '2020-02-25 23:14:16'),
(7, 2, 'Apartment', 'apartment', NULL, NULL, 1, 1, '2020-02-25 23:14:16', 1, '2020-02-25 23:14:16'),
(8, 5, 'Swimming Pool', 'swimmingpool', NULL, NULL, 1, 1, '2020-02-25 23:14:17', 1, '2020-02-25 23:14:17'),
(9, 1, 'Demo Project', 'demoproject', NULL, NULL, 1, 1, '2020-02-26 03:02:49', 1, '2020-02-26 03:02:49'),
(10, 3, '2BHK', '2bhk', NULL, NULL, 1, 1, '2020-02-26 03:02:49', 1, '2020-02-26 03:02:49'),
(11, 4, 'Dadabari', 'dadabari', NULL, NULL, 1, 1, '2020-02-26 03:02:49', 1, '2020-02-26 03:02:49'),
(12, 1, 'pukhra new', 'pukhra-new', NULL, NULL, 3, 1, '2020-02-27 22:40:09', 1, '2020-03-22 14:59:38'),
(13, 1, 'BENCHMARK TOWNSHIP', 'benchmarktownship', NULL, NULL, 1, 1, '2020-02-27 23:43:02', 1, '2020-02-27 23:43:02'),
(14, 3, '3BHK', '3bhk', NULL, NULL, 1, 1, '2020-02-27 23:43:02', 1, '2020-02-27 23:43:02'),
(26, 7, 'Electronic Fan', 'electronicfan', NULL, NULL, 1, 1, '2020-03-12 06:43:32', 1, '2020-03-12 06:43:32'),
(27, 2, 'Flat', 'flat', NULL, NULL, 1, 1, '2020-03-18 13:02:33', 1, '2020-03-18 13:02:33'),
(28, 1, 'Residential land in Jodhpur', 'residentiallandinjodhpur', NULL, NULL, 1, 1, '2020-03-18 13:22:05', 1, '2020-03-18 13:22:05'),
(29, 1, 'jaipur project', 'jaipurproject', NULL, NULL, 1, 1, '2020-03-18 13:34:39', 1, '2020-03-18 13:34:39'),
(30, 1, 'House for Sale in Jodhpur', 'houseforsaleinjodhpur', NULL, NULL, 1, 1, '2020-03-18 13:38:23', 1, '2020-03-18 13:38:23'),
(31, 2, 'houses', 'houses', NULL, NULL, 1, 1, '2020-03-18 13:38:24', 1, '2020-03-18 13:38:24'),
(32, 4, 'VIgyan Nagar', 'vigyannagar', NULL, NULL, 1, 1, '2020-03-18 13:46:20', 1, '2020-03-18 13:46:20'),
(33, 1, 'pukhraj element', 'pukhraj-element', NULL, NULL, 1, 1, '2020-03-19 11:12:04', 1, '2020-03-22 14:50:55'),
(34, 4, 'Jhawar Nagar', 'jhawarnagar', NULL, NULL, 1, 1, '2020-03-19 11:12:05', 1, '2020-03-19 11:12:05'),
(35, 5, 'Guest rooms', 'guestrooms', NULL, NULL, 1, 1, '2020-03-19 11:12:05', 1, '2020-03-19 11:12:05'),
(36, 5, 'community hall', 'communityhall', NULL, NULL, 1, 1, '2020-03-19 11:12:05', 1, '2020-03-19 11:12:05'),
(37, 5, 'Indoor Threatre', 'indoorthreatre', NULL, NULL, 1, 1, '2020-03-19 11:12:05', 1, '2020-03-19 11:12:05'),
(38, 5, 'Drivers Dormatory', 'driversdormatory', NULL, NULL, 1, 1, '2020-03-19 11:12:05', 1, '2020-03-19 11:12:05'),
(39, 5, 'Landscaping', 'landscaping', NULL, NULL, 1, 1, '2020-03-19 11:12:06', 1, '2020-03-19 11:12:06'),
(40, 5, 'Reception Lobby', 'receptionlobby', NULL, NULL, 1, 1, '2020-03-19 11:12:06', 1, '2020-03-19 11:12:06'),
(41, 5, 'security Guard 24X7 with cctv survellience', 'securityguard24x7withcctvsurvellience', NULL, NULL, 1, 1, '2020-03-19 11:12:07', 1, '2020-03-19 11:12:07'),
(42, 1, 'smaya groups inc', 'smaya-groups-inc', 'https://base.dev/uploads/filter/8af8378cd8f4a143d742771868a85f06.jpg', NULL, 1, 1, '2020-03-21 16:34:22', 1, '2020-03-22 15:45:26'),
(43, 3, '4BHK', '4bhk', NULL, NULL, 1, 1, '2020-03-21 16:34:22', 1, '2020-03-21 16:34:22'),
(44, 4, 'Gumanpura', 'gumanpura', NULL, NULL, 1, 1, '2020-03-21 16:34:22', 1, '2020-03-21 16:34:22'),
(45, 6, 'Fan', 'fan', NULL, NULL, 1, 1, '2020-03-22 15:47:46', 1, '2020-03-22 15:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) NOT NULL,
  `image` text,
  `img_group` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `img_group`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'image', 'ABCD', 0, 1, '2020-02-26 21:31:45', 1, '2020-02-26 21:31:45'),
(2, 'image', 'EFGH', 0, 1, '2020-02-26 21:31:48', 1, '2020-02-26 21:32:03'),
(3, 'https://base.dev/uploads/gallery/5fa486417b497fc166d220f5ae8cdfa8.jpg', 'gunju', 1, NULL, '2020-02-26 22:12:38', 1, '2020-02-27 01:05:40'),
(4, 'https://base.dev/uploads/gallery/2c7f86373d03c8bd29fdc31cde65a73b.jpg', 'IJKL', 1, 1, '2020-02-26 22:18:43', 1, '2020-02-27 00:35:35'),
(5, 'https://base.dev/uploads/gallery/db86aa6b0979bb46b2bad166e7e4b336.png', 'gunju', 3, 1, '2020-02-27 00:34:10', 1, '2020-02-27 21:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `mobile` varchar(10) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `requirement` bigint(20) NOT NULL COMMENT 'Product_ID | Category_ID',
  `comment` longtext COLLATE utf8_bin NOT NULL,
  `followup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0 - New | 11 - Not Interested | 12 - Interested | 13 - Convened | 14 - Not Convened | 3 - Delete  ',
  `created_by` bigint(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Manage Site''s Leads';

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `order_group_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `coupon_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_quantity` varchar(255) DEFAULT NULL,
  `total_discount` float(10,2) DEFAULT '0.00' COMMENT 'Total Offer & Discountable Price',
  `total_addition` float(10,2) DEFAULT '0.00' COMMENT 'Total Tax & Other Addable Price',
  `total_amount` float(10,2) DEFAULT '0.00' COMMENT 'Total Product Price',
  `total_paid` float(10,2) DEFAULT '0.00' COMMENT 'Calculated Price, To Be Paid ',
  `product_received_date` timestamp NULL DEFAULT NULL,
  `remark` text,
  `payment_mode` enum('online','cod') DEFAULT NULL,
  `payment_status` tinyint(2) DEFAULT '0' COMMENT '0: Unpaid | 1: Paid | 2: Return',
  `delivery_status` tinyint(2) DEFAULT '0' COMMENT '0: New | 1: Delivered | 2: Processing | 3: Cancel | 4: Return',
  `status` int(2) DEFAULT '1' COMMENT '3 : DELETE & Always Status be 1',
  `transaction_id` varchar(255) DEFAULT NULL,
  `transaction_msg` varchar(255) DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `web_token_id` varchar(255) DEFAULT NULL,
  `app_token_id` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `browser_version` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `mobile_device` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_group_id`, `user_id`, `coupon_id`, `product_id`, `product_quantity`, `total_discount`, `total_addition`, `total_amount`, `total_paid`, `product_received_date`, `remark`, `payment_mode`, `payment_status`, `delivery_status`, `status`, `transaction_id`, `transaction_msg`, `user_ip`, `web_token_id`, `app_token_id`, `device_type`, `browser`, `browser_version`, `os`, `mobile_device`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(2, 'ODR25736849', 5, NULL, 6, '1', 0.00, 0.00, 6000.00, 6000.00, NULL, 'f hxgbfgh 85xdghg', 'cod', 1, 0, 1, '41dfceb2a7b4a5abb442334e519a3638', 'backend', '127.0.0.1', NULL, NULL, 'web', 'Chrome', '80.0.3987.132', 'Windows 10', '', 1, '2020-03-16 10:01:52', 1, '2020-03-16 13:47:48'),
(3, 'ODR25736849', 5, NULL, 7, '1', 0.00, 0.00, 800.00, 800.00, NULL, 'f hxgbfgh 85xdghg', 'cod', 1, 0, 1, 'c1dcae476c287fd6754fdd965330664a', 'backend', '127.0.0.1', NULL, NULL, 'web', 'Chrome', '80.0.3987.132', 'Windows 10', '', 1, '2020-03-16 10:01:52', 1, '2020-03-16 13:47:45'),
(7, 'ODR51243968', 5, NULL, 6, '1', 0.00, 0.00, 6000.00, 6000.00, NULL, 'gf cvbcb f gbgbcf szg', 'online', 1, 1, 1, '1fa1175ebfe1f079448d14cc46d951df', 'backend', '127.0.0.1', NULL, NULL, 'web', 'Chrome', '80.0.3987.132', 'Windows 10', '', 1, '2020-03-16 13:45:32', 1, '2020-03-16 13:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `post_image` text,
  `status` tinyint(2) DEFAULT '0',
  `is_pinned` tinyint(1) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `slug`, `title`, `description`, `post_image`, `status`, `is_pinned`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 5, 'bog', 'Bog', '<p>&nbsp;dfgh fghd fhdfz h dfdfgs dfg gdf dfgdfg drzfgdfzgd fgdfg dfgdf d</p>\r\n', 'https://base.dev/uploads/Post/f42979e8b63ece20143fe43aeeaadf5f.jpg', 1, 1, 1, '2020-03-23 12:23:08', 1, '2020-03-23 12:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `post_reactions`
--

CREATE TABLE `post_reactions` (
  `id` bigint(20) NOT NULL,
  `user_ip` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `object_id` bigint(20) DEFAULT NULL,
  `object_type` varchar(255) DEFAULT NULL,
  `reaction_type` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post_type` enum('product','property','event') DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `extra_id` varchar(255) NOT NULL COMMENT 'Raraid',
  `slug` varchar(255) DEFAULT NULL,
  `srt_description` text,
  `description` longtext,
  `regular_price` varchar(255) DEFAULT '0' COMMENT 'Mn Price',
  `sell_price` varchar(255) DEFAULT '0' COMMENT 'Max Price',
  `image` longtext,
  `stock_quantity` varchar(255) DEFAULT NULL,
  `stock_status` int(1) DEFAULT '0' COMMENT '1 : Stockable | 0 : Not Stockable ',
  `on_deal` int(1) DEFAULT '0' COMMENT 'Hot Deals',
  `is_featured` int(1) DEFAULT '0',
  `extra_field` text COMMENT 'Size of Property',
  `extra_field_1` varchar(255) DEFAULT NULL COMMENT 'Proplive for City',
  `extra_date` datetime DEFAULT NULL COMMENT 'Passation Date',
  `avg_rate` varchar(5) DEFAULT '0',
  `rating_count` varchar(20) DEFAULT '0',
  `total_sale` varchar(20) DEFAULT '0',
  `offers` text COMMENT 'Additional Offer Text',
  `status` int(2) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `post_type`, `category_id`, `extra_id`, `slug`, `srt_description`, `description`, `regular_price`, `sell_price`, `image`, `stock_quantity`, `stock_status`, `on_deal`, `is_featured`, `extra_field`, `extra_field_1`, `extra_date`, `avg_rate`, `rating_count`, `total_sale`, `offers`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'Property in Jodhpur for Sale', 'property', 2, '', 'property-in-jodhpur-for-sale', 'Property in Jodhpur for Sale', '4 Bedroom Independent House in Pal Road\r\n₹ 70 Lac\r\n₹ 5,185/sq.ft.\r\n1,350 sq.ft. \r\n(125 sq.m.) Built-up Area\r\n4 BHK\r\n3 Baths\r\n11 properties chopasani housing board, pal road, birla school & near by colonies for sale Sg properties (Purchase / sale) detials below. 1 budget -70lac space -1250sqft 4 room attached latbath 2drawing lobby 2 modular kitchen duplex area -Hari om nagar 2 budget -1.25cr space -1800sqft 4 room 2 hall 2 drawing 2 kitchen 4 latbath duplex area -11 sector 3 budget -1.70cr space -1200sqft 4 room 2 modular kitchen 2 lobby 3 attached latbath corner 3 shop fur. Bed sofa area -Kheme ka kua 4 budget -45lac space -20*41 3 room kitchen lobby 2 latbath duplex 2 hall first floor area -Birla school ke samne 5 budget -60lac space -20*55 duplex 3 room drawing 2 hall 3latbath lobby 2230sqft area -Pal balaji 6 budget -90lac space -3 room drawing lobby 3 latbath modular kitchen 3150sqft duplex area -Pal balaji 7 budget -65lac space -1500sqft 3 room kitchen lobby 2 latbath area -10 sector 8 budget -70lac space -1250sqft 3 room kitchen lobby 3 latbath single story area -Ram nagar 9 budget -68lac space -22.5*50 3 room attached latbath kitchen lobby single story area -Birla school 10 budget -96lac space -1500sqft 3 room 3 latbath modular kitchen duplex bed / table east facing area - Near spicy kitchen pal road 11 budget -50lac space -648sqft 4 room 3 latbath lobby kitchen duplex area -18 sector', '7000000', '6000000', 'https://base.dev/uploads/property/9e64b3c45f79ca5c7863ab20b10b685f.jpg', NULL, 0, 0, 1, '4 BHK', 'jodhpur', '2020-03-31 01:44:00', '0', '0', '0', '', 1, 1, '2020-03-18 13:02:33', 1, '2020-03-21 16:35:11'),
(2, 'City Home Shankwas House', 'property', 2, '', 'city-home-shankwas-house', 'City Home Shankwas House', 'ity home shankwas house in paota, jodhpur by jai infratech jodhpur is a residential project. The project offers apartment with perfect combination of contemporary architecture and features to provide comfortable living. The apartment are of the following configurations: 2bhk and 3bhk. The size of the apartment ranges in between 66.43 sq. Mt and 114.73 sq. Mt City home shankwas house offers facilities such as gymnasium and lift.It also has amenity like swimming pool. It also offers car parking. Bank loan approved from hdfc home loans, icici bank, uco bank, state bank of india, bank of baroda, axis bank, iifl home loan and micro housing finance corporation limited. It is an under construction project with possession offered in oct, 2021. The project is spread over a total area of 1.79 acres of land. It has 30% of open space. City home shankwas house has a total of 1 towers. The construction is of 7 floors. An accommodation of 98 units has been provided. You can find city home shankwas house price list on 99acres.Com. About city: The real estate market of jodhpur shows positivity with increasing demands from buyers and supply from developers. With improving physical infrastructure that better connects the micro-Markets of the city, jodhpur has seen a positive impact on the realty market. Other factors that support the real estate of this city are presence of excellent healthcare centers, educational institutes and recreational centers in almost every part of the city', '5000', '7000', 'https://base.dev/uploads/property/11bc077374e20a0ff190f4548f6ec5c1.png', NULL, 0, 0, 1, '800 sqFt', 'jaipur', '2020-03-19 01:52:31', '0', '0', '0', '', 1, 1, '2020-03-18 13:12:36', 1, '2020-03-21 16:35:31'),
(3, '2 BHK Residential Apartment in Sardarpura', 'property', 3, '', '2-bhk-residential-apartment-in-sardarpura', '2 BHK Residential Apartment in Sardarpura', ' for sale in sardarpura, jodhpur. The property is 5-10 year old. It is a part of vinit textiles. The apartment is well ventilated with 2 balconies and has 1 bathrooms. This is a furnished east facing property. The width of facing road is 20 feet. The furnishings include. It also has convenience features like lift(s), maintenance staff, water storage, visitor parking and security/fire alarm. The area of the apartment is as follows: * super built-Up: 770 sq. Ft. * built-Up: 700 sq. Ft. * carpet: 670 sq. Ft. The expected price of the property that is on the 3rd floor of 5 floors is 46. 2 lakhs. (Rs. 6000 per sq. Ft. ) Additionally, you can expect. The apartment has marble flooring. The main road facing property is a freehold property. You get one covered parking. The society has a full power back-Up system. It has it\'s water source from municipal corporation. ', '20000', '400000', 'https://base.dev/uploads/property/60c1fd313564c902bbc4977bb42b689a.jpg', NULL, 0, 0, 1, '20 BHK', 'kota', '2020-03-19 01:52:50', '0', '0', '0', '', 1, 1, '2020-03-18 13:22:05', 1, '2020-03-21 16:36:05'),
(4, ' RHB Marwar Apartment', 'property', 3, '', 'rhb-marwar-apartment', ' RHB Marwar Apartmeny', '2 BHK Residential Apartment in Chopasni Housing Board\r\nRHB Marwar Apartment\r\n₹ 35 Lac\r\n₹ 5,148/sq.ft.\r\n680 sq.ft. \r\n(63 sq.m.) Built-up Area\r\n2 BHK\r\n2 Baths\r\n2bhk flat on 2nd floor for sale in marwar apartment located on main road with 24 hrs security and water availability free of cost. 6 kms away from jodhpur junction railway sta', '20', '200', 'https://base.dev/uploads/property/275e2954c150f63f669abdb8de068862.jpg', NULL, 0, 0, 1, '20 sqft', 'kota', '2020-03-19 01:53:17', '0', '0', '0', '', 1, 1, '2020-03-18 13:34:39', 1, '2020-03-21 16:36:02'),
(5, '3 Bedroom Independent House in Shastri Nagar', 'property', 3, '', '3-bedroom-independent-house-in-shastri-nagar', '3 Bedroom Independent House in Shastri Nagar', '7 properties prime location sardarpura a,b,c,d road for sale 1 budget - 1.60cr space -750sqft duplex area -Sardarpura 1st c road 2 budget -2cr space -2 manjila area -C road sardarpur 3 budget -60 lakh space -288sqft 3 manjila area -B road sardarpura 4 budget -55 lakh space -450sqft 2 rooms kitchen lobby 2 latbath area -B road sardarpura 5 budget -35 lakh space -850sqft 2 room kitchen lobby latbath flat area -Sardarpura b road 6 budget -2cr space -1550sqft 8 rooms 3 kitchen 3 manjila area -1st b road sardarpura 7 budget -90lac space -1400sqft 3 bhk flat area - Sardarpura a road Office address main chopasani road 2nd pulia near indian oil petrol pump wali gali time 9:30 am to 6:00 pm shashwat garg Sg propertie', '5000', '6000', 'https://base.dev/uploads/property/ab3b13c5aa995c47791ff5986cd02b58.jpg', NULL, 0, 1, 0, '800 BHk', 'kota', '2020-03-30 12:00:00', '0', '0', '0', '', 1, 1, '2020-03-18 13:38:23', 1, '2020-03-21 16:35:58'),
(6, 'Gokuldham Society', 'property', 2, '', 'gokuldham-society', 'Gokuldham Society', '7 properties prime location sardarpura a,b,c,d road for sale 1 budget - 1.60cr space -750sqft duplex area -Sardarpura 1st c road 2 budget -2cr space -2 manjila area -C road sardarpur 3 budget -60 lakh space -288sqft 3 manjila area -B road sardarpura 4 budget -55 lakh space -450sqft 2 rooms kitchen lobby 2 latbath area -B road sardarpura 5 budget -35 lakh space -850sqft 2 room kitchen lobby latbath flat area -Sardarpura b road 6 budget -2cr space -1550sqft 8 rooms 3 kitchen 3 manjila area -1st b road sardarpura 7 budget -90lac space -1400sqft 3 bhk flat area - Sardarpura a road Office address main chopasani road 2nd pulia near indian oil petrol pump wali gali time 9:30 am to 6:00 pm shashwat garg Sg properties shashwat ga', '2000', '4000', 'https://base.dev/uploads/property/2c573a75ed1924bb928335b149094997.jpg', NULL, 0, 1, 0, '300 BHK', 'delhi', '2020-03-19 01:54:04', '0', '0', '0', '', 1, 1, '2020-03-18 13:40:25', 1, '2020-03-21 16:35:54'),
(7, 'Adeshwar Heights', 'property', 3, '', 'adeshwar-heights', 'Adeshwar Heights', 'The data (based on the search query performed), on this webpage of 99acres.com has been made available for informational purposes only and no representation or warranty is expressly or impliedly given as to its accuracy. Any investment decisions that you take should not be based relying solely on the information that is available on the website 99acres.com or downloaded from it. Nothing contained herein shall be deemed to constitute legal advice, solicitation, invitation to acquire by the developer/builder or any other entity. You are advised to visit the relevant RERA website and contact builder/advertisers directly to know more about the project before taking any decision based on the contents displayed on the website 99acres.com. If you have any question or want to share feedback, feel free to write to us at projects-feedback@99acres.com. Trademarks belong to the respective owners.', '5000', '6000', 'https://base.dev/uploads/property/f49cc88c3ebaf546a97fa9dff944d44b.jpg', NULL, 0, 1, 0, '800 BHK', 'kota', '2020-03-19 01:58:58', '0', '0', '0', '', 1, 1, '2020-03-18 13:46:20', 1, '2020-03-21 16:35:50'),
(8, 'Ready to Move New Studio Flats /1BHK Flats', 'property', 2, 'RAJ/P/2017/510', 'ready-to-move-new-studio-flats-1bhk-flats', 'Ready to possession New Studio Flats For Buy at Adjoining Allen sammunat ', 'sjdkfh sd hsdf sdf ksdf dg sdjghsagjkdsf asdkj hdsf jh kedhsfkjahsdkfajkdsfhjashd ajsdvdsfv xdv', '2100000', '2100000', 'https://base.dev/uploads/property/28879fb1844d4d862ac35ddf379f4145.png', NULL, 0, 1, 1, '435 Sq.Ft.', 'kota', '2020-03-22 10:02:19', '0', '0', '0', '', 1, 8, '2020-03-19 11:12:04', 8, '2020-03-22 16:32:36'),
(9, '4 BHK flat', 'property', 2, 'ASD78945', '4-bhk-flat', 'af dfgdfg dfgfd dfg dfg', ' sdf dfs sg dfgdxfg dsf g', '500000', '10000000', 'https://base.dev/uploads/property/8f713c658318c8dfd183054b101a7ffc.jpg', NULL, 0, 0, 0, '800 sqft', 'kota', '2020-12-24 12:00:00', '0', '0', '0', '', 1, 1, '2020-03-21 16:34:22', 1, '2020-03-22 16:25:23'),
(10, 'WOOCOMMERCE', 'product', 4, '', 'woocommerce', 'sdf sfsfsdfs df', 's dfsdf sdfsdf sdf', '800', '850', 'https://base.dev/uploads/product/856b4b5eeb2edad4fc716ca637bb1e24.jpg', NULL, 0, 0, 0, NULL, NULL, NULL, '0', '0', '0', '', 1, 1, '2020-03-22 15:47:46', 1, '2020-03-22 15:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `option_key` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_key`, `option_value`) VALUES
(1, 'site_logo', 'https://base.dev/assets/img/logo.png'),
(2, 'site_mobile', '8005680948'),
(3, 'site_mail', 'proplive@gmail.com'),
(4, 'facebook', 'https://facebook.com/'),
(5, 'instagram', 'https://www.instagram.com/'),
(6, 'twitter', 'https://twitter.com/'),
(7, 'site_name', 'proplive'),
(8, 'site_favicon', 'https://base.dev/assets/img/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` text,
  `redirect_link` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `redirect_link`, `location`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'FirstSlide', 'D fv dzfvcvd fxdcvdf xvc dzfg cv', 'https://base.dev/uploads/slider/1ee361cde32f59f789e00effab96f2fc.jpeg', 'fb.me', NULL, 1, 1, '2020-03-17 10:50:30', 1, '2020-03-17 10:50:30'),
(2, 'SecondSlide', 'ad sd szdfd sds dfsd df sd', 'https://base.dev/uploads/slider/d9a903f857aae3e59e7026e76c11363b.jpg', 'SecondSlide', NULL, 1, 1, '2020-03-17 10:51:37', 1, '2020-03-23 12:48:38'),
(3, 'ThirdSlide', 'd fgdfgdf sdfg ', 'https://base.dev/uploads/slider/ea662ca317822e610bdf2102084ebbb7.jpeg', 'instagram.com', NULL, 1, 1, '2020-03-17 10:53:00', 1, '2020-03-17 10:53:00'),
(4, 'zdfdf', 'dfgdfg', 'https://base.dev/uploads/slider/3ece280a777dcaa9708d1554911c8b07.jpg', 'fb.me', NULL, 1, 1, '2020-03-23 12:47:55', 1, '2020-03-23 12:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `image` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `comment`, `rating`, `image`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'Gunjan', 'nicer drgdfgdfs dfzg fgdh dfg dxrjfgj fbxchrst hfgb', '3', 'https://base.dev/uploads/testimonial/95bdb224d32c232260312f6854ac722c.jpg', 1, 1, '2020-02-27 20:50:47', 1, '2020-03-22 06:53:57'),
(2, 'Gunjan', 'nice', '3', 'image', 3, 1, '2020-02-27 20:50:51', 1, '2020-02-27 23:17:16'),
(3, 'Kaushal', 'hii this is kaushal', '5', 'https://base.dev/uploads/testimonial/2c082880d9ea7721f64256cf2a22804c.png', 1, 1, '2020-02-27 23:13:25', 1, '2020-03-21 09:21:10'),
(4, 'Gunjan', 'hii Gunjna sdfd sg dfjkh shj kes fjkhsdh fjksdhfjhjksd ffh jksdfhjksdfhjksdf jkhksfhdhj ksadfh kjdsfh sjdkh jksdfghjk dfhg df sdfg', '2', 'https://base.dev/uploads/testimonial/9c8d637a078fd762db4cac8c84ab29b8.jpg', 1, 1, '2020-02-28 00:05:47', 1, '2020-03-21 13:38:37'),
(5, 'WOOCOMMERCE', 'asdasd asd', '5', 'https://base.dev/uploads/testimonial/a6f226395d4b85e16bc451a35ecb482b.jpg', 1, 1, '2020-03-22 06:55:17', 1, '2020-03-22 06:55:17'),
(6, 'zdfxgdfzg', 'dfg fs dfxbdfzg. fb ', '4', 'https://base.dev/uploads/testimonial/c035db9e04b4d864a412ba13a4bb544e.jpg', 1, 1, '2020-03-22 07:01:24', 1, '2020-03-22 07:01:24'),
(7, 'zdfg dzfgdf', 'df gdz dzfh nd fgfdg zd', '4.5', 'https://base.dev/uploads/testimonial/85d8798f119d744f99e453e51d6c04b0.jpg', 1, 1, '2020-03-22 07:01:45', 1, '2020-03-22 07:01:45'),
(8, 'cf hgbxdfthb', 'ghyhk b  tjfg ', '2.5', 'https://base.dev/uploads/testimonial/bd43b1b011b1b48086e4443243a3a194.jpg', 1, 1, '2020-03-22 07:02:09', 1, '2020-03-22 07:02:09'),
(9, 'Krishna', 'ed dfg aerzdz f dfg', '1.5', 'https://base.dev/uploads/testimonial/d698f095d215653659e3b84c9e8fddfd.jpg', 1, 1, '2020-03-22 07:02:31', 1, '2020-03-22 07:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `requirement` text,
  `comment` longtext,
  `lead_from` varchar(255) DEFAULT NULL,
  `followup_date` timestamp NULL DEFAULT NULL,
  `is_pinned` int(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `about` text,
  `gender` varchar(6) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 - New | 1 - Approve | 2 -  Pending | 3 - Delete | 4 - Block',
  `parent_id` bigint(20) DEFAULT NULL,
  `email_verified` varchar(255) DEFAULT NULL COMMENT 'Store Verification Code or True',
  `mobile_verified` varchar(255) DEFAULT NULL COMMENT 'Store Verification Code or True',
  `google_id` varchar(255) DEFAULT NULL,
  `fb_id` varchar(255) DEFAULT NULL,
  `address_id` bigint(20) DEFAULT NULL,
  `ref_id` bigint(20) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `user_type` enum('ADMIN','SUBSCRIBER') NOT NULL DEFAULT 'SUBSCRIBER',
  `role_id` bigint(20) DEFAULT '0' COMMENT '0 for Subscriber',
  `web_token_id` varchar(255) DEFAULT NULL,
  `app_token_id` varchar(255) DEFAULT NULL,
  `last_login_device` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `browser_version` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `mobile_device` varchar(255) DEFAULT NULL,
  `last_login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_ip`, `username`, `slug`, `email`, `mobile`, `password`, `first_name`, `last_name`, `profile_pic`, `requirement`, `comment`, `lead_from`, `followup_date`, `is_pinned`, `dob`, `about`, `gender`, `status`, `parent_id`, `email_verified`, `mobile_verified`, `google_id`, `fb_id`, `address_id`, `ref_id`, `pincode`, `user_type`, `role_id`, `web_token_id`, `app_token_id`, `last_login_device`, `device_type`, `browser`, `browser_version`, `os`, `mobile_device`, `last_login_date`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, '127.0.0.1', 'admin', 'admin', 'admin@gmail.com', '7014569040', '20a87b22b0129af7818ba45688e1be88ea286519', 'Krishna', 'gujjjar', 'https://base.dev/uploads/users/821d7d4610b3b3e4df7835e725a53c3e.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', 1, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'web', 'Chrome', '79.0.3945.130', 'Windows 10', '', '2020-02-18 16:20:45', 0, '2020-02-18 16:20:45', 0, '2020-03-03 06:51:26'),
(2, '127.0.0.1', 'blog', 'blog', 'blog@user.com', '7531567545', '20a87b22b0129af7818ba45688e1be88ea286519', 'blog', 'admin', 'https://base.dev/uploads/users/1e049f58d78905a4a94aef63d13522c8.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '1', '1', NULL, NULL, NULL, NULL, NULL, 'ADMIN', 5, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', 'web', 'Chrome', '80.0.3987.122', 'Windows 10', '', '2020-03-03 12:53:35', 1, '2020-03-03 12:53:35', 1, '2020-03-03 12:53:35'),
(3, '127.0.0.1', 'bm', 'bm', 'bm@user.com', '9756418041', '20a87b22b0129af7818ba45688e1be88ea286519', 'manager', 'blog', 'https://base.dev/uploads/users/a58e50983d4871e800263035ab5ca8d7.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, '1', '1', NULL, NULL, NULL, NULL, NULL, 'ADMIN', 6, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', 'web', 'Chrome', '80.0.3987.122', 'Windows 10', '', '2020-03-03 14:08:25', 2, '2020-03-03 14:08:25', 2, '2020-03-03 14:08:25'),
(4, NULL, 'asdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-12 07:42:13', 2, '2020-03-12 07:42:13', NULL, '2020-03-12 07:42:13'),
(5, '127.0.0.1', 'admin1', 'admin1', 'admin1@gmail.com', '8005680948', NULL, 'test3', 'test1', NULL, 'nothing', '', '', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBSCRIBER', 0, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36', 'web', 'Chrome', '80.0.3987.132', 'Windows 10', '', '2020-03-12 08:44:56', 1, '2020-03-12 08:44:56', 1, '2020-03-12 08:45:16'),
(6, '::1', 'asdasd', 'asdasd', 'asdasd@afas.dfg', '8784154545', NULL, 'asdas', 'asdasd', NULL, 'demo requirement', 'asf dszg dftg jsdhfgjkh jksbjk hfeseklj esdfkl jefsuh jsekh kljefso jlosd jfkljkld fvh jkh sklfjklj dgklsfj klj fsklj kl efshjksdjf vklj dgrsh jkjsld;fcfk jfgsd hjks fhdjkb rsjg jk hsjkdfs g ft', 'Web', '2020-03-28 06:30:00', 0, NULL, NULL, NULL, 11, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBSCRIBER', 0, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36', 'web', 'Chrome', '80.0.3987.149', 'Mac OS X', '', '2020-03-12 09:44:35', 3, '2020-03-12 09:44:35', 1, '2020-03-22 06:45:43'),
(7, '127.0.0.1', 'barry', 'barry', 'barry@allen.com', '7539514568', NULL, 'barry', 'allen', NULL, 'nothing', 'Nothing', 'web', '2020-03-14 06:30:00', 0, NULL, NULL, NULL, 12, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBSCRIBER', 0, NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36', 'web', 'Chrome', '80.0.3987.132', 'Windows 10', '', '2020-03-12 09:45:35', 6, '2020-03-12 09:45:35', 1, '2020-03-13 09:16:02'),
(8, '::1', 'admin_1', 'admin_1', 'admin@proplive.com', '7532954154', '20a87b22b0129af7818ba45688e1be88ea286519', 'ajit', 'rathor', 'https://base.dev/uploads/users/c011387646cce8929050f12fdaac501a.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '1', '1', NULL, NULL, NULL, NULL, NULL, 'ADMIN', 7, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36', 'web', 'Chrome', '80.0.3987.149', 'Mac OS X', '', '2020-03-22 16:30:50', 1, '2020-03-22 16:30:50', 1, '2020-03-22 16:30:50'),
(9, '::1', 'krishnag', 'krishnag', 'krishnag@gmail.com', NULL, NULL, 'krishna', NULL, NULL, 'join proplive', 'dxg dfh dzfgh dfgh dfgdzfgz dfgfdzg dzfgbndsf hjhsdjkfh jkhfs jdh jkhsdfjhjkfhs djhjkasf jifasjdkajcf szhjfshdfjkshdfj shdfjh shjkhsdfjh jkshdf hjksdhf ujhkaejf', 'contact', NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBSCRIBER', 0, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36', 'web', 'Chrome', '80.0.3987.149', 'Mac OS X', '', '2020-03-23 10:36:28', NULL, '2020-03-23 10:36:28', NULL, '2020-03-23 10:46:36'),
(10, '::1', 'alex', 'alex', 'alex@gmail.com', NULL, NULL, 'alex', NULL, NULL, 'join proplive', 'd fdfgzdfgdzfg dfgdfg zdf', 'contact', NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SUBSCRIBER', 0, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36', 'web', 'Chrome', '80.0.3987.149', 'Mac OS X', '', '2020-03-23 11:06:06', NULL, '2020-03-23 11:06:06', NULL, '2020-03-23 11:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `group_title` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `slug`, `group_title`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'super-admin', 'super admin', 1, 1, '2020-02-29 01:00:44', 1, '2020-02-29 02:20:41'),
(5, 'blog-admin', 'blog admin', 1, 1, '2020-03-03 12:51:16', 1, '2020-03-03 12:51:16'),
(6, 'blog-manager', 'blog manager', 1, 2, '2020-03-03 14:06:05', 2, '2020-03-03 14:06:05'),
(7, 'proplive', 'proplive', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_powers`
--

CREATE TABLE `user_group_powers` (
  `id` bigint(20) NOT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  `module_id` bigint(20) DEFAULT NULL,
  `action_key` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group_powers`
--

INSERT INTO `user_group_powers` (`id`, `group_id`, `module_id`, `action_key`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(126, 5, 1, 'admin_add', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(127, 5, 1, 'admin_list', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(128, 5, 2, 'post_add', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-07 08:57:45'),
(129, 5, 2, 'post_list', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-07 08:57:52'),
(130, 5, 2, 'post_edit', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-07 08:58:02'),
(131, 5, 2, 'post_delete', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-07 08:58:09'),
(132, 5, 16, 'comment_add', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(133, 5, 16, 'comment_list', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(134, 5, 16, 'comment_edit', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(135, 5, 16, 'comment_delete', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(136, 5, 15, 'user-role_add', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(137, 5, 15, 'user-role_list', 1, 1, '2020-03-03 14:03:15', 1, '2020-03-03 14:03:15'),
(138, 6, 1, 'admin_add', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-03 14:06:06'),
(139, 6, 1, 'admin_list', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-03 14:06:06'),
(140, 6, 2, 'post_add', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-07 08:58:18'),
(141, 6, 2, 'post_list', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-07 08:58:26'),
(142, 6, 16, 'comment_add', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-03 14:06:06'),
(143, 6, 16, 'comment_list', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-03 14:06:06'),
(144, 6, 15, 'user-role_add', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-03 14:06:06'),
(145, 6, 15, 'user-role_list', 1, 2, '2020-03-03 14:06:06', 2, '2020-03-03 14:06:06'),
(286, 1, 1, 'admin_add', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(287, 1, 1, 'admin_list', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(288, 1, 1, 'admin_edit', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(289, 1, 1, 'admin_delete', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(290, 1, 2, 'post_add', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(291, 1, 2, 'post_list', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(292, 1, 2, 'post_edit', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(293, 1, 2, 'post_delete', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(294, 1, 3, 'category_add', 1, 1, '2020-03-12 08:36:32', 1, '2020-03-12 08:36:32'),
(295, 1, 3, 'category_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(296, 1, 3, 'category_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(297, 1, 3, 'category_delete', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(298, 1, 16, 'comment_add', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(299, 1, 16, 'comment_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(300, 1, 16, 'comment_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(301, 1, 16, 'comment_delete', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(302, 1, 4, 'filter_add', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(303, 1, 4, 'filter_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(304, 1, 4, 'filter_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(305, 1, 4, 'filter_delete', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(306, 1, 5, 'gallery_add', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(307, 1, 5, 'gallery_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(308, 1, 5, 'gallery_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(309, 1, 5, 'gallery_delete', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(310, 1, 6, 'lead_add', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(311, 1, 6, 'lead_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(312, 1, 6, 'lead_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(313, 1, 6, 'lead_delete', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(314, 1, 7, 'module_add', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(315, 1, 7, 'module_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(316, 1, 7, 'module_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(317, 1, 7, 'module_delete', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(318, 1, 19, 'order_add', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(319, 1, 19, 'order_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(320, 1, 19, 'order_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(321, 1, 19, 'order_delete', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(322, 1, 8, 'page_add', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(323, 1, 8, 'page_list', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(324, 1, 8, 'page_edit', 1, 1, '2020-03-12 08:36:33', 1, '2020-03-12 08:36:33'),
(325, 1, 8, 'page_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(326, 1, 9, 'product_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(327, 1, 9, 'product_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(328, 1, 9, 'product_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(329, 1, 9, 'product_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(330, 1, 10, 'project_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(331, 1, 10, 'project_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(332, 1, 10, 'project_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(333, 1, 10, 'project_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(334, 1, 11, 'property_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(335, 1, 11, 'property_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(336, 1, 11, 'property_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(337, 1, 11, 'property_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(338, 1, 17, 'setting_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(339, 1, 17, 'setting_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(340, 1, 17, 'setting_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(341, 1, 17, 'setting_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(342, 1, 12, 'slider_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(343, 1, 12, 'slider_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(344, 1, 12, 'slider_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(345, 1, 12, 'slider_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(346, 1, 13, 'testimonial_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(347, 1, 13, 'testimonial_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(348, 1, 13, 'testimonial_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(349, 1, 13, 'testimonial_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(350, 1, 14, 'user_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(351, 1, 14, 'user_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(352, 1, 14, 'user_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(353, 1, 14, 'user_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(354, 1, 15, 'user-role_add', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(355, 1, 15, 'user-role_list', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(356, 1, 15, 'user-role_edit', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(357, 1, 15, 'user-role_delete', 1, 1, '2020-03-12 08:36:34', 1, '2020-03-12 08:36:34'),
(358, 7, 1, 'admin_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(359, 7, 1, 'admin_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(360, 7, 1, 'admin_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(361, 7, 1, 'admin_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(362, 7, 2, 'post_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(363, 7, 2, 'post_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(364, 7, 2, 'post_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(365, 7, 2, 'post_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(366, 7, 3, 'category_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(367, 7, 3, 'category_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(368, 7, 3, 'category_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(369, 7, 3, 'category_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(370, 7, 16, 'comment_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(371, 7, 16, 'comment_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(372, 7, 16, 'comment_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(373, 7, 16, 'comment_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(374, 7, 4, 'filter_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(375, 7, 4, 'filter_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(376, 7, 4, 'filter_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(377, 7, 4, 'filter_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(378, 7, 5, 'gallery_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(379, 7, 5, 'gallery_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(380, 7, 5, 'gallery_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(381, 7, 5, 'gallery_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(382, 7, 6, 'lead_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(383, 7, 6, 'lead_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(384, 7, 6, 'lead_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(385, 7, 6, 'lead_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(386, 7, 10, 'project_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(387, 7, 10, 'project_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(388, 7, 10, 'project_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(389, 7, 10, 'project_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(390, 7, 11, 'property_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(391, 7, 11, 'property_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(392, 7, 11, 'property_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(393, 7, 11, 'property_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(394, 7, 17, 'setting_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(395, 7, 17, 'setting_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(396, 7, 17, 'setting_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(397, 7, 17, 'setting_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(398, 7, 12, 'slider_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(399, 7, 12, 'slider_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(400, 7, 12, 'slider_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(401, 7, 12, 'slider_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(402, 7, 13, 'testimonial_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(403, 7, 13, 'testimonial_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(404, 7, 13, 'testimonial_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(405, 7, 13, 'testimonial_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(406, 7, 14, 'user_add', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(407, 7, 14, 'user_list', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(408, 7, 14, 'user_edit', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14'),
(409, 7, 14, 'user_delete', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-22 16:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_modules`
--

CREATE TABLE `user_modules` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `module_title` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_modules`
--

INSERT INTO `user_modules` (`id`, `slug`, `module_title`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(1, 'admin', 'Admin', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(2, 'post', 'Blog', 1, 1, '2020-02-28 23:15:58', NULL, '2020-03-12 08:36:21'),
(3, 'category', 'category', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(4, 'filter', 'filter', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(5, 'gallery', 'gallery', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(6, 'lead', 'lead', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(7, 'module', 'module', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(8, 'page', 'page', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(9, 'product', 'product', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(10, 'project', 'project', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(11, 'property', 'property', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(12, 'slider', 'slider', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(13, 'testimonial', 'testimonial', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(14, 'user', 'user', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-28 23:15:58'),
(15, 'user-role', 'user-role', 1, 1, '2020-02-28 23:15:58', NULL, '2020-02-29 00:32:11'),
(16, 'comment', 'Comments', 1, 1, '2020-03-02 03:40:00', 1, '2020-03-02 03:40:00'),
(17, 'setting', 'Settings', 1, 1, '2020-03-02 03:40:00', 1, '2020-03-02 03:40:00'),
(18, 'test', 'Testing', 0, NULL, '2020-03-05 08:43:07', NULL, '2020-03-05 08:43:07'),
(19, 'order', 'Orders', 1, 1, '2020-03-12 07:52:59', 1, '2020-03-12 07:52:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filter_product_category_relations`
--
ALTER TABLE `filter_product_category_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filter_values`
--
ALTER TABLE `filter_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requirement` (`requirement`),
  ADD KEY `status` (`status`),
  ADD KEY `followup_date` (`followup_date`),
  ADD KEY `created_date` (`created_date`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_powers`
--
ALTER TABLE `user_group_powers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_modules`
--
ALTER TABLE `user_modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `filter_product_category_relations`
--
ALTER TABLE `filter_product_category_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `filter_values`
--
ALTER TABLE `filter_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_reactions`
--
ALTER TABLE `post_reactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_group_powers`
--
ALTER TABLE `user_group_powers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;

--
-- AUTO_INCREMENT for table `user_modules`
--
ALTER TABLE `user_modules`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
