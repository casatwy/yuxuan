<?php

/**
 * This is the model class for table "silk".
 *
 * The followings are the available columns in table 'silk':
 * @property integer $id
 * @property string $goods_number
 * @property string $color_name
 * @property integer $color_number
 * @property integer $gang_number
 * @property integer $order_id
 */
class SilkModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SilkModel the static model class
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
		return 'silk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_number, color_name, color_number, gang_number, order_id', 'required'),
			array('color_number, gang_number, order_id', 'numerical', 'integerOnly'=>true),
			array('goods_number', 'length', 'max'=>30),
			array('color_name', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, goods_number, color_name, color_number, gang_number, order_id', 'safe', 'on'=>'search'),
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
			'goods_number' => 'Goods Number',
			'color_name' => 'Color Name',
			'color_number' => 'Color Number',
			'gang_number' => 'Gang Number',
			'order_id' => 'Order',
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
		$criteria->compare('goods_number',$this->goods_number,true);
		$criteria->compare('color_name',$this->color_name,true);
		$criteria->compare('color_number',$this->color_number);
		$criteria->compare('gang_number',$this->gang_number);
		$criteria->compare('order_id',$this->order_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}