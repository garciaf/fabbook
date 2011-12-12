-- phpMyAdmin SQL Dump
-- version OVH
-- http://www.phpmyadmin.net
--
-- Client: mysql51-46.perso
-- Généré le : Sun 11 Décembre 2011 à 20:55
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `fabbookfoto`
--

-- --------------------------------------------------------

--
-- Structure de la table `Album`
--

CREATE TABLE IF NOT EXISTS `Album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `Album`
--

INSERT INTO `Album` (`id`, `name`, `comment`, `createdAt`) VALUES
(3, 'PolyBad''', 'Les dessous de Polytech''', '2011-10-29'),
(6, 'Voyages', 'Le monde est un livre et celui qui ne voyage pas n''en lit qu''une page ...', '2011-10-29'),
(7, 'Polytech''', 'Petits souvenir de trois années d''école...', '2011-10-29'),
(8, 'Feux d''artifice', 'un peu d''artifice', '2011-11-01'),
(9, 'Anniversaire Clément', 'Un mélange entre océan et eau de vie', '2011-11-25'),
(10, '1001 pattes', 'Nos amis les bêtes ...', '2011-11-29'),
(11, 'By night', 'La ville de nuit', '2011-11-29'),
(12, 'Maroc', 'Le pays où le wisky a un goût de menthe', '2011-11-30'),
(13, 'Asie', 'retour sur le vietnam et la thaïlande', '2011-12-03');

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE IF NOT EXISTS `Article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `content` varchar(500) NOT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Article`
--

INSERT INTO `Article` (`id`, `title`, `subtitle`, `createdAt`, `content`, `author`) VALUES
(1, 'Nouveau Site fabbook', 'On prend tout on recommence', '2011-11-11', 'Le site a été refait de fond en comble, pour les connaisseurs où ceux que cela intéresse il s''agit de Symfony2. \r\nSinon pour ceux qui viennent regarder des photos bienvenue ! \r\nJ''espère que vous apprécierez la visite et n''hésitez pas à laisser vos commentaire sur mon mail :\r\nfab0670312047[at]gmail.com ou sur la page de contact (la version mobile de cette page de contact n''est pas encore terminée ...)\r\nOui je sais c''est pas sérieux ...\r\n\r\nAllez à plus !', 'Fabien Garcia'),
(3, 'Nouvel album', 'Entre l''océan et l''eau de vie', '2011-11-25', 'Parfois on sort son appareil photo pour avoir des souvenirs, ou dans d''autre cas pour se souvenir de la soirée d''hier ...\r\nUn peu de rhum un peu d''océan et vous voilà à Arcachon. \r\nOn se souviendra de la visite en bateau mémorable, dans le vent sous la pluie et avec des toilettes qui laissent entrer mais pas sortir...\r\nAllez à plus', 'Fabien Garcia'),
(4, '1001 pattes', 'Car nous ne sommes pas seul sur terre ...', '2011-11-29', 'Petit hommage à nos amis les bêtes au sens large, je dois dire que les animaux me fascinent d''un point de vue photographique pas de sourires forcés que du naturel  ...', 'Fabien Garcia'),
(5, 'Nouvel album Maroc', 'Retour sur un voyage au pays des mille et une nuits', '2011-12-03', 'Voilà une nouvelle série de photos prise au Maroc. Les clichés ont été fait dans différentes villes du pays. Un voyage qui m''a beaucoup appris sur cette culture fascinante.', 'Fabien Garcia'),
(6, 'Asie', 'Un nouvel album', '2011-12-07', 'Et oui encore un nouvel album, je dois dire que cette fois les photos ne sont pas fraîche, mais le souvenir reste intact. \r\n\r\nPour ne pas faire de jaloux cette fois c''est depuis l''Asie que viennent ces photos. Vietnam et Thaïlande, deux pays où la démocratie n''est pas au meilleur de sa forme mais qui reste cependant magnifiques. Bref un petit retour sur le continent du soleil de levant', 'Fabien Garcia');

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `createdAt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Message`
--

INSERT INTO `Message` (`id`, `sender`, `subject`, `content`, `createdAt`) VALUES
(3, 'lool13770@hotmail.com', 'petite critique objective', 'alor alor que dire sur ton nouveau site hey ben on va le faire en deux points\r\npoint positifs:\r\n- la présentation des differents albums est joli avec le petit commentaire c''est sympa\r\n- le site est fonctionnelle, pratique d''utilisation.\r\n- les photo sont joli \r\n- la page d''accueil avec les fotos en fond qui changent c''est sympa\r\n-la présentation en général est joli également\r\n- les photo défile vite sans bug avec la croix si on veut sortir qui est pratique\r\npoint négative (désolé):\r\n- les photo ', '2011-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `Picture`
--

CREATE TABLE IF NOT EXISTS `Picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `createdAt` date DEFAULT NULL,
  `is_background` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D96676151137ABCF` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=220 ;

--
-- Contenu de la table `Picture`
--

INSERT INTO `Picture` (`id`, `album_id`, `name`, `location`, `createdAt`, `is_background`) VALUES
(5, 3, 'leçon', 'f24d48b1b0f10581eae5abc0a296dde2.jpg', '2011-10-29', 0),
(6, 3, 'leçon', 'eb7cfc8267e7b77675010c684d35eca2.jpg', '2011-10-29', 0),
(7, 3, 'leçon', 'cf62d8ce38ef109689aa00facb444f01.jpg', '2011-10-29', 0),
(8, 3, 'leçon 2', 'de06757943c7b13984f29a8238c19521.jpg', '2011-10-29', 0),
(9, 3, 'leçon', 'd63ea1f6607fd0de0823e9159c50f477.jpg', '2011-10-29', 0),
(12, 3, 'fond2', 'bf62da92339867493df8dd6fc064c218.jpg', '2011-10-29', 1),
(13, 3, 'fond2', 'fa766e1dc68e4df012732331affa96e8.jpg', '2011-10-29', 1),
(14, 3, 'fond3', 'c8f97ebfca3adf90b301b7af1a37dd3f.jpg', '2011-10-29', 1),
(16, 3, 'leçon', 'phpJ8y3zA.jpg', '2011-10-29', 0),
(19, 13, 'FA092878.jpg', 'FA092878.jpg.jpg', '2011-10-29', 0),
(20, 6, 'FA194383.jpg', 'FA194383.jpg.jpg', '2011-10-29', 0),
(21, 12, 'FA136483.jpg', 'FA136483.jpg.jpg', '2011-10-29', 0),
(22, 12, 'FA136377.jpg', 'FA136377.jpg.jpg', '2011-10-29', 0),
(23, 13, 'FA092862.jpg', 'FA092862.jpg.jpg', '2011-10-29', 0),
(24, 13, 'FA103070.jpg', 'FA103070.jpg.jpg', '2011-10-29', 0),
(25, 13, 'FA183934.jpg', 'FA183934.jpg.jpg', '2011-10-29', 0),
(26, 6, 'FA106031.jpg', 'FA106031.jpg.jpg', '2011-10-29', 0),
(27, 6, 'FA106066.jpg', 'FA106066.jpg.jpg', '2011-10-29', 0),
(28, 13, 'FA062340.jpg', 'FA062340.jpg.jpg', '2011-10-29', 0),
(29, 6, 'FA184251.jpg', 'FA184251.jpg.jpg', '2011-10-29', 0),
(30, 6, 'FA054052.jpg', 'FA054052.jpg.jpg', '2011-10-29', 0),
(31, 6, 'FA126326.jpg', 'FA126326.jpg.jpg', '2011-10-29', 0),
(32, 12, 'FA156640.jpg', 'FA156640.jpg.jpg', '2011-10-29', 0),
(33, 12, 'FA166838.jpg', 'FA166838.jpg.jpg', '2011-10-29', 0),
(34, 6, 'FA214464.jpg', 'FA214464.jpg.jpg', '2011-10-29', 0),
(35, 6, 'FA184249.jpg', 'FA184249.jpg.jpg', '2011-10-29', 0),
(36, 6, 'FA156702.jpg', 'FA156702.jpg.jpg', '2011-10-29', 0),
(37, 13, 'FA092836.jpg', 'FA092836.jpg.jpg', '2011-10-29', 0),
(63, 12, 'FondVoyage1', 'phpq8TGRO.jpg.jpg', '2011-10-29', 1),
(64, 13, 'FondVoyage2', 'phpE610SM.jpg.jpg', '2011-10-29', 1),
(65, 6, 'FondVoyage3', 'phpYlGDjz.jpg.jpg', '2011-10-29', 1),
(66, 7, 'FA038439.jpg', 'FA038439.jpg.jpg', '2011-10-29', 0),
(67, 7, 'FA163825.jpg', 'FA163825.jpg.jpg', '2011-10-29', 0),
(68, 7, 'fondfabfoto9.jpg', 'fondfabfoto9.jpg.jpg', '2011-10-29', 1),
(69, 7, 'FA143454.jpg', 'FA143454.jpg.jpg', '2011-10-29', 0),
(70, 7, 'FA269012.jpg', 'FA269012.jpg.jpg', '2011-10-29', 0),
(71, 7, 'FA143567.jpg', 'FA143567.jpg.jpg', '2011-10-29', 0),
(72, 7, 'FA062946.jpg', 'FA062946.jpg.jpg', '2011-10-29', 0),
(74, 7, 'FA268895.jpg', 'FA268895.jpg.jpg', '2011-10-29', 0),
(75, 7, 'FA143608.jpg', 'FA143608.jpg.jpg', '2011-10-29', 0),
(76, 7, 'Promo 2012.jpg', 'FA079229ret.jpg.jpg', '2011-10-29', 0),
(77, 7, 'FA199473.jpg', 'FA199473.jpg.jpg', '2011-10-29', 0),
(78, 7, 'FA179827.jpg', 'FA179827.jpg.jpg', '2011-10-29', 0),
(79, 7, 'FA143489.jpg', 'FA143489.jpg.jpg', '2011-10-29', 0),
(80, 7, 'fondfabfoto8.jpg', 'fondfabfoto8.jpg.jpg', '2011-10-29', 1),
(81, 7, 'FA268916.jpg', 'FA268916.jpg.jpg', '2011-10-29', 0),
(82, 7, 'FA063271.jpg', 'FA063271.jpg.jpg', '2011-10-29', 0),
(85, 7, 'fondfabfoto7.jpg', 'fondfabfoto7.jpg.jpg', '2011-10-29', 1),
(86, 7, 'FA063297.jpg', 'FA063297.jpg.jpg', '2011-10-29', 0),
(87, 7, 'FA268940.jpg', 'FA268940.jpg.jpg', '2011-10-29', 0),
(88, 7, 'FA089291.jpg', 'FA089291.jpg.jpg', '2011-10-29', 0),
(89, 7, 'FA048805.jpg', 'FA048805.jpg.jpg', '2011-10-29', 0),
(90, 7, 'FA058866.jpg', 'FA058866.jpg.jpg', '2011-10-29', 0),
(91, 7, 'FA268798.jpg', 'FA268798.jpg.jpg', '2011-10-29', 0),
(92, 7, 'FA179832.jpg', 'FA179832.jpg.jpg', '2011-10-29', 0),
(93, 7, 'FA179807.jpg', 'FA179807.jpg.jpg', '2011-10-29', 0),
(94, 7, 'FA269167.jpg', 'FA269167.jpg.jpg', '2011-10-29', 0),
(96, 8, 'FA146850.jpg', 'FA146850.jpg.jpg', '2011-11-01', 0),
(97, 8, 'FA146833.jpg', 'FA146833.jpg.jpg', '2011-11-01', 0),
(98, 8, 'feuxdartifice5.jpg', 'feuxdartifice5.jpg.jpg', '2011-11-01', 0),
(99, 8, 'feuxdartifice.jpg', 'feuxdartifice.jpg.jpg', '2011-11-01', 0),
(100, 8, 'FA146877.jpg', 'FA146877.jpg.jpg', '2011-11-01', 0),
(101, 8, 'FA144797.jpg', 'FA144797.jpg.jpg', '2011-11-01', 0),
(102, 8, 'feuxdartifice4.jpg', 'feuxdartifice4.jpg.jpg', '2011-11-01', 0),
(103, 8, 'FA144841.jpg', 'FA144841.jpg.jpg', '2011-11-01', 0),
(104, 8, 'feuxdartifice2.jpg', 'feuxdartifice2.jpg.jpg', '2011-11-01', 0),
(105, 8, 'FA136760.jpg', 'FA136760.jpg.jpg', '2011-11-01', 0),
(106, 8, 'FA146823.jpg', 'FA146823.jpg.jpg', '2011-11-01', 0),
(107, 8, 'feuxdartifice3.jpg', 'feuxdartifice3.jpg.jpg', '2011-11-01', 0),
(108, 3, 'leçon 1', 'php89Qwiy.jpg.jpg', '2011-11-25', 0),
(109, 3, 'leçon 3', 'phpMSP1h8.jpg.jpg', '2011-11-25', 0),
(110, 3, 'leçon 28', 'phpDh0ivP.jpg.jpg', '2011-11-25', 0),
(111, 3, 'Tirer sur la corde', 'php5Ofcky.jpg.jpg', '2011-11-25', 0),
(112, 3, 'leçon 53', 'phposR5GE.jpg.jpg', '2011-11-25', 0),
(113, 3, 'leçon 49', 'phppKXasl.jpg.jpg', '2011-11-25', 0),
(114, 3, 'leçon 2', 'phpfblHDz.jpg.jpg', '2011-11-25', 0),
(115, 3, 'leçon 54', 'phpyKAfRg.jpg.jpg', '2011-11-25', 0),
(116, 9, 'Le groupe sauf ...', 'phprMbIne.jpg.jpg', '2011-11-25', 0),
(117, 9, 'Sur le port', 'php3JiL6L.jpg.jpg', '2011-11-25', 0),
(118, 9, 'La plus grande dune d''europe', 'phpCPWsbg.jpg.jpg', '2011-11-25', 0),
(119, 9, 'Le groupe sauf ...', 'phpBlbvSc.jpg.jpg', '2011-11-25', 0),
(120, 9, 'Le groupe sauf ...', 'phpa0dDL2.jpg.jpg', '2011-11-25', 0),
(121, 9, 'Le groupe sauf ...', 'phpMY3k1J.jpg.jpg', '2011-11-25', 0),
(122, 9, 'On t''aime', 'php5UVyLk.jpg.jpg', '2011-11-25', 0),
(123, 9, 'Dégustation de rhum', 'php9xaxYo.jpg.jpg', '2011-11-25', 0),
(124, 9, 'Dégustation de rhum 2', 'phpteBRBU.jpg.jpg', '2011-11-25', 0),
(125, 9, 'Dégustation de rhum 3', 'phpOnvdHH.jpg.jpg', '2011-11-25', 0),
(126, 9, 'Dégustation de rhum 4', 'phpy500GB.jpg.jpg', '2011-11-25', 0),
(127, 9, 'Après l''orage', 'php5PfIEQ.jpg.jpg', '2011-11-25', 0),
(128, 9, 'soirée', 'phpiIGytc.jpg.jpg', '2011-11-25', 0),
(129, 9, 'Dégustation de rhum', 'phpzWXQd2.jpg.jpg', '2011-11-25', 0),
(133, 9, 'fondclement', 'phpCVmhUi.jpg.jpg', '2011-11-25', 1),
(134, 8, 'fondfeux', 'phpZXAbIl.jpg.jpg', '2011-11-25', 1),
(135, 8, 'fondfeux2', 'php0BIYA2.jpg.jpg', '2011-11-25', 1),
(136, 10, 'Franckfort', 'phpLfqZht.jpg.jpg', '2011-11-29', 0),
(137, 10, 'Alsace', 'phpllEFTH.jpg.jpg', '2011-11-29', 0),
(138, 10, 'St petersbourg', 'phpfx5ksc.jpg.jpg', '2011-11-29', 0),
(139, 10, 'Alsace', 'phpg7k7Ht.jpg.jpg', '2011-11-29', 0),
(140, 10, 'Franckfort', 'php0mdRw3.jpg.jpg', '2011-11-29', 0),
(142, 8, 'Strasbourg', 'phpUpjPcG.jpg.jpg', '2011-11-29', 0),
(143, 8, 'Strasbourg', 'phpOR23sF.jpg.jpg', '2011-11-29', 0),
(144, 10, 'Venelles', 'phpoiGfrA.jpg.jpg', '2011-11-29', 0),
(145, 10, 'Allemagne', 'phpZZPvA0.jpg.jpg', '2011-11-29', 0),
(146, 10, 'Croatie', 'phpRQB8JK.jpg.jpg', '2011-11-29', 0),
(147, 10, 'fond1001Pates', 'phpuFUDZa.jpg.jpg', '2011-11-29', 1),
(148, 10, 'St Peter', 'phpFoa3kF.jpg.jpg', '2011-11-29', 0),
(149, 10, 'Berlin', 'phpcIqipN.jpg.jpg', '2011-11-29', 0),
(150, 10, 'venelles', 'phpyUfKnx.jpg.jpg', '2011-11-29', 0),
(151, 10, 'Russie', 'phpNGWNqn.jpg.jpg', '2011-11-29', 0),
(152, 11, 'Nantes', 'phpJq2RN4.jpg.jpg', '2011-11-29', 0),
(153, 11, 'Nantes', 'phpwKuCla.jpg.jpg', '2011-11-29', 0),
(154, 11, 'Venise', 'php3uifyr.jpg.jpg', '2011-11-29', 0),
(155, 11, 'Strasbourg', 'phpeWj709.jpg.jpg', '2011-11-29', 0),
(156, 11, 'Lyon', 'phpKRSEmc.jpg.jpg', '2011-11-30', 0),
(157, 11, 'Lyon', 'phpQLGMfb.jpg.jpg', '2011-11-30', 0),
(158, 11, 'Paris', 'phprP2eqt.jpg.jpg', '2011-11-30', 0),
(159, 11, 'Paris', 'php3FCexJ.jpg.jpg', '2011-11-30', 0),
(160, 11, 'Paris', 'phprkWQEo.jpg.jpg', '2011-11-30', 0),
(161, 10, 'maroc', 'php8AkdBu.jpg.jpg', '2011-11-30', 0),
(162, 8, 'Paris', 'phpwioAAe.jpg.jpg', '2011-11-30', 0),
(163, 10, 'aix en Provence', 'phpD5409I.jpg.jpg', '2011-11-30', 0),
(164, 10, 'aix en Provence', 'phpP9oRR3.jpg.jpg', '2011-11-30', 0),
(165, 10, 'aix en Provence', 'phpbafw1h.jpg.jpg', '2011-11-30', 0),
(166, 10, 'franckfort', 'phpRNLkih.jpg.jpg', '2011-11-30', 0),
(167, 12, 'maroc', 'phptqpctu.jpg.jpg', '2011-11-30', 0),
(168, 12, 'Marakech', 'phpI7aWOQ.jpg.jpg', '2011-11-30', 0),
(169, 10, 'Lyon', 'phpwfubKc.jpg.jpg', '2011-11-30', 0),
(170, 12, 'maroc', 'phpzQ0ENh.jpg.jpg', '2011-11-30', 0),
(171, 10, 'Paris', 'phpZ9r9s6.jpg.jpg', '2011-11-30', 0),
(172, 10, 'Paris', 'phpvWhTwS.jpg.jpg', '2011-11-30', 0),
(173, 11, 'Paris', 'phpKkANXt.jpg.jpg', '2011-11-30', 0),
(174, 12, 'desert', 'php2Nm7c7.jpg.jpg', '2011-11-30', 0),
(175, 12, 'un peu de desert', 'phppZWUMo.jpg.jpg', '2011-12-03', 0),
(176, 12, 'Mariage', 'phpaQJ7kw.jpg.jpg', '2011-12-03', 0),
(177, 12, 'dans le vent', 'phpYkTgaU.jpg.jpg', '2011-12-03', 0),
(178, 12, 'Dans la rue', 'phpHTiUeh.jpg.jpg', '2011-12-03', 0),
(179, 12, 'La place', 'phpH89b6h.jpg.jpg', '2011-12-03', 0),
(180, 7, 'Soirée noel', 'php3r8c4m.jpg.jpg', '2011-12-03', 0),
(181, 12, 'Les teintureries', 'phpJfNYou.jpg.jpg', '2011-12-03', 0),
(182, 12, 'maroc', 'phpRlNu97.jpg.jpg', '2011-12-03', 0),
(183, 10, 'United color of poussin', 'phpaoPYSc.jpg.jpg', '2011-12-03', 0),
(184, 10, 'marseille', 'phpjeOssK.jpg.jpg', '2011-12-03', 0),
(185, 12, 'maroc', 'phpm0TWnJ.jpg.jpg', '2011-12-03', 0),
(186, 10, 'sonic', 'phprax839.jpg.jpg', '2011-12-03', 0),
(187, 10, 'St petersbourg', 'phpd3ESm8.jpg.jpg', '2011-12-03', 0),
(188, 10, 'Berlin', 'phpP0e7ub.jpg.jpg', '2011-12-03', 0),
(189, 10, 'Berlin', 'phpdjcl4W.jpg.jpg', '2011-12-03', 0),
(190, 10, 'Berlin', 'phpd7o2fX.jpg.jpg', '2011-12-03', 0),
(191, 10, 'franckfort', 'phpPXvTZU.jpg.jpg', '2011-12-03', 0),
(192, 10, 'arraigne d''asie', 'phpsZpWji.jpg.jpg', '2011-12-03', 0),
(193, 13, 'Vietnam', 'php4J3Z3v.jpg.jpg', '2011-12-03', 0),
(194, 13, 'Maison sur piloti', 'phphBpCfg.jpg.jpg', '2011-12-03', 0),
(195, 13, 'Vietnam', 'php3L8oR9.jpg.jpg', '2011-12-03', 0),
(196, 13, 'Vietnam', 'phps4joPI.jpg.jpg', '2011-12-03', 0),
(197, 13, 'Vietnam', 'phpIKE8DW.jpg.jpg', '2011-12-03', 0),
(198, 13, 'Vietnam', 'phpdcxPQp.jpg.jpg', '2011-12-03', 0),
(199, 13, 'Vietnam', 'phpOlLTzx.jpg.jpg', '2011-12-03', 0),
(200, 13, 'Vietnam', 'phpS5LzRN.jpg.jpg', '2011-12-03', 0),
(201, 13, 'Vietnam', 'phph29wji.jpg.jpg', '2011-12-03', 0),
(202, 13, 'Vietnam', 'phpQMliAS.jpg.jpg', '2011-12-03', 0),
(203, 13, 'Vietnam', 'phpLBvb1h.jpg.jpg', '2011-12-03', 0),
(204, 10, 'Marseille', 'phprRYRzN.jpg.jpg', '2011-12-03', 0),
(205, 13, 'Vietnam', 'phpeR7j9d.jpg.jpg', '2011-12-03', 0),
(206, 8, 'spectacle venelles', 'php1dGZic.jpg.jpg', '2011-12-03', 0),
(207, 13, 'Vietnam', 'phpTdzpEZ.jpg.jpg', '2011-12-03', 0),
(208, 13, 'Vietnam', 'phpvvpuAf.jpg.jpg', '2011-12-03', 0),
(209, 13, 'Vietnam', 'php2yP4FF.jpg.jpg', '2011-12-03', 0),
(210, 10, 'montagne', 'phpCtRZLY.jpg.jpg', '2011-12-03', 0),
(211, 10, 'marseille', 'phpat917A.jpg.jpg', '2011-12-03', 0),
(212, 13, 'Vietnam', 'phpWDk1f4.jpg.jpg', '2011-12-03', 0),
(213, 10, 'Vietnam', 'phpac5BGH.jpg.jpg', '2011-12-03', 0),
(214, 13, 'Vietnam', 'phpAmJ2eX.jpg.jpg', '2011-12-03', 0),
(215, 13, 'Vietnam', 'phpT3PiMn.jpg.jpg', '2011-12-03', 0),
(216, 13, 'Vietnam', 'phpd1KJqS.jpg.jpg', '2011-12-03', 0),
(217, 13, 'Vietnam', 'phpDBn0ul.jpg.jpg', '2011-12-03', 0),
(218, 13, 'Vietnam', 'phpU4gPgl.jpg.jpg', '2011-12-03', 0),
(219, 11, 'FondVilles', 'phpI2I3R8.jpg.jpg', '2011-12-07', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Picture`
--
ALTER TABLE `Picture`
  ADD CONSTRAINT `FK_D96676151137ABCF` FOREIGN KEY (`album_id`) REFERENCES `Album` (`id`);
