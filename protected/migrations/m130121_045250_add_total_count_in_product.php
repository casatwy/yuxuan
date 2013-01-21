<?php

class m130121_045250_add_total_count_in_product extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `product` ADD  `total_count` INT NULL;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `product` DROP `total_count`;";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
