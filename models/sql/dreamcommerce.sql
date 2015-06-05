-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2015 at 05:01 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dreamcommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `id_user`, `nom_adresse`, `prenom_adresse`, `ligne1`, `ligne2`, `ville`, `pays`, `code`) VALUES
(1, 1, 'CHATEAUROUX', 'Alexandre', 'Place des Halles', '', 'STRASBOURG', 'France', 67000),
(2, 1, 'PERSONNE', 'paul2', 'Place des Halles', '', 'PARIS', 'France', 75000);

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `note` int(1) NOT NULL,
  `commentaires` varchar(2048) COLLATE utf8_bin NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_avis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_avis`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=55 ;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_produit`, `note`, `commentaires`, `id_user`, `date_avis`) VALUES
(51, 22, 5, '<p>J''aoute un &eacute;norme commentaire car j veux savoir si &ccedil;a va bien :</p>\n<p>&Eacute;videmment, cela n&rsquo;arrivera jamais si l&rsquo;on se contente d&rsquo;attendre passivement que le ticket gagnant nous tombe dessus. Quoique&hellip; pour certains, c&rsquo;&eacute;tait effectivement le cas ! L&rsquo;histoire commence sur un lit d&rsquo;h&ocirc;pital pour cet Am&eacute;ricain de 46 ans, chef de projet chez Verizon, une entreprise de t&eacute;l&eacute;communications outre-Atlantique.</p>\n<p>Joseph Amorese est originaire de la ville d&rsquo;Easton en Pennsylvanie et il vient de subir une op&eacute;ration chirurgicale &agrave; cause d&rsquo;une hernie. Durant sa convalescence, son p&egrave;re qui est passionn&eacute; de loterie lui envoie une carte de v&oelig;u accompagn&eacute;e d&rsquo;un ticket &agrave; gratter. Il n&rsquo;aura fallu que quelques secondes, le temps de gratter son ticket pour que sa vie et celle de sa femme Jodi basculent d&eacute;finitivement. Ses douleurs se sont dissip&eacute;es quand il se rend compte qu&rsquo;il vient de gagner 7 millions de dollars. &laquo; Heureusement que j&rsquo;&eacute;tais assis, car j&rsquo;ai &eacute;t&eacute; sous le choc &raquo; confiera-t-il lors de la c&eacute;r&eacute;monie officielle avant d&rsquo;ajouter : &laquo; Je venais d&rsquo;&ecirc;tre op&eacute;r&eacute;, je voulais sauter dans tous les sens, je ne pouvais pas, mais je le faisais dans ma t&ecirc;te &raquo;. Quand il appelle son &eacute;pouse pour partager la bonne nouvelle, celle-ci restera sans voix quelques minutes. Ce qui est tout &agrave; fait compr&eacute;hensible quand on sait qu&rsquo;ils n&rsquo;avaient qu&rsquo;une chance sur 3 708 000 de gagner le jackpot gr&acirc;ce &agrave; un ticket achet&eacute; quelques jours plus t&ocirc;t par le p&egrave;re de Joseph Amorese dans un petit commerce appel&eacute; &laquo; Just A Dollar &raquo; (litt&eacute;ralement &laquo; Juste Un Dollar &raquo;) &agrave; New City dans la ville de New York.</p>\n<p>Le couple qui n&rsquo;en revient toujours pas', 17, '2015-06-05 13:51:28'),
(54, 22, 5, '<p>Je suis bon quand m&ecirc;me</p>', 16, '2015-06-05 14:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
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
-- Table structure for table `commande`
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
  `statut` int(1) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_user`, `id_produit`, `quantity`, `prix_ht`, `tva`, `prix_ttc`, `id_facture`, `statut`, `date_commande`) VALUES
(1, 1, 1, 2, 100, 20, 120, 1, 1, '2015-05-29 08:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE IF NOT EXISTS `img` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `lien` varchar(256) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=469 ;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`id_img`, `id_produit`, `lien`) VALUES
(5, 8, './images/premonitoire-amesoeur.jpg'),
(6, 9, './images/premonitoire-travail.jpg'),
(8, 6, './images/erotique_angelina.jpg'),
(12, 8, './images/premonitoire-amesoeur2.jpg'),
(13, 8, './images/premonitoire-amesoeur3.jpg'),
(14, 9, './images/premonitoire-travail2.jpg'),
(19, 6, './images/erotique_angelina1.jpg'),
(20, 6, './images/erotique_angelina2.jpg'),
(21, 6, './images/erotique_angelina3.jpg'),
(22, 6, './images/erotique_angelina4.jpg'),
(23, 6, './images/erotique_angelina5.jpg'),
(34, 15, './images/cauchemar_foret_nuit.jpg'),
(425, 7, './images/erotique_brad.jpg'),
(426, 7, './images/erotique_brad2.jpg'),
(427, 7, './images/erotique_brad3.jpg'),
(432, 1, './images/gagnant_loto.jpg'),
(433, 1, './images/gagnant_loto2.jpg'),
(437, 16, './images/heureux_bebe.jpg'),
(438, 16, './images/heureux_bebe1.jpg'),
(439, 16, './images/heureux_bebe2.jpg'),
(440, 17, './images/sfg'),
(441, 18, './images/s'),
(442, 19, './images/sdgfsfgfs'),
(449, 20, './images/erotique_angelina.jpg'),
(450, 20, './images/erotique_angelina1.jpg'),
(451, 20, './images/erotique_angelina2.jpg'),
(452, 20, './images/erotique_angelina3.jpg'),
(453, 20, './images/erotique_angelina4.jpg'),
(454, 20, './images/erotique_angelina5.jpg'),
(455, 21, './images/erotique_brad.jpg'),
(456, 21, './images/erotique_brad2.jpg'),
(457, 21, './images/erotique_brad3.jpg'),
(460, 23, './images/heureux_bebe.jpg'),
(461, 23, './images/heureux_bebe1.jpg'),
(462, 23, './images/heureux_bebe2.jpg'),
(463, 24, './images/cauchemar_foret_nuit.jpg'),
(464, 22, './images/gagnant_loto.jpg'),
(465, 22, './images/gagnant_loto2.jpg'),
(466, 25, './images/aa'),
(468, 26, './images/aaaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `prix` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_panier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `produit`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=27 ;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_category`, `nom_produit`, `description`, `prix`, `duree`, `date`, `reference`) VALUES
(20, 3, 'Passez une nuit avec Angelina Jolie et plus si affinité.', 'La totaaaaaaaaaaaaale !', 69, 15, '2015-06-05 08:28:42', 'E_001'),
(21, 3, 'Passez une nuit avec Brad Pitt et plus si affinité.', 'La totale.', 69, 15, '2015-06-05 08:30:54', 'E_002'),
(22, 1, 'Gagner au loto', 'Vous êtes riches !!! Vous pouvez acheter tout ce que vous voulez !', 99, 15, '2015-06-05 08:32:12', 'H_001'),
(23, 1, 'Devenir parent', 'Vous attendez un heureux événement, un petit bout de chou va naître sous vos yeux.', 75, 15, '2015-06-05 08:34:03', 'H_002'),
(24, 2, 'Se promener en forêt la nuit', 'Se promener en forêt la nuit ça fait peur hein !', 45, 15, '2015-06-05 08:35:49', 'C_001');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `virtual_quantity` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `id_produit`, `duree`, `quantity`, `virtual_quantity`) VALUES
(1, 20, 15, 100, 100),
(2, 20, 60, 200, 200);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `date_naissance`, `password`, `email`, `telephone`, `droits`) VALUES
(1, 'CHATEAUROUX', 'Alexandre', '1980-01-28', '$2y$10$3sBubE270qtTDs10nL0GnOqOsioS63Uu5XfrMKzlo/6r554p5UTRK', 'alex@toto.fr', 123456789, 1),
(3, 'Mika', 'Mika', '1994-06-10', '0', 'don_cabral@hotmail.fr', 677906696, 1),
(5, 'Jhjkhjlh', 'hjklhjlhl', '1994-06-10', '$2y$10$/LpE3oJy905pUvuaMZZ6zOIW6w24kBV..5t7LER.mzaOmqsV.M9R.', 'd@hotmail.fr', 677906696, 3),
(6, 'Alex', 'Pas renseigné', '2000-01-01', '$2y$10$uyWu45sw2HF/loBXyGM08eZmImy2qVbWVS6bF24dXE.VBr1kk5epO', 'alex@toto2.fr', 1, 3),
(7, 'Alex', 'alex-test', '2000-01-01', '$2y$10$BAVrw1usj4dfqyTnDTQ5jeXBsvy6a5I5wZcAKcFH5gai80RTE.iy.', 'toto@toto.fr', 103204568, 3),
(8, 'ghsgsdfg', 'Pas renseigné', '2001-01-01', '$2y$10$kVNY6HqrkTpJPJahdi4a9u1u9JMk4UsLxC8IvKojnOxYWpdCVoN62', 'axel@toto.fr', 1, 3),
(9, 'Alex', 'Pas renseigné', '2000-01-01', '$2y$10$CIiwuES1vWMr5tNDH2RMROtgLGEJpy4WlQHKXMeF14Xv7ttoRwwQa', 'toto@toto.fr2', 0, 3),
(10, 'Alex', 'Pas renseigné', '2000-01-01', '$2y$10$iNVww72vBTraOcBf5qhW..GWk1IUi/4Yoe79rBHs85J9aLs1u7Zsm', 'toto@toto.fr21', 0, 3),
(11, 'Alex', 'Pas renseigné', '2000-01-01', '$2y$10$Lu3uX3KZk2XeKh/59sMboOjKGrIFvCKF35otVtF/X/wro5rrLFMDO', 'toto@toto.fr212', 0, 3),
(12, 'Alex', 'Pas renseigné', '2000-01-01', '$2y$10$dFGbpcLhypAbljz4wJGK9OEC1nKIEBSY/O.22Q0N5uSkIXy74UoxO', 'toto21@toto.fr', 1231321, 3),
(13, 'Alex', 'Pas renseigné', '2000-01-01', '$2y$10$nUrg7rqBim1Q8fb5iYOl6.9aCfXTZQhJUw5ss4mHmk9619vn7HUge', 'tot@fre.fr', 0, 3),
(14, 'Alex', 'dsf', '2000-01-01', '$2y$10$dThiyDWIdWY.HvMnDxTbiOESQYOeeZpQffD1BN5CoF5Y3b7iVCMX6', 'alex@toto.fr2', 1, 3),
(15, 'Alex', 'Pas renseigné', '2000-01-01', '$2y$10$n4F7nXBKgwEW1v.EPyz0uuO5hKp1ptBk53ONz4gA8cHtWIbI1S9Jq', 'alex@toto.fr3', 1, 3),
(16, 'Mika', 'Mika', '1994-06-10', '$2y$10$YddS.9zEApKoZoCyJLCqp.tWFdUVdDNk9Pu6/9cJVSOOyR.CBYFXi', 'mika@hotmail.fr', 677906696, 1),
(17, 'ROCHE', 'Eric', '1973-03-25', '$2y$10$yEBlCXEvFV3/0tf348XgvuHrbadAx941Xvu3tSwPzQTlQML0kNI5S', 'eric@toto.fr', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
