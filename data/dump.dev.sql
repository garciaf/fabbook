-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 20 Mars 2012 à 08:03
-- Version du serveur: 5.1.58
-- Version de PHP: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `fabfoto`
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
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `Album`
--

INSERT INTO `Album` (`id`, `name`, `comment`, `createdAt`, `slug`) VALUES
(3, 'PolyBad''', 'Les dessous de Polytech''', '2011-10-29', 'polybad'),
(9, 'Voyages', 'Le monde est un voyage', '2011-12-18', 'voyages');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `Article`
--

INSERT INTO `Article` (`id`, `title`, `subtitle`, `createdAt`, `content`, `author`) VALUES
(1, 'Nouveau Site fabfoto', 'On prend tout on recommence', '2011-10-29', 'Le site a été refait de fond en comble pour les connaisseurs sinon bienvenu aux nouveaux j''espère que vous apprécierez la visite et n''hésitez pas à laisser vos commentaire sur mon mail :\r\nfab0670312047[at]gmail.com\r\nUne page de contact est en construction ...', 'Fabien Garcia'),
(2, 'Nouveau article', 'encore', '2011-12-02', 'C''est  bien non ?', 'Fabien Garcia'),
(3, '3', 'test 3', '2011-12-07', 'article', 'Fabien Garcia'),
(4, 'Nouveau Site fabfoto 4', 'On prend tout on recommence', '2011-12-07', 'dzzdzddz', 'Fabien Garcia'),
(5, 'Nouveau Site fabfoto 5', 'On prend tout on recommence', '2011-12-07', 'zeez', 'Fabien Garcia'),
(6, 'Nouveau Site fabfoto 6', 'On prend tout on recommence', '2011-12-07', 'zddz <b> C''est en gras </b>', 'Fabien Garcia'),
(7, 'Le dernier', 'last', '2011-12-08', 'last', 'Fabien Garcia'),
(8, 'Un nouvel', 'Avec un sous titre', '2011-12-15', '<p>Voici un autre article avec&nbsp;<strong>du gras&nbsp;</strong><em>de l''italique&nbsp;<span style="text-decoration: underline;">du soulign&eacute;&nbsp;</span></em></p>\r\n<p><em><span style="text-decoration: underline;">Et&nbsp;</span></em><span style="text-decoration: underline;"></span>du texte&nbsp;<span style="color: #ff0000;">Rouge&nbsp;</span></p>', 'Fabien Garcia');

-- --------------------------------------------------------

--
-- Structure de la table `ArticleBlog`
--

CREATE TABLE IF NOT EXISTS `ArticleBlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `author` varchar(255) NOT NULL,
  `slugblog` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ArticleBlog`
--

INSERT INTO `ArticleBlog` (`id`, `createdAt`, `updatedAt`, `title`, `subtitle`, `content`, `author`, `slugblog`) VALUES
(1, '2011-12-09 00:00:00', '2011-12-08 00:00:00', 'Nouveau blogés dès là', 'Ouverture dés blogès', '<p>Du&nbsp;<strong>Gras</strong></p>', 'Fabien Garcia', 'nouveau-bloges-des-la'),
(2, '2011-12-13 00:00:00', '2011-12-22 00:00:00', 'News', 'Le sous titre', '<p>Salut &agrave; tous&nbsp;</p>\r\n<blockquote>\r\n<p>Un peu de code en C&nbsp;</p>\r\n</blockquote>\r\n<p>Et encore du texte</p>', 'Fabien Garcia', 'news'),
(3, '2012-03-18 00:00:00', '2012-03-18 00:00:00', 'Un nouveau test', 'un autre petit test', '<p>et kjjmmn</p>', 'Fabien Garcia', 'un-nouveau-test');

-- --------------------------------------------------------

--
-- Structure de la table `ArticleBlog_tags`
--

CREATE TABLE IF NOT EXISTS `ArticleBlog_tags` (
  `articleblog_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`articleblog_id`,`tag_id`),
  KEY `IDX_618A506349140E94` (`articleblog_id`),
  KEY `IDX_618A5063BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ArticleBlog_tags`
--

INSERT INTO `ArticleBlog_tags` (`articleblog_id`, `tag_id`) VALUES
(1, 2),
(2, 2),
(2, 3),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Author`
--

CREATE TABLE IF NOT EXISTS `Author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `googleLink` varchar(255) NOT NULL,
  `facebookLink` varchar(255) NOT NULL,
  `gitHubLink` varchar(255) NOT NULL,
  `linkedLink` varchar(255) NOT NULL,
  `twitterLink` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Author`
--

INSERT INTO `Author` (`id`, `name`, `firstname`, `description`, `googleLink`, `facebookLink`, `gitHubLink`, `linkedLink`, `twitterLink`, `mail`, `title`, `phone`) VALUES
(1, 'Garcia', 'Fabien', 'Passionné d''informatique et toujours à la recherche des nouveauté mais toujours avec la même copine mlle Olga Delafleure', 'http://google.com', 'http://facebook.com', 'http://github.com', 'http://linked.com', 'http://twitter.com', 'fab0670312047@gmail.com', 'Ingénieur Informaticien', '+33670312047');

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(500) NOT NULL,
  `createdAt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `Message`
--

INSERT INTO `Message` (`id`, `sender`, `subject`, `content`, `createdAt`) VALUES
(4, 'fab0670312047@gmail.com', 'Test Fabboook', 'Un petit message pour dire', '2012-03-17'),
(5, 'fab0670312047@gmail.com', 'kjgj', 'hghjglkjh jkh lmk mk', '2012-03-17'),
(6, 'for.olga.panova@gmail.com', 'jhgjkhg', 'gluuihlkj', '2012-03-17'),
(7, 'for.olga.panova@gmail.com', 'un message', 'ljhmlsdl', '2012-03-17'),
(8, 'for.olga.panova@gmail.com', 'super site !!', 'c''est vraiment un super site', '2012-03-17'),
(9, 'for.olga.panova@gmail.com', 'super site !!', 'c''est vraiment un super site', '2012-03-17'),
(10, 'for.olga.panova@gmail.com', 'super site !!', 'c''est vraiment un super site', '2012-03-17'),
(11, 'for.olga.panova@gmail.com', 'super site !!', 'c''est vraiment un super site', '2012-03-17'),
(12, 'for.olga.panova@gmail.com', 'super site !!', 'c''est vraiment un super sites', '2012-03-17'),
(13, 'for.olga.panova@gmail.com', 'super site !!', 'c''est vraiment un super sites', '2012-03-17'),
(14, 'for.olga.panova@gmail.com', 'super site !!', 'c''est vraiment un super sites', '2012-03-17'),
(15, 'for.olga.panova@gmail.com', 'C''est super ton site', 'C''est vraiment trop bien', '2012-03-17'),
(16, 'for.olga.panova@gmail.com', 'C''est super ton site', 'C''est vraiment trop bien', '2012-03-17'),
(17, 'for.olga.panova@gmail.com', 'C''est super ton site', 'C''est vraiment trop bien', '2012-03-17'),
(18, 'for.olga.panova@gmail.com', 'Test Fabboook', 'Un petit mail pour voir', '2012-03-17'),
(19, 'fab0670312047@gmail.com', 'super site !!', 'jkksjdhql', '2012-03-18');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20111210203733'),
('20111210224219'),
('20111211125523'),
('20111211130302'),
('20111211164059'),
('20111213214808'),
('20111213233130'),
('20111214225106');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

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
(108, 3, 'leçon', 'phpw2ArMZ.jpg.jpg', '2011-11-11', 0),
(109, 3, 'leçon 1', 'phpzCAeU8.jpg.jpg', '2011-11-25', 0),
(110, 9, 'zzz', 'phpkePkxx.jpg.jpg', '2011-12-18', 0),
(111, 3, 'aboutme', 'phpQ4Doe5.jpg.jpg', '2012-03-18', 0),
(112, 3, 'leçon', 'phpwURzpb.jpg.jpg', '2012-03-19', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Tag`
--

CREATE TABLE IF NOT EXISTS `Tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `Tag`
--

INSERT INTO `Tag` (`id`, `name`, `slug`) VALUES
(1, 'Informatique', 'informatique'),
(2, 'Symfony2', 'symfony2'),
(3, 'Blog', 'blog'),
(4, 'gfgf', 'gfgf'),
(5, 'dtrt', 'dtrt'),
(6, 'ééééàààeriou', 'eeeeaaaeriou');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ArticleBlog_tags`
--
ALTER TABLE `ArticleBlog_tags`
  ADD CONSTRAINT `FK_618A506349140E94` FOREIGN KEY (`articleblog_id`) REFERENCES `ArticleBlog` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_618A5063BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `Tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Picture`
--
ALTER TABLE `Picture`
  ADD CONSTRAINT `FK_D96676151137ABCF` FOREIGN KEY (`album_id`) REFERENCES `Album` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
