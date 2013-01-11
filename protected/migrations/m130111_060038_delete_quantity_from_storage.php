<?php

class m130111_060038_delete_quantity_from_storage extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE `storage` DROP `quantity`;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE  `storage` ADD  `quantity` INT NOT NULL;";
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
