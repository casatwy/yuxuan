<?php

/**
 * This is the model class for table "history_silk".
 *
 * The followings are the available columns in table 'history_silk':
 * @property string $id
 * @property integer $color_number
 * @property string $color_name
 * @property string $gang_number
 * @property integer $goods_number
 */
class HistorySilk extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HistorySilk the static model class
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
		return 'history_silk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('color_number, color_name, gang_number, goods_number', 'required'),
			array('color_number, goods_number', 'numerical', 'integerOnly'=>true),
			array('id, color_name, gang_number', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, color_number, color_name, gang_number, goods_number', 'safe', 'on'=>'search'),
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
			'color_number' => 'Color Number',
			'color_name' => 'Color Name',
			'gang_number' => 'Gang Number',
			'goods_number' => 'Goods Number',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('color_number',$this->color_number);
		$criteria->compare('color_name',$this->color_name,true);
		$criteria->compare('gang_number',$this->gang_number,true);
		$criteria->compare('goods_number',$this->goods_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}