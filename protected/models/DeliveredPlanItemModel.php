<?php

/**
 * This is the model class for table "delivered_plan_item".
 *
 * The followings are the available columns in table 'delivered_plan_item':
 * @property integer $id
 * @property integer $silk_id
 * @property integer $count
 * @property double $weight
 * @property string $goods_number
 * @property integer $record_time
 * @property integer $product_id
 * @property string $delivered_plan_id
 * @property integer $client_id
 */
class DeliveredPlanItemModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliveredPlanItemModel the static model class
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
		return 'delivered_plan_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('silk_id, count, weight, goods_number, record_time, product_id, delivered_plan_id, client_id', 'required'),
			array('silk_id, count, record_time, product_id, client_id', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('goods_number', 'length', 'max'=>30),
			array('delivered_plan_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, silk_id, count, weight, goods_number, record_time, product_id, delivered_plan_id, client_id', 'safe', 'on'=>'search'),
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
			'silk_id' => 'Silk',
			'count' => 'Count',
			'weight' => 'Weight',
			'goods_number' => 'Goods Number',
			'record_time' => 'Record Time',
			'product_id' => 'Product',
			'delivered_plan_id' => 'Delivered Plan',
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
		$criteria->compare('silk_id',$this->silk_id);
		$criteria->compare('count',$this->count);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('goods_number',$this->goods_number,true);
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('delivered_plan_id',$this->delivered_plan_id,true);
		$criteria->compare('client_id',$this->client_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}