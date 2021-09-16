-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 sep. 2021 à 16:08
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
-- Base de données : `fredi`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `id_utilisateur` int(11) NOT NULL,
  `numero_rue` varchar(50) DEFAULT NULL,
  `nom_rue` varchar(50) DEFAULT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `club` varchar(50) DEFAULT NULL,
  `num_license` varchar(50) DEFAULT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `clubs`
--

CREATE TABLE `clubs` (
  `id_club` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `numero_rue` varchar(50) DEFAULT NULL,
  `nom_rue` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `controleur`
--

CREATE TABLE `controleur` (
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lignes_de_frais`
--

CREATE TABLE `lignes_de_frais` (
  `id_ligne` int(11) NOT NULL,
  `libelle_deplacement` varchar(50) DEFAULT NULL,
  `nb_km` varchar(50) DEFAULT NULL,
  `montant_peage` varchar(50) DEFAULT NULL,
  `montant_repas` varchar(50) DEFAULT NULL,
  `montant_hebergement` varchar(50) DEFAULT NULL,
  `id_deplacement` int(11) NOT NULL,
  `id_note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligues`
--

CREATE TABLE `ligues` (
  `id_ligue` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligues`
--

INSERT INTO `ligues` (`id_ligue`, `nom`) VALUES
(0, 'Ligue de natation du Quercy'),
(1, 'Ligue de Judo Auvergne-Rhone-Alpes'),
(2, 'Ligue de football Haute-Garonne'),
(3, 'Ligue de football d\'Aquitaine'),
(4, 'Ligue de tennis de Corse du Sud'),
(5, 'Ligue d\'equitation du VAR');

-- --------------------------------------------------------

--
-- Structure de la table `motif_deplacement`
--

CREATE TABLE `motif_deplacement` (
  `id_deplacement` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notes_de_frais`
--

CREATE TABLE `notes_de_frais` (
  `id_note` int(11) NOT NULL,
  `indic_validite` varchar(50) DEFAULT NULL,
  `montant_total_ligne` varchar(50) DEFAULT NULL,
  `date_remise_note` varchar(50) DEFAULT NULL,
  `id_periode` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `periode_fiscale`
--

CREATE TABLE `periode_fiscale` (
  `id_periode` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `montant_forfaitaire` varchar(50) DEFAULT NULL,
  `periode_active` int(11) DEFAULT NULL,
  `date_periode` date DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `adresse_mail` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `id_club` (`id_club`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `id_ligue` (`id_ligue`);

--
-- Index pour la table `controleur`
--
ALTER TABLE `controleur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `lignes_de_frais`
--
ALTER TABLE `lignes_de_frais`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `id_deplacement` (`id_deplacement`),
  ADD KEY `id_note` (`id_note`);

--
-- Index pour la table `ligues`
--
ALTER TABLE `ligues`
  ADD PRIMARY KEY (`id_ligue`);

--
-- Index pour la table `motif_deplacement`
--
ALTER TABLE `motif_deplacement`
  ADD PRIMARY KEY (`id_deplacement`);

--
-- Index pour la table `notes_de_frais`
--
ALTER TABLE `notes_de_frais`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `periode_fiscale`
--
ALTER TABLE `periode_fiscale`
  ADD PRIMARY KEY (`id_periode`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lignes_de_frais`
--
ALTER TABLE `lignes_de_frais`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `adherent_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `adherent_ibfk_2` FOREIGN KEY (`id_club`) REFERENCES `clubs` (`id_club`);

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_ibfk_1` FOREIGN KEY (`id_ligue`) REFERENCES `ligues` (`id_ligue`);

--
-- Contraintes pour la table `controleur`
--
ALTER TABLE `controleur`
  ADD CONSTRAINT `controleur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `lignes_de_frais`
--
ALTER TABLE `lignes_de_frais`
  ADD CONSTRAINT `lignes_de_frais_ibfk_1` FOREIGN KEY (`id_deplacement`) REFERENCES `motif_deplacement` (`id_deplacement`),
  ADD CONSTRAINT `lignes_de_frais_ibfk_2` FOREIGN KEY (`id_note`) REFERENCES `notes_de_frais` (`id_note`);

--
-- Contraintes pour la table `notes_de_frais`
--
ALTER TABLE `notes_de_frais`
  ADD CONSTRAINT `notes_de_frais_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode_fiscale` (`id_periode`),
  ADD CONSTRAINT `notes_de_frais_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `adherent` (`id_utilisateur`);

--
-- Contraintes pour la table `periode_fiscale`
--
ALTER TABLE `periode_fiscale`
  ADD CONSTRAINT `periode_fiscale_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `controleur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
