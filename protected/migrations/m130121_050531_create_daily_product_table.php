<?php

class m130121_050531_create_daily_product_table extends CDbMigration
{
	public function up()
	{
        $sql = "DROP TABLE IF EXISTS `daily_product`;
                CREATE TABLE IF NOT EXISTS `daily_product` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `time` int(11) NOT NULL,
                `product_id` int(11) NOT NULL,
                `count` int(11) NOT NULL,
                `goods_number` int(11) NOT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "DROP TABLE IF EXISTS `daily_product`;";
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
