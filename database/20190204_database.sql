-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 04 fév. 2019 à 13:33
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

DROP TABLE IF EXISTS `apprentices`;
CREATE TABLE IF NOT EXISTS `apprentices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `fk_formation` int(11) NOT NULL,
  `fk_teacher` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_formation` (`fk_formation`),
  KEY `fk_teacher` (`fk_teacher`),
  KEY `fk_user` (`fk_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `apprentices_formations`
--

DROP TABLE IF EXISTS `apprentices_formations`;
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

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_formation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formations_modules`
--

DROP TABLE IF EXISTS `formations_modules`;
CREATE TABLE IF NOT EXISTS `formations_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_formation` int(11) NOT NULL,
  `fk_module` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_formation` (`fk_formation`),
  KEY `fk_module` (`fk_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

DROP TABLE IF EXISTS `grades`;
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

DROP TABLE IF EXISTS `modules_groups`;
CREATE TABLE IF NOT EXISTS `modules_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `eliminatory` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `fk_parent_group` int(11) DEFAULT NULL COMMENT 'Ne pas mettre sur soi-même',
  PRIMARY KEY (`id`),
  KEY `fk_parent_group` (`fk_parent_group`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `modules_groups`
--

INSERT INTO `modules_groups` (`id`, `name_group`, `weight`, `eliminatory`, `position`, `fk_parent_group`) VALUES
(0, 'Aucun', 0, 0, 0, NULL),
(1, 'Général', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `modules_subjects`
--

DROP TABLE IF EXISTS `modules_subjects`;
CREATE TABLE IF NOT EXISTS `modules_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL COMMENT '0 pour les matières',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_group` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_group` (`fk_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`fk_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_type` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_type` (`fk_user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users_types`
--

DROP TABLE IF EXISTS `users_types`;
CREATE TABLE IF NOT EXISTS `users_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users_types`
--

INSERT INTO `users_types` (`id`, `type`, `access_level`) VALUES
(0, 'Aucun', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apprentices`
--
ALTER TABLE `apprentices`
  ADD CONSTRAINT `fk_formation` FOREIGN KEY (`fk_formation`) REFERENCES `formations` (`id`),
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`fk_teacher`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `apprentices_formations`
--
ALTER TABLE `apprentices_formations`
  ADD CONSTRAINT `apprentices_formations_ibfk_1` FOREIGN KEY (`fk_apprentice`) REFERENCES `apprentices` (`id`),
  ADD CONSTRAINT `apprentices_formations_ibfk_2` FOREIGN KEY (`fk_formation`) REFERENCES `formations` (`id`);

--
-- Contraintes pour la table `formations_modules`
--
ALTER TABLE `formations_modules`
  ADD CONSTRAINT `formations_modules_ibfk_1` FOREIGN KEY (`fk_formation`) REFERENCES `formations` (`id`),
  ADD CONSTRAINT `formations_modules_ibfk_2` FOREIGN KEY (`fk_module`) REFERENCES `modules_subjects` (`id`);

--
-- Contraintes pour la table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`fk_module_subject`) REFERENCES `modules_subjects` (`id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`fk_apprentice_formation`) REFERENCES `apprentices_formations` (`id`);

--
-- Contraintes pour la table `modules_groups`
--
ALTER TABLE `modules_groups`
  ADD CONSTRAINT `modules_groups_ibfk_1` FOREIGN KEY (`fk_parent_group`) REFERENCES `modules_groups` (`id`);

--
-- Contraintes pour la table `modules_subjects`
--
ALTER TABLE `modules_subjects`
  ADD CONSTRAINT `modules_subjects_ibfk_1` FOREIGN KEY (`fk_group`) REFERENCES `modules_groups` (`id`);

--
-- Contraintes pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_user_type`) REFERENCES `users_types` (`id`);
COMMIT;
