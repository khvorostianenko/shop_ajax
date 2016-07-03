-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 03 2016 г., 12:16
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shoprk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `categoriesKey` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `showMethod` int(11) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`categoriesKey`, `name`, `showMethod`, `parent`) VALUES
(1, 'Компьютерная техника', 1, 0),
(2, 'Ноутбуки', 1, 1),
(3, 'Планшеты', 3, 1),
(4, 'ПК', 2, 1),
(5, 'Телефоны', 2, 0),
(6, 'Стационарный', 1, 5),
(7, 'Кнопочный', 2, 5),
(8, 'Сенсорный', 3, 5),
(9, 'Камерофоны', 1, 8),
(10, 'IP67', 2, 8),
(11, 'Кухонная Техника', 3, 0),
(12, 'Холодильники', 1, 11),
(13, 'Печи', 2, 11),
(14, 'Духовки', 3, 11),
(15, 'Бытовая Техника', 4, 0),
(16, 'Пылесос', 1, 15),
(17, 'Кондиционер', 2, 15),
(18, 'Телевизор', 3, 15),
(19, 'Детские товары', 5, 0),
(20, 'Игрушки', 1, 19),
(21, 'Памперсы', 2, 19),
(22, 'Питание', 3, 19),
(23, 'Бижутерия', 8, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_tovar` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id_comment`, `id_tovar`, `customer_name`, `time`, `comment`) VALUES
(50, 2, 'Miha', '13:52:55', 'privet'),
(51, 2, 'Miha', '13:53:08', 'privet'),
(52, 2, 'Nana', '13:53:21', 'g'),
(53, 2, 'Nana', '13:53:22', 'g'),
(54, 2, 'Nana', '13:57:24', 'g'),
(55, 2, 'Nana', '14:00:50', 'g'),
(56, 1, 'Sofa', '14:14:55', 'hi'),
(57, 1, 'Sofa', '14:16:09', 'hi'),
(58, 1, 'f', '14:18:12', 'f'),
(59, 1, 'f', '14:19:52', 'f'),
(60, 1, 'Front', '14:34:43', 'priva'),
(61, 1, 'Front End', '14:35:02', 'priva'),
(62, 2, 'Miha', '15:25:21', 'priva'),
(63, 3, 'Da', '15:31:57', 'net'),
(64, 3, 'Da', '15:33:39', 'net'),
(65, 3, 'Da', '15:34:31', 'net'),
(66, 2, 'Mija', '15:42:52', 'gff'),
(67, 3, 'Nana', '15:45:16', 'n'),
(68, 3, 'Nana', '15:51:39', 'n'),
(69, 2, 'j', '15:53:59', 'jjj'),
(70, 2, 'j', '15:58:54', 'jjj'),
(71, 2, 'j', '16:01:25', 'jjj'),
(72, 2, 'j', '16:02:33', 'jjj'),
(73, 2, 'j', '16:07:14', 'jjj'),
(74, 4, 'Misha', '11:56:28', 'pri'),
(75, 4, 'Антон', '12:08:19', 'норм');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id_comment` int(11) NOT NULL,
  `img_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_comment`, `img_path`) VALUES
(59, '&lt;img src=&#039;../../data/images_for_comments/1/59/image0.jpg&#039;&gt;'),
(60, ''),
(62, '&lt;img src=&#039;../../data/images_for_comments/2/62/image0.jpg&#039;&gt;'),
(63, ''),
(64, ''),
(65, ''),
(66, '&lt;img src=&#039;../../data/images_for_comments/2/66/image0.jpg&#039;&gt;'),
(67, ''),
(68, ''),
(69, ''),
(70, ''),
(71, ''),
(72, ''),
(73, '&lt;img src=&#039;../../data/images_for_comments/2/73/image0.jpg&#039;&gt;'),
(74, '&lt;img src=&#039;../../data/images_for_comments/4/74/image0.jpg&#039;&gt;'),
(75, '&lt;img src=&#039;../../data/images_for_comments/4/75/image0.gif&#039;&gt;');

-- --------------------------------------------------------

--
-- Структура таблицы `tovaru`
--

CREATE TABLE `tovaru` (
  `categoriesKey` int(11) NOT NULL,
  `tovaruKey` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `avaliability` tinyint(1) NOT NULL,
  `showMethod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovaru`
--

INSERT INTO `tovaru` (`categoriesKey`, `tovaruKey`, `name`, `price`, `avaliability`, `showMethod`) VALUES
(2, 1, 'AsusLT', 1000, 1, 2),
(2, 2, 'LenovoLT', 800, 1, 3),
(2, 3, 'AppleLT', 1500, 0, 1),
(3, 4, 'LenovoTablet', 100, 1, 2),
(3, 5, 'AppleTablet', 500, 0, 3),
(3, 6, 'SamsungTablet', 400, 1, 1),
(4, 7, 'BrainPC', 1000, 1, 1),
(4, 8, 'ImpressionPC', 1200, 1, 2),
(4, 9, 'ApplePC', 3000, 1, 3),
(6, 10, 'PanasonikTel', 50, 1, 3),
(6, 11, 'SonyTel', 100, 1, 2),
(6, 12, 'HPTel', 120, 1, 1),
(7, 13, 'NokiaMobile', 50, 1, 3),
(7, 14, 'SonyErMobile', 100, 1, 2),
(7, 15, 'Samsung', 50, 0, 1),
(8, 16, 'Iphone', 1000, 1, 3),
(8, 17, 'SamsingSensMob', 500, 1, 4),
(8, 18, 'LenovoSensMob', 300, 1, 2),
(9, 19, 'Iphone 6s', 1200, 1, 1),
(9, 20, 'LenovoCameraPhone', 800, 1, 2),
(10, 21, 'SigmaIP67', 100, 1, 1),
(10, 22, 'NokiaIP67', 200, 1, 2),
(12, 23, 'ZanussiHolod', 500, 1, 2),
(12, 24, 'NordHolod', 600, 0, 1),
(12, 25, 'SamsungHolod', 300, 1, 3),
(13, 26, 'PiramidaPech', 700, 1, 1),
(13, 27, 'IndesitPech', 1600, 0, 2),
(13, 28, 'ZanussiPech', 1300, 1, 3),
(14, 29, 'ZanussiDuh', 300, 1, 2),
(14, 30, 'AristonDuh', 700, 1, 3),
(14, 31, 'SamsungDuh', 200, 0, 4),
(16, 32, 'ZanussiPul', 500, 1, 1),
(16, 33, 'ZalmerPul', 200, 1, 2),
(16, 34, 'SamsungPul', 300, 1, 3),
(17, 35, 'MideaCond', 500, 1, 2),
(17, 36, 'LGCond', 1000, 0, 3),
(17, 37, 'SamsungCond', 800, 1, 4),
(18, 38, 'SamsungTV', 1200, 1, 4),
(18, 39, 'LGTV', 1200, 0, 3),
(18, 40, 'SonyTV', 1800, 1, 1),
(20, 44, 'Lego', 100, 1, 3),
(20, 45, 'Nintendo', 200, 0, 1),
(20, 46, 'PlayStation', 150, 1, 4),
(21, 56, 'Pampers', 20, 1, 4),
(21, 57, 'ActiveBaby', 30, 0, 1),
(21, 58, 'Libero', 18, 1, 2),
(22, 59, 'Смесь', 30, 1, 3),
(22, 60, 'Сок', 10, 1, 2),
(22, 61, 'Каша', 20, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoriesKey`),
  ADD KEY `name` (`name`),
  ADD KEY `orderShow` (`showMethod`),
  ADD KEY `parent` (`parent`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_tovar_index` (`id_tovar`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD KEY `id_comment_index` (`id_comment`);

--
-- Индексы таблицы `tovaru`
--
ALTER TABLE `tovaru`
  ADD PRIMARY KEY (`tovaruKey`),
  ADD KEY `categoriesKey` (`categoriesKey`),
  ADD KEY `name` (`name`),
  ADD KEY `showMethod` (`showMethod`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `categoriesKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `tovaru`
--
ALTER TABLE `tovaru`
  MODIFY `tovaruKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
