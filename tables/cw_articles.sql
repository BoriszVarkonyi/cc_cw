DROP TABLE IF EXISTS `cw_articles`;
CREATE TABLE `cw_articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT (curdate()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

INSERT INTO cw_articles (title, body, author) VALUES 
    ('First article', 'Hello World', 'szeto'),
    ('Second Article', 'Second article', 'szeto');