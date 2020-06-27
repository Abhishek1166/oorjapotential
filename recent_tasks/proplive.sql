-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 23, 2020 at 06:33 PM
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
(3, 'rent', 'property', 'rent', 0, 'https://base.dev/uploads/category/880b1f8d3e565ffbc521dde8f9b8241f.jpeg', 1, '2020-02-22 01:10:18', 1, '2020-03-19 11:52:02', 1);

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
(5, 'amenities', 'property', 'amenities', NULL, 1, 1, 1, 1, '2020-02-25 17:58:50', 1, '2020-03-11 09:12:14');

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
(44, 4, 'Gumanpura', 'gumanpura', NULL, NULL, 1, 1, '2020-03-21 16:34:22', 1, '2020-03-21 16:34:22');

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
(1,'site_logo', 'https://base.dev/assets/img/logo.png'),
(2,'site_favicon', 'https://base.dev/assets/img/logo.png'),
(3,'site_name', 'proplive'),
(4,'site_mobile', '8005680948'),
(5,'site_mail', 'info@proplive.in'),
(6,'site_address', ''),
(7,'site_map', ''),
(8,'contact_us_response', ''),
(9,'site_map', ''),
(10,'site_map', ''),
(11,'social_facebook', 'https://facebook.com/'),
(12,'social_instagram', 'https://www.instagram.com/'),
(13,'social_twitter', 'https://twitter.com/'),
(14,'social_linkedin', 'https://twitter.com/'),
(15,'social_youtube', 'https://twitter.com/');

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
(2, '127.0.0.1', 'admin_1', 'admin_1', 'admin@proplive.com', '7532954154', '20a87b22b0129af7818ba45688e1be88ea286519', 'ajeet', 'rathore', 'https://base.dev/uploads/users/c011387646cce8929050f12fdaac501a.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '1', '1', NULL, NULL, NULL, NULL, NULL, 'ADMIN', 2, NULL, NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36', 'web', 'Chrome', '80.0.3987.149', 'Mac OS X', '', '2020-03-22 16:30:50', 1, '2020-03-22 16:30:50', 1, '2020-03-23 13:00:10');

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
(2, 'admin', 'admin', 1, 1, '2020-03-22 16:27:14', 1, '2020-03-23 12:53:58');

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
(1, 1, 1, 'admin_add', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(2, 1, 1, 'admin_list', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(3, 1, 1, 'admin_edit', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(4, 1, 1, 'admin_delete', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(5, 1, 2, 'post_add', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(6, 1, 2, 'post_list', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(7, 1, 2, 'post_edit', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(8, 1, 2, 'post_delete', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(9, 1, 3, 'category_add', 1, 1, '2020-03-12 03:06:32', 1, '2020-03-12 03:06:32'),
(10, 1, 3, 'category_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(11, 1, 3, 'category_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(12, 1, 3, 'category_delete', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(13, 1, 16, 'comment_add', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(14, 1, 16, 'comment_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(15, 1, 16, 'comment_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(16, 1, 16, 'comment_delete', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(17, 1, 4, 'filter_add', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(18, 1, 4, 'filter_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(19, 1, 4, 'filter_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(20, 1, 4, 'filter_delete', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(21, 1, 5, 'gallery_add', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(22, 1, 5, 'gallery_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(23, 1, 5, 'gallery_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(24, 1, 5, 'gallery_delete', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(25, 1, 6, 'lead_add', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(26, 1, 6, 'lead_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(27, 1, 6, 'lead_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(28, 1, 6, 'lead_delete', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(29, 1, 7, 'module_add', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(30, 1, 7, 'module_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(31, 1, 7, 'module_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(32, 1, 7, 'module_delete', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(33, 1, 19, 'order_add', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(34, 1, 19, 'order_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(35, 1, 19, 'order_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(36, 1, 19, 'order_delete', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(37, 1, 8, 'page_add', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(38, 1, 8, 'page_list', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(39, 1, 8, 'page_edit', 1, 1, '2020-03-12 03:06:33', 1, '2020-03-12 03:06:33'),
(40, 1, 8, 'page_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(41, 1, 9, 'product_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(42, 1, 9, 'product_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(43, 1, 9, 'product_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(44, 1, 9, 'product_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(45, 1, 10, 'project_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(46, 1, 10, 'project_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(47, 1, 10, 'project_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(48, 1, 10, 'project_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(49, 1, 11, 'property_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(50, 1, 11, 'property_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(51, 1, 11, 'property_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(52, 1, 11, 'property_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(53, 1, 17, 'setting_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(54, 1, 17, 'setting_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(55, 1, 17, 'setting_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(56, 1, 17, 'setting_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(57, 1, 12, 'slider_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(58, 1, 12, 'slider_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(59, 1, 12, 'slider_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(60, 1, 12, 'slider_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(61, 1, 13, 'testimonial_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(62, 1, 13, 'testimonial_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(63, 1, 13, 'testimonial_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(64, 1, 13, 'testimonial_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(65, 1, 14, 'user_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(66, 1, 14, 'user_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(67, 1, 14, 'user_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(68, 1, 14, 'user_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(69, 1, 15, 'user-role_add', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(70, 1, 15, 'user-role_list', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(71, 1, 15, 'user-role_edit', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(72, 1, 15, 'user-role_delete', 1, 1, '2020-03-12 03:06:34', 1, '2020-03-12 03:06:34'),
(73, 2, 1, 'admin_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(74, 2, 1, 'admin_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(75, 2, 1, 'admin_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(76, 2, 1, 'admin_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(77, 2, 2, 'post_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(78, 2, 2, 'post_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(79, 2, 2, 'post_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(80, 2, 2, 'post_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(81, 2, 3, 'category_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(82, 2, 3, 'category_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(83, 2, 3, 'category_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(84, 2, 3, 'category_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(85, 2, 16, 'comment_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(86, 2, 16, 'comment_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(87, 2, 16, 'comment_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(88, 2, 16, 'comment_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(89, 2, 4, 'filter_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(90, 2, 4, 'filter_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(91, 2, 4, 'filter_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(92, 2, 4, 'filter_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(93, 2, 5, 'gallery_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(94, 2, 5, 'gallery_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(95, 2, 5, 'gallery_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(96, 2, 5, 'gallery_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(97, 2, 6, 'lead_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(98, 2, 6, 'lead_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(99, 2, 6, 'lead_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(100, 2, 6, 'lead_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(101, 2, 10, 'project_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(102, 2, 10, 'project_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(103, 2, 10, 'project_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(104, 2, 10, 'project_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(105, 2, 11, 'property_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(106, 2, 11, 'property_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(107, 2, 11, 'property_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(108, 2, 11, 'property_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(109, 2, 17, 'setting_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(110, 2, 17, 'setting_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(111, 2, 17, 'setting_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(112, 2, 17, 'setting_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(113, 2, 12, 'slider_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(114, 2, 12, 'slider_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(115, 2, 12, 'slider_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(116, 2, 12, 'slider_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(117, 2, 13, 'testimonial_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(118, 2, 13, 'testimonial_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(119, 2, 13, 'testimonial_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(120, 2, 13, 'testimonial_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(121, 2, 14, 'user_add', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(122, 2, 14, 'user_list', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(123, 2, 14, 'user_edit', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14'),
(124, 2, 14, 'user_delete', 1, 1, '2020-03-22 10:57:14', 1, '2020-03-22 10:57:14');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `filter_product_category_relations`
--
ALTER TABLE `filter_product_category_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filter_values`
--
ALTER TABLE `filter_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_reactions`
--
ALTER TABLE `post_reactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_group_powers`
--
ALTER TABLE `user_group_powers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `user_modules`
--
ALTER TABLE `user_modules`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
