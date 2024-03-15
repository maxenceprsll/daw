-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 15 mars 2024 à 00:53
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetdaw`
--

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `idQuestion` int(11) NOT NULL,
  `Intitulé` varchar(50) DEFAULT NULL,
  `valRep` varchar(1) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`idQuestion`, `Intitulé`, `valRep`, `categorie`) VALUES
(1, 'Combien font 1+1 ?', 'b', 'mathematique'),
(2, 'Combien font 3+2 ?', 'c', 'mathematique'),
(3, 'Combien font 10*10 ?', 'a', 'mathematique'),
(4, 'Combien font 5-10 ?', 'd', 'mathematique'),
(5, 'Combien font 500/100 ?', 'b', 'mathematique'),
(6, 'Quand a eu lieu la révolution ?', 'c', 'Histoire');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `idReponse` int(11) NOT NULL,
  `texteRep` varchar(50) DEFAULT NULL,
  `val` varchar(1) DEFAULT NULL,
  `idQuestion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`idReponse`, `texteRep`, `val`, `idQuestion`) VALUES
(1, '1', 'a', 1),
(2, '2', 'b', 1),
(3, '3', 'c', 1),
(4, '4', 'd', 1),
(5, '0', 'a', 2),
(6, '10', 'b', 2),
(7, '5', 'c', 2),
(8, '15', 'd', 2),
(9, '100', 'a', 3),
(10, '200', 'b', 3),
(11, '50', 'c', 3),
(12, '10', 'd', 3),
(13, '10', 'a', 4),
(14, '5', 'b', 4),
(15, '0', 'c', 4),
(16, '-5', 'd', 4),
(17, '100', 'a', 5),
(18, '5', 'b', 5),
(19, '50', 'c', 5),
(20, '10', 'd', 5),
(21, '1788', 'a', 6),
(22, '1790', 'b', 6),
(23, '1789', 'c', 6),
(24, '1800', 'd', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`idReponse`),
  ADD KEY `idQuestion` (`idQuestion`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `idReponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
