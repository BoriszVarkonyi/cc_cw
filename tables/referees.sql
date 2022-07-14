DROP TABLE IF EXISTS `referees`;
CREATE TABLE `referees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` int NOT NULL,
  `sexe` boolean NOT NULL DEFAULT 0,
  `referee_id` int NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `club` varchar(255) NOT NULL,
  `literalite` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `license` varchar(255) NOT NULL,
  `nation` varchar(16) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_online` boolean NOT NULL DEFAULT 0,
  `username` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
