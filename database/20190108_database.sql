-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 08 jan. 2019 à 11:45
-- Version du serveur :  10.1.35-MariaDB
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_formations`
--

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ta_apprentices_formations`
--

CREATE TABLE `ta_apprentices_formations` (
  `ID` int(11) NOT NULL,
  `FK_Apprentice` int(11) NOT NULL,
  `FK_Formation` int(11) NOT NULL,
  `Year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ta_formations_modules`
--

CREATE TABLE `ta_formations_modules` (
  `ID` int(11) NOT NULL,
  `FK_Formation` int(11) NOT NULL,
  `FK_Module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_apprentices`
--

CREATE TABLE `t_apprentices` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Date_Birth` date NOT NULL,
  `FK_Formation` int(11) NOT NULL,
  `FK_MSP` int(11) NOT NULL,
  `FK_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

CREATE TABLE `t_formations` (
  `ID` int(11) NOT NULL,
  `Name_Formation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_grades`
--

CREATE TABLE `t_grades` (
  `ID` int(11) NOT NULL,
  `Grade` decimal(2,1) NOT NULL,
  `FK_Apprentice_Formation` int(11) NOT NULL,
  `FK_Module_Subject` int(11) NOT NULL,
  `Date_Test` date NOT NULL,
  `Date_Inscription` date NOT NULL,
  `Weight` int(11) NOT NULL,
  `Semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_groups`
--

CREATE TABLE `t_groups` (
  `ID` int(11) NOT NULL,
  `Name_Group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Weight` int(11) NOT NULL,
  `Eliminatory` tinyint(1) NOT NULL,
  `Position` int(11) NOT NULL,
  `FK_Parent_Group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_modules_subjects`
--

CREATE TABLE `t_modules_subjects` (
  `ID` int(11) NOT NULL,
  `Number` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FK_Group` int(11) NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_msps`
--

CREATE TABLE `t_msps` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FK_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

CREATE TABLE `t_users` (
  `ID` int(11) NOT NULL,
  `FK_User_Type` int(11) NOT NULL,
  `User` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_user_types`
--

CREATE TABLE `t_user_types` (
  `ID` int(11) NOT NULL,
  `Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Access_Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Index pour la table `ta_apprentices_formations`
--
ALTER TABLE `ta_apprentices_formations`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `ta_formations_modules`
--
ALTER TABLE `ta_formations_modules`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_apprentices`
--
ALTER TABLE `t_apprentices`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_formations`
--
ALTER TABLE `t_formations`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_grades`
--
ALTER TABLE `t_grades`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_groups`
--
ALTER TABLE `t_groups`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_modules_subjects`
--
ALTER TABLE `t_modules_subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_msps`
--
ALTER TABLE `t_msps`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `t_user_types`
--
ALTER TABLE `t_user_types`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ta_apprentices_formations`
--
ALTER TABLE `ta_apprentices_formations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ta_formations_modules`
--
ALTER TABLE `ta_formations_modules`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_apprentices`
--
ALTER TABLE `t_apprentices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_formations`
--
ALTER TABLE `t_formations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_grades`
--
ALTER TABLE `t_grades`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_groups`
--
ALTER TABLE `t_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_modules_subjects`
--
ALTER TABLE `t_modules_subjects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_msps`
--
ALTER TABLE `t_msps`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_user_types`
--
ALTER TABLE `t_user_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
