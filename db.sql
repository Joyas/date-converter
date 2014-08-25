-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 26 Août 2014 à 01:42
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `date-converter`
--

-- --------------------------------------------------------

--
-- Structure de la table `King`
--

CREATE TABLE `King` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startDateReign` datetime NOT NULL,
  `endDateReign` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Contenu de la table `King`
--

INSERT INTO `King` (`id`, `name`, `startDateReign`, `endDateReign`) VALUES
(1, 'WilliamI', '1066-12-25 00:00:00', '1087-09-09 00:00:00'),
(2, 'WilliamII', '1087-09-26 00:00:00', '1100-08-02 00:00:00'),
(3, 'HenryI', '1100-08-05 00:00:00', '1135-12-01 00:00:00'),
(4, 'Stephen', '1135-12-22 00:00:00', '1154-10-25 00:00:00'),
(5, 'HenryII', '1154-12-19 00:00:00', '1189-03-05 00:00:00'),
(6, 'RichardI', '1189-09-03 00:00:00', '1199-04-06 00:00:00'),
(7, 'John', '1199-05-27 00:00:00', '1216-10-19 00:00:00'),
(8, 'HenryIII', '1216-10-28 00:00:00', '1272-11-16 00:00:00'),
(9, 'EdwardI', '1272-11-20 00:00:00', '1307-07-07 00:00:00'),
(10, 'EdwardII', '1307-07-07 00:00:00', '1327-09-21 00:00:00'),
(11, 'EdwardIII', '1327-01-25 00:00:00', '1377-06-21 00:00:00'),
(12, 'RichardII', '1377-06-21 00:00:00', '1399-09-29 00:00:00'),
(13, 'HenryIV', '1399-09-30 00:00:00', '1413-03-20 00:00:00'),
(14, 'HenryV', '1413-03-20 00:00:00', '1422-08-31 00:00:00'),
(15, 'HenryVI', '1422-08-31 00:00:00', '1461-03-04 00:00:00'),
(16, 'EdwardIV', '1461-03-04 00:00:00', '1483-04-09 00:00:00'),
(17, 'HenryVI', '1470-10-30 00:00:00', '1471-04-11 00:00:00'),
(18, 'EdwardV', '1483-04-09 00:00:00', '1483-06-25 00:00:00'),
(19, 'RichardIII', '1483-06-26 00:00:00', '1485-08-22 00:00:00'),
(20, 'HenryVII', '1485-08-22 00:00:00', '1509-04-21 00:00:00'),
(21, 'HenryVIII', '1509-04-21 00:00:00', '1547-01-28 00:00:00'),
(22, 'EdwardVI', '1547-01-28 00:00:00', '1553-07-06 00:00:00'),
(23, 'MaryI', '1553-07-19 00:00:00', '1558-11-17 00:00:00'),
(24, 'ElisabethI', '1558-11-17 00:00:00', '1603-03-24 00:00:00');
