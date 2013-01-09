<?php

/**
 * This is the model class for table "history_product".
 *
 * The followings are the available columns in table 'history_product':
 * @property string $id
 * @property integer $silk_id
 * @property string $needle_type
 * @property string $size
 * @property integer $goods_number
 * @property string $diaoxian
 */
class HistoryProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HistoryProduct the static model class
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
		return 'history_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('silk_id, needle_type, size, goods_number, diaoxian', 'required'),
			array('silk_id, goods_number', 'numerical', 'integerOnly'=>true),
			array('id, size, diaoxian', 'length', 'max'=>20),
			array('needle_type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, silk_id, needle_type, size, goods_number, diaoxian', 'safe', 'on'=>'search'),
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
			'needle_type' => 'Needle Type',
			'size' => 'Size',
			'goods_number' => 'Goods Number',
			'diaoxian' => 'Diaoxian',
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
		$criteria->compare('silk_id',$this->silk_id);
		$criteria->compare('needle_type',$this->needle_type,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('diaoxian',$this->diaoxian,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}