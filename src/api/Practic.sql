-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2023 г., 07:51
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Practic`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ClientCategories`
--

CREATE TABLE `ClientCategories` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ClientCategories`
--

INSERT INTO `ClientCategories` (`category_id`, `category_name`) VALUES
(1, 'Standard'),
(2, 'Silver'),
(3, 'Gold'),
(4, 'Platinum');

-- --------------------------------------------------------

--
-- Структура таблицы `Reviews`
--

CREATE TABLE `Reviews` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `score` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Reviews`
--

INSERT INTO `Reviews` (`id`, `id_user`, `user_name`, `title`, `description`, `date`, `score`) VALUES
(6, 1, 'Иван', 'Отличный отдых', 'Прекрасный отель, уютный номер, вежливый персонал. Очень доволен!', '2023-05-10', 5),
(7, 3, 'Мария', 'Хороший сервис', 'Номер был чистым, уютным и комфортным. Завтрак был очень вкусным. Сотрудники отеля были очень приветливы и внимательны. Рекомендую!', '2023-05-12', 4),
(8, 4, 'Петр', 'Плохой интернет', 'Отель был хороший, но интернет был очень медленным. Надеюсь, что улучшат в будущем.', '2023-05-09', 2),
(9, 6, 'Иван', 'Неудачный опыт', 'Я ожидал большего от этого отеля. Номер был не таким чистым, как я ожидал, и персонал был не очень внимательным. Не рекомендую.', '2023-05-08', 2),
(10, 10, 'Анна', 'Отдых с детьми', 'Отель отлично подходит для отдыха с детьми. Есть много игровых зон и мест, где можно провести время с детьми. Номер был чистым и уютным. Рекомендую!', '2023-05-11', 5),
(21, 3, 'Мария', 'Хороший сервис', 'Номер был чистым, уютным и комфортным. Завтрак был очень вкусным. Сотрудники отеля были очень приветливы и внимательны. Рекомендую!', '2023-05-12', 4),
(22, 4, 'Петр', 'Плохой интернет', 'Отель был хороший, но интернет был очень медленным. Надеюсь, что улучшат в будущем.', '2023-05-09', 2),
(23, 1, 'Иван', 'Отличный отдых', 'Прекрасный отель, уютный номер, вежливый персонал. Очень доволен!', '2023-05-10', 5),
(24, 10, 'Анна', 'Отдых с детьми', 'Отель отлично подходит для отдыха с детьми. Есть много игровых зон и мест, где можно провести время с детьми. Номер был чистым и уютным. Рекомендую!', '2023-05-11', 5),
(25, 4, 'Петр', 'Плохой интернет', 'Отель был хороший, но интернет был очень медленным. Надеюсь, что улучшат в будущем.', '2023-05-09', 2),
(26, 10, 'Анна', 'Отдых с детьми', 'Отель отлично подходит для отдыха с детьми. Есть много игровых зон и мест, где можно провести время с детьми. Номер был чистым и уютным. Рекомендую!', '2023-05-11', 5),
(27, 3, 'Мария', 'Хороший сервис', 'Номер был чистым, уютным и комфортным. Завтрак был очень вкусным. Сотрудники отеля были очень приветливы и внимательны. Рекомендую!', '2023-05-12', 4),
(30, 1, 'Иван', 'Отличный отдых', 'Прекрасный отель, уютный номер, вежливый персонал. Очень доволен!', '2023-05-10', 5),
(31, 6, 'Иван', 'Неудачный опыт', 'Я ожидал большего от этого отеля. Номер был не таким чистым, как я ожидал, и персонал был не очень внимательным. Не рекомендую.', '2023-05-08', 2),
(34, 4, 'Дмитрий', 'Хороший выбор', 'Не пожалел, что решил выбрать данный отель. Все ухожено, еда вкусная, еще и виды прекрасные. В общем, я доволен!', '2023-05-14', 5);

--
-- Структура таблицы `Clients`
--

CREATE TABLE `Clients` (
  `client_id` int NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_phone` varchar(64) NOT NULL,
  `client_category_id` int DEFAULT '1',
  `password` varchar(64) NOT NULL,
  `birthday` date DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Clients`
--

INSERT INTO `Clients` (`client_id`, `client_name`, `client_phone`, `client_category_id`, `password`, `birthday`, `admin`) VALUES
(1, 'testStandart', '', 2, '', '2023-05-22', 0),
(5, '333333', '', 3, '333333', '2023-05-30', 1),
(7, '111111', '11111111', 1, '1111111111', '2023-05-18', 0),
(8, 'asdasdasdasd', '22222222222', 1, '22222222', '2023-05-19', 0),
(13, '123@mail.ru', '1111111111', 1, '11111111', '1111-11-11', 0),
(14, 'Дмитрий', '1', 2, '1', '2023-05-25', 1),
(15, '2', '2', 4, '2', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Discounts`
--

CREATE TABLE `Discounts` (
  `discount_id` int NOT NULL,
  `discount_type` enum('fixed','percentage') NOT NULL,
  `discount_title` varchar(64) NOT NULL,
  `discount_description` text NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `end_date` date DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `client_category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Discounts`
--

INSERT INTO `Discounts` (`discount_id`, `discount_type`, `discount_title`, `discount_description`, `discount_value`, `end_date`, `direction`, `client_category`) VALUES
(6, 'percentage', 'Скидка для категории Silver', 'Скидка для людей, получивших статус Silver', '10.00', NULL, '', '2'),
(7, 'percentage', 'Скидка для категории Gold', 'Скидка для людей, получивших статус Gold', '20.00', NULL, '', '3'),
(8, 'percentage', 'Скидка для категории Platinum', 'Скидка для людей, получивших статус Platinum', '30.00', NULL, '', '4');

-- --------------------------------------------------------

--
-- Структура таблицы `Hotels`
--

CREATE TABLE `Hotels` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `img` varchar(128) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Hotels`
--

INSERT INTO `Hotels` (`id`, `name`, `description`, `img`, `location`, `rating`) VALUES
(1, 'test', 'Уютный отель в историческом центре города', 'hotel.jpg', '2', 5),
(2, 'test2', 'Роскошный отель с видом на Красную площадь', 'hotel.jpg', 'Челябинск, Россия', 4),
(4, 'Отель AIR', 'Отель с видом на море, расположенный в Нью-Йорке', 'hotel.jpg', 'Нью-Йорк, США', 4),
(5, '123', '321', 'hotel.jpg', '3', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Locations`
--

CREATE TABLE `Locations` (
  `id` int NOT NULL,
  `position` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Locations`
--

INSERT INTO `Locations` (`id`, `position`) VALUES
(1, 'Киров, Россия'),
(2, 'Париж, Франция'),
(3, 'Нью-Йорк, США'),
(4, 'Челябинск, Россия'),
(6, 'Москва, Россия');

-- --------------------------------------------------------

--
-- Структура таблицы `Services`
--

CREATE TABLE `Services` (
  `id` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Services`
--

INSERT INTO `Services` (`id`, `title`, `description`, `price`) VALUES
(2, 'Аренда автомобилей', 'Удобная аренда автомобилей для свободного передвижения', '2000'),
(4, 'Экскурсии', 'Увлекательные экскурсии по достопримечательностям города', '1000');

-- --------------------------------------------------------

--
-- Структура таблицы `Tours`
--

CREATE TABLE `Tours` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `img` varchar(128) NOT NULL,
  `departure` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `destination` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `hotel_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Tours`
--

INSERT INTO `Tours` (`id`, `title`, `description`, `img`, `departure`, `destination`, `date`, `duration`, `price`, `hotel_id`) VALUES
(1, 'Tour 1', 'Description 1', 'tour.jpg', 'first', 'second', '2023-05-01', 7, '1000.00', 2),
(3, 'Tour 3', 'Description 3', 'tour.jpg', 'third', 'first', '2023-07-01', 5, '800.00', 2),
(6, '123', '123', 'tour.jpg', 'Киров, Россия', 'Париж, Франция', '2023-05-10', 12, '12000.00', 2),
(7, 'На париж!', 'Путешествие по парижу и пятизвездочный отель', 'tour.jpg', 'Челябинск, Россия', 'Париж, Франция', '2023-05-26', 5, '10000.00', 1),
(9, 'Автобусный тур в Дагестан', 'Проезд на автобусе, проживание, питание, экскурсии, прогулка на катере', 'test2.jpg', 'Киров, Россия', 'Киров, Россия', '2023-05-25', 3, '2000.00', 4),
(10, 'Отдых на озере Увильды', 'транспортное обслуживание, входной билет на территорию санатория «Курорт Увильды»', 'test2.jpg', 'Киров, Россия', 'Челябинск, Россия', '2023-05-25', 2, '1500.00', 4),
(11, 'На париж!', 'Путешествие по парижу и пятизвездочный отель', 'tour.jpg', 'Челябинск, Россия', 'Париж, Франция', '2023-05-26', 5, '10000.00', 1),
(12, 'Автобусный тур в Дагестан', 'Проезд на автобусе, проживание, питание, экскурсии, прогулка на катере', 'test2.jpg', 'Киров, Россия', 'Нью-Йорк, США', '2023-05-25', 3, '2000.00', 4),
(13, 'Отдых на озере Увильды', 'транспортное обслуживание, входной билет на территорию санатория «Курорт Увильды»', 'test2.jpg', 'Киров, Россия', 'Челябинск, Россия', '2023-05-25', 2, '1500.00', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `UserTours`
--

CREATE TABLE `UserTours` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_tour` int DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `UserTours`
--

INSERT INTO `UserTours` (`id`, `id_user`, `id_tour`, `end_date`, `total_price`) VALUES
(12, 14, 7, '2023-05-30', '100'),
(13, 14, 1, '2023-05-24', '200'),
(14, 14, 6, '2023-05-30', '300'),
(15, 15, 7, '2023-05-30', '400'),
(17, 15, 3, '2023-05-31', '500'),
(18, 14, 1, '2023-05-31', '800');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ClientCategories`
--
ALTER TABLE `ClientCategories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `client_category_id` (`client_category_id`);

--
-- Индексы таблицы `Discounts`
--
ALTER TABLE `Discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Индексы таблицы `Hotels`
--
ALTER TABLE `Hotels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Locations`
--
ALTER TABLE `Locations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Services`
--
ALTER TABLE `Services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Tours`
--
ALTER TABLE `Tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Индексы таблицы `UserTours`
--
ALTER TABLE `UserTours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ClientCategories`
--
ALTER TABLE `ClientCategories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Clients`
--
ALTER TABLE `Clients`
  MODIFY `client_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `Discounts`
--
ALTER TABLE `Discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Hotels`
--
ALTER TABLE `Hotels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Locations`
--
ALTER TABLE `Locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Services`
--
ALTER TABLE `Services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Tours`
--
ALTER TABLE `Tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `UserTours`
--
ALTER TABLE `UserTours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Clients`
--
ALTER TABLE `Clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`client_category_id`) REFERENCES `ClientCategories` (`category_id`);

--
-- Ограничения внешнего ключа таблицы `Tours`
--
ALTER TABLE `Tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `Hotels` (`id`);

--
-- Ограничения внешнего ключа таблицы `UserTours`
--
ALTER TABLE `UserTours`
  ADD CONSTRAINT `usertours_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `Clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
