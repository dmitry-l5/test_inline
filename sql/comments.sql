DROP TABLE IF EXISTS `comments`;
CREATE TABLE `inline_test`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_id` INT NOT NULL,
  `email` VARCHAR(255) NULL,
  `body` LONGTEXT NULL,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`));