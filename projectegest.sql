-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projectgest
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projectgest
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projectgest` DEFAULT CHARACTER SET utf8 ;
USE `projectgest` ;

-- -----------------------------------------------------
-- Table `projectgest`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projectgest`.`usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL DEFAULT NOW(),
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `password_UNIQUE` (`password` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projectgest`.`proyecto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projectgest`.`proyecto` (
  `proyecto_id` INT NOT NULL,
  `titulo` VARCHAR(255) NULL,
  `descripcion` VARCHAR(255) NULL,
  `fecha_inicio` DATE NULL,
  `fecha_fin` DATE NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`proyecto_id`),
  INDEX `fk_proyecto_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_proyecto_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `projectgest`.`usuario` (`usuario_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projectgest`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projectgest`.`estado` (
  `estado_id` INT NOT NULL,
  `nombre` VARCHAR(255) NULL,
  PRIMARY KEY (`estado_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projectgest`.`tarea`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projectgest`.`tarea` (
  `tarea_id` INT NOT NULL,
  `titulo` VARCHAR(255) NULL,
  `descripcion` VARCHAR(255) NULL,
  `comentarios` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `usuario_id` INT NOT NULL,
  `estado_id` INT NOT NULL,
  `proyecto_id` INT NOT NULL,
  PRIMARY KEY (`tarea_id`),
  INDEX `fk_tarea_usuario1_idx` (`usuario_id` ASC) ,
  INDEX `fk_tarea_estado1_idx` (`estado_id` ASC) ,
  INDEX `fk_tarea_proyecto1_idx` (`proyecto_id` ASC) ,
  CONSTRAINT `fk_tarea_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `projectgest`.`usuario` (`usuario_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tarea_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `projectgest`.`estado` (`estado_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tarea_proyecto1`
    FOREIGN KEY (`proyecto_id`)
    REFERENCES `projectgest`.`proyecto` (`proyecto_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
