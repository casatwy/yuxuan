<?php

class m130110_073950_add_type_table extends CDbMigration
{
	public function up()
	{
        $sql = "DROP TABLE IF EXISTS `type`;
                CREATE TABLE IF NOT EXISTS `type` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(20) COLLATE utf8_bin NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "DROP TABLE IF EXISTS `type`;";
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
