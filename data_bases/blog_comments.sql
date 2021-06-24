-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 04 avr. 2021 à 12:20
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text_comment` text NOT NULL,
  `comment_date` date NOT NULL,
  `comment_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `id_post`, `author`, `text_comment`, `comment_date`, `comment_time`) VALUES
(1, 1, 'Drx85', 'Commentaire de test n°1 (1er billet)', '2021-03-20', '15:59:58'),
(2, 1, 'Drx85', 'Commentaire de test n°2 (1er billet)', '2021-03-20', '15:59:58'),
(3, 1, 'Drx85', 'Commentaire de test n°3 (1er billet)', '2021-03-20', '16:00:00'),
(4, 2, 'Drx85', 'Commentaire de test n°1 (2ème billet)', '2021-03-20', '15:59:58'),
(5, 2, 'Drx85', 'Commentaire de test n°2 (2ème billet)', '2021-03-20', '15:59:58'),
(6, 2, 'Drx85', 'Commentaire de test n°3 (2ème billet)', '2021-03-20', '16:00:00'),
(7, 3, 'Drx85', 'Commentaire de test n°1 (3ème billet) ', '2021-03-23', '15:46:35'),
(8, 3, 'Drx85', 'Commentaire de test n°2 (3ème billet) ', '2021-03-23', '15:46:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
