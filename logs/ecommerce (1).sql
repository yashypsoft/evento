-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 06:26 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `prefix` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `prefix`, `name`, `mobile`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'Yash P', 701683813, 'admin@admin.com', 'admin', '2020-02-14 15:32:53', '2020-02-14 15:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `url_key` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `url_key`, `image`, `status`, `description`, `parent_category`, `created_at`, `updated_at`) VALUES
(26, 'Electronics', 'electronics', 'attachment.jpg', 'ON', 'descriptionaaaaaaa', 0, '2020-02-15 12:03:07', '0000-00-00 00:00:00'),
(30, 'Men', 'men', 'attachment.jpg', 'ON', 'asd', 0, '2020-02-17 10:07:24', '0000-00-00 00:00:00'),
(33, 'Mobiles', 'mobiles', 'mobile.jpg', 'ON', 'mobile description', 26, '2020-02-17 14:41:34', '0000-00-00 00:00:00'),
(34, 'Mobile assesories', 'mobileassesories', 'mobile.jpg', 'ON', 'cs', 26, '2020-02-17 14:42:37', '0000-00-00 00:00:00'),
(35, 'Footwear', 'footwear', 'footwear.jpg', 'ON', 'footwear description', 30, '2020-02-17 14:45:02', '0000-00-00 00:00:00'),
(36, 'T-Shirt', 'tshirt', 'tshirt.jpg', 'ON', 'description of tshirt', 30, '2020-02-17 14:46:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL,
  `page_title` varchar(50) NOT NULL,
  `url_key` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `page_title`, `url_key`, `status`, `content`, `created_at`, `updated_at`) VALUES
(4, 'aboutus', 'aboutus', 'ON', 'About us  Content', '2020-02-15 17:00:00', '2020-02-17 17:45:47'),
(5, 'Home', 'home', 'ON', 'content of about us', '2020-02-15 17:33:39', '2020-02-15 18:12:32'),
(6, 'contactus', 'contactus', 'ON', 'content of about us\r\n', '2020-02-15 18:13:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `url_key` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `short_description` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `sku`, `url_key`, `image`, `status`, `description`, `short_description`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(11, 'Redmi Note 8 Pro', '2551', 'redminoteeightpro', 'mobile.jpg', 'ON', 'description', 'short desc', 8000, 50, '2020-02-17 14:53:38', '0000-00-00 00:00:00'),
(12, 'Samsung A70s', '2555855', 'samsungaseventys', 'mobile.jpg', 'ON', 'bgfreddc', 'fecs', 24000, 80, '2020-02-17 14:54:26', '0000-00-00 00:00:00'),
(13, 'POCO  x2', '1236126', 'pocoxtwo', '960x0.jpg', 'ON', 'rgbnbfgdw', 'refggd', 17000, 80, '2020-02-17 14:55:18', '0000-00-00 00:00:00'),
(14, 'Powerbank', '16516', 'powerbank', 'powerbank.jpg', 'ON', 'edfgbbg', 'sfvfcb', 800, 98, '2020-02-17 14:57:23', '0000-00-00 00:00:00'),
(15, 'Earphone', '87541', 'earphone', 'earphone.jpg', 'ON', 'earphone', 'earphone', 700, 80, '2020-02-17 14:58:28', '2020-02-17 15:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `product_id`, `category_id`) VALUES
(9, 11, 33),
(10, 12, 33),
(11, 13, 33),
(12, 14, 34),
(13, 15, 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_category` (`parent_category`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `products_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
