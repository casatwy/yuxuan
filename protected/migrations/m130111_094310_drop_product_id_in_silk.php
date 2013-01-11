<?php

class m130111_094310_drop_product_id_in_silk extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE `silk` DROP `product_id`";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `silk` ADD `product_id` INT NOT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
