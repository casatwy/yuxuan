<?php

/**
 * This is the model class for table "delivered_plan_item".
 *
 * The followings are the available columns in table 'delivered_plan_item':
 * @property integer $id
 * @property integer $silk_id
 * @property integer $count
 * @property double $weight
 * @property integer $goods_number
 * @property integer $record_time
 * @property integer $client_id
 * @property integer $product_id
 * @property string $delivered_plan_id
 */
class DeliveredPlanItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliveredPlanItem the static model class
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
		return 'delivered_plan_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('silk_id, count, weight, goods_number, record_time, client_id, product_id, delivered_plan_id', 'required'),
			array('silk_id, count, goods_number, record_time, client_id, product_id', 'numerical', 'integerOnly'=>true),
			array('weight', 'numerical'),
			array('delivered_plan_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, silk_id, count, weight, goods_number, record_time, client_id, product_id, delivered_plan_id', 'safe', 'on'=>'search'),
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
			'count' => 'Count',
			'weight' => 'Weight',
			'goods_number' => 'Goods Number',
			'record_time' => 'Record Time',
			'client_id' => 'Client',
			'product_id' => 'Product',
			'delivered_plan_id' => 'Delivered Plan',
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
		$criteria->compare('silk_id',$this->silk_id);
		$criteria->compare('count',$this->count);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('delivered_plan_id',$this->delivered_plan_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function saveItem($plan, $data){
        foreach($data['silk'] as $silk){
            $item = new DeliveredPlanItem;
            $item->silk_id = $silk['silk_id'];
            $item->count = -1;
            $item->weight = $silk['weight'];
            $item->goods_number = $data['goods_number'];
            $item->record_time = $plan->record_time;
            $item->product_id = -1;
            $item->delivered_plan_id = $plan->id;
            $item->client_id = $plan->client_id;
            $item->save();
        }
        foreach($data['product'] as $product){
            $item = new DeliveredPlanItem;
            $item->silk_id = -1;
            $item->count = $product['count'];
            $item->weight = -1;
            $item->goods_number = $data['goods_number'];
            $item->record_time = $plan->record_time;
            $item->product_id = $product['product_id'];
            $item->delivered_plan_id = $plan->id;
            $item->client_id = $plan->client_id;
            $item->save();
        }
    }

    public function getPlanMakerName(){
        DeliveredPlan::model()->findByPk($this->delivered_plan_id)->getPlanMakerName();
    }

    public function getMakerTelephone(){
        DeliveredPlan::model()->findByPk($this->delivered_plan_id)->getPlanMakerTelephone();
    }
}
