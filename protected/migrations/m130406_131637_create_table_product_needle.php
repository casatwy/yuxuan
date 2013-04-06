<?php

class m130406_131637_create_table_product_needle extends CDbMigration
{
	public function up()
	{
        $sql = "
            DROP TABLE IF EXISTS `product_part`;
            CREATE TABLE IF NOT EXISTS `product_part` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `part_name` varchar(30) COLLATE utf8_bin NOT NULL,
            `needle_type` varchar(30) COLLATE utf8_bin NOT NULL,
            `plan_id` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `plan_id` (`plan_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "DROP TABLE IF EXISTS `product_part`;";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
