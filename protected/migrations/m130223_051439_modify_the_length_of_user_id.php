<?php

class m130223_051439_modify_the_length_of_user_id extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `received_record` CHANGE  `record_maker_id`  `record_maker_id` INT( 11 ) NOT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
		return true;
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
