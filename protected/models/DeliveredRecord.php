<?php

/**
 * This is the model class for table "delivered_record".
 *
 * The followings are the available columns in table 'delivered_record':
 * @property string $id
 * @property integer $record_time
 * @property integer $record_maker_id
 * @property integer $client_id
 */
class DeliveredRecord extends Record
{
    public function tableName(){
        return "delivered_record";
    }
}
