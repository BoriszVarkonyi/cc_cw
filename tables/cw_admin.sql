DROP TABLE IF EXISTS `cw_admin`;
CREATE TABLE `cw_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

INSERT INTO cw_admin (name, password) VALUES
    ('borisz', '$2y$10$Wv0U9l0UwpnnM9CI0pHh6OD2fjam5anhVNL/tKgYT0gYvenVPlrBi'),
    ('kovi', '$2y$10$YoDHIRvCJ.cdWsm.1OYbkusbH4yGE4SPAYFLpUPmxZpyJwMbr484y'),
    ('szeto', '$2y$10$YoDHIRvCJ.cdWsm.1OYbkusbH4yGE4SPAYFLpUPmxZpyJwMbr484y');