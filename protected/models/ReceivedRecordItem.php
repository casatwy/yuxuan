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
 */
class ReceivedRecordItem extends CActiveRecord
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

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('received_record_id, goods_number, record_time, record_maker_id, product_id, type', 'required'),
			array('count, goods_number, record_time, record_maker_id, product_id, type', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('received_record_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, received_record_id, weight, count, goods_number, record_time, record_maker_id, product_id, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'received_record_id' => 'Received Record',
			'weight' => 'Weight',
			'count' => 'Count',
			'goods_number' => 'Goods Number',
			'record_time' => 'Record Time',
			'record_maker_id' => 'Record Maker',
			'product_id' => 'Product',
			'type' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('received_record_id',$this->received_record_id,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('count',$this->count);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('record_maker_id',$this->record_maker_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}