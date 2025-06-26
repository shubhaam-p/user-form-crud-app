CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwd` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `nstatus` int DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
)