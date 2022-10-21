DROP TABLE IF EXISTS `tournaments`;
CREATE TABLE `tournaments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tournament_name` varchar(255) NOT NULL,
  `organiser_id` int NOT NULL,
  `timetable` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `appointments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;