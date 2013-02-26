<?php

class m130226_130200_renamed_delivered_record_id extends CDbMigration
{
	public function up()
	{
		$sql = "ALTER TABLE  `delivered_record_item` CHANGE  `delivered_record_id`  `record_id` BIGINT( 20 ) NOT NULL;
		ALTER TABLE  `received_record_item` CHANGE  `received_record_id`  `record_id` BIGINT( 20 ) NOT NULL;";
		return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
		$sql = "ALTER TABLE  `delivered_record_item` CHANGE  `record_id`  `delivered_record_id` BIGINT( 20 ) NOT NULL;
		ALTER TABLE  `received_record_item` CHANGE  `record_id`  `received_record_id` BIGINT( 20 ) NOT NULL;";
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
