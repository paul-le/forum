-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 24 fév. 2020 à 13:10
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `messagesthreads`
--

DROP TABLE IF EXISTS `messagesthreads`;
CREATE TABLE IF NOT EXISTS `messagesthreads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_thread` varchar(255) NOT NULL,
  `id_utilisateur` varchar(255) NOT NULL,
  `messages` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messagesthreads`
--

INSERT INTO `messagesthreads` (`id`, `id_thread`, `id_utilisateur`, `messages`, `date`) VALUES
(23, '32', '27', 'C\'est trop bien', '2020-02-24 12:21:40');

-- --------------------------------------------------------

--
-- Structure de la table `thread`
--

DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `thread`
--

INSERT INTO `thread` (`id`, `id_topic`, `nom`, `description`) VALUES
(33, 96, 'Toast', 'Je teste'),
(32, 92, 'Fire Force', 'Toast');

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id`, `nom`, `description`, `etat`) VALUES
(91, 'Musiques', 'Musique en tout genre anime ou pas', 'public'),
(90, 'Animes', 'Parlez des dernieres sorties d\'anime sans spoil', 'public'),
(89, 'Discussions', 'Discutez de tout et n\'importe quoi !', 'public'),
(92, 'Jeux videos', 'Vous voulez parler de jeux ? Chercher un mate c\'est par ici', 'public'),
(93, 'Test1', 'Test1', 'public'),
(94, 'Je test', 'Je test', 'public'),
(95, 'Reunion Staff', 'Reunion Staff entre Admin et Modo (prive)', 'prive'),
(96, 'Toast', 'Toast', 'public'),
(97, 'Test prive', 'Prive', 'prive'),
(98, 'Test publique', 'Topic publique', 'public');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `age`, `avatar`, `role`) VALUES
(1, 'Admin', '$2y$12$9RklS93oBUtRZeSxbtEfLOonAueHBFbzYL/dY2PihXyMtkKDn5zfW', '24', 'Admin.jpg', 'Admin'),
(2, 'Modo', '$2y$12$DrXmqOAgbzIgHu9UwoA80uTlt94lUeAKbeHFSLTxrEtJY5vFhkzsK', '24', 'VIDE', 'Modo'),
(27, 'Paul', '$2y$12$tYxJzt7jVkZa39UQlAiK6.q7kdC8vLsHVQnA69TgoqetmVoJU/.Ae', '24', 'VIDE', 'Membre');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
