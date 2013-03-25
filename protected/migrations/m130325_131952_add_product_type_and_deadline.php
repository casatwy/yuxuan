<?php

class m130325_131952_add_product_type_and_deadline extends CDbMigration
{
	public function up()
	{
        $sql = "
            ALTER TABLE  `product` ADD  `product_type` VARCHAR( 50 ) NULL;
            ALTER TABLE  `product` ADD  `gang_number` VARCHAR( 50 ) NULL;
            ALTER TABLE  `product` ADD  `deadline_time` INT( 11 ) NULL;
            ALTER TABLE `daily_product` DROP `type`;
        ";

        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "
            ALTER TABLE `product` DROP `deadline_time`;
            ALTER TABLE `product` DROP `product_type`;
            ALTER TABLE `product` DROP `gang_number`;
            ALTER TABLE  `daily_product` ADD  `type` tinyint( 4 );
        ";

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
