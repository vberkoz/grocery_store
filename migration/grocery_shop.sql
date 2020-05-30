-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 05:54 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `visibility` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `sort_order`, `visibility`) VALUES
(1, 'Всі продукти', 1, 1),
(2, 'Фрукти', 2, 1),
(3, 'Овочі', 3, 1),
(4, 'Гриби', 4, 1),
(5, 'Зелень', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_comment` text,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `bag` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_name`, `user_phone`, `user_address`, `user_comment`, `order_status`, `bag`, `created_at`) VALUES
(26, 9, 'Гріша', '0668132356', 'Kutuzova st. 4/90', '', 0, '{\"31\":1,\"24\":1,\"22\":1}', '2020-05-20 13:03:16'),
(27, 9, 'Гріша', '0668132356', 'Kutuzova st. 4/90', '', 0, '{\"32\":1,\"31\":2,\"30\":3,\"29\":1,\"28\":2,\"27\":1}', '2020-05-21 22:12:18'),
(28, 9, 'Гріша', '0668132356', 'Kutuzova st. 4/90', '', 3, '{\"22\":3,\"21\":3,\"25\":4,\"26\":1,\"30\":1}', '2020-05-22 09:27:07'),
(29, 8, 'Микола', '1234567899', '1-й провулок Герцена, 13', '', 2, '{\"31\":2,\"36\":5,\"26\":2}', '2020-05-23 14:37:50'),
(30, 8, 'Микола', '1234567899', '1-й провулок Герцена, 13', '', 2, '{\"28\":1,\"22\":10,\"29\":1}', '2020-05-27 09:08:38'),
(31, 8, 'Микола', '1234567899', '1-й провулок Герцена, 13', '', 1, '{\"36\":1}', '2020-05-27 09:19:35'),
(32, 8, 'Микола', '1234567899', '1-й провулок Герцена, 13', '', 3, '{\"32\":4}', '2020-05-28 14:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `excerpt`, `content`, `author`, `image`, `type`, `created_at`) VALUES
(1, 'Assorted fruit and nuts', 'Show us the person who said that you are not allowed to eat sweets before going to bed. In response, we will show the assorted fruit and nuts recipe. Save it, just not to lose, buy all the products you need and treat yourself with useful candies.', 'Ingredients\r\nDates without pits - 70g\r\nDried fruit mix - 70g\r\nHazelnut - 70g\r\nAlmond - 70g\r\nHoney of different herbs - 2tbsp\r\nLemon juice - 1tsp\r\nCoconut shaving - to your taste Stages of cooking\r\n                                01\r\n                                Pour all the dried fruits with water and keep there until being softened for 30-60 min. Dry and remove pits.\r\n                                \r\n                                02\r\n                                Put all the ingredients into a blender pouring with lemon juice. Mix it. Add honey and mix again.\r\n                                \r\n                                03\r\n                                Form sweets with dried fruits in a form of balls. Roll every candy in coconut shaving and nuts.Bon appetite!', 'TopicAuthor', 'images/2.png', 'NewsPublication', '2016-05-12 11:05:04'),
(2, 'Smoothie Bowl with Mango', 'Warning: there is no man who can resist the temptation of a smoothie bowl with mango. To be sure in this, buy the products you need and cook the dish at least once.', 'Ingredients\r\nMango cubes frozen - 150g\r\nCoconut milk - 1/2 cup\r\nLime - 1 pcs\r\nHoney of different herbs - to your taste\r\nBlanched almond - to your taste\r\nBlanched hazelnut - to your taste\r\nCoconut flakes - to your taste\r\nStages of cooking\r\n01\r\nMix all the ingredients with coconut milk with a blender till homogeneous mass.\r\n\r\n02\r\nPour the mixture into a bowl. Add some nuts and coconut shaving on it.', 'TopicAuthor', 'images/2.png', 'NewsPublication', '2016-05-11 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL DEFAULT '1',
  `visibility` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) NOT NULL,
  `volume` int(11) DEFAULT '1',
  `unit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category_id`, `product_id`, `price`, `availability`, `visibility`, `image`, `volume`, `unit`) VALUES
(15, 'Банан', 2, 'BBCRLBQH', 33, 1, 1, 'BBCRLBQH.jpg', 1, 'кг'),
(16, 'Яблуко Голден', 2, 'R37PKGP2', 46, 0, 1, 'R37PKGP2.jpg', 1, 'кг'),
(17, 'Апельсин Єгипет', 2, 'CQXE9HUC', 33, 1, 1, 'CQXE9HUC.jpg', 1, 'кг'),
(18, 'Огірок корнішон', 3, '2DDUBV24', 40, 1, 1, '2DDUBV24.jpg', 1, 'кг'),
(19, 'Морква', 3, 'W63UECM8', 8.5, 1, 1, 'W63UECM8.jpg', 1, 'кг'),
(20, 'Картопля молода', 3, 'S58XTLUA', 30, 1, 1, 'S58XTLUA.jpg', 1, 'кг'),
(21, 'Печериці', 4, 'KK8QD4ZT', 55, 1, 1, 'KK8QD4ZT.jpg', 1, 'кг'),
(22, 'Печериці королівські', 4, 'MYP7R3X5', 60, 1, 1, 'MYP7R3X5.jpg', 1, 'кг'),
(23, 'Глива', 4, 'VVJUGH2H', 50, 1, 1, 'VVJUGH2H.jpg', 1, 'кг'),
(24, 'Петрушка', 5, 'KGE87PYH', 16, 1, 1, 'KGE87PYH.jpg', 100, 'г'),
(25, 'Цибуля зелена', 5, 'AC24B4UU', 20, 1, 1, 'AC24B4UU.jpg', 100, 'г'),
(26, 'Салат Пучок', 5, 'PC2U9ZXH', 40, 1, 1, 'PC2U9ZXH.jpg', 170, 'г'),
(27, 'Авокадо', 2, '62MM8SXW', 18, 1, 1, '62MM8SXW.jpg', 150, 'г'),
(28, 'Грейпфрут Туреччина', 2, 'LJXMECFC', 40, 1, 1, 'LJXMECFC.jpg', 1, 'кг'),
(29, 'Ківі', 2, 'E28ZCSV2', 75, 1, 1, 'E28ZCSV2.jpg', 1, 'кг'),
(30, 'Редис червоний', 3, 'U6Y5BMDK', 40, 1, 1, 'U6Y5BMDK.jpg', 1, 'кг'),
(31, 'Буряк', 3, 'PZ3RHSAJ', 5.5, 1, 1, 'PZ3RHSAJ.jpg', 1, 'кг'),
(32, 'Томат Сливка', 3, '2TTB688C', 40, 1, 1, '2TTB688C.jpg', 1, 'кг'),
(36, 'Щавель', 5, '06bbe071', 20, 1, 1, '06bbe071.jpg', 100, 'г');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `REQUEST_TIME_FLOAT` varchar(255) NOT NULL,
  `REMOTE_ADDR` varchar(255) DEFAULT NULL,
  `REQUEST_METHOD` varchar(255) DEFAULT NULL,
  `REQUEST_URI` varchar(255) DEFAULT NULL,
  `HTTP_USER_AGENT` varchar(255) DEFAULT NULL,
  `HTTP_ACCEPT_LANGUAGE` varchar(255) DEFAULT NULL,
  `PHPSESSID` varchar(255) DEFAULT NULL,
  `USER_ID` int(11) DEFAULT NULL,
  `BAG` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`REQUEST_TIME_FLOAT`, `REMOTE_ADDR`, `REQUEST_METHOD`, `REQUEST_URI`, `HTTP_USER_AGENT`, `HTTP_ACCEPT_LANGUAGE`, `PHPSESSID`, `USER_ID`, `BAG`) VALUES
('1590841932.1469', '192.168.1.101', 'GET', '/category/2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":1}'),
('1590841932.8247', '192.168.1.101', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":1}'),
('1590841932.8695', '192.168.1.101', 'GET', '/bag/data', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":1}'),
('1590841937.0737', '192.168.1.101', 'GET', '/category/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":1}'),
('1590841937.9361', '192.168.1.101', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":1}'),
('1590841937.9938', '192.168.1.101', 'GET', '/bag/data', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":1}'),
('1590841987.693', '192.168.1.100', 'GET', '/signout', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', 1, 'null'),
('1590842370.9519', '192.168.1.100', 'GET', '/category/2', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', 0, ''),
('1590842371.6078', '192.168.1.100', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', 0, ''),
('1590842371.66', '192.168.1.100', 'GET', '/bag/data', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', 0, ''),
('1590842500.1487', '192.168.1.103', 'GET', '/', 'Mozilla/5.0 (Linux; Android 4.1.2; IQ444 Quattro Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.111 Mobile Safari/537.36', 'en-US,en;q=0.8', '5adt4kmpdk5r5slk4h09i5i2sb', 0, ''),
('1590842500.2132', '192.168.1.103', 'GET', '/category/1', 'Mozilla/5.0 (Linux; Android 4.1.2; IQ444 Quattro Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.111 Mobile Safari/537.36', 'en-US,en;q=0.8', '5adt4kmpdk5r5slk4h09i5i2sb', 0, ''),
('1590842650.3993', '192.168.1.102', 'GET', '/', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', NULL, 0, ''),
('1590842650.5031', '192.168.1.102', 'GET', '/category/1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', '014mqvmjt01m4spl5k32oa0vks', 0, ''),
('1590842651.2046', '192.168.1.102', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', '014mqvmjt01m4spl5k32oa0vks', 0, ''),
('1590842651.2412', '192.168.1.102', 'GET', '/bag/data', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', '014mqvmjt01m4spl5k32oa0vks', 0, ''),
('1590842667.1088', '192.168.1.102', 'GET', '/signin', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', '014mqvmjt01m4spl5k32oa0vks', 0, ''),
('1590842667.417', '192.168.1.102', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', '014mqvmjt01m4spl5k32oa0vks', 0, ''),
('1590842667.4571', '192.168.1.102', 'GET', '/bag/data', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', '014mqvmjt01m4spl5k32oa0vks', 0, ''),
('1590844175.9842', '192.168.1.101', 'POST', '/bag/add-ajax/30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 0, ''),
('1590844238.7841', '192.168.1.101', 'GET', '/bag', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 0, ''),
('1590844239.454', '192.168.1.101', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 0, ''),
('1590844239.4971', '192.168.1.101', 'GET', '/bag/data', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 0, ''),
('1590844496.3852', '192.168.1.101', 'GET', '/category/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590844497.4411', '192.168.1.101', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590844497.5136', '192.168.1.101', 'GET', '/bag/data', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590844616.6058', '192.168.1.100', 'GET', '/category/3', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', NULL, ''),
('1590844617.6719', '192.168.1.100', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', NULL, ''),
('1590844617.7174', '192.168.1.100', 'GET', '/bag/data', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', NULL, ''),
('1590844717.4726', '192.168.1.100', 'GET', '/signin', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', NULL, ''),
('1590844717.8934', '192.168.1.100', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', NULL, ''),
('1590844717.9242', '192.168.1.100', 'GET', '/bag/data', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', NULL, ''),
('1590844761.3428', '192.168.1.100', 'POST', '/signin', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', NULL, ''),
('1590844761.4199', '192.168.1.100', 'GET', '/cabinet/history', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', 9, ''),
('1590844761.9417', '192.168.1.100', 'GET', '/bag/index-ajax', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', 9, ''),
('1590844761.9836', '192.168.1.100', 'GET', '/bag/data', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1.2 Mobile/15E148 Safari/604.1', 'en-us', '84ne7iabrgi6k2pktg49psl7jp', 9, ''),
('1590846137.5595', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846139.2596', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846143.3594', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846147.7084', '192.168.1.101', 'GET', '/admin/user/view/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846149.8275', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846151.1866', '192.168.1.101', 'GET', '/admin/user/view/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846210.1323', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846218.442', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590846221.1953', '192.168.1.101', 'GET', '/admin/user/view/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590851100.2995', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590851791.3334', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590851796.3039', '192.168.1.101', 'GET', '/admin/order/view/32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590851799.8305', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590851801.7757', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590851841.1768', '192.168.1.101', 'GET', '/admin/user/view/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852003.3272', '192.168.1.101', 'GET', '/admin/user/view/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852112.6595', '192.168.1.101', 'GET', '/admin/user/view/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852322.7465', '192.168.1.101', 'GET', '/admin/user/view/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852326.2204', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852370.4766', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852491.9819', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852729.8302', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852731.8356', '192.168.1.101', 'GET', '/admin/category', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852733.5609', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852735.3506', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852737.6673', '192.168.1.101', 'GET', '/admin/user/view/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852740.2511', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852741.5634', '192.168.1.101', 'GET', '/admin/user/view/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852746.3637', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852749.0708', '192.168.1.101', 'GET', '/admin/category', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852752.5697', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852781.3685', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852794.0054', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852960.4389', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852965.5086', '192.168.1.101', 'GET', '/admin/category', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852967.4034', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852971.6379', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590852977.5657', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853040.8623', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853052.6748', '192.168.1.101', 'GET', '/admin/product/update/27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853060.1593', '192.168.1.101', 'POST', '/admin/product/update/27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853060.3426', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853065.5296', '192.168.1.101', 'GET', '/admin/product/update/26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853070.3627', '192.168.1.101', 'POST', '/admin/product/update/26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853070.4964', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853074.9154', '192.168.1.101', 'GET', '/admin/product/update/25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853080.9872', '192.168.1.101', 'POST', '/admin/product/update/25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853081.1059', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853085.6045', '192.168.1.101', 'GET', '/admin/product/update/24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853091.6201', '192.168.1.101', 'POST', '/admin/product/update/24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853091.7856', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853097.8889', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853154.6225', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853170.734', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853373.3323', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853385.5921', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853495.5312', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853510.9779', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853512.5234', '192.168.1.101', 'GET', '/admin/category', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853513.7873', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853514.8122', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853516.6737', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853626.5583', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853642.6186', '192.168.1.101', 'GET', '/admin/category', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853710.0968', '192.168.1.101', 'GET', '/admin/category', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853724.6172', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853775.1106', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853778.5318', '192.168.1.101', 'GET', '/admin/user', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853886.7433', '192.168.1.101', 'GET', '/admin', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853901.0166', '192.168.1.101', 'GET', '/admin/product', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853905.6256', '192.168.1.101', 'GET', '/admin/category', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853929.5166', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853941.469', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}'),
('1590853952.4302', '192.168.1.101', 'GET', '/admin/order', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', 'en-US,en;q=0.9,fr;q=0.8,ru-RU;q=0.7,ru;q=0.6,uk;q=0.5', 'o6n72nma30jkg8rved85du5a30', 8, '{\"28\":1,\"29\":1,\"30\":2}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT '0',
  `secret` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `phone`, `address`, `discount`, `secret`, `role`) VALUES
(1, 'vberkoz1@gmail.com', 'vberkoz', NULL, NULL, 0, '123456', 'client'),
(8, 'vberkoz@gmail.com', 'Микола', '1234567899', '1-й провулок Герцена, 13', 0, '123456', 'admin'),
(9, 'vberkoz2@gmail.com', 'Гріша', '0668132356', 'Kutuzova st. 4/90', 30, '654654', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_id_uindex` (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id_uindex` (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`REQUEST_TIME_FLOAT`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_uindex` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
