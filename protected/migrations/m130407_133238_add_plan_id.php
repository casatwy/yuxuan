<?php

class m130407_133238_add_plan_id extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `product` ADD  `plan_id` INT NOT NULL;
                ALTER TABLE  `product` ADD INDEX (  `plan_id` );";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "ALTER TABLE `product` DROP `plan_id`";
        return Yii::app()->db->createCommand($sql)->execute();
	}
}
