DROP TABLE IF EXISTS `pistes`;
CREATE TABLE `pistes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(64) NOT NULL,
  `available` boolean NOT NULL DEFAULT 0, 
  `url` varchar(256),
  `connectable` boolean NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;