-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主機: localhost:3306
-- 產生日期: 2013 年 01 月 13 日 09:53
-- 伺服器版本: 5.5.28
-- PHP 版本: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `facetech`
--

-- --------------------------------------------------------

--
-- 表的結構 `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `userId1` int(8) NOT NULL,
  `userId2` int(8) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `group` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的結構 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `userId1` int(8) NOT NULL,
  `userId2` int(8) NOT NULL,
  `date` datetime NOT NULL,
  `message` char(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `messageId` int(8) NOT NULL,
  `userId` int(8) NOT NULL,
  `date` datetime NOT NULL,
  `response` char(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `account` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `enable` int(1) NOT NULL DEFAULT '1',
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `head` char(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `birthday` date NOT NULL,
  `telephone` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `city` char(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 轉存資料表中的資料 `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `type`, `enable`, `username`, `head`, `birthday`, `telephone`, `city`) VALUES
(1, 'root', 'root', 1, 1, '管理員', 'default.png', '2013-01-14', '0000-000000', 'Internet');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
