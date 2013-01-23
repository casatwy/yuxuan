<?php

class m130110_165317_modified_about_provider extends CDbMigration
{
	public function up()
	{
        $sql = "drop table silk_provider;RENAME TABLE  `yuxuan`.`product_provider` TO  `yuxuan`.`provider` ;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "RENAME TABLE  `yuxuan`.`provider` TO  `yuxuan`.`product_provider` ;
            DROP TABLE IF EXISTS `silk_provider`;
            CREATE TABLE IF NOT EXISTS `silk_provider` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(20) COLLATE utf8_bin NOT NULL,
                `location` varchar(20) COLLATE utf8_bin NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
        ";
            $sql = "DROP TABLE IF EXISTS `silk_provider`;";
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
