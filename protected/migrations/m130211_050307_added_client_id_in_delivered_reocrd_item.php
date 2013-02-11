<?php

class m130211_050307_added_client_id_in_delivered_reocrd_item extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `delivered_record_item` ADD  `client_id` INT NOT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `delivered_record_item` DROP `client_id`";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
