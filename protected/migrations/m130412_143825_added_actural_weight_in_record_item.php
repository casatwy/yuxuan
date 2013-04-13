<?php

class m130412_143825_added_actural_weight_in_record_item extends CDbMigration
{
	public function up()
	{
        $sql = "
            ALTER TABLE  `delivered_record_item` ADD  `actural_weight` FLOAT NOT NULL;
            ALTER TABLE  `received_record_item` ADD  `actural_weight` FLOAT NOT NULL;
        ";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "
            ALTER TABLE `delivered_record_item` DROP `actural_weight`;
            ALTER TABLE `received_record_item` DROP `actural_weight`;
        ";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
