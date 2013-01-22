<?php

/**
 * This is the model class for table "deliver_plan".
 *
 * The followings are the available columns in table 'deliver_plan':
 * @property string $id
 * @property integer $record_time
 * @property string $plan_maker
 * @property integer $provider_id
 */
class DeliverPlan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliverPlan the static model class
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
		return 'deliver_plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('record_time, plan_maker, provider_id', 'required'),
			array('record_time, provider_id', 'numerical', 'integerOnly'=>true),
			array('plan_maker', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, record_time, plan_maker, provider_id', 'safe', 'on'=>'search'),
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
			'record_time' => 'Record Time',
			'plan_maker' => 'Plan Maker',
			'provider_id' => 'Provider',
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
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('plan_maker',$this->plan_maker,true);
		$criteria->compare('provider_id',$this->provider_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}