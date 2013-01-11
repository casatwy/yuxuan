<?php

class m130111_055059_added_columns_in_storage extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `storage` ADD  `received_weight` FLOAT NOT NULL AFTER  `delivered_count` ,
                ADD  `received_count` INT NOT NULL AFTER  `received_weight`";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `storage` DROP `received_weight`, DROP `received_count`;";
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
