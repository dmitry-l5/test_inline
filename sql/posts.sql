DROP TABLE IF EXISTS `posts`;
CREATE TABLE `inline_test`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` TEXT NULL,
  `body` TEXT NULL,
  PRIMARY KEY (`id`));
