<?php

/**
 * This is the model class for table "delivered_plan".
 *
 * The followings are the available columns in table 'delivered_plan':
 * @property string $id
 * @property integer $client_id
 * @property integer $record_time
 * @property integer $plan_maker_id
 */
class DeliveredPlan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeliveredPlan the static model class
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
		return 'delivered_plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, record_time, plan_maker_id', 'required'),
			array('client_id, record_time, plan_maker_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, client_id, record_time, plan_maker_id', 'safe', 'on'=>'search'),
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
			'client_id' => 'Client',
			'record_time' => 'Record Time',
			'plan_maker_id' => 'Plan Maker',
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
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('record_time',$this->record_time);
		$criteria->compare('plan_maker_id',$this->plan_maker_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function savePlan($data){
        $plan = new DeliveredPlan;
        $plan->client_id = $data['client_id'];
        $plan->record_time = time();
        $plan->plan_maker_id = Yii::app()->user->getState("user_id");
        if($plan->save()){
            DeliveredPlanItem::saveItem($plan, $data);
        }
    }

    public function getClientName(){
        return Client::model()->findByPk($this->client_id)->name;
    }

    public function getPlanMakerName(){
        return User::model()->findByPk($this->plan_maker_id)->name;
    }

    public function getPlanMakerTelephone(){
        return User::model()->findByPk($this->plan_maker_id)->telephone;
    }

    public static function getPlanContent($plan_id){
        $planList = array(
            'silk' => array(),
            'product' => array(),
        );

        $params = array(":plan_id" => $plan_id);

        $silkCondition = "delivered_plan_id = :plan_id and product_id=-1";
        $silkDeliveredList = DeliveredPlanItem::model()->findAll($silkCondition, $params);
        foreach($silkDeliveredList as $silkDelivered){
            $silk = Silk::model()->findByPk($silkDelivered->silk_id);
            $planList['silk'][] = array(
                "color_name" => $silk->color_name,
                "color_number" => $silk->color_number,
                "gang_number" => $silk->gang_number,
                "weight" => $silkDelivered->weight,
            );
        }

        $productCondition = "delivered_plan_id = :plan_id and silk_id=-1";
        $productDeliveredList = DeliveredPlanItem::model()->findAll($productCondition, $params);
        foreach($productDeliveredList as $productDelivered){
            $product = Product::model()->findByPk($productDelivered->product_id);
            $planList['product'][$product->color_name][] = array(
                "size" => $product->size,
                "count" => $productDelivered->count,
            );
        }

        return $planList;
    }
}
