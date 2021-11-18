-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 oct. 2021 à 13:27
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fredi21`
--
CREATE DATABASE IF NOT EXISTS `fredi21` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fredi21`;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE `adherent` (
  `id_adherent` int(11) NOT NULL,
  `nr_licence` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_adherent`, `nr_licence`, `adr1`, `adr2`, `adr3`, `id_utilisateur`, `id_club`) VALUES
(1, '123', '1 rue du clone', '31000', 'toulouse', 9, 11),
(2, '012', '2 rue du clone', '31000', 'toulouse', 10, 5),
(3, '456', '3 rue du clone', '31000', 'toulouse', 11, 6),
(4, '789', '4 rue du clone', '31000', 'toulouse', 12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `id_club` int(11) NOT NULL,
  `lib_club` varchar(50) DEFAULT NULL,
  `adr1` varchar(50) DEFAULT NULL,
  `adr2` varchar(50) DEFAULT NULL,
  `adr3` varchar(50) DEFAULT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id_club`, `lib_club`, `adr1`, `adr2`, `adr3`, `id_ligue`) VALUES
(1, 'Dojo Burgien', '1 rue du Docteur DUBY', '1000', 'BOURG EN BRESSE', 1),
(2, 'Saint-Denis Dojo', '239 Allées des sports', '1000', 'ST DENIS LES BOURG', 1),
(3, 'Judo Club Vallée Arbent', 'rue du Général ANDREA', '1100', 'ARBENT', 1),
(4, 'Belli Judo', '1 rue du Bac', '1100', 'BELLIGNAT', 1),
(5, 'Racing Club Montluel Judo', '170 rue des Chartinières', '1120', 'DAGNEUX', 1),
(6, 'Centre Arts Martiaux Pondinois', 'rue de l Oiselon', '1160', 'PONT D AIN', 1),
(7, 'Judo Club Ornex', '58 rue des Pralets', '1210', 'ORNEX', 1),
(8, 'Dojo Gessien Valserine', '58 rue des Pralets', '1220', 'DIVONNE LES BAINS', 1),
(9, 'Dojo La Vallière', 'Complexe Sportif', '1250', 'MONTAGNAT', 1),
(10, 'Football club Merville', 'Rue Emile Pouvillon', '31330', 'MERVILLE', 2),
(11, 'Football Club Bassin d Arcachon', 'Boulevard Mestrezat - Stade jean Brousse', '33120', 'ARCACHON', 3),
(12, 'Andernos Sport Football Club', 'Plaine des Sports Jacques Rosazza', '33510', 'ANDERNOS LES BAINS', 3);

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
CREATE TABLE `ligne` (
  `id_ligne` int(11) NOT NULL,
  `dat_ligne` date DEFAULT NULL,
  `lib_trajet` varchar(50) DEFAULT NULL,
  `nb_km` int(11) DEFAULT NULL,
  `mt_km` decimal(15,2) DEFAULT NULL,
  `mt_peage` decimal(15,2) DEFAULT NULL,
  `mt_repas` decimal(15,2) DEFAULT NULL,
  `mt_hebergement` decimal(15,2) DEFAULT NULL,
  `mt_total` decimal(15,2) DEFAULT NULL,
  `id_motif` int(11) NOT NULL,
  `id_note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligne`
--

INSERT INTO `ligne` (`id_ligne`, `dat_ligne`, `lib_trajet`, `nb_km`, `mt_km`, `mt_peage`, `mt_repas`, `mt_hebergement`, `mt_total`, `id_motif`, `id_note`) VALUES
(1, NULL, 'Reu', 50, '26.15', '15.00', '16.00', '45.00', '102.15', 1, 2),
(2, NULL, 'Comp', 50, '26.15', '26.00', '11.00', '27.00', '90.15', 2, 3),
(3, NULL, 'Sta', 100, '52.30', '19.00', '19.00', '53.00', '143.30', 5, 2),
(4, NULL, 'test', 50, '26.15', '15.00', '16.00', '45.00', '102.15', 1, 2),
(5, NULL, 'test2', 50, '26.15', '15.00', '16.00', '45.00', '102.15', 1, 2);

--
-- Déclencheurs `ligne`
--
DROP TRIGGER IF EXISTS `after_insert_ligne`;
DELIMITER $$
CREATE TRIGGER `after_insert_ligne` AFTER INSERT ON `ligne` FOR EACH ROW BEGIN
    DECLARE mt_total_ligne FLOAT;
	SELECT SUM(ligne.mt_total) INTO mt_total_ligne FROM ligne, note WHERE ligne.id_note = NEW.id_note AND note.id_note = ligne.id_note;
    UPDATE note SET mt_total = mt_total_ligne WHERE note.id_note = NEW.id_note;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `after_update_ligne`;
DELIMITER $$
CREATE TRIGGER `after_update_ligne` AFTER UPDATE ON `ligne` FOR EACH ROW BEGIN
    DECLARE mt_total_ligne FLOAT;
	SELECT SUM(ligne.mt_total) INTO mt_total_ligne FROM ligne, note WHERE ligne.id_note = NEW.id_note AND note.id_note = ligne.id_note;
    UPDATE note SET mt_total = mt_total_ligne WHERE note.id_note = NEW.id_note;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_insert_ligne`;
DELIMITER $$
CREATE TRIGGER `before_insert_ligne` BEFORE INSERT ON `ligne` FOR EACH ROW BEGIN
    DECLARE mt_periode FLOAT;
    
    SELECT mt_km INTO mt_periode FROM periode WHERE est_active=1 LIMIT 1;
    SET NEW.mt_km = NEW.nb_km * mt_periode;

    SET NEW.mt_total = NEW.mt_repas + NEW.mt_peage + NEW.mt_hebergement+NEW.mt_km;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_ligne`;
DELIMITER $$
CREATE TRIGGER `before_update_ligne` BEFORE UPDATE ON `ligne` FOR EACH ROW BEGIN

    DECLARE mt_periode FLOAT;
    
    SELECT mt_km INTO mt_periode FROM periode WHERE est_active=1 LIMIT 1;
    SET NEW.mt_km = NEW.nb_km * mt_periode;

    SET NEW.mt_total = NEW.mt_repas + NEW.mt_peage + NEW.mt_hebergement+NEW.mt_km;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

DROP TABLE IF EXISTS `ligue`;
CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`) VALUES
(1, 'Ligue de Judo Auvergne-Rhone-Alpes'),
(2, 'Ligue de football Haute-Garonne'),
(3, 'Ligue de football d\'Aquitaine'),
(4, 'Ligue de tennis de Corse du Sud'),
(5, 'Ligue d\'equitation du VAR'),
(6, 'Ligue de natation du Quercy');

-- --------------------------------------------------------

--
-- Structure de la table `motif`
--

DROP TABLE IF EXISTS `motif`;
CREATE TABLE `motif` (
  `id_motif` int(11) NOT NULL,
  `lib_motif` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `motif`
--

INSERT INTO `motif` (`id_motif`, `lib_motif`) VALUES
(1, 'Réunion'),
(2, 'Compétition régionale'),
(3, 'Compétition nationale'),
(4, 'Compétition internationnale'),
(5, 'Stage'),
(6, 'Visite médicale'),
(7, 'Oxygénation'),
(8, 'Convocation'),
(9, 'Formation');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id_note` int(11) NOT NULL,
  `est_valide` tinyint(1) DEFAULT NULL,
  `mt_total` decimal(15,2) DEFAULT NULL,
  `dat_remise` date DEFAULT NULL,
  `nr_ordre` int(11) DEFAULT NULL,
  `id_periode` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id_note`, `est_valide`, `mt_total`, `dat_remise`, `nr_ordre`, `id_periode`, `id_utilisateur`) VALUES
(1, 0, NULL, NULL, NULL, 1, 12),
(2, 0, '449.75', NULL, NULL, 2, 12),
(3, 0, '90.15', NULL, NULL, 3, 12),
(4, 0, NULL, NULL, NULL, 4, 12),
(5, 0, NULL, NULL, NULL, 5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `lib_periode` varchar(50) DEFAULT NULL,
  `est_active` tinyint(1) NOT NULL DEFAULT 0,
  `mt_km` decimal(8,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`id_periode`, `lib_periode`, `est_active`, `mt_km`) VALUES
(1, '2021', 1, '0.523'),
(2, '2020', 0, '0.423'),
(3, '2019', 0, '0.621'),
(4, '2018', 0, '0.359'),
(5, '2017', 0, '0.428'),
(6, '2016', 0, '0.541'),
(7, '2015', 0, '0.593');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `mdp`, `mail`, `nom`, `prenom`, `role`) VALUES
(9, 'yohan', '$2y$10$jaa7NnbdBhEuL5hMLGMbteg.KXzsep5/VCVs.Ql9DZj/SYZ45jHdG', 'yohan.marques@limayrac.fr', 'marques', 'yohan', 2),
(10, 'agustin', '$2y$10$ZT6T366PoTdRCNY.8KCYaeL5atqndjRct0ToNsksraYWlRWYC2qa2', 'agustin.quintero@limayrac.fr', 'Quintero', 'Agustin', 2),
(11, 'david', '$2y$10$18jqscpcfns8YHYcYFabl.dIFP7pmLptXd4WTm4WpwgBtQqBsguym', 'david.peyrard@limayrac.fr', 'Peyrard', 'David', 1),
(12, 'ph', '$2y$10$50fd6ZGE.4gSJmwGCubcLeMzzx6e76j6AU5NzFWOtwF77HQCF.OC6', 'pierrehonore.akendengue@limayrac.fr', 'Akendengue', 'Pierre-Honoré', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`id_adherent`),
  ADD KEY `fk_id_utilisateur2` (`id_utilisateur`),
  ADD KEY `fk_id_club` (`id_club`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `fk_id_ligue` (`id_ligue`);

--
-- Index pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `fk_id_motif` (`id_motif`),
  ADD KEY `fk_id_note` (`id_note`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`);

--
-- Index pour la table `motif`
--
ALTER TABLE `motif`
  ADD PRIMARY KEY (`id_motif`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `fk_id_periode` (`id_periode`),
  ADD KEY `fk_id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id_adherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `ligne`
--
ALTER TABLE `ligne`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `motif`
--
ALTER TABLE `motif`
  MODIFY `id_motif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `fk_id_club` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`),
  ADD CONSTRAINT `fk_id_utilisateur2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `fk_id_ligue` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`);

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `fk_id_motif` FOREIGN KEY (`id_motif`) REFERENCES `motif` (`id_motif`),
  ADD CONSTRAINT `fk_id_note` FOREIGN KEY (`id_note`) REFERENCES `note` (`id_note`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_id_periode` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`),
  ADD CONSTRAINT `fk_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
