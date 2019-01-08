-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 08 jan. 2019 à 08:00
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.8

SET FOREIGN_KEY_CHECKS=0;
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
-- Structure de la table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ta_apprentices_formations`
--

CREATE TABLE IF NOT EXISTS `ta_apprentices_formations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_Apprentice` int(11) NOT NULL,
  `FK_Formation` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ta_formations_modules`
--

CREATE TABLE IF NOT EXISTS `ta_formations_modules` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_Formation` int(11) NOT NULL,
  `FK_Module` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_apprentices`
--

CREATE TABLE IF NOT EXISTS `t_apprentices` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Date_Birth` date NOT NULL,
  `FK_Formation` int(11) NOT NULL,
  `FK_MSP` int(11) NOT NULL,
  `FK_User` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

CREATE TABLE IF NOT EXISTS `t_formations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name_Formation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Duration` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_grades`
--

CREATE TABLE IF NOT EXISTS `t_grades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Grade` decimal(2,1) NOT NULL,
  `FK_Apprentice_Formation` int(11) NOT NULL,
  `FK_Module_Subject` int(11) NOT NULL,
  `Date_Test` date NOT NULL,
  `Date_Inscription` date NOT NULL,
  `Weight` int(11) NOT NULL,
  `Semester` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_groups`
--

CREATE TABLE IF NOT EXISTS `t_groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name_Group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Weight` int(11) NOT NULL,
  `Eliminatory` tinyint(1) NOT NULL,
  `Position` int(11) NOT NULL,
  `FK_Parent_Group` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_modules_subjects`
--

CREATE TABLE IF NOT EXISTS `t_modules_subjects` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FK_Group` int(11) NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Is_Subject` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_msps`
--

CREATE TABLE IF NOT EXISTS `t_msps` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FK_User` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

CREATE TABLE IF NOT EXISTS `t_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FK_User_Type` int(11) NOT NULL,
  `User` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_user_types`
--

CREATE TABLE IF NOT EXISTS `t_user_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Access_Level` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
