-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2018 г., 12:41
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `qulix`
--

-- --------------------------------------------------------

--
-- Структура таблицы `crude`
--

CREATE TABLE `crude` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Название сырья'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `crude`
--

INSERT INTO `crude` (`id`, `name`) VALUES
(1, 'Инопланетянина сырье'),
(2, 'Хорошее сырье'),
(3, 'Выброшенное радиоактивное сырье');

-- --------------------------------------------------------

--
-- Структура таблицы `crude_has_population`
--

CREATE TABLE `crude_has_population` (
  `crude_id` int(11) NOT NULL,
  `population_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `crude_has_population`
--

INSERT INTO `crude_has_population` (`crude_id`, `population_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `population`
--

CREATE TABLE `population` (
  `id` int(11) NOT NULL,
  `sort` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Вид населения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `population`
--

INSERT INTO `population` (`id`, `sort`) VALUES
(1, 'Инопланетянин'),
(2, 'Асоциальная личность'),
(3, 'Обычный человек');

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE `worker` (
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Имя работника',
  `status` decimal(10,0) DEFAULT NULL COMMENT 'Количество радиации'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`name`, `status`) VALUES
('Работник Вася', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `crude`
--
ALTER TABLE `crude`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `crude_has_population`
--
ALTER TABLE `crude_has_population`
  ADD PRIMARY KEY (`crude_id`,`population_id`),
  ADD KEY `IDX_B4C45391E214EFDF` (`crude_id`),
  ADD KEY `IDX_B4C45391C955D1E1` (`population_id`);

--
-- Индексы таблицы `population`
--
ALTER TABLE `population`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `crude`
--
ALTER TABLE `crude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `population`
--
ALTER TABLE `population`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `crude_has_population`
--
ALTER TABLE `crude_has_population`
  ADD CONSTRAINT `FK_B4C45391C955D1E1` FOREIGN KEY (`population_id`) REFERENCES `population` (`id`),
  ADD CONSTRAINT `FK_B4C45391E214EFDF` FOREIGN KEY (`crude_id`) REFERENCES `crude` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
