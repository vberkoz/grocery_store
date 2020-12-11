-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `gs`;

DROP TABLE IF EXISTS `cart_products`;
CREATE TABLE `cart_products` (
                                 `id` int NOT NULL AUTO_INCREMENT,
                                 `cart_id` int NOT NULL,
                                 `product_id` int NOT NULL,
                                 `quantity` float NOT NULL,
                                 `client` float NOT NULL DEFAULT '0',
                                 `restaurant` float NOT NULL DEFAULT '0',
                                 `price` float NOT NULL,
                                 PRIMARY KEY (`id`),
                                 KEY `order_id` (`cart_id`),
                                 KEY `product_id` (`product_id`),
                                 CONSTRAINT `cart_products_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
                                 CONSTRAINT `cart_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cart_products` (`id`, `cart_id`, `product_id`, `quantity`, `client`, `restaurant`, `price`) VALUES
(13,	98,	209,	1,	5,	0,	45),
(14,	98,	213,	1,	20,	0,	315),
(15,	99,	214,	1.6,	0,	0,	28),
(16,	99,	212,	1,	3,	10,	33),
(17,	99,	208,	1,	0,	0,	45),
(27,	102,	213,	2,	0,	10,	315),
(28,	102,	212,	1.3,	3,	10,	33),
(29,	102,	25,	5,	0,	0,	40),
(30,	103,	209,	2.7,	0,	0,	45),
(31,	103,	208,	1.4,	0,	0,	45),
(32,	103,	207,	1.1,	0,	0,	23),
(33,	104,	213,	1,	0,	10,	315),
(67,	131,	213,	2,	0,	10,	315),
(68,	131,	212,	1.3,	3,	10,	33),
(69,	131,	25,	5,	0,	0,	40),
(70,	132,	213,	2,	0,	10,	315),
(71,	132,	212,	1.3,	3,	10,	33),
(72,	132,	25,	5,	0,	0,	40),
(79,	140,	109,	1,	0,	0,	72),
(80,	140,	124,	1,	0,	0,	116);

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                         `user_id` int DEFAULT NULL,
                         `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                         `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                         `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                         `message` text CHARACTER SET utf8 COLLATE utf8_general_ci,
                         `count` int DEFAULT NULL,
                         `price` float DEFAULT NULL,
                         `discount` float DEFAULT '0',
                         `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `orders_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `carts` (`id`, `hash`, `user_id`, `name`, `phone`, `address`, `message`, `count`, `price`, `discount`, `created_at`) VALUES
(98,	'f2e9e50dad88',	10,	'Олександр',	'0956543211',	'',	'',	NULL,	NULL,	25,	'2020-07-12 12:33:10'),
(99,	'996e248a6046',	18,	'Basil Sergius',	'1234567899',	'Комарова 6/2',	'',	NULL,	NULL,	6.3,	'2020-07-24 11:28:57'),
(102,	'3acc7f658ba9',	18,	'Basil Sergius',	'0668132356',	'Комарова 6/2',	'',	NULL,	NULL,	37.8,	'2020-07-27 19:28:22'),
(103,	'f88de97a311b',	18,	'Basil Sergius',	'0668132356',	'Комарова 6/2',	'',	NULL,	NULL,	0,	'2020-07-27 20:34:06'),
(104,	'3f49067ed742',	18,	'Basil Sergius',	'0668132356',	'Комарова 6/2',	'',	NULL,	NULL,	31.5,	'2020-07-30 15:34:45'),
(131,	'de9b2f65a2d6',	18,	'Basil Sergius',	'0668132356',	'Комарова 6/2',	'',	NULL,	NULL,	0,	'2020-08-05 21:05:06'),
(132,	'3bd863c59ba9',	18,	'Basil Sergius',	'0668132356',	'Комарова 6/2',	'',	NULL,	NULL,	0,	'2020-08-06 02:01:10'),
(140,	'c5c64de0ca51',	NULL,	'Василь',	'0668132356',	NULL,	NULL,	2,	188,	0,	'2020-12-07 21:09:14');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
                              `id` int NOT NULL AUTO_INCREMENT,
                              `title` varchar(255) NOT NULL,
                              `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                              `visible` int NOT NULL DEFAULT '1',
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `title`, `slug`, `visible`) VALUES
(1,	'Інше',	'inshe',	0),
(2,	'Фрукти',	'frukti',	1),
(3,	'Овочі',	'ovochi',	1),
(4,	'Бакалія',	'bakaliya',	1),
(5,	'Зелень',	'zelen',	1),
(6,	'Сухофрукти',	'suhofrukti',	1),
(7,	'Горіхи',	'gorihi',	1);

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
                             `id` int NOT NULL AUTO_INCREMENT,
                             `user_id` int NOT NULL,
                             `product_id` int NOT NULL,
                             `currency` float NOT NULL DEFAULT '0',
                             `percent` float NOT NULL DEFAULT '0',
                             PRIMARY KEY (`id`),
                             UNIQUE KEY `discounts_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `discounts` (`id`, `user_id`, `product_id`, `currency`, `percent`) VALUES
(20,	9,	214,	2,	1),
(24,	9,	213,	1,	1),
(27,	18,	212,	3,	10),
(28,	18,	213,	0,	10),
(29,	10,	214,	0,	0),
(30,	10,	213,	20,	0),
(31,	10,	209,	5,	0);

DROP TABLE IF EXISTS `product_details`;
CREATE TABLE `product_details` (
                                   `id` int NOT NULL AUTO_INCREMENT,
                                   `product_id` int NOT NULL,
                                   `language` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                   `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                   `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                   `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                   `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                   `characteristics` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                   `unit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                                   PRIMARY KEY (`id`),
                                   KEY `product_id` (`product_id`),
                                   CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `product_details` (`id`, `product_id`, `language`, `title`, `slug`, `image`, `description`, `characteristics`, `unit`) VALUES
(664,	15,	'ua',	'Банан',	'banan',	'banan.jpg',	'',	'{}',	'кг'),
(665,	16,	'ua',	'Яблуко Голден',	'yabluko-golden',	'yabluko-golden.jpg',	'',	'{}',	'кг'),
(666,	18,	'ua',	'Огірок корнішон',	'ogirok-kornishon',	'ogirok-kornishon.jpg',	'',	'{}',	'кг'),
(667,	19,	'ua',	'Морква',	'morkva',	'morkva.jpg',	'',	'{}',	'кг'),
(668,	20,	'ua',	'Картопля молода',	'kartoplya-moloda',	'kartoplya-moloda.jpg',	'',	'{}',	'кг'),
(669,	21,	'ua',	'Гриб Шампіньйон',	'grib-shampinjon',	'grib-shampinjon.jpg',	'',	'{}',	'кг'),
(670,	24,	'ua',	'Петрушка вагова',	'petrushka-vagova',	'petrushka-vagova.jpg',	'',	'{}',	'кг'),
(671,	25,	'ua',	'Зелена цибуля (перо)',	'zelena-cibulya-pero',	'zelena-cibulya-pero.jpg',	'',	'{}',	'шт'),
(672,	26,	'ua',	'Салат Пучок',	'salat-puchok',	'salat-puchok.jpg',	'',	'{}',	'шт'),
(673,	27,	'ua',	'Авокадо',	'avokado',	'avokado.jpg',	'',	'{}',	'шт'),
(674,	28,	'ua',	'Грейпфрут Туреччина',	'grejpfrut-turechchina',	'grejpfrut-turechchina.jpg',	'',	'{}',	'кг'),
(675,	30,	'ua',	'Редис червоний',	'redis-chervonij',	'redis-chervonij.jpg',	'',	'{}',	'кг'),
(676,	32,	'ua',	'Томат Сливка',	'tomat-slivka',	'tomat-slivka.jpg',	'',	'{}',	'кг'),
(677,	36,	'ua',	'Щавель',	'shavel',	'shavel.jpg',	'',	'{}',	'кг'),
(678,	37,	'ua',	'Банан в\'ялений',	'banan-v-yalenij',	'banan-v-yalenij.jpg',	'',	'{}',	'кг'),
(679,	38,	'ua',	'Суміш горіхів з фруктами',	'sumish-gorihiv-z-fruktami',	'sumish-gorihiv-z-fruktami.jpg',	'',	'{}',	'кг'),
(680,	39,	'ua',	'Абрикос',	'abrikos',	'abrikos.jpg',	'',	'{}',	'кг'),
(681,	40,	'ua',	'Авокадо',	'avokado',	'avokado.jpg',	'',	'{}',	'шт'),
(682,	41,	'ua',	'Авокадо Хаас',	'avokado-haas',	'avokado-haas.jpg',	'',	'{}',	'шт'),
(683,	42,	'ua',	'Айва',	'ajva',	'ajva.jpg',	'',	'{}',	'кг'),
(684,	43,	'ua',	'Амарант',	'amarant',	'amarant.jpg',	'',	'{}',	'кг'),
(685,	44,	'ua',	'Ананас калібр 10',	'ananas-kalibr-10',	'ananas-kalibr-10.jpg',	'',	'{}',	'кг'),
(686,	45,	'ua',	'Ананас калібр 6',	'ananas-kalibr-6',	'ananas-kalibr-6.jpg',	'',	'{}',	'кг'),
(687,	46,	'ua',	'Ананас кільце',	'ananas-kilce',	'ananas-kilce.jpg',	'',	'{}',	'кг'),
(688,	47,	'ua',	'Ананас Королівський',	'ananas-korolivskij',	'ananas-korolivskij.jpg',	'',	'{}',	'кг'),
(689,	48,	'ua',	'Апельсин',	'apelsin',	'apelsin.jpg',	'',	'{}',	'кг'),
(690,	49,	'ua',	'Апельсин гранатовий',	'apelsin-granatovij',	'apelsin-granatovij.jpg',	'',	'{}',	'кг'),
(691,	50,	'ua',	'Апельсин Іспанія',	'apelsin-ispaniya',	'apelsin-ispaniya.jpg',	'',	'{}',	'кг'),
(692,	51,	'ua',	'Апельсин Сицилія',	'apelsin-siciliya',	'apelsin-siciliya.jpg',	'',	'{}',	'кг'),
(693,	52,	'ua',	'Апельсин сітка',	'apelsin-sitka',	'apelsin-sitka.jpg',	'',	'{}',	'кг'),
(694,	53,	'ua',	'Арахіс Бланш',	'arahis-blansh',	'arahis-blansh.jpg',	'',	'{}',	'кг'),
(695,	54,	'ua',	'Арахіс в глазурі',	'arahis-v-glazuri',	'arahis-v-glazuri.jpg',	'',	'{}',	'кг'),
(696,	55,	'ua',	'Арахіс в шкаралупі',	'arahis-v-shkaralupi',	'arahis-v-shkaralupi.jpg',	'',	'{}',	'кг'),
(697,	56,	'ua',	'Арахіс сирий Ява',	'arahis-sirij-yava',	'arahis-sirij-yava.jpg',	'',	'{}',	'кг'),
(698,	57,	'ua',	'Арахіс смажений Ява',	'arahis-smazhenij-yava',	'arahis-smazhenij-yava.jpg',	'',	'{}',	'кг'),
(699,	58,	'ua',	'Арахіс солений',	'arahis-solenij',	'arahis-solenij.jpg',	'',	'{}',	'кг'),
(700,	59,	'ua',	'Асорті Горіхове',	'asorti-gorihove',	'asorti-gorihove.jpg',	'',	'{}',	'кг'),
(701,	60,	'ua',	'Бадьян',	'badyan',	'badyan.jpg',	'',	'{}',	'кг'),
(702,	61,	'ua',	'Базилік',	'bazilik',	'bazilik.jpg',	'',	'{}',	'кг'),
(703,	62,	'ua',	'Баклажан імпорт',	'baklazhan-import',	'baklazhan-import.jpg',	'',	'{}',	'кг'),
(704,	63,	'ua',	'Бананові чіпси',	'bananovi-chipsi',	'bananovi-chipsi.jpg',	'',	'{}',	'кг'),
(705,	64,	'ua',	'Батат',	'batat',	'batat.jpg',	'',	'{}',	'кг'),
(706,	65,	'ua',	'Борошно',	'boroshno',	'boroshno.jpg',	'',	'{}',	'кг'),
(707,	66,	'ua',	'Буряк молодий',	'buryak-molodij',	'buryak-molodij.jpg',	'',	'{}',	'кг'),
(708,	67,	'ua',	'Буряк старий',	'buryak-starij',	'buryak-starij.jpg',	'',	'{}',	'кг'),
(709,	68,	'ua',	'Виноград білий',	'vinograd-bilij',	'vinograd-bilij.jpg',	'',	'{}',	'кг'),
(710,	69,	'ua',	'Виноград Киш-Миш',	'vinograd-kish-mish',	'vinograd-kish-mish.jpg',	'',	'{}',	'кг'),
(711,	70,	'ua',	'Виноград Рожевий',	'vinograd-rozhevij',	'vinograd-rozhevij.jpg',	'',	'{}',	'кг'),
(712,	71,	'ua',	'Виноград Темний',	'vinograd-temnij',	'vinograd-temnij.jpg',	'',	'{}',	'кг'),
(713,	72,	'ua',	'Вишня вялена',	'vishnya-vyalena',	'vishnya-vyalena.jpg',	'',	'{}',	'кг'),
(714,	73,	'ua',	'Лохина',	'lohina',	'lohina.jpg',	'',	'{}',	'кг'),
(715,	74,	'ua',	'Горіх Кедровий',	'gorih-kedrovij',	'gorih-kedrovij.jpg',	'',	'{}',	'кг'),
(716,	75,	'ua',	'Гранат',	'granat',	'granat.jpg',	'',	'{}',	'кг'),
(717,	76,	'ua',	'Грейпфрут',	'grejpfrut',	'grejpfrut.jpg',	'',	'{}',	'кг'),
(718,	77,	'ua',	'Грецький горіх',	'greckij-gorih',	'greckij-gorih.jpg',	'',	'{}',	'кг'),
(719,	78,	'ua',	'Груша',	'grusha',	'grusha.jpg',	'',	'{}',	'кг'),
(720,	79,	'ua',	'Дайкон',	'dajkon',	'dajkon.jpg',	'',	'{}',	'кг'),
(721,	80,	'ua',	'Диня',	'dinya',	'dinya.jpg',	'',	'{}',	'кг'),
(722,	81,	'ua',	'Диня сушена',	'dinya-sushena',	'dinya-sushena.jpg',	'',	'{}',	'кг'),
(723,	82,	'ua',	'Журавлина',	'zhuravlina',	'zhuravlina.jpg',	'',	'{}',	'кг'),
(724,	83,	'ua',	'Ізюм золотий',	'izyum-zolotij',	'izyum-zolotij.jpg',	'',	'{}',	'кг'),
(725,	84,	'ua',	'Ізюм синій',	'izyum-sinij',	'izyum-sinij.jpg',	'',	'{}',	'кг'),
(726,	85,	'ua',	'Ізюм темний',	'izyum-temnij',	'izyum-temnij.jpg',	'',	'{}',	'кг'),
(727,	86,	'ua',	'Імбир',	'imbir',	'imbir.jpg',	'',	'{}',	'кг'),
(728,	87,	'ua',	'Імбірь Цукат',	'imbir-cukat',	'imbir-cukat.jpg',	'',	'{}',	'кг'),
(729,	88,	'ua',	'Інжир',	'inzhir',	'inzhir.jpg',	'',	'{}',	'кг'),
(730,	89,	'ua',	'Інжир сушений',	'inzhir-sushenij',	'inzhir-sushenij.jpg',	'',	'{}',	'кг'),
(731,	90,	'ua',	'Кабачок',	'kabachok',	'kabachok.jpg',	'',	'{}',	'кг'),
(732,	91,	'ua',	'Кавун',	'kavun',	'kavun.jpg',	'',	'{}',	'кг'),
(733,	92,	'ua',	'Капуста імпорт',	'kapusta-import',	'kapusta-import.jpg',	'',	'{}',	'кг'),
(734,	93,	'ua',	'Капуста Білокачанна',	'kapusta-bilokachanna',	'kapusta-bilokachanna.jpg',	'',	'{}',	'кг'),
(735,	94,	'ua',	'Капуста Брокколі',	'kapusta-brokkoli',	'kapusta-brokkoli.jpg',	'',	'{}',	'кг'),
(736,	95,	'ua',	'Капуста квашена',	'kapusta-kvashena',	'kapusta-kvashena.jpg',	'',	'{}',	'кг'),
(737,	96,	'ua',	'Капуста Молода',	'kapusta-moloda',	'kapusta-moloda.jpg',	'',	'{}',	'кг'),
(738,	97,	'ua',	'Капуста Пекінська',	'kapusta-pekinska',	'kapusta-pekinska.jpg',	'',	'{}',	'кг'),
(739,	98,	'ua',	'Капуста Синя',	'kapusta-sinya',	'kapusta-sinya.jpg',	'',	'{}',	'кг'),
(740,	99,	'ua',	'Капуста Цвітна',	'kapusta-cvitna',	'kapusta-cvitna.jpg',	'',	'{}',	'кг'),
(741,	100,	'ua',	'Картопля',	'kartoplya',	'kartoplya.jpg',	'',	'{}',	'кг'),
(742,	101,	'ua',	'Картопля молода',	'kartoplya-moloda',	'kartoplya-moloda.jpg',	'',	'{}',	'кг'),
(743,	102,	'ua',	'Квасоля',	'kvasolya',	'kvasolya.jpg',	'',	'{}',	'кг'),
(744,	103,	'ua',	'Кеш\'ю',	'kesh-yu',	'kesh-yu.jpg',	'',	'{}',	'кг'),
(745,	104,	'ua',	'Ківі',	'kivi',	'kivi.jpg',	'',	'{}',	'кг'),
(746,	105,	'ua',	'Ківі цукат',	'kivi-cukat',	'kivi-cukat.jpg',	'',	'{}',	'кг'),
(747,	106,	'ua',	'Кінза',	'kinza',	'kinza.jpg',	'',	'{}',	'кг'),
(748,	107,	'ua',	'Козинакі',	'kozinaki',	'kozinaki.jpg',	'',	'{}',	'кг'),
(749,	108,	'ua',	'Кокос',	'kokos',	'kokos.jpg',	'',	'{}',	'кг'),
(750,	109,	'ua',	'Кокосова стружка',	'kokosova-struzhka',	'kokosova-struzhka.jpg',	'',	'{}',	'кг'),
(751,	110,	'ua',	'Корицева паличка',	'koriceva-palichka',	'koriceva-palichka.jpg',	'',	'{}',	'кг'),
(752,	111,	'ua',	'Корінь Селери',	'korin-seleri',	'korin-seleri.jpg',	'',	'{}',	'кг'),
(753,	112,	'ua',	'Корольок',	'korolok',	'korolok.jpg',	'',	'{}',	'кг'),
(754,	113,	'ua',	'Корольок Іспанія',	'korolok-ispaniya',	'korolok-ispaniya.jpg',	'',	'{}',	'кг'),
(755,	114,	'ua',	'Кріп ваговий',	'krip-vagovij',	'krip-vagovij.jpg',	'',	'{}',	'кг'),
(756,	115,	'ua',	'Кріп пучок',	'krip-puchok',	'krip-puchok.jpg',	'',	'{}',	'шт'),
(757,	116,	'ua',	'Кукуруза зі смаком',	'kukuruza-zi-smakom',	'kukuruza-zi-smakom.jpg',	'',	'{}',	'кг'),
(758,	117,	'ua',	'Кумкват',	'kumkvat',	'kumkvat.jpg',	'',	'{}',	'кг'),
(759,	118,	'ua',	'Кунжут',	'kunzhut',	'kunzhut.jpg',	'',	'{}',	'кг'),
(760,	119,	'ua',	'Курага 1 сорт',	'kuraga-1-sort',	'kuraga-1-sort.jpg',	'',	'{}',	'кг'),
(761,	120,	'ua',	'Курага джамбо',	'kuraga-dzhambo',	'kuraga-dzhambo.jpg',	'',	'{}',	'кг'),
(762,	121,	'ua',	'Курага сердечко',	'kuraga-serdechko',	'kuraga-serdechko.jpg',	'',	'{}',	'кг'),
(763,	122,	'ua',	'Лайм',	'lajm',	'lajm.jpg',	'',	'{}',	'кг'),
(764,	123,	'ua',	'Лимон',	'limon',	'limon.jpg',	'',	'{}',	'кг'),
(765,	124,	'ua',	'Мак',	'mak',	'mak.jpg',	'',	'{}',	'кг'),
(766,	125,	'ua',	'Малина',	'malina',	'malina.jpg',	'',	'{}',	'кг'),
(767,	126,	'ua',	'Манго',	'mango',	'mango.jpg',	'',	'{}',	'кг'),
(768,	127,	'ua',	'Манго королівське',	'mango-korolivske',	'mango-korolivske.jpg',	'',	'{}',	'кг'),
(769,	128,	'ua',	'Манго Цукат',	'mango-cukat',	'mango-cukat.jpg',	'',	'{}',	'кг'),
(770,	129,	'ua',	'Мангольд',	'mangold',	'mangold.jpg',	'',	'{}',	'кг'),
(771,	130,	'ua',	'Мандарин еліт',	'mandarin-elit',	'mandarin-elit.jpg',	'',	'{}',	'кг'),
(772,	131,	'ua',	'Мандарин Іспанія',	'mandarin-ispaniya',	'mandarin-ispaniya.jpg',	'',	'{}',	'кг'),
(773,	132,	'ua',	'Мандарин Італія',	'mandarin-italiya',	'mandarin-italiya.jpg',	'',	'{}',	'кг'),
(774,	133,	'ua',	'Мандарин Турція',	'mandarin-turciya',	'mandarin-turciya.jpg',	'',	'{}',	'кг'),
(775,	134,	'ua',	'Мигдаль золотий',	'migdal-zolotij',	'migdal-zolotij.jpg',	'',	'{}',	'кг'),
(776,	135,	'ua',	'Мікрогрін Горох',	'mikrogrin-goroh',	'mikrogrin-goroh.jpg',	'',	'{}',	'шт'),
(777,	136,	'ua',	'Мікрогрін Люцерна',	'mikrogrin-lyucerna',	'mikrogrin-lyucerna.jpg',	'',	'{}',	'шт'),
(778,	137,	'ua',	'Мікрогрін Гарбуз',	'mikrogrin-garbuz',	'mikrogrin-garbuz.jpg',	'',	'{}',	'шт'),
(779,	138,	'ua',	'Мікрогрін Редис',	'mikrogrin-redis',	'mikrogrin-redis.jpg',	'',	'{}',	'шт'),
(780,	139,	'ua',	'Мікрогрін Цибуля',	'mikrogrin-cibulya',	'mikrogrin-cibulya.jpg',	'',	'{}',	'шт'),
(781,	140,	'ua',	'Морква Абако',	'morkva-abako',	'morkva-abako.jpg',	'',	'{}',	'кг'),
(782,	141,	'ua',	'Мята',	'myata',	'myata.jpg',	'',	'{}',	'кг'),
(783,	142,	'ua',	'Насіння гарбуза',	'nasinnya-garbuza',	'nasinnya-garbuza.jpg',	'',	'{}',	'кг'),
(784,	143,	'ua',	'Насіння Чіа',	'nasinnya-chia',	'nasinnya-chia.jpg',	'',	'{}',	'кг'),
(785,	144,	'ua',	'Горох Нут',	'goroh-nut',	'goroh-nut.jpg',	'',	'{}',	'кг'),
(786,	145,	'ua',	'Огірок гладкий',	'ogirok-gladkij',	'ogirok-gladkij.jpg',	'',	'{}',	'кг'),
(787,	146,	'ua',	'Огірок квашений',	'ogirok-kvashenij',	'ogirok-kvashenij.jpg',	'',	'{}',	'кг'),
(788,	147,	'ua',	'Огірок колючий',	'ogirok-kolyuchij',	'ogirok-kolyuchij.jpg',	'',	'{}',	'кг'),
(789,	148,	'ua',	'Помело',	'pomelo',	'pomelo.jpg',	'',	'{}',	'кг'),
(790,	149,	'ua',	'Папайя',	'papajya',	'papajya.jpg',	'',	'{}',	'кг'),
(791,	150,	'ua',	'Паприка мелена',	'paprika-melena',	'paprika-melena.jpg',	'',	'{}',	'кг'),
(792,	151,	'ua',	'Пахлава',	'pahlava',	'pahlava.jpg',	'',	'{}',	'кг'),
(793,	152,	'ua',	'Перець Білозірка',	'perec-bilozirka',	'perec-bilozirka.jpg',	'',	'{}',	'кг'),
(794,	153,	'ua',	'Перець Болгарський',	'perec-bolgarskij',	'perec-bolgarskij.jpg',	'',	'{}',	'кг'),
(795,	154,	'ua',	'Перець Болгарський Жовтий',	'perec-bolgarskij-zhovtij',	'perec-bolgarskij-zhovtij.jpg',	'',	'{}',	'кг'),
(796,	155,	'ua',	'Перець Каппі',	'perec-kappi',	'perec-kappi.jpg',	'',	'{}',	'кг'),
(797,	156,	'ua',	'Перець Чилі',	'perec-chili',	'perec-chili.jpg',	'',	'{}',	'кг'),
(798,	157,	'ua',	'Персик',	'persik',	'persik.jpg',	'',	'{}',	'кг'),
(799,	158,	'ua',	'Петрушка кучерява',	'petrushka-kucheryava',	'petrushka-kucheryava.jpg',	'',	'{}',	'кг'),
(800,	159,	'ua',	'Петрушка',	'petrushka',	'petrushka.jpg',	'',	'{}',	'шт'),
(801,	160,	'ua',	'Пітахайя біла',	'pitahajya-bila',	'pitahajya-bila.jpg',	'',	'{}',	'кг'),
(802,	161,	'ua',	'Пітахайя червона',	'pitahajya-chervona',	'pitahajya-chervona.jpg',	'',	'{}',	'кг'),
(803,	162,	'ua',	'Полуниця',	'polunicya',	'polunicya.jpg',	'',	'{}',	'кг'),
(804,	163,	'ua',	'Томат',	'tomat',	'tomat.jpg',	'',	'{}',	'кг'),
(805,	164,	'ua',	'Томат коктейльный',	'tomat-koktejlnyj',	'tomat-koktejlnyj.jpg',	'',	'{}',	'кг'),
(806,	165,	'ua',	'Томат рожевий',	'tomat-rozhevij',	'tomat-rozhevij.jpg',	'',	'{}',	'кг'),
(807,	166,	'ua',	'Томат чері',	'tomat-cheri',	'tomat-cheri.jpg',	'',	'{}',	'кг'),
(808,	167,	'ua',	'Порей',	'porej',	'porej.jpg',	'',	'{}',	'кг'),
(809,	168,	'ua',	'Смородина червона',	'smorodina-chervona',	'smorodina-chervona.jpg',	'',	'{}',	'кг'),
(810,	169,	'ua',	'Салат Радічіо',	'salat-radichio',	'salat-radichio.jpg',	'',	'{}',	'кг'),
(811,	170,	'ua',	'Редиска',	'rediska',	'rediska.jpg',	'',	'{}',	'кг'),
(812,	171,	'ua',	'Розмарин',	'rozmarin',	'rozmarin.jpg',	'',	'{}',	'кг'),
(813,	172,	'ua',	'Рукола',	'rukola',	'rukola.jpg',	'',	'{}',	'кг'),
(814,	173,	'ua',	'Рукола пучок',	'rukola-puchok',	'rukola-puchok.jpg',	'',	'{}',	'шт'),
(815,	174,	'ua',	'Салат Айсберг',	'salat-ajsberg',	'salat-ajsberg.jpg',	'',	'{}',	'кг'),
(816,	175,	'ua',	'Салат Біонда',	'salat-bionda',	'salat-bionda.jpg',	'',	'{}',	'кг'),
(817,	176,	'ua',	'Салат Мікс',	'salat-miks',	'salat-miks.jpg',	'',	'{}',	'кг'),
(818,	177,	'ua',	'Салат Ромен',	'salat-romen',	'salat-romen.jpg',	'',	'{}',	'кг'),
(819,	178,	'ua',	'Салат Россо',	'salat-rosso',	'salat-rosso.jpg',	'',	'{}',	'кг'),
(820,	179,	'ua',	'Світі',	'sviti',	'sviti.jpg',	'',	'{}',	'кг'),
(821,	180,	'ua',	'Стебло Селери',	'steblo-seleri',	'steblo-seleri.jpg',	'',	'{}',	'кг'),
(822,	181,	'ua',	'Суміш сухофруктів',	'sumish-suhofruktiv',	'sumish-suhofruktiv.jpg',	'',	'{}',	'кг'),
(823,	182,	'ua',	'Сушка',	'sushka',	'sushka.jpg',	'',	'{}',	'кг'),
(824,	183,	'ua',	'Сушка узбецька',	'sushka-uzbecka',	'sushka-uzbecka.jpg',	'',	'{}',	'кг'),
(825,	184,	'ua',	'Гарбуз',	'garbuz',	'garbuz.jpg',	'',	'{}',	'кг'),
(826,	185,	'ua',	'Кмин',	'kmin',	'kmin.jpg',	'',	'{}',	'кг'),
(827,	186,	'ua',	'Урюк сушений',	'uryuk-sushenij',	'uryuk-sushenij.jpg',	'',	'{}',	'кг'),
(828,	187,	'ua',	'Фінік',	'finik',	'finik.jpg',	'',	'{}',	'кг'),
(829,	188,	'ua',	'Фінік медовий',	'finik-medovij',	'finik-medovij.jpg',	'',	'{}',	'кг'),
(830,	189,	'ua',	'Фінік медовий',	'finik-medovij',	'finik-medovij.jpg',	'',	'{}',	'шт'),
(831,	190,	'ua',	'Фісташки',	'fistashki',	'fistashki.jpg',	'',	'{}',	'кг'),
(832,	191,	'ua',	'Салат Фрізе',	'salat-frize',	'salat-frize.jpg',	'',	'{}',	'кг'),
(833,	192,	'ua',	'Фундук чиш',	'funduk-chish',	'funduk-chish.jpg',	'',	'{}',	'кг'),
(834,	193,	'ua',	'Халва',	'halva',	'halva.jpg',	'',	'{}',	'кг'),
(835,	194,	'ua',	'Халва Узбецька',	'halva-uzbecka',	'halva-uzbecka.jpg',	'',	'{}',	'кг'),
(836,	195,	'ua',	'Цибуля',	'cibulya',	'cibulya.jpg',	'',	'{}',	'кг'),
(837,	196,	'ua',	'Цибуля Біла',	'cibulya-bila',	'cibulya-bila.jpg',	'',	'{}',	'кг'),
(838,	197,	'ua',	'Цибуля Марс',	'cibulya-mars',	'cibulya-mars.jpg',	'',	'{}',	'кг'),
(839,	198,	'ua',	'Цукат Кубик Мікс',	'cukat-kubik-miks',	'cukat-kubik-miks.jpg',	'',	'{}',	'кг'),
(840,	199,	'ua',	'Цукат Кубик Мікс Кроха',	'cukat-kubik-miks-kroha',	'cukat-kubik-miks-kroha.jpg',	'',	'{}',	'кг'),
(841,	200,	'ua',	'Цукат Помело',	'cukat-pomelo',	'cukat-pomelo.jpg',	'',	'{}',	'кг'),
(842,	201,	'ua',	'Цукат Папайя',	'cukat-papajya',	'cukat-papajya.jpg',	'',	'{}',	'кг'),
(843,	202,	'ua',	'Цукор',	'cukor',	'cukor.jpg',	'',	'{}',	'кг'),
(844,	203,	'ua',	'Часник',	'chasnik',	'chasnik.jpg',	'',	'{}',	'кг'),
(845,	204,	'ua',	'Часник імпорт',	'chasnik-import',	'chasnik-import.jpg',	'',	'{}',	'кг'),
(846,	205,	'ua',	'Сочевиця',	'sochevicya',	'sochevicya.jpg',	'',	'{}',	'кг'),
(847,	206,	'ua',	'Сочевиця Червона',	'sochevicya-chervona',	'sochevicya-chervona.jpg',	'',	'{}',	'кг'),
(848,	207,	'ua',	'Сочевиця Шліфована',	'sochevicya-shlifovana',	'sochevicya-shlifovana.jpg',	'',	'{}',	'кг'),
(849,	208,	'ua',	'Чорнослив',	'chornosliv',	'chornosliv.jpg',	'',	'{}',	'кг'),
(850,	209,	'ua',	'Шпинат',	'shpinat',	'shpinat.jpg',	'',	'{}',	'кг'),
(851,	210,	'ua',	'Шпинат пучок',	'shpinat-puchok',	'shpinat-puchok.jpg',	'',	'{}',	'шт'),
(852,	211,	'ua',	'Яблуко Домашнє',	'yabluko-domashnye',	'yabluko-domashnye.jpg',	'',	'{}',	'кг'),
(853,	212,	'ua',	'Яблуко червоне',	'yabluko-chervone',	'yabluko-chervone.jpg',	'',	'{}',	'кг'),
(854,	213,	'ua',	'Ягоди Годжі',	'yagodi-godzhi',	'yagodi-godzhi.jpg',	'<p>Плоди годжі мають довгасту форму і червоний колір. Вони містять цинк, йод, селен, залізо, кальцій, фосфор, калій, германій, магній, мідь, кобальт, вітаміни А, С, В1, В2, В6, В9, Е. Тобто завдяки широкому спектру необхідних людині мікроелементів і вітамінів ягоди годжі підвищують тонус, дають заряд енергії, нормалізують роботу нервової системи, покращують зір, підвищують рівень гемоглобіну у крові.</p><p>Лінолева кислота, що міститься у плодах годжі, спалює жир, тому дієтологи часто додають їх у раціон дієтичного харчування. Ці плоди підтримують баланс мікрофлори кишківника, очищають печінку, виводять зайву рідину з організму.</p><p>Оскільки продукти містять кислоти Омега-6, Омега-3 і полісахариди LBP, годжі нормалізують гормональний фон і мають антиоксидантну дію, підтримуючи молодість клітин і стимулюючи їх оновлення.</p>',	'{}',	'кг'),
(855,	214,	'ua',	'Ядро соняшника1',	'yadro-sonyashnika',	'yadro-sonyashnika.jpg',	'[\"Антиоксиданти. У зернах із соняшнику міститься велика кількість вітаміну Е. Саме цей компонент відповідає за здорову шкіру, слизову оболонку порожнини рота, захищає клітини організму.\",\"В насінні міститься достатня кількість кислот, що мають антиокислювальні властивості. Вдосталь у зернах знаходиться амінокислоти аргініну. Саме цей компонент здатний підтримати серцево-судинну систему, зменшує відсоток виникнення тромбозу вен.\",\"Фітостероли, які містяться в насінні, вбирають у себе холестерин, тим самим зменшують його кількість в організмі.\"]',	'{\"Умови зберігання\": \"температура 0 до +10; вологість до 70%\", \"Термін зберігання\": \"7 місяців\", \"Калорійність (на 100г)\": \"600 ккал\"}',	'кг');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `category_id` int NOT NULL,
                            `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                            `price` float NOT NULL,
                            `visible` int NOT NULL DEFAULT '1',
                            `volume` float DEFAULT '0.1',
                            `volume_min` float DEFAULT '0.1',
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `product_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `category_id`, `code`, `price`, `visible`, `volume`, `volume_min`) VALUES
(15,	2,	'BBCRLBQH',	34.21,	1,	1,	0.1),
(16,	2,	'R37PKGP2',	33,	1,	1,	0.1),
(18,	3,	'2DDUBV24',	40,	0,	1,	0.1),
(19,	3,	'W63UECM8',	8.5,	0,	1,	0.1),
(20,	3,	'S58XTLUA',	30,	0,	1,	0.1),
(21,	1,	'KK8QD4ZT',	55,	1,	1,	0.1),
(24,	5,	'KGE87PYH',	55,	1,	1,	0.1),
(25,	5,	'AC24B4UU',	40,	1,	1,	1),
(26,	5,	'PC2U9ZXH',	40,	0,	1,	1),
(27,	2,	'62MM8SXW',	18,	0,	1,	1),
(28,	2,	'LJXMECFC',	40,	0,	1,	0.1),
(30,	3,	'U6Y5BMDK',	40,	0,	1,	0.1),
(32,	3,	'2TTB688C',	40,	0,	1,	0.1),
(36,	5,	'06bbe071',	65,	1,	1,	0.1),
(37,	6,	'5312f233',	22,	1,	1,	0.2),
(38,	7,	'0a579037',	217,	1,	1,	0.1),
(39,	2,	'b1d7b535',	55,	1,	1,	0.1),
(40,	2,	'00c5d5d5',	22,	1,	1,	1),
(41,	2,	'acc8be7b',	37,	1,	1,	1),
(42,	2,	'7be4e45e',	1,	0,	1,	0.1),
(43,	4,	'd2123081',	1,	0,	1,	0.1),
(44,	2,	'681aaa9b',	40,	1,	1.5,	0.1),
(45,	2,	'c59021da',	85,	1,	1,	0.1),
(46,	6,	'b912ce1d',	171,	1,	1,	0.1),
(47,	2,	'a89aa689',	110,	1,	1.8,	0.1),
(48,	2,	'5df93b4f',	33,	1,	1,	0.1),
(49,	2,	'4fc4deff',	1,	0,	1,	0.1),
(50,	2,	'3ad7e9fe',	52,	1,	1,	0.1),
(51,	2,	'4e05ecef',	1,	0,	1,	0.1),
(52,	2,	'5ae8297f',	1,	0,	1,	0.1),
(53,	7,	'73e240ce',	75,	1,	1,	0.1),
(54,	7,	'cbc3009a',	128,	1,	1,	0.1),
(55,	7,	'5137f451',	80,	1,	1,	0.1),
(56,	7,	'130ed591',	60,	1,	1,	0.1),
(57,	7,	'81b4294c',	66,	1,	1,	0.1),
(58,	7,	'6d1cd31b',	168,	1,	1,	0.1),
(59,	7,	'feeefcfb',	185,	1,	1,	0.1),
(60,	1,	'2e2d89c0',	380,	1,	1,	0.1),
(61,	1,	'c33c64f3',	25,	1,	1,	0.1),
(62,	3,	'951156e5',	70,	1,	1,	0.1),
(63,	6,	'd0cea7d1',	121,	1,	1,	0.1),
(64,	3,	'fdff930b',	95,	1,	1,	0.1),
(65,	4,	'277418fa',	8.4,	1,	1,	0.1),
(66,	3,	'80f9240c',	12,	1,	1,	0.1),
(67,	3,	'c31b59c4',	6,	1,	1,	0.1),
(68,	2,	'b4d1e94e',	82,	1,	1,	0.1),
(69,	2,	'b89de029',	1,	0,	1,	0.1),
(70,	2,	'3ff87e11',	82,	1,	1,	0.1),
(71,	2,	'd75d06fe',	1,	0,	1,	0.1),
(72,	6,	'ad74bac0',	165,	1,	1,	0.1),
(73,	2,	'd1585c95',	320,	1,	1,	0.1),
(74,	7,	'b3810df2',	550,	1,	1,	0.1),
(75,	2,	'6dcfedcf',	110,	1,	1,	0.1),
(76,	2,	'b148899b',	30,	1,	1,	0.1),
(77,	7,	'989e9043',	155,	1,	1,	0.1),
(78,	2,	'2316672c',	50,	1,	1,	0.1),
(79,	3,	'122c4e56',	1,	0,	1,	0.1),
(80,	2,	'35dc74cf',	60,	1,	1,	0.1),
(81,	6,	'af80484d',	189,	1,	1,	0.1),
(82,	2,	'f1b90a05',	1,	0,	1,	0.1),
(83,	6,	'28ca9e58',	80,	1,	1,	0.1),
(84,	6,	'3714a657',	87,	1,	1,	0.1),
(85,	6,	'ea907e88',	63,	1,	1,	0.1),
(86,	1,	'1f816f68',	95,	1,	1,	0.1),
(87,	6,	'aebf1016',	165,	1,	1,	0.1),
(88,	2,	'4bb17469',	28,	1,	1,	0.2),
(89,	6,	'5f3d9a0a',	124,	1,	1,	0.1),
(90,	3,	'a9f2a57d',	26,	1,	1,	0.1),
(91,	2,	'b3369e98',	35,	1,	1,	0.1),
(92,	3,	'e284a30c',	1,	0,	1,	0.1),
(93,	3,	'1051fff5',	5.5,	1,	1,	0.1),
(94,	3,	'ce641912',	65,	1,	1,	0.1),
(95,	3,	'c90916b9',	1,	0,	1,	0.1),
(96,	3,	'2a51a607',	6,	1,	1,	0.1),
(97,	3,	'f53f11ed',	15,	1,	1,	0.1),
(98,	3,	'd3e30534',	1,	0,	1,	0.1),
(99,	3,	'5c58cc44',	35,	1,	1,	0.1),
(100,	3,	'89b39669',	10.5,	1,	1,	0.1),
(101,	3,	'a7b73551',	14,	1,	1,	0.1),
(102,	4,	'8c1ef2e4',	30,	1,	1,	0.1),
(103,	7,	'55cf6007',	292,	1,	1,	0.1),
(104,	2,	'8dd867a1',	174,	1,	1,	0.1),
(105,	6,	'b8753072',	152,	1,	1,	0.1),
(106,	5,	'29f34e72',	1,	0,	1,	1),
(107,	1,	'ecb47cd0',	78,	1,	1,	0.1),
(108,	2,	'6348662d',	23,	1,	1,	0.1),
(109,	4,	'4a642424',	72,	1,	1,	0.1),
(110,	1,	'f61719dc',	283,	1,	1,	0.1),
(111,	3,	'7550a5a0',	20,	1,	1,	0.1),
(112,	2,	'0f098d5d',	1,	0,	1,	0.1),
(113,	2,	'03f5a0f4',	1,	0,	1,	0.1),
(114,	5,	'44a6c1e3',	75,	1,	1,	0.1),
(115,	5,	'75bf86ca',	4.5,	1,	1,	1),
(116,	1,	'4128a283',	104,	1,	1,	0.1),
(117,	2,	'ab3d4ce1',	260,	1,	1,	0.1),
(118,	4,	'af867ae2',	87,	1,	1,	0.1),
(119,	6,	'95b2deb9',	73,	1,	1,	0.1),
(120,	6,	'04943868',	132,	1,	1,	0.1),
(121,	6,	'2438a727',	36,	1,	1,	0.1),
(122,	2,	'1a12a211',	110,	1,	1,	0.1),
(123,	2,	'c92ab684',	48,	1,	1,	0.1),
(124,	4,	'ccfcd4a4',	116,	1,	1,	0.1),
(125,	2,	'34290083',	560,	1,	1,	0.1),
(126,	2,	'60fb2bde',	47,	1,	1,	0.1),
(127,	2,	'4b0435ae',	160,	1,	1,	0.1),
(128,	6,	'e8df93d1',	167,	1,	1,	0.1),
(129,	5,	'86c4f834',	110,	1,	1,	0.1),
(130,	2,	'cd9c493c',	62,	1,	1,	0.1),
(131,	2,	'b13d17de',	1,	0,	1,	0.1),
(132,	2,	'14c43103',	1,	0,	1,	0.1),
(133,	2,	'e758b62f',	1,	0,	1,	0.1),
(134,	7,	'f6c5a6df',	1,	0,	1,	0.1),
(135,	5,	'56298bfa',	70,	1,	1,	1),
(136,	5,	'589c23d5',	50,	1,	1,	1),
(137,	5,	'5b05ebc4',	70,	1,	1,	1),
(138,	5,	'ad89d238',	70,	1,	1,	1),
(139,	5,	'41a8dd80',	110,	1,	1,	1),
(140,	3,	'1d9cd195',	8.5,	1,	1,	0.1),
(141,	5,	'1f456de9',	80,	1,	1,	0.1),
(142,	4,	'75c131ee',	142,	1,	1,	0.1),
(143,	4,	'e7253431',	105,	1,	1,	0.1),
(144,	4,	'ed9e0096',	35,	1,	1,	0.1),
(145,	3,	'17979b0d',	1,	0,	1,	0.1),
(146,	4,	'5ca6aea0',	1,	0,	1,	0.1),
(147,	3,	'cc2d8d39',	26,	1,	1,	0.1),
(148,	2,	'56cb9d04',	1,	0,	1,	0.1),
(149,	2,	'baaebbf6',	200,	1,	1,	0.1),
(150,	1,	'97eeb83d',	1,	0,	1,	0.1),
(151,	1,	'2ba901e5',	130,	1,	1,	0.1),
(152,	3,	'e713ab96',	1,	0,	1,	0.1),
(153,	3,	'8dfdf4bc',	75,	1,	1,	0.1),
(154,	3,	'de9d82b4',	75,	1,	1,	0.1),
(155,	3,	'7ac12ce8',	1,	0,	1,	0.1),
(156,	3,	'169b9ad7',	130,	1,	1,	0.1),
(157,	2,	'2c970115',	70,	1,	1,	0.1),
(158,	5,	'2c6fd03f',	60,	1,	1,	0.1),
(159,	5,	'98f22372',	4.5,	1,	1,	1),
(160,	2,	'1f29d052',	110,	1,	1,	0.1),
(161,	2,	'f2720ea3',	140,	1,	1,	0.1),
(162,	2,	'5d0088c2',	70,	1,	1,	0.1),
(163,	3,	'136a2f0b',	70,	1,	1,	0.1),
(164,	3,	'ea228605',	143,	1,	1,	0.1),
(165,	3,	'6e4686f4',	40,	1,	1,	0.1),
(166,	3,	'5dfeed1d',	72,	1,	1,	0.1),
(167,	3,	'f268a059',	1,	0,	1,	0.1),
(168,	2,	'fd05c235',	650,	1,	1,	0.1),
(169,	3,	'f16cb967',	110,	1,	1,	0.1),
(170,	3,	'66cc6fd6',	25,	1,	1,	0.1),
(171,	5,	'd8d5e529',	190,	1,	1,	0.1),
(172,	5,	'a01b6c41',	90,	1,	1,	0.1),
(173,	5,	'bcd4d0c3',	29,	1,	1,	1),
(174,	3,	'1ddd9780',	132,	1,	1,	0.1),
(175,	3,	'94bb6c6d',	35,	1,	1,	0.1),
(176,	3,	'46e3a288',	30,	1,	1,	0.1),
(177,	3,	'119de140',	980,	1,	1,	0.1),
(178,	3,	'cc628b77',	25,	1,	1,	0.1),
(179,	2,	'0e97af87',	1,	0,	1,	0.1),
(180,	5,	'a133e773',	1,	0,	1,	0.1),
(181,	6,	'c948d774',	190,	1,	1,	0.1),
(182,	6,	'5af4523f',	28,	1,	1,	0.1),
(183,	6,	'ee2c7c2d',	35,	1,	1,	0.1),
(184,	3,	'82082666',	1,	0,	1,	0.1),
(185,	1,	'5e1d6e5b',	190,	1,	1,	0.1),
(186,	6,	'b1c45393',	116,	1,	1,	0.1),
(187,	6,	'2ac07d67',	78,	1,	1,	0.1),
(188,	6,	'fc359e9c',	82,	1,	1,	0.1),
(189,	6,	'ab567238',	1,	0,	1,	1),
(190,	7,	'0fa5f7ec',	420,	1,	1,	0.1),
(191,	3,	'34b2bbf5',	30,	1,	1,	0.1),
(192,	7,	'2762dd1f',	334,	1,	1,	0.1),
(193,	1,	'b318cb8f',	128,	1,	1,	0.1),
(194,	1,	'ab4b9900',	46,	0,	1,	0.1),
(195,	3,	'4e9d3a7d',	13,	1,	1,	0.1),
(196,	3,	'3e43a441',	1,	0,	1,	0.1),
(197,	3,	'1174b925',	21,	1,	1,	0.1),
(198,	6,	'3c86a643',	132,	1,	1,	0.1),
(199,	6,	'6152bdf7',	125,	1,	1,	0.1),
(200,	6,	'16291f40',	126,	1,	1,	0.1),
(201,	6,	'fc70c95a',	1,	0,	1,	0.1),
(202,	4,	'56e64d2e',	1,	0,	1,	0.1),
(203,	3,	'1b69a585',	70,	1,	1,	0.1),
(204,	3,	'f8c86d27',	100,	1,	1,	0.1),
(205,	4,	'14505639',	22,	1,	1,	0.1),
(206,	4,	'f79c4554',	32,	1,	1,	0.1),
(207,	4,	'fa011b75',	23,	1,	1,	0.1),
(208,	6,	'07e34d5c',	45,	1,	1,	0.1),
(209,	5,	'37bfbf28',	45,	1,	1,	0.1),
(210,	5,	'18c63dc4',	1,	0,	1,	1),
(211,	2,	'739310d1',	18,	1,	1,	0.1),
(212,	2,	'76e630db',	33,	1,	1,	0.1),
(213,	6,	'd91dcea3',	315,	1,	1,	0.1),
(214,	4,	'5082ce7c',	28,	1,	1,	0.1);

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `product_id` int NOT NULL,
                           `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                           `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                           `text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                           `date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
                           PRIMARY KEY (`id`),
                           KEY `product_id` (`product_id`),
                           CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `reviews` (`id`, `product_id`, `name`, `email`, `text`, `date`) VALUES
(2,	214,	'Олександр',	'alex@gmail.com',	'Дуже хороший товар, добре заходить з пивком під футбольчик',	'2020-11-20 13:31:50'),
(3,	214,	'Іван',	'ivan@gmail.com',	'Люблю сидіти під дверима і лускати соняшки',	'2020-11-20 13:31:08'),
(4,	213,	'Микола',	'mykola@gmail.com',	'Вовчі ягоди найкраще смакують свіжими',	'2020-11-20 13:50:23'),
(5,	213,	'Марина',	'marina@gmail.com',	'Гарний, яскравий колір',	'2020-11-20 13:52:20'),
(6,	213,	'Іван',	'ivan@gmail.com',	'Інформація справді корисна',	'2020-11-29 10:53:36'),
(9,	213,	'Марина',	'marina@gmail.com',	'З\'явився ще один чудовий колір',	'2020-11-29 11:10:22');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `email` varchar(255) NOT NULL,
                         `username` varchar(255) NOT NULL,
                         `phone` varchar(10) DEFAULT NULL,
                         `address` varchar(255) DEFAULT NULL,
                         `discount` int DEFAULT '0',
                         `secret` varchar(255) NOT NULL,
                         `role` varchar(255) DEFAULT NULL,
                         `change_secret_link` varchar(255) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `email`, `username`, `phone`, `address`, `discount`, `secret`, `role`, `change_secret_link`) VALUES
(8,	'vberkoz@gmail.com',	'Микола',	'1234567899',	'1-й провулок Герцена, 13',	0,	'$2y$10$p5Gh.8gunmx.G4J5mA8dVehjUV8M3bvtq.IP.2VmQUU0ZgTEfxlU2',	'admin',	''),
(9,	'vberkoz2@gmail.com',	'Євген',	'0668132356',	'Фучика, 71',	30,	'$2y$10$.DMJGzmLYo6OzZLFlv.EDu8qgPQMWw3.cQT5g23h2KuzAyvSDKaMW',	'restaurant',	NULL),
(10,	'alex@mail.com',	'Олександр',	NULL,	NULL,	0,	'$2y$10$Ja6adhjFQJoE2mFC5ElNBuO8hjovdh7K2yDPBjWOp0BBclTNwsiMi',	'client',	''),
(18,	'vasylberkoz@icloud.com',	'Basil Sergius',	'0668132356',	'Комарова 6/2',	0,	'$2y$10$uBQZxQXGHFOrTpg38yLGTuh.NEEK/EHvNavKHmG2Wlprt1JsR.MpK',	'restaurant',	NULL);

-- 2020-12-07 21:11:18