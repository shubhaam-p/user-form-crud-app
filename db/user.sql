            $query = "INSERT INTO user (name, email_id, dob, pwd) VALUES(?, ?, ?, ?)";


    CREATE TABLE `user` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `email_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `dob` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `pwd` text COLLATE utf8mb4_unicode_ci,
    `nstatus` int DEFAULT NULL,
    `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
    `updatedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deletedon` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
    )