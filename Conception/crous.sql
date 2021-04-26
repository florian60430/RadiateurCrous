-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 07 avr. 2021 à 08:44
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `crous`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

CREATE TABLE `appartement` (
  `ID` int(11) NOT NULL,
  `ID_Batiment` int(11) NOT NULL,
  `Num_appartement` int(11) NOT NULL,
  `locataire` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appartement`
--

INSERT INTO `appartement` (`ID`, `ID_Batiment`, `Num_appartement`, `locataire`) VALUES
(1, 1, 1, 'martin'),
(2, 1, 2, 'dupont'),
(3, 1, 4, 'dupond'),
(4, 1, 8, 'raoul'),
(5, 2, 2, 'Tintin'),
(6, 2, 5, 'Obélix'),
(7, 1, 12, 'Haddock'),
(8, 2, 10, 'Marcel'),
(9, 1, 14, 'Astérix'),
(10, 1, 5, 'V');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE `batiment` (
  `ID` int(11) NOT NULL,
  `nom_batiment` char(100) NOT NULL,
  `adresse` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`ID`, `nom_batiment`, `adresse`) VALUES
(1, 'batiment 1', '1 rue de la paix'),
(2, 'batiment 2', '10 rue Charles de gaulle');

-- --------------------------------------------------------

--
-- Structure de la table `chauffages`
--

CREATE TABLE `chauffages` (
  `ID` int(11) NOT NULL,
  `ID_Appartement` int(11) NOT NULL,
  `Etat_Chauffage` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chauffages`
--

INSERT INTO `chauffages` (`ID`, `ID_Appartement`, `Etat_Chauffage`) VALUES
(1, 4, 'ON'),
(2, 1, 'OFF'),
(3, 1, 'ON');

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

CREATE TABLE `config` (
  `nuit` char(100) NOT NULL,
  `deges_min` int(11) NOT NULL,
  `consigne_basse` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `consigne_prog`
--

CREATE TABLE `consigne_prog` (
  `ID` int(11) NOT NULL,
  `jour_semaine` char(100) NOT NULL,
  `heure_debut` date NOT NULL,
  `heure_fin` date NOT NULL,
  `temperature` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE `programme` (
  `ID_Chauffage` int(11) NOT NULL,
  `ID_Consigne` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `util`
--

CREATE TABLE `util` (
  `ID` int(11) NOT NULL,
  `user` char(100) NOT NULL,
  `MDP` char(100) NOT NULL,
  `droit` char(100) NOT NULL,
  `mail` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartement`
--
ALTER TABLE `appartement`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Batiment` (`ID_Batiment`);

--
-- Index pour la table `batiment`
--
ALTER TABLE `batiment`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `chauffages`
--
ALTER TABLE `chauffages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Appartment` (`ID_Appartement`),
  ADD KEY `ID_Appartment_2` (`ID_Appartement`);

--
-- Index pour la table `consigne_prog`
--
ALTER TABLE `consigne_prog`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `programme`
--
ALTER TABLE `programme`
  ADD KEY `ID_Chauffage` (`ID_Chauffage`),
  ADD KEY `ID_Consigne` (`ID_Consigne`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartement`
--
ALTER TABLE `appartement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `batiment`
--
ALTER TABLE `batiment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `chauffages`
--
ALTER TABLE `chauffages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `consigne_prog`
--
ALTER TABLE `consigne_prog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
