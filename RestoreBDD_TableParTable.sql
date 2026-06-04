DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (167,'vincentparrot@gmail.com','[\"ROLE_ADMIN\"]','$2y$13$IS4YPrg038Q2au4DSKRltu6X.XsujjQbJHOJn/0rTnvGqX0tf1qWW','parrot','vincent','3 rue du pain','74100','Annecy'),(168,'emmanuel.rodrigues@tele2.fr','[]','$2y$13$y2iYPsu2tTMnyEjd9IM.c.j6405J353p7rwlneKY59tr2e/mwUZN6','Le Roux','Adèle','place Sébastien Clerc','95 918','Chauveau'),(169,'xdumont@noos.fr','[]','$2y$13$b9g7JfxdV4q3moWGElZhkePaJH78m/1PEawEgsRTqJy6rgRqkZyyu','Lefebvre','Jeannine','impasse Laroche','29046','Fernandez-les-Bains'),(170,'auguste.antoine@free.fr','[]','$2y$13$lCulDIUxlLN/528n8nIgVebimlpl0T9wpYZHpK60VUf6fdJMZ/OPW','Cousin','Tristan','51, rue de Gimenez','49 724','Fernandes-sur-Garcia'),(171,'nfabre@neveu.org','[]','$2y$13$cwcGNeqBzpCOI5SALNNNSOREO3PqX6GeKXODbJ8W6Ho5WKI0Utj66','Brunet','Matthieu','925, place de Olivier','86652','Bruneau'),(172,'peltier.nathalie@gerard.net','[]','$2y$13$M8VgbrVcPQHRayThW//mgO9UVDiprKuw8jjES9Md2g6WZ.Q7.vq.a','Lemaire','Pierre','89, avenue de Launay','93878','Arnaud-sur-Mer'),(173,'mathis@gmail.com','[]','$2y$13$ugvimOHcpiz4pMaKoKLEeOhyZzBPTH/1rM.6W7w9e0MHiZMz1NfJK','Dupont','Mathis','Rue du bureau','74100','Annemasse'),(174,'tsitokikoo@gmail.com','[\"ROLE_EMPLOYE\"]','$2y$13$EKCqoT.KtmbhDySvulXkyu9oP58SUiIZJznRDakDwYwDQ4/tTQu9G','Rabarijaona','tsitoha','contamines','74160','stju'),(175,'victordup@gmail.com','[\"ROLE_EMPLOYE\"]','$2y$13$D9B3CySCYszP0CG8SkObEOL8oOmJY.9OY/o9mNLjjLNapbxWi7W1u','Dupont','Victor','Avenue des gens','74100','Annecy'),(176,'adphilippe@gmail.com','[\"ROLE_EMPLOYE\"]','$2y$13$iCsK9UnOmjH5HRbtF45BteL1H0Ot1jkAYqq2eOhyXyUoVvxNQ2RIy','Adobe','Philippe','rue du porte feuille','74100','Annemasse'),(177,'hugopuits@gmail.com','[\"ROLE_EMPLOYE\"]','$2y$13$/4sIMsmDtGst92RToffKsenBir/NFBRbssgXLhirMa2XO47/p0KwS','Puits','Hugo','Rue du buldozer','74000','Annecy'),(178,'sophie23@gmail.com','[]','$2y$13$zWUoj5oZ/Z6NmzTwJfswEOxy0o78RkW65sDKNf74tfXbQpkpCHW0K','Dutel','Sophie','rue de l\'eau','74100','Annecy'),(179,'hugo@gmail','[]','$2y$13$OaEOF8NKL4ZDIKVGiYSGde1WkzgokZoQylljJoBOGcTnCchrxU9k2','manche','hugo','rue du kilo','74160','Saint julien');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `etat_demande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etat_demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle_etat_demande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `avis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `note` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu_message_avis` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`),
  CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638A76ED395` (`user_id`),
  CONSTRAINT `FK_4C62E638A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `etat_ouverture_garage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etat_ouverture_garage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_open` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `etat_ouverture_garage` WRITE;
/*!40000 ALTER TABLE `etat_ouverture_garage` DISABLE KEYS */;
INSERT INTO `etat_ouverture_garage` VALUES (1,1);
/*!40000 ALTER TABLE `etat_ouverture_garage` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `genre_demande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre_demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle_genre_demande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre_demande`
--

LOCK TABLES `genre_demande` WRITE;
/*!40000 ALTER TABLE `genre_demande` DISABLE KEYS */;
INSERT INTO `genre_demande` VALUES (27,'Enim.'),(28,'Est.'),(29,'Dolor.'),(30,'Hic est.'),(31,'Et qui.');
/*!40000 ALTER TABLE `genre_demande` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `reparation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reparation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_moyen` int NOT NULL,
  `nom_reparation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparation`
--

LOCK TABLES `reparation` WRITE;
/*!40000 ALTER TABLE `reparation` DISABLE KEYS */;
INSERT INTO `reparation` VALUES (17,'8974PO',500,'Reparation carrosserie'),(19,'12345AZ',300,'Reparation roues'),(20,'48ADOP',300,'Changement de pneus arrières avec pneus neufs'),(21,'80ACD45',500,'Reparation moteur'),(22,'80ACD45',500,'Reparation moteur'),(24,'80DC58',100,'Changement liquide de frein'),(26,'7894AD',32,'ebabab'),(27,'7894AD',45,'vvvava');
/*!40000 ALTER TABLE `reparation` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immatriculation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int NOT NULL,
  `annee_mise_en_circulation` int NOT NULL,
  `kms` int NOT NULL,
  `est_disponible` tinyint(1) NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_292FFF1DA76ED395` (`user_id`),
  CONSTRAINT `FK_292FFF1DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
INSERT INTO `vehicule` VALUES (66,'Renault clio','DF654AS',2500,2005,200000,1,'renaultclio-656854207888b814013026.jpg',170),(67,'Peugeot 308','PD451XS',5000,2015,300000,1,'peugeot308-65685aa70f357983633252.jpg',173),(69,'Toyota yaris','HO236NX',4000,2010,200000,1,'toyotayaris-65685b02b963e340595041.jpg',169),(70,'Citroen C4','IZ802QU',2000,2001,250000,1,'citroenc4-65685b3001bd2239491673.jpg',168),(71,'Audi Q8 occasion','AP124DK',2000,2005,350000,0,'audiq8-6569bb586a200776510325.jpg',174),(72,'Audi RS3','ZE789DQ',8415,2009,100000,1,'audi-rs-3-abt-656edc4d748d5909045879.jpg',171),(73,'Renaut megane','SQ126DF',2000,2003,300000,1,'renaultmegane-656edc741f838103693650.jpg',170),(74,'Mercedes Classe A','LM523SQ',5358,2008,275000,1,'mercedesclassea-656edcb363514471318618.jpg',172),(75,'Renault Capture 2','HO736QS',7400,2010,258000,1,'renaultcapture2-656edde33efb5629752296.png',168),(76,'Renault clio 5 bleue','PA785MV',1578,2002,289000,1,'renaultclio5bleue-656ee04958a34478493921.jpg',172),(77,'Audi Q8','DK124QE',10000,2013,319755,1,'audiq8-656ee0f35a0a6664610803.jpg',174),(78,'Peugeot 2008','UN694AZ',8456,2011,246852,1,'peugeot2008-656ee13e06fa5048614075.jpg',171),(79,'Toyota hybrid','DC450EF',6500,2015,100000,1,'toyotahybride-65a8f81770243849887053.jpg',174);
/*!40000 ALTER TABLE `vehicule` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `search_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `search_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `min_price` int NOT NULL,
  `max_price` int NOT NULL,
  `min_kms` int NOT NULL,
  `max_kms` int NOT NULL,
  `min_annees` date NOT NULL,
  `max_annees` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_data`
--

LOCK TABLES `search_data` WRITE;
/*!40000 ALTER TABLE `search_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_data` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20231030145748','2023-10-30 15:01:25',535),('DoctrineMigrations\\Version20231031133254','2023-10-31 13:34:40',294),('DoctrineMigrations\\Version20231115093519','2023-11-15 10:41:53',191),('DoctrineMigrations\\Version20231116105421','2023-11-16 10:55:38',154),('DoctrineMigrations\\Version20231116145834','2023-11-16 14:58:41',27),('DoctrineMigrations\\Version20231122081428','2023-11-22 08:14:39',163),('DoctrineMigrations\\Version20231123140906','2023-11-23 14:09:22',83),('DoctrineMigrations\\Version20231123141456','2023-11-23 14:15:21',27),('DoctrineMigrations\\Version20231129145745','2023-11-29 14:58:33',74),('DoctrineMigrations\\Version20231208093245','2023-12-08 09:39:39',59),('DoctrineMigrations\\Version20240108104654','2024-01-08 10:47:10',256),('DoctrineMigrations\\Version20240111154356','2024-01-11 15:49:01',568);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `demande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `demande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicule_id` int DEFAULT NULL,
  `etat_demande_id` int DEFAULT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_demande_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2694D7A54A4A3511` (`vehicule_id`),
  KEY `IDX_2694D7A529A5620D` (`etat_demande_id`),
  KEY `IDX_2694D7A5FC80D23D` (`genre_demande_id`),
  CONSTRAINT `FK_2694D7A529A5620D` FOREIGN KEY (`etat_demande_id`) REFERENCES `etat_demande` (`id`),
  CONSTRAINT `FK_2694D7A54A4A3511` FOREIGN KEY (`vehicule_id`) REFERENCES `vehicule` (`id`),
  CONSTRAINT `FK_2694D7A5FC80D23D` FOREIGN KEY (`genre_demande_id`) REFERENCES `genre_demande` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
