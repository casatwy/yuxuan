<?php

/**
 * This is the model class for table "product_part".
 *
 * The followings are the available columns in table 'product_part':
 * @property integer $id
 * @property string $part_name
 * @property string $needle_type
 * @property integer $plan_id
 */
class ProductPartModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductPartModel the static model class
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
		return 'product_part';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('part_name, needle_type, plan_id', 'required'),
			array('plan_id', 'numerical', 'integerOnly'=>true),
			array('part_name, needle_type', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, part_name, needle_type, plan_id', 'safe', 'on'=>'search'),
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
			'part_name' => 'Part Name',
			'needle_type' => 'Needle Type',
			'plan_id' => 'Plan',
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
		$criteria->compare('part_name',$this->part_name,true);
		$criteria->compare('needle_type',$this->needle_type,true);
		$criteria->compare('plan_id',$this->plan_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}