-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : mer. 28 déc. 2022 à 17:38
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `travel_agency`
--

-- --------------------------------------------------------

--
-- Structure de la table `plane_step`
--

CREATE TABLE `plane_step` (
  `id` int UNSIGNED NOT NULL,
  `bagage_drop` varchar(20) DEFAULT NULL,
  `gateway` varchar(30) NOT NULL,
  `step_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `plane_step`
--

INSERT INTO `plane_step` (`id`, `bagage_drop`, `gateway`, `step_id`) VALUES
(1, NULL, '22', 1),
(2, '344', '45B', 5),
(3, NULL, '45B', 11),
(4, '123', '96B', 12);

-- --------------------------------------------------------

--
-- Structure de la table `steps`
--

CREATE TABLE `steps` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL,
  `seat` varchar(10) DEFAULT NULL,
  `transport_number` varchar(20) NOT NULL,
  `departure_date` datetime NOT NULL,
  `arrival_date` datetime NOT NULL,
  `departure` varchar(100) NOT NULL,
  `arrival` varchar(100) NOT NULL,
  `travel_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `steps`
--

INSERT INTO `steps` (`id`, `type`, `seat`, `transport_number`, `departure_date`, `arrival_date`, `departure`, `arrival`, `travel_id`) VALUES
(1, 'plane', '7B', 'SK22', '2022-12-28 17:21:50', '2022-12-28 17:21:50', 'Stockholm', 'New York JFK', 1),
(2, 'bus', NULL, 'airport', '2022-12-28 17:21:50', '2022-12-28 17:21:50', 'Barcelona', 'Gerona Airport', 1),
(5, 'plane', '3A', 'SK455', '2022-12-28 17:24:02', '2022-12-28 17:24:02', 'Gerona Airport', 'Stockholm', 1),
(6, 'train', '45B', '78A', '2022-12-28 17:24:02', '2022-12-28 17:24:02', 'Madrid', 'Barcelona', 1),
(7, 'bus', NULL, 'B1', '2022-12-28 17:29:21', '2022-12-28 17:29:21', 'Grasse', 'Cannes', 2),
(8, 'train', '', 'TER-A', '2022-12-28 17:29:21', '2022-12-28 17:29:21', 'Cannes', 'Nice Riquier', 2),
(11, 'plane', '3A', 'P455', '2022-12-28 17:30:53', '2022-12-28 17:30:53', 'Nice', 'Paris', 2),
(12, 'plane', '96B', 'P42', '2022-12-28 17:30:53', '2022-12-28 17:30:53', 'Paris', 'Londres', 2),
(13, 'train', '6', 'T9 3/4', '2022-12-28 17:35:56', '2022-12-28 17:35:56', 'Londre', 'Hogwarts Castle', 2);

-- --------------------------------------------------------

--
-- Structure de la table `travels`
--

CREATE TABLE `travels` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `travels`
--

INSERT INTO `travels` (`id`, `name`) VALUES
(1, 'Voyage 1'),
(2, 'Voyage 2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `plane_step`
--
ALTER TABLE `plane_step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_step_id` (`step_id`);

--
-- Index pour la table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `arrival` (`arrival`,`travel_id`),
  ADD KEY `travel_id` (`travel_id`);

--
-- Index pour la table `travels`
--
ALTER TABLE `travels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `plane_step`
--
ALTER TABLE `plane_step`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `steps`
--
ALTER TABLE `steps`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `travels`
--
ALTER TABLE `travels`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `plane_step`
--
ALTER TABLE `plane_step`
  ADD CONSTRAINT `fk_step_id` FOREIGN KEY (`step_id`) REFERENCES `steps` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `steps`
--
ALTER TABLE `steps`
  ADD CONSTRAINT `fk_travel_id` FOREIGN KEY (`travel_id`) REFERENCES `travels` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
