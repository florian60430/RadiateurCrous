-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 19 mai 2021 à 08:29
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP : 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crous`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `user` char(100) NOT NULL,
  `mdp` char(100) NOT NULL,
  `droit` char(100) NOT NULL,
  `adresse_mail` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `user`, `mdp`, `droit`, `adresse_mail`) VALUES
(1, 'test', '123', 'admin', 'a@la-providence.net'),
(2, 'malter', '1234', 'admin', 'amalter@la-providence.net'),
(3, 'wantelez', '1234', 'admin', 'fwantelez@la-providence.net'),
(4, 'garcia', '1234', 'utilisateur', 'fwantelez@la-providence.net'),
(5, 'bouet', '1234', 'utilisateur', 'fwantelez@la-providence.net');

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

CREATE TABLE `appartement` (
  `ID` int(11) NOT NULL,
  `ID_batiment` int(11) NOT NULL,
  `num_appartement` int(11) NOT NULL,
  `locataire` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `appartement`
--

INSERT INTO `appartement` (`ID`, `ID_batiment`, `num_appartement`, `locataire`) VALUES
(1, 1, 1, 'dupont'),
(2, 1, 2, 'raoul'),
(3, 1, 5, 'andré'),
(4, 2, 8, 'dupond'),
(5, 1, 10, 'pierre');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE `batiment` (
  `ID` int(11) NOT NULL,
  `nom_batiment` char(100) NOT NULL,
  `adresse` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`ID`, `nom_batiment`, `adresse`) VALUES
(1, 'batiment1', '1 rue de la paix'),
(2, 'batiment2', '5 rue Charles de Gaulle');

-- --------------------------------------------------------

--
-- Structure de la table `chauffage`
--

CREATE TABLE `chauffage` (
  `ID` int(11) NOT NULL,
  `ID_appartement` int(11) NOT NULL,
  `etat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chauffage`
--

INSERT INTO `chauffage` (`ID`, `ID_appartement`, `etat`) VALUES
(1, 1, ''),
(5, 2, ''),
(3, 3, ''),
(4, 4, ''),
(5, 5, ''),
(6, 3, 'marche'),
(7, 2, 'pas en marche');

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

CREATE TABLE `config` (
  `degres_nuit` int(11) NOT NULL,
  `degres_jour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `consigne_prog`
--

CREATE TABLE `consigne_prog` (
  `ID` int(11) NOT NULL,
  `jour_semaine_debut` varchar(6) NOT NULL,
  `jour_semaine_fin` varchar(6) NOT NULL,
  `heure_debut` time(6) NOT NULL,
  `heure_fin` time(6) NOT NULL,
  `température` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `consigne_prog`
--

INSERT INTO `consigne_prog` (`ID`, `jour_semaine_debut`, `jour_semaine_fin`, `heure_debut`, `heure_fin`, `température`) VALUES
(3, 'LU', '', '19:00:00.000000', '07:00:00.000000', 120000);

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE `programme` (
  `ID_chauffages` int(11) NOT NULL,
  `ID_consigne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `programme`
--

INSERT INTO `programme` (`ID_chauffages`, `ID_consigne`) VALUES
(6, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `appartement`
--
ALTER TABLE `appartement`
  ADD KEY `ID_batiment` (`ID_batiment`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `batiment`
--
ALTER TABLE `batiment`
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `chauffage`
--
ALTER TABLE `chauffage`
  ADD KEY `ID` (`ID`),
  ADD KEY `ID_appartement` (`ID_appartement`);

--
-- Index pour la table `consigne_prog`
--
ALTER TABLE `consigne_prog`
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `programme`
--
ALTER TABLE `programme`
  ADD KEY `ID_consigne` (`ID_consigne`),
  ADD KEY `ID_chauffages` (`ID_chauffages`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartement`
--
ALTER TABLE `appartement`
  ADD CONSTRAINT `appartement_ibfk_1` FOREIGN KEY (`ID_batiment`) REFERENCES `batiment` (`ID`);

--
-- Contraintes pour la table `chauffage`
--
ALTER TABLE `chauffage`
  ADD CONSTRAINT `chauffage_ibfk_1` FOREIGN KEY (`ID_appartement`) REFERENCES `appartement` (`ID`);

--
-- Contraintes pour la table `consigne_prog`
--
ALTER TABLE `consigne_prog`
  ADD CONSTRAINT `consigne_prog_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `programme` (`ID_consigne`);

--
-- Contraintes pour la table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `programme_ibfk_1` FOREIGN KEY (`ID_chauffages`) REFERENCES `chauffage` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
