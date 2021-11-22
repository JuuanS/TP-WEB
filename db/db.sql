SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

CREATE DATABASE IF NOT EXISTS `db_movietracker` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_movietracker`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ROLE_NAME_UK` (`role_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`),
  UNIQUE KEY `USER_NAME_UK` (`user_name`),
  UNIQUE KEY `USER_EMAIL_UK` (`email`),
  CONSTRAINT `ROLE_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CATEGORY_NAME_UK` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `movies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `movie_title` varchar(100) NOT NULL,
  `movie_description` text DEFAULT NULL,
  `movie_release_date` timestamp NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_url` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `CATEGORIE_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `movie_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `movie_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `comment` text DEFAULT NULL,
  `vote` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `MOVIE_FK` FOREIGN KEY (`movie_id`) REFERENCES `users` (`id`),
  CONSTRAINT `USER_FK` FOREIGN KEY (`user_id`) REFERENCES `movies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;