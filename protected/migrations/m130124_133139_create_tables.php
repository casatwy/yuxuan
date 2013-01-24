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
                    `count` int(11) NOT NULL,
                      `goods_number` int(11) NOT NULL,
                        PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`),
  KEY `product_id` (`product_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `delivered_plan`;
        CREATE TABLE IF NOT EXISTS `delivered_plan` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `provider_id` int(11) NOT NULL,
                  `delivered_count` int(11) NOT NULL,
                    `create_time` int(11) NOT NULL,
                      `goods_number` int(11) NOT NULL,
                        `product_id` int(11) NOT NULL,
                          PRIMARY KEY (`id`)
                      ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `deliver_plan`;
        CREATE TABLE IF NOT EXISTS `deliver_plan` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `record_time` int(11) NOT NULL,
                  `plan_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                    `provider_id` int(11) NOT NULL,
                      PRIMARY KEY (`id`),
  KEY `record_time` (`record_time`),
  KEY `silk_provider_id` (`provider_id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `deliver_plan_item`;
        CREATE TABLE IF NOT EXISTS `deliver_plan_item` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `product_id` bigint(20) NOT NULL,
                  `quantity` int(11) NOT NULL,
                    `goods_number` int(11) NOT NULL,
                      `plan_id` bigint(20) NOT NULL,
                        `record_time` int(11) NOT NULL,
                          `plan_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                            `provider_id` int(11) NOT NULL,
                              PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`),
  KEY `item` (`product_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `deliver_record`;
        CREATE TABLE IF NOT EXISTS `deliver_record` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `record_time` int(11) NOT NULL,
                  `record_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                    `provider_id` int(11) NOT NULL,
                      PRIMARY KEY (`id`),
  KEY `record_time` (`record_time`),
  KEY `silk_provider_id` (`provider_id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `deliver_record_item`;
        CREATE TABLE IF NOT EXISTS `deliver_record_item` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `type` tinyint(4) NOT NULL,
                  `item_id` bigint(20) NOT NULL,
                    `weight` float NOT NULL,
                      `quantity` int(11) NOT NULL,
                        `goods_number` int(11) NOT NULL,
                          `record_id` bigint(20) NOT NULL,
                            `record_time` int(11) NOT NULL,
                              `record_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                                `provider_id` int(11) NOT NULL,
                                  PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`),
  KEY `item` (`type`,`item_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `history_product`;
        CREATE TABLE IF NOT EXISTS `history_product` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `silk_id` int(11) NOT NULL,
                  `needle_type` varchar(10) COLLATE utf8_bin NOT NULL,
                    `size` varchar(20) COLLATE utf8_bin NOT NULL,
                      `goods_number` int(11) NOT NULL,
                        `diaoxian` varchar(20) COLLATE utf8_bin NOT NULL,
                          PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `history_silk`;
        CREATE TABLE IF NOT EXISTS `history_silk` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `color_number` int(11) NOT NULL,
                  `color_name` varchar(20) COLLATE utf8_bin NOT NULL,
                    `gang_number` varchar(20) COLLATE utf8_bin NOT NULL,
                      `goods_number` int(11) NOT NULL,
                        PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`) USING BTREE
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `history_storage`;
        CREATE TABLE IF NOT EXISTS `history_storage` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `item_id` bigint(20) NOT NULL,
                  `type` tinyint(4) NOT NULL,
                    `quantity` int(11) NOT NULL,
                      `goods_number` int(11) NOT NULL,
                        `total_weight` float NOT NULL,
                          `total_count` int(11) NOT NULL,
                            `delivered_weight` float NOT NULL,
                              `delivered_count` int(11) NOT NULL,
                                PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`),
  KEY `item` (`type`,`item_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `order_list`;
        CREATE TABLE IF NOT EXISTS `order_list` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                    `status` varchar(24) COLLATE utf8_bin DEFAULT NULL,
                      `received` bigint(20) DEFAULT NULL,
                        `receivable` bigint(20) DEFAULT NULL,
                          PRIMARY KEY (`id`)
                      ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `product`;
        CREATE TABLE IF NOT EXISTS `product` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `silk_id` int(11) NOT NULL,
              `type_id` int(11) NOT NULL,
              `needle_type` varchar(10) COLLATE utf8_bin NOT NULL,
              `size` varchar(20) COLLATE utf8_bin NOT NULL,
              `goods_number` int(11) NOT NULL,
              `diaoxian` varchar(20) COLLATE utf8_bin DEFAULT NULL,
              `total_count` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `product_provider`;
        CREATE TABLE IF NOT EXISTS `product_provider` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(20) COLLATE utf8_bin NOT NULL,
                  `location` varchar(20) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `provider`;
        CREATE TABLE IF NOT EXISTS `provider` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(20) COLLATE utf8_bin NOT NULL,
                  `location` varchar(20) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `receive_record`;
        CREATE TABLE IF NOT EXISTS `receive_record` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `record_time` int(11) NOT NULL,
                  `record_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                    `provider_id` int(11) NOT NULL,
                      PRIMARY KEY (`id`),
  KEY `record_time` (`record_time`),
  KEY `provider_id` (`provider_id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `receive_record_item`;
        CREATE TABLE IF NOT EXISTS `receive_record_item` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `type` tinyint(4) NOT NULL,
                  `item_id` bigint(20) NOT NULL,
                    `weight` float NOT NULL,
                      `quantity` int(11) NOT NULL,
                        `goods_number` int(11) NOT NULL,
                          `record_id` bigint(20) NOT NULL,
                            `record_time` int(11) NOT NULL,
                              `record_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                                `provider_id` int(11) NOT NULL,
                                  PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`),
  KEY `item` (`type`,`item_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `silk`;
        CREATE TABLE IF NOT EXISTS `silk` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `color_number` int(11) NOT NULL,
                  `color_name` varchar(20) COLLATE utf8_bin NOT NULL,
                    `gang_number` varchar(20) COLLATE utf8_bin NOT NULL,
                      `goods_number` int(11) NOT NULL,
                        `zhi_count` int(11) NOT NULL,
                          PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`) USING BTREE
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;

            DROP TABLE IF EXISTS `storage`;
        CREATE TABLE IF NOT EXISTS `storage` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `item_id` bigint(20) NOT NULL,
                  `type` tinyint(4) NOT NULL,
                    `goods_number` int(11) NOT NULL,
                      `total_weight` float NOT NULL,
                        `total_count` int(11) NOT NULL,
                          `delivered_weight` float NOT NULL,
                            `delivered_count` int(11) NOT NULL,
                              `received_weight` float NOT NULL,
                                `received_count` int(11) NOT NULL,
                                  PRIMARY KEY (`id`),
  KEY `goods_number` (`goods_number`),
  KEY `item` (`type`,`item_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `type`;
        CREATE TABLE IF NOT EXISTS `type` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(20) COLLATE utf8_bin NOT NULL,
                  PRIMARY KEY (`id`)
              ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

            DROP TABLE IF EXISTS `users`;
        CREATE TABLE IF NOT EXISTS `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(20) COLLATE utf8_bin NOT NULL,
                  `telephone` varchar(20) COLLATE utf8_bin NOT NULL,
                    `password` varchar(45) COLLATE utf8_bin NOT NULL,
                      `authority` varchar(45) COLLATE utf8_bin NOT NULL,
                        `available` tinyint(2) NOT NULL,
                          PRIMARY KEY (`id`),
  KEY `name` (`name`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

        INSERT INTO  `yuxuan`.`users` (`id` , `name` ,`telephone` ,`password` ,`authority` ,`available`)
        VALUES (NULL ,  'casa',  '13636495946',  '6752324b14fe3c3c8df0d973e5ae32ed',  'authority',  '0');

        INSERT INTO  `yuxuan`.`type` (`id` ,`name`) VALUES 
            (NULL ,  '毛纱'), (NULL ,  '成衣'), (NULL ,  '前片'), (NULL ,  '后片'), (NULL ,  '左片'), (NULL ,  '右片'),
            (NULL ,  '上片'), (NULL ,  '下片');
        ";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "
            DROP TABLE IF EXISTS `daily_product`;
            DROP TABLE IF EXISTS `delivered_plan`;
            DROP TABLE IF EXISTS `deliver_plan`;
            DROP TABLE IF EXISTS `deliver_plan_item`;
            DROP TABLE IF EXISTS `deliver_record`;
            DROP TABLE IF EXISTS `deliver_record_item`;
            DROP TABLE IF EXISTS `history_product`;
            DROP TABLE IF EXISTS `history_silk`;
            DROP TABLE IF EXISTS `history_storage`;
            DROP TABLE IF EXISTS `order_list`;
            DROP TABLE IF EXISTS `product`;
            DROP TABLE IF EXISTS `product_provider`;
            DROP TABLE IF EXISTS `provider`;
            DROP TABLE IF EXISTS `receive_record`;
            DROP TABLE IF EXISTS `receive_record_item`;
            DROP TABLE IF EXISTS `silk`;
            DROP TABLE IF EXISTS `storage`;
            DROP TABLE IF EXISTS `type`;
            DROP TABLE IF EXISTS `users`;
            ";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
