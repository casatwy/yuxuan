<?php

class m130211_055214_added_client_id_in_delivered_plan_item extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `delivered_plan_item` ADD  `client_id` INT NOT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `delivered_plan_item` DROP `client_id`";
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
