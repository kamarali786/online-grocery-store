-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2024 at 06:55 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `banner_id` int(25) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `image`, `active`) VALUES
(10, 'images/uploads/banner/1708678842.jpg', 1),
(6, 'images/uploads/banner/1708678835.jpeg', 1),
(9, 'images/uploads/banner/1708678847.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`) VALUES
(30, 5, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(25) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `image`, `active`) VALUES
(11, 'vegetable', 'images/uploads/category/1707573301.jpg', 1),
(9, 'Fruits', 'images/uploads/category/1707573306.jpg', 1),
(12, 'beverges', 'images/uploads/category/1707573321.jpeg', 1),
(13, 'spices', 'images/uploads/category/1707573332.jpg', 1),
(14, 'Dairy', 'images/uploads/category/1707573365.jpg', 1),
(15, 'Legums', 'images/uploads/category/1708484239.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `email`, `message`) VALUES
(27, 2, 'test@gmail.com', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `date` date NOT NULL,
  `price` int(25) NOT NULL,
  `status` varchar(100) NOT NULL,
  `payment` varchar(200) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `date`, `price`, `status`, `payment`) VALUES
(39, 2, '2021-02-24', 23, 'Delivered', 'cash on delivery'),
(44, 2, '2024-02-23', 50, 'Delivered', 'cash on delivery'),
(42, 2, '2021-02-24', 69, 'Delivered', 'Cash on Delivery'),
(43, 2, '2021-02-24', 69, 'Delivered', 'credit card payment'),
(45, 4, '2024-02-23', 180, 'Delivered', 'cash on delivery'),
(46, 4, '2024-02-23', 180, 'Delivered', 'cash on delivery'),
(47, 2, '2024-03-11', 180, 'Canceled', 'cash on delivery'),
(48, 6, '2024-03-11', 60, 'Canceled', 'cash on delivery'),
(49, 7, '2024-03-11', 80, 'Canceled', 'cash on delivery'),
(50, 7, '2024-03-11', 80, 'Pending', 'cash on delivery'),
(51, 7, '2024-03-11', 20, 'Pending', 'cash on delivery');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_details_id` int(25) NOT NULL AUTO_INCREMENT,
  `cart_id` int(25) NOT NULL,
  `order_id` int(25) NOT NULL,
  `total` int(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(25) NOT NULL,
  PRIMARY KEY (`order_details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `cart_id`, `order_id`, `total`, `quantity`, `product_name`, `price`) VALUES
(36, 31, 47, 180, 3, 'Graphs', 60),
(35, 28, 46, 180, 3, 'Orange', 60),
(34, 27, 45, 180, 3, 'Grapes', 60),
(33, 26, 44, 50, 2, 'Chees', 25),
(32, 25, 43, 69, 3, 'black', 23),
(31, 24, 42, 69, 3, 'black', 23),
(30, 23, 41, 69, 3, 'black', 23),
(29, 22, 40, 92, 4, 'black', 23),
(28, 21, 39, 23, 1, 'onion', 23),
(27, 20, 38, 23, 1, 'onion', 23),
(26, 19, 35, 46, 2, 'onion', 23),
(25, 18, 31, 92, 4, 'onion', 23),
(24, 17, 30, 46, 2, 'onion', 23),
(37, 32, 48, 60, 3, 'Bisleri', 20),
(38, 33, 49, 80, 4, 'Bisleri', 20),
(39, 34, 50, 80, 4, 'Bisleri', 20),
(40, 35, 51, 20, 1, 'Bisleri', 20);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(25) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `product_price` double NOT NULL,
  `stock` int(25) UNSIGNED NOT NULL,
  `unit` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int(25) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image`, `description`, `product_price`, `stock`, `unit`, `active`, `category_id`) VALUES
(5, 'onion', 'images/uploads/product/1707573423.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 23, 20, '250 gm', 1, 11),
(6, 'Eggplant', 'images/uploads/product/1707573441.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 30, 61, '500 gm', 1, 11),
(7, 'Tomato', 'images/uploads/product/1708484393.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 45, 15, '750 gm', 1, 11),
(8, 'Cabbege', 'images/uploads/product/1708484435.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 25, 12, '500 gm', 1, 11),
(9, 'Apple', 'images/uploads/product/1708484469.webp', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 150, 16, '1 Kg', 1, 9),
(10, 'Graphs', 'images/uploads/product/1708484499.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 60, 19, '250 gm', 1, 9),
(11, 'Orange', 'images/uploads/product/1708484532.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 60, 42, '750 gm', 1, 9),
(12, 'Pinappele', 'images/uploads/product/1708484570.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 250, 23, '2 Kg', 1, 9),
(13, 'Chana', 'images/uploads/product/1708484666.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 100, 5, '1 Kg', 1, 15),
(14, 'Chilli', 'images/uploads/product/1708484712.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 250, 23, '250 gm', 1, 15),
(15, 'oil', 'images/uploads/product/1708484753.webp', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 460, 25, '5 Kg', 1, 15),
(16, 'Sugar', 'images/uploads/product/1708484816.webp', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 35, 25, '750 gm', 1, 15),
(17, 'Amul Butter', 'images/uploads/product/1708484890.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 100, 5, '2 Kg', 1, 14),
(18, 'Chees', 'images/uploads/product/1708485009.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 25, 48, '250 gm', 1, 14),
(19, 'Cow Gee', 'images/uploads/product/1708485038.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 500, 45, '1 Kg', 1, 14),
(20, 'Kesar Milk', 'images/uploads/product/1708485075.webp', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 20, 80, '250 gm', 1, 14),
(21, 'Coca Cola', 'images/uploads/product/1708485355.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 200, 20, '500 gm', 1, 12),
(22, 'Jeera', 'images/uploads/product/1708485465.jpeg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 190, 60, '2 Kg', 1, 12),
(23, 'Pepsi', 'images/uploads/product/1708485511.jpeg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 50, 25, '750 gm', 1, 12),
(24, 'Bisleri', 'images/uploads/product/1708485540.jpeg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 20, 13, '1 Kg', 1, 12),
(25, 'AJWAIN-SEED', 'images/uploads/product/1708485777.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 2500, 25, '750 gm', 1, 13),
(26, 'BLACK-PAPER', 'images/uploads/product/1708679244.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 250, 25, '500 gm', 1, 13),
(27, 'SUWA', 'images/uploads/product/1708679302.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 100, 60, '250 gm', 1, 13),
(28, 'YELLOW-MUSTARD', 'images/uploads/product/1708679337.jpg', 'Explore the bring home the best for you and your Family - because great meals start with great ingredients', 650, 23, '750 gm', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(25) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(200) NOT NULL,
  `setting_value` varchar(200) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `setting_value`) VALUES
(1, 'email', 'onlinegrocery786@gmail.com'),
(2, 'phone_number', '0274200511'),
(3, 'Symbol', 'Choose Symbol'),
(4, 'fb_url', 'http://facebook.com'),
(5, 'x_url', 'http://twitter.com'),
(6, 'insta_url', 'http://Instagram.com'),
(7, 'yt_url', 'http://youtube.com'),
(9, 'logo', 'images/uploads/logo/1707148663.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(25) NOT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'not image',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `type`, `image`) VALUES
(1, 'test', 'test@gmail.com', '1234', 'admin', 'images/uploads/profile/1708680548.jpg'),
(7, 'Maknoijya kamar ali', 'maknojiyaali123@gmail.com', '1234', 'user', 'not image');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `details_id` int(25) NOT NULL AUTO_INCREMENT,
  `user_id` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `note` varchar(11) NOT NULL DEFAULT 'not',
  `image` varchar(250) NOT NULL DEFAULT 'not image set',
  `zip_code` int(25) NOT NULL,
  PRIMARY KEY (`details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`details_id`, `user_id`, `name`, `email`, `phone`, `state`, `city`, `address`, `note`, `image`, `zip_code`) VALUES
(10, 7, 'Maknoijya kamar ali', 'maknojiyaali123@gmail.com', 955869617, 'gujrata', 'PALANPUR', 'at po : chadotar', '', 'images/uploads/profile/1710139938.jpg', 385001);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
