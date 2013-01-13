<?php

class m130112_153856_added_zhi_count_in_silk extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `silk` ADD  `zhi_count` INT NOT NULL;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `silk` DROP `zhi_count`;";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
