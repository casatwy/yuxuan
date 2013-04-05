<?php

class m130405_134128_create_table_plan extends CDbMigration
{
	public function up()
	{
        $sql = "
            DROP TABLE IF EXISTS `plan`;
            CREATE TABLE IF NOT EXISTS `plan` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `goods_number` varchar(30) COLLATE utf8_bin NOT NULL,
            `client_id` int(11) NOT NULL,
            `create_time` int(11) NOT NULL,
            `deadline_time` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `goods_number` (`goods_number`),
            KEY `create_time` (`create_time`),
            KEY `deadline_time` (`deadline_time`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "DROP TABLE IF EXISTS `plan`;";
        Yii::app()->db->createCommand($sql)->execute();
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
