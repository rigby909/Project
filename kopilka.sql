-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 05 2017 г., 12:39
-- Версия сервера: 5.5.45
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kopilka`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_type`
--

CREATE TABLE IF NOT EXISTS `auth_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `auth_type`
--

INSERT INTO `auth_type` (`id`, `auth_name`) VALUES
(1, 'native'),
(2, 'social');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `auth_via` int(11) NOT NULL,
  `identity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_via` (`auth_via`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `auth_via`, `identity`) VALUES
(1, 'Элина', 'Грищенко', '1995', 'rigby909@gmail.com', 1, NULL),
(2, 'Петр', 'Петров', '1111', 'petya@mail.com', 1, NULL),
(3, 'Алина', '', '1234', 'qqq@mail.ru', 1, NULL),
(5, 'Elina.', 'Миронова', NULL, NULL, 2, 'http://twitter.com/rigby909'),
(6, 'Элина', 'Ригби', NULL, NULL, 2, 'http://instagram.com/rigby909'),
(7, 'Алина', 'Алина', NULL, NULL, 2, 'http://instagram.com/lightdior'),
(8, 'Элина', 'Г.', NULL, NULL, 2, 'https://my.mail.ru/mail/lightdiorcherie/');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`auth_via`) REFERENCES `auth_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
