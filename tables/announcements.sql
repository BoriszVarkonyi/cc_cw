DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `is_disabled` boolean NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;