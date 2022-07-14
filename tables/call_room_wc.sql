DROP TABLE IF EXISTS `call_room_wc`;
CREATE TABLE `call_room_wc` (
  `fencer_id` varchar(11) NOT NULL,
  `comp_id` int NOT NULL,
  `last_table` varchar(3) NOT NULL DEFAULT '0',
  `issues_array` varchar(255) DEFAULT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`fencer_id`,`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;