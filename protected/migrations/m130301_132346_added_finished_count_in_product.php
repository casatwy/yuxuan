<?php

class m130301_132346_added_finished_count_in_product extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `product` ADD  `finished_count` INT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `product` DROP `finished_count`";
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
