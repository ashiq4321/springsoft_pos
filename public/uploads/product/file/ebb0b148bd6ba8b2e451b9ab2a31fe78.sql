-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 05:01 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebazar`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminpi`
--

CREATE TABLE `adminpi` (
  `admin_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `phone_no` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `catagory_id` int(10) NOT NULL,
  `catagory_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`catagory_id`, `catagory_name`) VALUES
(1, 'men'),
(2, 'women'),
(3, 'child'),
(4, 'winter'),
(5, 'summer'),
(6, 'fall'),
(7, 'womennn'),
(9, 'aaa444'),
(30, 'cat33'),
(31, 'catagory123');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(10) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `percentage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_code`, `percentage`) VALUES
(1, 'va001', 20),
(2, 'vf666', 15),
(3, '567', 10),
(4, 'l77', 25),
(5, 'cc11', 25),
(6, 'bbb33', 30),
(7, 'hhh666', 66),
(8, 'gg222', 25),
(9, 'nn333', 25);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_seller`
--

CREATE TABLE `coupon_seller` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `couponSeller` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_seller`
--

INSERT INTO `coupon_seller` (`id`, `couponSeller`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 'gg222', '25', NULL, NULL),
(2, 'nn333', '25', NULL, NULL),
(4, 'zzz111', '25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customerpi`
--

CREATE TABLE `customerpi` (
  `customer_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone_no` int(20) NOT NULL,
  `block_status` tinyint(1) NOT NULL,
  `membership_status` varchar(20) NOT NULL,
  `shopping_point` int(10) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerpi`
--

INSERT INTO `customerpi` (`customer_id`, `user_id`, `name`, `email`, `address`, `dob`, `phone_no`, `block_status`, `membership_status`, `shopping_point`, `profile_pic`, `amount`) VALUES
(1, 12, 'bb', 'customer1@gmail', 'fgfgdfg', '2020-11-03', 555555, 0, 'regular', 100, 'imagesssss', 1111111),
(3, 13, 'cc', 'customer2@gmail', 'fgfgdfg', '2020-11-03', 555555, 0, 'regular', 100, 'imagesssss', 1111111);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_01_03_152334_create_coupon_seller_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `seller_revenue` int(10) NOT NULL,
  `company_revenue` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`order_id`, `customer_id`, `user_id`, `product_id`, `quantity`, `order_status`, `paid`, `date`, `seller_revenue`, `company_revenue`) VALUES
(1, 1, 93, 10, 2, 'pending', 0, '2020-11-09', 50, 30),
(2, 1, 93, 13, 4, 'deliverd', 1, '2020-12-16', 30, 20),
(3, 3, 93, 10, 555, 'deliverd', 1, '2020-12-16', 30, 20),
(4, 1, 93, 10, 3333, 'cancel', 1, '2020-12-16', 30, 20),
(5, 1, 93, 10, 3, 'deliverd', 1, '2020-12-16', 50, 20),
(8, 1, 93, 10, 3, 'pending', 1, '2020-12-16', 30, 20),
(9, 1, 93, 10, 3, 'cancel', 1, '2020-12-16', 30, 20),
(11, 1, 98, 54, 3, 'deliverd', 1, '2020-12-16', 30, 20),
(12, 1, 98, 54, 3, 'deliverd', 1, '2020-12-16', 30, 20),
(13, 1, 98, 55, 3, 'deliverd', 1, '2020-12-16', 30, 20);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `poll_id` int(10) NOT NULL,
  `product_name` int(50) NOT NULL,
  `count` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `catagory_id` int(10) DEFAULT NULL,
  `product_img` varchar(100) DEFAULT NULL,
  `average_rating` double DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `published` tinyint(10) DEFAULT NULL,
  `exclusive` tinyint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `user_id`, `product_name`, `quantity`, `price`, `catagory_id`, `product_img`, `average_rating`, `description`, `published`, `exclusive`) VALUES
(5, NULL, '55', 1, 0, NULL, '50', 100, '1', 0, NULL),
(10, 93, 'uuuuuuuuuu', 11, 9, 2, '/pictures/image_1606173108647.jpg', 0, 'hhhh', 1, 1),
(13, 93, 'hgjkhk', 12, 9, 5, '/pictures/image_1606173108647.jpg', 0, 'ghjhgjghj', 0, 1),
(32, 93, 'hhh', 20, 20, 4, 'nokia.jpg', 0, 'desss1', 0, 0),
(37, 2, 'vvvv', 8, 9, 1, 'nokia.jpg', 0, 'jhkjhk', 0, 0),
(47, 93, 'x', 55, 55, 1, 'nokia.jpg', 0, 'dessss1', 1, 0),
(49, 93, 'iiii', 66, 77, 3, 'nokia.jpg', 0, 'jklkjl', 1, 0),
(50, 93, 'm', 66, 66, 1, 'nokia.jpg', 0, 'ghjhgjghj', 0, 0),
(53, 98, 'name2', 786, 78678, 1, 'nokia.jpg', 0, 'dessss1', 0, 0),
(54, 98, 'name444444', 666, 666, 1, 'nokia.jpg', 0, 'dessss1', 0, 0),
(55, 97, 'p1', 47, 22, 1, 'retretfg.PNG', 0, 'dessss1', 0, 0),
(56, 98, 'prodcutyy', 55, 556, 1, 'logogog.PNG', 0, 'dessss1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(10) NOT NULL,
  `fromuser` int(10) NOT NULL,
  `touser` int(10) NOT NULL,
  `report_msg` varchar(100) NOT NULL,
  `checked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `fromuser`, `touser`, `report_msg`, `checked`) VALUES
(1, 1, 12, 'fghfgh', NULL),
(2, 1, 12, 'fghfgh', NULL),
(3, 1, 1, 'ghghj', NULL),
(4, 1, 12, 'fghfgh', NULL),
(9, 1, 2, 'h', NULL),
(10, 1, 2, 'tryrtyrty', NULL),
(11, 1, 2, 'uuuuuu', NULL),
(12, 2, 2, 'yyyyyyy', NULL),
(17, 2, 12, 'jghjghjghj', NULL),
(18, 2, 13, 'ttthgfhfghfgdh', NULL),
(19, 2, 12, 'yuyuyuyuyuyu', NULL),
(20, 2, 12, 'aaaaaaaaa', NULL),
(21, 2, 13, '', NULL),
(22, 2, 13, '', NULL),
(23, 2, 13, 'rrrpp', NULL),
(24, 93, 1, 'reerere', NULL),
(26, 98, 1, 'hjkhjkjhk', NULL),
(27, 98, 1, 'report1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `retailsellerpi`
--

CREATE TABLE `retailsellerpi` (
  `retailseller_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone_no` int(20) NOT NULL,
  `level` int(10) NOT NULL,
  `selling_point` int(10) NOT NULL,
  `profile_pic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `review_msg` varchar(30) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `customer_id`, `product_id`, `review_msg`, `rating`) VALUES
(13, 1, 10, 'good product', 4),
(14, 1, 10, 'good product', 3),
(15, 1, 5, 'good product', 5),
(16, 1, 55, 'good product', 5),
(17, 1, 55, 'bad product', 5);

-- --------------------------------------------------------

--
-- Table structure for table `savedproductlist`
--

CREATE TABLE `savedproductlist` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sellerpi`
--

CREATE TABLE `sellerpi` (
  `seller_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_no` int(10) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `social_media` varchar(100) NOT NULL,
  `level` int(10) NOT NULL,
  `selling_point` float(10,10) NOT NULL,
  `block_status` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerpi`
--

INSERT INTO `sellerpi` (`seller_id`, `user_id`, `name`, `email`, `address`, `phone_no`, `profile_pic`, `social_media`, `level`, `selling_point`, `block_status`, `verified`) VALUES
(4, 98, 'aumlan', 'aumlan@gmail.com', '', 0, '', '', 0, 0.0000000000, 0, 0),
(8, 97, 'Aumlan Abrar', 'aumlan0120@gmail.com', '', 0, '', '', 0, 0.0000000000, 0, 0),
(9, 99, 'jkjkjk', 'jk@gmail.com', '', 0, '', '', 0, 0.0000000000, 0, 0),
(10, 100, 'hg', 'hg@gmail.com', '', 0, '', '', 0, 0.0000000000, 0, 0),
(11, 97, 'Aumlan Abrar', 'aumlan0120@gmail.com', '', 0, '', '', 0, 0.0000000000, 0, 0),
(12, 97, 'Aumlan Abrar', 'aumlan0120@gmail.com', '', 0, '', '', 0, 0.0000000000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sellsreport`
--

CREATE TABLE `sellsreport` (
  `sells_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `month` date NOT NULL,
  `amount` int(10) NOT NULL,
  `revenue` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `type`) VALUES
(1, 'email@gm', '1', 'SELLER'),
(2, 'email@gm', '1', 'SELLER'),
(12, 'customer@gmail', '1', 'CUSTOMER'),
(13, 'customer1@gmail', '1', 'CUSTOMER'),
(88, 'email@gm', '1', 'SELLER'),
(89, 'ff@g', '1', 'SELLER'),
(90, 'ee@g', '1', 'SELLER'),
(91, 'gg@g', '1', 'SELLER'),
(92, 'hhh@g', '1', 'SELLER'),
(93, 'rt@gmail.com', '111', 'SELLER');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'aaaaaaa', 'hh@gmail.com', NULL, '$2y$10$k.D/1mf6JHmTLXA3SM/wxuNy9nFKN7cnd1j2ge6FxaJMeI1gfBKYS', NULL, '2021-01-04 12:58:42', '2021-01-04 12:58:42'),
(93, 'Aumlanul', 'aumlanggg@gmail.com', NULL, '$2y$10$LYsupQ9x22C8Rr.RXWBW4eAp8eVveIZisGa6BnhbARmpOysWk.YtO', NULL, '2021-01-04 15:59:42', '2021-01-04 15:59:42'),
(94, 'sss', 'sss@gmail.com', NULL, '$2y$10$FGKhJO9VVEhfTf1SCE9uBOB8M1DoGHLtZOK.GzCN1zy8fQywbbKMW', NULL, '2021-01-04 17:33:03', '2021-01-04 17:33:03'),
(96, 'qqq', 'qq@gmail.com', NULL, '$2y$10$1or5/Gn/Zp4adhi92fwfaOrTn9LT6oKzw0EvY9Ow5rVUtfEtW9jv.', NULL, '2021-01-04 19:12:11', '2021-01-04 19:12:11'),
(97, 'Aumlan Abrar', 'aumlan0120@gmail.com', NULL, '$2y$10$4zS5khdxVpfwAycqx6LQXOBIJYRAsrwJcqwPytO4ecjNhz2Nt77XW', NULL, '2021-01-04 19:21:40', '2021-01-04 19:21:40'),
(98, 'aumlan', 'aumlan@gmail.com', NULL, '$2y$10$gkLY5d5C65mjZcONnDr4cO38QDGCN8llfQXoLKoo03hf6zx3/1SRG', NULL, '2021-01-04 20:35:34', '2021-01-04 20:35:34'),
(99, 'jkjkjk', 'jk@gmail.com', NULL, '$2y$10$27.G9jN8bH9MtrtVh1d0oO/fK3JWlAVl3jYUnCTKu9ezKllB2emSq', NULL, '2021-01-04 22:29:16', '2021-01-04 22:29:16'),
(100, 'hg', 'hg@gmail.com', NULL, '$2y$10$Fe/J/AGAqsNKqIoS.McIzOOQkCKX47OcGBIyFBzTSZnzBu/Kc.12u', NULL, '2021-01-04 22:30:02', '2021-01-04 22:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminpi`
--
ALTER TABLE `adminpi`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`catagory_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `coupon_seller`
--
ALTER TABLE `coupon_seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerpi`
--
ALTER TABLE `customerpi`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `catagory_id` (`catagory_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `fromuser` (`fromuser`),
  ADD KEY `touser` (`touser`);

--
-- Indexes for table `retailsellerpi`
--
ALTER TABLE `retailsellerpi`
  ADD PRIMARY KEY (`retailseller_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `savedproductlist`
--
ALTER TABLE `savedproductlist`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `sellerpi`
--
ALTER TABLE `sellerpi`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `sellsreport`
--
ALTER TABLE `sellsreport`
  ADD PRIMARY KEY (`sells_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminpi`
--
ALTER TABLE `adminpi`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `catagory_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupon_seller`
--
ALTER TABLE `coupon_seller`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customerpi`
--
ALTER TABLE `customerpi`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `poll_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `retailsellerpi`
--
ALTER TABLE `retailsellerpi`
  MODIFY `retailseller_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `savedproductlist`
--
ALTER TABLE `savedproductlist`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellerpi`
--
ALTER TABLE `sellerpi`
  MODIFY `seller_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sellsreport`
--
ALTER TABLE `sellsreport`
  MODIFY `sells_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerpi` (`customer_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `customerpi`
--
ALTER TABLE `customerpi`
  ADD CONSTRAINT `customerpi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `orderlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerpi` (`customer_id`),
  ADD CONSTRAINT `orderlist_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`catagory_id`) REFERENCES `catagory` (`catagory_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`touser`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `retailsellerpi`
--
ALTER TABLE `retailsellerpi`
  ADD CONSTRAINT `retailsellerpi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerpi` (`customer_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `sellsreport`
--
ALTER TABLE `sellsreport`
  ADD CONSTRAINT `sellsreport_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customerpi` (`customer_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
