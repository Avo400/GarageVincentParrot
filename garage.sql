-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 juin 2026 à 09:30
-- Version du serveur : 8.0.40
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garage`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `note` int NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu_message_avis` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `note`, `titre`, `contenu_message_avis`, `user_id`, `approved`) VALUES
(163, 5, 'Super garage', 'Cool', 182, 1),
(168, 3, 'Horaires', 'Super garage mais horaires peu pratiques pour les travailleurs', 181, 1),
(169, 4, 'Efficacité', 'Ma carrosserie a été réparée très rapidement !', 184, 1),
(170, 2, 'Arnaqueurs', 'J\'ai payé 500€ pour deux roues d\'hiver !! Trop cher', 184, 1),
(172, 2, 'Personnel boudeur', 'Personnel très peu accueillant', 183, 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `titre`, `message`) VALUES
(11, 170, 'Demande de renseignement', 'Bonjour, pouvez-vous me confirmer si la Renault Clio 4 est toujours disponible à la vente ?'),
(12, 171, 'Prise de rendez-vous', 'Bonjour, je souhaiterais prendre rendez-vous pour faire estimer mon véhicule. Merci.'),
(13, 172, 'Question sur une réparation', 'Pouvez-vous me donner un ordre de prix pour le remplacement d\'un pare-brise sur une Citroën C4 ?'),
(14, 173, 'Disponibilité véhicule', 'Je suis intéressé par l\'Audi Q8 occasion présente sur votre site. Est-elle toujours disponible ?'),
(15, 174, 'Demande de devis', 'Bonjour, pouvez-vous établir un devis pour un changement de batterie sur une Volkswagen Polo ?'),
(16, 175, 'Information financement', 'Proposez-vous des solutions de financement pour l\'achat de véhicules d\'occasion ?'),
(17, 176, 'Problème après achat', 'Bonjour, j\'ai acheté un véhicule récemment chez vous et j\'ai constaté un bruit inhabituel au démarrage.'),
(18, 177, 'Question entretien', 'Quels sont les délais pour obtenir un rendez-vous pour une révision complète ?'),
(19, 178, 'Demande de rappel', 'Merci de me rappeler concernant ma demande d\'achat du véhicule Renault Clio 4.'),
(20, 180, 'Remerciement', 'Je tenais à remercier votre équipe pour son professionnalisme lors de l\'achat de mon véhicule.'),
(24, 183, 'Annulation RDV', 'Bonjour, suite à un imprévu j\'aimerais annuler le rdv de demain. Désolé'),
(25, 183, 'Prise rdv semaine pro', 'Bonjour, j\'aimerais prendre un rdv pour une vidange le 11/06'),
(26, 180, 'RDV', 'Bonjour, prise rdv demain'),
(27, 180, 'RDV', 'Bonjour j\'aimerais prendre rendez-vous la semaine prochaine');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicule_id` int DEFAULT NULL,
  `etat_demande_id` int DEFAULT NULL,
  `sujet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu_message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_demande_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2694D7A54A4A3511` (`vehicule_id`),
  KEY `IDX_2694D7A529A5620D` (`etat_demande_id`),
  KEY `IDX_2694D7A5FC80D23D` (`genre_demande_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231030145748', '2023-10-30 15:01:25', 535),
('DoctrineMigrations\\Version20231031133254', '2023-10-31 13:34:40', 294),
('DoctrineMigrations\\Version20231115093519', '2023-11-15 10:41:53', 191),
('DoctrineMigrations\\Version20231116105421', '2023-11-16 10:55:38', 154),
('DoctrineMigrations\\Version20231116145834', '2023-11-16 14:58:41', 27),
('DoctrineMigrations\\Version20231122081428', '2023-11-22 08:14:39', 163),
('DoctrineMigrations\\Version20231123140906', '2023-11-23 14:09:22', 83),
('DoctrineMigrations\\Version20231123141456', '2023-11-23 14:15:21', 27),
('DoctrineMigrations\\Version20231129145745', '2023-11-29 14:58:33', 74),
('DoctrineMigrations\\Version20231208093245', '2023-12-08 09:39:39', 59),
('DoctrineMigrations\\Version20240108104654', '2024-01-08 10:47:10', 256),
('DoctrineMigrations\\Version20240111154356', '2024-01-11 15:49:01', 568);

-- --------------------------------------------------------

--
-- Structure de la table `etat_demande`
--

DROP TABLE IF EXISTS `etat_demande`;
CREATE TABLE IF NOT EXISTS `etat_demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle_etat_demande` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etat_ouverture_garage`
--

DROP TABLE IF EXISTS `etat_ouverture_garage`;
CREATE TABLE IF NOT EXISTS `etat_ouverture_garage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_open` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat_ouverture_garage`
--

INSERT INTO `etat_ouverture_garage` (`id`, `is_open`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `genre_demande`
--

DROP TABLE IF EXISTS `genre_demande`;
CREATE TABLE IF NOT EXISTS `genre_demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle_genre_demande` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre_demande`
--

INSERT INTO `genre_demande` (`id`, `libelle_genre_demande`) VALUES
(27, 'Enim.'),
(28, 'Est.'),
(29, 'Dolor.'),
(30, 'Hic est.'),
(31, 'Et qui.');

-- --------------------------------------------------------

--
-- Structure de la table `reparation`
--

DROP TABLE IF EXISTS `reparation`;
CREATE TABLE IF NOT EXISTS `reparation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_moyen` int NOT NULL,
  `nom_reparation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reparation`
--

INSERT INTO `reparation` (`id`, `code`, `prix_moyen`, `nom_reparation`) VALUES
(20, '48ADOP', 300, 'Changement de pneus arrières avec pneus neufs'),
(29, '7894AZ', 1200, 'Remplacement portière avant'),
(30, '6541AP', 400, 'Remplacement pare-brise'),
(34, '3161XD', 28, 'Nettoyage pare brise avant et pare brise arrière'),
(35, '2145SQ', 123, 'Remplacement batterie');

-- --------------------------------------------------------

--
-- Structure de la table `search_data`
--

DROP TABLE IF EXISTS `search_data`;
CREATE TABLE IF NOT EXISTS `search_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `min_price` int NOT NULL,
  `max_price` int NOT NULL,
  `min_kms` int NOT NULL,
  `max_kms` int NOT NULL,
  `min_annees` date NOT NULL,
  `max_annees` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `lastname`, `firstname`, `address`, `zipcode`, `city`) VALUES
(167, 'vincentparrot@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$IS4YPrg038Q2au4DSKRltu6X.XsujjQbJHOJn/0rTnvGqX0tf1qWW', 'parrot', 'vincent', '3 rue du pain', '74100', 'Annecy'),
(168, 'emmanuel.rodrigues@tele2.fr', '[\"ROLE_USER\"]', '$2y$13$y2iYPsu2tTMnyEjd9IM.c.j6405J353p7rwlneKY59tr2e/mwUZN6', 'Le Roux', 'Adèle', 'place Sébastien Clerc', '95 918', 'Chauveau'),
(169, 'xdumont@noos.fr', '[\"ROLE_USER\"]', '$2y$13$b9g7JfxdV4q3moWGElZhkePaJH78m/1PEawEgsRTqJy6rgRqkZyyu', 'Lefebvre', 'Jeannine', 'impasse Laroche', '29046', 'Fernandez-les-Bains'),
(170, 'auguste.antoine@free.fr', '[\"ROLE_USER\"]', '$2y$13$lCulDIUxlLN/528n8nIgVebimlpl0T9wpYZHpK60VUf6fdJMZ/OPW', 'Cousin', 'Tristan', '51, rue de Gimenez', '49 724', 'Fernandes-sur-Garcia'),
(171, 'nfabre@neveu.org', '[\"ROLE_USER\"]', '$2y$13$cwcGNeqBzpCOI5SALNNNSOREO3PqX6GeKXODbJ8W6Ho5WKI0Utj66', 'Brunet', 'Matthieu', '925, place de Olivier', '86652', 'Bruneau'),
(172, 'peltier.nathalie@gerard.net', '[\"ROLE_USER\"]', '$2y$13$M8VgbrVcPQHRayThW//mgO9UVDiprKuw8jjES9Md2g6WZ.Q7.vq.a', 'Lemaire', 'Pierre', '89, avenue de Launay', '93878', 'Arnaud-sur-Mer'),
(173, 'mathis@gmail.com', '[\"ROLE_USER\"]', '$2y$13$ugvimOHcpiz4pMaKoKLEeOhyZzBPTH/1rM.6W7w9e0MHiZMz1NfJK', 'Dupont', 'Mathis', 'Rue du bureau', '74100', 'Annemasse'),
(174, 'tsitokikoo@gmail.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$EKCqoT.KtmbhDySvulXkyu9oP58SUiIZJznRDakDwYwDQ4/tTQu9G', 'Rabarijaona', 'tsitoha', 'contamines', '74160', 'stju'),
(175, 'victordup@gmail.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$D9B3CySCYszP0CG8SkObEOL8oOmJY.9OY/o9mNLjjLNapbxWi7W1u', 'Dupont', 'Victor', 'Avenue des gens', '74100', 'Annecy'),
(176, 'adphilippe@gmail.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$iCsK9UnOmjH5HRbtF45BteL1H0Ot1jkAYqq2eOhyXyUoVvxNQ2RIy', 'Adobe', 'Philippe', 'rue du porte feuille', '74100', 'Annemasse'),
(177, 'hugopuits@gmail.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$/4sIMsmDtGst92RToffKsenBir/NFBRbssgXLhirMa2XO47/p0KwS', 'Puits', 'Hugo', 'Rue du buldozer', '74000', 'Annecy'),
(178, 'sophie23@gmail.com', '[\"ROLE_USER\"]', '$2y$13$zWUoj5oZ/Z6NmzTwJfswEOxy0o78RkW65sDKNf74tfXbQpkpCHW0K', 'Dutel', 'Sophie', 'rue de l\'eau', '74100', 'Annecy'),
(179, 'hugo@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'manche', 'hugo', 'rue du kilogramme', '74160', 'Saint julien'),
(180, 'sophiesty@gmail.com', '[\"ROLE_USER\"]', '$2y$13$BEBAlaSlAqUnNz98YtPmP..1.UYCIPvaDWjACM5yY53BqL7VmHFkm', 'Stylo', 'Sophie', 'Rue du levant', '74100', 'Annemasse'),
(181, 'avora@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$OGcMx6HOW5PbevdOtgL8GOKrwCEgMVUc3a5RF3MeuSYOXX1zcFIKa', 'Rabari', 'Avo', 'Rue du marteau', '75100', 'Paris'),
(182, 'quentin@gmail.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$LO1XepyHslWiKkSsxsqsJ.E5GlD9eOd1CIhSwjncQ6KnR.z.lUUra', 'Dupieux', 'Quentin', 'Avenue Maréchal', '74100', 'Annemasse'),
(183, 'test@gmail.com', '[\"ROLE_USER\"]', '$2y$13$fZW21FWug47Q67Q6jItdhOdAKtBznfIpoqjtUIQZGSjf3LGx4qVYq', 'Abc', 'Henri', 'rue de gourde', '74100', 'Annemasse'),
(184, 'chris@gmail.com', '[\"ROLE_USER\"]', '$2y$13$h6Z5Jimylh/34O3BLYa4d.fY1O46FhepNHWBGl.y1Q8mBRw3CCJOm', 'DER', 'Chris', 'Avenue Foch', '74100', 'Annemasse'),
(187, 'tom@gmail.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$.samoOVAFxdivZbB80nmV.SG0ZFiQ9aTfUczPnO/UOHtnLuVLk4ly', 'Sawyer', 'Tom', 'Place du marché', '74100', 'Annemasse'),
(188, 'ophelie@gmail.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$t2M6XGwnVa6FNSi8AcH9O.W8WZ/9bLpOdOumkpi1tQPcnpahh0t3S', 'Arbre', 'Ophelie', 'Rue du livron', '74100', 'Annemasse'),
(189, 'ghislaine@gmail.com', '[\"ROLE_USER\"]', '$2y$13$UUQz0AXvKrAe2ojnIfNdH.CNyXzHO1aD.Q5GIPsXYTgIAh/rUkpd2', 'Marais', 'Ghislaine', 'Rue du fleuve', '74100', 'Annemasse'),
(190, 'marie.dupont@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Dupont', 'Marie', '12 rue Victor Hugo', '74000', 'Annecy'),
(191, 'paul.martin@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Martin', 'Paul', '5 avenue de France', '74100', 'Annemasse'),
(192, 'julie.bernard@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Bernard', 'Julie', '18 rue des Alpes', '74200', 'Thonon'),
(193, 'luc.moreau@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Moreau', 'Luc', '3 rue Centrale', '74000', 'Annecy'),
(194, 'sarah.leroy@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Leroy', 'Sarah', '27 avenue du Léman', '74160', 'Saint-Julien'),
(195, 'thomas.robert@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Robert', 'Thomas', '45 rue du Mont-Blanc', '74100', 'Annemasse'),
(196, 'camille.richard@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Richard', 'Camille', '8 rue de la Gare', '74000', 'Annecy'),
(197, 'nicolas.petit@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Petit', 'Nicolas', '14 rue du Commerce', '74240', 'Gaillard'),
(198, 'lea.garnier@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Garnier', 'Léa', '2 rue du Parc', '74130', 'Bonneville'),
(199, 'alexandre.faure@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Faure', 'Alexandre', '11 avenue des Sports', '74000', 'Annecy'),
(200, 'manon.chevalier@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Chevalier', 'Manon', '22 rue des Fleurs', '74100', 'Annemasse'),
(201, 'kevin.roche@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Roche', 'Kevin', '6 impasse des Lilas', '74300', 'Cluses'),
(202, 'amelie.blanc@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Blanc', 'Amélie', '33 rue de Genève', '74000', 'Annecy'),
(203, 'julien.perrin@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Perrin', 'Julien', '17 rue des Tilleuls', '74160', 'Saint-Julien'),
(204, 'clara.girard@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Girard', 'Clara', '28 avenue du Rhône', '74200', 'Thonon'),
(205, 'antoine.roux@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Roux', 'Antoine', '13 rue Pasteur', '74100', 'Annemasse'),
(206, 'emma.boyer@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Boyer', 'Emma', '4 rue du Lac', '74000', 'Annecy'),
(207, 'maxime.colin@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Colin', 'Maxime', '25 rue de la Paix', '74240', 'Gaillard'),
(208, 'laura.mercier@gmail.com', '[\"ROLE_USER\"]', '$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2', 'Mercantile', 'Laura', '10 rue du Stade de la paguette', '74130', 'Bonneville'),
(210, 'yohancab@gmail.com', '[\"ROLE_USER\"]', '$2y$13$k/5cMoc0K8cDLR4N.g7AtuYLTI8vbafhQxyNYQJvdVEM22ZZXtaEG', 'Cabaye', 'Yohan', 'Avenue du soleil', '74160', 'Saint Julien en Genevois');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `immatriculation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int NOT NULL,
  `annee_mise_en_circulation` int NOT NULL,
  `kms` int NOT NULL,
  `est_disponible` tinyint(1) NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_292FFF1DA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `libelle`, `immatriculation`, `prix`, `annee_mise_en_circulation`, `kms`, `est_disponible`, `image_name`, `user_id`) VALUES
(71, 'Audi Q8 occasion', 'AP124DK', 2000, 2005, 350000, 0, 'audiq8-6569bb586a200776510325.jpg', 174),
(72, 'Audi RS3', 'ZE789DQ', 8415, 2009, 100000, 1, 'audi-rs-3-abt-656edc4d748d5909045879.jpg', 171),
(86, 'Dacia Sandero', 'SQ456ED', 7745, 2015, 120514, 1, 'sandero-6a1d8809658c4062256384.jpg', 184),
(87, 'Opel Astra 3', 'AZ485DQ', 7496, 2009, 125012, 1, 'opelastra-6a205688e0f9e697362965.jpg', 188),
(88, 'Clio 2', 'UX94SQ', 8000, 2014, 84632, 1, 'clio2-6a218d0d59e2e414233350.jpg', 198),
(89, 'Citroen C4', 'JH415SA', 9456, 2025, 97455, 1, 'citroenc4-6a218dc82ef25456780776.jpg', 193),
(90, 'Toyota Hilux', 'HS28QA', 18000, 2017, 94512, 1, 'toyotahilux-6a2193c169b69947117981.jpg', 198);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `FK_2694D7A529A5620D` FOREIGN KEY (`etat_demande_id`) REFERENCES `etat_demande` (`id`),
  ADD CONSTRAINT `FK_2694D7A54A4A3511` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicule` (`id`),
  ADD CONSTRAINT `FK_2694D7A5FC80D23D` FOREIGN KEY (`genre_demande_id`) REFERENCES `genre_demande` (`id`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `FK_292FFF1DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
