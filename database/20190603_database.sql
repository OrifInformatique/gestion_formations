-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 03 juin 2019 à 15:05
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `gestion_formations`
--
CREATE DATABASE IF NOT EXISTS `gestion_formations` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gestion_formations`;

-- --------------------------------------------------------

--
-- Structure de la table `apprentices`
--

CREATE TABLE IF NOT EXISTS `apprentices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `fk_teacher` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher` (`fk_teacher`),
  KEY `fk_user` (`fk_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `apprentices_formations`
--

CREATE TABLE IF NOT EXISTS `apprentices_formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_apprentice` int(11) NOT NULL,
  `fk_formation` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_apprentice` (`fk_apprentice`),
  KEY `fk_formation` (`fk_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('6bgt3q5450o7ft7p8kpqskfe8sp7d7mp', '::1', 1559558957, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393535383935373b),
('a4dtuvednckh2afqocp9bvq6iq4l4ctb', '::1', 1559562553, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536323535333b),
('94tu9nie70fg08e24qf0amrsemk7vi6q', '::1', 1559562875, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536323837353b),
('uclkga5ore4s0df66307qiae2r5ue71r', '::1', 1559563192, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536333139323b),
('ou2c9d29bpjh4ors177gjtgofk4u76ot', '::1', 1559563667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536333636373b),
('cb9prdfgmjq43cscfgutfj26hgolgh9c', '::1', 1559564027, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536343032373b),
('g38b232eh2thchqu256dfm6e4hsmh79o', '::1', 1559564332, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536343333323b),
('tebaifu3v2t7hjou8vrbj5in8h6m2i1f', '::1', 1559564709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536343730393b),
('04j5580715hp4cpq88pni371l2a21cvp', '::1', 1559565371, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536353337313b),
('g6ttl4i5bo3g34epk2c69mh31452jh61', '::1', 1559565566, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535393536353337313b);

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE IF NOT EXISTS `formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_formation` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `name_formation`, `duration`) VALUES
(0, 'Aucune', 0),
(1, 'Stage d\'observation', 1),
(2, 'Développement d\'applications CFC', 4),
(3, 'Informatique d\'entreprise', 4),
(4, 'Technique des systèmes', 4),
(5, 'Médiamatique', 4),
(6, 'Opérateur en informatique', 3),
(7, 'Pré-apprentissage', 1);

-- --------------------------------------------------------

--
-- Structure de la table `formations_modules_groups`
--

CREATE TABLE IF NOT EXISTS `formations_modules_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `eliminatory` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `fk_parent_group` int(11) NOT NULL DEFAULT '0',
  `fk_formation` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parent_group` (`fk_parent_group`),
  KEY `fk_formation` (`fk_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formations_modules_groups`
--

INSERT INTO `formations_modules_groups` (`id`, `name_group`, `weight`, `eliminatory`, `position`, `fk_parent_group`, `fk_formation`) VALUES
(0, 'Aucun', 0, 0, 0, 0, 0),
(1, 'CIE', 20, 0, 1, 0, 0),
(2, 'Matières', 20, 0, 1, 0, 0),
(3, 'ECG', 20, 0, 1, 0, 0),
(4, 'Cours', 20, 0, 1, 0, 0),
(5, 'CIE (dev)', 30, 0, 2, 1, 2),
(6, 'Matières (dev)', 20, 0, 2, 2, 2),
(7, 'ECG (dev)', 20, 0, 2, 3, 2),
(8, 'Cours (dev)', 20, 0, 2, 4, 2),
(9, 'CIE (inf ent)', 20, 0, 3, 1, 3),
(10, 'Matières (inf ent)', 20, 0, 3, 2, 3),
(11, 'ECG (inf ent)', 20, 0, 3, 3, 3),
(12, 'Cours (inf ent)', 20, 0, 3, 4, 3),
(13, 'CIE (tec sys)', 20, 0, 4, 1, 4),
(14, 'Matières (tec sys)', 20, 0, 4, 2, 4),
(15, 'ECG (tec sys)', 20, 0, 4, 3, 4),
(16, 'Cours (tec sys)', 20, 0, 4, 4, 4),
(17, 'CIE (ope inf)', 20, 0, 5, 1, 6),
(18, 'Matières (ope inf)', 20, 0, 5, 2, 6),
(19, 'ECG (ope inf)', 20, 0, 5, 3, 6),
(20, 'Cours (ope inf)', 20, 0, 5, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` decimal(2,1) NOT NULL,
  `fk_apprentice_formation` int(11) NOT NULL,
  `fk_module_subject` int(11) NOT NULL,
  `date_test` date NOT NULL,
  `date_inscription` date NOT NULL,
  `weight` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_apprentice_formation` (`fk_apprentice_formation`),
  KEY `fk_module_subject` (`fk_module_subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `modules_groups`
--

CREATE TABLE IF NOT EXISTS `modules_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_formation_modules_group` int(11) NOT NULL,
  `fk_module` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_module` (`fk_module`),
  KEY `fk_formation_modules_group` (`fk_formation_modules_group`)
) ENGINE=InnoDB AUTO_INCREMENT=282 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modules_groups`
--

INSERT INTO `modules_groups` (`id`, `fk_formation_modules_group`, `fk_module`) VALUES
(21, 1, 12),
(22, 1, 15),
(23, 1, 16),
(24, 1, 22),
(25, 1, 31),
(26, 1, 32),
(27, 1, 33),
(28, 1, 34),
(29, 1, 35),
(30, 1, 36),
(31, 1, 37),
(32, 1, 54),
(33, 1, 55),
(34, 1, 56),
(35, 1, 57),
(36, 1, 58),
(37, 2, 6),
(38, 2, 7),
(39, 2, 8),
(40, 3, 9),
(41, 4, 10),
(42, 4, 11),
(43, 4, 13),
(44, 4, 14),
(45, 4, 17),
(46, 4, 18),
(47, 4, 19),
(48, 4, 20),
(49, 4, 21),
(50, 4, 23),
(51, 4, 24),
(52, 4, 25),
(53, 4, 26),
(54, 4, 27),
(55, 4, 28),
(56, 4, 29),
(57, 4, 30),
(58, 4, 38),
(59, 4, 39),
(60, 4, 40),
(61, 4, 41),
(62, 4, 42),
(63, 4, 43),
(64, 4, 44),
(65, 4, 45),
(66, 4, 46),
(67, 4, 47),
(68, 4, 48),
(69, 4, 49),
(70, 4, 50),
(71, 4, 51),
(72, 4, 52),
(73, 4, 53),
(74, 4, 59),
(75, 4, 60),
(76, 4, 61),
(77, 4, 62),
(78, 4, 63),
(79, 4, 64),
(80, 4, 65),
(81, 4, 66),
(82, 4, 67),
(83, 4, 68),
(84, 4, 69),
(85, 4, 70),
(86, 4, 71),
(87, 4, 72),
(88, 4, 73),
(89, 5, 12),
(90, 5, 15),
(91, 5, 16),
(92, 5, 22),
(93, 5, 31),
(94, 5, 32),
(95, 5, 33),
(96, 5, 34),
(97, 5, 35),
(98, 5, 36),
(99, 5, 37),
(100, 6, 6),
(101, 6, 7),
(102, 6, 8),
(103, 7, 9),
(104, 8, 10),
(105, 8, 11),
(106, 8, 13),
(107, 8, 14),
(108, 8, 17),
(109, 8, 18),
(110, 8, 19),
(111, 8, 20),
(112, 8, 21),
(113, 8, 23),
(114, 8, 24),
(115, 8, 25),
(116, 8, 26),
(117, 8, 27),
(118, 8, 28),
(119, 8, 29),
(120, 8, 30),
(121, 8, 38),
(122, 8, 39),
(123, 8, 40),
(124, 8, 41),
(125, 8, 42),
(126, 8, 43),
(127, 8, 44),
(128, 8, 45),
(129, 8, 46),
(130, 8, 47),
(131, 8, 48),
(132, 8, 49),
(133, 8, 50),
(134, 8, 51),
(135, 9, 12),
(136, 9, 15),
(137, 9, 16),
(148, 9, 54),
(163, 10, 6),
(164, 10, 7),
(165, 10, 8),
(166, 11, 9),
(167, 9, 22),
(168, 9, 31),
(169, 9, 32),
(170, 9, 33),
(171, 9, 35),
(172, 9, 36),
(173, 9, 55),
(174, 9, 56),
(175, 9, 57),
(176, 9, 58),
(177, 12, 10),
(178, 12, 11),
(179, 12, 13),
(180, 12, 14),
(181, 12, 17),
(182, 12, 18),
(183, 12, 19),
(184, 12, 20),
(185, 12, 21),
(186, 12, 23),
(187, 12, 24),
(188, 12, 25),
(189, 12, 26),
(190, 12, 27),
(191, 12, 28),
(192, 12, 29),
(193, 12, 30),
(194, 12, 38),
(195, 12, 42),
(196, 12, 43),
(197, 12, 47),
(198, 12, 48),
(199, 12, 49),
(200, 12, 50),
(201, 12, 51),
(202, 12, 52),
(203, 12, 53),
(204, 12, 59),
(205, 12, 60),
(206, 12, 61),
(207, 12, 62),
(208, 12, 63),
(209, 12, 64),
(210, 12, 65),
(211, 12, 66),
(212, 12, 67),
(213, 12, 68),
(214, 12, 69),
(215, 12, 70),
(216, 12, 71),
(217, 12, 72),
(218, 13, 12),
(219, 13, 15),
(220, 13, 16),
(221, 13, 22),
(222, 13, 31),
(223, 13, 54),
(224, 13, 55),
(225, 13, 56),
(226, 13, 57),
(227, 13, 58),
(228, 14, 6),
(229, 14, 7),
(230, 14, 8),
(231, 15, 9),
(232, 16, 10),
(233, 16, 11),
(234, 16, 13),
(235, 16, 14),
(236, 16, 17),
(237, 16, 18),
(238, 16, 19),
(239, 16, 20),
(240, 16, 21),
(241, 16, 23),
(242, 16, 24),
(243, 16, 25),
(244, 16, 26),
(245, 16, 27),
(246, 16, 28),
(247, 16, 29),
(248, 16, 30),
(249, 16, 38),
(250, 16, 39),
(251, 16, 40),
(252, 16, 41),
(253, 16, 42),
(254, 16, 43),
(255, 16, 44),
(256, 16, 45),
(257, 16, 46),
(258, 16, 47),
(259, 16, 48),
(260, 16, 49),
(261, 16, 50),
(262, 16, 51),
(263, 17, 16),
(264, 17, 74),
(265, 17, 75),
(267, 18, 6),
(268, 18, 7),
(269, 18, 8),
(270, 19, 9),
(271, 20, 17),
(272, 20, 18),
(273, 20, 19),
(274, 20, 48),
(275, 20, 49),
(276, 20, 50),
(277, 20, 61),
(278, 20, 63),
(279, 20, 76),
(280, 20, 77),
(281, 17, 15);

-- --------------------------------------------------------

--
-- Structure de la table `modules_subjects`
--

CREATE TABLE IF NOT EXISTS `modules_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL COMMENT '0 pour les matières',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modules_subjects`
--

INSERT INTO `modules_subjects` (`id`, `number`, `title`, `description`) VALUES
(6, 0, 'Math', ''),
(7, 0, 'Sciences naturelles', ''),
(8, 0, 'Anglais', ''),
(9, 0, 'ECG', ''),
(10, 100, '100 - Distinguer, préparer, évaluer des données', ''),
(11, 104, '104 - Implémenter un modèle de données', ''),
(12, 101, '101 - Réaliser, publier un site Web', ''),
(13, 403, '403 - Implém manière proc déroul progr', ''),
(14, 404, '404 - Programmer orienté object selon directives', ''),
(15, 304, '304 - Installer et configurer un ordinateur monoposte', ''),
(16, 305, '305 - Installer, configurer, administrer un système d\'exploitation', ''),
(17, 123, '123 - Activer les services d\'un serveur', ''),
(18, 117, '117 - Mettre en place l\'infrastructure informatique d\'une petite entreprise', ''),
(19, 431, '431 - Exécuter des mandats de manière autonome dans un environnement informatique', ''),
(20, 114, '114 - Systèmes de codification compr, encryptage', ''),
(21, 153, '153 - Développer les modèles de données', ''),
(22, 105, '105 - Traiter une BDD avec SQL', ''),
(23, 151, '151 - Intégrer des BDD dans une APP WEB', ''),
(24, 133, '133 - Réaliser des app Web en Session-Handling', ''),
(25, 326, '326 - Dév et impl orienté objet', ''),
(26, 226, '226A - Implémenter orienté objet', '226A'),
(27, 226, '226B - Implémenter orienté objet', '226B'),
(28, 183, '183 - Implémenter la sécurité d\'une APP', ''),
(29, 120, '120 - Impl les interfaces graphiques d\'appl', ''),
(30, 306, '306 - Réaliser un petit projet IT', ''),
(31, 302, '302 - Fonctions avancées d\'Office', ''),
(32, 307, '307 - Réaliser des pages Web interactives', ''),
(33, 256, '256 - Réaliser la partie cliente APP Web', ''),
(34, 335, '335 - Réaliser une App pour mobile', ''),
(35, 318, '318 - Analys, progr OO avec composants', ''),
(36, 223, '223 - Réaliser des APP multi-utilisateurs OO', ''),
(37, 154, '154 - Organiser exploit d\'applications', ''),
(38, 301, '301 - Appliquer les outils bureautiques', ''),
(39, 254, '254 - Décrire des processus métier', ''),
(40, 152, '152 - Intégrer contenus multimédia dans une application Web', ''),
(41, 150, '150 - Adapter une appl E-commerce', ''),
(42, 426, '426 - Dév logiciel avec des méthodes agiles', ''),
(43, 411, '411 - Dev/appl struct données/algo', ''),
(44, 253, '253 - Visualiser les signaux de capteurs', ''),
(45, 242, '242 - Réaliser des appl microproc', ''),
(46, 155, '155 - Dév des procédures temps réel', ''),
(47, 121, '121 - Elaborer des tâches de pilotage', ''),
(48, 214, '214 - Instruire les utilisateurs à l\'IT', ''),
(49, 122, '122 - Automatiser des procédures à l\'aide de scripts', ''),
(50, 129, '129 - Mettre en service des composants réseaux', ''),
(51, 213, '213 - Développer l\'esprit d\'équipe', ''),
(52, 159, '159 - Config sync le service d\'annulaire', ''),
(53, 143, '143 - Syst sauvegarde/restoration', ''),
(54, 127, '127 - Assur l\'exploit de serveurs', ''),
(55, 340, '340 - Mettre en service des srv virtuels', ''),
(56, 330, '330 - Mettre en service un syst de tél IP', ''),
(57, 130, '130 - Contrôler un réseau et mesurer ses flux', ''),
(58, 184, '184 - Implémenter la sécurité réseau', ''),
(59, 158, '158 - Planifier, exécuter la migr de logiciels', ''),
(60, 138, '138 - Planifier et installer des postes de travail', ''),
(61, 437, '437 - Travailler dans le support', ''),
(62, 157, '157 - Planif, exec, introd d\'un système IT', ''),
(63, 126, '126 - Installer des périphériques en réseau', ''),
(64, 124, '124 - Etendre/modif place trav avec ordinateur', ''),
(65, 115, '115 - Mettre en service install multimédia', ''),
(66, 300, '300 - Intégrer serv rés multi-plateformes', ''),
(67, 239, '239 - Mettre en service un serveur Web', ''),
(68, 141, '141 - Installer des systèmes de BDD', ''),
(69, 140, '140 - Admin, exploiter des BDD', ''),
(70, 146, '146 - Relier une entreprise à internet', ''),
(71, 145, '145 - Exploiter et étendre un réseau', ''),
(72, 182, '182 - Implémenter la sécurité système', ''),
(73, 156, '156 - Dév nouv services, planif introduction', ''),
(74, 260, '260 - Mettre en pratique des outils d\'Office', ''),
(75, 261, '261 - Assurer la fonction des terminaux ICT utilisateurs dans l\'infrastructure réseau', ''),
(76, 262, '262 - Exécuter l\'évaluation de moyens ICT', ''),
(77, 263, '263 - Assurer la sécurité des terminaux ICT utilisateurs', '');

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`fk_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `teachers`
--

INSERT INTO `teachers` (`id`, `firstname`, `last_name`, `fk_user`) VALUES
(0, 'Aucun', '', 0),
(1, 'Sven', 'Kholer', 0),
(2, 'Frédéric', 'Meuwly', 0),
(3, 'Teresa', 'Valente', 0),
(4, 'Didier', 'Viret', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_type` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_type` (`fk_user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fk_user_type`, `user`, `password`) VALUES
(0, 0, 'Aucun', ''),
(1, 2, 'Orif', '$2y$10$x8JOOyEwn.kBEBnZ7TL4D.OD9pq5P03mjKAn.k.sEVpYyYi44NMKe'),
(2, 2, 'Admin', '$2y$10$9SkOLP51.toHgX23xLHDMe7F6KjvVpiUxlKmY/56QkWowUoW3Y0Ku'),
(3, 1, 'Invite', '$2y$10$KuzesbykAjghQvV08qaTqOx2X0reN.rR2LFSI0Rhj9D2xGeprRukG');

-- --------------------------------------------------------

--
-- Structure de la table `users_types`
--

CREATE TABLE IF NOT EXISTS `users_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users_types`
--

INSERT INTO `users_types` (`id`, `type`, `access_level`) VALUES
(0, 'Aucun', 0),
(1, 'Visiteur', 1),
(2, 'Administrateur', 4),
(3, 'Enregistré', 2),
(4, 'Invité', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apprentices`
--
ALTER TABLE `apprentices`
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`fk_teacher`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `apprentices_formations`
--
ALTER TABLE `apprentices_formations`
  ADD CONSTRAINT `apprentices_formations_ibfk_1` FOREIGN KEY (`fk_apprentice`) REFERENCES `apprentices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `apprentices_formations_ibfk_2` FOREIGN KEY (`fk_formation`) REFERENCES `formations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `formations_modules_groups`
--
ALTER TABLE `formations_modules_groups`
  ADD CONSTRAINT `formations_modules_groups_ibfk_1` FOREIGN KEY (`fk_parent_group`) REFERENCES `formations_modules_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `formations_modules_groups_ibfk_2` FOREIGN KEY (`fk_formation`) REFERENCES `formations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`fk_module_subject`) REFERENCES `modules_subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`fk_apprentice_formation`) REFERENCES `apprentices_formations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `modules_groups`
--
ALTER TABLE `modules_groups`
  ADD CONSTRAINT `modules_groups_ibfk_2` FOREIGN KEY (`fk_module`) REFERENCES `modules_subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `modules_groups_ibfk_3` FOREIGN KEY (`fk_formation_modules_group`) REFERENCES `formations_modules_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_user_type`) REFERENCES `users_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
