<?php

class m130413_180305_modified_some_attributes_in_record_item extends CDbMigration
{
	public function up()
	{
        $sql = "
            ALTER TABLE  `delivered_record_item` CHANGE  `weight`  `weight` FLOAT NULL DEFAULT '0',
            CHANGE  `count`  `count` INT( 11 ) NULL DEFAULT '0',
            CHANGE  `actural_weight`  `actural_weight` FLOAT NULL DEFAULT '0';
        ";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "
            ALTER TABLE  `delivered_record_item` CHANGE  `weight`  `weight` FLOAT NOT NULL ,
            CHANGE  `count`  `count` INT( 11 ) NOT NULL ,
            CHANGE  `actural_weight`  `actural_weight` FLOAT NOT NULL;
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
