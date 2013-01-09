<?php

/**
 * This is the model class for table "deliver_record".
 *
 * The followings are the available columns in table 'deliver_record':
 * @property string $id
 * @property string $record_time
 * @property string $record_maker
 * @property integer $silk_provider_id
 * @property integer $deliver_produce_id
 */
class DeliverRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliverRecord the static model class
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
		return 'deliver_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('record_time, record_maker, silk_provider_id', 'required'),
			array('silk_provider_id, deliver_produce_id', 'numerical', 'integerOnly'=>true),
			array('id, record_maker', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, record_time, record_maker, silk_provider_id, deliver_produce_id', 'safe', 'on'=>'search'),
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
			'record_maker' => 'Record Maker',
			'silk_provider_id' => 'Silk Provider',
			'deliver_produce_id' => 'Deliver Produce',
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
		$criteria->compare('record_time',$this->record_time,true);
		$criteria->compare('record_maker',$this->record_maker,true);
		$criteria->compare('silk_provider_id',$this->silk_provider_id);
		$criteria->compare('deliver_produce_id',$this->deliver_produce_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}