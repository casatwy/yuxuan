<?php

class DeliveredPlanItem extends DeliveredPlanItemModel
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
