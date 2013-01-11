<?php

class m130109_045406_create_tables extends CDbMigration
{
	public function up()
	{
        $sql = "DROP TABLE IF EXISTS `deliver_record`;
                CREATE TABLE IF NOT EXISTS `deliver_record` (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `record_time` int(11) NOT NULL,
                    `record_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                    `silk_provider_id` int(11) NOT NULL,
                    `deliver_produce_id` int(11) DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    KEY `record_time` (`record_time`),
                    KEY `deliver_produce_id` (`deliver_produce_id`),
                    KEY `silk_provider_id` (`silk_provider_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `deliver_record_item`;
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
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `history_product`;
                CREATE TABLE IF NOT EXISTS `history_product` (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `silk_id` int(11) NOT NULL,
                    `needle_type` varchar(10) COLLATE utf8_bin NOT NULL,
                    `size` varchar(20) COLLATE utf8_bin NOT NULL,
                    `goods_number` int(11) NOT NULL,
                    `diaoxian` varchar(20) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `goods_number` (`goods_number`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `history_silk`;
                CREATE TABLE IF NOT EXISTS `history_silk` (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `color_number` int(11) NOT NULL,
                    `color_name` varchar(20) COLLATE utf8_bin NOT NULL,
                    `gang_number` varchar(20) COLLATE utf8_bin NOT NULL,
                    `goods_number` int(11) NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `goods_number` (`goods_number`) USING BTREE
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `history_storage`;
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
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `product`;
                CREATE TABLE IF NOT EXISTS `product` (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `silk_id` int(11) NOT NULL,
                    `needle_type` varchar(10) COLLATE utf8_bin NOT NULL,
                    `size` varchar(20) COLLATE utf8_bin NOT NULL,
                    `goods_number` int(11) NOT NULL,
                    `diaoxian` varchar(20) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `goods_number` (`goods_number`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `product_provider`;
                CREATE TABLE IF NOT EXISTS `product_provider` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(20) COLLATE utf8_bin NOT NULL,
                    `location` varchar(20) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `receive_record`;
                CREATE TABLE IF NOT EXISTS `receive_record` (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `record_time` int(11) NOT NULL,
                    `record_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                    `provider_id` int(11) NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `record_time` (`record_time`),
                    KEY `provider_id` (`provider_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `receive_record_item`;
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
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `silk`;
                CREATE TABLE IF NOT EXISTS `silk` (
                    `id` bigint(20) NOT NULL AUTO_INCREMENT,
                    `color_number` int(11) NOT NULL,
                    `color_name` varchar(20) COLLATE utf8_bin NOT NULL,
                    `gang_number` varchar(20) COLLATE utf8_bin NOT NULL,
                    `goods_number` int(11) NOT NULL,
                    `product_id` bigint(20) DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    KEY `goods_number` (`goods_number`) USING BTREE
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `silk_provider`;
                CREATE TABLE IF NOT EXISTS `silk_provider` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(20) COLLATE utf8_bin NOT NULL,
                    `location` varchar(20) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `storage`;
                CREATE TABLE IF NOT EXISTS `storage` (
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
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `users`;
                CREATE TABLE IF NOT EXISTS `users` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(20) COLLATE utf8_bin NOT NULL,
                    `telephone` varchar(20) COLLATE utf8_bin NOT NULL,
                    `password` varchar(45) COLLATE utf8_bin NOT NULL,
                    `authority` varchar(45) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

                INSERT INTO `users` (`id`, `name`, `telephone`, `password`, `authority`) VALUES
                (1, 'casa', '13636495946', '6752324b14fe3c3c8df0d973e5ae32ed', 'authority'),
                (2, 'twy', '13636495946', '6752324b14fe3c3c8df0d973e5ae32ed', 'authority');
                ";
        Yii::app()->db->createCommand($sql)->execute();

        return true;
	}

	public function down()
	{
        $sql = "DROP TABLE `deliver_record`;
                DROP TABLE `deliver_record_item`;
                DROP TABLE `history_product`;
                DROP TABLE `history_silk`;
                DROP TABLE `history_storage`;
                DROP TABLE `product`;
                DROP TABLE `product_provider`;
                DROP TABLE `receive_record`;
                DROP TABLE `receive_record_item`;
                DROP TABLE `silk`;
                DROP TABLE `silk_provider`;
                DROP TABLE `storage`;
                DROP TABLE `users`;";
		return Yii::app()->db->createCommand($sql)->execute();
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
