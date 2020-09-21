-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 sep. 2020 à 13:10
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `cp` int(5) NOT NULL,
  `surface` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `type` enum('location','vente') NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type`, `description`) VALUES
(1, 'Maison individuelle', 'Rue des labours', 'saintes', 17100, '300', '700 000', 'photo/house1.jpg', 'vente', 'Donec vulputate a metus id tincidunt. Nulla hendrerit orci at vulputate feugiat. Donec et neque eleifend, accumsan risus ac, tempus magna. Proin efficitur lectus non sapien aliquam mollis. Maecenas interdum ultricies tortor ac facilisis. Ut tempus nibh le'),
(2, 'Maison individuelle', 'Rue des Auzes', 'St porchaire', 17250, '250', '2750', 'photo/house4.jpg', 'location', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae tincidunt magna, nec sollicitudin turpis. Morbi metus orci, elementum sed lectus vitae, convallis egestas nibh. Integer neque nulla, tempor at lorem non, porta ultrices dolor. Donec pulvina'),
(3, 'Maison individuelle', 'Rue des Auzes', 'St porchaire', 17250, '150', '700 000', 'photo/house2.jpg', 'location', 'cfgggggggggggggggggggggggggg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
