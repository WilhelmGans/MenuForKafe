-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 27 2021 г., 10:37
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kaferew`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'login',
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_user` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `colorinterface` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'white',
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT '/resources/images/icon-admin.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `name`, `password`, `type_user`, `colorinterface`, `img_url`) VALUES
(1, 'vlad', 'Vladislav', '$2y$10$btkUFlg/I.PEpvupieKCyeJfyb1YpzTg6PZVz20RERzgpsiQlmf52', '1', 'white', '/resources/images/icon-admin.png'),
(5, 'user', 'user', '$2y$10$k.P4ZNavqZ9Tq7YCZc8TsOJOZQ2aa2EdK0TAG4YpIpY1/6l10RsiO', '0', 'white', '/resources/images/icon-admin.png'),
(6, 'admin', 'ÐÐ´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ‚Ð¾Ñ€', '$2y$10$kNsAV6zvSsuywcXXBtPPtO0xiFE6TU5RE4g75TCONfCQ1DwnWaJyy', '1', 'white', '/resources/images/icon-admin.png');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name_cat` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'иное',
  `name_cat_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mass_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'грамм'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name_cat`, `name_cat_en`, `mass_name`) VALUES
(37, 'Ð¥Ð¾Ð»Ð¾Ð´Ð½Ñ‹Ðµ Ð·Ð°ÐºÑƒÑÐºÐ¸ Ð¸ Ð¡Ð°Ð»Ð°Ñ‚Ñ‹', NULL, 'грамм'),
(39, 'Ð¡ÑƒÐ¿Ñ‹', NULL, 'грамм'),
(40, 'Ð¤Ñ€Ð¸', NULL, 'грамм'),
(41, 'Ð“Ð¾Ñ€ÑÑ‡Ð¸Ðµ Ð±Ð»ÑŽÐ´Ð° Ð¸ Ð·Ð°ÐºÑƒÑÐºÐ¸', NULL, 'грамм'),
(43, 'ÐœÐ¾Ñ€Ð¾Ð¶ÐµÐ½Ð¾Ðµ', NULL, 'грамм'),
(44, 'Ð³Ð°Ñ€Ð½Ð¸Ñ€Ñ‹', NULL, 'грамм'),
(45, 'Ñ‡Ð°Ð¹', NULL, 'грамм'),
(46, 'ÐºÐ¾Ñ„Ðµ', NULL, 'грамм'),
(47, 'ÑÐ¾ÐºÐ¸', NULL, 'грамм'),
(48, 'Ð¿Ð¸Ð²Ð¾', NULL, 'грамм'),
(49, 'Ð’Ð¾Ð´Ð°', NULL, 'грамм'),
(51, 'ÐŸÐ¸Ð²Ð¾ Ð½Ð° Ñ€Ð¾Ð·Ð»Ð¸Ð²', NULL, 'грамм'),
(52, 'Ð§Ð°Ð¹ Ð·Ð°Ð²Ð°Ñ€Ð½Ð¾Ð¹', NULL, 'грамм'),
(53, 'Ð“Ð°Ð·Ð¸Ñ€Ð¾Ð²Ð°Ð½Ð½Ñ‹Ðµ Ð½Ð°Ð¿Ð¸Ñ‚ÐºÐ¸', NULL, 'грамм'),
(54, 'Ð”Ð¾Ð¿Ð¾Ð»Ð½Ð¸Ñ‚ÐµÐ»ÑŒÐ½Ð¾', NULL, 'грамм'),
(56, 'Ð¡Ð¾ÑƒÑ', NULL, 'грамм'),
(57, 'Ð—Ð°ÐºÑƒÑÐºÐ¸ Ðº Ð¿Ð¸Ð²Ñƒ', NULL, 'грамм'),
(66, 'мясо5', NULL, 'грамм'),
(67, 'Пиво из фишек', NULL, 'грамм');

-- --------------------------------------------------------

--
-- Структура таблицы `categories_screen`
--

CREATE TABLE `categories_screen` (
  `id` int(11) NOT NULL,
  `id_screen` int(11) NOT NULL,
  `id_categories` int(11) NOT NULL,
  `category_screen_positions` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories_screen`
--

INSERT INTO `categories_screen` (`id`, `id_screen`, `id_categories`, `category_screen_positions`) VALUES
(80, 13, 40, 2),
(81, 14, 56, 1),
(82, 14, 51, 2),
(85, 14, 67, 1),
(86, 27, 37, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `sum_fast_screen` int(11) NOT NULL,
  `sum_template_screen` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`id`, `sum_fast_screen`, `sum_template_screen`) VALUES
(1, 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visible` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `id_cat`, `name`, `name_en`, `mass`, `price`, `visible`) VALUES
(118, 37, 'ÑÐ°Ð»Ð°Ñ‚ Ñ†ÐµÐ·Ð°Ñ€ÑŒ Ñ ÐºÑƒÑ€Ð¸Ñ†ÐµÐ¹', NULL, '250', '450', 'yes'),
(120, 37, 'ÑÐ°Ð»Ð°Ñ‚ Ð³Ñ€ÐµÑ‡ÐµÑÐºÐ¸Ð¹', NULL, '250', '350', 'yes'),
(126, 39, 'Ð‘Ð¾Ñ€Ñ‰ Ñ Ð³Ð¾Ð²ÑÐ´Ð¸Ð½Ð¾Ð¹', NULL, '250/30', '350', 'yes'),
(127, 39, 'Ð Ð°Ð¼ÐµÐ½ Ð¾ÑÑ‚Ñ€Ñ‹Ð¹ ', NULL, '500', '350', 'yes'),
(128, 39, 'ÐžÐºÑ€Ð¾ÑˆÐºÐ° ', NULL, '300', '250', 'no'),
(129, 40, 'ÐšÐ°Ð»ÑŒÐ¼Ð°Ñ€ Ñ„Ñ€Ð¸', NULL, '200', '250', 'yes'),
(130, 40, 'Ð¡Ñ‹Ñ€Ð½Ñ‹Ðµ Ð¿Ð°Ð»Ð¾Ñ‡ÐºÐ¸', NULL, '150/30', '300', 'yes'),
(131, 40, 'Ð½Ð°Ð³ÐµÑ‚ÑÑ‹ ÐºÑƒÑ€Ð¸Ð½Ñ‹Ðµ', NULL, '150/30', '300', 'yes'),
(132, 40, 'Ð“Ñ‘Ð´Ð·Ð° ÑÐ¾ ÑÐ²Ð¸Ð½Ð¸Ð½Ð¾Ð¹', NULL, '200/50', '350', 'yes'),
(133, 40, 'Ð“Ñ‘Ð´Ð·Ð° Ð¾ÑÑ‚Ñ€Ñ‹Ðµ', NULL, '180/50', '350', 'yes'),
(134, 40, 'Ð“Ñ‘Ð´Ð·Ð° Ñ Ð¼Ð¾Ñ€ÐµÐ¿Ñ€Ð¾Ð´ÑƒÐºÑ‚Ð°Ð¼Ð¸', NULL, '180/50', '350', 'yes'),
(135, 41, 'ÐšÐµÑÐ°Ð´Ð¸Ð»ÑŒÑ Ñ ÐºÑƒÑ€Ð¸Ñ†ÐµÐ¹', NULL, '300/50/30', '450', 'yes'),
(137, 41, 'Ð“Ð°Ð¼Ð±ÑƒÑ€Ð³ÐµÑ€ Ñ ÐºÐ°Ñ€Ñ‚Ð¾Ñ„ÐµÐ»ÐµÐ¼ Ñ„Ñ€Ð¸ Ð¸ ÐºÐµÑ‚Ñ‡ÑƒÐ¿Ð¾Ð¼', NULL, '300/100/30', '400', 'yes'),
(138, 41, 'Ð§Ð¸Ð·Ð±ÑƒÑ€Ð³ÐµÑ€ Ñ ÐºÐ°Ñ€Ñ‚Ð¾Ñ„ÐµÐ»ÐµÐ¼ Ñ„Ñ€Ð¸ Ð¸ ÐºÐµÑ‚Ñ‡ÑƒÐ¿Ð¾Ð¼', NULL, '300/100/30', '400', 'yes'),
(140, 41, 'Ð¨Ð°ÑˆÐ»Ñ‹Ñ‡ÐºÐ¸ Ð¸Ð· ÐºÑƒÑ€Ð¸Ñ†Ñ‹ Ñ ÑÐ¾ÑƒÑÐ¾Ð¼ Ð¢ÐµÑ€Ñ€Ð¸ÑÐºÐ¸ (Ð²Ñ€ÐµÐ¼Ñ Ð¾Ð¶Ð¸Ð´Ð°Ð½Ð¸Ñ Ð½Ðµ Ð¼ÐµÐ½ÐµÐµ 15 Ð¼Ð¸Ð½ÑƒÑ‚)', NULL, '150/100', '400', 'yes'),
(146, 41, 'ÐšÐ¸Ð¼-Ñ‡Ð¸ Ð¶Ð°Ñ€ÐµÐ½Ð°Ñ ÑÐ¾ ÑÐ²Ð¸Ð½Ð¸Ð½Ð¾Ð¹(Ð²Ñ€ÐµÐ¼Ñ Ð¾Ð¶Ð¸Ð´Ð°Ð½Ð¸Ñ Ð½Ðµ Ð¼ÐµÐ½ÐµÐµ 15 Ð¼Ð¸Ð½ÑƒÑ‚)', NULL, '300', '350', 'yes'),
(147, 41, 'Ñ‡Ð°Ð¿-Ñ‡Ðµ', NULL, '350', '400', 'yes'),
(148, 44, 'Ð§ÐµÑÐ½Ð¾Ñ‡Ð½Ñ‹Ðµ Ð³Ñ€ÐµÐ½ÐºÐ¸', NULL, '150', '150', 'yes'),
(149, 44, 'ÐšÐ°Ñ€Ñ‚Ð¾Ñ„ÐµÐ»ÑŒ Ñ„Ñ€Ð¸', NULL, '150', '250', 'yes'),
(150, 44, 'Ñ€Ð¸Ñ', NULL, '150', '50', 'yes'),
(152, 43, 'Ð¨Ð¾ÐºÐ¾Ð»Ð°Ð´Ð½Ð¾Ðµ, ÐºÐ»ÑƒÐ±Ð½Ð¸Ñ‡Ð½Ð¾Ðµ, Ð°Ð±Ñ€Ð¸ÐºÐ¾ÑÐ¾Ð²Ð¾Ðµ, Ð²Ð°Ð½Ð¸Ð»ÑŒÐ½Ð¾Ðµ, ÑÐ¼Ð¾Ñ€Ð¾Ð´Ð¸Ð½Ð°', NULL, '50', '100', 'yes'),
(159, 47, 'Ð¢Ð¾Ð¼Ð°Ñ‚Ð½Ñ‹Ð¹', NULL, '200', '50', 'yes'),
(160, 47, 'ÐÐ¿ÐµÐ»ÑŒÑÐ¸Ð½Ð¾Ð²Ñ‹Ð¹', NULL, '200', '50', 'yes'),
(161, 47, 'Ð¯Ð±Ð»Ð¾Ñ‡Ð½Ñ‹Ð¹', NULL, '200', '50', 'yes'),
(162, 47, 'ÐœÑƒÐ»ÑŒÑ‚Ð¸Ñ„Ñ€ÑƒÐºÑ‚', NULL, '200', '50', 'yes'),
(164, 49, 'Ð‘Ð¾Ð½ ÐÐºÐ²Ð° Ð³Ð°Ð· / Ð±ÐµÐ· Ð³Ð°Ð·Ð°', NULL, '500', '100', 'yes'),
(166, 45, 'Ð¤ÑŒÑŽÐ· ÐºÐ»ÑƒÐ±Ð½Ð¸ÐºÐ°-Ð¼Ð°Ð»Ð¸Ð½Ð°', NULL, '500', '150', 'yes'),
(168, 48, 'Ð’ÐµÐ»ÐºÐ¾Ð¿Ð¾Ð¿Ð¾Ð²Ð¸Ñ†ÐºÐ¸Ð¹ ÐºÐ¾Ð·ÐµÐ» ÑÐ²ÐµÑ‚Ð»Ð¾Ðµ', NULL, '450', '200', 'yes'),
(169, 48, 'Ð’ÐµÐ»ÐºÐ¾Ð¿Ð¾Ð¿Ð¾Ð²Ð¸Ñ†ÐºÐ¸Ð¹ ÐºÐ¾Ð·ÐµÐ» Ñ‚ÐµÐ¼Ð½Ð¾Ðµ', NULL, '450', '200', 'yes'),
(170, 48, 'Ð¡Ñ‚ÐµÐ»Ð»Ð° ÐÑ€Ñ‚ÑƒÐ°', NULL, '500', '250', 'yes'),
(171, 48, 'Ð¥ÐµÐ¹Ð½ÐµÐºÐµÐ½', NULL, '470', '300', 'yes'),
(172, 48, 'Ð¥ÑƒÐ³Ð°Ñ€Ð´ÐµÐ½', NULL, '470', '350', 'yes'),
(174, 48, 'Ð’Ð°Ð¹ÑÐ±ÐµÑ€Ð³ Ð±ÐµÐ·Ð°Ð»ÐºÐ¾Ð³Ð¾Ð»ÑŒÐ½Ð¾Ðµ', NULL, '500', '200', 'yes'),
(176, 45, 'Ð¤ÑŒÑŽÐ· ÐœÐ°Ð½Ð³Ð¾-Ñ€Ð¾Ð¼Ð°ÑˆÐºÐ°', NULL, '500', '150', 'yes'),
(177, 45, 'Ð¤ÑŒÑŽÐ· Ð¯Ð±Ð»Ð¾ÐºÐ¾ - ÐšÐ¸Ð²Ð¸', NULL, '500', '150', 'yes'),
(178, 46, 'ÐÐ¼ÐµÑ€Ð¸ÐºÐ°Ð½Ð¾', NULL, '200', '200', 'yes'),
(179, 46, 'ÐšÐ°Ð¿ÑƒÑ‡Ð¸Ð½Ð¾', NULL, '200', '200', 'yes'),
(180, 46, 'Ð›Ð°Ñ‚Ñ‚Ðµ', NULL, '200', '200', 'yes'),
(181, 46, 'Ð­ÑÐ¿Ñ€ÐµÑÑÐ¾', NULL, '25', '150', 'yes'),
(182, 53, 'Ð¤Ð°Ð½Ñ‚Ð° ', NULL, '500', '150', 'yes'),
(183, 53, 'ÐšÐ¾ÐºÐ°-ÐºÐ¾Ð»Ð°', NULL, '500', '150', 'yes'),
(184, 53, 'Ð¡Ð¿Ñ€Ð°Ð¹Ñ‚', NULL, '500', '150', 'yes'),
(187, 49, 'Ð‘Ð¾Ð½ ÐÐºÐ²Ð° Ð¯Ð±Ð»Ð¾ÐºÐ¾ / Ð›Ð¸Ð¼Ð¾Ð½ / Ð»Ð°Ð¹Ð¼', NULL, '500', '150', 'yes'),
(188, 52, 'Ð”Ð¸Ð¼Ð±ÑƒÐ»Ð°- Ñ‚Ñ€Ð°Ð´Ð¸Ñ†Ð¸Ð¾Ð½Ð½Ð¾ Ñ‡ÐµÑ€Ð½Ñ‹Ð¹ Ñ†ÐµÐ¹Ð»Ð¾Ð½ÑÐºÐ¸Ð¹', NULL, '200', '100', 'yes'),
(189, 52, 'Ð®Ð°Ð½ÑŒ Ð¸Ð·ÑƒÐ¼Ñ€ÑƒÐ´Ð½Ñ‹Ð¹ - ÐºÐ¸Ñ‚Ð°Ð¹ÑÐºÐ¸Ð¹ Ð·ÐµÐ»ÐµÐ½Ñ‹Ð¹', NULL, '200', '100', 'yes'),
(190, 52, 'Ð–Ð°ÑÐ¼Ð¸Ð½Ð¾Ð²Ñ‹Ð¹-ÐºÐ¸Ñ‚Ð°Ð¹ÑÐºÐ¸Ð¹ Ð·ÐµÐ»ÐµÐ½Ñ‹Ð¹', NULL, '200', '100', 'yes'),
(192, 52, 'Ð“Ð¾Ñ€Ð½Ñ‹Ð¹ Ñ‡Ð°Ð±Ñ€ÐµÑ†- Ñ‡ÐµÑ€Ð½Ñ‹Ð¹ Ñ Ð»ÐµÐ¿ÐµÑÑ‚ÐºÐ°Ð¼Ð¸ Ð²Ð°ÑÐ¸Ð»ÑŒÐºÐ°', NULL, '200', '100', 'yes'),
(193, 52, 'Ð¯Ð³Ð¾Ð´Ð°-Ð¼Ð°Ð»Ð¸Ð½Ð° - Ñ„Ñ€ÑƒÐºÑ‚Ð¾Ð²Ñ‹Ð¹ ÑÐ±Ð¾Ñ€', NULL, '200', '100', 'yes'),
(194, 52, 'Ð‘Ñ€ÑƒÑÐ½Ð¸Ñ‡Ð½Ñ‹Ð¹ Ð»ÐµÑ - ÑÐ³Ð¾Ð´Ð½Ñ‹Ð¹ ÑÐ±Ð¾Ñ€', NULL, '200', '100', 'yes'),
(196, 52, 'ÐœÐ°Ð»Ð¸Ð½Ð¾Ð²Ð°Ñ Ð¼ÑÑ‚Ð° - Ñ‚Ñ€Ð°Ð²ÑÐ½Ð¾Ð¹ ÑÐ±Ð¾Ñ€ ', NULL, '200', '100', 'yes'),
(198, 51, 'Ð’Ð°Ð¹Ñ Ð±ÐµÑ€Ð³', NULL, '500', '300', 'yes'),
(199, 54, 'Ð¡Ð¸Ñ€Ð¾Ð¿ \"ÐœÐ¾Ð½Ð¸Ð½\" Ð² Ð°ÑÑÐ¾Ñ€Ñ‚Ð¸Ð¼ÐµÐ½Ñ‚Ðµ', NULL, '30', '50', 'yes'),
(200, 54, 'ÐšÑ€Ð¾ÑˆÐºÐ°  Ñ‚ÐµÐ¼Ð½Ñ‹Ð¹ ÑˆÐ¾ÐºÐ¾Ð»Ð°Ð´', NULL, '10', '50', 'yes'),
(201, 54, 'ÐšÑ€Ð¾ÑˆÐºÐ° Ð±ÐµÐ»Ñ‹Ð¹ ÑˆÐ¾ÐºÐ¾Ð»Ð°Ð´', NULL, '10', '50', 'yes'),
(202, 41, 'ÐšÑƒÑ€Ð¸Ð½Ñ‹Ðµ ÐºÑ€Ñ‹Ð»Ñ‹ÑˆÐºÐ¸ Ð±Ð°Ñ€Ð±ÐµÐºÑŽ (Ð²Ñ€ÐµÐ¼Ñ Ð¾Ð¶Ð¸Ð´Ð°Ð½Ð¸Ñ Ð½Ðµ Ð¼ÐµÐ½ÐµÐµ 15 Ð¼Ð¸Ð½ÑƒÑ‚)', NULL, '300/60', '500', 'yes'),
(205, 56, 'Ð§Ð¸Ð»Ð¸', NULL, '30', '30', 'yes'),
(206, 56, 'Ð¡Ð¾ÐµÐ²Ñ‹Ð¹', NULL, '30', '30', 'yes'),
(207, 56, 'Ð§ÐµÑÐ½Ð¾Ñ‡Ð½Ñ‹Ð¹', NULL, '30', '50', 'yes'),
(208, 56, 'ÐšÐµÑ‚Ñ‡ÑƒÐ¿', NULL, '30', '30', 'yes'),
(209, 41, 'ÐšÐ¾Ð»Ð±Ð°ÑÐºÐ¸ Ð¼ÑÑÐ½Ñ‹Ðµ Ñ ÐºÐ°Ñ€Ñ‚Ð¾Ñ„ÐµÐ»ÐµÐ¼', NULL, '170/100/50', '450', 'yes'),
(212, 54, 'Ð¡Ð°Ñ…Ð°Ñ€', NULL, '10', '10', 'yes'),
(213, 54, 'Ð›Ð¸Ð¼Ð¾Ð½', NULL, '10', '10', 'yes'),
(214, 49, 'ÐÐºÐ²Ð° ÑˆÐµÐ»ÑŒÑ„', NULL, '500', '50', 'yes'),
(219, 51, 'ÐÑÐ°Ñ…Ð¸  ÑÐ²ÐµÑ‚Ð»Ð¾Ðµ', NULL, '330', '300', 'yes'),
(221, 51, 'ÐÑÐ°Ñ…Ð¸. ÑÐ²ÐµÑ‚Ð»Ð¾Ðµ', NULL, '500', '500', 'yes'),
(222, 44, 'Ð¥Ð»ÐµÐ±', NULL, '30', '5', 'yes'),
(230, 57, 'ÑÑƒÑ…Ð°Ñ€Ð¸ÐºÐ¸  Ð² Ð°ÑÑÐ¾Ñ€Ñ‚Ð¸Ð¼ÐµÐ½Ñ‚Ðµ', NULL, '40', '50', 'yes'),
(234, 57, 'ÐºÑ€ÐµÐ²ÐµÑ‚ÐºÐ° Ðº Ð¿Ð¸Ð²Ñƒ', NULL, '250', '450', 'yes'),
(237, 57, 'Ð§Ð¸Ð¿ÑÑ‹  \"Ð‘Ð¸Ð½Ð³Ñ€Ñ\"', NULL, '50', '120', 'yes'),
(238, 57, 'Ð°Ñ€Ð°Ñ…Ð¸Ñ ÑÐ¾Ð»ÐµÐ½Ñ‹Ð¹', NULL, '60', '100', 'yes'),
(239, 57, 'Ð¡Ñ‚Ñ€ÑƒÐ¶ÐºÐ° ÐºÐ°Ð»ÑŒÐ¼Ð°Ñ€Ð°', NULL, '50', '150', 'yes'),
(240, 57, 'Ð¡Ð¾Ð»Ð¾Ð¼ÐºÐ° Ð³Ð¾Ñ€Ð±ÑƒÑˆÐ¸', NULL, '50', '150', 'yes'),
(246, 39, 'Ð‘ÑƒÐ»ÑŒÐ¾Ð½ Ñ ÑÐ¹Ñ†Ð¾Ð¼', NULL, '250/40', '250', 'yes'),
(247, 57, 'ÐÐµÑ€ÐºÐ° Ñ/Ñ Ñ Ð³Ñ€ÐµÐ½ÐºÐ°Ð¼Ð¸', NULL, '60/40', '350', 'yes'),
(248, 57, 'Ð¤Ð¾Ñ€ÐµÐ»ÑŒ  Ñ/Ñ Ñ  Ð³Ñ€ÐµÐ½ÐºÐ°Ð¼Ð¸', NULL, '60/40', '350', 'yes'),
(250, 47, 'Ð»Ð¸Ð¼Ð¾Ð½Ð°Ð´ ', NULL, '200', '50', 'yes'),
(252, 39, 'ÐŸÐµÐ»ÑŒÐ¼ÐµÐ½Ð¸ Ð¼ÑÑÐ½Ñ‹Ðµ Ñ Ð±ÑƒÐ»ÑŒÐ¾Ð½Ð¾Ð¼ (Ð²Ñ€ÐµÐ¼Ñ Ð¿Ñ€Ð¸Ð³Ð¾Ñ‚Ð¾Ð²Ð»ÐµÐ½Ð¸Ñ Ð½Ðµ Ð¼ÐµÐ½ÐµÐµ 20 Ð¼Ð¸Ð½ÑƒÑ‚)', NULL, '350', '250', 'yes'),
(254, 43, 'ÐšÐ¾ÐºÑ‚ÐµÐ¹Ð»ÑŒ Ð¼Ð¾Ð»Ð¾Ñ‡Ð½Ñ‹Ð¹(ÑˆÐ¾ÐºÐ¾Ð»Ð°Ð´, Ð²Ð°Ð½Ð¸Ð»ÑŒ, ÐºÐ»ÑƒÐ±Ð½Ð¸ÐºÐ°, ÑÐ¼Ð¾Ñ€Ð¾Ð´Ð¸Ð½Ð°)', NULL, '200', '150', 'yes'),
(255, 54, 'Ð‘Ð»Ð¸Ð½Ñ‡Ð¸ÐºÐ¸ (ÑÐ¼ÐµÑ‚Ð°Ð½Ð°, ÑÐ³ÑƒÑ‰ÐµÐ½Ð½Ð¾Ðµ Ð¼Ð¾Ð»Ð¾ÐºÐ¾, Ð°Ð¿ÐµÐ»ÑŒÑÐ¸Ð½Ð¾Ð²Ð¾Ðµ Ð²Ð°Ñ€ÐµÐ½ÑŒÐµ, Ñ‚Ð¾Ð¿Ð¸Ð½Ð³Ð¸)', NULL, '150/30', '150', 'yes'),
(256, 45, 'Ñ„ÑŒÑŽÐ· Ð»ÐµÑÐ½Ñ‹Ðµ ÑÐ³Ð¾Ð´Ñ‹-Ð³Ð¸Ð±Ð¸ÑÐºÑƒÑ', NULL, '500', '150', 'yes'),
(257, 45, 'Ñ„ÑŒÑŽÐ· Ð»Ð¸Ð¼Ð¾Ð½-Ð»ÐµÐ¼Ð¾Ð½Ð³Ñ€Ð°ÑÑ', NULL, '500', '150', 'yes'),
(258, 48, 'Ð‘Ð»Ð°Ð½Ñˆ Ð±Ð¸Ñ€', NULL, '500', '250', 'yes'),
(259, 66, 'пиво1', NULL, '15', '51', 'yes'),
(260, 66, 'пиво199', NULL, '15', '51', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `screen`
--

CREATE TABLE `screen` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL COMMENT 'номер экрана',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'имя экрана',
  `type_template` int(11) NOT NULL DEFAULT 1 COMMENT 'тип шаблона ',
  `screen_active` int(11) NOT NULL DEFAULT 1 COMMENT 'статус меню на экране',
  `img_active` int(11) NOT NULL DEFAULT 0 COMMENT 'картинка заднего фона активного экрана',
  `img_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ссылка на картинку',
  `bg_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mdb-color darken-3' COMMENT 'цвет заднего фона экрана',
  `text_title_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text-warning' COMMENT 'цвет заголовка',
  `text_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '	text-white' COMMENT 'цвет основного текста',
  `fast_access` int(11) NOT NULL DEFAULT 0 COMMENT 'отображение в navbar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `screen`
--

INSERT INTO `screen` (`id`, `number`, `name`, `type_template`, `screen_active`, `img_active`, `img_url`, `bg_color`, `text_title_color`, `text_color`, `fast_access`) VALUES
(1, 1, 'Еда3', 1, 1, 0, '/manager/resources/upload/0218c9996944683eb19806d30cdcce11.jpg', '	mdb-color darken-3	', '	text-warning	', '	text-white	', 1),
(12, 2, 'ad', 2, 1, 1, '/manager/resources/upload/00f915c29d48531c515701337f8e4883.jpg', 'mdb-color darken-3', '	text-danger	', '	text-danger	', 1),
(13, 3, 'asd', 1, 1, 0, NULL, 'mdb-color darken-3', 'text-warning', '	text-white', 1),
(14, 4, 'asdasd', 1, 1, 0, NULL, 'mdb-color darken-3', 'text-warning', '	text-white', 1),
(27, 7, 'asd', 1, 1, 0, NULL, 'mdb-color darken-3', 'text-warning', '	text-white', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories_screen`
--
ALTER TABLE `categories_screen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_screen` (`id_screen`,`id_categories`),
  ADD KEY `id_categories` (`id_categories`);

--
-- Индексы таблицы `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`,`id_cat`) USING BTREE,
  ADD KEY `id_cat` (`id_cat`);

--
-- Индексы таблицы `screen`
--
ALTER TABLE `screen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT для таблицы `categories_screen`
--
ALTER TABLE `categories_screen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT для таблицы `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT для таблицы `screen`
--
ALTER TABLE `screen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories_screen`
--
ALTER TABLE `categories_screen`
  ADD CONSTRAINT `categories_screen_ibfk_1` FOREIGN KEY (`id_screen`) REFERENCES `screen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_screen_ibfk_2` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
