-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 28, 2024 at 02:59 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_daw`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `arID` int(11) NOT NULL,
  `arTitre` text NOT NULL,
  `arContenu` text NOT NULL,
  `arAuteur` int(11) NOT NULL,
  `arDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`arID`, `arTitre`, `arContenu`, `arAuteur`, `arDate`) VALUES
(1, 'Conseil Projet DAW', 'Bonjour, je suis à la recherche de conseils pour le projet de DAW je coince un peu..', 1, '2024-03-21'),
(2, 'Question projet', 'Hey, quelqu\'un sait quand on doit rendre le projet ?', 2, '2024-03-21'),
(3, 'MVC', 'Salut, vous arrivez à respecter le MVC pour votre site vous ?', 1, '2024-03-22'),
(4, 'Salaire', 'Hey, je me demandais si on était payé vu la charge de travail que l\'on a en ce moment, quelqu\'un a des infos peut-être ?', 1, '2024-03-22'),
(5, 'Pixar', 'Vous avez trouvé la lampe pixar pour le TP ?', 2, '2024-03-22'),
(6, 'Cours', 'Bonjour, qui sait quand seront ajoutés les pages de cours ?', 1, '2024-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `coID` int(11) NOT NULL,
  `coArticleID` int(11) NOT NULL,
  `coContenu` text NOT NULL,
  `coAuteur` int(11) NOT NULL,
  `coDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`coID`, `coArticleID`, `coContenu`, `coAuteur`, `coDate`) VALUES
(1, 1, 'Hello, aurais-tu des questions plus précises je peux aider ?', 2, '2024-03-21'),
(2, 1, 'Comment vous faites pour respecter le MVC ? Je trouve cela compliqué parfois..', 1, '2024-03-21'),
(3, 2, 'Yes, c\'est pour le 19 avril, faut pas trainer!', 1, '2024-03-21'),
(4, 2, 'Ok super merci beaucoup', 2, '2024-03-21'),
(5, 1, 'C\'est bon j\'ai fini par trouver!', 1, '2024-03-22'),
(6, 3, 'Oui moi j\'y arrive ;)', 3, '2024-03-22'),
(7, 4, 'Non, aucune rémunération n\'est prévue, travaillez plus.', 3, '2024-03-22'),
(8, 5, 'J\'ai rien dis, c\'est pas la bonne matière pardon', 3, '2024-03-22'),
(9, 5, 'J\'ai rien dis, c\'est pas la bonne matière pardon', 3, '2024-03-23'),
(10, 6, 'Oubliez je sais merci', 1, '2024-03-26'),
(11, 2, 'Pas de problème !', 1, '2024-03-26'),
(12, 2, 'Je réouvre un sujet si besoin.', 2, '2024-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `elementCours`
--

CREATE TABLE `elementCours` (
  `elID` int(11) NOT NULL,
  `elCoursID` int(11) DEFAULT NULL,
  `elType` varchar(3) DEFAULT NULL,
  `elContenu` text,
  `elFormat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `elementCours`
--

INSERT INTO `elementCours` (`elID`, `elCoursID`, `elType`, `elContenu`, `elFormat`) VALUES
(26, 15, 'txt', 'Partie I', 'h2'),
(27, 15, 'txt', 'Contenu de la partie 1', 'p'),
(28, 15, 'txt', 'Sous Partie I-I', 'h3'),
(32, 17, 'doc', 'TDglobal.pdf.zip', ''),
(33, 14, 'txt', 'Cours Magistraux', 'h2'),
(34, 14, 'doc', 'CM1_JS.pdf', ''),
(35, 14, 'doc', 'CM2_JS_Json.pdf', ''),
(37, 26, 'txt', 'Section 1', 'h2'),
(38, 26, 'doc', 'cactus.blend', '');

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `foID` int(11) NOT NULL,
  `foIntitule` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`foID`, `foIntitule`) VALUES
(0, 'Non précisé'),
(1, 'Mathématiques'),
(2, 'Histoire'),
(3, 'Sciences'),
(4, 'Informatique'),
(5, 'Langues'),
(6, 'Économie');

-- --------------------------------------------------------

--
-- Table structure for table `niveau`
--

CREATE TABLE `niveau` (
  `niID` int(11) NOT NULL,
  `niIntitule` text NOT NULL,
  `niShort` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `niveau`
--

INSERT INTO `niveau` (`niID`, `niIntitule`, `niShort`) VALUES
(0, 'Non précisé', 'NP'),
(1, 'Licence 1', 'L1'),
(2, 'Licence 2', 'L2'),
(3, 'Licence 3', 'L3'),
(4, 'Master 1', 'M1'),
(5, 'Master 2', 'M2'),
(6, 'Doctorat 1', 'D1'),
(7, 'Doctorat 2', 'D2'),
(8, 'Doctorat 3', 'D3');

-- --------------------------------------------------------

--
-- Table structure for table `pageCours`
--

CREATE TABLE `pageCours` (
  `paID` int(11) NOT NULL,
  `paFormationID` int(11) NOT NULL,
  `paTitre` text NOT NULL,
  `paNiveau` int(11) NOT NULL,
  `paUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pageCours`
--

INSERT INTO `pageCours` (`paID`, `paFormationID`, `paTitre`, `paNiveau`, `paUser`) VALUES
(14, 4, 'DAW', 3, 3),
(15, 4, 'Programmation Logique et Fonctionnelle', 3, 3),
(17, 4, 'Graphes', 3, 3),
(26, 4, 'Images pour le Web', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `quID` int(11) NOT NULL,
  `quIntitule` text,
  `quFormation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`quID`, `quIntitule`, `quFormation`) VALUES
(1, 'Combien font 1+1 ?', 1),
(2, 'Combien font 3+2 ?', 1),
(3, 'Combien font 10*10 ?', 1),
(4, 'Combien font 5-10 ?', 1),
(5, 'Combien font 500/100 ?', 1),
(6, 'Quand a eu lieu la révolution ?', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `reID` int(11) NOT NULL,
  `reQuestionID` int(11) DEFAULT NULL,
  `reIntitule` text,
  `reCorrecte` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`reID`, `reQuestionID`, `reIntitule`, `reCorrecte`) VALUES
(1, 1, '1', 0),
(2, 1, '2', 1),
(3, 1, '3', 0),
(4, 1, '4', 0),
(5, 2, '0', 0),
(6, 2, '10', 0),
(7, 2, '5', 1),
(8, 2, '15', 0),
(9, 3, '100', 1),
(10, 3, '200', 0),
(11, 3, '50', 0),
(12, 3, '10', 0),
(13, 4, '10', 0),
(14, 4, '5', 0),
(15, 4, '0', 0),
(16, 4, '-5', 1),
(17, 5, '100', 0),
(18, 5, '5', 1),
(19, 5, '50', 0),
(20, 5, '10', 0),
(21, 6, '1788', 0),
(22, 6, '1790', 0),
(23, 6, '1789', 1),
(24, 6, '1800', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `usID` int(11) NOT NULL,
  `usNom` text NOT NULL,
  `usPrenom` text NOT NULL,
  `usLogin` text NOT NULL,
  `usPass` text NOT NULL,
  `usAdmin` tinyint(1) NOT NULL,
  `usNiveau` int(11) NOT NULL,
  `usFormation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`usID`, `usNom`, `usPrenom`, `usLogin`, `usPass`, `usAdmin`, `usNiveau`, `usFormation`) VALUES
(1, 'Persello', 'Maxence', 'mp269437', '$2y$10$INde.8B6AIDc83hSDfDwIuk/37vGTYGXFQdIY2/IowJbnAX2WZgfG', 0, 3, 4),
(2, 'Freissinet', 'Chloe', 'cf709753', '$2y$10$GEwlQkEDPSeBMepMRUDlGOFrIagEAaY3rZTsVKa66AxZoJ6Rhm3Pa', 0, 3, 4),
(3, 'Ayikpa', 'Jean', 'ja190324', '$2y$10$5YPoyyhWo.H5M1OdKbjfWeczNh8UTW0CMFxUVsvGi9QKhCTfzXHe2', 1, 8, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`arID`),
  ADD KEY `fk_article_user` (`arAuteur`);

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`coID`),
  ADD KEY `fk_commentaire_article` (`coArticleID`),
  ADD KEY `fk_commentaire_user` (`coAuteur`);

--
-- Indexes for table `elementCours`
--
ALTER TABLE `elementCours`
  ADD PRIMARY KEY (`elID`),
  ADD KEY `fk_element_cours` (`elCoursID`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`foID`);

--
-- Indexes for table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`niID`);

--
-- Indexes for table `pageCours`
--
ALTER TABLE `pageCours`
  ADD PRIMARY KEY (`paID`),
  ADD KEY `fk_cours_user` (`paUser`),
  ADD KEY `fk_niveau_cours` (`paNiveau`),
  ADD KEY `fk_formation_cours` (`paFormationID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`quID`),
  ADD KEY `fk_formation` (`quFormation`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`reID`),
  ADD KEY `reQuestionID` (`reQuestionID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usID`),
  ADD KEY `fk_user_niveau` (`usNiveau`),
  ADD KEY `fo_user_formation` (`usFormation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `arID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `coID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `elementCours`
--
ALTER TABLE `elementCours`
  MODIFY `elID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `foID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `niID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pageCours`
--
ALTER TABLE `pageCours`
  MODIFY `paID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `quID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `reID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `usID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`arAuteur`) REFERENCES `user` (`usID`);

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_article` FOREIGN KEY (`coArticleID`) REFERENCES `article` (`arID`),
  ADD CONSTRAINT `fk_commentaire_user` FOREIGN KEY (`coAuteur`) REFERENCES `user` (`usID`);

--
-- Constraints for table `elementCours`
--
ALTER TABLE `elementCours`
  ADD CONSTRAINT `fk_element_cours` FOREIGN KEY (`elCoursID`) REFERENCES `pageCours` (`paID`);

--
-- Constraints for table `pageCours`
--
ALTER TABLE `pageCours`
  ADD CONSTRAINT `fk_cours_user` FOREIGN KEY (`paUser`) REFERENCES `user` (`usID`),
  ADD CONSTRAINT `fk_formation_cours` FOREIGN KEY (`paFormationID`) REFERENCES `formation` (`foID`),
  ADD CONSTRAINT `fk_niveau_cours` FOREIGN KEY (`paNiveau`) REFERENCES `niveau` (`niID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_formation` FOREIGN KEY (`quFormation`) REFERENCES `formation` (`foID`);

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`reQuestionID`) REFERENCES `question` (`quID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_niveau` FOREIGN KEY (`usNiveau`) REFERENCES `niveau` (`niID`),
  ADD CONSTRAINT `fo_user_formation` FOREIGN KEY (`usFormation`) REFERENCES `formation` (`foID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
