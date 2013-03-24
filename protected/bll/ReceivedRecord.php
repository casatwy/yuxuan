<?php

/**
 * This is the model class for table "received_record".
 *
 * The followings are the available columns in table 'received_record':
 * @property string $id
 * @property integer $record_time
 * @property integer $record_maker_id
 * @property integer $client_id
 */
class ReceivedRecord extends Record
{
    public function tableName(){
        return "received_record";
    }
}
