-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 29 Mai 2015 à 16:58
-- Version du serveur: 5.5.41-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dreamcommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nom_adresse` varchar(32) COLLATE utf8_bin NOT NULL,
  `prenom_adresse` varchar(32) COLLATE utf8_bin NOT NULL,
  `ligne1` varchar(128) COLLATE utf8_bin NOT NULL,
  `ligne2` varchar(128) COLLATE utf8_bin NOT NULL,
  `ville` varchar(32) COLLATE utf8_bin NOT NULL,
  `pays` varchar(16) COLLATE utf8_bin NOT NULL,
  `code` int(16) NOT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `id_user`, `nom_adresse`, `prenom_adresse`, `ligne1`, `ligne2`, `ville`, `pays`, `code`) VALUES
(1, 1, 'CHATEAUROUX', 'Alexandre', 'Place des Halles', '', 'STRASBOURG', 'France', 67000);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `note` int(1) NOT NULL,
  `commentaires` varchar(2048) COLLATE utf8_bin NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_avis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_produit`, `note`, `commentaires`, `id_user`, `date`) VALUES
(1, 1, 5, 'Houhou trop classe', 1, '2015-05-29 14:29:41');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id_category`, `nom`) VALUES
(1, 'Heureux'),
(2, 'Cauchemar'),
(3, 'Érotique'),
(4, 'Prémonitoire'),
(5, 'Brisé'),
(6, 'Éveillé '),
(7, 'Merdique');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `prix_ht` float NOT NULL,
  `tva` float NOT NULL,
  `prix_ttc` float NOT NULL,
  `id_facture` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_user`, `id_produit`, `quantity`, `prix_ht`, `tva`, `prix_ttc`, `id_facture`, `paid`, `date`) VALUES
(1, 1, 1, 2, 200, 20, 120, 1, 1, '2015-05-29 08:31:26');

-- --------------------------------------------------------

--
-- Structure de la table `img`
--

CREATE TABLE IF NOT EXISTS `img` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `lien` varchar(256) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `img`
--

INSERT INTO `img` (`id_img`, `id_produit`, `lien`) VALUES
(1, 1, './images/gagnant_loto.jpg'),
(3, 1, './images/gagnant_loto2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quanty` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_panier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `nom_produit` varchar(64) COLLATE utf8_bin NOT NULL,
  `description` varchar(512) COLLATE utf8_bin NOT NULL,
  `prix` float NOT NULL,
  `duree` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference` varchar(16) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_category`, `nom_produit`, `description`, `prix`, `duree`, `date`, `reference`) VALUES
(1, 1, 'Gagner au loto', 'Vous avez voulu gagner au loto !', 99, 15, '2015-05-29 12:18:24', 'H_001'),
(2, 2, 'Manger avec Freddy', 'Oulalala ça fait peur !', 666, 15, '2015-05-29 12:20:24', 'C_001'),
(3, 2, 'Se promener dans une forêt la nuit', 'Parce que j''ai déjà trouvé une photo', 55, 15, '2015-05-29 12:20:24', 'C_002'),
(6, 3, 'Passez une soirée avec Angelina Jolie et plus si affinité', 'La totale.', 69, 15, '2015-05-29 12:22:22', 'E_001'),
(7, 3, 'Passez une soirée avec Brad Pitt et plus si affinité', 'La totale.', 69, 15, '2015-05-29 12:22:22', 'E_002');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cur_quantity` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(64) COLLATE utf8_bin NOT NULL,
  `date_naissance` date NOT NULL,
  `password` varchar(512) COLLATE utf8_bin NOT NULL,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  `telephone` int(11) NOT NULL,
  `droits` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `date_naissance`, `password`, `email`, `telephone`, `droits`) VALUES
(1, 'CHATEAUROUX', 'Alexandre', '1980-01-31', 'toto', 'alex@toto.fr', 102030405, 1),
(3, 'Mika', 'Mika', '1994-06-10', '0', 'don_cabral@hotmail.fr', 677906696, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
