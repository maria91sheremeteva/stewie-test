-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 08 2017 г., 21:26
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `status` enum('new','done') NOT NULL COMMENT 'new - новый, done - завершен',
  `finish_date` datetime NOT NULL COMMENT 'ставится, когда заказ оплачен и товары выданы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заказы';

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `status`, `finish_date`) VALUES
(1, 'new', '2017-01-04 21:25:17'),
(2, 'done', '2017-01-04 21:25:31'),
(3, 'new', '2017-02-09 21:25:40'),
(4, 'new', '2017-02-15 21:25:47'),
(5, 'done', '2017-02-13 21:25:57');

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `summa` decimal(10,2) NOT NULL COMMENT 'цена продажи позиции'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Позиции по заказу';

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `summa`) VALUES
(1, 1, 2, '30000.00'),
(2, 2, 3, '5000.00'),
(3, 1, 4, '2000.00'),
(4, 3, 3, '6000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `order_id` int(11) NOT NULL,
  `summa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Оплаты по заказам';

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `date`, `order_id`, `summa`) VALUES
(1, '2017-02-14 21:29:20', 1, '6000.00'),
(2, '2017-02-01 21:29:38', 3, '2000.00'),
(3, '2017-02-13 21:31:57', 2, '3000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `product_item`
--

CREATE TABLE `product_item` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_item_id` int(11) DEFAULT NULL COMMENT 'позиция заказа или null',
  `status` enum('free','order') NOT NULL COMMENT ' free позиция на складе, order — в заказе (выдан)',
  `price` decimal(10,2) NOT NULL COMMENT ' сумма закупки товара'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Позиции склада';

--
-- Дамп данных таблицы `product_item`
--

INSERT INTO `product_item` (`id`, `product_id`, `order_item_id`, `status`, `price`) VALUES
(1, 2, 3, 'free', '6000.00'),
(2, 3, 3, 'order', '3000.00'),
(3, 3, 2, 'order', '2000.00'),
(4, 3, 0, 'free', '5000.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
