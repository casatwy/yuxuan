<?php

/**
 * This is the model class for table "storage".
 *
 * The followings are the available columns in table 'storage':
 * @property integer $id
 * @property string $item_id
 * @property integer $type
 * @property integer $goods_number
 * @property double $total_weight
 * @property integer $total_count
 * @property double $delivered_weight
 * @property integer $delivered_count
 * @property double $received_weight
 * @property integer $received_count
 */
class Storage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Storage the static model class
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
		return 'storage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, type, goods_number, total_weight, total_count, delivered_weight, delivered_count, received_weight, received_count', 'required'),
			array('type, goods_number, total_count, delivered_count, received_count', 'numerical', 'integerOnly'=>true),
			array('total_weight, delivered_weight, received_weight', 'numerical'),
			array('item_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_id, type, goods_number, total_weight, total_count, delivered_weight, delivered_count, received_weight, received_count', 'safe', 'on'=>'search'),
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
			'item_id' => 'Item',
			'type' => 'Type',
			'goods_number' => 'Goods Number',
			'total_weight' => 'Total Weight',
			'total_count' => 'Total Count',
			'delivered_weight' => 'Delivered Weight',
			'delivered_count' => 'Delivered Count',
			'received_weight' => 'Received Weight',
			'received_count' => 'Received Count',
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
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('total_weight',$this->total_weight);
		$criteria->compare('total_count',$this->total_count);
		$criteria->compare('delivered_weight',$this->delivered_weight);
		$criteria->compare('delivered_count',$this->delivered_count);
		$criteria->compare('received_weight',$this->received_weight);
		$criteria->compare('received_count',$this->received_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}