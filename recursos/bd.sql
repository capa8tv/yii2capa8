-- MySQL Workbench Synchronization
-- Generated: 2015-09-15 21:16
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Jonathan Morales Salazar

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `blogcapa8`.`noticia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `titulo` VARCHAR(100) NOT NULL COMMENT '',
  `detalle` VARCHAR(45) NOT NULL COMMENT '',
  `categoria_id` INT(11) NOT NULL COMMENT '',
  `created_by` INT(11) UNSIGNED NOT NULL COMMENT '',
  `created_at` DATETIME NULL DEFAULT NULL COMMENT '',
  `udated_by` INT(11) UNSIGNED NOT NULL COMMENT '',
  `updated_at` DATETIME NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`, `created_by`)  COMMENT '',
  INDEX `fk_noticia_categoria1_idx` (`categoria_id` ASC)  COMMENT '',
  INDEX `fk_noticia_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_noticia_user2_idx` (`udated_by` ASC)  COMMENT '',
  CONSTRAINT `fk_noticia_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `blogcapa8`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticia_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `blogcapa8`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticia_user2`
    FOREIGN KEY (`udated_by`)
    REFERENCES `blogcapa8`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `blogcapa8`.`categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `categoria` VARCHAR(45) NOT NULL COMMENT '',
  `imagen` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `created_at` DATETIME NULL DEFAULT NULL COMMENT '',
  `created_by` INT(11) UNSIGNED NOT NULL COMMENT '',
  `updated_at` DATETIME NULL DEFAULT NULL COMMENT '',
  `updated_by` INT(11) UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_categoria_user1_idx` (`created_by` ASC)  COMMENT '',
  INDEX `fk_categoria_user2_idx` (`updated_by` ASC)  COMMENT '',
  CONSTRAINT `fk_categoria_user1`
    FOREIGN KEY (`created_by`)
    REFERENCES `blogcapa8`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categoria_user2`
    FOREIGN KEY (`updated_by`)
    REFERENCES `blogcapa8`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
