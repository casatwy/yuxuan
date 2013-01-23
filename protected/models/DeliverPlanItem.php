<?php

/**
 * This is the model class for table "deliver_plan_item".
 *
 * The followings are the available columns in table 'deliver_plan_item':
 * @property integer $id
 * @property string $product_id
 * @property integer $quantity
 * @property integer $goods_number
 * @property string $plan_id
 * @property integer $record_time
 * @property string $plan_maker
 * @property integer $provider_id
 */
class DeliverPlanItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliverPlanItem the static model class
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
		return 'deliver_plan_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, quantity, goods_number, plan_id, record_time, plan_maker, provider_id', 'required'),
			array('quantity, goods_number, record_time, provider_id', 'numerical', 'integerOnly'=>true),
			array('product_id, plan_id, plan_maker', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, quantity, goods_number, plan_id, record_time, plan_maker, provider_id', 'safe', 'on'=>'search'),
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
            "provider"=>array(self::BELONGS_TO, 'Provider', 'provider_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'quantity' => 'Quantity',
			'goods_number' => 'Goods Number',
			'plan_id' => 'Plan',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('plan_id',$this->plan_id,true);
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('plan_maker',$this->plan_maker,true);
		$criteria->compare('provider_id',$this->provider_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
