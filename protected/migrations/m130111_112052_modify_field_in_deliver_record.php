<?php

class m130111_112052_modify_field_in_deliver_record extends CDbMigration
{
	public function up()
	{
        $sql = "alter table deliver_record drop column deliver_produce_id ,
            change silk_provider_id provider_id int not null;";
        Yii::app()->db->createCommand($sql)->execute();
	}

	public function down()
	{
        $sql = "alter table deliver_record add deliver_produce_id int not null,
            change provider_id silk_provider_id int not null;";
        Yii::app()->db->createCommand($sql)->execute();
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
