<?php

/**
 * This is the model class for table "plan".
 *
 * The followings are the available columns in table 'plan':
 * @property integer $id
 * @property string $goods_number
 * @property integer $client_id
 * @property integer $create_time
 * @property integer $deadline_time
 */
class PlanModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PlanModel the static model class
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
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_number, client_id, create_time, deadline_time', 'required'),
			array('client_id, create_time, deadline_time', 'numerical', 'integerOnly'=>true),
			array('goods_number', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, goods_number, client_id, create_time, deadline_time', 'safe', 'on'=>'search'),
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
			'client_id' => 'Client',
			'create_time' => 'Create Time',
			'deadline_time' => 'Deadline Time',
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
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('deadline_time',$this->deadline_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}