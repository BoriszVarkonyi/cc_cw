DROP TABLE IF EXISTS `cw_videos`;
CREATE TABLE `cw_videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comp_name` varchar(255) NOT NULL,
  `prev` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `comp_id` int DEFAULT NULL,
  `created` date NOT NULL DEFAULT (curdate()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;


INSERT INTO cw_videos (url, title, comp_name, comp_id, prev, author) VALUES
  ('https://youtu.be/Ozor-bT-sOs', 'First video', 'csgo', 1, 'Preview test', 'szeto'),
  ('https://youtu.be/VzvH5UZVQU8', 'Second video', 'csgo', 52, 'Prev text', 'szeto');