<?php

class m130111_053348_make_diaoxian_nullable extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE  `product` CHANGE  `diaoxian`  `diaoxian` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_bin NULL";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
		$sql = "ALTER TABLE  `product` CHANGE  `diaoxian`  `diaoxian` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL";
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
