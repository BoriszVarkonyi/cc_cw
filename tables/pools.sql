DROP TABLE IF EXISTS `pools`;
CREATE TABLE `pools` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` int NOT NULL,
  `fencers` longtext,
  `matches` longtext,
  `pool_of` int NOT NULL,
  `sort_by_club` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;