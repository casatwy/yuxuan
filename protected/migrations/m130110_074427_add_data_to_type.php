<?php

class m130110_074427_add_data_to_type extends CDbMigration
{
	public function up()
	{
        $sql = "INSERT INTO  `yuxuan`.`type` (`id` ,`name`) VALUES 
            (NULL ,  '毛纱'), 
            (NULL ,  '成衣'),
            (NULL ,  '前片'),
            (NULL ,  '后片'),
            (NULL ,  '左片'),
            (NULL ,  '右片'),
            (NULL ,  '上片'),
            (NULL ,  '下片')
            ;";
        return Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "truncate table type;";
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
