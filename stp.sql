-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 10 2020 г., 13:25
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `stp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `stp_bookings`
--

CREATE TABLE `stp_bookings` (
  `ID` int(11) NOT NULL,
  `NAME` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `stp_bookings`
--

INSERT INTO `stp_bookings` (`ID`, `NAME`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `stp_films`
--

CREATE TABLE `stp_films` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `stp_films`
--

INSERT INTO `stp_films` (`ID`, `NAME`) VALUES
(26, '1'),
(31, '124124'),
(28, '3'),
(23, 'SkillUp'),
(24, 'Дистанционка'),
(25, 'Михалев Владислав SkillUP'),
(32, 'Ф1'),
(27, 'фывфыв');

-- --------------------------------------------------------

--
-- Структура таблицы `stp_tickets`
--

CREATE TABLE `stp_tickets` (
  `ID` int(11) NOT NULL,
  `NAME` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `stp_tickets`
--

INSERT INTO `stp_tickets` (`ID`, `NAME`) VALUES
(3, 25),
(4, 26);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `stp_bookings`
--
ALTER TABLE `stp_bookings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `stp_bookings_ibfk_1` (`NAME`);

--
-- Индексы таблицы `stp_films`
--
ALTER TABLE `stp_films`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `FILMNAME_UNIQUE` (`NAME`);

--
-- Индексы таблицы `stp_tickets`
--
ALTER TABLE `stp_tickets`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NAME` (`NAME`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `stp_bookings`
--
ALTER TABLE `stp_bookings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `stp_films`
--
ALTER TABLE `stp_films`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `stp_tickets`
--
ALTER TABLE `stp_tickets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `stp_bookings`
--
ALTER TABLE `stp_bookings`
  ADD CONSTRAINT `stp_bookings_ibfk_1` FOREIGN KEY (`NAME`) REFERENCES `stp_tickets` (`ID`);

--
-- Ограничения внешнего ключа таблицы `stp_tickets`
--
ALTER TABLE `stp_tickets`
  ADD CONSTRAINT `stp_tickets_ibfk_1` FOREIGN KEY (`NAME`) REFERENCES `stp_films` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
