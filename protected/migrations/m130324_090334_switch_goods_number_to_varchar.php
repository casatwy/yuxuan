<?php

class m130324_090334_switch_goods_number_to_varchar extends CDbMigration
{
	public function up()
	{
        $sql = "
            ALTER TABLE  `daily_product` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `delivered_plan_item` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `delivered_record_item` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `product` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `product_storage` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `received_record_item` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `silk` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
            ALTER TABLE  `silk_storage` CHANGE  `goods_number`  `goods_number` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
        ";

        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "
            ALTER TABLE  `daily_product` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `delivered_plan_item` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `delivered_record_item` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `product` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `product_storage` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `received_record_item` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `silk` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
            ALTER TABLE  `silk_storage` CHANGE  `goods_number`  `goods_number` INT( 11 ) NOT NULL;
        ";
		return Yii::app()->db->createCommand($sql)->execute();
	}
}
