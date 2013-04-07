<?php
class ProductPart extends ProductPartModel
{
    public static function createProductPart($data, $productIdList, $plan){
        $idList = array();
        foreach($data as $partData){
            $part = new ProductPartModel();
            $part->part_name = $partData['partName'];
            $part->needle_type = $partData['needleType'];
            $part->plan_id = $plan->id;
            if($part->save()){
                array_push($idList, $part->id);
            }else{
                self::model()->deleteById($idList);
                return false;
            }
        }
        return $idList;
    }
}
