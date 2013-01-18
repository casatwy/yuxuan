<?php

class m130118_080401_alert_user_available extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `users` ADD  `available` TINYINT( 2 ) NOT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `users` DROP `available`";
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
