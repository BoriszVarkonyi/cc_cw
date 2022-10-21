DROP TABLE IF EXISTS `technicians`;
CREATE TABLE `technicians` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` int NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `role` int NOT NULL,
  `pass` text,
  `online` boolean NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;