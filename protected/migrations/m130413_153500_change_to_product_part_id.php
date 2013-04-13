<?php

class m130413_153500_change_to_product_part_id extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `product` CHANGE  `product_type`  `product_part_id` INT( 11 ) NULL DEFAULT NULL;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE  `product` CHANGE  `product_part_id`  `product_type` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL;";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
