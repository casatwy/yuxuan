<?php

/**
 * This is the model class for table "daily_product".
 *
 * The followings are the available columns in table 'daily_product':
 * @property integer $id
 * @property integer $time
 * @property integer $product_id
 * @property integer $count
 * @property integer $goods_number
 */
class DailyProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DailyProduct the static model class
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
		return 'daily_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('time, product_id, count, goods_number', 'required'),
			array('time, product_id, count, goods_number', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time, product_id, count, goods_number', 'safe', 'on'=>'search'),
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
			'time' => 'Time',
			'product_id' => 'Product',
			'count' => 'Count',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('time',$this->time);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('count',$this->count);
		$criteria->compare('goods_number',$this->goods_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getFinishedSum($product_id){
        $sql = "select sum(count) as finished from `daily_product` where product_id=".$product_id;
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }
}
