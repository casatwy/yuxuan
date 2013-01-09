SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `yuxuan` ;
CREATE SCHEMA IF NOT EXISTS `yuxuan` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `yuxuan` ;

-- -----------------------------------------------------
-- Table `yuxuan`.`silk_provider`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`silk_provider` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`silk_provider` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `location` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `yuxuan`.`product_provider`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`product_provider` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`product_provider` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `location` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `yuxuan`.`silk`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`silk` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`silk` (
  `id` BIGINT NOT NULL DEFAULT 1000000 ,
  `color_number` INT NOT NULL ,
  `color_name` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `gang_number` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `goods_number` INT NOT NULL ,
  `product_id` BIGINT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` USING BTREE ON `yuxuan`.`silk` (`goods_number` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`product` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`product` (
  `id` BIGINT NOT NULL DEFAULT 1000000 ,
  `silk_id` INT NOT NULL ,
  `needle_type` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `size` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `goods_number` INT NOT NULL ,
  `diaoxian` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` ON `yuxuan`.`product` (`goods_number` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`receive_record`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`receive_record` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`receive_record` (
  `id` BIGINT NOT NULL DEFAULT 10000000 ,
  `record_time` TIMESTAMP NOT NULL ,
  `record_maker` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `provider_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `record_time` ON `yuxuan`.`receive_record` (`record_time` ASC) ;

CREATE INDEX `provider_id` ON `yuxuan`.`receive_record` (`provider_id` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`deliver_record`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`deliver_record` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`deliver_record` (
  `id` BIGINT NOT NULL DEFAULT 10000000 ,
  `record_time` TIMESTAMP NOT NULL ,
  `record_maker` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `silk_provider_id` INT NOT NULL ,
  `deliver_produce_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `record_time` ON `yuxuan`.`deliver_record` (`record_time` ASC) ;

CREATE INDEX `deliver_produce_id` ON `yuxuan`.`deliver_record` (`deliver_produce_id` ASC) ;

CREATE INDEX `silk_provider_id` ON `yuxuan`.`deliver_record` (`silk_provider_id` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`receive_record_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`receive_record_item` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`receive_record_item` (
  `id` INT NOT NULL ,
  `type` TINYINT NOT NULL ,
  `item_id` BIGINT NOT NULL ,
  `weight` FLOAT NOT NULL ,
  `quantity` INT NOT NULL COMMENT '产品是数量，毛纱是支数' ,
  `goods_number` INT NOT NULL ,
  `record_id` BIGINT NOT NULL ,
  `record_time` TIMESTAMP NOT NULL ,
  `record_maker` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `provider_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` ON `yuxuan`.`receive_record_item` (`goods_number` ASC) ;

CREATE INDEX `item` ON `yuxuan`.`receive_record_item` (`type` ASC, `item_id` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`deliver_record_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`deliver_record_item` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`deliver_record_item` (
  `id` INT NOT NULL ,
  `type` TINYINT NOT NULL ,
  `item_id` BIGINT NOT NULL ,
  `weight` FLOAT NOT NULL ,
  `quantity` INT NOT NULL COMMENT '产品是数量，毛纱是支数' ,
  `goods_number` INT NOT NULL ,
  `record_id` BIGINT NOT NULL ,
  `record_time` TIMESTAMP NOT NULL ,
  `record_maker` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `provider_id` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` ON `yuxuan`.`deliver_record_item` (`goods_number` ASC) ;

CREATE INDEX `item` ON `yuxuan`.`deliver_record_item` (`type` ASC, `item_id` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`storage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`storage` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`storage` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `item_id` BIGINT NOT NULL ,
  `type` TINYINT NOT NULL ,
  `quantity` INT NOT NULL ,
  `goods_number` INT NOT NULL ,
  `total_weight` FLOAT NOT NULL ,
  `total_count` INT NOT NULL ,
  `delivered_weight` FLOAT NOT NULL ,
  `delivered_count` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` ON `yuxuan`.`storage` (`goods_number` ASC) ;

CREATE INDEX `item` ON `yuxuan`.`storage` (`type` ASC, `item_id` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`history_silk`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`history_silk` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`history_silk` (
  `id` BIGINT NOT NULL DEFAULT 1000000 ,
  `color_number` INT NOT NULL ,
  `color_name` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `gang_number` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `goods_number` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` USING BTREE ON `yuxuan`.`history_silk` (`goods_number` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`history_product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`history_product` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`history_product` (
  `id` BIGINT NOT NULL DEFAULT 1000000 ,
  `silk_id` INT NOT NULL ,
  `needle_type` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `size` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `goods_number` INT NOT NULL ,
  `diaoxian` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` ON `yuxuan`.`history_product` (`goods_number` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`history_storage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`history_storage` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`history_storage` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `item_id` BIGINT NOT NULL ,
  `type` TINYINT NOT NULL ,
  `quantity` INT NOT NULL ,
  `goods_number` INT NOT NULL ,
  `total_weight` FLOAT NOT NULL ,
  `total_count` INT NOT NULL ,
  `delivered_weight` FLOAT NOT NULL ,
  `delivered_count` INT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE INDEX `goods_number` ON `yuxuan`.`history_storage` (`goods_number` ASC) ;

CREATE INDEX `item` ON `yuxuan`.`history_storage` (`type` ASC, `item_id` ASC) ;


-- -----------------------------------------------------
-- Table `yuxuan`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `yuxuan`.`users` ;

CREATE  TABLE IF NOT EXISTS `yuxuan`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `telephone` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `password` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `authority` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
