-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 23 fév. 2020 à 10:56
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_switch`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(3) NOT NULL AUTO_INCREMENT,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text COLLATE utf8_bin NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_avis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(3) NOT NULL AUTO_INCREMENT,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(3) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(60) COLLATE utf8_bin NOT NULL,
  `nom` varchar(20) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `civilite` enum('m','f') COLLATE utf8_bin NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(3, 'agent007', '$2y$10$f6QBlF10HL/NqTCemQmJ8uDJkJK3ypPEfygduYKp2WFR0Hb151PSa', 'bond', 'james', 'rggg@.fr', 'm', 1, '2020-02-20 23:38:21');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(3) NOT NULL AUTO_INCREMENT,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int(3) NOT NULL AUTO_INCREMENT,
  `titre` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `photo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `pays` varchar(20) COLLATE utf8_bin NOT NULL,
  `ville` varchar(20) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(50) COLLATE utf8_bin NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('reunion','bureau','formation') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(5, 'tttt', '9999', 'salle7.jpg', 'France', 'Paris', '45 avenu de rien', 93200, 1, 'reunion'),
(6, 'fazeuohbdfuiazo', 'zdadda', 'salle6.jpg', 'France', 'Paris', 'dzadazd', 78000, 50, 'bureau'),
(7, 'my room', 'its my room', 'salle7.jpg', 'France', 'Paris', 'my address', 78000, 50, 'bureau'),
(8, 'test', 'test', 'salle8.jpg', 'France', 'Lyon', 'test', 87965, 1, 'reunion'),
(11, 'salle de versailles', 'belle et grande', 'salle2.jpg', 'France', 'Paris', '15 bd du roi', 78888, 50, 'reunion'),
(12, 'dsffdsv', 'vsvfsvs', 'salle6.jpg', 'France', 'Marseille', 'bfdbd', 20202, 50, 'bureau'),
(15, 'salle du lyon', 'au stade gerland', 'salle9.jpg', 'France', 'Lyon', '156 rue des perdants', 69200, 50, 'formation');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
