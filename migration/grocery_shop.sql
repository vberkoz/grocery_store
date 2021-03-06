-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 11:12 AM
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
(5, 'Зелень', 5, 1),
(6, 'Сухофрукти', 6, 1),
(7, 'Горіхи', 7, 1),
(8, 'Бакалія', 8, 1),
(11, 'Інше', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `currency` float NOT NULL DEFAULT '0',
  `percent` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `user_id`, `product_id`, `currency`, `percent`) VALUES
(20, 9, 214, 2, 1),
(24, 9, 213, 1, 1),
(27, 18, 212, 3, 10),
(28, 18, 213, 0, 10),
(29, 10, 214, 0, 0),
(30, 10, 213, 20, 0),
(31, 10, 209, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `product_id`) VALUES
(1, 8, 15),
(2, 8, 16),
(3, 8, 36),
(5, 8, 25),
(6, 8, 23),
(7, 8, 173),
(9, 18, 194),
(12, 18, 211),
(13, 18, 101);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quantity` float NOT NULL,
  `discount_client` float NOT NULL DEFAULT '0',
  `discount_restaurant` float NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `order_id`, `product_id`, `title`, `quantity`, `discount_client`, `discount_restaurant`, `price`, `unit`) VALUES
(13, 98, 209, 'Шпинат', 1, 5, 0, 45, 'кг'),
(14, 98, 213, 'Ягоди Годжі', 1, 20, 0, 315, 'кг'),
(15, 99, 214, 'Ядро соняшника', 1.6, 0, 0, 28, 'кг'),
(16, 99, 212, 'Яблуко червоне', 1, 3, 10, 33, 'кг'),
(17, 99, 208, 'Чорнослив', 1, 0, 0, 45, 'кг'),
(27, 102, 213, 'Ягоди Годжі', 2, 0, 10, 315, 'кг'),
(28, 102, 212, 'Яблуко червоне', 1.3, 3, 10, 33, 'кг'),
(29, 102, 25, 'Зелена цибуля (перо)', 5, 0, 0, 40, 'шт'),
(30, 103, 209, 'Шпинат', 2.7, 0, 0, 45, 'кг'),
(31, 103, 208, 'Чорнослив', 1.4, 0, 0, 45, 'кг'),
(32, 103, 207, 'Сочевиця Шліфована', 1.1, 0, 0, 23, 'кг'),
(33, 104, 213, 'Ягоди Годжі', 1, 0, 10, 315, 'кг'),
(67, 131, 213, 'Ягоди Годжі', 2, 0, 10, 315, 'кг'),
(68, 131, 212, 'Яблуко червоне', 1.3, 3, 10, 33, 'кг'),
(69, 131, 25, 'Зелена цибуля (перо)', 5, 0, 0, 40, 'шт'),
(70, 132, 213, 'Ягоди Годжі', 2, 0, 10, 315, 'кг'),
(71, 132, 212, 'Яблуко червоне', 1.3, 3, 10, 33, 'кг'),
(72, 132, 25, 'Зелена цибуля (перо)', 5, 0, 0, 40, 'шт');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_comment` text,
  `bag` text,
  `discount` float DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `user_name`, `user_phone`, `user_address`, `user_comment`, `bag`, `discount`, `created_at`) VALUES
(98, 'f2e9e50dad88', 10, 'Олександр', '0956543211', '', '', '{\"209\":\"1\",\"213\":\"1\"}', 25, '2020-07-12 12:33:10'),
(99, '996e248a6046', 18, 'Basil Sergius', '1234567899', 'Комарова 6/2', '', '{\"214\":\"1\",\"212\":\"1\",\"208\":\"1\"}', 6.3, '2020-07-24 11:28:57'),
(102, '3acc7f658ba9', 18, 'Basil Sergius', '0668132356', 'Комарова 6/2', '', '{\"213\":\"1\",\"212\":\"1\",\"25\":\"2\"}', 37.8, '2020-07-27 19:28:22'),
(103, 'f88de97a311b', 18, 'Basil Sergius', '0668132356', 'Комарова 6/2', '', '{\"209\":\"1\",\"208\":\"1\",\"207\":\"1\"}', 0, '2020-07-27 20:34:06'),
(104, '3f49067ed742', 18, 'Basil Sergius', '0668132356', 'Комарова 6/2', '', '{\"213\":\"1\"}', 31.5, '2020-07-30 15:34:45'),
(131, 'de9b2f65a2d6', 18, 'Basil Sergius', '0668132356', 'Комарова 6/2', '', '', 0, '2020-08-05 21:05:06'),
(132, '3bd863c59ba9', 18, 'Basil Sergius', '0668132356', 'Комарова 6/2', '', '', 0, '2020-08-06 02:01:10');

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
  `volume` float DEFAULT '0.1',
  `volume_min` float DEFAULT '0.1',
  `unit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category_id`, `product_id`, `price`, `availability`, `visibility`, `image`, `volume`, `volume_min`, `unit`) VALUES
(15, 'Банан', 2, 'BBCRLBQH', 34.21, 1, 1, 'BBCRLBQH.jpg', 1, 0.1, 'кг'),
(16, 'Яблуко Голден', 2, 'R37PKGP2', 33, 1, 1, 'R37PKGP2.jpg', 1, 0.1, 'кг'),
(18, 'Огірок корнішон', 3, '2DDUBV24', 40, 1, 0, '2DDUBV24.jpg', 1, 0.1, 'кг'),
(19, 'Морква', 3, 'W63UECM8', 8.5, 1, 0, 'W63UECM8.jpg', 1, 0.1, 'кг'),
(20, 'Картопля молода', 3, 'S58XTLUA', 30, 1, 0, 'S58XTLUA.jpg', 1, 0.1, 'кг'),
(21, 'Гриб Шампіньйон', 11, 'KK8QD4ZT', 55, 1, 1, 'KK8QD4ZT.jpg', 1, 0.1, 'кг'),
(24, 'Петрушка вагова', 5, 'KGE87PYH', 55, 1, 1, 'KGE87PYH.jpg', 1, 0.1, 'кг'),
(25, 'Зелена цибуля (перо)', 5, 'AC24B4UU', 40, 1, 1, 'AC24B4UU.jpg', 1, 1, 'шт'),
(26, 'Салат Пучок', 5, 'PC2U9ZXH', 40, 1, 0, 'PC2U9ZXH.jpg', 1, 1, 'шт'),
(27, 'Авокадо', 2, '62MM8SXW', 18, 1, 0, '62MM8SXW.jpg', 1, 1, 'шт'),
(28, 'Грейпфрут Туреччина', 2, 'LJXMECFC', 40, 1, 0, 'LJXMECFC.jpg', 1, 0.1, 'кг'),
(30, 'Редис червоний', 3, 'U6Y5BMDK', 40, 1, 0, 'U6Y5BMDK.jpg', 1, 0.1, 'кг'),
(32, 'Томат Сливка', 3, '2TTB688C', 40, 1, 0, '2TTB688C.jpg', 1, 0.1, 'кг'),
(36, 'Щавель', 5, '06bbe071', 65, 1, 1, '06bbe071.jpg', 1, 0.1, 'кг'),
(37, 'Банан в\'ялений', 6, '5312f233', 22, 1, 1, '5312f233.jpg', 1, 0.2, 'кг'),
(38, 'Суміш горіхів з фруктами', 7, '0a579037', 217, 1, 1, '0a579037.jpg', 1, 0.1, 'кг'),
(39, 'Абрикос', 2, 'b1d7b535', 55, 1, 1, 'b1d7b535.jpg', 1, 0.1, 'кг'),
(40, 'Авокадо', 2, '00c5d5d5', 22, 1, 1, '00c5d5d5.jpg', 1, 1, 'шт'),
(41, 'Авокадо Хаас', 2, 'acc8be7b', 37, 1, 1, 'acc8be7b.jpg', 1, 1, 'шт'),
(42, 'Айва', 2, '7be4e45e', 1, 0, 0, '7be4e45e.jpg', 1, 0.1, 'кг'),
(43, 'Амарант', 8, 'd2123081', 1, 0, 0, 'd2123081.jpg', 1, 0.1, 'кг'),
(44, 'Ананас калібр 10', 2, '681aaa9b', 40, 1, 1, '681aaa9b.jpg', 1.5, 0.1, 'кг'),
(45, 'Ананас калібр 6', 2, 'c59021da', 85, 1, 1, 'c59021da.jpg', 1, 0.1, 'кг'),
(46, 'Ананас кільце', 6, 'b912ce1d', 171, 1, 1, 'b912ce1d.jpg', 1, 0.1, 'кг'),
(47, 'Ананас Королівський', 2, 'a89aa689', 110, 1, 1, 'a89aa689.jpg', 1.8, 0.1, 'кг'),
(48, 'Апельсин', 2, '5df93b4f', 33, 1, 1, '5df93b4f.jpg', 1, 0.1, 'кг'),
(49, 'Апельсин гранатовий', 2, '4fc4deff', 1, 0, 0, '4fc4deff.jpg', 1, 0.1, 'кг'),
(50, 'Апельсин Іспанія', 2, '3ad7e9fe', 52, 1, 1, '3ad7e9fe.jpg', 1, 0.1, 'кг'),
(51, 'Апельсин Сицилія', 2, '4e05ecef', 1, 0, 0, '4e05ecef.jpg', 1, 0.1, 'кг'),
(52, 'Апельсин сітка', 2, '5ae8297f', 1, 0, 0, '5ae8297f.jpg', 1, 0.1, 'кг'),
(53, 'Арахіс Бланш', 7, '73e240ce', 75, 1, 1, '73e240ce.jpg', 1, 0.1, 'кг'),
(54, 'Арахіс в глазурі', 7, 'cbc3009a', 128, 1, 1, 'cbc3009a.jpg', 1, 0.1, 'кг'),
(55, 'Арахіс в шкаралупі', 7, '5137f451', 80, 1, 1, '5137f451.jpg', 1, 0.1, 'кг'),
(56, 'Арахіс сирий Ява', 7, '130ed591', 60, 1, 1, '130ed591.jpg', 1, 0.1, 'кг'),
(57, 'Арахіс смажений Ява', 7, '81b4294c', 66, 1, 1, '81b4294c.jpg', 1, 0.1, 'кг'),
(58, 'Арахіс солений', 7, '6d1cd31b', 168, 1, 1, '6d1cd31b.jpg', 1, 0.1, 'кг'),
(59, 'Асорті Горіхове', 7, 'feeefcfb', 185, 1, 1, 'feeefcfb.jpg', 1, 0.1, 'кг'),
(60, 'Бадьян', 11, '2e2d89c0', 380, 1, 1, '2e2d89c0.jpg', 1, 0.1, 'кг'),
(61, 'Базилік', 11, 'c33c64f3', 25, 1, 1, 'c33c64f3.jpg', 1, 0.1, 'кг'),
(62, 'Баклажан імпорт', 3, '951156e5', 70, 1, 1, '951156e5.jpg', 1, 0.1, 'кг'),
(63, 'Бананові чіпси', 6, 'd0cea7d1', 121, 1, 1, 'd0cea7d1.jpg', 1, 0.1, 'кг'),
(64, 'Батат', 3, 'fdff930b', 95, 1, 1, 'fdff930b.jpg', 1, 0.1, 'кг'),
(65, 'Борошно', 8, '277418fa', 8.4, 1, 1, '277418fa.jpg', 1, 0.1, 'кг'),
(66, 'Буряк молодий', 3, '80f9240c', 12, 1, 1, '80f9240c.jpg', 1, 0.1, 'кг'),
(67, 'Буряк старий', 3, 'c31b59c4', 6, 1, 1, 'c31b59c4.jpg', 1, 0.1, 'кг'),
(68, 'Виноград білий', 2, 'b4d1e94e', 82, 1, 1, 'b4d1e94e.jpg', 1, 0.1, 'кг'),
(69, 'Виноград Киш-Миш', 2, 'b89de029', 1, 0, 0, 'b89de029.jpg', 1, 0.1, 'кг'),
(70, 'Виноград Рожевий', 2, '3ff87e11', 82, 1, 1, '3ff87e11.jpg', 1, 0.1, 'кг'),
(71, 'Виноград Темний', 2, 'd75d06fe', 1, 0, 0, 'd75d06fe.jpg', 1, 0.1, 'кг'),
(72, 'Вишня вялена', 6, 'ad74bac0', 165, 1, 1, 'ad74bac0.jpg', 1, 0.1, 'кг'),
(73, 'Лохина', 2, 'd1585c95', 320, 1, 1, 'd1585c95.jpg', 1, 0.1, 'кг'),
(74, 'Горіх Кедровий', 7, 'b3810df2', 550, 1, 1, 'b3810df2.jpg', 1, 0.1, 'кг'),
(75, 'Гранат', 2, '6dcfedcf', 110, 1, 1, '6dcfedcf.jpg', 1, 0.1, 'кг'),
(76, 'Грейпфрут', 2, 'b148899b', 30, 1, 1, 'b148899b.jpg', 1, 0.1, 'кг'),
(77, 'Грецький горіх', 7, '989e9043', 155, 1, 1, '989e9043.jpg', 1, 0.1, 'кг'),
(78, 'Груша', 2, '2316672c', 50, 1, 1, '2316672c.jpg', 1, 0.1, 'кг'),
(79, 'Дайкон', 3, '122c4e56', 1, 0, 0, '122c4e56.jpg', 1, 0.1, 'кг'),
(80, 'Диня', 2, '35dc74cf', 60, 1, 1, '35dc74cf.jpg', 1, 0.1, 'кг'),
(81, 'Диня сушена', 6, 'af80484d', 189, 1, 1, 'af80484d.jpg', 1, 0.1, 'кг'),
(82, 'Журавлина', 2, 'f1b90a05', 1, 0, 0, 'f1b90a05.jpg', 1, 0.1, 'кг'),
(83, 'Ізюм золотий', 6, '28ca9e58', 80, 1, 1, '28ca9e58.jpg', 1, 0.1, 'кг'),
(84, 'Ізюм синій', 6, '3714a657', 87, 1, 1, '3714a657.jpg', 1, 0.1, 'кг'),
(85, 'Ізюм темний', 6, 'ea907e88', 63, 1, 1, 'ea907e88.jpg', 1, 0.1, 'кг'),
(86, 'Імбир', 11, '1f816f68', 95, 1, 1, '1f816f68.jpg', 1, 0.1, 'кг'),
(87, 'Імбірь Цукат', 6, 'aebf1016', 165, 1, 1, 'aebf1016.jpg', 1, 0.1, 'кг'),
(88, 'Інжир', 2, '4bb17469', 28, 1, 1, '4bb17469.jpg', 1, 0.2, 'кг'),
(89, 'Інжир сушений', 6, '5f3d9a0a', 124, 1, 1, '5f3d9a0a.jpg', 1, 0.1, 'кг'),
(90, 'Кабачок', 3, 'a9f2a57d', 26, 1, 1, 'a9f2a57d.jpg', 1, 0.1, 'кг'),
(91, 'Кавун', 2, 'b3369e98', 35, 1, 1, 'b3369e98.jpg', 1, 0.1, 'кг'),
(92, 'Капуста імпорт', 3, 'e284a30c', 1, 0, 0, 'e284a30c.jpg', 1, 0.1, 'кг'),
(93, 'Капуста Білокачанна', 3, '1051fff5', 5.5, 1, 1, '1051fff5.jpg', 1, 0.1, 'кг'),
(94, 'Капуста Брокколі', 3, 'ce641912', 65, 1, 1, 'ce641912.jpg', 1, 0.1, 'кг'),
(95, 'Капуста квашена', 3, 'c90916b9', 1, 0, 0, 'c90916b9.jpg', 1, 0.1, 'кг'),
(96, 'Капуста Молода', 3, '2a51a607', 6, 1, 1, '2a51a607.jpg', 1, 0.1, 'кг'),
(97, 'Капуста Пекінська', 3, 'f53f11ed', 15, 1, 1, 'f53f11ed.jpg', 1, 0.1, 'кг'),
(98, 'Капуста Синя', 3, 'd3e30534', 1, 0, 0, 'd3e30534.jpg', 1, 0.1, 'кг'),
(99, 'Капуста Цвітна', 3, '5c58cc44', 35, 1, 1, '5c58cc44.jpg', 1, 0.1, 'кг'),
(100, 'Картопля', 3, '89b39669', 10.5, 1, 1, 'S58XTLUA.jpg', 1, 0.1, 'кг'),
(101, 'Картопля молода', 3, 'a7b73551', 14, 1, 1, 'a7b73551.jpg', 1, 0.1, 'кг'),
(102, 'Квасоля', 8, '8c1ef2e4', 30, 1, 1, '8c1ef2e4.jpg', 1, 0.1, 'кг'),
(103, 'Кеш\'ю', 7, '55cf6007', 292, 1, 1, '55cf6007.jpg', 1, 0.1, 'кг'),
(104, 'Ківі', 2, '8dd867a1', 174, 1, 1, '8dd867a1.jpg', 1, 0.1, 'кг'),
(105, 'Ківі цукат', 6, 'b8753072', 152, 1, 1, 'b8753072.jpg', 1, 0.1, 'кг'),
(106, 'Кінза', 5, '29f34e72', 1, 0, 0, '29f34e72.jpg', 1, 1, 'кг'),
(107, 'Козинакі', 11, 'ecb47cd0', 78, 1, 1, 'ecb47cd0.jpg', 1, 0.1, 'кг'),
(108, 'Кокос', 2, '6348662d', 23, 1, 1, '6348662d.jpg', 1, 0.1, 'кг'),
(109, 'Кокосова стружка', 8, '4a642424', 72, 1, 1, '4a642424.jpg', 1, 0.1, 'кг'),
(110, 'Корицева паличка', 11, 'f61719dc', 283, 1, 1, 'f61719dc.jpg', 1, 0.1, 'кг'),
(111, 'Корінь Селери', 3, '7550a5a0', 20, 1, 1, '7550a5a0.jpg', 1, 0.1, 'кг'),
(112, 'Корольок', 2, '0f098d5d', 1, 0, 0, '0f098d5d.jpg', 1, 0.1, 'кг'),
(113, 'Корольок Іспанія', 2, '03f5a0f4', 1, 0, 0, '03f5a0f4.jpg', 1, 0.1, 'кг'),
(114, 'Кріп ваговий', 5, '44a6c1e3', 75, 1, 1, '44a6c1e3.jpg', 1, 0.1, 'кг'),
(115, 'Кріп пучок', 5, '75bf86ca', 4.5, 1, 1, '75bf86ca.jpg', 1, 1, 'шт'),
(116, 'Кукуруза зі смаком', 11, '4128a283', 104, 1, 1, '4128a283.jpg', 1, 0.1, 'кг'),
(117, 'Кумкват', 2, 'ab3d4ce1', 260, 1, 1, 'ab3d4ce1.jpg', 1, 0.1, 'кг'),
(118, 'Кунжут', 8, 'af867ae2', 87, 1, 1, 'af867ae2.jpg', 1, 0.1, 'кг'),
(119, 'Курага 1 сорт', 6, '95b2deb9', 73, 1, 1, '95b2deb9.jpg', 1, 0.1, 'кг'),
(120, 'Курага джамбо', 6, '04943868', 132, 1, 1, '04943868.jpg', 1, 0.1, 'кг'),
(121, 'Курага сердечко', 6, '2438a727', 36, 1, 1, '2438a727.jpg', 1, 0.1, 'кг'),
(122, 'Лайм', 2, '1a12a211', 110, 1, 1, '1a12a211.jpg', 1, 0.1, 'кг'),
(123, 'Лимон', 2, 'c92ab684', 48, 1, 1, 'c92ab684.jpg', 1, 0.1, 'кг'),
(124, 'Мак', 8, 'ccfcd4a4', 116, 1, 1, 'ccfcd4a4.jpg', 1, 0.1, 'кг'),
(125, 'Малина', 2, '34290083', 560, 1, 1, '34290083.jpg', 1, 0.1, 'кг'),
(126, 'Манго', 2, '60fb2bde', 47, 1, 1, '60fb2bde.jpg', 1, 0.1, 'кг'),
(127, 'Манго королівське', 2, '4b0435ae', 160, 1, 1, '4b0435ae.jpg', 1, 0.1, 'кг'),
(128, 'Манго Цукат', 6, 'e8df93d1', 167, 1, 1, 'e8df93d1.jpg', 1, 0.1, 'кг'),
(129, 'Мангольд', 5, '86c4f834', 110, 1, 1, '86c4f834.jpg', 1, 0.1, 'кг'),
(130, 'Мандарин еліт', 2, 'cd9c493c', 62, 1, 1, 'cd9c493c.jpg', 1, 0.1, 'кг'),
(131, 'Мандарин Іспанія', 2, 'b13d17de', 1, 0, 0, 'b13d17de.jpg', 1, 0.1, 'кг'),
(132, 'Мандарин Італія', 2, '14c43103', 1, 0, 0, '14c43103.jpg', 1, 0.1, 'кг'),
(133, 'Мандарин Турція', 2, 'e758b62f', 1, 0, 0, 'e758b62f.jpg', 1, 0.1, 'кг'),
(134, 'Мигдаль золотий', 7, 'f6c5a6df', 1, 0, 0, 'f6c5a6df.jpg', 1, 0.1, 'кг'),
(135, 'Мікрогрін Горох', 5, '56298bfa', 70, 1, 1, '56298bfa.jpg', 1, 1, 'шт'),
(136, 'Мікрогрін Люцерна', 5, '589c23d5', 50, 1, 1, '589c23d5.jpg', 1, 1, 'шт'),
(137, 'Мікрогрін Гарбуз', 5, '5b05ebc4', 70, 1, 1, '5b05ebc4.jpg', 1, 1, 'шт'),
(138, 'Мікрогрін Редис', 5, 'ad89d238', 70, 1, 1, 'ad89d238.jpg', 1, 1, 'шт'),
(139, 'Мікрогрін Цибуля', 5, '41a8dd80', 110, 1, 1, '41a8dd80.jpg', 1, 1, 'шт'),
(140, 'Морква Абако', 3, '1d9cd195', 8.5, 1, 1, '1d9cd195.jpg', 1, 0.1, 'кг'),
(141, 'Мята', 5, '1f456de9', 80, 1, 1, '1f456de9.jpg', 1, 0.1, 'кг'),
(142, 'Насіння гарбуза', 8, '75c131ee', 142, 1, 1, '75c131ee.jpg', 1, 0.1, 'кг'),
(143, 'Насіння Чіа', 8, 'e7253431', 105, 1, 1, 'e7253431.jpg', 1, 0.1, 'кг'),
(144, 'Горох Нут', 8, 'ed9e0096', 35, 1, 1, 'ed9e0096.jpg', 1, 0.1, 'кг'),
(145, 'Огірок гладкий', 3, '17979b0d', 1, 0, 0, '17979b0d.jpg', 1, 0.1, 'кг'),
(146, 'Огірок квашений', 8, '5ca6aea0', 1, 0, 0, '5ca6aea0.jpg', 1, 0.1, 'кг'),
(147, 'Огірок колючий', 3, 'cc2d8d39', 26, 1, 1, 'cc2d8d39.jpg', 1, 0.1, 'кг'),
(148, 'Помело', 2, '56cb9d04', 1, 0, 0, '56cb9d04.jpg', 1, 0.1, 'кг'),
(149, 'Папайя', 2, 'baaebbf6', 200, 1, 1, 'baaebbf6.jpg', 1, 0.1, 'кг'),
(150, 'Паприка мелена', 11, '97eeb83d', 1, 0, 0, '97eeb83d.jpg', 1, 0.1, 'кг'),
(151, 'Пахлава', 11, '2ba901e5', 130, 1, 1, '2ba901e5.jpg', 1, 0.1, 'кг'),
(152, 'Перець Білозірка', 3, 'e713ab96', 1, 0, 0, 'e713ab96.jpg', 1, 0.1, 'кг'),
(153, 'Перець Болгарський', 3, '8dfdf4bc', 75, 1, 1, '8dfdf4bc.jpg', 1, 0.1, 'кг'),
(154, 'Перець Болгарський Жовтий', 3, 'de9d82b4', 75, 1, 1, 'de9d82b4.jpg', 1, 0.1, 'кг'),
(155, 'Перець Каппі', 3, '7ac12ce8', 1, 0, 0, '7ac12ce8.jpg', 1, 0.1, 'кг'),
(156, 'Перець Чилі', 3, '169b9ad7', 130, 1, 1, '169b9ad7.jpg', 1, 0.1, 'кг'),
(157, 'Персик', 2, '2c970115', 70, 1, 1, '2c970115.jpg', 1, 0.1, 'кг'),
(158, 'Петрушка кучерява', 5, '2c6fd03f', 60, 1, 1, '2c6fd03f.jpg', 1, 0.1, 'кг'),
(159, 'Петрушка', 5, '98f22372', 4.5, 1, 1, '98f22372.jpg', 1, 1, 'шт'),
(160, 'Пітахайя біла', 2, '1f29d052', 110, 1, 1, '1f29d052.jpg', 1, 0.1, 'кг'),
(161, 'Пітахайя червона', 2, 'f2720ea3', 140, 1, 1, 'f2720ea3.jpg', 1, 0.1, 'кг'),
(162, 'Полуниця', 2, '5d0088c2', 70, 1, 1, '5d0088c2.jpg', 1, 0.1, 'кг'),
(163, 'Томат', 3, '136a2f0b', 70, 1, 1, '136a2f0b.jpg', 1, 0.1, 'кг'),
(164, 'Томат коктейльный', 3, 'ea228605', 143, 1, 1, 'ea228605.jpg', 1, 0.1, 'кг'),
(165, 'Томат рожевий', 3, '6e4686f4', 40, 1, 1, '6e4686f4.jpg', 1, 0.1, 'кг'),
(166, 'Томат чері', 3, '5dfeed1d', 72, 1, 1, '5dfeed1d.jpg', 1, 0.1, 'кг'),
(167, 'Порей', 3, 'f268a059', 1, 0, 0, 'f268a059.jpg', 1, 0.1, 'кг'),
(168, 'Смородина червона', 2, 'fd05c235', 650, 1, 1, 'fd05c235.jpg', 1, 0.1, 'кг'),
(169, 'Салат Радічіо', 3, 'f16cb967', 110, 1, 1, 'f16cb967.jpg', 1, 0.1, 'кг'),
(170, 'Редиска', 3, '66cc6fd6', 25, 1, 1, '66cc6fd6.jpg', 1, 0.1, 'кг'),
(171, 'Розмарин', 5, 'd8d5e529', 190, 1, 1, 'd8d5e529.jpg', 1, 0.1, 'кг'),
(172, 'Рукола', 5, 'a01b6c41', 90, 1, 1, 'a01b6c41.jpg', 1, 0.1, 'кг'),
(173, 'Рукола пучок', 5, 'bcd4d0c3', 29, 1, 1, 'bcd4d0c3.jpg', 1, 1, 'шт'),
(174, 'Салат Айсберг', 3, '1ddd9780', 132, 1, 1, '1ddd9780.jpg', 1, 0.1, 'кг'),
(175, 'Салат Біонда', 3, '94bb6c6d', 35, 1, 1, '94bb6c6d.jpg', 1, 0.1, 'кг'),
(176, 'Салат Мікс', 3, '46e3a288', 30, 1, 1, '46e3a288.jpg', 1, 0.1, 'кг'),
(177, 'Салат Ромен', 3, '119de140', 980, 1, 1, '119de140.jpg', 1, 0.1, 'кг'),
(178, 'Салат Россо', 3, 'cc628b77', 25, 1, 1, 'cc628b77.jpg', 1, 0.1, 'кг'),
(179, 'Світі', 2, '0e97af87', 1, 0, 0, '0e97af87.jpg', 1, 0.1, 'кг'),
(180, 'Стебло Селери', 5, 'a133e773', 1, 0, 0, 'a133e773.jpg', 1, 0.1, 'кг'),
(181, 'Суміш сухофруктів', 6, 'c948d774', 190, 1, 1, 'c948d774.jpg', 1, 0.1, 'кг'),
(182, 'Сушка', 6, '5af4523f', 28, 1, 1, '5af4523f.jpg', 1, 0.1, 'кг'),
(183, 'Сушка узбецька', 6, 'ee2c7c2d', 35, 1, 1, 'ee2c7c2d.jpg', 1, 0.1, 'кг'),
(184, 'Гарбуз', 3, '82082666', 1, 0, 0, '82082666.jpg', 1, 0.1, 'кг'),
(185, 'Кмин', 11, '5e1d6e5b', 190, 1, 1, '5e1d6e5b.jpg', 1, 0.1, 'кг'),
(186, 'Урюк сушений', 6, 'b1c45393', 116, 1, 1, 'b1c45393.jpg', 1, 0.1, 'кг'),
(187, 'Фінік', 6, '2ac07d67', 78, 1, 1, '2ac07d67.jpg', 1, 0.1, 'кг'),
(188, 'Фінік медовий', 6, 'fc359e9c', 82, 1, 1, 'fc359e9c.jpg', 1, 0.1, 'кг'),
(189, 'Фінік медовий', 6, 'ab567238', 1, 0, 0, 'ab567238.jpg', 1, 1, 'шт'),
(190, 'Фісташки', 7, '0fa5f7ec', 420, 1, 1, '0fa5f7ec.jpg', 1, 0.1, 'кг'),
(191, 'Салат Фрізе', 3, '34b2bbf5', 30, 1, 1, '34b2bbf5.jpg', 1, 0.1, 'кг'),
(192, 'Фундук чиш', 7, '2762dd1f', 334, 1, 1, '2762dd1f.jpg', 1, 0.1, 'кг'),
(193, 'Халва', 11, 'b318cb8f', 128, 1, 1, 'b318cb8f.jpg', 1, 0.1, 'кг'),
(194, 'Халва Узбецька', 11, 'ab4b9900', 46, 1, 0, 'ab4b9900.jpg', 1, 0.1, 'кг'),
(195, 'Цибуля', 3, '4e9d3a7d', 13, 1, 1, '4e9d3a7d.jpg', 1, 0.1, 'кг'),
(196, 'Цибуля Біла', 3, '3e43a441', 1, 0, 0, '3e43a441.jpg', 1, 0.1, 'кг'),
(197, 'Цибуля Марс', 3, '1174b925', 21, 1, 1, '1174b925.jpg', 1, 0.1, 'кг'),
(198, 'Цукат Кубик Мікс', 6, '3c86a643', 132, 1, 1, '3c86a643.jpg', 1, 0.1, 'кг'),
(199, 'Цукат Кубик Мікс Кроха', 6, '6152bdf7', 125, 1, 1, '6152bdf7.jpg', 1, 0.1, 'кг'),
(200, 'Цукат Помело', 6, '16291f40', 126, 1, 1, '16291f40.jpg', 1, 0.1, 'кг'),
(201, 'Цукат Папайя', 6, 'fc70c95a', 1, 0, 0, 'fc359e9c.jpg', 1, 0.1, 'кг'),
(202, 'Цукор', 8, '56e64d2e', 1, 0, 0, '56e64d2e.jpg', 1, 0.1, 'кг'),
(203, 'Часник', 3, '1b69a585', 70, 1, 1, '1b69a585.jpg', 1, 0.1, 'кг'),
(204, 'Часник імпорт', 3, 'f8c86d27', 100, 1, 1, 'f8c86d27.jpg', 1, 0.1, 'кг'),
(205, 'Сочевиця', 8, '14505639', 22, 1, 1, '14505639.jpg', 1, 0.1, 'кг'),
(206, 'Сочевиця Червона', 8, 'f79c4554', 32, 1, 1, 'f79c4554.jpg', 1, 0.1, 'кг'),
(207, 'Сочевиця Шліфована', 8, 'fa011b75', 23, 1, 1, 'fa011b75.jpg', 1, 0.1, 'кг'),
(208, 'Чорнослив', 6, '07e34d5c', 45, 1, 1, '07e34d5c.jpg', 1, 0.1, 'кг'),
(209, 'Шпинат', 5, '37bfbf28', 45, 1, 1, '37bfbf28.jpg', 1, 0.1, 'кг'),
(210, 'Шпинат пучок', 5, '18c63dc4', 1, 0, 0, '18c63dc4.jpg', 1, 1, 'шт'),
(211, 'Яблуко Домашнє', 2, '739310d1', 18, 1, 1, '739310d1.jpg', 1, 0.1, 'кг'),
(212, 'Яблуко червоне', 2, '76e630db', 33, 1, 1, '76e630db.jpg', 1, 0.1, 'кг'),
(213, 'Ягоди Годжі', 6, 'd91dcea3', 315, 1, 1, 'd91dcea3.jpg', 1, 0.1, 'кг'),
(214, 'Ядро соняшника', 8, '5082ce7c', 28, 1, 1, '5082ce7c.jpg', 1, 0.1, 'кг');

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
  `role` varchar(255) DEFAULT NULL,
  `change_secret_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `phone`, `address`, `discount`, `secret`, `role`, `change_secret_link`) VALUES
(8, 'vberkoz@gmail.com', 'Микола', '1234567899', '1-й провулок Герцена, 13', 0, '$2y$10$p5Gh.8gunmx.G4J5mA8dVehjUV8M3bvtq.IP.2VmQUU0ZgTEfxlU2', 'admin', ''),
(9, 'vberkoz2@gmail.com', 'Євген', '0668132356', 'Фучика, 71', 30, '$2y$10$.DMJGzmLYo6OzZLFlv.EDu8qgPQMWw3.cQT5g23h2KuzAyvSDKaMW', 'restaurant', NULL),
(10, 'alex@mail.com', 'Олександр', NULL, NULL, 0, '$2y$10$Ja6adhjFQJoE2mFC5ElNBuO8hjovdh7K2yDPBjWOp0BBclTNwsiMi', 'client', ''),
(18, 'vasylberkoz@icloud.com', 'Basil Sergius', '0668132356', 'Комарова 6/2', 0, '$2y$10$uBQZxQXGHFOrTpg38yLGTuh.NEEK/EHvNavKHmG2Wlprt1JsR.MpK', 'restaurant', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `discounts_id_uindex` (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `liked_products_id_uindex` (`id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_id_uindex` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id_uindex` (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordered_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
