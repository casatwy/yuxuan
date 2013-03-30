<?php

class m130330_190023_change_gang_number_to_string extends CDbMigration
{
	public function up()
	{
        $sql = "
            ALTER TABLE  `product` CHANGE  `gang_number`  `gang_number` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `silk` CHANGE  `gang_number`  `gang_number` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "
            ALTER TABLE  `product` CHANGE  `gang_number`  `gang_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `silk` CHANGE  `gang_number`  `gang_number` INT( 11 ) NOT NULL;
            ";
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
