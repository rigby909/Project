-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 07 2017 г., 16:34
-- Версия сервера: 5.5.35-log
-- Версия PHP: 5.3.27

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
-- Структура таблицы `standart_expences_categories`
--

CREATE TABLE IF NOT EXISTS `standart_expences_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `standart_expences_categories`
--

INSERT INTO `standart_expences_categories` (`id`, `name`) VALUES
(1, 'Еда и напитки'),
(2, 'Покупки'),
(3, 'Счета'),
(4, 'Кредит'),
(5, 'Авто'),
(6, 'Путешествия'),
(7, 'Семья'),
(8, 'Дом'),
(9, 'Развлечения'),
(10, 'Мобильная связь'),
(11, 'Одежда'),
(12, 'Домашние животные'),
(13, 'Транспорт'),
(14, 'Хобби'),
(15, 'Здоровье'),
(16, 'Аренда');

-- --------------------------------------------------------

--
-- Структура таблицы `standart_incomes_categories`
--

CREATE TABLE IF NOT EXISTS `standart_incomes_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `standart_incomes_categories`
--

INSERT INTO `standart_incomes_categories` (`id`, `name`) VALUES
(1, 'Заработная плата'),
(2, 'Премия'),
(3, 'Дополнительный доход'),
(4, 'Пенсия'),
(5, 'Стипендия');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `amount` double NOT NULL,
  `st_income_category` int(11) DEFAULT NULL,
  `st_expence_category` int(11) DEFAULT NULL,
  `user_income_category` int(11) DEFAULT NULL,
  `user_expence_category` int(11) DEFAULT NULL,
  `comment` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`st_income_category`,`st_expence_category`,`user_income_category`,`user_expence_category`),
  KEY `st_income_category` (`st_income_category`),
  KEY `st_expence_category` (`st_expence_category`),
  KEY `user_income_category` (`user_income_category`),
  KEY `user_expence_category` (`user_expence_category`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `date`, `amount`, `st_income_category`, `st_expence_category`, `user_income_category`, `user_expence_category`, `comment`) VALUES
(15, 1, 1, '2017-05-04', 1200, 1, NULL, NULL, NULL, NULL),
(16, 1, 1, '2017-05-05', 120, 3, NULL, NULL, NULL, NULL),
(17, 1, 1, '2017-05-03', 100, NULL, NULL, 4, NULL, NULL),
(18, 1, 2, '2017-05-05', 250, NULL, 13, NULL, NULL, NULL),
(19, 1, 2, '2017-05-07', 100, NULL, NULL, NULL, 4, NULL),
(20, 5, 1, '2017-05-01', 1000, NULL, NULL, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_type`
--

CREATE TABLE IF NOT EXISTS `transactions_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `transactions_type`
--

INSERT INTO `transactions_type` (`id`, `name`) VALUES
(1, 'income'),
(2, 'expence');

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
  KEY `auth_via` (`auth_via`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `auth_via`, `identity`) VALUES
(1, 'Элина', 'Грищенко', '1995', 'rigby909@gmail.com', 1, NULL),
(2, 'Петр', 'Петров', '1111', 'petya@mail.com', 1, NULL),
(3, 'Алина', 'Сидорова', '1234', 'qqq@mail.ru', 1, NULL),
(5, 'Elina.', 'Миронова', NULL, NULL, 2, 'http://twitter.com/rigby909'),
(6, 'Элина', 'Ригби', NULL, NULL, 2, 'http://instagram.com/rigby909'),
(7, 'Алина', 'Алина', NULL, NULL, 2, 'http://instagram.com/lightdior'),
(8, 'Элина', 'Г.', NULL, NULL, 2, 'https://my.mail.ru/mail/lightdiorcherie/'),
(9, 'Элина', 'Грищенко', NULL, NULL, 2, 'https://plus.google.com/u/0/108333486001349835409/');

-- --------------------------------------------------------

--
-- Структура таблицы `users_balance`
--

CREATE TABLE IF NOT EXISTS `users_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users_balance`
--

INSERT INTO `users_balance` (`id`, `user_id`, `balance`) VALUES
(3, 1, 1070),
(4, 5, 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `user_expences_categories`
--

CREATE TABLE IF NOT EXISTS `user_expences_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `user_expences_categories`
--

INSERT INTO `user_expences_categories` (`id`, `user_id`, `name`) VALUES
(2, 1, 'Интернет'),
(4, 1, 'Спорт'),
(5, 5, 'Кино');

-- --------------------------------------------------------

--
-- Структура таблицы `user_incomes_categories`
--

CREATE TABLE IF NOT EXISTS `user_incomes_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `user_incomes_categories`
--

INSERT INTO `user_incomes_categories` (`id`, `user_id`, `name`) VALUES
(3, 1, 'Наследство'),
(4, 1, 'Подарок'),
(5, 1, 'Секретная'),
(6, 5, 'Секретная'),
(7, 3, 'Секретная');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`type`) REFERENCES `transactions_type` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`st_income_category`) REFERENCES `standart_incomes_categories` (`id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`st_expence_category`) REFERENCES `standart_expences_categories` (`id`),
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`user_income_category`) REFERENCES `user_incomes_categories` (`id`),
  ADD CONSTRAINT `transactions_ibfk_5` FOREIGN KEY (`user_expence_category`) REFERENCES `user_expences_categories` (`id`),
  ADD CONSTRAINT `transactions_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`auth_via`) REFERENCES `auth_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `users_balance`
--
ALTER TABLE `users_balance`
  ADD CONSTRAINT `users_balance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_expences_categories`
--
ALTER TABLE `user_expences_categories`
  ADD CONSTRAINT `user_expences_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_incomes_categories`
--
ALTER TABLE `user_incomes_categories`
  ADD CONSTRAINT `user_incomes_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
