-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 05 oct. 2018 à 10:38
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `statsdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

DROP TABLE IF EXISTS `statistiques`;
CREATE TABLE IF NOT EXISTS `statistiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nbVisites` int(11) NOT NULL DEFAULT '0',
  `pageVisitee` varchar(100) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `numSession` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT '2000-01-01',
  `Login` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `LoginOriginal` (`Login`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statistiques`
--

INSERT INTO `statistiques` (`id`, `nbVisites`, `pageVisitee`, `ip`, `numSession`, `date`, `Login`, `Password`) VALUES
(15, 9, '/Main.php', '127.0.0.1', '6pkfhjh1d5cac74ibl8jk94e95', '2018-10-05', NULL, NULL),
(16, 1, '/Signup.php', '127.0.0.1', '', '2018-10-05', 'Damien', 'damien'),
(17, 6, '/Auth.php', '127.0.0.1', '6pkfhjh1d5cac74ibl8jk94e95', '2018-10-05', NULL, NULL),
(18, 32, '/AffichageStatistiques.php', '127.0.0.1', '6pkfhjh1d5cac74ibl8jk94e95', '2018-10-05', NULL, NULL),
(19, 1, '/Signup.php', '127.0.0.1', '', '2018-10-05', 'Jean', 'Michel'),
(20, 3, '/SecondMain.php', '127.0.0.1', '6pkfhjh1d5cac74ibl8jk94e95', '2018-10-05', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
