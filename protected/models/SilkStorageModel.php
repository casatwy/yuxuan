<?php

/**
 * This is the model class for table "silk_storage".
 *
 * The followings are the available columns in table 'silk_storage':
 * @property integer $id
 * @property double $weight
 * @property string $goods_number
 * @property integer $silk_id
 */
class SilkStorageModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SilkStorageModel the static model class
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
		return 'silk_storage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('weight, goods_number, silk_id', 'required'),
			array('silk_id', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('goods_number', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, weight, goods_number, silk_id', 'safe', 'on'=>'search'),
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
			'weight' => 'Weight',
			'goods_number' => 'Goods Number',
			'silk_id' => 'Silk',
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
		$criteria->compare('weight',$this->weight);
		$criteria->compare('goods_number',$this->goods_number,true);
		$criteria->compare('silk_id',$this->silk_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}