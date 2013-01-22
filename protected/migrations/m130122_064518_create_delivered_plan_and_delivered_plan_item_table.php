<?php

class m130122_064518_create_delivered_plan_and_delivered_plan_item_table extends CDbMigration
{
    public function up()
    {
        $sql = "DROP TABLE IF EXISTS `deliver_plan`;

                CREATE TABLE IF NOT EXISTS `deliver_plan` (
                `id` bigint(20) NOT NULL AUTO_INCREMENT,
                `record_time` int(11) NOT NULL,
                `plan_maker` varchar(20) COLLATE utf8_bin NOT NULL,
                `provider_id` int(11) NOT NULL,
                PRIMARY KEY (`id`),
                KEY `record_time` (`record_time`),
                KEY `silk_provider_id` (`provider_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1000000 ;";
        Yii::app()->db->createCommand($sql)->execute();

        $sql = "DROP TABLE IF EXISTS `deliver_plan_item`;
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
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        return Yii::app()->db->createCommand($sql)->execute();
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS `deliver_plan`;
                DROP TABLE IF EXISTS `deliver_plan_item`;";
        return Yii::app()->db->createCommand($sql)->execute();
    }
}
