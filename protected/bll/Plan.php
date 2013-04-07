<?php

class Plan extends PlanModel
{
    public static function createPlan($data)
    {
        $plan = new Plan();
        $plan->goods_number = $data['goods_number'];
        $plan->client_id = $data['client_id'];
        $plan->deadline_time = strtotime($data['deadline']);
        $plan->create_time = time();
        if($plan->save()){
            $productIdList = Product::createProduct($data['productData'], $plan);
            if($productIdList){
                $partIdList = ProductPart::createProductPart($data['partData'], $productIdList, $plan);
                if(!$partIdList){
                    Product::deleteByIdList($productIdList);
                }
            }else{
                $plan->delete();
            }
        }
    }
}
