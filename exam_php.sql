-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 juin 2026 à 10:51
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exam_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaires`
--

DROP TABLE IF EXISTS `beneficiaires`;
CREATE TABLE IF NOT EXISTS `beneficiaires` (
  `id_beneficiaire` int NOT NULL AUTO_INCREMENT,
  `num_client` int NOT NULL,
  `num_compte_beneficiaire` int NOT NULL,
  `raison` text NOT NULL,
  PRIMARY KEY (`id_beneficiaire`),
  KEY `fk_num_client` (`num_client`),
  KEY `fk_num_compte` (`num_compte_beneficiaire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `num_client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`num_client`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`num_client`, `nom`, `prenom`, `adresse`, `email`, `telephone`, `date_naissance`, `mdp`) VALUES
(1, 'Mirija', '', '', '', 'mirijaramanandafy@gmail.com', '0000-00-00', '$2y$12$5jrECsV5kDQz/BxE.7KrjObdzETuJMJJD1ozGABvWH.LCoccWdpYy'),
(2, 'Rakoto', '', '', '', 'rakoto@gmail.com', '0000-00-00', '$2y$12$DEAxMlpxfc39ybudlY18lur8jBF0CaFbyX3fhjjif/dPVdQCtNVmK'),
(8, 'Dupont', 'Jean', 'Rue de la paix', 'mirijaramanandafy@gmail.com', '032 22 222 22', '2026-06-01', '$2y$12$1nAa93HQJOxUjA2vhSprKO5e8mv1kSI62rW6OoB7Qp0.pyTGNaDCi'),
(9, 'Ramanandafy', 'Mirija', 'Andranomena', 'mirijaramanandafy@gmail.com', '032 22 222 22', '2026-06-10', '$2y$12$WsaL6wU5vjgJ4.Rrkx.wEONeFArxUBuaLa2LYdeTOe5G2fimF02wq');

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `num_compte` int NOT NULL AUTO_INCREMENT,
  `num_client` int NOT NULL,
  `type_compte` set('courant','épargne') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `solde_actuel` double NOT NULL,
  `date_ouverture` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fermeture` timestamp NULL DEFAULT NULL,
  `taux_interet` float NOT NULL,
  `statut_compte` set('actif','fermé') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'actif',
  PRIMARY KEY (`num_compte`),
  KEY `fk_comptes_clients` (`num_client`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`num_compte`, `num_client`, `type_compte`, `solde_actuel`, `date_ouverture`, `date_fermeture`, `taux_interet`, `statut_compte`) VALUES
(3, 2, 'épargne', 9000, '2026-06-03 10:40:19', NULL, 0.02, 'actif'),
(2, 8, 'épargne', 10990, '2026-06-03 10:28:00', NULL, 0.02, 'actif'),
(4, 1, 'épargne', 10000000, '2026-06-03 10:46:08', NULL, 0.02, 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `reference` int NOT NULL AUTO_INCREMENT,
  `num_compte_source` int DEFAULT NULL,
  `num_compte_destination` int DEFAULT NULL,
  `type_transaction` set('dépôt','retrait','virement') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `montant` double NOT NULL,
  `date_transaction` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut_transaction` set('validé','annulé','en attente') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`reference`),
  KEY `fk_client_source` (`num_compte_source`),
  KEY `fk_client_destination` (`num_compte_destination`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`reference`, `num_compte_source`, `num_compte_destination`, `type_transaction`, `montant`, `date_transaction`, `statut_transaction`) VALUES
(1, 2, NULL, 'retrait', 10, '2026-06-02 21:00:00', 'validé'),
(2, NULL, 3, 'dépôt', 1, '2026-06-02 21:00:00', 'validé'),
(3, 3, NULL, 'retrait', 1, '2026-06-02 21:00:00', 'validé'),
(4, 3, 2, 'virement', 1000, '2026-06-02 21:00:00', 'validé');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
