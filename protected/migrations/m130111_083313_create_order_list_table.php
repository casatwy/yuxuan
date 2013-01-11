<?php

class m130111_083313_create_order_list_table extends CDbMigration
{
	public function up()
	{
        $sql = "DROP TABLE IF EXISTS `order_list`;
        CREATE TABLE IF NOT EXISTS `order_list` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
        `status` varchar(24) COLLATE utf8_bin DEFAULT NULL,
        `received` bigint(20) DEFAULT NULL,
        `receivable` bigint(20) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
		echo "m130111_083313_create_order_list_table does not support migration down.\n";
		return false;
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
