-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 17 Mars 2018 à 20:36
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `maviance`
--

-- --------------------------------------------------------

--
-- Structure de la table `kingdom`
--

CREATE TABLE `kingdom` (
  `id` int(11) NOT NULL,
  `length_n` int(11) UNSIGNED NOT NULL,
  `width_m` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `kingdom`
--

INSERT INTO `kingdom` (`id`, `length_n`, `width_m`) VALUES
(16, 6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `queen`
--

CREATE TABLE `queen` (
  `id` int(11) NOT NULL,
  `place_x` int(11) NOT NULL,
  `place_y` int(11) NOT NULL,
  `kingdom_id` int(11) NOT NULL,
  `facing` enum('NORTH','SOUTH','WEST','EAST') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `queen`
--

INSERT INTO `queen` (`id`, `place_x`, `place_y`, `kingdom_id`, `facing`) VALUES
(1, 2, 4, 16, 'WEST');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `kingdom`
--
ALTER TABLE `kingdom`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `queen`
--
ALTER TABLE `queen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_97A0ADA32FC0CB0F` (`kingdom_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `kingdom`
--
ALTER TABLE `kingdom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `queen`
--
ALTER TABLE `queen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `queen`
--
ALTER TABLE `queen`
  ADD CONSTRAINT `FK_97A0ADA32FC0CB0F` FOREIGN KEY (`kingdom_id`) REFERENCES `kingdom` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
