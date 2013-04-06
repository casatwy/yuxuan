<?php

class m130406_134407_drop_needle_type_in_product extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE `product` DROP `needle_type`";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE  `product` ADD  `needle_type` INT NOT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
