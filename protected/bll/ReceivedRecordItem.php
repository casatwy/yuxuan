<?php

/**
 * This is the model class for table "received_record_item".
 *
 * The followings are the available columns in table 'received_record_item':
 * @property integer $id
 * @property string $received_record_id
 * @property double $weight
 * @property integer $count
 * @property integer $goods_number
 * @property integer $record_time
 * @property integer $record_maker_id
 * @property integer $product_id
 * @property integer $type
 * @property integer $client_id
 */
class ReceivedRecordItem extends ReceivedRecordItemModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceivedRecordItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'received_record_item';
	}

}
