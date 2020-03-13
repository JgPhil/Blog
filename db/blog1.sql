-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 13 mars 2020 à 09:45
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_validate_date` datetime DEFAULT NULL,
  `content_comment` text NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `users_comments_fk` (`user_id`),
  KEY `blogs_comments_fk` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment_date`, `comment_validate_date`, `content_comment`) VALUES
(1, 1, 2, '2020-03-12 11:06:14', '2020-03-12 11:06:14', 'Ce premier post est visible , et tu es sur la bonne voie'),
(2, 2, 2, '2020-03-12 11:06:14', '2020-03-12 11:06:14', 'Ce 2ème post est visible , et tu es sur la bonne voie');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `heading` varchar(255) NOT NULL,
  `last_update` datetime NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `users_blogs_fk` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `content`, `heading`, `last_update`, `picture`, `creation_date`) VALUES
(1, 1, 'Mon premier post', 'Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test Ceci est un test ', 'ceci est un test', '2020-03-12 11:02:57', NULL, '2020-03-12 11:02:57'),
(2, 1, 'Deuxième post', 'Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test Deuxième post test ', 'test de post 2', '2020-03-12 11:02:57', NULL, '2020-03-12 11:02:57');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'member'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role_user_fk` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `username`, `password`, `email`, `creation_date`, `avatar`) VALUES
(1, 2, 'Phil', '12345678', 'jamingph@gmail.com', '2020-03-12 10:57:32', NULL),
(2, 1, 'Orianne', '12345678', 'filtre67@gmail.com', '2020-03-12 10:57:32', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
