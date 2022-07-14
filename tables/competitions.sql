DROP TABLE IF EXISTS `competitions`;
CREATE TABLE `competitions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `wc_type` int NOT NULL,
  `sex` int NOT NULL,
  `weapon` int NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `info` text NOT NULL,
  `status` int NOT NULL,
  `organiser_id` int NOT NULL,
  `ranking_id` int NOT NULL,
  `host` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `postal` int NOT NULL,
  `entry` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `pre_end` date NOT NULL,
  `tournament_id` int NOT NULL,
  `is_individual` boolean NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;