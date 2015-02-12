--
-- Base de données :  `joom_estivale2015`
--

-- --------------------------------------------------------

--
-- Structure de la table `#__estivole_calendars`
--

CREATE TABLE IF NOT EXISTS `#__estivole_calendars` (
  `calendar_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `published` tinyint(2) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`calendar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `#__estivole_daytimes`
--

CREATE TABLE IF NOT EXISTS `#__estivole_daytimes` (
  `daytime_id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `daytime_day` date NOT NULL,
  `daytime_hour_start` datetime NOT NULL,
  `daytime_hour_end` datetime NOT NULL,
  `quota` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`daytime_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `#__estivole_members`
--

CREATE TABLE IF NOT EXISTS `#__estivole_members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `firstname` varchar(150) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `npa` int(11) DEFAULT NULL,
  `tshirtsize` varchar(5) DEFAULT NULL,
  `availibility` varchar(50) DEFAULT NULL,
  `friendgroup` varchar(100) DEFAULT NULL,
  `favchoices` varchar(5) DEFAULT NULL,
  `comment` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `#__estivole_members_daytimes`
--

CREATE TABLE IF NOT EXISTS `#__estivole_members_daytimes` (
  `member_daytime_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `daytime_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`member_daytime_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `#__estivole_services`
--

CREATE TABLE IF NOT EXISTS `#__estivole_services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `summary` text CHARACTER SET utf16,
  `image` varchar(255) CHARACTER SET utf16 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `#__estivole_services`
--

INSERT INTO `#__estivole_services` (`service_id`, `name`, `summary`, `image`, `created`, `modified`) VALUES
(1, 'Accueil / Informations', '<ul>\r\n<li>Préparation et mise en place de l''accueil</li>\r\n<li>Accueil, réception et distriibution des invitations et accréditations à la caisse</li>\r\n<li>Gestion du bancomat (paiement avec cartes et distribution du cash en échange)</li>\r\n</ul>', NULL, '2014-11-06 22:22:18', '2014-11-06 22:22:18'),
(2, 'Bars', '<ul>\r\n<li>Service aux bars</li>\r\n<li>Nettoyage et préparation des bars durant la journée</li>\r\n<li>Préparation des cocktails durant la journée (découpage des citrons, effeuillage menthe, etc...)</li>\r\n</ul>', NULL, NULL, NULL),
(3, 'Camping', '<ul>\r\n<li>Accueil des nouveaux arrivants</li>\r\n<li>Entretien du camping</li>\r\n<li>Encaissement des locations de place & retour à la caisse</li>\r\n</ul>', NULL, NULL, NULL),
(4, 'Cuisine', '<ul>\r\n<li>Service aux bénévoles</li>\r\n<li>Service aux artistes</li>\r\n<li>Nettoyage et rangement du lieu de repas</li>\r\n<li>Nettoyage des WC</li>\r\n</ul>', NULL, NULL, NULL),
(5, 'Décoration', '<ul>\r\n<li>Décoration du site</li>\r\n<li>Décoration des backstages</li>\r\n<li>Aide à la mise en place des backstages</li>\r\n<li>Démontage, rangement et transport</li>\r\n</ul>', NULL, NULL, NULL),
(6, 'Economat / Ravitaillement', '<ul>\r\n<li>Préparation des bars pour le soir (remplissage des frigos, inventaire des bars, etc...)</li>\r\n<li>Ravitaillement aux bars durant les soirées si nécessaires</li>\r\n</ul>', NULL, NULL, NULL),
(7, 'Infrastructure / Montage', '<ul>\r\n<li>Montage des stands</li>\r\n<li>Montage des infrastructures</li>\r\n<li>Mise en place des backstages</li>\r\n<li>Mise en place de l''espace bénévoles</li>\r\n<li>Nettoyage du site, poubelles, etc...</li>\r\n<li>Nettoyage des WC</li>\r\n<li>Démontage du site</li>\r\n</ul>', NULL, NULL, NULL),
(8, 'Electricité', '<ul>\r\n<li>Transport du matériel</li>\r\n<li>Mise en place des tableaux de distributions</li>\r\n<li>Eclairage du site</li>\r\n<li>Alimentation des stands et scènes</li>\r\n<li>Maintenance et amélioration</li>\r\n<li>Service de piquet</li>\r\n<li>Démontage, rangement et transport</li>\r\n</ul>', NULL, NULL, NULL),
(9, 'Sécurité', '', NULL, NULL, NULL),
(10, 'VIP / Loges', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `#__estivole_services_daytimes`
--

CREATE TABLE IF NOT EXISTS `#__estivole_services_daytimes` (
  `id_daytime` int(11) NOT NULL,
  `id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;
