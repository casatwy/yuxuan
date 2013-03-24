<?php

class DeliveredPlan extends DeliveredPlanModel
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
