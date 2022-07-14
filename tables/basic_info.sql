DROP TABLE IF EXISTS `basic_info`;
CREATE TABLE `basic_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` int NOT NULL,
  `data` longtext NOT NULL,
  `host_country` varchar(128),
  `city_street` varchar(128),
  `zip_code` int,
  `entry_fee` int,
  `starting_date` date,
  `ending_date` date,
  `end_of_pre_reg` date,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;