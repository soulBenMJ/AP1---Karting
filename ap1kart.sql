-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 oct. 2024 à 14:16
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ap1kart`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `note` int NOT NULL,
  `texte` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `user_id`, `note`, `texte`) VALUES
(1, 1, 10, 'trop bien wesh');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `email`, `num_tel`, `motif`) VALUES
(1, 'blou', 'ouble', 'b.s@tkt.exe', '0666666666', 'oui bah faut bien faire des tests'),
(2, 'blou', 'ouble', 'b.s@tkt.ex', '0666666666', 'oui bah faut bien faire des tests');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240920143943', '2024-09-20 14:40:18', 67),
('DoctrineMigrations\\Version20240927151426', '2024-09-27 15:14:53', 74),
('DoctrineMigrations\\Version20241006121729', '2024-10-17 07:56:52', 55),
('DoctrineMigrations\\Version20241009110247', '2024-10-09 11:03:25', 214),
('DoctrineMigrations\\Version20241011122910', '2024-10-11 12:29:23', 73),
('DoctrineMigrations\\Version20241013173449', '2024-10-18 06:48:20', 163),
('DoctrineMigrations\\Version20241017075225', '2024-10-17 07:57:40', 113),
('DoctrineMigrations\\Version20241017080102', '2024-10-17 08:01:07', 45),
('DoctrineMigrations\\Version20241018065014', '2024-10-18 06:50:24', 42);

-- --------------------------------------------------------

--
-- Structure de la table `ouverture`
--

DROP TABLE IF EXISTS `ouverture`;
CREATE TABLE IF NOT EXISTS `ouverture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heure_debut` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heure_fin` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ouverture`
--

INSERT INTO `ouverture` (`id`, `jour`, `heure_debut`, `heure_fin`) VALUES
(1, 'Lundi', '11h00', '20h00'),
(2, 'Mardi', '10h00', '15h00'),
(3, 'Mercredi', '14h00', '19h00'),
(4, 'Jeudi', '9h30', '13h30'),
(5, 'Vendredi', '10h00', '22h00'),
(6, 'Samedi', '8h00', '23h00'),
(7, 'Dimanche', 'Fermé', '');

-- --------------------------------------------------------

--
-- Structure de la table `presentation`
--

DROP TABLE IF EXISTS `presentation`;
CREATE TABLE IF NOT EXISTS `presentation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `presentation`
--

INSERT INTO `presentation` (`id`, `libelle`, `description`) VALUES
(2, 'kart-a-toi', 'je te jure il est pas mal aussi celui la'),
(3, 'chouwi', 'c\'est vraiment un des meilleursil fait 14km de long avec toute sorte de topographies.'),
(6, 'Cartable', 'pour les pitit nenfant c\'est génial OhOh!'),
(7, 'biscuitos', 'La joie des sucrerie Mexicaine !!');

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

DROP TABLE IF EXISTS `prestation`;
CREATE TABLE IF NOT EXISTS `prestation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_a` int NOT NULL,
  `prix_e` int NOT NULL,
  `temps` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prestation`
--

INSERT INTO `prestation` (`id`, `libelle`, `prix_a`, `prix_e`, `temps`) VALUES
(2, 'cass-cou', 125, 100, '10min'),
(3, 'Kart-a-toi', 298, 12, '45min'),
(5, 'cartable', 150, 100, '2h25'),
(6, 'biscuitos', 144, 100, '2h'),
(7, 'chouwi', 120, 100, '5min');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'b.s@tkt.exe', '[\"ROLE_ADMIN\"]', '$2y$13$MRY9JMdVLaMFJ4vSFXjqHudS1/xavgoxXIDoR303u9TDcExeZ.iRK');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
