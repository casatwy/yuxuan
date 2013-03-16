<?php

class m130124_133139_create_tables extends CDbMigration
{
	public function up()
	{
        $sql = "
            DROP TABLE IF EXISTS `daily_product`;
            CREATE TABLE IF NOT EXISTS `daily_product` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `time` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `count` int(11) DEFAULT NULL,
            `weight` float DEFAULT NULL,
            `goods_number` int(11) NOT NULL,
            `type` tinyint(4) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `goods_number` (`goods_number`),
            KEY `product_id` (`product_id`),
            KEY `type` (`type`),
            KEY `time` (`time`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


            DROP TABLE IF EXISTS `delivered_plan`;
            CREATE TABLE IF NOT EXISTS `delivered_plan` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `client_id` int(11) NOT NULL,
            `record_time` int(11) NOT NULL,
            `plan_maker_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `client_id` (`client_id`),
            KEY `record_time` (`record_time`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;


            DROP TABLE IF EXISTS `delivered_plan_item`;
            CREATE TABLE IF NOT EXISTS `delivered_plan_item` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `silk_id` int(11) NOT NULL,
            `count` int(11) NOT NULL,
            `weight` float NOT NULL,
            `goods_number` int(11) NOT NULL,
            `record_time` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `delivered_plan_id` bigint(20) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `goods_number` (`goods_number`),
            KEY `silk_id` (`silk_id`),
            KEY `record_time` (`record_time`),
            KEY `product_id` (`product_id`),
            KEY `delivered_plan_id` (`delivered_plan_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `delivered_record`;
            CREATE TABLE IF NOT EXISTS `delivered_record` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `record_time` int(11) NOT NULL,
            `record_maker_id` int(11) NOT NULL,
            `client_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `record_time` (`record_time`),
            KEY `client_id` (`client_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `delivered_record_item`;
            CREATE TABLE IF NOT EXISTS `delivered_record_item` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `delivered_record_id` bigint(20) NOT NULL,
            `weight` float NOT NULL,
            `count` int(11) NOT NULL,
            `goods_number` int(11) NOT NULL,
            `type` tinyint(4) NOT NULL,
            `record_time` int(11) NOT NULL,
            `record_maker_id` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `goods_number` (`goods_number`),
            KEY `delivered_record_id` (`delivered_record_id`),
            KEY `type` (`type`),
            KEY `record_time` (`record_time`),
            KEY `product_id` (`product_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `order`;
            CREATE TABLE IF NOT EXISTS `order` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `client_id` int(11) NOT NULL,
            `total_fee` int(11) DEFAULT NULL,
            `status` tinyint(4) NOT NULL,
            `create_time` int(11) NOT NULL,
            `finished_time` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `client_id` (`client_id`),
            KEY `status` (`status`),
            KEY `create_time` (`create_time`),
            KEY `finished_time` (`finished_time`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `product`;
            CREATE TABLE IF NOT EXISTS `product` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `needle_type` int(11) NOT NULL,
            `color_name` varchar(10) COLLATE utf8_bin NOT NULL,
            `color_number` int(11) NOT NULL,
            `goods_number` int(11) NOT NULL,
            `size` varchar(10) COLLATE utf8_bin NOT NULL,
            `order_id` int(11) DEFAULT NULL,
            `price` int(11) DEFAULT NULL,
            `total_count` int(11) DEFAULT NULL,
            `client_id` int(11) DEFAULT NULL,
            `status` tinyint(4) NOT NULL,
            `create_time` int(11) NOT NULL,
            `finished_time` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `color_number` (`color_number`),
            KEY `goods_number` (`goods_number`),
            KEY `order_id` (`order_id`),
            KEY `client_id` (`client_id`),
            KEY `status` (`status`),
            KEY `create_time` (`create_time`),
            KEY `finished_time` (`finished_time`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `client`;
            CREATE TABLE IF NOT EXISTS `client` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(20) COLLATE utf8_bin NOT NULL,
            `location` varchar(20) COLLATE utf8_bin NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `received_record`;
            CREATE TABLE IF NOT EXISTS `received_record` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `record_time` int(11) NOT NULL,
            `record_maker_id` int(20) NOT NULL,
            `client_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `record_time` (`record_time`),
            KEY `client_id` (`client_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `received_record_item`;
            CREATE TABLE IF NOT EXISTS `received_record_item` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `received_record_id` bigint(20) NOT NULL,
            `weight` float DEFAULT NULL,
            `count` int(11) DEFAULT NULL,
            `goods_number` int(11) NOT NULL,
            `record_time` int(11) NOT NULL,
            `record_maker_id` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            `type` tinyint(4) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `received_record_id` (`received_record_id`),
            KEY `goods_number` (`goods_number`),
            KEY `record_time` (`record_time`),
            KEY `product_id` (`product_id`),
            KEY `type` (`type`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `silk`;
            CREATE TABLE IF NOT EXISTS `silk` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `goods_number` int(11) NOT NULL,
            `color_name` varchar(20) COLLATE utf8_bin NOT NULL,
            `color_number` int(11) NOT NULL,
            `gang_number` int(11) NOT NULL,
            `order_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `goods_number` (`goods_number`),
            KEY `color_number` (`color_number`),
            KEY `order_id` (`order_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `silk_storage`;
            CREATE TABLE IF NOT EXISTS `silk_storage` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `weight` float NOT NULL,
            `goods_number` int(11) NOT NULL,
            `silk_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `goods_number` (`goods_number`),
            KEY `silk_id` (`silk_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `product_storage`;
            CREATE TABLE IF NOT EXISTS `product_storage` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `weight` float NOT NULL,
            `count` int(11) NOT NULL,
            `goods_number` int(11) NOT NULL,
            `product_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `goods_number` (`goods_number`),
            KEY `product_id` (`product_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


            DROP TABLE IF EXISTS `user`;
            CREATE TABLE IF NOT EXISTS `user` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(20) COLLATE utf8_bin NOT NULL,
            `telephone` varchar(20) COLLATE utf8_bin NOT NULL,
            `password` varchar(45) COLLATE utf8_bin NOT NULL,
            `authority` varchar(45) COLLATE utf8_bin NOT NULL,
            `available` tinyint(2) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `password` (`password`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

        INSERT INTO  `yuxuan`.`user` (`id` , `name` ,`telephone` ,`password` ,`authority` ,`available`)
        VALUES (NULL ,  'casa',  '13636495946',  '6752324b14fe3c3c8df0d973e5ae32ed',  '7420738134810',  '0');
        ";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "
            DROP TABLE IF EXISTS `daily_product`;
            DROP TABLE IF EXISTS `delivered_plan`;
            DROP TABLE IF EXISTS `delivered_plan_item`;
            DROP TABLE IF EXISTS `delivered_record`;
            DROP TABLE IF EXISTS `delivered_record_item`;
            DROP TABLE IF EXISTS `order`;
            DROP TABLE IF EXISTS `client`;
            DROP TABLE IF EXISTS `product`;
            DROP TABLE IF EXISTS `received_record`;
            DROP TABLE IF EXISTS `received_record_item`;
            DROP TABLE IF EXISTS `silk_storage`;
            DROP TABLE IF EXISTS `product_storage`;
            DROP TABLE IF EXISTS `silk`;
            DROP TABLE IF EXISTS `user`;
            ";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
