-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 26 Juin 2016 à 21:54
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fitness_park`
--

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(15) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `logs`
--

INSERT INTO `logs` (`id`, `userId`, `message`, `date`) VALUES
(1, '127.0.0.1', 'exemple de log', '2016-04-14 14:46:23'),
(2, '12', 'Nouvelle reservation: type Yoga', '2016-06-17 12:07:09'),
(3, '12', 'Nouvelle reservation: type Cardio', '2016-06-17 12:07:09'),
(4, '16', 'Nouvelle rÃ©servation: typeCardio, email: , adresse: huhuhuhuhuhHO', '2016-06-24 08:52:15'),
(5, '16', 'Nouvelle rÃ©servation: typeRenforcement musculaire, email: quentin.hoarau@fitnesspark.fr, adresse: testtesttest', '2016-06-24 08:55:11'),
(6, '16', 'Nouvelle rÃ©servation: typeYoga, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: kokokok', '2016-06-24 09:04:00'),
(7, '16', 'Modification description: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:18:43'),
(8, '16', 'Modification password: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:19:45'),
(9, '16', 'Modification password: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:20:20'),
(10, '16', 'Logout: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:35:54'),
(11, NULL, 'Logout: user: ', '2016-06-24 09:36:03'),
(12, '16', 'Logout: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:38:33'),
(13, NULL, 'Logout: user: ', '2016-06-24 09:38:37'),
(14, '16', 'Logout: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:39:40'),
(15, '16', 'Logout: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:39:42'),
(16, NULL, 'Logout: user: ', '2016-06-24 09:39:58'),
(17, '16', 'Logout: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:41:32'),
(18, NULL, 'Logout: user: ', '2016-06-24 09:42:05'),
(19, NULL, 'Logout: user: ', '2016-06-24 09:42:36'),
(20, NULL, 'Logout: user: ', '2016-06-24 09:42:47'),
(21, NULL, 'Logout: user: ', '2016-06-24 09:42:50'),
(22, '16', 'Logout: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:43:04'),
(23, '16', 'Logout: user: quentin.hoarau@fitnesspark.fr', '2016-06-24 09:44:11'),
(24, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: hththt', '2016-06-24 12:37:07'),
(25, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: ffzfz', '2016-06-24 12:37:27'),
(26, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: fefefe', '2016-06-24 13:35:36'),
(27, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: fefefefefef', '2016-06-24 13:36:01'),
(28, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: zzzz', '2016-06-26 15:48:14'),
(29, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: zzzz', '2016-06-26 15:49:25'),
(30, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: jijijij', '2016-06-26 16:02:58'),
(31, '16', 'Nouvelle reservation: typeRenforcement musculaire, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: iiiii', '2016-06-26 16:03:21'),
(32, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: ffff', '2016-06-26 22:18:50'),
(33, '16', 'Nouvelle reservation: typeCardio, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: fefefe', '2016-06-26 22:19:07'),
(34, '16', 'Nouvelle reservation: typeRenforcement musculaire, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: ssss', '2016-06-26 22:25:52'),
(35, '16', 'Nouvelle reservation: typeYoga, client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr, adresse: kjkjkjkj', '2016-06-26 22:26:26'),
(36, '16', 'Demande de suppression reservation: client: quentin.hoarau@fitnesspark.fr, coach: ', '2016-06-26 22:51:19'),
(37, '16', 'Demande de suppression reservation: client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr', '2016-06-26 22:53:21'),
(38, '15', 'Suppression reservation: client: , coach: ', '2016-06-26 22:55:29'),
(39, '15', 'Suppression reservation: client: , coach: ', '2016-06-26 22:56:43'),
(40, '15', 'Suppression reservation: client: , coach: ', '2016-06-26 22:56:45'),
(41, '16', 'Demande de suppression reservation: client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr', '2016-06-26 22:57:20'),
(42, '15', 'Suppression reservation: client: quentin.hoarau@fitnesspark.fr, coach: julien.gauthier@fitnesspark.fr', '2016-06-26 22:57:58'),
(43, '15', 'Modification description: user: julien.gauthier@fitnesspark.fr', '2016-06-26 23:49:16');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `id_customer` int(11) NOT NULL,
  `id_coach` int(11) NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `address` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `askForDelete` tinyint(1) NOT NULL DEFAULT '0',
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `reservations`
--

INSERT INTO `reservations` (`id`, `type`, `id_customer`, `id_coach`, `level`, `address`, `start`, `end`, `askForDelete`, `date_creation`) VALUES
(5, 'Renforcement musculaire', 16, 15, '2', 'ssss', '2016-06-27 12:30:00', '2016-06-27 14:00:00', 0, '2016-06-26 22:25:52');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `description` longtext,
  `type` enum('customer','coach','admin') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `lastName`, `firstName`, `description`, `type`) VALUES
(1, 'admin@fitnesspark.fr', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Blue', 'Johnny', 'Administrateur du Backend rÃ©servation de coach en ligne', 'admin'),
(16, 'quentin.hoarau@fitnesspark.fr', 'bba68d49f013544eca3988ee173b502213e5ac62', 'Hoarau', 'Quentin', 'test de description', 'customer'),
(15, 'julien.gauthier@fitnesspark.fr', 'c63c8ec7f6e2308874076f269e863af55d2cc22e', 'Gauthier', 'Julien', 'Je suis Julien Gauthier\r\nMa spÃ©cialitÃ©: la musculation ainsi que le cardio', 'coach'),
(14, 'coach2@fitnesspark.fr', 'cf7ccba71746fc061551ba7e7ce70c9bd1368058', 'coach2', 'Coach2', 'blablabla', 'coach'),
(13, 'coach@fitnesspark.fr', 'c63c8ec7f6e2308874076f269e863af55d2cc22e', 'coach', 'coach', '', 'coach'),
(12, 'test@fitnesspark.fr', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', 'test', '', 'customer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
