DROP TABLE IF EXISTS `weapon_control`;
CREATE TABLE `weapon_control` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comp_id` varchar(255) NOT NULL,
  `fencer_id` varchar(255) NOT NULL,
  `issues_array` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `weapons_turned_in` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `notes` varchar(255) DEFAULT NULL,
  `check_in_date` timestamp NULL DEFAULT NULL,
  `check_out_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `weapon_control_chk_1` CHECK (json_valid(`issues_array`)),
  CONSTRAINT `weapon_control_chk_2` CHECK (json_valid(`weapons_turned_in`))
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;