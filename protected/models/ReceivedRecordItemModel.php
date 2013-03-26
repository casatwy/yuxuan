<?php

/**
 * This is the model class for table "received_record_item".
 *
 * The followings are the available columns in table 'received_record_item':
 * @property integer $id
 * @property string $record_id
 * @property double $weight
 * @property integer $count
 * @property string $goods_number
 * @property integer $record_time
 * @property integer $record_maker_id
 * @property integer $product_id
 * @property integer $type
 * @property integer $client_id
 */
class ReceivedRecordItemModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceivedRecordItemModel the static model class
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
			array('record_id, goods_number, record_time, record_maker_id, product_id, type, client_id', 'required'),
			array('count, record_time, record_maker_id, product_id, type, client_id', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('record_id', 'length', 'max'=>20),
			array('goods_number', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, record_id, weight, count, goods_number, record_time, record_maker_id, product_id, type, client_id', 'safe', 'on'=>'search'),
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
			'record_id' => 'Record',
			'weight' => 'Weight',
			'count' => 'Count',
			'goods_number' => 'Goods Number',
			'record_time' => 'Record Time',
			'record_maker_id' => 'Record Maker',
			'product_id' => 'Product',
			'type' => 'Type',
			'client_id' => 'Client',
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
		$criteria->compare('record_id',$this->record_id,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('count',$this->count);
		$criteria->compare('goods_number',$this->goods_number,true);
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('record_maker_id',$this->record_maker_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('client_id',$this->client_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}