DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` int NOT NULL,
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;