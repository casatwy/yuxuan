<?php

class m130407_131229_add_diaoxian_in_product extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `product` ADD  `diaoxian` VARCHAR( 30 ) NOT NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `product` DROP `diaoxian`";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
