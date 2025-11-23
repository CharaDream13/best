-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 23, 2025 at 10:50 PM
-- Server version: 5.1.65-community-log
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `SE`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `id_moder_status` int(11) NOT NULL AUTO_INCREMENT,
  `moder_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_moder_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`id_moder_status`, `moder_status`) VALUES
(1, 'none'),
(2, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name_product` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `bucket_volume` text NOT NULL,
  `digging_depth` text NOT NULL,
  `engine_power` text NOT NULL,
  `dimensions` text NOT NULL,
  `speed` int(11) NOT NULL,
  `available` tinyint(1) DEFAULT '1',
  `id_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_product`),
  KEY `fk_product_type` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id_product`, `name_product`, `photo`, `price`, `weight`, `bucket_volume`, `digging_depth`, `engine_power`, `dimensions`, `speed`, `available`, `id_type`) VALUES
(1, 'Solar 225 NLC-V', '../product/1.jpg', 2250, 21000, '1.02', '5.7', '148', '0', 0, 13, 1),
(2, 'JCB JS 220 LC', '../product/2.jpg', 2250, 22550, '1.2', '6.61', '172', '0', 0, 10, 1),
(3, 'Hitachi ZX330-5G', '../product/3.jpg', 2750, 31500, '1.8', '7.41', '246', '0', 0, 7, 1),
(4, 'Volvo 290', '../product/4.jpg', 2500, 29600, '1.4', '7.56', '194', '0', 0, 9, 1),
(5, 'Tvex 140W', '../product/5.png', 2125, 14400, '0.8', '5.15', '122', '8.1 x 2.5 x 3.1', 0, 3, 2),
(6, 'Volvo EW140', '../product/6.jpg', 2125, 16850, '0.7', '5.72', '142', '0', 35, 14, 2),
(7, 'Komatsu PW180-7', '../product/7.jpg', 2250, 18440, '1.1', '5.46', '148', '8.9 x 3.7 x 2.5', 0, 11, 2),
(8, 'Hitachi ZX190W-5A', '../product/8.jpg', 2350, 19800, '0.8', '5.83', '153', '0', 35, 1, 2),
(9, 'Hyundai R60W-9S', '../product/9.png', 1225, 5500, '0.18', '3.56', '53', '1.9 x 6.1 x 2.8', 0, 16, 3),
(10, 'TEREX TC 35', '../product/10.jpg', 1313, 3575, '0.26', '3.48', '30', '3.2 x 3.5 x 1.5', 0, 13, 3),
(11, 'Hitachi ZX50', '../product/11.jpg', 1415, 4510, '0.22', '3.98', '36', '5.4 x 2 x 2.5', 0, 10, 3),
(12, 'Yanmar VIO 57', '../product/12.jpg', 1625, 5700, '0.19', '3.8', '58', '5.5 x 1.9 x 2.5', 0, 14, 3),
(13, 'Terex 860', '../product/13.jpg', 2000, 7370, '1', '5.83', '100', '0', 41, 5, 4),
(14, 'JCB 3CX Super', '../product/14.jpg', 2125, 8425, '1.1', '5.69', '92', '0', 30, 8, 4),
(15, 'JCB 3CX Super', '../product/15.jpg', 2250, 8500, '1', '4.05', '85', '0', 28, 10, 4),
(16, 'Hidromek HMK 102B', '../product/16.jpg', 2000, 9100, '1.1', '5.8', '100', '0', 40, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Rent`
--

CREATE TABLE IF NOT EXISTS `Rent` (
  `id_rent` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `id_moder_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rent`),
  KEY `id_user` (`id_user`),
  KEY `id_product` (`id_product`),
  KEY `id_status` (`id_status`),
  KEY `id_moder_status` (`id_moder_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `Rent`
--

INSERT INTO `Rent` (`id_rent`, `id_user`, `id_product`, `price`, `date`, `time`, `id_status`, `id_moder_status`) VALUES
(1, 1, 1, 221400, '2025-11-20', 123, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE IF NOT EXISTS `Reviews` (
  `id_review` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text,
  `date` date DEFAULT NULL,
  `id_moder_status` int(11) DEFAULT NULL,
  `show_first_name` tinyint(1) NOT NULL DEFAULT '0',
  `show_last_name` tinyint(1) NOT NULL DEFAULT '0',
  `show_patronymic` tinyint(1) NOT NULL DEFAULT '0',
  `show_login` tinyint(1) NOT NULL DEFAULT '0',
  `id_rent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_review`),
  KEY `id_user` (`id_user`),
  KEY `id_moder_status` (`id_moder_status`),
  KEY `fk_rent_review` (`id_rent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`id_review`, `id_user`, `rating`, `comment`, `date`, `id_moder_status`, `show_first_name`, `show_last_name`, `show_patronymic`, `show_login`, `id_rent`) VALUES
(1, 2, 5, 'Самые нормальные цены у ребят на такую технику. Пару раз уже брали экскаватор- погрузчик, и территорию выравнивали, и траншеи копали. Работает техника на «ура»: достаточно мощные, не глохнут, заводятся с полоборота, маневренность хорошая, работают практически как нулевые. Как клиенты — мы очень довольны сотрудничеством с компанией.', '2023-02-06', 2, 1, 0, 0, 0, 1),
(2, 3, 4, 'Заказывал эту машинку для сноса старого дедовского дома и со своей работой она справилась более чем достойно. Мало разбираюсь в работе экскаваторов, особенно когда к ним еще и крепится этот «разрушитель», благо здесь нам на помощь пришел водитель, который терпило выслушивал таких неумех и прекрасно справился со своей работой, мужик вообще оказался хороший, с ним и поговорить и пошутить можно.Работой, людьми остался доволен.', '2023-05-07', 2, 1, 0, 0, 0, 1),
(3, 4, 4, 'Для стройки необходим колесный эскаватор, удобнее всего брать в аренду на время — поэтому арендовал у этой компании Jcb Js 160w — один из \r\nсамых практичных аппаратов в строительной области. Необычайно удобен в эксплуатации и надёжен, повышает работоспособность на стройке и ускоряет её процесс.\r\nСамое главное достоинство — простота аренды техники на этом сервисе, а также доступные цены и оперативность оформления заказа.', '2023-06-20', 2, 1, 1, 0, 0, 1),
(4, 5, 5, 'Пользовались услугами данного автокрана уже не в первый раз. Обычно мы разгружаем им разного рода плиты. Скорость работы крана устраивает вполне. На нем работает отличный крановщик, который очень хорошо справляется с поставленными задачами. Машина нового уровня, в работе просто зверь. Аренда вполне нормальная, как по не. Спасибо огромное за такую хорошую аренду.', '2023-07-22', 2, 1, 0, 0, 0, 1),
(5, 6, 4, 'Занимаемся строительными работами, естественно, нам постоянно нужен транспорт. По грузоподъемности и объему эти самосвалы самые подходящие. Радует, что техника в отличном состоянии, за полгода работы ни разу не было у нас проблем с машинами, под наши заказы всегда  находят свободную машину, приятно работать с людьми.', '2023-08-11', 2, 1, 0, 0, 0, 1),
(6, 7, 4, 'На подмосковной даче делали индивидуальную систему водоподведения. Копали скважину для насосной станции. Вручную, конечно, это непосильно, поэтому заказали данный мини-экскаватор. Выбрали именно эту фирму по рекомендации, но перед этим ещё очень долго мониторили рынок. Здесь оказались самые приемлемые цены. И качество работы тоже достойное.', '2023-02-06', 2, 1, 0, 0, 0, 1),
(7, 8, 5, 'Брал однажды эту крошку в аренду, работает без поломок, отлично. Большая вместимость ковша, а также проходимость и устойчивость на уровне. Водитель — мужик вежливый и понятливый, мы с ним сразу нашли общий язык, не халтурил и не пытался обмануть. Все цены такие, как на сайте.', '2023-10-13', 2, 0, 0, 0, 1, 1),
(8, 9, 5, 'У нас небольшая строительная фирма. Постоянно заказываем услуги данного экскаватора. ОН очень устойчивый и самое главное работает на хорошей скорости. Цена за день вполне адекватная. Ту работу которую он может выполнить за день, по деньгам все оправдывается. Машина просто мощь. Спасибо за такие выгодные предложения. ', '2023-12-07', 2, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Rules`
--

CREATE TABLE IF NOT EXISTS `Rules` (
  `id_rule` int(11) NOT NULL AUTO_INCREMENT,
  `name_rule` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Rules`
--

INSERT INTO `Rules` (`id_rule`, `name_rule`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `Status`
--

CREATE TABLE IF NOT EXISTS `Status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Status`
--

INSERT INTO `Status` (`id_status`, `name_status`) VALUES
(1, 'open'),
(2, 'close'),
(3, 'ban');

-- --------------------------------------------------------

--
-- Table structure for table `Types`
--

CREATE TABLE IF NOT EXISTS `Types` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Types`
--

INSERT INTO `Types` (`id_type`, `type`) VALUES
(1, 'excavator'),
(2, 'bulldozer'),
(3, 'crane'),
(4, 'truck');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `id_rule` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_rule` (`id_rule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id_user`, `login`, `phone`, `email`, `password`, `first_name`, `last_name`, `patronymic`, `id_rule`) VALUES
(1, 'admin', '+7(996)966-69-13', 'charadream13@gmail.com', 'admintex', 'chara', 'dream', 'none', 1),
(2, 'bot1', '80000000001', 'bot1@bot.bot', 'botbot', 'Аркадий', 'Бот', 'Бот', 2),
(3, 'bot2', '80000000002', 'bot2@bot.bot', 'botbot', 'Егор', 'Бот', 'Бот', 2),
(4, 'bot3', '80000000003', 'bot3@bot.bot', 'botbot', 'Андрей', 'Воронцов', 'Бот', 2),
(5, 'bot4', '80000000004', 'bot4@bot.bot', 'botbot', 'Антон', 'Бот', 'Бот', 2),
(6, 'bot5', '80000000005', 'bot5@bot.bot', 'botbot', 'Константин', 'Бот', 'Бот', 2),
(7, 'bot6', '80000000006', 'bot6@bot.bot', 'botbot', 'Дмитрий', 'Бот', 'Бот', 2),
(8, 'Nikkey', '80000000007', 'bot7@bot.bot', 'botbot', 'Бот', 'Бот', 'Бот', 2),
(9, 'bot8', '80000000008', 'bot8@bot.bot', 'botbot', 'Саша', 'Бот', 'Бот', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `fk_product_type` FOREIGN KEY (`id_type`) REFERENCES `types` (`id_type`);

--
-- Constraints for table `Rent`
--
ALTER TABLE `Rent`
  ADD CONSTRAINT `rent_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `rent_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`),
  ADD CONSTRAINT `rent_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `rent_ibfk_4` FOREIGN KEY (`id_moder_status`) REFERENCES `admin` (`id_moder_status`);

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `fk_rent_review` FOREIGN KEY (`id_rent`) REFERENCES `rent` (`id_rent`),
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`id_moder_status`) REFERENCES `admin` (`id_moder_status`);

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_rule`) REFERENCES `rules` (`id_rule`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
