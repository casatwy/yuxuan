<?php

/**
 * This is the model class for table "received_record".
 *
 * The followings are the available columns in table 'received_record':
 * @property string $id
 * @property integer $record_time
 * @property integer $record_maker_id
 * @property integer $client_id
 */
class ReceivedRecordModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceivedRecordModel the static model class
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
		return 'received_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('record_time, record_maker_id, client_id', 'required'),
			array('record_time, record_maker_id, client_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, record_time, record_maker_id, client_id', 'safe', 'on'=>'search'),
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
			'record_maker_id' => 'Record Maker',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('record_maker_id',$this->record_maker_id);
		$criteria->compare('client_id',$this->client_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}